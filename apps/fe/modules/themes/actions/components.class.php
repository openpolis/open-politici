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
 * themes components.
 *
 * @package    openpolis
 * @subpackage themes
 * @author     Guglielmo Celata
 * @version    SVN: $Id: components.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class themesComponents extends sfComponents
{

  /**
   * elenco paginato di tutti i temi
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeThemesList()
  {
    $c = new Criteria();
    if ($this->sort == 'popular')
      $c->addDescendingOrderByColumn(OpThemePeer::RELEVANCY_SCORE);
    else if ($this->sort == 'insert')
      $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    else if ($this->sort == 'vsq08')
      $c->add(OpThemePeer::VSQ08, 0, Criteria::GREATER_THAN);
    else
      $c->addAscendingOrderByColumn('RAND(NOW())');
    
    $c->addJoin(OpThemePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    
    if ($this->area != 'x'){
      $c->addJoin(OpOpinableContentPeer::CONTENT_ID, OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID);
      $c->addJoin(OpTagHasOpOpinableContentPeer::TAG_ID, OpTagPeer::ID);
      $c->addJoin(OpOpinableContentPeer::CONTENT_ID, OpContentPeer::ID);
      $c->add(OpTagPeer::NORMALIZED_TAG, $this->area);
    }
    $c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
    $this->themes = OpThemePeer::doSelect($c);
    
    // costruisce l'array associativo di aree tematiche per la select (filtro)
    $areas = sfConfig::get('app_area_for_theme'); 
    $selectables[''] = "== Tutte le aree ==";
    foreach ($areas as $a){
      $selectables[myTag::normalize($a)] = $a;
    }
    $this->selectable_areas = $selectables;
    
    $this->nThemes = count($this->themes);
    $this->pager = new ArrayPager(null, sfConfig::get('app_pagination_themes_limit'));
    $this->pager->setResultsArray($this->themes);
    $this->pager->setPage($this->page);
    $this->pager->init();
  }

  public function executeBlockForComments()
  {
    $c = new Criteria();
    $c->Add(OpCommentPeer::CONTENT_ID, $this->theme_id, Criteria::EQUAL);

    //sorting
    if ($this->sort=='date')
      // by date
      $c->addDescendingOrderByColumn(OpCommentPeer::CREATED_AT);
    else
    {
      //sorted by relevancy
      $c->addAsColumn('relevancy', 
                      OpCommentPeer::RELEVANCY_SCORE_UP . 
                      ' / (' . OpCommentPeer::RELEVANCY_SCORE_UP . ' + ' . 
                      OpCommentPeer::RELEVANCY_SCORE_DOWN.')' );
      $c->addDescendingOrderByColumn('relevancy');
      $c->addDescendingOrderByColumn(OpCommentPeer::RELEVANCY_SCORE_UP);	
    }
    
	  $this->comments = OpCommentPeer::doSelect($c);
  
  }	

}

?>
