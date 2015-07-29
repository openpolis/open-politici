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
 * administrator actions.
 *
 * @package    askeet
 * @subpackage administrator
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 83 2006-03-15 13:24:55Z fabien $
 */
class administratorActions extends sfActions
{
  public function preExecute()
  {
    $this->getResponse()->addStylesheet('administrator.css');  
  }
  
  public function executeIndex()
  {
    $this->setLayout('noColumnLayout');
  }


  public function handleErrorIndex()
  {
    $this->message = "Access denied";
    $this->forward404();
  }

  public function executeAdoptions()
  {
    $this->response->setTitle('amministrazione | adozioni | openpolis');
    $this->type = $this->getRequestParameter('type', 'requested');
    $this->page = $this->getRequestParameter('page', 1);
  }

  public function executeAdoptionsList()
  {

    $this->type = $this->getRequestParameter('type', 'requested');
    $this->page = $this->getRequestParameter('page', 1);
    
  }

  public function executeAdoptionAccept()
  {
    $adopter_id = $this->getRequestParameter('adopter_id');
    if ($this->getRequestParameter('type') == 'pol')
    {
      $adoptee_id = $this->getRequestParameter('adoptee_id');
      $adoption = OpPolAdoptionPeer::retrieveByPK($adopter_id, $adoptee_id);
    } else {
      $adoptee_id = $this->getRequestParameter('adoptee_id');
      $adoption = OpLocAdoptionPeer::retrieveByPK($adopter_id, $adoptee_id);
    }
    
    $adoption->setGrantedAt(time());
    $adoption->save();

	  // invia la notifica
	  $raw_email = $this->sendEmail('mail', "sendAdoptionAccept");
    #$this->logMessage($raw_email, 'debug');     
    
    $this->redirect('@lista_adozioni');
  }


  public function executeAdoptionRefuseReason()
  {
    // memorizza i parametri ricevuti
    $this->adopter_id = $this->getRequestParameter('adopter_id');
    $this->type = $this->getRequestParameter('type');
    if ($this->type == 'pol')
    {
      $this->adoptee_id = $this->getRequestParameter('adoptee_id');
    } else {
      $this->adoptee_id = $this->getRequestParameter('adoptee_id');
    }
    $this->referer = $this->getRequest()->getReferer();
  }

  public function executeAdoptionRefuse()
  {
    $adopter_id = $this->getRequestParameter('adopter_id');
    if ($this->getRequestParameter('type') == 'pol')
    {
      $adoptee_id = $this->getRequestParameter('adoptee_id');
      $adoption = OpPolAdoptionPeer::retrieveByPK($adopter_id, $adoptee_id);
    } else {
      $adoptee_id = $this->getRequestParameter('adoptee_id');
      $adoption = OpLocAdoptionPeer::retrieveByPK($adopter_id, $adoptee_id);
    }
    
    $adoption->setRefusedAt(time());
    $adoption->save();

	  // invia la notifica
	  $raw_email = $this->sendEmail('mail', "sendAdoptionRefuse");
    #$this->logMessage($raw_email, 'debug');     
    
    $this->redirect('@lista_adozioni');
  }

  
  public function executeAdoptionBlock()
  {
    $user_id = $this->getRequestParameter('adopter_id');
    if ($this->getRequestParameter('type') == 'pol')
    {
      $pol_id = $this->getRequestParameter('adoptee_id');
      $adoption = OpPolAdoptionPeer::retrieveByPK($user_id, $pol_id);
    } else {
      $loc_id = $this->getRequestParameter('adoptee_id');
      $adoption = OpLocAdoptionPeer::retrieveByPK($user_id, $loc_id);
    }
    
    $adoption->setRevokedAt(time());
    $adoption->save();
    
    $this->redirect('@lista_adozioni');
  }

  public function executeAdoptionUnblock()
  {
    $user_id = $this->getRequestParameter('adopter_id');
    if ($this->getRequestParameter('type') == 'pol')
    {
      $pol_id = $this->getRequestParameter('adoptee_id');
      $adoption = OpPolAdoptionPeer::retrieveByPK($user_id, $pol_id);
    } else {
      $loc_id = $this->getRequestParameter('adoptee_id');
      $adoption = OpLocAdoptionPeer::retrieveByPK($user_id, $loc_id);
    }
    
    $adoption->setRevokedAt(null);
    $adoption->save();
    
    $this->redirect('@lista_adozioni');
  }
  

  public function executeProblematicUsers()
  {
    $this->title = 'Utenti problematici';
    $this->urlalias = 'problematic_users';
    $this->getResponse()->setTitle($this->title);
  }

  public function executeModerators()
  {
    $this->title = 'Moderatori';
    $this->urlalias = 'moderators';
    $this->getResponse()->setTitle($this->title);
  }

  public function executeAdministrators()
  {
    $this->title = 'Amministratori';
    $this->urlalias = 'administrators';
    $this->getResponse()->setTitle($this->title);
  }

  public function executeModeratorCandidates()
  {
    $this->title = 'Candidati moderatori';
    $this->urlalias = 'moderator_candidates';
    $this->getResponse()->setTitle($this->title);
  }

  public function executePromoteModerator()
  {
    $this->toggleModerator(true);
  }

  public function executeRemoveModerator()
  {
    $this->toggleModerator(false);
  }

  public function executePromoteAdministrator()
  {
    $this->toggleAdministrator(true);
  }

  public function executeRemoveAdministrator()
  {
    $this->toggleAdministrator(false);
  }
  
  public function executeDeleteUser()
  {
    $user = OpUserPeer::getUserFromNickname($this->getRequestParameter('nickname'));
    $this->forward404Unless($user);

    $user->setCreatedAt(null);
  	$user->setWantToBeModerator(false);
  	$user->setIsModerator(false);
    $user->save();
	
	  $this->redirect($this->getRequest()->getReferer());
  }

