<?php

/**
 * polOrgCharges actions.
 *
 * @package    openpolis
 * @subpackage polOrgCharges
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class polOrgChargesActions extends sfActions
{
  
  
  public function executeCreate()
  {
    $this->forward('polOrgCharges', 'organizationEdit');
  }
  
  public function executeOrganizationEdit()
  {
    if ($this->getRequest()->getMethod() != sfRequest::POST)
    {
      // l'id del politico di cui inserire l'incarico è passato nella query string
      $pol_id = $this->getRequestParameter('politician_id', 0);
      $this->pol = OpPoliticianPeer::retrieveByPK($pol_id);

      // Mostra il form
      return sfView::SUCCESS;
    }
    else
    {
      // Gestisce la submit
      
      // lettura dei parametri del form
      $pol_id = $this->getRequestParameter('politician_id');
      $org_id = $this->getRequestParameter('organization_id', 0);
      $org_name = $this->getRequestParameter('organization');
      $org_tags_as_string = $this->getRequestParameter('organization_tags');
      $org_url = $this->getRequestParameter('organization_url');
      
      // aggiunta o modifica?
      if ($org_id == 0)
      {
        $org = new OpOrganization();
        $org->setName($org_name);
      } else {
        $org = OpOrganizationPeer::retrieveByPK($org_id);
      }
      
      
      if ($org_url != $org->getUrl())
        $org->setUrl($org_url);
      if ($org_tags_as_string != $org->getTagsAsString())
        $org->setTagsFromString($org_tags_as_string);
        
      $org->save();

      // salvataggio org_id e pol_id in user session
      $this->getUser()->setAttribute('organization_id', $org->getId());
      $this->getUser()->setAttribute('politician_id', $pol_id);
      
      // redirect alla seconda fase: aggiunta o modifica dell'incarico
      $this->redirect('polOrgCharges/edit');
    }
    
  }
  
  public function handleErrorOrganizationEdit()
  {
    return sfView::SUCCESS;
  }
  

  public function executeEdit()
  {
    $this->_checkEdit();
    
    if ($this->getRequest()->getMethod() != sfRequest::POST)
    {
      // generazione form
      
      $this->org = OpOrganizationPeer::retrieveByPK($this->org_id);
      $this->pol = OpPoliticianPeer::retrieveByPK($this->pol_id);

      // Mostra il form
      return sfView::SUCCESS;
      
    } else {
      // gestione submit
      
      // lettura variabili da campi del form
      $org_id = $this->getRequestParameter('organization_id');
      $pol_id = $this->getRequestParameter('politician_id');
      $charge_name = $this->getRequestParameter('charge_name');
      $current = $this->getRequestParameter('current');
      $date_start = $this->getRequestParameter('date_start[year]')."-01-01";
      $date_end = $this->getRequestParameter('date_end[year]')."-01-01";
      
      $org = OpOrganizationPeer::retrieveByPK($org_id);
      $pol = OpPoliticianPeer::retrieveByPK($pol_id);

      // rimuove organization_id e politician_id dalla session utente
      $this->getUser()->getAttributeHolder()->remove('organization_id');
      $this->getUser()->getAttributeHolder()->remove('politician_id');

      if ($this->content_id != 0) 
      {
        // edit
        $charge = OpOrganizationChargePeer::retrieveByPK($this->content_id);
      } else {
        // add
        $charge = new OpOrganizationCharge();
        $charge->setOpPolitician($pol);
        $charge->setOpOrganization($org);
      }
      
      $charge->setChargeName($charge_name);
      $charge->setCurrent($current);
      
      if ($this->getRequestParameter('date_start[year]'))
        $charge->setDateStart($date_start);
      else
        $charge->setDateStart();

      if ($this->getRequestParameter('date_end[year]'))
        $charge->setDateEnd($date_end);
      else
        $charge->setDateEnd();

        $charge->save();
        
      
      // redirect alla pagina del politico
      $this->redirect('politician/page?content_id='.$pol->getContentId());
      
      
    }
    
  }


  public function handleErrorEdit()
  {
    $this->_checkEdit();

    $this->org = OpOrganizationPeer::retrieveByPK($this->org_id);
    $this->pol = OpPoliticianPeer::retrieveByPK($this->pol_id);

    return sfView::SUCCESS;
  }


  private function _checkEdit()
  {
    $this->content_id = $this->getRequestParameter('content_id', 0);

    if ($this->content_id != 0)
    {
      // modifica un incarico esistente
      
      $this->charge = OpOrganizationChargePeer::retrieveByPK($this->content_id);

      $this->pol_id = $this->charge->getOpPolitician()->getContentId();
      $this->org_id = $this->charge->getOpOrganization()->getId();
      $this->current = $this->getRequestParameter('current', $this->charge->getCurrent());
      

      $this->date_start_year = array('year' => $this->charge->getDateStart('Y'));
      $this->date_end_year = array('year' => $this->charge->getDateEnd('Y'));
        
    } else {
      // inserisci un nuovo incarico
      
      // a new OpOrganizationCharge object is created, to be safely used in the Object Form
      // the object is not saved here
      $this->charge = new OpOrganizationCharge();

      // legge l'id dell'organizzazione e del politico dalla sessione utente
      $this->org_id = $this->getUser()->getAttribute('organization_id');
      $this->pol_id = $this->getUser()->getAttribute('politician_id');

      $this->date_start_year = array('year' => date('Y', time()));       
      $this->date_end_year = array('year' => date('Y', time()));       

      $this->current = true;
    }
    
  }

  public function executeOrganizationLookup()
  {
    $this->id = trim(strip_tags($this->getRequestParameter('organization_id', 0)));

		//controllo se il nome dell'organizzazione è gia presente
		try {
		  $org = OpOrganizationPeer::retrieveByPK($this->id);
  		if ($org instanceof OpOrganization)
  		{
  			$this->organization = $org;
  			$this->tags = $org->getTagsAsString();
  			$this->url = $org->getUrl();  		  
  		}
		} catch (Exception $e) {
		  sfContext::getInstance()->getLogger()->error("Eccezione durante executeOrganizationLookup: " . $e->getMessage());
		}
		
  }
  
  
  public function executeEditUrl()
  {
    // legge parametri inviati
    $url = strip_tags($this->getRequestParameter('value'));
    $org_id = $this->getRequestParameter('org_id');
    
    // effettua le modifiche
    $org = OpOrganizationPeer::retrieveByPK($org_id);
    $org->setUrl($url);
    $org->save();
    
    // prepara per il ritorno
    $this->value = $url;
    $this->setTemplate('editInPlace');
  }


  public function executeEditTags()
  {
    $tags_as_string = strip_tags($this->getRequestParameter('value'));
    $org_id = $this->getRequestParameter('org_id');
    
    // effettua le modifiche
    $org = OpOrganizationPeer::retrieveByPK($org_id);
    $org->setTagsFromString($tags_as_string);
    $org->Save();

    // prepara per il ritorno
    $this->value = $tags_as_string;
    $this->setTemplate('editInPlace');
    
  }
  
    
  public function executeObscuration()
  {
    $this->organization_charge_id = $this->getRequestParameter('organization_charge_id');
  }
	
		
	public function executeDelete()
	{
  	$organization_charge = OpOrganizationChargePeer::retrieveByPk($this->getRequestParameter('content_id'));
  	
  	$this->forward404Unless($organization_charge);
	
  	$this->op_politician_id = $organization_charge->getPoliticianId();
	
  	//settaggio del campo deleted at di open content
  	$open_content = OpOpenContentPeer::RetrieveByPk($this->getRequestParameter('content_id'));
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

	
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  }
}
