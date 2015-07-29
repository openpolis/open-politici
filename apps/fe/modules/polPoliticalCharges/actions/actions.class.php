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
 * polPoliticalCharges actions.
 *
 * @package    openpolis
 * @subpackage polPoliticalCharges
 * @author     Gianluca Canale
 * @version    SVN: $Id: actions.class.php 1814 2006-08-24 12:20:11Z fabien $
 */
class polPoliticalChargesActions extends sfActions
{
  /**************************************/
  protected function getPoliticalChargeOrCreate($content_id = 'content_id')
  {
    if (!$this->getRequestParameter('content_id', 0))
    {
      $political_charge = new OpPoliticalCharge();
    }
    else
    {
      $political_charge = OpPoliticalChargePeer::retrieveByPk($this->getRequestParameter($content_id));
      $this->forward404Unless($political_charge);
    }
    return $political_charge;
  }
	
  /**************************************/
  public function executeCreate()
	{
      $politician_id = $this->getRequestParameter('politician_id');
      $this->forward404Unless($politician_id);
	  
	  return $this->redirect('polPoliticalCharges/edit?politician_id='.$politician_id);
    }		
	
  /**************************************/
  public function executeEdit()
  {
    $this->political_charge = $this->getPoliticalChargeOrCreate();
	  $this->description='';
    $this->loc_type='1';
	  $this->current='1';
						
    if($this->getRequestParameter('politician_id'))
    {
      $this->politician_id = $this->getRequestParameter('politician_id');
      $this->charge='iscritto'; 
    }
    else
    {
      $this->politician_id = $this->political_charge->getOpPolitician()->getContentId();
      $this->charge = $this->political_charge->getOpChargeType()->getName();
	    $this->current = $this->political_charge->getCurrent();
  	  switch($this->political_charge->getOpLocation()->getLocationTypeId())
      {
        case '3':
          $this->loc_type='1';
          break;
        case '4':
          $this->loc_type='2';
          break;
        case '5':
          $this->loc_type='3';
          break;
        case '6':
          $this->loc_type='4';
          break;			
      }
    }
    $this->politician = OpPoliticianPeer::retrieveByPk($this->politician_id);
    	
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updatePoliticalChargeFromRequest();
      $this->savePoliticalCharge($this->political_charge);
      return $this->redirect('politician/page?content_id='.$this->political_charge->getPoliticianId());
    }
    else
    {
      
    }
  }
  
  /**************************************/
  public function handleErrorEdit()
  {
    if($this->getRequestParameter('content_id'))
	{	
      $this->political_charge = OpPoliticalChargePeer::retrieveByPk($this->getRequestParameter('content_id'));
	}
	else
	{
	  $this->political_charge = new OpPoliticalCharge();
	}
	
	$this->loc_type = $this->getRequestParameter('location_type');
	$this->charge = $this->getRequestParameter('status')=='1' ? 'iscritto' : 'carica';
	$this->current = $this->getRequestParameter('current');    
		
	$this->politician_id = $this->getRequestParameter('politician_id');			
	$this->politician = OpPoliticianPeer::retrieveByPk($this->politician_id);

    return sfView::SUCCESS;
  }
    
  /**************************************/
  protected function savePoliticalCharge($political_charge)
  {
    $political_charge->save();
  }	

  /**************************************/
  protected function updatePoliticalChargeFromRequest()
  {
    $political_charge = $this->getRequestParameter('political_charge');
  
    if ($this->getRequestParameter('politician_id'))
    {
      $this->political_charge->setPoliticianId($this->getRequestParameter('politician_id'));
    }
	
  	switch($this->getRequestParameter('location_type'))
  	{
  	  //carica nazionale
      case '1': 
        $location_id = 2;
        break;
      
  	  //carica regionale	
      case '2':
        $location_id = $this->getRequestParameter('region_id');
        break;
      
  	  //carica provinciale	
      case '3':
        $location_id = $this->getRequestParameter('provincial_id');
        break;
      
  	  //carica comunale	
      case '4':
        $location_id = $this->getRequestParameter('loc_id');
        break;
      
  	  default:
        $location_id = 2;				
    }
  	$this->political_charge->setLocationId($location_id);
	
  	if($this->getRequestParameter('status')=='1')
    {
      $this->political_charge->setChargeTypeId(sfConfig::get('app_charge_type_id_iscritto'));
    }
    else
    {
      $this->political_charge->setChargeTypeId(sfConfig::get('app_charge_type_id_carica'));
    }	
    $this->political_charge->setDescription($this->getRequestParameter('description'));
    $this->political_charge->setPartyId($this->getRequestParameter('party_id', 1));
	
  	$this->political_charge->setCurrent($this->getRequestParameter('current'));
	
  	if ($this->getRequestParameter('date_start[year]'))
    {
      $this->political_charge->setDateStart($this->getRequestParameter('date_start[year]')."-01-01");
    }
  	else
  	{
  	  $this->political_charge->setDateStart();
  	}
		
    if ($this->getRequestParameter('date_end[year]'))
    {
      $this->political_charge->setDateEnd($this->getRequestParameter('date_end[year]')."-01-01");
    }
  	else
  	{
  	  $this->political_charge->setDateEnd();
  	}	
	
  }	
  
  public function executeObscuration()
  {
    $this->political_charge_id = $this->getRequestParameter('political_charge_id');
  }
  
  /**************************************/
  public function executeDelete()
  {
    $this->hasLayout = $this->getRequestParameter('has_layout');
    $political_charge = OpPoliticalChargePeer::retrieveByPk($this->getRequestParameter('content_id'));
    $this->forward404Unless($political_charge);
	
	  $this->op_politician_id = $political_charge->getPoliticianId();

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
    
    //invio email di notifica
  	$raw_email = $this->sendEmail('mail', 'sendObscurationNotification');  

    //invio messaggistica
    //TODO

    return $this->redirect('@politico_new?slug='. $political_charge->getOpPolitician()->getSlug() .'&content_id='.$this->op_politician_id);
  }
  
  
  public function executeTab()
  {
    $this->op_politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));
	
	$this->ist_count = $this->getRequestParameter('ist_count');
	$this->pol_count = $this->getRequestParameter('pol_count');
	$this->org_count = $this->getRequestParameter('org_count');
	
	//seleziono le cariche politiche attuali pubblicate
	$c3=new Criteria();
	$c3->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
	$c3->add(OpPoliticalChargePeer::CURRENT, 1, Criteria::EQUAL);
	$c3->addDescendingOrderByColumn(OpPoliticalChargePeer::DATE_START);
	$this->political_charges = $this->op_politician->getOpPoliticalChargesJoinOpOpenContent($c3);
		
    //seleziono le cariche politiche passate pubblicate
    $c3bis=new Criteria();
    $c3bis->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c3bis->add(OpPoliticalChargePeer::CURRENT, 0, Criteria::EQUAL);
    $c3bis->addDescendingOrderByColumn(OpPoliticalChargePeer::DATE_START);
    $this->past_political_charges = $this->op_politician->getOpPoliticalChargesJoinOpOpenContent($c3bis);
  }	
  
  /**
   * assegna un candidato a una lista, per le politiche 2008
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeAssignVsq2008Candidation()
  {
  	$this->politician_id = $this->getRequestParameter('politician_id');
  	$party_id = $this->getRequestParameter('party_id');
  	if ($party_id != 'x')
  	{
    	$this->party = OpPartyPeer::retrieveByPK($party_id);

    	// associa il candidato, creando un incarico politico di tipo "candidatoPol2008"
    	
    	// verifica l'esistenza di un incarico o ne crea uno nuovo
    	$charge = OpPoliticalChargePeer::retrieveVsqCandidation($this->politician_id);
    	if (!$charge instanceof OpPoliticalCharge)
        $charge = new OpPoliticalCharge();
        
      $charge->setPoliticianId($this->politician_id);

      // l'incarico e' nazionale
      $location = OpLocationPeer::retrieveByNameType('Italia', 'Italia');
    	$charge->setOpLocation($location);
      
      // incarico CandidatoPolitiche2008
      $charge_type = OpChargeTypePeer::retrieveByShortName('CandidatoPolitiche2008');
      $charge->setOpChargeType($charge_type);
      
      // partito
      $charge->setOpParty($this->party);

      // altri valori
    	$charge->setCurrent(0);
  	  
  	  // salvataggio
  	  $charge->save();


  	} else {

  	  // rimuove la candidatura (se esistente)
    	$charge = OpPoliticalChargePeer::retrieveVsqCandidation($this->politician_id);
    	if ($charge instanceof OpPoliticalCharge)
    	{
    	  $charge->getOpOpenContent()->getOpContent()->delete();
    	}
  	  
  	  $this->party = null;
  	  
  	}
    
  }
 
	
}

?>