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
 * politician components.
 *
 * @package    openpolis
 * @subpackage politician
 * @author     Gianluca Canale 
 * @version    SVN: $Id: components.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class politicianComponents extends sfComponents
{
  
  /* TODO: queste azioni per componenti potrebbero non essere più usate */

  public function executeRegionPoliticians()
  {
    //selezione presidente giunta regionale
	  $c1 = new Criteria();
    $c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GR'));  
    $c1->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c1->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c1->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c1->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'));
    $this->presidente_giunta_regionale = OpInstitutionChargePeer::doSelectOne($c1); 
	
	  //selezione della giunta regionale
    $c1 = new Criteria();
    $c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GR'));  
    $c1->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c1->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
	  $c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'), Criteria::NOT_IN);
    $c1->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c1->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c1->addAscendingOrderByColumn(OpChargeTypePeer::PRIORITY);
    $c1->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
    $this->elementi_giunta_regionale = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c1); 
    
	  //selezione presidente consiglio regionale
	  $c1 = new Criteria();
    $c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CR'));  
    $c1->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c1->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c1->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c1->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'));
    $this->presidente_consiglio_regionale = OpInstitutionChargePeer::doSelectOne($c1);
	
    //selezione del consiglio regionale 				
    $c2 = new Criteria();
    $c2->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CR')); 
    $c2->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
	  $c2->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'), Criteria::NOT_IN);
    $c2->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
    $c2->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c2->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c2->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $this->elementi_consiglio_regionale = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c2);  	
  }

  public function executeProvincialPoliticians()
  {
    //selezione presidente giunta provinciale
    $c1 = new Criteria();
    $c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GP'));  
    $c1->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c1->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'));
	$c1->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c1->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $this->presidente_giunta_provinciale = OpInstitutionChargePeer::doSelectOne($c1);
	  	
    //selezione della giunta provinciale
    $c1 = new Criteria();
    $c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GP'));  
    $c1->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c1->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'), Criteria::NOT_IN);
	$c1->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c1->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c1->addAscendingOrderByColumn(OpChargeTypePeer::PRIORITY);
    $c1->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
    $this->elementi_giunta_provinciale = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c1); 

    //selezione presidente consiglio provinciale
    $c1 = new Criteria();
    $c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CP'));  
    $c1->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c1->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'));
	$c1->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c1->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $this->presidente_consiglio_provinciale = OpInstitutionChargePeer::doSelectOne($c1);

    //selezione del consiglio provinciale
    $c2 = new Criteria();
    $c2->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CP'));  
    $c2->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c2->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c2->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'), Criteria::NOT_IN);
	$c2->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c2->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c2->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
    $this->elementi_consiglio_provinciale = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c2); 

    //selezione del commissario
    $c3 = new Criteria();
    $c3->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CO'));  
    $c3->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c3->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c3->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c3->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $this->elementi_commissariamento = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c3);
  }

  public function executeMunicipalPoliticians()
  {
    //selezione sindaco
    $c1 = new Criteria();
    $c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GC'));  
    $c1->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c1->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_sindaco'));
	$c1->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c1->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $this->sindaco = OpInstitutionChargePeer::doSelectOne($c1);
	
	//selezione della giunta comunale
    $c1 = new Criteria();
    $c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GC'));  
    $c1->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c1->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_sindaco'), Criteria::NOT_IN);
	$c1->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c1->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c1->addAscendingOrderByColumn(OpChargeTypePeer::PRIORITY);
    $c1->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
    $this->elementi_giunta_comunale = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c1); 
    
	//selezione presidente consiglio comunale
    $c1 = new Criteria();
    $c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CC'));  
    $c1->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c1->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'));
	$c1->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c1->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $this->presidente_consiglio_comunale = OpInstitutionChargePeer::doSelectOne($c1);
	
    //selezione del consiglio comunale
    $c2 = new Criteria();
    $c2->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CC'));  
    $c2->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c2->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'), Criteria::NOT_IN);
	$c2->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
    $c2->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c2->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c2->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $this->elementi_consiglio_comunale = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c2); 

    //selezione del commissario
    $c3 = new Criteria();
    $c3->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CO'));  
    $c3->Add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
    $c3->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c3->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c3->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $this->elementi_commissariamento = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c3);
  }

  public function executeConstituencyPoliticians()
  {
    //determinazione della circoscrizione elettorale
    $c = new Criteria(); 
    $c->Add(OpConstituencyPeer::ELECTION_TYPE_ID, $this->election_type);
    $c->Add(OpConstituencyLocationPeer::LOCATION_ID, $this->location_id);
    $c->setLimit(1);
    $constituency = OpConstituencyLocationPeer::doSelectJoinOpConstituency($c); 
    $circoscrizione = $constituency[0];

    $c1 = new Criteria();
	$c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, 3, Criteria::NOT_EQUAL);
    $c1->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c1->Add(OpInstitutionChargePeer::CONSTITUENCY_ID, $circoscrizione->getOpConstituency()->getId(), Criteria::EQUAL);
    $c1->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
    $this->institution_charges=OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpPoliticianAndOpGroupAndOpChargeType($c1);
  }

  /* fine NOTA */


  public function executeActualCharges()
  {
    $this->id_giunta_comunale = sfConfig::get('app_institution_id_GC');
    $this->id_consiglio_comunale = sfConfig::get('app_institution_id_CC');
  }

  public function executeCamereList()
  {
  	$c = new Criteria();
	$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, $this->getRequestParameter('id'), Criteria::EQUAL);
	$c->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'), Criteria::EQUAL);
    $c->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
	$this->presidente = OpInstitutionChargePeer::doSelectOne($c);
  }
  
  public function executeGovernoList()
  {
    $c_pres = new Criteria();
    $c_pres->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_PR'), Criteria::EQUAL);
    $c_pres->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c_pres->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c_pres->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c_pres->setLimit(1);
    $presidente = OpInstitutionChargePeer::doSelect($c_pres);
    $this->presidente_repubblica=NULL;
    if($presidente)
      $this->presidente_repubblica = $presidente[0];
	
	$c_pres = new Criteria();
    //$c_pres->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GI'), Criteria::EQUAL);
    $c_pres->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_pres_consiglio'), Criteria::EQUAL);
    $c_pres->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c_pres->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c_pres->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c_pres->setLimit(1);
    $presidente = OpInstitutionChargePeer::doSelect($c_pres);
    $this->presidente_consiglio = NULL;
    if($presidente)
      $this->presidente_consiglio = $presidente[0];  
  }
  
  public function executeAnagraphical()
  {
    //recupero professione
    if ($this->op_politician->getProfessionId()!= NULL)
    {
      $this->profession = (string)$this->op_politician->getOpProfession();
    }
    else
    {
      $this->profession = 'non inserita';
    }
		
    //recupero titolo di studio
    $c = new Criteria();
    $c->addJoin(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, OpEducationLevelPeer::ID, Criteria::LEFT_JOIN);
    $c->Add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $this->op_politician->getContentId(), Criteria::EQUAL);
    $education = OpPoliticianHasOpEducationLevelPeer::doSelectOne($c);
    $this->education_level = 'non inserito';
    $this->description = '';
    if($education)
    {
      $this->education_level = $education->getOpEducationLevel()->getDescription();
      if($education->getDescription() != '')
        $this->description = $education->getDescription();	
    }		
  }
  
  public function executeTagsCloud()
  {
  	$this->tags = OpTagPeer::getTagsForPolitician($this->politician_id, sfConfig::get('app_tag_cloud_max'));
  }	
}  	
?>
