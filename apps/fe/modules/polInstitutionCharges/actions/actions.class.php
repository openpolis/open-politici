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
 * polInstitutionCharges actions.
 *
 * @package    openpolis
 * @subpackage polInstitutionCharges
 * @author     Gianluca Canale
 * @version    SVN: $Id: actions.class.php 343 2007-12-08 20:52:44Z guglielmo $
 */
class polInstitutionChargesActions extends sfActions
{
  /**************************************/
  protected function getInstitutionChargeOrCreate($content_id = 'content_id')
  {
    if (!$this->getRequestParameter('content_id', 0))
    {
      $institution_charge = new OpInstitutionCharge();
    }
    else
    {
      $institution_charge = OpInstitutionChargePeer::retrieveByPk($this->getRequestParameter($content_id));
      $this->forward404Unless($institution_charge);
    }
    return $institution_charge;
}
	
  /**************************************/
  public function executeCreate()
	{
    $politician_id = $this->getRequestParameter('politician_id');
    $this->forward404Unless($politician_id);
	  $this->from_error = false;
	  
    return $this->redirect('polInstitutionCharges/edit?politician_id='.$politician_id);
  }
	
  /**************************************/
  public function executeEdit()
  {
    $this->institution_charge = $this->getInstitutionChargeOrCreate();
	  $this->from_error = false;
	  $this->this_year = date('Y');
				
    if($this->getRequestParameter('politician_id'))
    {
      $this->politician_id = $this->getRequestParameter('politician_id');
      $this->loc_type=0;
    }
    else
    {
      $this->politician_id = $this->institution_charge->getOpPolitician()->getContentId();
      $this->loc_type=$this->institution_charge->getOpLocation()->getLocationTypeId();
    }
    $this->politician = OpPoliticianPeer::retrieveByPk($this->politician_id);

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateInstitutionChargeFromRequest();
      $this->saveInstitutionCharge($this->institution_charge);
      return $this->redirect('@politico_new?content_id='.$this->institution_charge->getPoliticianId() .'&slug='. $this->politician->getSlug());
    }
    else
    {
      $c = new Criteria();
      $c->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID, Criteria::LEFT_JOIN);
      $c->Add(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, $this->institution_charge->getInstitutionId(), Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpChargeTypePeer::PRIORITY);
      $this->charge_list = OpChargeTypePeer::doSelect($c);
    }
  }
  
  /**************************************/
	public function handleErrorEdit()
  	{
  	  $this->from_error = true;
  	  $this->this_year = date('Y');
  	  
	    $this->location_id = $this->getRequestParameter('location_id');
	  	
  	  if($this->getRequestParameter('content_id'))
	    {
    		$this->institution_charge = OpInstitutionChargePeer::retrieveByPk($this->getRequestParameter('content_id'));
  		  $this->loc_type=$this->institution_charge->getOpLocation()->getLocationTypeId();
	    }
  	  else
  	  {
  	    $this->institution_charge = new OpInstitutionCharge();
	    
  	    switch($this->getRequestParameter('institution_id'))
  	    {
  		  case sfConfig::get('app_institution_id_CE'):
  		  case sfConfig::get('app_institution_id_PE'):
  			  $this->loc_type = sfConfig::get('app_location_type_id_european');
  			  break;
		  
  		  case sfConfig::get('app_institution_id_PR'):
  		  case sfConfig::get('app_institution_id_GI'):
  		  case sfConfig::get('app_institution_id_SR'):
  		  case sfConfig::get('app_institution_id_CD'):
  			  $this->loc_type = sfConfig::get('app_location_type_id_national');
  			  break;
  		  case sfConfig::get('app_institution_id_GR'):
  		  case sfConfig::get('app_institution_id_CR'):
  			  $this->loc_type = sfConfig::get('app_location_type_id_region');
  			  break;
  		  case sfConfig::get('app_institution_id_GP'):
  		  case sfConfig::get('app_institution_id_CP'):
                  case sfConfig::get('app_institution_id_AS'):
  			  $this->loc_type = sfConfig::get('app_location_type_id_provincial');
  			  break;
  		  case sfConfig::get('app_institution_id_GC'):
  		  case sfConfig::get('app_institution_id_CC'):
  			  $this->loc_type = sfConfig::get('app_location_type_id_municipal');
  			  break;	  	  	  	  
  	    }
  	  }		
		
  	  $this->institution_charge->setInstitutionId($this->getRequestParameter('institution_id'));
  	  $this->institution_charge->setChargeTypeId($this->getRequestParameter('charge_type_id'));
  	  $this->institution_charge->setLocationId($this->location_id);
		
	    $c = new Criteria();
      $c->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID, Criteria::LEFT_JOIN);
      $c->Add(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, $this->institution_charge->getInstitutionId(), Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpChargeTypePeer::PRIORITY);
      $this->charge_list = OpChargeTypePeer::doSelect($c);
	
  	  $this->politician_id = $this->getRequestParameter('politician_id');			
  	  $this->politician = OpPoliticianPeer::retrieveByPk($this->politician_id);
  		
  	  return sfView::SUCCESS;
  	}	
	
  /**************************************/
  protected function updateInstitutionChargeFromRequest()
  {
    $institution_charge = $this->getRequestParameter('institution_charge');

    if ($this->getRequestParameter('politician_id'))
    {
      $this->institution_charge->setPoliticianId($this->getRequestParameter('politician_id'));
    }

    $this->institution_charge->setInstitutionId($this->getRequestParameter('institution_id'));

    switch($this->getRequestParameter('institution_id'))
    {
      case sfConfig::get('app_institution_id_CE'):
      case sfConfig::get('app_institution_id_PE'):
        $location_id = sfConfig::get('app_location_id_europe');
        break;
      case sfConfig::get('app_institution_id_GI'):
      case sfConfig::get('app_institution_id_CD'):
      case sfConfig::get('app_institution_id_SR'):
      case sfConfig::get('app_institution_id_PR'):	  
        $location_id = sfConfig::get('app_location_id_italy');
        break;
      case sfConfig::get('app_institution_id_GR'):
      case sfConfig::get('app_institution_id_CR'):
        $location_id = $this->getRequestParameter('region_id');
        break;
      case sfConfig::get('app_institution_id_GP'):
      case sfConfig::get('app_institution_id_CP'):
      case sfConfig::get('app_institution_id_AS'):
        $location_id = $this->getRequestParameter('provincial_id');
        break;
      case sfConfig::get('app_institution_id_GC'):
      case sfConfig::get('app_institution_id_CC'):
        $location_id = $this->getRequestParameter('loc_id');
        break;
    }

    $this->institution_charge->setLocationId($location_id);
    $this->institution_charge->setChargeTypeId($this->getRequestParameter('charge_type_id'));
		
    $party_id = $this->getRequestParameter('party_id', '1');
    if($party_id == 0)
      $party_id=1;	
    $this->institution_charge->setPartyId($party_id);

    $group_id = $this->getRequestParameter('group_id', '1');
    if($group_id == 0)
      $group_id=1;	
    $this->institution_charge->setGroupId($group_id);

    if (isset($institution_charge['description']))
    {
      $this->institution_charge->setDescription($institution_charge['description']);
    }

    if ($this->getRequestParameter('date_start[day]'))
    {
      $date_start_day = $this->getRequestParameter('date_start[day]');
    }
    else
    {
      $date_start_day = '01';
    }

    if ($this->getRequestParameter('date_start[month]'))
    {
      $date_start_month = $this->getRequestParameter('date_start[month]');
    }
    else
    {
      $date_start_month = '01';
    }

    $date_start_year = $this->getRequestParameter('date_start[year]');

    $this->institution_charge->setDateStart($date_start_year.'-'.$date_start_month.'-'.$date_start_day);

    if ($this->getRequestParameter('date_end[year]'))
    {
      if ($this->getRequestParameter('date_end[day]'))
      {
        $date_end_day = $this->getRequestParameter('date_end[day]');
      }
      else
      {
        $date_end_day = '01';
      }

      if ($this->getRequestParameter('date_end[month]'))
      {
        $date_end_month = $this->getRequestParameter('date_end[month]');
      }
      else
      {
        $date_end_month = '01';
      }

      $date_end_year = $this->getRequestParameter('date_end[year]');
           
	  $this->institution_charge->setDateEnd($date_end_year.'-'.$date_end_month.'-'.$date_end_day);
    }
    else
    {
      $this->institution_charge->setDateEnd(NULL);
    }	

  }

  /**************************************/
  protected function saveInstitutionCharge($institution_charge)
  {
    $institution_charge->save();
  }	

  /**************************************/
  public function executeObscuration()
  {
    $this->institution_charge_id = $this->getRequestParameter('institution_charge_id');
  
  }
  	
  /**************************************/
  public function executeDelete()
  {
    $this->hasLayout = $this->getRequestParameter('has_layout');
    $institution_charge = OpInstitutionChargePeer::retrieveByPk($this->getRequestParameter('content_id'));
    $this->forward404Unless($institution_charge);
    
$politician = $institution_charge->getOpPolitician();
  	$this->op_politician_id = $institution_charge->getPoliticianId();
	
  	$this->ist_count = $this->getRequestParameter('ist_count');
  	$this->pol_count = $this->getRequestParameter('pol_count');
  	$this->org_count = $this->getRequestParameter('org_count');
	
    //settaggio del campo deleted at e verified_at di open content
    $open_content=OpOpenContentPeer::RetrieveByPk($this->getRequestParameter('content_id'));
    $open_content->setDeletedAt(time());
    $open_content->setVerifiedAt(time());
    $open_content->addVerificationRecord(sfContext::getInstance()->getUser()->getSubscriberId(), 'oscurato');
    $open_content->save();

    //inserimento nella tabella obscured content
    $obscured_content = new OpObscuredContent();
    $obscured_content->setUserId($this->getRequestParameter('user_id'));
    $obscured_content->setContentId($this->getRequestParameter('content_id'));
    $obscured_content->setReason($this->getRequestParameter('reason'));
    $obscured_content->save();

    // aggiornamento degli indici del politico associato
    $iMan = new OpIndexManager();
    $iMan->updateDocument($politician);
    $iMan->commit();
    unset($iMan);
		
    // eventuale aggiornamento del campo op_user.last_contribution e op_user.charges
    $user = OpUserPeer::retrieveByPK($this->getRequestParameter('user_id'));
    $user->updateLastContribution();
    $user->setCharges($user->countCharges());
    $user->save();
    unset($user);

    // invio email di notifica TODO: correggere errore
  	// $raw_email = $this->sendEmail('mail', 'sendObscurationNotification');

    return $this->redirect('@politico_new?slug='.$politician->getSlug().'&content_id='.$this->politician->getContentId());
  }

  /**************************************/
  public function executeChargesForInstitution()
  {
    $c = new Criteria();
    $c->Add(OpChargeTypePeer::INSTITUTION_ID, $this->getRequestParameter('id'));
    $this->charges = OpChargeTypePeer::doSelect($c); 
  }

  /**************************************/
  public function executeLocationsForInstitution()
  {
    switch($this->getRequestParameter('id'))
    {
      case '1':
        $this->location_type_id = 2;
        break;
      case '2':
      case '3':
        $this->location_type_id = 3;
        break;
      case '4':
      case '5':
        $this->location_type_id = 4;
        break;
      case '6':
      case '7':
      case '8':
        $this->location_type_id = 5;
        break;
      case '9':
      case '10':
      case '11':
        $this->location_type_id = 6;
        break;
    }

    $c = new Criteria();
    $c->Add(OpLocationPeer::LOCATION_TYPE_ID, $this->location_type_id);
    $c->Add(OpLocationPeer::NAME, '', Criteria::NOT_EQUAL);
    $c->addAscendingOrderByColumn(OpLocationPeer::NAME);
    $this->locations = OpLocationPeer::doSelect($c); 
  }

  /**************************************/
  public function executeCharges()
  {
    $this->location_id = $this->getRequestParameter('location_id');
    $institution_id = $this->getRequestParameter('institution_id');

    $this->institution_charge_id = $this->getRequestParameter('institution_charge_id');

    $institution_charge = OpInstitutionChargePeer::RetrieveByPk($this->institution_charge_id);
    if($institution_charge)
    {
      $this->charge_type_id = $institution_charge->getChargeTypeId();
    }
    else
    {
      $this->charge_type_id = 0;
    }

    $c = new Criteria();
    $c->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID, Criteria::LEFT_JOIN);
    $c->Add(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, $institution_id, Criteria::EQUAL);
    $c->addAscendingOrderByColumn(OpChargeTypePeer::PRIORITY);
    $this->charge_list = OpChargeTypePeer::doSelect($c);
  }

  /**************************************/
  public function executeParties()
  {
    $this->location_id = $this->getRequestParameter('location_id');
    $this->institution_charge_id = $this->getRequestParameter('institution_charge_id');
    
  }

  /**************************************/
  public function executeGroups()
  {
    $this->location_id = $this->getRequestParameter('location_id');
	$this->institution_id = $this->getRequestParameter('institution_id');
    $this->institution_charge_id = $this->getRequestParameter('institution_charge_id');
    
  }
  
  public function executeTab()
  {
    $this->op_politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));
	
	$this->ist_count = $this->getRequestParameter('ist_count');
	$this->pol_count = $this->getRequestParameter('pol_count');
	$this->org_count = $this->getRequestParameter('org_count');
	
    //seleziono le cariche istituzionali attuali pubblicate
    $c2=new Criteria();
    $c2->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c2->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c2->addDescendingOrderByColumn(OpInstitutionChargePeer::DATE_START);
    $this->institution_charges = $this->op_politician->getOpInstitutionChargesJoinOpOpenContent($c2);

    //seleziono le cariche istituzionali passate pubblicate
    $c2bis=new Criteria();
    $c2bis->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c2bis->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::NOT_EQUAL);
    $c2bis->addDescendingOrderByColumn(OpInstitutionChargePeer::DATE_END);
    $this->past_institution_charges = $this->op_politician->getOpInstitutionChargesJoinOpOpenContent($c2bis);

  }
  
  public function executeMultipleChargeTitle()
  {
    $this->ordina = $this->getRequestParameter('ordina');
  }	
  
  public function executeEntiCommissariati()
  {
    
  }
  
  
  public function executePensioni()
  {
    $arr=array();
    $gruppi_c=array();
    $gruppi_s=array();
     function count_days( $a, $b )
     {
         // First we need to break these dates into their constituent parts:
         $gd_a = getdate( $a );
         $gd_b = getdate( $b );

         // Now recreate these timestamps, based upon noon on each day
         // The specific time doesn't matter but it must be the same each day
         $a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
         $b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );

         // Subtract these two numbers and divide by the number of seconds in a
         //  day. Round the result since crossing over a daylight savings time
         //  barrier will cause this time to be off by an hour or two.
         return round( abs( $a_new - $b_new ) / 86400 );
     }
    $c=new Criteria();
    $c->add(OpInstitutionChargePeer::INSTITUTION_ID,4);
    $c->add(OpInstitutionChargePeer::CHARGE_TYPE_ID,5);
    $c->add(OpInstitutionChargePeer::DATE_END,NULL,Criteria::ISNULL);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $parls=OpInstitutionChargePeer::doSelect($c);
    
    foreach ($parls as $parl)
    {
      $giorni=count_days(strtotime(date('Y-m-d')),strtotime($parl->getDateStart()));
      $c= new Criteria();
      $crit0 = $c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, 4);
      $crit1 = $c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, 5);

      $crit0->addAnd($crit1);
      $crit2 = $c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, 5);
      $crit3 = $c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, 6);

      $crit2->addAnd($crit3);

      $crit0->addOr($crit2);

      $c->add($crit0);
      
      $c->add(OpInstitutionChargePeer::DATE_END,NULL,Criteria::ISNOTNULL);
      $c->add(OpInstitutionChargePeer::POLITICIAN_ID,$parl->getPoliticianId());
      $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
      $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
      $lasts=OpInstitutionChargePeer::doSelect($c);
      foreach ($lasts as $last)
      {
        $giorni=$giorni+count_days(strtotime($last->getDateEnd()),strtotime($last->getDateStart()));
      }
      if ($giorni<365*4+(365/2)+1)
      {
        if (array_key_exists($parl->getGroupId(),$gruppi_c))
        {
          $gruppi_c[$parl->getGroupId()]=$gruppi_c[$parl->getGroupId()]+1;
        }
        else
        {
          $gruppi_c[$parl->getGroupId()]=1;
        }
        $arr_c[$parl->getContentId()]=intval(365*4+(365/2)+1-$giorni);
      } 
    }
    
    $c=new Criteria();
    $c->add(OpInstitutionChargePeer::INSTITUTION_ID,5);
    $c->add(OpInstitutionChargePeer::CHARGE_TYPE_ID,6);
    $c->add(OpInstitutionChargePeer::DATE_END,NULL,Criteria::ISNULL);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $parls=OpInstitutionChargePeer::doSelect($c);
    
    foreach ($parls as $parl)
    {
      
      $giorni=count_days(strtotime(date('Y-m-d')),strtotime($parl->getDateStart()));
      $c= new Criteria();
      $crit0 = $c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, 4);
      $crit1 = $c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, 5);

      $crit0->addAnd($crit1);
      $crit2 = $c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, 5);
      $crit3 = $c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, 6);

      $crit2->addAnd($crit3);

      $crit0->addOr($crit2);

      $c->add($crit0);
      
      $c->add(OpInstitutionChargePeer::DATE_END,NULL,Criteria::ISNOTNULL);
      $c->add(OpInstitutionChargePeer::POLITICIAN_ID,$parl->getPoliticianId());
      $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
      $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
      $lasts=OpInstitutionChargePeer::doSelect($c);
      foreach ($lasts as $last)
      {
        $giorni=$giorni+count_days(strtotime($last->getDateEnd()),strtotime($last->getDateStart()));
      }
      if ($giorni<365*4+(365/2)+1)
      {
        if (array_key_exists($parl->getGroupId(),$gruppi_s))
        {
          $gruppi_s[$parl->getGroupId()]=$gruppi_s[$parl->getGroupId()]+1;
        }
        else
        {
          $gruppi_s[$parl->getGroupId()]=1;
        }
        $arr_s[$parl->getContentId()]=intval(365*4+(365/2)+1-$giorni);
      } 
    }
    
   $this->pensioni_c=$arr_c; 
   $this->pensioni_s=$arr_s;
   $this->gruppi_c=$gruppi_c;
   $this->gruppi_s=$gruppi_s; 
   
   $this->nolayout = false;
   if ($this->getRequestParameter('nolayout') == 'true') {
    $this->nolayout = true;
    $this->setLayout(false);
   }
  }
  
  public function executeClassificaGiorniInCarica()
  {
    
    function getAnniGiorni($giorni)
    {
      if ($giorni/365>=2)
        $durata=intval($giorni/365).' anni e ';
      elseif ($giorni/365>=1)  
        $durata='un anno e ';
      else
        $durata="";

      if (($giorni%365)>0)
        $durata=($durata.$giorni%365)." giorni";
      return $durata;  
    }
    
    $xml= simplexml_load_file("http://www.openpolis.it/api/parlamentareHowDays?id=0");
    $classifica=array();
    $stat=array(0,0,0,0,0);
    if ($xml)
    {
      foreach ($xml->xpath("//politician") as $p)
      {   
        $polid= trim($p->opid[0]);
        $giorni = trim($p->days[0]);
        $durata=getAnniGiorni($giorni);
        $classifica[$polid]=array($durata,$p->contentid[0]); 
        
        if ($giorni<1825)
          $stat[0]=$stat[0]+1;
        elseif ($giorni>=1825 && $giorni<3650)  
          $stat[1]=$stat[1]+1;
        elseif ($giorni>=3650 && $giorni<5475)  
          $stat[2]=$stat[2]+1;
        elseif ($giorni>=5475 && $giorni<7300)  
          $stat[3]=$stat[3]+1;
        elseif ($giorni>=7300)  
          $stat[4]=$stat[4]+1;      
        
      }   
    } 
    $this->classifica=$classifica;
    $this->stat=$stat;

      
  }


}

?>
