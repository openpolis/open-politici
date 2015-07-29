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
 * solr actions.
 *
 * @package    openpolis
 * @subpackage solr
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class solrActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('solr', 'search');
  }
  
  public function executeSearch()
  { 
    $this->hit_types = array(
      'op_politician' =>  'Politico',
      'op_declaration' => 'Dichiarazione',
      'op_comment'     => 'Commento',
      'op_tag'         => 'Tag'
    );
    $this->response->setTitle('risultati ricerca | openpolis');
	  $this->query = ""; 
    $this->rows = sfConfig::get('app_pagination_search_results', 10);
    if ($this->getRequest()->getMethod() == sfRequest::POST || $this->getRequest()->getMethod() == sfRequest::GET)
    {
      $this->query = strip_tags(trim($this->getRequestParameter('query')));
            
      // estrae la prima parola e la stringa quoted
  		$q_first = ""; $quoted = false;
  		if (strpos($this->query, '"') === false)
  		{
  		  $words = split(" ", $this->query);
    		$q_first = $words[0];		  
  		  $quoted = '"' . $this->query . '"';
  		}

  		// definizione dei boost (spostare in config??)
  		$pol_last_boost = 3.0;
  		$loc_boost = 2.5;
  		$tag_boost = 2.0;
  		$decl_title_boost = 1.5;
  		$decl_text_boost = 1.0;
  		$pol_name_boost = 1.0;
  		$comment_body_boost = 0.5;

  		// compone la query ponderata
      $composed_query  = "+(";
      if ($quoted) 
      {
        $composed_query .= " politician_last_name: ($quoted)^" . $pol_last_boost . " ";
        $composed_query .= " location_name: ($quoted)^" . $loc_boost . " ";
        $composed_query .= " tag: ($quoted)^" . $tag_boost . " ";
        $composed_query .= " declaration_title: ($quoted)^" . $decl_title_boost . " ";
        $composed_query .= " declaration_text: ($quoted)^" . $decl_text_boost . " ";
        $composed_query .= " politician_name: ($quoted)^" . $pol_name_boost . " ";
        $composed_query .= " comment_body: ($quoted)^" . $comment_body_boost . " ";
      }
      if ($q_first)
      {
        $composed_query .= " politician_last_name: ($q_first*)^" . $pol_last_boost . " ";
        $composed_query .= " location_name: ($q_first*)^" . $loc_boost . " ";
        $composed_query .= " tag: ($q_first*)^" . $tag_boost . " ";
        $composed_query .= " declaration_title: ($q_first*)^" . $decl_title_boost . " ";
        $composed_query .= " declaration_text: ($q_first*)^" . $decl_text_boost . " ";
        $composed_query .= " politician_name: ($q_first*)^" . $pol_name_boost . " ";
        $composed_query .= " comment_body: ($q_first*)^" . $comment_body_boost . " ";
      }

      $composed_query .= " politician_last_name:(" . $this->query . ")^" . $pol_last_boost;
      $composed_query .= " location_name:(" . $this->query . ")^" . $loc_boost;
      $composed_query .= " tag:(" . $this->query . ")^" . $tag_boost;
      $composed_query .= " declaration_title:(" . $this->query . ")^" . $decl_title_boost;
      $composed_query .= " declaration_text:(" . $this->query . ")^" . $decl_text_boost;
      $composed_query .= " politician_name:(" . $this->query . ")^" . $pol_name_boost;
      $composed_query .= " comment_body:(" . $this->query . ")^" . $comment_body_boost;
      
      $composed_query .= ") ";

      $this->myquery = $composed_query;
      
      try {
        $this->hits = $this->_doSearch($composed_query, 0, sfConfig::get('app_search_max_results', 500));        
        $this->totale = count($this->hits);
        $this->pager = new ArrayPager(null, $this->rows);
        $this->pager->setResultsArray($this->hits);
        $this->pager->setPage($this->getRequestParameter('page',1));
        $this->pager->init();

      } catch (Exception $e) {
        echo $e->getMessage();
        $this->err_msg = $e->getMessage();
      }
    }
  }

  public function executeSearchDeclaration()
  {   
    $this->query = ""; 
    $this->rows = sfConfig::get('app_pagination_search_results', 10);
    if ($this->getRequest()->getMethod() == sfRequest::POST || $this->getRequest()->getMethod() == sfRequest::GET)
    {
      $this->query = strip_tags(trim($this->getRequestParameter('query')));
      $composed_query  = " declaration_title: " . $this->query . "^2.5";
      $composed_query .= " declaration_text: " . $this->query . "^1.0";
      $composed_query .= " declaration_author: " . $this->query . "^6.0";
      $composed_query .= " declaration_tags: " . $this->query . "^3.0";
      
      try {
        $this->hits = $this->_doSearch($composed_query, 0, sfConfig::get('app_search_max_results', 500));        
        $this->totale = count($this->hits);
        $this->pager = new ArrayPager(null, $this->rows);
        $this->pager->setResultsArray($this->hits);
        $this->pager->setPage($this->getRequestParameter('page',1));
        $this->pager->init();

      } catch (Exception $e) {
        $this->err_msg = $e->getMessage();
      }
    }
  }

  public function executeSearchPolitician()
  {    
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {

      $query = strip_tags(strtolower(trim($this->getRequestParameter('politician'))));
      $unspaced_query = str_replace(array(" ", "-", "'"), "", $query);
      $c_query  = "politician_name_sort:" .$unspaced_query ."*^5.0";
      $c_query .= " politician_name:" . trim($query) . "^3.0";
      $c_query .= " politician_name:" . trim($query) . "*";
      $this->c_query = $c_query;    

      try {
        $this->hits = $this->_doSearch($c_query, 0, 10);        
        $this->totale = count($this->hits);

      } catch (Exception $e) {
        $this->err_msg = $e->getMessage();
        $this->setFlash('err_msg', $e->getMessage());
      }
    }
  }

  public function executeSearchLocation()
  {    
    if ($this->getRequest()->getMethod() == sfRequest::POST || $this->getRequest()->getMethod() == sfRequest::GET)
    {
      $this->query = strip_tags(trim($this->getRequestParameter('query')));
      $this->rows = sfConfig::get('app_pagination_search_results', 10);
      
      $composed_query = "location_name:" . $this->query;
      try {
        $this->hits = $this->_doSearch($composed_query, 0, sfConfig::get('app_search_max_results', 500));        
        $this->totale = count($this->hits);
        $this->pager = new ArrayPager(null, $this->rows);
        $this->pager->setResultsArray($this->hits);
        $this->pager->setPage($this->getRequestParameter('page',1));
        $this->pager->init();

      } catch (Exception $e) {
        $this->err_msg = $e->getMessage();
        $this->setFlash('err_msg', $e->getMessage());
      }


    }
  }

  public function executeSearchLocationComune()
  {    
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {      
      $query = strip_tags(strtolower(trim($this->getRequestParameter('location'))));
      $unspaced_query = str_replace(" ", "", $query);
      $c_query = "+(location_name_sort:" .$unspaced_query ."*^5.0";
      $c_query .= "  location_name:" . $query . "^3.0";
      $c_query .= "  location_name:" . $query . "*" . ")";
      $c_query .= " +location_type_s: Comune";  
      $this->c_query = $c_query;    
      
      try {
        $this->hits = $this->_doSearch($c_query, 0, 10);        
        $this->totale = count($this->hits);

      } catch (Exception $e) {
        $this->err_msg = $e->getMessage();
        $this->setFlash('err_msg', $e->getMessage());
      }
      
    }
  }

  public function executeLocation_autocomplete()
  {    
    if ($this->getRequest()->getMethod() == sfRequest::POST || $this->getRequest()->getMethod() == sfRequest::GET)
    {
      $query = strip_tags(strtolower(trim($this->getRequestParameter('location'))));
      $unspaced_query = str_replace(array(" ", "-", "'"), "", $query);
      $c_query  = "+(location_name_sort:" .$unspaced_query ."*^5.0";
      $c_query .= "  location_name:" . $query . "^3.0";
      $c_query .= "  location_name:" . $query . "*" . ")";
      $c_query .= " +location_type_s: Comune";  
      $this->c_query = $c_query;    
      
      try {
        $this->hits = $this->_doSearch($c_query, 0, 10);        
        $this->totale = count($this->hits);

      } catch (Exception $e) {
        $this->err_msg = $e->getMessage();
        $this->setFlash('err_msg', $e->getMessage());
      }
    }

  }

  public function executePolitician_autocomplete()
  {    
    if ($this->getRequest()->getMethod() == sfRequest::POST || $this->getRequest()->getMethod() == sfRequest::GET)
    {
      $query = strip_tags(strtolower(trim($this->getRequestParameter('politician'))));
      $unspaced_query = str_replace(array(" ", "-", "'"), "", $query);
      $c_query  = "politician_name_sort:" .$unspaced_query ."*^5.0";
      $c_query .= " politician_name:" . trim($query) . "^3.0";
      $c_query .= " politician_name:" . trim($query) . "*";
      $this->c_query = $c_query;    
      
      try {
        $this->hits = $this->_doSearch($c_query, 0, 10);        
        $this->totale = count($this->hits);

      } catch (Exception $e) {
        $this->err_msg = $e->getMessage();
        $this->setFlash('err_msg', $e->getMessage());
      }
    }

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
      $solr = new Apache_Solr_Service('localhost', 8080, '/openpolitici');
      
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
