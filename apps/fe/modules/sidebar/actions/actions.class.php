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
 * sidebar actions.
 *
 * @package    openpolis
 * @subpackage sidebar
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1814 2006-08-24 12:20:11Z fabien $
 */
 
class sidebarActions extends sfActions
{
  /**************************************/	
  public function executePopularPoliticiansCloud()
  {
    $this->period = $this->getRequestParameter('period', 'week');
    switch($this->period)
    {
      case 'week':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
		break;
      case 'mounth':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m")-1,date("d"), date("Y")));
        break;
      default:
        $date = '-1';
    }
	
	if($date=='-1')
      $this->politicians = OpPoliticianPeer::getPopulars(sfConfig::get('app_tag_cloud_max'));
    else
      $this->politicians = OpPoliticianPeer::getPopulars(sfConfig::get('app_tag_cloud_max'), $date);
  }

  /**************************************/  
  public function executePopularTagsCloud()
  {
    $this->period = $this->getRequestParameter('period', 'week');
    switch($this->period)
    {
      case 'week':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
		break;
      case 'mounth':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m")-1,date("d"), date("Y")));
        break;
      default:
        $date = '-1';
    }
    
    if($date=='-1')
      $this->tags = OpTagPeer::getPopularTags(sfConfig::get('app_tag_cloud_max'));
    else
      $this->tags = OpTagPeer::getPopularTags(sfConfig::get('app_tag_cloud_max'), $date);
  }

  /**************************************/ 
  public function executeInstitutionPoliticiansCloud()
  {
    $this->period = $this->getRequestParameter('period', 'week');
	  $this->location_id = $this->getRequestParameter('id',0);
	
    switch($this->period)
    {
      case 'week':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
		break;
      case 'mounth':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m")-1,date("d"), date("Y")));
        break;
      default:
        $date = '-1';
    }
	
	if($date=='-1')
      $this->politicians = OpPoliticianPeer::getPopularsForInstitution($this->location_id, sfConfig::get('app_tag_cloud_max'));
    else
      $this->politicians = OpPoliticianPeer::getPopularsForInstitution($this->location_id, sfConfig::get('app_tag_cloud_max'), $date);	  	  
  }

  /**************************************/  
  public function executeInstitutionTagsCloud()
  {  	  
    $this->period = $this->getRequestParameter('period', 'week');
	  $this->location_id = $this->getRequestParameter('id',0);
	
    switch($this->period)
    {
      case 'week':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
		break;
      case 'mounth':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m")-1,date("d"), date("Y")));
        break;
      default:
        $date = '-1';
    }
    
    if($date=='-1')
      $this->tags = OpTagPeer::getInstitutionTags($this->location_id, sfConfig::get('app_tag_cloud_max'));
    else
      $this->tags = OpTagPeer::getInstitutionTags($this->location_id, sfConfig::get('app_tag_cloud_max'), $date);
  }

  /**************************************/ 
  public function executeLocationPoliticiansCloud()
  {
    $this->period = $this->getRequestParameter('period', 'week');
	$this->location_id = $this->getRequestParameter('location_id',0);
	
    switch($this->period)
    {
      case 'week':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
		break;
      case 'mounth':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m")-1,date("d"), date("Y")));
        break;
      default:
        $date = '-1';
    }
	
	if($date=='-1')
      $this->politicians = OpPoliticianPeer::getPopularsForLocation($this->location_id, sfConfig::get('app_tag_cloud_max'));
    else
      $this->politicians = OpPoliticianPeer::getPopularsForLocation($this->location_id, sfConfig::get('app_tag_cloud_max'), $date);	  	  
  }

  /**************************************/  
  public function executeLocationTagsCloud()
  {  	  
    $this->period = $this->getRequestParameter('period', 'week');
	$this->location_id = $this->getRequestParameter('location_id',0);
	$this->routing = $this->getRequestParameter('routing', '');
	
    switch($this->period)
    {
      case 'week':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
		break;
      case 'mounth':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m")-1,date("d"), date("Y")));
        break;
      default:
        $date = '-1';
    }
    
    if($date=='-1')
      $this->tags = OpTagPeer::getLocationTags($this->location_id, $this->routing ,sfConfig::get('app_tag_cloud_max'));
    else
      $this->tags = OpTagPeer::getLocationTags($this->location_id, $this->routing ,sfConfig::get('app_tag_cloud_max'), $date);
  }  

  /**************************************/  
  public function executeCloudForPolitician()
  {  	  
    $this->period = $this->getRequestParameter('period', 'week');
	$this->content_id = $this->getRequestParameter('content_id','0');
	
    switch($this->period)
    {
      case 'week':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
		break;
      case 'mounth':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m")-1,date("d"), date("Y")));
        break;
      default:
        $date = '-1';
    }
    
    if($date=='-1')
      $this->tags = OpTagPeer::getTagsForPolitician($this->content_id, sfConfig::get('app_tag_cloud_max'));
    else
      $this->tags = OpTagPeer::getTagsForPolitician($this->content_id, sfConfig::get('app_tag_cloud_max'), $date);
  }

  /**************************************/ 
  public function executePoliticiansForTagCloud()
  {
    $this->period = $this->getRequestParameter('period', 'week');
	$this->tag_id = $this->getRequestParameter('tag_id',0);
	
    switch($this->period)
    {
      case 'week':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
		break;
      case 'mounth':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m")-1,date("d"), date("Y")));
        break;
      default:
        $date = '-1';
    }
	
	if($date=='-1')
      $this->politicians=OpTagPeer::getPoliticians($this->tag_id, sfConfig::get('app_tag_cloud_max'));
    else
      $this->politicians=OpTagPeer::getPoliticians($this->tag_id, sfConfig::get('app_tag_cloud_max'), $date);
  }
  
  /**************************************/  
  public function executeLocationFeed()
  {   
    $this->declarations = OpDeclarationPeer::getPopularsForLocation($this->getRequestParameter('location_id'), 3, 50);
  }
  
  public function executeInstitutionFeed()
  {
    $this->declarations = OpDeclarationPeer::getPopularsForInstitution($this->getRequestParameter('id'), 50);
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
