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
 * autocompleter actions.
 *
 * @package    openpolis
 * @subpackage autocompleter
 * @author     Gianluca Canale
 * @version    SVN: $Id: actions.class.php 1814 2006-08-24 12:20:11Z fabien $
 */
class autocompleterActions extends sfActions
{
	/***************************************************************/
	public function executePolitician_autocomplete() {
		
		$this->politicians = myCustom::custom1($this->getRequestParameter('politician'), true);
	}
	
	public function executeLocation_autocomplete() {
		
		$this->locations = myCustom::custom2($this->getRequestParameter('location'), true);
	}
	
	//differisce da Location_autocomplete perchè trova solo i politici
	//relativi a giunte e consigli comunali
	public function executeLocation2_autocomplete() {
		
		$this->locations = myCustom::custom2($this->getRequestParameter('location2'), true);
	}
	
	/***************************************************************/
	public function executeOrganization_autocomplete() {
		
		$this->my_str = $this->getRequestParameter('organization');
		
		$c = new Criteria();
		$c->Add(OpOrganizationPeer::ID,'',Criteria::NOT_EQUAL);
		$c->Add(OpOrganizationPeer::NAME, $this->my_str."%", Criteria::LIKE);
		$c->addAscendingOrderByColumn(OpOrganizationPeer::NAME);
		$c->setLimit(sfConfig::get('app_autocomplete_limit'));
		
		$this->organizations=OpOrganizationPeer::doSelect($c);
				
		/*query nel caso di numero di record minore di quello minimo previsto
		if (count($this->organizations)<sfConfig::get('app_autocomplete_limit')) {
			$this->organizations = null;
			$c1 = new Criteria();
			$c1->Add(OpOrganizationPeer::ID,'',Criteria::NOT_EQUAL);
			$c1->Add(OpOrganizationPeer::NAME, "%".$this->my_str."%", Criteria::LIKE);
			$c1->addAscendingOrderByColumn(OpOrganizationPeer::NAME);
			$c1->setLimit(sfConfig::get('app_autocomplete_limit'));
			
			$this->organizations=OpOrganizationPeer::doSelect($c1);
		}
		*/
	}
	
	/***************************************************************/
	public function executeOrganizationTagsAutocomplete() {
		
		$this->organization_id=$this->getRequestParameter('org_id');
		$this->my_str1 = $this->getRequestParameter('organization_tags');
		
		$c = new Criteria();
		$c->Add(OpOrganizationTagPeer::NAME, $this->my_str1."%", Criteria::LIKE);
		$this->tags=OpOrganizationTagPeer::doSelect($c);
			
	}
	
	public function executeTagsAutocomplete() {
		
		$this->content_id=$this->getRequestParameter('content_id');
		$this->my_str = $this->getRequestParameter('tags');
		
		$c = new Criteria();
		$c->Add(OpTagPeer::TAG, $this->my_str."%", Criteria::LIKE);
		$this->tags=OpTagPeer::doSelect($c);
						
	}
	
	/***************************************************************/
	public function executeArgumentAutocomplete() {
		
		$this->my_str = $this->getRequestParameter('argument');
		
		$c = new Criteria();
		$c->Add(OpTagPeer::TAG, $this->my_str."%", Criteria::LIKE);
		$this->tags=OpTagPeer::doSelect($c);
			
	}
	
	public function executePartyAutocomplete() {
		
		$this->my_str = $this->getRequestParameter('party');
		
		$c = new Criteria();
		$c->Add(OpPartyPeer::NAME, $this->my_str."%", Criteria::LIKE);
		$c->addAscendingOrderByColumn(OpPartyPeer::NAME);
		$c->setLimit(sfConfig::get('app_autocomplete_limit'));
		
		$this->parties=OpPartyPeer::doSelect($c);
	}
	
	public function executeGroupAutocomplete() {
		
		$this->my_str = $this->getRequestParameter('group');
		
		$c = new Criteria();
		$c->Add(OpGroupPeer::NAME, $this->my_str."%", Criteria::LIKE);
		$c->addAscendingOrderByColumn(OpGroupPeer::NAME);
		$c->setLimit(sfConfig::get('app_autocomplete_limit'));
		
		$this->groups=OpGroupPeer::doSelect($c);
		
	}
	
}
?>
