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
// auto-generated by sfPropelCrud
// date: 2006/08/10 12:52:42
?>
<?php

/**
 * politician actions.
 *
 * @package    openpolis
 * @subpackage politician
 * @author     Gianluca Canale
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class politicianActions extends sfActions
{
	/**************************************/
  	public function executeIndex ()
  	{
    	return $this->forward('politician', 'list');
  	}
	
	/**************************************/
  	public function executeList ()
  	{
		$pager = new sfPropelPager('OpPolitician', 25);
		$c = new Criteria();
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->setPeerMethod('doSelect');
		$pager->init();
	
		$this->op_politician_pager = $pager;
  	}

	/**************************************/
  	public function executePage ()
  	{
		$requestId = $this->getRequestParameter('content_id');
		$requestSlug = $this->getRequestParameter('slug');
	
        $this->op_politician = OpPoliticianPeer::retrieveByPk( $requestId );
    	
		$this->forward404Unless($this->op_politician );
		// controllo se lo slug � corretto
		if ( $requestId AND $requestSlug )
		{
			$this->forward404Unless( $this->op_politician->getSlug() == strtolower(urlencode($this->getRequestParameter('slug'))) );
		}
		        
		$this->response->setTitle('Gli incarichi e le dichiarazioni di '.$this->op_politician->getFirstName().' '.$this->op_politician->getLastName().' | '.'openpolis');
		$this->response->addMeta('description','Le cariche elettive attuali e passate, gli incarichi di partito, contatti e recapiti, le dichiarazioni di '.$this->op_politician->getFirstName().' '.$this->op_politician->getLastName(),true);
		
		//seleziono le risorse pubblicate
		$c=new Criteria();
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$this->resources = $this->op_politician->getOpResourcessJoinOpOpenContent($c);
				
		//seleziono le cariche istituzionali attuali pubblicate
		$c2=new Criteria();
		$c2->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$c2->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c2->addDescendingOrderByColumn(OpInstitutionChargePeer::DATE_START);
		$this->institution_charges = $this->op_politician->getOpInstitutionChargesJoinOpOpenContent($c2);
		
		//seleziono le cariche istituzionali passate pubblicate
		$c2bis=new Criteria();
		$c2bis->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$c2bis->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::NOT_EQUAL);
		$c2bis->addDescendingOrderByColumn(OpInstitutionChargePeer::DATE_END);
		$this->past_institution_charges = $this->op_politician->getOpInstitutionChargesJoinOpOpenContent($c2bis);
		
		$this->ist_count = count($this->institution_charges) + count($this->past_institution_charges);
		
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
		
		$this->pol_count = count($this->political_charges) + count($this->past_political_charges);
		
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
		
		$this->org_count = count($this->organization_charges) + count($this->past_organization_charges);
				    	
		//seleziono le dichiarazioni pubblicate
		$c5=new Criteria();
		$c5->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$this->declarations = $this->op_politician->getOpDeclarationsJoinOpOpenContent($c5);
			
	}

	/**************************************/
  	public function executeCreate ()
  	{
    	$this->politician = new OpPolitician();
		$this->hasLayout = $this->getRequestParameter('has_layout');
		$this->setLayout('politiciansLayout');
    	$this->setTemplate('edit');
  	}

	/**************************************/
  	public function executeShow ()
  	{
    	$this->hasLayout = $this->getRequestParameter('has_layout');
    	$this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('content_id'));
    	$this->forward404Unless($this->politician);
  	}
  
  	/**************************************/
  	public function executeEdit ()
  	{
    	// check if decorator must be turned off
    	$this->hasLayout = $this->getRequestParameter('has_layout');
		$this->setLayout('politiciansLayout');
    	$this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('content_id'));
    	$this->forward404Unless($this->politician);
		
		$c = new Criteria();
			$c->Add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $this->getRequestParameter('content_id'), Criteria::EQUAL);
			$education_level_flag = OpPoliticianHasOpEducationLevelPeer::doSelectOne($c);
			if($education_level_flag)
			{
				$this->education_level = $education_level_flag;
			}else{
				$this->education_level = new OpPoliticianHasOpEducationLevel;
			}
		
		$c = new Criteria();
		$c->add(OpEducationLevelPeer::OID, null, Criteria::EQUAL);
		$c->addAscendingOrderByColumn(OpEducationLevelPeer::DESCRIPTION);
		$this->education_list = OpEducationLevelPeer::doSelect($c);
		
		$c = new Criteria();
		$c->add(OpProfessionPeer::OID, null, Criteria::EQUAL);
		$c->addAscendingOrderByColumn(OpProfessionPeer::ODESCRIPTION);
		$this->profession_list = OpProfessionPeer::doSelect($c);
  	}

	/**************************************/
  	public function executeUpdate ()
  	{
    	$this->hasLayout = $this->getRequestParameter('has_layout');
    	if (!$this->getRequestParameter('content_id'))
    	{
      		$op_politician = new OpPolitician();
    	}
    	else
    	{
      		$op_politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('content_id'));
      		$this->forward404Unless($op_politician);
    	}
		
    	$op_politician->setContentId($this->getRequestParameter('content_id'));
    	$profession_id = 1;
    	if ($this->getRequestParameter('profession_id') != 0)
    	  $profession_id = $this->getRequestParameter('profession_id');
    	$op_politician->setProfessionId( $profession_id );
    	$op_politician->setUserId($this->getRequestParameter('user_id'));
    	$op_politician->setFirstName($this->getRequestParameter('first_name'));
    	$op_politician->setLastName($this->getRequestParameter('last_name'));
    	
		//inserimento livello istruzione
		if($this->getRequestParameter('content_id'))
		{
			$pol_id = $this->getRequestParameter('content_id');
		}else{
			$pol_id = $op_politician->getContentId();
		}
		
		//verifico se � gia presente un livello d'istruzione
		$c = new Criteria();
		$c->Add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $pol_id, Criteria::EQUAL);
		$education_level = OpPoliticianHasOpEducationLevelPeer::doSelectOne($c);
		
		$education_level_id = '';
		$description = '';
		
		if($education_level)
		{
			//memorizzo le informazioni del record presente
			$education_level_id = $education_level->getEducationLevelId();
			$description = $education_level->getDescription();
		}	
		
		if($education_level_id!=$this->getRequestParameter('education_level') || $description!=$this->getRequestParameter('description'))
		{
			if($education_level)
			{
				$education_level->delete();
			}
			
			$education_level = new OpPoliticianHasOpEducationLevel;
			
			if($education_level_id!=$this->getRequestParameter('education_level'))
			{
				$education_level->setEducationLevelId($this->getRequestParameter('education_level'));
			}
			else
			{
				$education_level->setEducationLevelId($education_level_id);	
			}
			
			if($description!=$this->getRequestParameter('description'))
			{
				$education_level->setDescription($this->getRequestParameter('description'));
			}
			else
			{
				$education_level->setDescription($description);	
			}
			
			$education_level->setPoliticianId($pol_id);
			$education_level->save();		
		}	
				
		
		if($this->getRequestParameter('delete') == '1')
		{
			$op_politician->setPicture();
		}
		
		if($_FILES['picture_file']['tmp_name']!='')
		{
			$op_politician->setPicture($_FILES['picture_file']['tmp_name']);
		}
		
    	if ($this->getRequestParameter('birth_date'))
    	{
      		list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('birth_date'), $this->getUser()->getCulture());
      		$op_politician->setBirthDate("$y-$m-$d");
    	}
		
		if ($this->getRequestParameter('check_for_death', NULL))
		{
			list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('death_date'), $this->getUser()->getCulture());
      		$op_politician->setDeathDate("$y-$m-$d");
    }
		else
		{
			$op_politician->setDeathDate(NULL);
		}
		
		$this->birth_location=OpLocationPeer::RetrieveByPk($this->getRequestParameter('location_id'));
		if ($this->getRequestParameter('location_id') != '')
		{
			$location = $this->birth_location->getName()."(".$this->birth_location->getProv().")";
		}
		else
		{
			$location = $this->getRequestParameter('location');	
		}		
		
		$op_politician->setBirthLocation($location);
		
    $op_politician->save();

		return $this->redirect('@politico_new?content_id='.$op_politician->getContentId().'&slug='. $op_politician->getSlug());
		
  	}
	
	/**************************************/
	public function handleErrorUpdate()
  	{
		if (!$this->getRequestParameter('content_id'))
    	{
      		$this->politician = new OpPolitician();
    	}
    	else
    	{
      		$this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('content_id'));
      	}
		
		$c = new Criteria();
		$c->Add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $this->getRequestParameter('content_id'), Criteria::EQUAL);
		$education_level_flag = OpPoliticianHasOpEducationLevelPeer::doSelectOne($c);
		if($education_level_flag)
		{
			$this->education_level = $education_level_flag;
		}else{
			$this->education_level = new OpPoliticianHasOpEducationLevel;
		}
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn(OpEducationLevelPeer::DESCRIPTION);
		$this->education_list = OpEducationLevelPeer::doSelect($c);
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn(OpProfessionPeer::DESCRIPTION);
		$this->profession_list = OpProfessionPeer::doSelect($c);
		
		$this->hasLayout = 'true';
		$this->mode = 'add';
		
		$this->setTemplate('edit');
		$this->setLayout('politiciansLayout');
		return sfView::SUCCESS;
	}

	/**************************************/
  	public function executeDelete ()
  	{
    	$op_politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('content_id'));
    	$this->forward404Unless($op_politician);

    	$op_politician->delete();
    	return $this->redirect('politician/list');
  	}
  
	/**************************************/
  	public function executePicture ()
  	{
		$op_politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('content_id'));
    	$this->forward404Unless($op_politician);
    	$this->picture = $op_politician->getPicture();
    }
  
  	/**************************************/
	  public function executeRegPoliticians()
  	{
	    //ricerca informazioni location selezionata 
      $this->location = OpLocationPeer::retrieveByPK($this->getRequestParameter('location_id'));
	    $this->forward404Unless($this->location);
	  
      //$this->response->setTitle('Regione '.$this->location->getName().' | politici | openpolis');
      $this->response->setTitle('Regione '.$this->location->getName().' - Presidente e Amministrazione regionale');
	  //$this->response->addMeta('description','La lista degli assessori e consiglieri, le loro carriere politiche, la composizione di giunta e consiglio della regione '.$this->location->getName(),true);
	  $this->response->addMeta('description', 'Il Presidente, gli Assessori ed i Consiglieri della Regione '.$this->location->getName().' con l\'appartenenza politica delle ultime elezioni regionali.');
  	}  


	  /**************************************/
	  public function executeProvPoliticians()
  	{
	    //ricerca informazioni location selezionata 
  	  $c = new Criteria();
	    $c->Add(OpLocationPeer::ID, $this->getRequestParameter('location_id'), Criteria::EQUAL);
	    $c->Add(OpLocationPeer::LOCATION_TYPE_ID, sfConfig::get('app_location_type_id_provincial'), Criteria::EQUAL);
  	  $this->location = OpLocationPeer::doSelectOne($c);
	    $this->forward404Unless($this->location);
	  
	    //$this->response->setTitle('Provincia '.$this->location->getName().' | politici | openpolis');	
	    $this->response->setTitle('Provincia '.$this->location->getName().' - Presidente e Amministrazione provinciale');
	    //$this->response->setTitle('Componenti la Giunta e il Consiglio della provincia di '.$this->location->getName().' | openpolis');
	    //$this->response->addMeta('description','La lista degli amministratori locali, le loro carriere politiche, la composizione di giunta e consiglio della provincia di '.$this->location->getName(),true);
		$this->response->addMeta('description','Il Presidente, gli Assessori ed i Consiglieri della Provincia '.$this->location->getName().' con l\'appartenenza politica delle ultime elezioni provinciali',true);
	
  	}
	
	  /**************************************/
	  public function executeMunPoliticians()
  	{
	    //ricerca informazioni location selezionata 
  	  $c = new Criteria();
	    $c->Add(OpLocationPeer::ID, $this->getRequestParameter('location_id'), Criteria::EQUAL);
	    $c->Add(OpLocationPeer::LOCATION_TYPE_ID, sfConfig::get('app_location_type_id_municipal'), Criteria::EQUAL);
  	  $this->location = OpLocationPeer::doSelectOne($c);
	    $this->forward404Unless($this->location);
	  
	    //determinazione della provincia (mi serve l'id della provincia intesa come citt�)
      $c1= new Criteria();
      $c1->Add(OpLocationPeer::PROVINCIAL_ID, $this->location->getProvincialId());
      $c1->Add(OpLocationPeer::LOCATION_TYPE_ID, sfConfig::get('app_location_type_id_provincial'));
      $this->prov = OpLocationPeer::doSelectOne($c1);
		
      //determinazione della regione
      $c3= new Criteria();
      $c3->Add(OpLocationPeer::REGIONAL_ID, $this->prov->getRegionalId());
      $c3->Add(OpLocationPeer::LOCATION_TYPE_ID, sfConfig::get('app_location_type_id_region'));
      $this->region = OpLocationPeer::doSelectOne($c3);
	  
	    //$this->response->setTitle('Componenti la Giunta e il Consiglio del comune di '.$this->location->getName().' ('.$this->location->getProv().')'.' | openpolis');
	    //$this->response->addMeta('description','La lista degli amministratori locali, le loro carriere politiche, la composizione di giunta e consiglio del comune di '.$this->location->getName().' ('.$this->location->getProv().')',true);
	
		$this->response->setTitle('Comune di '.$this->location->getName().' ('.$this->location->getProv().')'.' - Sindaco e Amministrazione comunale');
	    $this->response->addMeta('description','Il Sindaco, gli Assessori ed i Consiglieri del comune di '.$this->location->getName().' ('.$this->location->getProv().')'.' con l\'appartenenza politica delle ultime elezioni comunali.',true);
  	}


	/**************************************/
	public function executeForlocation()
  	{
		// ricerca informazioni location selezionata 
		$this->location = OpLocationPeer::retrieveByPK($this->getRequestParameter('location_id'));
		$this->forward404Unless($this->location);
		
		// determinazione della provincia
		$this->prov = $this->location->getProvincia();
		
		// determinazione della regione
		$this->region = $this->location->getRegione();
		
		$this->response->setTitle($this->location->getName().' ('.$this->location->getProv().')'.' | politici | openpolis');
		
		// determinazione rappresentanza in europarlamento
		$this->europarlamento = $this->location->getRappresentanzaEuroparlamento($this->prov->getId());
		
		// determinazione rappresentanza alla camera
		$this->camera = $this->location->getRappresentanzaCamera($this->prov->getId());
		
		// determinazione rappresentanza al senato
		$this->senato = $this->location->getRappresentanzaSenato($this->prov->getId());
		
		//determinazione degli eletti alla regione
		$this->regione = $this->location->getRappresentanzaRegione($this->region->getId());
		
		//determinazione degli eletti alla provincia
		$this->provincia = $this->location->getRappresentanzaProvincia($this->prov->getId());

		//determinazione degli eletti al comune
		$this->comune = $this->location->getRappresentanzaComune();
		
 		$this->n_totale_rappresentanti = 
 		   $this->europarlamento['n_rappresentanti'] + $this->camera['n_rappresentanti'] + $this->senato['n_rappresentanti'] +
 		   $this->regione['n_rappresentanti'] + $this->provincia['n_rappresentanti'] + $this->comune['n_rappresentanti'];
		
		 $this->response->setTitle('Chi sono i politici eletti in tutte le istituzioni dai cittadini del comune di '.$this->location->getName().' ('.$this->location->getProv().')'.' | openpolis');
	   $this->response->addMeta('description','La lista dei parlamentari europei, di quelli italiani, di assessori e consiglieri regionali, provinciali e comunali eletti dai cittadinini del comune di '.$this->location->getName().' ('.$this->location->getProv().')',true);	
	}

	/**************************************/
	public function executeForinstitution()
  	{
		$this->inst = OpInstitutionPeer::RetrieveByPk($this->getRequestParameter('id'));
		$this->forward404Unless($this->inst);
		
		$this->processSort();
		
		$c1 = new Criteria();
		// aggiungere i casi per tutte le istituzioni
		switch ($this->getRequestParameter('id')) {
			case sfConfig::get('app_institution_id_CE'):
			case sfConfig::get('app_institution_id_PE'):
				$this->title = "Parlamento europeo"; // - i parlamentari italiani in carica";
				$this->response->addMeta('description', 'I parlamentari europei eletti in Italia con l\'appartenenza politica delle ultime elezioni europee.');
				
				$c = new Criteria();
				$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CE'), Criteria::EQUAL);
				$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
				$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
				$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
				$this->commissari_europei = OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpPoliticianAndOpGroupAndOpChargeType($c);
				
				$c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_PE'));
				$c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_deputato'));
			break;	
			
			case sfConfig::get('app_institution_id_GI'):
				$c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GI'));
				$c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_pres_consiglio'), Criteria::NOT_IN);
				$c2 = new Criteria();
				$c2->Add(OpInstitutionPeer::ID, $this->getRequestParameter('id'));
				$institution = OpInstitutionPeer::doSelectOne($c2);
				$this->title = $institution->getName();
				$this->response->addMeta('description', 'Il Presidente del Consiglio, i Ministri, Vicemistri e i Sottosegretari del Governo italiano.');
				
			break;
			
			case sfConfig::get('app_institution_id_SR'): 
				$c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_SR'));
				//$c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore'));		
				$cton1 = $c1->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore'), Criteria::EQUAL);
		        $cton2 = $c1->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore_vita'), Criteria::EQUAL);
		        $cton1->addOr($cton2);
		        $c1->add($cton1);
				$c2 = new Criteria();
				$c2->Add(OpInstitutionPeer::ID, $this->getRequestParameter('id'));
				$institution = OpInstitutionPeer::doSelectOne($c2);
				$this->title = $institution->getName(); // .' - i senatori in carica';
				$this->response->addMeta('description', 'Il Presidente del Senato e tutti i senatori');
				
			break;	
			
			case sfConfig::get('app_institution_id_CD'):	
				$c1->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CD'));
				$c1->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_deputato'));	
				$c2 = new Criteria();
				$c2->Add(OpInstitutionPeer::ID, $this->getRequestParameter('id'));
				$institution = OpInstitutionPeer::doSelectOne($c2);
				$this->title = $institution->getName(); // .' - i deputati in carica';
				
				$this->response->addMeta('description', 'Il Presidente della Camera e tutti i deputati');
			break;
			
			default:
				$this->title = "";
		}
		$this->response->setTitle(ucfirst(strtolower($this->title))." | politici | openpolis");
		$c1->Add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c1->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c1->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		 
		$this->addSortCriteria($c1);
 		
		$pager = new sfPropelPager('OpInstitutionCharge', sfConfig::get('app_pagination_limit'));
    	$pager->setCriteria($c1);
		
		if($this->getRequestParameter('id')==sfConfig::get('app_institution_id_GI'))
		{
			$pager->setPeerMethod('doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty');
		}
		else
		{
			$pager->setPeerMethod('doSelectJoinOpPoliticianAndOpPoliticianAndOpGroupAndOpChargeType');
		}		
		
    	$pager->setPage($this->getRequestParameter('page', 1));
    	$pager->init();
    	$this->pager = $pager;
	}

	/**************************************/	
	protected function processSort ()
  	{
  		if ($this->getRequestParameter('sort'))
		{
		  	$this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'fe/forinstitution/sort');
		  	$this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'fe/forinstitution/sort');
		}
		else
		{
			if($this->getRequestParameter('id')==sfConfig::get('app_institution_id_GI'))
			{
				$this->getUser()->setAttribute('sort', 'priority', 'fe/forinstitution/sort');
		  		$this->getUser()->setAttribute('type', 'asc', 'fe/forinstitution/sort');
			}
			else
			{	
				$this->getUser()->setAttribute('sort', 'last_name', 'fe/forinstitution/sort');
		  		$this->getUser()->setAttribute('type', 'asc', 'fe/forinstitution/sort');
			}
		}
  	}
	
	protected function addSortCriteria (&$c)
  	{
		if ($sort_column = $this->getUser()->getAttribute('sort', NULL, 'fe/forinstitution/sort'))
		{
			switch($this->getUser()->getAttribute('sort', NULL, 'fe/forinstitution/sort'))
			{
			 	case 'last_name':
					$sort_column = OpPoliticianPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
				break;
				
				case 'acronym':
					$sort_column= 'name'; //rimuovere nel caso di acronimo
					$sort_column = OpGroupPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
				break;
				
				case 'name':
					$sort_column = OpConstituencyPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
				break;
				
				case 'priority':
					$sort_column = OpChargeTypePeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
				break;
				
				case 'party_name':
					$sort_column= 'name';
					$sort_column = OpPartyPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
				break;
			}
			
			if ($this->getUser()->getAttribute('type', NULL, 'fe/forinstitution/sort') == 'asc')
			{
				$c->addAscendingOrderByColumn($sort_column);
				$c->addAscendingOrderByColumn(OpPoliticianPeer::translateFieldName('last_name', BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME));
			}
			else
			{
				$c->addDescendingOrderByColumn($sort_column);
				$c->addAscendingOrderByColumn(OpPoliticianPeer::translateFieldName('last_name', BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME));
			}		  
		}
  	}
 
  	/**************************************/
  	public function executeModalform()
  	{
  		
  	}
	   
   	/**************************************/
	public function executeReportForm()
	{
		$this->user_id=$this->getRequestParameter('user_id');
		$this->content_id=$this->getRequestParameter('content_id');
		$this->opContent = OpContentPeer::RetrieveByPk($this->content_id);
		$this->forward404Unless($this->opContent);
		
		$c=new Criteria();
		switch($this->opContent->getOpClass())
		{
			case 'OpResources':
				$c->Add(OpResourcesPeer::CONTENT_ID, $this->content_id);
				$this->content=OpResourcesPeer::DoSelectOne($c);
				break;
			
			case 'OpInstitutionCharge':
				$c->Add(OpInstitutionChargePeer::CONTENT_ID, $this->content_id);
				$this->content=OpInstitutionChargePeer::DoSelectOne($c);
				break;
			
			case 'OpPoliticalCharge':
				$c->Add(OpPoliticalChargePeer::CONTENT_ID, $this->content_id);
				$this->content=OpPoliticalChargePeer::DoSelectOne($c);
				break;
			
			case 'OpOrganizationCharge':
				$c->Add(OpOrganizationChargePeer::CONTENT_ID, $this->content_id);
				$this->content=OpOrganizationChargePeer::DoSelectOne($c);
				break;
			
			case 'OpDeclaration':
				$c->Add(OpDeclarationPeer::CONTENT_ID, $this->content_id);
				$this->content=OpDeclarationPeer::DoSelectOne($c);
				break;				
		}		
		
		$this->pol_id=$this->getRequestParameter('politician_id');
		
		$this->politician=OpPoliticianPeer::RetrieveByPk($this->pol_id);
		
		$c = new Criteria();
		$c->Add(OpReportPeer::USER_ID, $this->user_id, Criteria::EQUAL);
		$c->Add(OpReportPeer::CONTENT_ID, $this->content_id, Criteria::EQUAL);
		$report=OpReportPeer::doSelectOne($c);
		
		$this->notes='';
		$this->report_type='';
		
		if($report)
		{ 
			$this->notes=$report->getNotes();
			$this->report_type=$report->getReportType();
		}
		$this->setLayout('politiciansLayout');		
	}
	
	
	
	/**************************************/
	public function executeReport()
  	{
    	$user_id=$this->getRequestParameter('user_id');
  		$content_id=$this->getRequestParameter('content_id');
  		$this->politician_id = $this->getRequestParameter('politician_id');
	
  		switch($this->getRequestParameter('report_type'))
  		{
  			case '2': 
  				$report_type='o';
  				break;
  			case '3': 
  				$report_type='s';
  				break;	
  			default:
  				$report_type='e';	
  				break; 
  		}
		
  		$notes=$this->getRequestParameter('notes');
		
  		//verifico se l'utente ha gi� inviato il report in precedenza
  		$report = OpReportPeer::RetrieveByPk($user_id, $content_id);
  		if (!$report instanceof OpReportPeer)
  		{
  			//creazione report
  			$report=new OpReport();
  			$report->setUserId($user_id);
  			$report->setContentId($content_id);
  		}
  		
  		// set del tipo di report e delle note testuali
			$report->setReportType($report_type);
			$report->setNotes($notes);
			$report->save();	

      // invia la notifica solamente se ci sono adopter
      $adopters_ids = OpAdoptionPeer::getAdoptersForPolitician($this->politician_id);
      if (count($adopters_ids))
    	  $raw_email = $this->sendEmail('mail', 'sendReportNotification');
		
			
  		//return $this->redirect('politician/page?content_id='.$politician_id);
  	}

	/**************************************/
	public function executeDontFind()
  {
		$this->location_id=$this->getRequestParameter('location_id', NULL);
	}
	
	/**************************************/
	public function executeDontFindNotification()
  {
  	$raw_email = $this->sendEmail('mail', 'sendDontFindNotification');
	}
	
	/**************************************/
	public function handleErrorDontFindNotification()
  	{
		$this->location_id=$this->getRequestParameter('location_id', NULL);
		
		$this->setTemplate('dontFind');
		return sfView::SUCCESS;
	}
	
	public function executeAnagraficalReport()
	{
	  $this->user_id = $this->getRequestParameter('user_id');
	  $this->content_id = $this->getRequestParameter('content_id');
	  $this->politician_id = $this->getRequestParameter('politician_id');
	}	
	
	public function executeListTaxDeclaration()
	{
	  $this->response->setTitle('Le dichiarazioni patrimoniali dei politici | '.'openpolis');
	  $this->response->addMeta('description','Le dichiarazioni patrimoniali e le spese elettorali dei politici e dei parlamentari',true);
	  $array=array();
	  $c= new Criteria();
	  $c->addJoin(OpTaxDeclarationPeer::POLITICIAN_ID,OpPoliticianPeer::CONTENT_ID);
          $c->addJoin(OpPoliticianPeer::CONTENT_ID,OpInstitutionChargePeer::POLITICIAN_ID);
          $c->addJoin(OpOpenContentPeer::CONTENT_ID,OpInstitutionChargePeer::CONTENT_ID);
          $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::ISNULL);
          $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::ISNULL);
          $c->add(OpInstitutionChargePeer::INSTITUTION_ID, array(4,5) , Criteria::IN);
          $c->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, array(5,6) , Criteria::IN);
          //$c->add(OpTaxDeclarationPeer::YEAR, 2013);
	  $c->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
	  $c->addDescendingOrderByColumn(OpTaxDeclarationPeer::YEAR);
	  $taxs=OpTaxDeclarationPeer::doSelect($c);
	  foreach($taxs as $tax)
	  {
	    $add=array($tax->getYear(),$tax->getUrl());
	    if (array_key_exists($tax->getPoliticianId(),$array))
	      $array[$tax->getPoliticianId()]=array_merge((array)$array[$tax->getPoliticianId()],(array)$add);
	    elseif ($tax->getYear()==2014)
	      $array[$tax->getPoliticianId()]=$add;
	  }
	  $this->taxs=$array;
	  $this->cnt=count($array);
	}	
}
?>