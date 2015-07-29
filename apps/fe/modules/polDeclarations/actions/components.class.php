<?php
/*****************************************************************************
 *    Questo file e' parte del progetto openpolis.
 * 
 *    openpolis - la politica trasparente
 *    copyright (C) 2008
 *    Ass. Democrazia Elettronica e Partecipazione Pubblica, 
 *    Via Luigi Montuori 5, 00154 - Roma, Italia
 *
 *    openpolis e' free software; e' possibile redistribuirlo o modificarlo
 *    nei termini della General Public License GNU, versione 2 o successive;
 *    secondo quanto pubblicato dalla Free Software Foundation.
 *
 *    openpolis e' distribuito nella speranza che risulti utile, 
 *    ma SENZA ALCUNA GARANZIA.
 *    
 *    Potete trovare la licenza GPL e altre informazioni su licenze e 
 *    copyright, nella cartella "licenze" del package.
 *
 *    $HeadURL$
 *    $LastChangedDate$
 *    $LastChangedBy$
 *    $LastChangedRevision$
 *
 ****************************************************************************/
?>
<?php
/**
 * polDeclarations components.
 *
 * @package    openpolis
 * @subpackage polDeclarations
 * @author     Gianluca Canale
 * @version    SVN: $Id: components.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class polDeclarationsComponents extends sfComponents
{

  /**
   * elenco di tutte le dichiarazioni paginato
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeDeclarationsList()
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    $c->addJoin(OpContentPeer::ID, OpDeclarationPeer::CONTENT_ID);
    $c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $declarations = OpDeclarationPeer::doSelect($c);
    
    $this->nDeclarations = count($declarations);
    $this->pager = new ArrayPager(null, sfConfig::get('app_pagination_declaration_limit'));
    $this->pager->setResultsArray($declarations);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }

  /**
   * elenco delle ultime n dichiarazioni
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeLastDeclarations()
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    $c->addJoin(OpContentPeer::ID, OpDeclarationPeer::CONTENT_ID);
    $c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c->setLimit($this->amount);
    $this->declarations = OpDeclarationPeer::doSelect($c);
  }


  public function executeShowdeclaration()
  {
  }

  public function executeBlockForPoliticianPage()
  {
    $this->op_politician = OpPoliticianPeer::retrieveByPk($this->politician_id);
	
	  //seleziono le dichiarazioni pubblicate
    $c = new Criteria();
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    if($this->limit != 'no_limit')
	  $c->setLimit($this->limit);
    if($this->sort == 'last')
      $c->addDescendingOrderByColumn(OpDeclarationPeer::DATE);
    elseif($this->sort == 'insert')
      $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    else
      $c->addDescendingOrderByColumn(OpDeclarationPeer::RELEVANCY_SCORE);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $this->declarations = $this->op_politician->getOpDeclarationsJoinOpOpenContent($c);
  }
  
  public function executeBlockForArgumentPage()
  {
    $this->op_politician = OpPoliticianPeer::retrieveByPk($this->politician_id);
	  $this->declarations = OpDeclarationPeer::getPopularByTag($this->tag_id, $this->politician_id, $this->sort, $this->limit);
  }

  public function executeDeclarationsBlockForTheme()
  {
	  $this->declarations = OpDeclarationPeer::getDeclarationsByTheme($this->theme_id, $this->sort);
  }

  public function executeSelectableList()
  {
    // legge il theme_id dalla variabile di sessione
    $theme_id = $this->getUser()->getAttribute('theme_id', 0);
    $this->theme = OpThemePeer::retrieveByPK($theme_id);

    $this->sort = $this->getRequestParameter('sort', 'last');
    $this->selectable_query = $this->getRequestParameter('selectable_query', $this->theme->getTitle());
    
    $c = new Criteria();
    
    // ordinamento
    if($this->sort == 'last')
      $c->addDescendingOrderByColumn(OpDeclarationPeer::DATE);
    elseif($this->sort == 'insert')
      $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    else
      $c->addDescendingOrderByColumn(OpDeclarationPeer::RELEVANCY_SCORE);

    // eliminazione contenuti oscurati
    $c->addJoin(OpContentPeer::ID, OpDeclarationPeer::CONTENT_ID);
    $c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    
    // eliminazione contenuti già associati
    $ca = new Criteria();
    $ca->addJoin(OpThemePeer::CONTENT_ID, OpThemeHasDeclarationPeer::THEME_ID);
    $ca->add(OpThemePeer::CONTENT_ID, $theme_id);
    $associated_decls = OpThemeHasDeclarationPeer::doSelect($ca);
    $associated_decls_ids = array();
    foreach ($associated_decls as $associated_decl) 
      $associated_decls_ids[] = $associated_decl->getDeclarationId();
    $criterion = $c->getNewCriterion(OpDeclarationPeer::CONTENT_ID, $associated_decls_ids, Criteria::NOT_IN);
    unset($ca);
    

    // filtro
    if ($this->selectable_query != 'Inserisci un filtro' && $this->selectable_query != 'x')
    {
      $query = strip_tags(trim($this->selectable_query));
      $composed_query  = " declaration_title: " . $query . "^2.5";
      $composed_query .= " declaration_text: " . $query . "^1.0";
      $composed_query .= " declaration_author: " . $query . "^6.0";
      $composed_query .= " declaration_tags: " . $query . "^3.0";
      $hits = $this->_doSearch($composed_query, 0, sfConfig::get('app_search_max_results', 500));
      $hits_ids = array();
      foreach ($hits as $hit) $hits_ids[]=$hit->declaration_id;
      $criterion->addAnd($c->getNewCriterion(OpDeclarationPeer::CONTENT_ID, $hits_ids, Criteria::IN));
    }

    $c->add($criterion);
        
    $pager = new sfPropelPager('OpDeclaration', sfConfig::get('app_pagination_selectable_declaration_limit'));
    $pager->setCriteria($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
  }
  
  
  /**
   * 
   * effettua una ricerca di una query, con offset e limit specificati
   * setta le meta-variabili per la vista (status, QTime, numFound)
   * 
   * @return array con i risultati
   * @author Guglielmo
   **/
  private function _doSearch($query, $offset, $limit)
  {
    try
    {
      require_once('Apache/Solr/Service.php');
      $solr = new Apache_Solr_Service('localhost', 8080, '/solr_op');
      
      // effettua la ricerca
      $this->docs = array();
      $response = $solr->search($query, $offset, $limit, array("fl"=>"*,score"));
      $this->status = $response->responseHeader->status;
      $this->QTime = $response->responseHeader->QTime;
      $numFound = $response->response->numFound;
      if ($numFound > 0)
      {
        $this->doc_number = $response->response->start;
        $this->docs = $response->response->docs;
      }
      
      return $this->docs;      

    } catch (Exception $e) { 
      throw new Exception($e->getMessage()); 
    }    
    
  }
  
  
}

?>
