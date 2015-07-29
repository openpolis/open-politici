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
 * @subpackage statistics
 * @author     Gianluca Canale
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */

class statisticsComponents extends sfComponents
{
    private function executePoliticiMaschi()
	{
      $numero_totale_politici = OpPoliticianPeer::doCount(new Criteria());
      $c = new Criteria();
      $c->Add(OpPoliticianPeer::SEX, 'M', Criteria::EQUAL);
      
	  $numero_totale_politici_maschi = OpPoliticianPeer::doCount($c);
	  return $perc_maschi = number_format($numero_totale_politici_maschi/$numero_totale_politici *100,2);
    }
	
	private function executeEtaMediaPolitici()
	{
      $numero_totale_politici = OpPoliticianPeer::doCount(new Criteria());
      $c = new Criteria();
      $c->Add(OpPoliticianPeer::SEX, 'F', Criteria::EQUAL);
      
	  $numero_totale_politici_femmine = OpPoliticianPeer::doCount($c);
      return $perc_maschi = floor(($numero_totale_politici - $numero_totale_politici_femmine)/$numero_totale_politici * 100);
	}
	
	private function executePoliticiLaureati()
	{
      $c = new Criteria();
	  $c->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, '1', Criteria::NOT_EQUAL);
	  $c->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, '2', Criteria::NOT_EQUAL); 	  
	  $politici_con_grado_istruzione = OpPoliticianHasOpEducationLevelPeer::doCount($c);
	  #$politici_con_grado_istruzione = OpPoliticianPeer::doCount(new Criteria());
	  
	  $c = new Criteria();
      $criterion = $c->getNewCriterion(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID , sfConfig::get('app_education_level_laurea_breve'), Criteria::EQUAL);
      $criterion->addOr($c->getNewCriterion(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID , sfConfig::get('app_education_level_laurea'), Criteria::EQUAL));
      $c->add($criterion);
      $numero_totale_politici_laureati = OpPoliticianHasOpEducationLevelPeer::doCount($c);
	  
	  return number_format($numero_totale_politici_laureati /$politici_con_grado_istruzione *100,2);
    }
    
	
	/**
   	* Executes default component
   	*
   	*/
  	public function executeDefault()
  	{
  	  
  	  $this->registered_users = OpUserPeer::countRegisteredUsers();
  	  
  		//numero di politici con incarichi
  		$this->politici_con_incarichi = OpInstitutionChargePeer::getChargesGroupByPolitician();
		
  		//numero di dichiarazioni non oscurate
  		$c = new Criteria();
  		$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpDeclarationPeer::CONTENT_ID, Criteria::LEFT_JOIN);
  		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
  		$this->numero_dichiarazioni = OpDeclarationPeer::doCount($c);
				
		$this->numero_argomenti = OpTagPeer::doCount(new Criteria());
		
		$politici = OpPoliticianPeer::doCount(new Criteria());
		
		$c = new Criteria();
		$c->Add(OpPoliticianPeer::LAST_CHARGE_UPDATE, NULL, Criteria::NOT_EQUAL);
		$politici_revisionati = OpPoliticianPeer::doCount($c);
		
		$this->politici_revisionati_perc = number_format($politici_revisionati/$politici *100,2);
		
		$c = new Criteria();
		$c->Add(OpLocationPeer::LOCATION_TYPE_ID, '6', Criteria::EQUAL);
		$comuni = OpLocationPeer::doCount($c);
		
		$c = new Criteria();
		$c->Add(OpLocationPeer::LAST_CHARGE_UPDATE, NULL, Criteria::NOT_EQUAL);
		$c->Add(OpLocationPeer::LOCATION_TYPE_ID, '6', Criteria::EQUAL);
		$comuni_revisionati = OpLocationPeer::doCount($c);
		
		$this->comuni_revisionati_perc = number_format($comuni_revisionati/$comuni *100,2);
		
		$c = new Criteria();
		$c->Add(OpLocationPeer::LOCATION_TYPE_ID, '5', Criteria::EQUAL);
		$provincie = OpLocationPeer::doCount($c);
		
		$c = new Criteria();
		$c->Add(OpLocationPeer::LAST_CHARGE_UPDATE, NULL, Criteria::NOT_EQUAL);
		$c->Add(OpLocationPeer::LOCATION_TYPE_ID, '5', Criteria::EQUAL);
		$provincie_revisionate = OpLocationPeer::doCount($c);
		
		$this->provincie_revisionate_perc = number_format($provincie_revisionate/$provincie *100,2);
		
		$c = new Criteria();
		$c->Add(OpLocationPeer::LOCATION_TYPE_ID, '4', Criteria::EQUAL);
		$regioni = OpLocationPeer::doCount($c);
		
		$c = new Criteria();
		$c->Add(OpLocationPeer::LAST_CHARGE_UPDATE, NULL, Criteria::NOT_EQUAL);
		$c->Add(OpLocationPeer::LOCATION_TYPE_ID, '4', Criteria::EQUAL);
		$regioni_revisionate = OpLocationPeer::doCount($c);
		
		$this->regioni_revisionate_perc = number_format($regioni_revisionate/$regioni *100,2);
	  }
	
	  public function executeInstitutionStatistics()
  	{
		
  		if($this->getRequestParameter('id')==sfConfig::get('app_institution_id_CE'))
  		{
  			$institution_id=sfConfig::get('app_institution_id_PE');
  		}
  		else
  		{
  			$institution_id=$this->getRequestParameter('id');
  		}
	
  		//numero di politici con incarichi nella istituzione selezionata
  		$politici_con_incarichi = OpInstitutionChargePeer::getChargesGroupByPolitician($institution_id);
		
  		$politici_con_incarichi_maschi = OpInstitutionChargePeer::getChargesGroupByPolitician($institution_id, 'M');
  		$this->maschi_perc=number_format($politici_con_incarichi_maschi/$politici_con_incarichi *100,2);
  		$this->femmine_perc=number_format(100-$this->maschi_perc,2);
		
		$this->totale_maschi_perc = number_format($this->executePoliticiMaschi(),2);
		
  		$anno_medio = OpInstitutionChargePeer::getInstitutionAverageAge($institution_id);
  		$this->eta_media = number_format(date('Y',time())-$anno_medio, 1 );
		
		$anno_medio_totale = OpInstitutionChargePeer::getTotalAverageAge();
		$this->eta_media_totale = number_format(date('Y',time())-$anno_medio_totale, 1 );
		
		$politici_con_grado_istruzione = OpInstitutionChargePeer::getInstitutionEducationLevelCount($institution_id);
  		$laureati = OpInstitutionChargePeer::getInstitutionEducationLevel($institution_id,sfConfig::get('app_education_level_laurea'));
  		$this->laureati_perc = number_format($laureati/$politici_con_grado_istruzione *100,2);
		
		$this->numero_medio_laureati = $this->executePoliticiLaureati();
			
	  }
	
	  public function executeRegionalStatistics()
  	{
  		//numero di politici con incarichi nella istituzione selezionata
  		$politici_con_incarichi = OpInstitutionChargePeer::getChargesGroupByLocationPolitician($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GR'),sfConfig::get('app_institution_id_CR'));
		
  		$politici_con_incarichi_maschi = OpInstitutionChargePeer::getChargesGroupByLocationPolitician($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GR'),sfConfig::get('app_institution_id_CR'),'M');
  		$this->maschi_perc=number_format($politici_con_incarichi_maschi/$politici_con_incarichi *100,2);
  		$this->femmine_perc=number_format(100-$this->maschi_perc,2);
		
		$this->totale_maschi_perc = number_format($this->executePoliticiMaschi(),2);
		
  		$anno_medio = OpInstitutionChargePeer::getLocationAverageAge($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GR'),sfConfig::get('app_institution_id_CR'));
  		$this->eta_media = number_format(date('Y',time())-$anno_medio, 1 );
		
		$anno_medio_totale = OpInstitutionChargePeer::getTotalAverageAge();
		$this->eta_media_totale = number_format(date('Y',time())-$anno_medio_totale, 1 );
		
		$politici_con_grado_istruzione = OpInstitutionChargePeer::getLocationEducationLevelCount($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GR'),sfConfig::get('app_institution_id_CR'));
  		$laureati = OpInstitutionChargePeer::getLocationEducationLevel($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GR'),sfConfig::get('app_institution_id_CR'),sfConfig::get('app_education_level_laurea'));
		
  		$this->laureati_perc = number_format($laureati/$politici_con_grado_istruzione *100,2);
		
		$this->numero_medio_laureati = $this->executePoliticiLaureati();
			
	  }
	
	public function executeProvincialStatistics()
  	{
		//numero di politici con incarichi nella istituzione selezionata
		$politici_con_incarichi = OpInstitutionChargePeer::getChargesGroupByLocationPolitician($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GP'),sfConfig::get('app_institution_id_CP'));
				
		$politici_con_incarichi_maschi = OpInstitutionChargePeer::getChargesGroupByLocationPolitician($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GP'),sfConfig::get('app_institution_id_CP'),'M');
		$this->maschi_perc=number_format($politici_con_incarichi_maschi/$politici_con_incarichi *100,2);
		$this->femmine_perc=number_format(100-$this->maschi_perc,2);
		
		$this->totale_maschi_perc = number_format($this->executePoliticiMaschi(),2);
		
		$anno_medio = OpInstitutionChargePeer::getLocationAverageAge($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GP'),sfConfig::get('app_institution_id_CP'));
		$this->eta_media = number_format(date('Y',time())-$anno_medio, 1 );
		
		$anno_medio_totale = OpInstitutionChargePeer::getTotalAverageAge();
		$this->eta_media_totale = number_format(date('Y',time())-$anno_medio_totale, 1 );
		
		$politici_con_grado_istruzione = OpInstitutionChargePeer::getLocationEducationLevelCount($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GP'),sfConfig::get('app_institution_id_CP'));
		$laureati = OpInstitutionChargePeer::getLocationEducationLevel($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GP'),sfConfig::get('app_institution_id_CP'),sfConfig::get('app_education_level_laurea'));
		$this->laureati_perc = number_format($laureati/$politici_con_grado_istruzione *100,2);
		
		$this->numero_medio_laureati = $this->executePoliticiLaureati();
					
	}
	
	public function executeMunicipalStatistics()
  	{
		//numero di politici con incarichi nella istituzione selezionata
		$politici_con_incarichi = OpInstitutionChargePeer::getChargesGroupByLocationPolitician($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GC'),sfConfig::get('app_institution_id_CC'));
		
		$politici_con_incarichi_maschi = OpInstitutionChargePeer::getChargesGroupByLocationPolitician($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GC'),sfConfig::get('app_institution_id_CC'),'M');
		$this->maschi_perc=number_format($politici_con_incarichi_maschi/$politici_con_incarichi *100,2);
		$this->femmine_perc=number_format(100-$this->maschi_perc,2);
		
		$this->totale_maschi_perc = number_format($this->executePoliticiMaschi(),2);
		
		$anno_medio = OpInstitutionChargePeer::getLocationAverageAge($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GC'),sfConfig::get('app_institution_id_CC'));
		$this->eta_media = number_format(date('Y',time())-$anno_medio, 1 );
		
		$anno_medio_totale = OpInstitutionChargePeer::getTotalAverageAge();
		$this->eta_media_totale = number_format(date('Y',time())-$anno_medio_totale, 1 );
		
		$politici_con_grado_istruzione = OpInstitutionChargePeer::getLocationEducationLevelCount($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GC'),sfConfig::get('app_institution_id_CC'));
		$laureati = OpInstitutionChargePeer::getLocationEducationLevel($this->getRequestParameter('location_id'),sfConfig::get('app_institution_id_GC'),sfConfig::get('app_institution_id_CC'),sfConfig::get('app_education_level_laurea'));
		$this->laureati_perc = number_format($laureati/$politici_con_grado_istruzione *100,2);
		
		$this->numero_medio_laureati = $this->executePoliticiLaureati();
			
	}
	
  /********** STATISTICHE UTENTE ****************/
  public function executeUsersStatistics()
  {
    // calcolo statistiche utenti
    $this->registered_users = OpUserPeer::countRegisteredUsers();
    $this->moderators = OpUserPeer::countModerators();
    $this->activeUsersInLastMonth = OpUserPeer::countActiveUsersInLastMonth();
    $this->regioniMaxUsers = OpUserPeer::getLocationsWithMaxUsers('regione');
    $this->provinceMaxUsers = OpUserPeer::getLocationsWithMaxUsers('provincia');
    $this->comuniMaxUsers = OpUserPeer::getLocationsWithMaxUsers('comune');
    
  }
  
  public function executeSex()
  {
    if ($this->zona==1) $reg=array(1,2,3,4,5,6,7);
    if ($this->zona==2) $reg=array(8,9,10,11,12,13,14);
    if ($this->zona==3) $reg=array(15,16,17,18,19,20);
    if ($this->zona==4) $reg=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
       $loc=array();
        $c= new Criteria();
        $c->add(OpLocationPeer::REGIONAL_ID, $reg, Criteria::IN);
        $locations=OpLocationPeer::doSelect($c);
        foreach($locations as $location)
        {
          $loc[]=$location->getId();
        }
    
     $c = new Criteria();
     $c->add(OpInstitutionChargePeer::INSTITUTION_ID, array(6,7,8,9,10,11), Criteria::IN);
     $c->add(OpInstitutionChargePeer::LOCATION_ID, $loc, Criteria::IN);
     $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
     $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
     $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpInstitutionChargePeer::POLITICIAN_ID);
     $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
     $this->totale = OpInstitutionChargePeer::doCount($c);
    
    $c = new Criteria();
    $c->add(OpInstitutionChargePeer::INSTITUTION_ID, array(6,7,8,9,10,11), Criteria::IN);
    $c->add(OpInstitutionChargePeer::LOCATION_ID, $loc, Criteria::IN);
    $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpInstitutionChargePeer::POLITICIAN_ID);
    $c->add(OpPoliticianPeer::SEX, $this->sex, Criteria::EQUAL);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $this->incarichi = OpPoliticianPeer::doCount($c);
  }
  
  public function executeAge()
  {
    if ($this->zona==1) $reg=array(1,2,3,4,5,6,7);
    if ($this->zona==2) $reg=array(8,9,10,11,12,13,14);
    if ($this->zona==3) $reg=array(15,16,17,18,19,20);
    if ($this->zona==4) $reg=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
       $loc=array();
        $c= new Criteria();
        $c->add(OpLocationPeer::REGIONAL_ID, $reg, Criteria::IN);
        $locations=OpLocationPeer::doSelect($c);
        foreach($locations as $location)
        {
          $loc[]=$location->getId();
        }
    
     $c = new Criteria();
     $c->add(OpInstitutionChargePeer::INSTITUTION_ID, array(6,7,8,9,10,11), Criteria::IN);
     $c->add(OpInstitutionChargePeer::LOCATION_ID, $loc, Criteria::IN);
     $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
     $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
     $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpInstitutionChargePeer::POLITICIAN_ID);
     $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
     $this->totale = OpInstitutionChargePeer::doCount($c);
    
    $c = new Criteria();
    $c->add(OpInstitutionChargePeer::INSTITUTION_ID, array(6,7,8,9,10,11), Criteria::IN);
    $c->add(OpInstitutionChargePeer::LOCATION_ID, $loc, Criteria::IN);
    $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpInstitutionChargePeer::POLITICIAN_ID);
		$criterion = $c->getNewCriterion(OpPoliticianPeer::BIRTH_DATE , (date('Y',time()) - $this->age1).'-12-31 00:00:00', Criteria::GREATER_THAN  );
		$criterion->addAnd($c->getNewCriterion(OpPoliticianPeer::BIRTH_DATE , (date('Y',time()) - $this->age2).'-12-31 00:00:00', Criteria::LESS_EQUAL ));
		$c->add($criterion);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $this->incarichi = OpPoliticianPeer::doCount($c);
  }
  
  public function executeEdu()
  {
    if ($this->zona==1) $reg=array(1,2,3,4,5,6,7);
    if ($this->zona==2) $reg=array(8,9,10,11,12,13,14);
    if ($this->zona==3) $reg=array(15,16,17,18,19,20);
    if ($this->zona==4) $reg=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
       $loc=array();
        $c= new Criteria();
        $c->add(OpLocationPeer::REGIONAL_ID, $reg, Criteria::IN);
        $locations=OpLocationPeer::doSelect($c);
        foreach($locations as $location)
        {
          $loc[]=$location->getId();
        }
    
     $c = new Criteria();
     $c->add(OpInstitutionChargePeer::INSTITUTION_ID, array(6,7,8,9,10,11), Criteria::IN);
     $c->add(OpInstitutionChargePeer::LOCATION_ID, $loc, Criteria::IN);
     $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
     $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
     $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpInstitutionChargePeer::POLITICIAN_ID);
     $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
     $this->totale = OpInstitutionChargePeer::doCount($c);
    
    $c = new Criteria();
    $c->add(OpInstitutionChargePeer::INSTITUTION_ID, array(6,7,8,9,10,11), Criteria::IN);
    $c->add(OpInstitutionChargePeer::LOCATION_ID, $loc, Criteria::IN);
    $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpInstitutionChargePeer::POLITICIAN_ID);
    $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, $this->edu, Criteria::EQUAL);
    $this->incarichi = OpPoliticianPeer::doCount($c);
  }
  
  public function executeWork()
  {
    
    if ($this->zona==1) $reg=array(1,2,3,4,5,6,7);
    if ($this->zona==2) $reg=array(8,9,10,11,12,13,14);
    if ($this->zona==3) $reg=array(15,16,17,18,19,20);
    if ($this->zona==4) $reg=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
       $loc=array();
        $c= new Criteria();
        $c->add(OpLocationPeer::REGIONAL_ID, $reg, Criteria::IN);
        $locations=OpLocationPeer::doSelect($c);
        foreach($locations as $location)
        {
          $loc[]=$location->getId();
        }
    
     $c = new Criteria();
     $c->add(OpInstitutionChargePeer::INSTITUTION_ID, array(6,7,8,9,10,11), Criteria::IN);
     $c->add(OpInstitutionChargePeer::LOCATION_ID, $loc, Criteria::IN);
     $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
     $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
     $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpInstitutionChargePeer::POLITICIAN_ID);
     $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
     $this->totale = OpInstitutionChargePeer::doCount($c);
    
    $c = new Criteria();
    $c->add(OpInstitutionChargePeer::INSTITUTION_ID, array(6,7,8,9,10,11), Criteria::IN);
    $c->add(OpInstitutionChargePeer::LOCATION_ID, $loc, Criteria::IN);
    $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpInstitutionChargePeer::POLITICIAN_ID);
    $c->add(OpPoliticianPeer::PROFESSION_ID, $this->work);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $this->incarichi = OpPoliticianPeer::doCount($c);
  }
  
  public function executeAgeSinglePolitician()
  {
    
    $c = new Criteria();
    $c->add(OpInstitutionChargePeer::INSTITUTION_ID, $this->institution_id, Criteria::IN);
    $c->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->charge_type_id, Criteria::IN);
    $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpInstitutionChargePeer::POLITICIAN_ID);
    $c->add(OpPoliticianPeer::BIRTH_DATE,NULL,Criteria::ISNOTNULL);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    if ($this->order==0)
      $c->addAscendingOrderByColumn(OpPoliticianPeer::BIRTH_DATE);
    else
      $c->addDescendingOrderByColumn(OpPoliticianPeer::BIRTH_DATE);
    $c->setLimit($this->limit);
    $this->incarichi = OpInstitutionChargePeer::doSelect($c);
  }
	

}

?>
