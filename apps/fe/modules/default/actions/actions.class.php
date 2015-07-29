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
 * default actions.
 *
 * @package    openpolis
 * @subpackage default
 * @author     Gianluca Canale
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class defaultActions extends sfActions
{
  public function executeTestData()
  {
    # code...
  }

  public function executeManutenzione()
  {
    # code...
  }

  /**
   * pagina bianca per sciopero FNSI 9 luglio 2010
   *
   * @return void
   * @author Guglielmo Celata
   */
  public function executeBlankIndex()
  {
    
  }

	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{
		// $this->setLayout('noColumnLayout');
		$this->setLayout('hpLayout');
		$this->getUser()->setCulture('it_IT');
		
		$this->donors = 0;
		$this->needed = 0;
		$this->raised = 0;
		$this->spent = 0;
				
		// fetch informazioni sulla raccolta fondi
		$funds_info = OpRequiredFundsPeer::fetch_last_record();
		if ($funds_info instanceof OpRequiredFunds)
		{
		  $this->donors = $funds_info->getDonors();
		  $this->needed = $funds_info->getNeeded();
		  $this->raised = $funds_info->getRaised();
		  $this->spent = $funds_info->getSpent();
		}
	}
  
  public function executeChoice1() {
	
		if($this->getRequestParameter('politician')=='Inserisci il cognome del politico') {	
			return $this->redirect('@homepage');		
		}
		
		if($this->getRequestParameter('politician_id')!=null) {	
			//return $this->redirect('politician/page?content_id='.$this->getRequestParameter('politician_id'));	
			$pol = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));	
			return $this->redirect('@politico_new?slug='.$pol->getSlug().'&content_id='.$pol->getContentId());		
		}
		else
		{
			$c1 = new Criteria();
			$this->words = $this->getRequestParameter('politician');
			
			$c1->Add(OpPoliticianPeer::LAST_NAME, $this->words."%", Criteria::LIKE);
			
			$c1->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
			$c1->addAscendingOrderByColumn(OpPoliticianPeer::FIRST_NAME);
			$pager = new sfPropelPager('OpPolitician', sfConfig::get('app_pagination_limit'));
    		$pager->setCriteria($c1);
			$pager->setPeerMethod('doSelect');
    		$pager->setPage($this->getRequestParameter('page', 1));
    		$pager->init();
    		$this->pager = $pager;
			
			//se ho un solo politico vado subito alla sua pagina
			if($this->pager->getNbResults() == 1)
			{
				$this->politician = $this->pager->getCurrent();
				return $this->redirect('@politico_new?slug='.$this->politician->getSlug().'&content_id='.$this->politician->getContentId());	
				//return $this->redirect('politician/page?content_id='.$this->politician->getContentId());
			}
		}
	}
	
	public function executeError404()
	{
  	$this->setLayout('noColumnLayout');
		return sfView::SUCCESS;
	}
	
	
	public function handleErrorChoice1()
  	{
    	$this->setTemplate('index');
		  return sfView::SUCCESS;
  	}

	public function executeSelectPoliticianLocation() {

		if($this->getRequestParameter('location_id') != null)	
		{
			$loc = OpLocationPeer::retrieveByPk( $this->getRequestParameter('location_id') );
			return $this->redirect('@localita?slug='. $loc->getSlug().'&location_id='.$loc->getId() );
		}
			//return $this->redirect('politician/forlocation?location_id='.$this->getRequestParameter('location_id'));		
	}

	
	public function executeChoice2()
	{
	
		if($this->getRequestParameter('location')=='Inserisci il tuo comune di residenza' || 
		   $this->getRequestParameter('location') == '') {	
			return $this->redirect('@homepage');		
		}
		

	  if (!$this->hasRequestParameter('location_id') || $this->getRequestParameter('location_id') == '')
	  {
	    // a questo punto so che la location e' univoca
      $c = new Criteria();
      $c->add(OpLocationPeer::NAME, $this->getRequestParameter('location'));
      $c->add(OpLocationTypePeer::NAME, 'comune');
      $c->addJoin(OpLocationPeer::LOCATION_TYPE_ID, OpLocationTypePeer::ID);
      $location = OpLocationPeer::doSelectOne($c);
      $location_id = $location->getId();
    } else
	    $location_id = $this->getRequestParameter('location_id');
		$loc = OpLocationPeer::retrieveByPk( $location_id );
		return $this->redirect('@localita?slug='. $loc->getSlug().'&location_id='.$loc->getId() );
		//return $this->redirect('politician/forlocation?location_id='.$location_id);		      

	}

	
	public function handleErrorChoice2()
  {
		return $this->redirect('@homepage');		
		
  }

	public function executeChoice3() 
	{

		if($this->getRequestParameter('location')=='Inserisci il comune' || 
		   $this->getRequestParameter('location') == 'location') {	
			return $this->redirect('@politici_new#comune');		
		}		

	  if (!$this->hasRequestParameter('location_id') || $this->getRequestParameter('location_id') == '')
	  {
	    // a questo punto so che la location e' univoca
      $c = new Criteria();
      $c->add(OpLocationPeer::NAME, $this->getRequestParameter('location'));
      $c->add(OpLocationTypePeer::NAME, 'comune');
      $c->addJoin(OpLocationPeer::LOCATION_TYPE_ID, OpLocationTypePeer::ID);
      $location = OpLocationPeer::doSelectOne($c);
      $location_id = $location->getId();
    } else
	    $location_id = $this->getRequestParameter('location_id');
		$loc = OpLocationPeer::retrieveByPk( $location_id );
		return $this->redirect('@comune_new?slug='. $loc->getSlug().'&location_id='.$location_id);		

  }

	public function handleErrorChoice3()
  {
		return $this->redirect('@politici_new#comune');		
  }
	
	/**
	* Executes location_autocomplete action
	* query per la lista delle località per la
	* funzione di autocompletamento
	*/
  	public function executeLocation_autocomplete2() {
		
		$this->locations = myCustom::custom2($this->getRequestParameter('location2'), true);
	}
	
	public function executeChoice4() {
	
		if($this->getRequestParameter('politician')=='Inserisci il cognome del politico') {	
			return $this->redirect('@politici_new');		
		}
		
		$this->setTemplate('choice1');
		
		if($this->getRequestParameter('politician_id')!=null) {	
			//return $this->redirect('politician/page?content_id='.$this->getRequestParameter('politician_id'));
			$pol = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));		
			return $this->redirect('@politico_new?slug='.$pol->getSlug().'content_id='. $this->getRequestParameter('politician_id') );
		}
		else
		{
			//$this->politicians = myCustom::custom1($this->getRequestParameter('politician'), false);
			$this->words=explode(' ',$this->getRequestParameter('politician'));
						
			$c1 = new Criteria();
			if (count($this->words)==1)
			{
				$c1->Add(OpPoliticianPeer::LAST_NAME, "%".$this->getRequestParameter('politician')."%", Criteria::LIKE);
			}
			else
			{
				$i=0;
				foreach($this->words as $word)
				{
					if($i==0)
					{
						$criterion = $c1->getNewCriterion(OpPoliticianPeer::LAST_NAME, "%".$word."%", Criteria::LIKE);
						$i++;
					}
					else
					{
						$criterion->addOr($c1->getNewCriterion(OpPoliticianPeer::LAST_NAME, "%".$word."%", Criteria::LIKE));
					}
				}
				$c1->add($criterion);
			
			}	
		    $c1->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
			$pager = new sfPropelPager('OpPolitician', sfConfig::get('app_pagination_limit'));
    		$pager->setCriteria($c1);
			$pager->setPeerMethod('doSelect');
    		$pager->setPage($this->getRequestParameter('page', 1));
    		$pager->init();
    		$this->pager = $pager;
			
			//se ho un solo politico vado subito alla sua pagina
			if($this->pager->getNbResults() == 1)
			{
				$this->politician = $this->pager->getCurrent();
				//return $this->redirect('politician/page?content_id='.$this->politician->getContentId());
				return $this->redirect('@politico_new?content_id='. $this->politician->getContentId() . '&slug='. $this->politician->getSlug() );
			}
		}
	}
	
	public function handleErrorChoice4()
  	{
		$this->forward('default', 'politiciansHome');
  	}
	
	public function executeChoice5() {
	
		if($this->getRequestParameter('location')=='Inserisci il TUO comune di residenza') {	
			return $this->redirect('@politici_new');		
		}
	
		$this->setTemplate('choice2');
		
		if($this->getRequestParameter('location_id')!=null) {	
			//return $this->redirect('politician/forlocation?location_id='.$this->getRequestParameter('location_id'));
			$loc = OpLocationPeer::retrieveByPk( $this->getRequestParameter('location_id') );
			return $this->redirect('@localita_new?slug='. $loc->getSlug() .'&location_id='.$this->getRequestParameter('location_id'));		
		}
		else
		{
			//$this->locations = myCustom::custom2($this->getRequestParameter('location'), false);
			$c1 = new Criteria();
			$c1->Add(OpLocationPeer::CITY_ID,'',Criteria::NOT_EQUAL);
			$c1->Add(OpLocationPeer::LOCATION_TYPE_ID,'6');
			$c1->Add(OpLocationPeer::NAME, $this->getRequestParameter('location')."%", Criteria::LIKE);
			$c1->addAscendingOrderByColumn(OpLocationPeer::NAME);
			$pager = new sfPropelPager('OpLocation', sfConfig::get('app_pagination_limit'));
    		$pager->setCriteria($c1);
			$pager->setPeerMethod('doSelect');
    		$pager->setPage($this->getRequestParameter('page', 1));
    		$pager->init();
    		$this->pager = $pager;
			
			//se ho una sola località vado subito alla sua pagina
			if($this->pager->getNbResults() == 1)
			{
				$this->location = $this->pager->getCurrent();
				//return $this->redirect('politician/forlocation?location_id='.$this->location->getId());
				return $this->redirect('@localita_new?slug='. $this->location->getSlug() .'&location_id='.$this->location->getId());
			}
		}
	}
	
	public function handleErrorChoice5()
  	{
    	$this->forward('default', 'politiciansHome');
  	}
		
    
  	public function executeProvincials() {
		
		$this->provincials = new OpLocation();
		$this->provincials = OpLocationPeer::getProvincials($this->getRequestParameter('id'));	
	}
	
	public function executeMunicipals() {
		
		$this->comuns = new OpLocation();
		$this->comuns = OpLocationPeer::getComuns($this->getRequestParameter('id'));	
	}
	
	public function executePoliticiansHome()
	{
		$this->setLayout('politiciansLayout');
		$this->response->setTitle('Tutti i politici italiani');
        $this->response->addMeta('description', "Cerca tutti i politici italiani eletti dal più piccolo comune fino al Parlamento Europeo.");
		
		//numero comm europei
		$c = new Criteria();
		$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CE'), Criteria::EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$this->numero_commissari_europei = OpInstitutionChargePeer::doCount($c);
		
		//numero parlam europei
		$c = new Criteria();
		$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_PE'), Criteria::EQUAL);
		$c->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_deputato'), Criteria::EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$this->numero_parlamentari_europei = OpInstitutionChargePeer::doCount($c);
		
		//num membri gov it 
		$c = new Criteria();
		$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GI'), Criteria::EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$this->numero_membri_governo = OpInstitutionChargePeer::doCount($c);
		
		//num senatori
		$c = new Criteria();
		$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_SR'), Criteria::EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$cton1 = $c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore'), Criteria::EQUAL);
		$cton2 = $c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore_vita'), Criteria::EQUAL);
		$cton1->addOr($cton2);
		$c->add($cton1);
		$this->numero_senatori = OpInstitutionChargePeer::doCount($c);
		
		//num deputati
		$c = new Criteria();
		$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CD'), Criteria::EQUAL);
		$c->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_deputato'), Criteria::EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$this->numero_deputati = OpInstitutionChargePeer::doCount($c);
		
		//num membri regionali
		$c = new Criteria();
		$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GR'), Criteria::EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$this->numero_membri_giunte_regionali = OpInstitutionChargePeer::doCount($c);
		
		$c = new Criteria();
		$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CR'), Criteria::EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$this->numero_membri_consigli_regionali = OpInstitutionChargePeer::doCount($c);
		
		//num membri provinciali
		$c = new Criteria();
		$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GP'), Criteria::EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$this->numero_membri_giunte_provinciali = OpInstitutionChargePeer::doCount($c);
		
		$c = new Criteria();
		$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CP'), Criteria::EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$this->numero_membri_consigli_provinciali = OpInstitutionChargePeer::doCount($c);
		
		//num membri comunali
		$c = new Criteria();
		$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_GC'), Criteria::EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$this->numero_membri_giunte_comunali = OpInstitutionChargePeer::doCount($c);
		
		$c = new Criteria();
		$c->Add(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CC'), Criteria::EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->AddJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$this->numero_membri_consigli_comunali = OpInstitutionChargePeer::doCount($c);
		
		//elenco regioni
		$this->regions = new OpLocation();
		$this->regions = OpLocationPeer::getRegions();
		
		//elenco provincie
		$c=new Criteria();
		$c->Add(OpLocationPeer::LOCATION_TYPE_ID, sfConfig::get('app_location_type_id_provincial'));
		$c->Add(OpLocationPeer::NAME,'', CRITERIA::NOT_EQUAL);
		$c->addAscendingOrderByColumn(OpLocationPeer::NAME);
		$this->provincials = OpLocationPeer::doSelect($c);
	
	}
	
	public function executeForm()
	{
	
	
	}
	
	public function executeSearchForm1()
	{
	
	}
	
	public function executeSearchForm2()
	{
	
	}
	
	public function executeSearchForm3()
	{
	
	}
}
?>
