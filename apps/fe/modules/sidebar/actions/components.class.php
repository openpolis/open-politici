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
 * sidebar components.
 *
 * @package    openpolis
 * @subpackage sidebar
 * @author     Guglielmo Celata
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */

class sidebarComponents extends sfComponents
{
  /********** componenti per i moderatori *************/
  public function executeDefault()
  {
  }

  public function executeEmpty()
  {
  }

  /*********************************************/
  /************ CLOUD COMPONENTS ***************/
  /*********************************************/
  public function executeDefaultCloud()
  {
  }
  
  /************ spalla su singola dichiarazione con dich. su argomenti stessa data */
  public function executeSingleDeclarationCorrelated()
  {
    // funzione per rendere unici i valori di un array multidimensionale
    function super_unique($array)
    {
      $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

      foreach ($result as $key => $value)
      {
        if ( is_array($value) )
        {
          $result[$key] = super_unique($value);
        }
      }

      return $result;
    }
    
    $declaration = OpDeclarationPeer::retrieveByPk($this->getRequestParameter('declaration_id'));
    $this->declaration_id=$declaration->getContentId();
    $tags=$declaration->getTags();
    $tag_ids=array();
    foreach ($tags as $tag)
    {
      $tag_ids[]=$tag->getTagId();
    }
    $declarations = OpDeclarationPeer::getPopularByTag($tag_ids, 0, 'last', false, $declaration->getDate(),'20');
    $this->declarations=super_unique($declarations);
  }

  /************ nuvola con tutti i politici + nuvola con tutti i tag ***************/
  public function executePopularClouds()
  {
    //ricavo l'ultima settimana
    $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
	  
	  //se bisogna considerare l'ultima settimana, sostituire 'all' con $date e modificare il template
	  $this->politicians = OpPoliticianPeer::getPopulars(sfConfig::get('app_tag_cloud_max'), 'all');
    $this->tags = OpTagPeer::getPopularTags(sfConfig::get('app_tag_cloud_max'), 'all');
  }

  /************ nuvola con tutti i politici di una istituzione nazionale + nuvola con tutti i tag ***************/	
  public function executeInstitutionClouds()
  {
    $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
	  $this->location_id = $this->getRequestParameter('id',0);
	
	  $this->politicians = OpPoliticianPeer::getPopularsForInstitution($this->location_id, sfConfig::get('app_tag_cloud_max'), 'all');
    $this->tags = OpTagPeer::getInstitutionTags($this->location_id, sfConfig::get('app_tag_cloud_max'), 'all');
  }

  /************ nuvola con tutti i politici di una istituzione locale + nuvola con tutti i tag ***************/
  public function executeLocationClouds()
  {
    $this->location_id = $this->getRequestParameter('location_id',0);
	$date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
	
	$internalUri=sfRouting::getInstance()->getCurrentInternalUri();
    $routing = substr($internalUri,0,strpos($internalUri,'?'));
    
	switch($routing)
    {
     case 'politician/regPoliticians':
        $this->rout = 'regPoliticians';
        break;
      case 'politician/provPoliticians':
        $this->rout = 'provPoliticians';
        break;
      case 'politician/munPoliticians':
        $this->rout = 'munPoliticians';
        break;			
    }			
			
    $this->politicians = OpPoliticianPeer::getPopularsForLocation($this->location_id, sfConfig::get('app_tag_cloud_max'), 'all');
    $this->tags = OpTagPeer::getLocationTags($this->location_id, $routing ,sfConfig::get('app_tag_cloud_max'), 'all');
  }
  
  /************ nuvola degli argomenti associati ad un politico ***************/
  public function executeCloudForPolitician()
  {
    $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
	$this->content_id = $this->getRequestParameter('content_id','0'); 
	
	$this->tags = OpTagPeer::getTagsForPolitician($this->content_id, sfConfig::get('app_tag_cloud_max'), $date);
  }

  /************ nuvola del politici associati ad un tag ***************/
  public function executePoliticiansForTagCloud()
  {
    $tag=OpTagPeer::RetrieveByPk($this->getRequestParameter('tag','0'));
    $this->tag_id=$tag->getId();
	$date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
	
    $this->politicians=OpTagPeer::getPoliticians($this->tag_id, sfConfig::get('app_tag_cloud_max'), 'all');
  }
	
  /*********************************************/
  /************* WIKI COMPONENTS ***************/
  /*********************************************/

  /****** wiki per le istituzioni nazionali ******/
  public function executeInstitutionWiki()
  {
			
  }

  /****** wiki per le istituzioni regionali ******/
  public function executeRegionalWiki()
  {
			
  }
	
  /****** wiki per le istituzioni provinciali ******/
  public function executeProvincialWiki()
  {
			
  }
	
  /****** wiki per le istituzioni comunali ******/
  public function executeMunicipalWiki()
  {
			
  }
	
  /****** wiki di un politico ******/
  public function executePoliticianWiki()
  {
			
  }
	
  /****** wiki di un tag ******/
  public function executeTagWiki()
  {
			
  }
  
  public function executeLastDeclarations()
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    $c->addJoin(OpContentPeer::ID, OpDeclarationPeer::CONTENT_ID);
    $c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c->setLimit(20);
    $this->declarations = OpDeclarationPeer::doSelect($c);
  }
	
	
  /*************************************************/
  /************* FEED RSS COMPONENTS ***************/
  /*************************************************/

  public function executeDefaultFeed()
  {
  
  }
	
  /****** feed rss con le dichiarazioni dei politici di una istituzione nazionale ******/
  public function executeInstitutionFeed()
  {
    $this->declarations = OpDeclarationPeer::getPopularsForInstitution($this->getRequestParameter('id'), 10);
    $this->institution = OpInstitutionPeer::RetrieveByPk($this->getRequestParameter('id'));
	
	$this->total_declarations = count(OpDeclarationPeer::getPopularsForInstitution($this->getRequestParameter('id'), 50));
  }
	
  /****** feed rss con le dichiarazioni dei politici di una istituzione locale ******/
  public function executeLocationFeed()
  {
    $this->declarations = OpDeclarationPeer::getPopularsForLocation($this->getRequestParameter('location_id'), null, 10);
    $this->location = OpLocationPeer::RetrieveByPk($this->getRequestParameter('location_id'));
	
	$this->total_declarations = count(OpDeclarationPeer::getPopularsForLocation($this->getRequestParameter('location_id'), null, 50));
  }
  public function executeTaxDeclaration()
  {
    
  }

  public function executeLinkBilancio()
  {
        $comune=OpLocationPeer::retriveByPk($this->getRequestParameter('location_id'));
        $text=$comune->getName();
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        $prov=strtolower($comune->getProv());
        $this->link=$text."-comune-".$prov;
  }


}

?>
