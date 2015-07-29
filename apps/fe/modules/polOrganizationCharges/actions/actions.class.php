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
 * polOrganizationCharges actions.
 *
 * @package    openpolis
 * @subpackage polOrganizationCharges
 * @author     Gianluca Canale
 * @version    SVN: $Id: actions.class.php 1814 2006-08-24 12:20:11Z fabien $
 */
 
class polOrganizationChargesActions extends sfActions
{
  
  /**************************************/
	public function executeCreate()
	{
		//calendar library
		$this->getResponse()->addJavascript('/sf/calendar/calendar.js');
		$this->getResponse()->addJavascript('/sf/calendar/lang/calendar-it.js');
		$this->getResponse()->addJavascript('/sf/calendar/calendar-setup.js');
		$this->getResponse()->addStylesheet('/sf/calendar/skins/aqua/theme.css');
	
  	$this->hasLayout = $this->getRequestParameter('has_layout');
  	
  	$this->politician_id = $this->getRequestParameter('politician_id');
	
		$this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));
	
		$this->current='1';
		$this->organization_charge = new OpOrganizationCharge();
		$this->setLayout('politiciansLayout');
  	$this->setTemplate('edit');
	}
	
	/**************************************/
	public function executeEdit() 
	{
		//calendar library
		$this->getResponse()->addJavascript('/sf/calendar/calendar.js');
		$this->getResponse()->addJavascript('/sf/calendar/lang/calendar-it.js');
		$this->getResponse()->addJavascript('/sf/calendar/calendar-setup.js');
		$this->getResponse()->addStylesheet('/sf/calendar/skins/aqua/theme.css');
	
		$this->hasLayout = $this->getRequestParameter('has_layout');
    	
		$this->organization_charge = OpOrganizationChargePeer::retrieveByPk($this->getRequestParameter('content_id'));
		$this->current = $this->organization_charge->getCurrent();
		
		$this->politician_id = $this->organization_charge->getPoliticianId();
		$this->politician = OpPoliticianPeer::retrieveByPk($this->politician_id);
		
  	$this->forward404Unless($this->organization_charge);
		$this->setLayout('politiciansLayout');
	}
  	
  	
    
	
	/**************************************/
  	public function executeUpdateorganizationcharge()
  	{
    		
		$this->hasLayout = $this->getRequestParameter('has_layout');
    if (!$this->getRequestParameter('content_id'))
    {
      $organization_charge = new OpOrganizationCharge();
      $organization_charge->setPoliticianId($this->getRequestParameter('politician_id'));
    }
    else
    {
      $organization_charge = OpOrganizationChargePeer::retrieveByPk($this->getRequestParameter('content_id'));
      $this->forward404Unless($organization_charge);
    }
		
		$organization_charge->setOrganizationId($this->getRequestParameter('organization_id'));
		
		$organization_charge->setChargeName($this->getRequestParameter('charge_name'));
		
		$organization_charge->setCurrent($this->getRequestParameter('current'));
		
    if ($this->getRequestParameter('date_start[year]'))
    {
      $organization_charge->setDateStart($this->getRequestParameter('date_start[year]')."-01-01");
    }
    else
    {
      $organization_charge->setDateStart();
    }

    if ($this->getRequestParameter('date_end[year]'))
    {
      $organization_charge->setDateEnd($this->getRequestParameter('date_end[year]')."-01-01");
    }
    else
    {
      $organization_charge->setDateEnd();
    }

    $organization_charge->save();
		
		//inserimento link organizzazione
		if($this->getRequestParameter('url'))
		{
			$organization = OpOrganizationPeer::RetrieveByPk($this->getRequestParameter('organization_id'));
			$organization->setUrl($this->getRequestParameter('url'));
			$organization->save();
		}
		
		if($this->getRequestParameter('organization_url'))
		{
			$organization = OpOrganizationPeer::RetrieveByPk($this->getRequestParameter('organization_id'));
			$organization->setUrl($this->getRequestParameter('organization_url'));
			$organization->save();
		}
		
		//inserimento tags delle organizzazioni
		if($this->getRequestParameter('organization_tags'))
		{
			$tags=split(',',$this->getRequestParameter('organization_tags'));
			foreach($tags as $tag)
			{
				$tag = trim(strip_tags($tag));
				
				//controllo se il tag gia esiste
				$c=new Criteria();
				$c->Add(OpOrganizationTagPeer::NAME, $tag);
				$existing_tag=OpOrganizationTagPeer::DoSelectOne($c);
				
				if($existing_tag)
				{
					//il tag esiste
					$new_m2m_organization_tag=new OpOrganizationHasOpOrganizationTag();
					$new_m2m_organization_tag->setOrganizationTagId($existing_tag->getId());
				}
				else
				{		
					//il tag non esiste
					$organization_tag=new OpOrganizationTag();
					$organization_tag->setName($tag);
					$organization_tag->save();
				
					$new_m2m_organization_tag=new OpOrganizationHasOpOrganizationTag();
					$new_m2m_organization_tag->setOrganizationTagId($organization_tag->getId());
				}		
				
				$new_m2m_organization_tag->setOrganizationId($this->getRequestParameter('organization_id'));
				$new_m2m_organization_tag->save();
			}
			
		}
		
		if ($this->hasLayout == 'false'){
    		return $this->redirect('polOrganizationCharges/showorganizationcharges?'.'has_layout=false&content_id='.$organization_charge->getPoliticianId());
		}
		else
		{
    		return $this->redirect('politician/page?content_id='.$organization_charge->getPoliticianId());
		}
	}	


  /**************************************/
  public function handleErrorUpdateorganizationcharge()
  {
        
	  if($this->getRequestParameter('content_id'))
	  {	
        $this->organization_charge = OpOrganizationChargePeer::retrieveByPk($this->getRequestParameter('content_id'));
	  }
	  else
	  {
	    $this->organization_charge = new OpOrganizationCharge();
		  $this->organization_charge->setOrganizationId($this->getRequestParameter('organization_id'));
		
	  }
	  
	  $this->hasLayout = $this->getRequestParameter('has_layout');			
	  $this->politician_id = $this->getRequestParameter('politician_id');			
	  $this->politician = OpPoliticianPeer::retrieveByPk($this->politician_id);
	  $this->current = $this->getRequestParameter('current');
	
	  $this->setTemplate('edit');
	  return sfView::SUCCESS;
	}
	
	/**************************************/
  	public function executeOrganization()
  	{
		$this->organization_name=$this->getRequestParameter('organization','');
		$this->control_name=str_replace(' ', '',$this->organization_name);
		$this->current=$this->getRequestParameter('current','1');
		
		//validazione
		if (strlen($this->control_name)!=0)
		{
			$this->organization_id=$this->getRequestParameter('organization_id','');
			$this->politician_id=$this->getRequestParameter('politician_id','');
			$this->hasLayout = $this->getRequestParameter('has_layout');
			
			//nuova organizzazione inserita
			if($this->organization_id == '')
			{
			
				$this->organization_name = trim(strip_tags($this->organization_name));
				
				//controllo se il nome dell'organizzazione è gia presente
				$c1=new Criteria();
				$c1->Add(OpOrganizationPeer::NAME,$this->organization_name);
				$org=OpOrganizationPeer::doSelectOne($c1);
				
				if($org)
				{
					$this->organization=$org;
					$this->organization_id=$org->getId();
				}
				else
				//nome non presente
				{
					$this->organization = new OpOrganization();
					$this->organization->setName(trim(strip_tags($this->getRequestParameter('organization'))));
					$this->organization->save();
				
					$this->organization_id=$this->organization->getId();
				}
								
			}
			else
			{
				$this->organization=OpOrganizationPeer::RetrieveByPk($this->organization_id);	
			}
			
			$this->organization_charge = new OpOrganizationCharge();
			$this->organization_charge->setPoliticianId($this->politician_id);
			$this->organization_charge->setOrganizationId($this->organization_id);
		
		
		}
		else
		{
			return sfView::NONE;
		}
			
	}
	
	/**************************************/
    public function executeObscuration()
    {
      $this->organization_charge_id = $this->getRequestParameter('organization_charge_id');
    }
		
	/**************************************/
	public function executeDelete()
  	{
    	$this->hasLayout = $this->getRequestParameter('has_layout');
    	$organization_charge = OpOrganizationChargePeer::retrieveByPk($this->getRequestParameter('content_id'));
    	
		$this->forward404Unless($organization_charge);
		
		$this->op_politician_id = $organization_charge->getPoliticianId();
		
		//settaggio del campo deleted at di open content
		$open_content=OpOpenContentPeer::RetrieveByPk($this->getRequestParameter('content_id'));
    $open_content->setDeletedAt(time());
		$open_content->save();
		
		//inserimento nella tabella obscured content
		$obscured_content = new OpObscuredContent();
		$obscured_content->setUserId($this->getRequestParameter('user_id'));
		$obscured_content->setContentId($this->getRequestParameter('content_id'));
		$obscured_content->setReason($this->getRequestParameter('reason'));
		$obscured_content->save();

    // eventuale aggiornamento del campo op_user.last_contribution e op_user.charges
    $user = OpUserPeer::retrieveByPK($this->getRequestParameter('user_id'));
    $user->updateLastContribution();
    $user->setCharges($user->countCharges());
    $user->save();

    unset($user);

		
		//invio email di notifica
  	$raw_email = $this->sendEmail('mail', 'sendObscurationNotification');
		
		
		//invio messaggistica
		//TODO
		 		
		return $this->redirect('@politico_new?slug='. $organization_charge->getOpPolitician()->getSlug() .'&content_id='.$this->op_politician_id);
		
	}
	
  public function executeTab()
  {
    $this->op_politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));

    $this->ist_count = $this->getRequestParameter('ist_count');
    $this->pol_count = $this->getRequestParameter('pol_count');
    $this->org_count = $this->getRequestParameter('org_count');

    //seleziono le cariche organizzative attuali pubblicate
    $c4=new Criteria();
    $c4->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c4->add(OpOrganizationChargePeer::CURRENT, 1, Criteria::EQUAL);
    $c4->addDescendingOrderByColumn(OpOrganizationChargePeer::DATE_START);
    $this->organization_charges = $this->op_politician->getOpOrganizationChargesJoinOpOpenContent($c4);

    //seleziono le cariche organizzative passate pubblicate
    $c4bis=new Criteria();
    $c4bis->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c4bis->add(OpOrganizationChargePeer::CURRENT, 0, Criteria::EQUAL);
    $c4bis->addDescendingOrderByColumn(OpOrganizationChargePeer::DATE_START);
    $this->past_organization_charges = $this->op_politician->getOpOrganizationChargesJoinOpOpenContent($c4bis);
	
  }	
	
}

?>