  private function toggleModerator($moderator)
  {
    $user = OpUserPeer::getUserFromNickname($this->getRequestParameter('nickname'));
    $this->forward404Unless($user);

    $user->setIsModerator($moderator);
    $user->setWantToBeModerator(false);

    $user->save();

    $this->redirect($this->getRequest()->getReferer());
  }

  private function toggleAdministrator($administrator)
  {
    $user = OpUserPeer::getUserFromNickname($this->getRequestParameter('nickname'));
    $this->forward404Unless($user);

    $user->setIsAdministrator($administrator);

    $user->save();

    $this->redirect($this->getRequest()->getReferer());
  }
  
  //###### elenco cariche istituzioni locali ########
  public function executeLocationManaging()
  {
    // controllo nel caso in cui viene inserita località non in elenco
    if($this->getRequestParameter('location_type')=='municipal' && !$this->getRequestParameter('location_id'))
      return $this->redirect('administrator/locationManaging');

    $this->setLayout('noColumnLayout');
	//calendar library
    $this->getResponse()->addJavascript('/sf/calendar/calendar.js');
    $this->getResponse()->addJavascript('/sf/calendar/lang/calendar-it.js');
    $this->getResponse()->addJavascript('/sf/calendar/calendar-setup.js');
    $this->getResponse()->addStylesheet('/sf/calendar/skins/aqua/theme.css');

    $region_id=$this->getRequestParameter('region_id', 0);
    $provincial_id=$this->getRequestParameter('provincial_id', 0);
    $this->location_id=$this->getRequestParameter('location_id', 0);
    $this->location_type=$this->getRequestParameter('location_type');

    $c1 = new Criteria(); //criterio per query giunta
    $c2 = new Criteria(); //criterio per query consiglio

    if ($this->getRequestParameter('location_type'))
    {
      switch($this->location_type)
      {
        case 'region':
          $this->location_id = $region_id; 
          $this->id1 = sfConfig::get('app_institution_id_GR');
          $this->id2 = sfConfig::get('app_institution_id_CR');
          $c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, $this->id1);
          $c2->Add(OpInstitutionChargePeer::INSTITUTION_ID, $this->id2);
          /*$election_type_id = 4;*/
          break;

        case 'provincial':
          $this->location_id = $provincial_id; 
          $this->id1 = sfConfig::get('app_institution_id_GP');
          $this->id2 = sfConfig::get('app_institution_id_CP');
          $c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, $this->id1);
          $c2->Add(OpInstitutionChargePeer::INSTITUTION_ID, $this->id2);
          /*$election_type_id = 5;*/
          break;

        case 'municipal':
          $this->id1 = sfConfig::get('app_institution_id_GC');
          $this->id2 = sfConfig::get('app_institution_id_CC');
          $c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, $this->id1);
          $c2->Add(OpInstitutionChargePeer::INSTITUTION_ID, $this->id2);
          /*$election_type_id = 6;*/
          break;
      }

      $inst1 = OpInstitutionPeer::RetrieveByPk($this->id1);
      $inst2 = OpInstitutionPeer::RetrieveByPk($this->id2);

      $this->title1 = $inst1->getName();
      $this->title2 = $inst2->getName(); 

      $c1->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
      $c1->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
      $c1->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
      $c1->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
      $c1->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
      $this->politicians = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c1);

      $c2->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
      $c2->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
      $c2->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
      $c2->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
      $c2->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
      $this->politicians2 = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c2); 

      $this->location = OpLocationPeer::retrieveByPk($this->location_id);

      $c = new Criteria();
      $c->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID, Criteria::LEFT_JOIN);
      $c->Add(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, $this->id1, Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpChargeTypePeer::PRIORITY);
      $c->addAscendingOrderByColumn(OpChargeTypePeer::NAME);
      $this->charge_list1 = OpChargeTypePeer::doSelect($c);

      $c = new Criteria();
      $c->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID, Criteria::LEFT_JOIN);
      $c->Add(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, $this->id2, Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpChargeTypePeer::PRIORITY);
      $c->addAscendingOrderByColumn(OpChargeTypePeer::NAME);
      $this->charge_list2 = OpChargeTypePeer::doSelect($c);

      $c = new Criteria();
      $c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_main'), Criteria::EQUAL);
      $c->Add(OpPartyPeer::OID, NULL, Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
      $this->primary_party_list = OpPartyPeer::doSelect($c);

      $primary_party_array[]="";
      $primary_party_array[]="1";
      foreach ($this->primary_party_list as $primary_party)
        $primary_party_array[]=$primary_party->getId();

      $c = new Criteria();
      $c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_secondary'), Criteria::EQUAL);
      $c->Add(OpPartyPeer::OID, NULL, Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
      $this->secondary_party_list = OpPartyPeer::doSelect($c);

      $c = new Criteria();
      $c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_death'), Criteria::EQUAL);
      $c->Add(OpPartyPeer::OID, NULL, Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
      $this->death_party_list = OpPartyPeer::doSelect($c);

      $c = new Criteria();
      $c->addJoin(OpPartyPeer::ID, OpPartyLocationPeer::PARTY_ID, Criteria::LEFT_JOIN);
      $c->Add(OpPartyLocationPeer::LOCATION_ID, $this->location_id, Criteria::EQUAL);
      $c->Add(OpPartyPeer::ID, $primary_party_array, Criteria::NOT_IN);
      $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
      $this->regional_party_list = OpPartyPeer::doSelect($c);

      $c = new Criteria();
      $c->Add(OpGroupPeer::OID, NULL, Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpGroupPeer::NAME);
      $this->primary_group_list = OpGroupPeer::doSelect($c);

      $primary_group_array[]="";
      $primary_group_array[]="1";
      foreach ($this->primary_group_list as $primary_group)
        $primary_group_array[]=$primary_group->getId();

      $c = new Criteria();
      $c->addJoin(OpGroupPeer::ID, OpGroupLocationPeer::GROUP_ID, Criteria::LEFT_JOIN);
      $c->Add(OpGroupLocationPeer::LOCATION_ID, $this->location_id, Criteria::EQUAL);
      $c->Add(OpGroupPeer::ID, $primary_group_array, Criteria::NOT_IN);
      $c->Add(OpGroupPeer::OID, NULL, Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpGroupPeer::NAME);
      $this->regional_group_list = OpGroupPeer::doSelect($c);

      $this->cont = 0;
    }
  }

  //##### aggiornamento cariche locali##########
  public function executeUpdateManaging()
  {
    $location_id=$this->getRequestParameter('location_id', 0);
    $location_type=$this->getRequestParameter('location_type');

    if($this->getRequestParameter('location_type'))
    {
      switch($location_type)
      {
        case 'region':
          $param = 'region_id';
          break;
        case 'provincial':
          $param = 'provincial_id';
          break;
        case 'municipal':
          $param = 'location_id';
          break;
        default:
          $param = '';
          break;		
      }
    }	

    $cont = $this->getRequestParameter('cont');

    for($i=0; $i<$cont; $i++)
    {
      if($this->getRequestParameter('update_'.$i))
      {
        $content_id = $this->getRequestParameter('update_'.$i);
        
		    $institution_charge = OpInstitutionChargePeer::retrieveByPk($content_id);
        $institution_charge->setChargeTypeId($this->getRequestParameter('charge_type_id_'.$content_id));
        $institution_charge->setPartyId($this->getRequestParameter('party_id_'.$content_id, 1));
        $institution_charge->setGroupId($this->getRequestParameter('group_id_'.$content_id, 1));

        if($this->getRequestParameter('constituency_id_'.$content_id))
          $institution_charge->setConstituencyId($this->getRequestParameter('constituency_id_'.$content_id));

        if($this->getRequestParameter('date_start_'.$content_id))
        {
          list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('date_start_'.$content_id),
                                                       $this->getUser()->getCulture());
          $institution_charge->setDateStart("$y-$m-$d");
        }

        if($this->getRequestParameter('date_end_'.$content_id))
        {
          list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('date_end_'.$content_id),
                                                       $this->getUser()->getCulture());
          $institution_charge->setDateEnd("$y-$m-$d");
        }	

        $institution_charge->save();
        
        $open_content = $institution_charge->getOpOpenContent();
        $open_content->setVerifiedAt(time());
        $open_content->addVerificationRecord($this->getUser()->getSubscriberId(), 'modificato da amministratore');
        $open_content->save();
        
      }
    }

    if($this->getRequestParameter('institution_id'))
      return $this->redirect('administrator/nationalManaging?institution_id='.$this->getRequestParameter('institution_id'));
    else
      return $this->redirect('administrator/locationManaging?location_type='.$location_type.'&'.$param.'='.$location_id);
  }

  //##### elenco cariche nazionali ########
  public function executeNationalManaging()
  {

    $this->setLayout('noColumnLayout');
    //calendar library
    $this->getResponse()->addJavascript('/sf/calendar/calendar.js');
    $this->getResponse()->addJavascript('/sf/calendar/lang/calendar-it.js');
    $this->getResponse()->addJavascript('/sf/calendar/calendar-setup.js');
    $this->getResponse()->addStylesheet('/sf/calendar/skins/aqua/theme.css');

    if ($this->getRequestParameter('institution_id'))
    {
      switch($this->getRequestParameter('institution_id'))
      {
        case sfConfig::get('app_institution_id_CE'):
        case sfConfig::get('app_institution_id_PE'):
          $this->location_id = 1;
          $election_type_id = 1;
          break;
        case sfConfig::get('app_institution_id_CD'):
          $this->location_id = 2;
          $election_type_id = 2;
          break;
        case sfConfig::get('app_institution_id_SR'):
          $this->location_id = 2;
          $election_type_id = 3;
          break;
        case sfConfig::get('app_institution_id_PR'):
          $this->location_id = 2;
          $election_type_id = -1;
          break;	
        default:
          $this->location_id = 2;
          $election_type_id = 2;		
      }

      $c = new Criteria();
      $c->Add(OpInstitutionChargePeer::INSTITUTION_ID, $this->getRequestParameter('institution_id'));
      $c->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
      $c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
      $c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
      $this->politicians = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c);

      $pager = new sfPropelPager('OpInstitutionCharge', sfConfig::get('app_pagination_admin_limit'));
      $pager->setCriteria($c);
      $pager->setPeerMethod('doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty');
      $pager->setPage($this->getRequestParameter('page', 1));
      $pager->init();
      $this->pager = $pager;

      $this->institution = OpInstitutionPeer::RetrieveByPk($this->getRequestParameter('institution_id'));	

      $c = new Criteria();
      $c->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID, Criteria::LEFT_JOIN);
      $c->Add(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, $this->getRequestParameter('institution_id'), Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpChargeTypePeer::NAME);
      $this->charge_list = OpChargeTypePeer::doSelect($c);

      $c = new Criteria();
      $c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_main'), Criteria::EQUAL);
      $c->Add(OpPartyPeer::OID, NULL, Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
      $this->primary_party_list = OpPartyPeer::doSelect($c);

      $c = new Criteria();
      $c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_secondary'), Criteria::EQUAL);
      $c->Add(OpPartyPeer::OID, NULL, Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
      $this->secondary_party_list = OpPartyPeer::doSelect($c);

      $c = new Criteria();
      $c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_death'), Criteria::EQUAL);
      $c->Add(OpPartyPeer::OID, NULL, Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
      $this->death_party_list = OpPartyPeer::doSelect($c);

      $c = new Criteria();
      $c->Add(OpGroupPeer::OID, NULL, Criteria::EQUAL);
      $c->addAscendingOrderByColumn(OpGroupPeer::NAME);
      $this->primary_group_list = OpGroupPeer::doSelect($c);

      $c = new Criteria();
      $c->addAscendingOrderByColumn(OpConstituencyPeer::NAME);
      $c->Add(OpConstituencyPeer::ELECTION_TYPE_ID, $election_type_id, Criteria::EQUAL);
      $this->constituency_list = OpConstituencyPeer::doSelect($c);

      $this->cont = 0;
    }
  }

  public function executePoliticianData()
  {
    if($this->getRequestParameter('content_id'))
    {
      // modifica di un politico
      $this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('content_id'));

      $c = new Criteria();
      $c->Add(OpResourcesPeer::RESOURCES_TYPE_ID, '1', Criteria::EQUAL);
      $c->Add(OpResourcesPeer::POLITICIAN_ID, $this->getRequestParameter('content_id'), Criteria::EQUAL);
	    $email_flag = OpResourcesPeer::doSelectOne($c);

      if($email_flag)
        $this->email = $email_flag;
      else
        $this->email = new OpResources;

      $c = new Criteria();
      $c->Add(OpResourcesPeer::RESOURCES_TYPE_ID, '3', Criteria::EQUAL);
      $c->Add(OpResourcesPeer::POLITICIAN_ID, $this->getRequestParameter('content_id'), Criteria::EQUAL);
      $url_flag = OpResourcesPeer::doSelectOne($c);

      if($url_flag)
        $this->url = $url_flag;
      else
        $this->url = new OpResources;

      $c = new Criteria();
      $c->Add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $this->getRequestParameter('content_id'), Criteria::EQUAL);
      $education_level_flag = OpPoliticianHasOpEducationLevelPeer::doSelectOne($c);

      if($education_level_flag)
        $this->education_level = $education_level_flag;
      else
        $this->education_level = new OpPoliticianHasOpEducationLevel;
    }
    else
    {
      // aggiunta di un politico
      $this->politician = new OpPolitician;
      $this->email = new OpResources;
      $this->url = new OpResources;
      $this->education_level = new OpPoliticianHasOpEducationLevel;
    }
    
    $this->forward404Unless($this->politician);

    $c = new Criteria();
    $c->addAscendingOrderByColumn(OpProfessionPeer::DESCRIPTION);
    $c->add(OpProfessionPeer::OID, null, Criteria::ISNULL);
    $this->profession_list = OpProfessionPeer::doSelect($c);

    $c = new Criteria();
    $c->addAscendingOrderByColumn(OpEducationLevelPeer::DESCRIPTION);
    $c->add(OpEducationLevelPeer::OID, null, Criteria::ISNULL);
	  $this->education_list = OpEducationLevelPeer::doSelect($c);

    $this->location_type = $this->getRequestParameter('location_type');
    $this->institution_location_id = $this->getRequestParameter('location_id');

    $this->institution_id = $this->getRequestParameter('institution_id');
  }

  public function executePoliticianDataUpdate()
  {
    $institution_location_id = $this->getRequestParameter('institution_location_id');
    $institution_id = $this->getRequestParameter('institution_id');
    $location_type = $this->getRequestParameter('location_type');

    $birth_date = $this->getRequestParameter('birth_date[year]') . '-' . 
                  $this->getRequestParameter('birth_date[month]') . '-' . 
                  $this->getRequestParameter('birth_date[day]');                  
    if ($birth_date == '--') $birth_date = '';
    
    if($this->getRequestParameter('content_id'))
	    $this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('content_id'));
    else
    {
      $existing_pol = OpPoliticianPeer::retrieveByAnagrafica($this->getRequestParameter('first_name'), 
                                                             $this->getRequestParameter('last_name'), 
                                                             $birth_date);
      if (!$existing_pol instanceof OpPolitician &&
          $existing_pol == OpPoliticianPeer::NO_RECORD)
        $this->politician = new OpPolitician;
      else
      {
        $this->setFlash('warning', "il politico che stai cercando di creare &egrave; gi&agrave; nel nostro database<br/> questa &egrave; la sua scheda, dove puoi modificare la sua anagrafica o aggiungere nuovi incarichi");
        $this->redirect('@politico_new?slug='. $existing_pol->getSlug().'&content_id='.$existing_pol->getContentId());
      }
    }

    $this->forward404Unless($this->politician);

    switch($location_type)
    {
      case 'region':
        $param = 'region_id';
        break;
      case 'provincial':
        $param = 'provincial_id';
        break;
      case 'municipal':
        $param = 'location_id';
        break;	
    }

    $this->politician->setSex($this->getRequestParameter('sex'));		
    $this->politician->setProfessionId($this->getRequestParameter('profession_id'));
    $this->politician->setUserId($this->getRequestParameter('user_id'));
    $this->politician->setFirstName($this->getRequestParameter('first_name'));
    $this->politician->setLastName($this->getRequestParameter('last_name'));

    if($this->getRequestParameter('delete') == '1')
	    $this->politician->setPicture(NULL);

    if($_FILES['picture_file']['tmp_name']!='')
      $this->politician->setPicture($_FILES['picture_file']['tmp_name']);

    if ($birth_date !== '') {
      $this->politician->setBirthDate($birth_date);
    }

    $birth_location = OpLocationPeer::RetrieveByPk($this->getRequestParameter('location_id'));

    if ($this->getRequestParameter('check_for_death', NULL))
        $this->politician->setDeathDate($this->getRequestParameter('death_date[year]') . '-' . 
                                        $this->getRequestParameter('death_date[month]') . '-' . 
                                        $this->getRequestParameter('death_date[day]'));

    if ($this->getRequestParameter('location_id') != '')
      $location = $birth_location->getName()."(".$birth_location->getProv().")";
    else
      $location = $this->getRequestParameter('location');	

    $this->politician->setBirthLocation($location);

    // inserimento utente creatore se non admin
    $creator_id = $this->getUser()->getSubscriber()->getId();
    if ($creator_id != 1)
      $this->politician->setCreatorId($creator_id);

    $this->politician->save();

    //inserimento email ufficiale
    if($this->getRequestParameter('email'))
    {
      if($this->getRequestParameter('email_id'))
        $email = OpResourcesPeer::RetrieveByPk($this->getRequestParameter('email_id'));
      else
        $email = new OpResources;

      $email->setPoliticianId($this->politician->getContentId());
      $email->setResourcesTypeId('1');
      $email->setValore($this->getRequestParameter('email'));

      $email->save();
    }

    //inserimento livello istruzione
    if($this->getRequestParameter('education_level'))
    {
      if($this->getRequestParameter('content_id'))
        $pol_id = $this->getRequestParameter('content_id');
      else
        $pol_id = $this->politician->getContentId();

      $c = new Criteria();
      $c->Add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $pol_id, Criteria::EQUAL);
      $education_level = OpPoliticianHasOpEducationLevelPeer::doSelectOne($c);

      if(!$education_level)
      {
        $education_level = new  OpPoliticianHasOpEducationLevel; 
        $education_level->setPoliticianId($pol_id);
      }

      $education_level->setEducationLevelId($this->getRequestParameter('education_level'));
      $education_level->setDescription($this->getRequestParameter('description'));

      $education_level->save();
    }

    //inserimento url ufficiale
    if($this->getRequestParameter('url'))
    {
      if($this->getRequestParameter('url_id'))
        $url = OpResourcesPeer::RetrieveByPk($this->getRequestParameter('url_id'));
      else
        $url = new OpResources;

      $url->setPoliticianId($this->politician->getContentId());
      $url->setResourcesTypeId('3');
      $url->setValore($this->getRequestParameter('url'));

      $url->save();
    }

    if($this->getRequestParameter('institution_id'))
      return $this->redirect('administrator/nationalManaging?institution_id='.$institution_id);
    else
    {	
      if($this->getRequestParameter('location_type'))
        return $this->redirect('administrator/locationManaging?location_type='.$location_type.'&'.$param.'='.$institution_location_id);
      else
      {
        $this->setFlash('notice', "questa &egrave; la scheda del politico che hai appena creato <br/> ora puoi aggiungere nuovi incarichi e contatti (email / siti web) che lo riguardano ");
        $this->redirect('@politico_new?slug='. $this->politician->getSlug().'&content_id='.$this->politician->getContentId());        
      }
    }		
  }

  public function executeChargeData()
  {
    $this->institution_id = $this->getRequestParameter('institution_id');
    $this->location_type = $this->getRequestParameter('location_type');

    if($this->getRequestParameter('location_id'))
      $this->location_id = $this->getRequestParameter('location_id');
    else
    {
      if($this->getRequestParameter('institution_id') == sfConfig::get('app_institution_id_CE') ||  $this->getRequestParameter('institution_id') == sfConfig::get('app_institution_id_PE'))
        $this->location_id = 1;
      else
        $this->location_id = 2;
    }		

    $this->institution = OpInstitutionPeer::RetrieveByPk($this->institution_id);
    $this->title = $this->institution->getName();

    $this->location = OpLocationPeer::retrieveByPk($this->location_id);

    $c = new Criteria();
    $c->addJoin(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID, Criteria::LEFT_JOIN);
    $c->Add(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, $this->institution_id, Criteria::EQUAL);
    $c->addAscendingOrderByColumn(OpChargeTypePeer::NAME);
    $this->charge_list = OpChargeTypePeer::doSelect($c);

    $c = new Criteria();
    $c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_main'), Criteria::EQUAL);
    $c->Add(OpPartyPeer::OID, NULL, Criteria::EQUAL);
    $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
    $this->primary_party_list = OpPartyPeer::doSelect($c);
    $primary_party_array[]="";
    $primary_party_array[]="1";
	
    foreach ($this->primary_party_list as $primary_party)
      $primary_party_array[]=$primary_party->getId();

    $c = new Criteria();
    $c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_secondary'), Criteria::EQUAL);
    $c->Add(OpPartyPeer::OID, NULL, Criteria::EQUAL);
    $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
    $this->secondary_party_list = OpPartyPeer::doSelect($c);

    $c = new Criteria();
    $c->Add(OpPartyPeer::MAIN, sfConfig::get('app_party_type_death'), Criteria::EQUAL);
    $c->Add(OpPartyPeer::OID, NULL, Criteria::EQUAL);
    $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
    $this->death_party_list = OpPartyPeer::doSelect($c);

    $c = new Criteria();
    $c->addJoin(OpPartyPeer::ID, OpPartyLocationPeer::PARTY_ID, Criteria::LEFT_JOIN);
    $c->Add(OpPartyLocationPeer::LOCATION_ID, $this->location_id, Criteria::EQUAL);
    $c->Add(OpPartyPeer::ID, $primary_party_array, Criteria::NOT_IN);
    $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
    $this->regional_party_list = OpPartyPeer::doSelect($c);

    $c = new Criteria();
    $c->addAscendingOrderByColumn(OpGroupPeer::NAME);
    $this->group_list = OpGroupPeer::doSelect($c);
  }

  public function executeAddCharge()
  {
    $this->institution_id = $this->getRequestParameter('institution_id');
    $location_id = $this->getRequestParameter('loc_id');
    $location_type = $this->getRequestParameter('location_type');

    if($this->getRequestParameter('location_type'))
    {
      switch($location_type)
      {
        case 'region':
          $param = 'region_id';
          break;
        case 'provincial':
          $param = 'provincial_id';
          break;
        case 'municipal':
          $param = 'location_id';
          break;	
      }
    }

    //se non è selezionato un nome dell'elenco non esegue nulla
    if($this->getRequestParameter('pol_id'))
    {
      $institution_charge = new OpInstitutionCharge;
      $institution_charge->setPoliticianId($this->getRequestParameter('pol_id'));
      $institution_charge->setInstitutionId($this->getRequestParameter('institution_id'));
      $institution_charge->setChargeTypeId($this->getRequestParameter('charge_type_id'));
      $institution_charge->setLocationId($location_id);
      $institution_charge->setPartyId($this->getRequestParameter('party_id',1));
      $institution_charge->setGroupId($this->getRequestParameter('group_id',1));
      $institution_charge->setDescription($this->getRequestParameter('description'));

      if($this->getRequestParameter('date_start[day]') && 
         $this->getRequestParameter('date_start[month]') &&
         $this->getRequestParameter('date_start[year]'))
      {
        //list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('date_start'), $this->getUser()->getCulture());
        $institution_charge->setDateStart($this->getRequestParameter('date_start[year]').'-'.
													  $this->getRequestParameter('date_start[month]').'-'.
													  $this->getRequestParameter('date_start[day]')
													 );
      }

      if($this->getRequestParameter('date_end[day]') && 
         $this->getRequestParameter('date_end[month]') &&
         $this->getRequestParameter('date_end[year]'))
      {
        //list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('date_end'), $this->getUser()->getCulture());
        $institution_charge->setDateEnd($this->getRequestParameter('date_end[year]').'-'.
													$this->getRequestParameter('date_end[month]').'-'.
													$this->getRequestParameter('date_end[day]')
												);
      }
     
	  $institution_charge->save();			
    }

    if($this->getRequestParameter('location_type'))
      return $this->redirect('administrator/locationManaging?location_type='.$location_type.'&'.$param.'='.$location_id);
    else
      return $this->redirect('administrator/nationalManaging?institution_id='.$this->institution_id);
  }

  public function executePartyManaging()
  {
    $this->setLayout('noColumnLayout');

    if($this->getRequestParameter('location_id'))
      $this->location_id = $this->getRequestParameter('location_id');
    else
      $this->location_id = 0;	

    if($this->getRequestParameter('location_type'))
      $this->location_type=$this->getRequestParameter('location_type');
    else
      $this->location_type = 'all';	

    $c = new Criteria();		

    if($this->getRequestParameter('location_type') && $this->getRequestParameter('location_type')!= 'all' )
    {
      switch($this->location_type)
      {
        case 'europe':
          $this->location_id = 1;
          break;
        case 'italy':
          $this->location_id = 2;
          break;	 
        case 'region':
          $this->location_id = $this->getRequestParameter('region_id');
          break;
        case 'provincial':
          $this->location_id = $this->getRequestParameter('provincial_id');
          break;
        case 'municipal':
          break;
      }

      $c->addJoin(OpPartyPeer::ID, OpPartyLocationPeer::PARTY_ID, Criteria::LEFT_JOIN);
      $c->Add(OpPartyLocationPeer::LOCATION_ID, $this->location_id, Criteria::EQUAL);

      $this->location = OpLocationPeer::RetrieveByPk($this->location_id);
    }	

    $c->addAscendingOrderByColumn(OpPartyPeer::NAME);

    $pager = new sfPropelPager('OpParty', sfConfig::get('app_pagination_limit'));
    $pager->setCriteria($c);
    $pager->setPeerMethod('doSelect');
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
  }

  public function executePartyData()
  {
    if($this->getRequestParameter('id'))
      $this->party = OpPartyPeer::RetrieveByPk($this->getRequestParameter('id'));
    else
      $this->party = new OpParty;

    $this->location_id = $this->getRequestParameter('location_id');
    if($this->location_id != 0)
      $this->location = OpLocationPeer::RetrieveByPk($this->location_id);
  }

  public function executePartyUpdate()
  {
    if($this->getRequestParameter('party_id'))
	  $this->party = OpPartyPeer::retrieveByPk($this->getRequestParameter('party_id'));
    else
      $this->party = new OpParty;

    $this->forward404Unless($this->party);

    $this->party->setIstatCode($this->getRequestParameter('istat_code'));
    $this->party->setName($this->getRequestParameter('name'));
    $this->party->setAcronym($this->getRequestParameter('acronym'));
    $this->party->setParty($this->getRequestParameter('party', 0));
    $this->party->setMain($this->getRequestParameter('main', 0));

    $this->party->save();

    $location_id = $this->getRequestParameter('location_id');
    if($location_id != 0 && !$this->getRequestParameter('party_id'))
    {
      $party_location = new OpPartyLocation;
      $party_location->setPartyId($this->party->getId());
      $party_location->setLocationId($location_id);
      $party_location->save();
    }

    return $this->redirect('administrator/partyManaging');
  }

  public function executeExistingParty()
  {
    $this->location_type = $this->getRequestParameter('location_type');
    $this->location_id = $this->getRequestParameter('location_id');
    $this->location = OpLocationPeer::RetrieveByPk($this->location_id);

    //elenco partiti della location selezionata
    $c = new Criteria();
    $c->addJoin(OpPartyPeer::ID, OpPartyLocationPeer::PARTY_ID, Criteria::LEFT_JOIN);
    $c->Add(OpPartyLocationPeer::LOCATION_ID, $this->location_id, Criteria::EQUAL);
    $c->addAscendingOrderByColumn(OpPartyPeer::NAME);
    $this->parties = OpPartyPeer::doSelect($c);
  }

  public function executeUpdateExistingParty()
  {
    $location_type = $this->getRequestParameter('location_type');
    $location_id = $this->getRequestParameter('location_id');

    if($this->getRequestParameter('party_id'))
    {
      $party_location = new OpPartyLocation;
      $party_location->setPartyId($this->getRequestParameter('party_id'));
      $party_location->setLocationId($this->getRequestParameter('location_id'));
      $party_location->save();
    }

    //return $this->redirect('administrator/partyManaging?location_id='.$location_id.'&location_type='.$location_type);
    return $this->redirect('administrator/partyManaging');
  }

  public function executeGroupManaging()
  {
    $this->setLayout('noColumnLayout');

    if($this->getRequestParameter('location_id'))
      $this->location_id = $this->getRequestParameter('location_id');
    else
      $this->location_id = 0;	

    if($this->getRequestParameter('location_type'))
      $this->location_type=$this->getRequestParameter('location_type');
    else
      $this->location_type = 'all';	

    $c = new Criteria();		

    if($this->getRequestParameter('location_type') && $this->getRequestParameter('location_type')!= 'all' )
    {
      switch($this->location_type)
      {
        case 'europe':
          $this->location_id = 1;
          break;
        case 'italy':
          $this->location_id = 2;
          break;	 
        case 'region':
          $this->location_id = $this->getRequestParameter('region_id');
          break;
        case 'provincial':
          $this->location_id = $this->getRequestParameter('provincial_id');
          break;
        case 'municipal':
          break;
      }

      $c->addJoin(OpGroupPeer::ID, OpGroupLocationPeer::GROUP_ID, Criteria::LEFT_JOIN);
      $c->Add(OpGroupLocationPeer::LOCATION_ID, $this->location_id, Criteria::EQUAL);

      $this->location = OpLocationPeer::RetrieveByPk($this->location_id);
    }	

    $c->addAscendingOrderByColumn(OpGroupPeer::NAME);

    $pager = new sfPropelPager('OpGroup', sfConfig::get('app_pagination_limit'));
    $pager->setCriteria($c);
    $pager->setPeerMethod('doSelect');
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
  }

  public function executeGroupData()
  {
    if($this->getRequestParameter('id'))
      $this->group = OpGroupPeer::RetrieveByPk($this->getRequestParameter('id'));
    else
      $this->group = new OpGroup;

    $this->location_id = $this->getRequestParameter('location_id');
    if($this->location_id != 0)
      $this->location = OpLocationPeer::RetrieveByPk($this->location_id);
  }

  public function executeGroupUpdate()
  {
    if($this->getRequestParameter('group_id'))
      $this->group = OpGroupPeer::retrieveByPk($this->getRequestParameter('group_id'));
    else
      $this->group = new OpGroup;

    $this->forward404Unless($this->group);

    $this->group->setName($this->getRequestParameter('name'));
    $this->group->setAcronym($this->getRequestParameter('acronym'));

    $this->group->save();

    $location_id = $this->getRequestParameter('location_id');
    if($location_id != 0 && !$this->getRequestParameter('group_id'))
    {
      $group_location = new OpGroupLocation;
      $group_location->setGroupId($this->group->getId());
      $group_location->setLocationId($location_id);
      $group_location->save();
    }

    return $this->redirect('administrator/groupManaging');
  }

  public function executeExistingGroup()
  {
    $this->location_type = $this->getRequestParameter('location_type');

    $this->location_id = $this->getRequestParameter('location_id');
    $this->location = OpLocationPeer::RetrieveByPk($this->location_id);

    //elenco gruppi della location selezionata
    $c = new Criteria();
    $c->addJoin(OpGroupPeer::ID, OpGroupLocationPeer::GROUP_ID, Criteria::LEFT_JOIN);
    $c->Add(OpGroupLocationPeer::LOCATION_ID, $this->location_id, Criteria::EQUAL);
    $c->addAscendingOrderByColumn(OpGroupPeer::NAME);
    $this->groups = OpGroupPeer::doSelect($c);
  }

  public function executeUpdateExistingGroup()
  {
    $location_type = $this->getRequestParameter('location_type');
    $location_id = $this->getRequestParameter('location_id');

    if($this->getRequestParameter('group_id'))
    {
      $group_location = new OpGroupLocation;
      $group_location->setGroupId($this->getRequestParameter('group_id'));
      $group_location->setLocationId($this->getRequestParameter('location_id'));
      $group_location->save();
    }

    //return $this->redirect('administrator/partyManaging?location_id='.$location_id.'&location_type='.$location_type);
    return $this->redirect('administrator/groupManaging');
  }

  public function executeObscuredContents()
  {
    $this->setLayout('noColumnLayout');

    // incarichi
    $c = new Criteria();
    $c->AddJoin(OpContentPeer::ID, OpObscuredContentPeer::CONTENT_ID, Criteria::INNER_JOIN);
    $c->Add(OpContentPeer::OP_CLASS, '%Charge', Criteria::LIKE);
    $c->addDescendingOrderByColumn(OpObscuredContentPeer::CREATED_AT);
    $this->obscured_charges = OpObscuredContentPeer::doSelect($c);

    // dichiarazioni
    $c = new Criteria();
    $c->AddJoin(OpContentPeer::ID, OpObscuredContentPeer::CONTENT_ID, Criteria::INNER_JOIN);
    $c->Add(OpContentPeer::OP_CLASS, 'OpDeclaration', Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpObscuredContentPeer::CREATED_AT);
    $this->obscured_declarations = OpObscuredContentPeer::doSelect($c);

    // temi
    $c = new Criteria();
    $c->AddJoin(OpContentPeer::ID, OpObscuredContentPeer::CONTENT_ID, Criteria::INNER_JOIN);
    $c->Add(OpContentPeer::OP_CLASS, 'OpTheme', Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpObscuredContentPeer::CREATED_AT);
    $this->obscured_themes = OpObscuredContentPeer::doSelect($c);

  }

  public function executeRestoredCharge()
  {
    $content_id = $this->getRequestParameter('content_id');

    //aggiornamento campo deleted_at in op_open_content
    $open_content = OpOpenContentPeer::retrieveByPK($content_id);
    $open_content->setDeletedAt(NULL);
    $open_content->setVerifiedAt(time());
    $open_content->addVerificationRecord(sfContext::getInstance()->getUser()->getSubscriberId(), 'ripristinato');
    $open_content->save();

    //eliminazione record da op_obscured_content
    $obscured_content = OpObscuredContentPeer::retrieveByContentId($content_id);
    $obscured_content->delete();

    // aggiorna l'indice del politico associato (l'ultimo incarico è nei dati [unindexed-stored])
    $content = OpContentPeer::retrieveByPK($content_id);
    $class = $content->getOpClass();
    $this->content_type = "charges";
    switch ($class)
    {
      case 'OpInstitutionCharge':
        $charge = OpInstitutionChargePeer::retrieveByPK($content_id);
        break;
      case 'OpPoliticalCharge':
        $charge = OpPoliticalChargePeer::retrieveByPK($content_id);
        break;
      case 'OpOrganizationCharge':
        $charge = OpInstitutionChargePeer::retrieveByPK($content_id);
        break;
    }
    $iMan = new OpIndexManager();
    $iMan->updateDocument($charge->getOpPolitician());
    $iMan->commit();
    unset($iMan);
    
    // aggiornamento cache per info utente creatore del content (se != admin)
    $user = $open_content->getOpUser();
    if ($user->getNickname() != 'admin')
    {
      $user->setCharges($user->countCharges()); 
      $user->updateLastContribution();
      $user->save();      
    }
    

    // ri-estrazione dei contenuti oscurati, dopo il restore
    $c = new Criteria();
    $c->AddJoin(OpContentPeer::ID, OpObscuredContentPeer::CONTENT_ID, Criteria::INNER_JOIN);
    $c->Add(OpContentPeer::OP_CLASS, '%Charge', Criteria::LIKE);
    $c->addDescendingOrderByColumn(OpObscuredContentPeer::CREATED_AT);
    $this->obscured_contents = OpObscuredContentPeer::doSelect($c);

    $this->setTemplate('restoredContent');
    
  }


  /**
   * esegue il restore di un contenuto opinabile
   * 
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeRestoredOpinableContent()
  {
    $content_id = $this->getRequestParameter('content_id');

    //aggiornamento campo deleted_at in op_open_content
    $open_content = OpOpenContentPeer::retrieveByPK($content_id);
    $open_content->setDeletedAt(null);
    $open_content->save();


    //eliminazione record da op_obscured_content
    $obscured_content = OpObscuredContentPeer::retrieveByContentId($content_id);
    $obscured_content->delete();


    //ripristino dei tag associati
    $c = new Criteria();
    $c->Add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $content_id);
    $tags = OpTagHasOpOpinableContentPeer::doSelect($c);
    foreach($tags as $tag)
    {
      $tag->setIsObscured(0);
      $tag->save();
    }	

    // ripristino degli indici testuali e della cache nelle user infoz (se != admin)
    $content = OpContentPeer::retrieveByPK($this->getRequestParameter('content_id'));
    $class = $content->getOpClass();
    $this->content_type = strtolower(str_replace("Op", "", $class)) . 's';
    $user = $open_content->getOpUser();    
    $update_user_infoz = $user->getNickname()!='admin'?true:false;
    if ($class == 'OpDeclaration')
    {
      $declined_content = OpDeclarationPeer::retrieveByPK($content_id);
      if ($update_user_infoz) $user->setDeclarations($user->countDeclarations());
    } elseif ($class == 'OpTheme') {
      $declined_content = OpThemePeer::retrieveByPK($content_id);
      if ($update_user_infoz) $user->setThemes($user->countThemes()); 
    }

    if ($update_user_infoz) 
    {
      $user->updateLastContribution();
      $user->save();      
    }
    
    $iMan = new OpIndexManager();
    $iMan->addDocument($declined_content);
    $iMan->commit();
    unset($iMan);

    // ri-estrazione dei contenuti oscurati, dopo il restore
    $c = new Criteria();
    $c->AddJoin(OpContentPeer::ID, OpObscuredContentPeer::CONTENT_ID, Criteria::INNER_JOIN);
    $c->Add(OpContentPeer::OP_CLASS, $class, Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpObscuredContentPeer::CREATED_AT);
    $this->obscured_contents = OpObscuredContentPeer::doSelect($c);

    $this->setTemplate('restoredContent');

  }
  
  /**
   * rimuove in modo definitivo un contenuto oscurato
   * la rimozione di tutti i record associati avviene automaticamente
   * grazie al on delete cascade definito nel DB
   * 
   *
   * @return void
   * @author Guglielmo Celata
   **/

  public function executeRemovedContent()
  {
    $content_hash = $this->getRequestParameter('content_hash');
    $content = OpContentPeer::getContentFromHash($content_hash);
    $class = $content->getOpClass();
    $this->content_type = strtolower(str_replace("Op", "", $class)) . 's';
    if (strpos($this->content_type, "charge")) $this->content_type = "charges";

    //eliminazione record da op_content
    $content->delete();

    // ri-estrazione dei contenuti oscurati, dopo la rimozione
    $c = new Criteria();
    $c->AddJoin(OpContentPeer::ID, OpObscuredContentPeer::CONTENT_ID, Criteria::INNER_JOIN);
    if ($this->content_type == "charges")
      $c->Add(OpContentPeer::OP_CLASS, '%Charge', Criteria::LIKE);
    else
      $c->Add(OpContentPeer::OP_CLASS, $class, Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpObscuredContentPeer::CREATED_AT);
    $this->obscured_contents = OpObscuredContentPeer::doSelect($c);

  }
  
  
  public function executeVsqCandidates()
  {
    // parametro per vedere se si devono mostrare o meno i candidati gia' assegnati
    $this->assegnati = $this->getRequestParameter('assegnati');
    
    $this->politicians = OpPoliticianPeer::getVsqCandidates($this->assegnati);
    
    // estrai i partiti per le elezioni 2008 (flag electoral)
    $c = new Criteria();
    $c->add(OpPartyPeer::ELECTORAL, 1);
    $parties = OpPartyPeer::doSelect($c);

    // calcola l'array associativo per la select
    $sel_parties = array();
    foreach ($parties as $party)
    {
      $sel_parties[$party->getId()] = $party->getName() . ($party->getAcronym() != ''? " (".$party->getAcronym().")" : "");
    }
    $this->selectable_parties = $sel_parties;
    
  }
  
}

?>