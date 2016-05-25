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

require_once 'lib/model/om/BaseOpPolitician.php';


/**
 * Skeleton subclass for representing a row from the 'op_politician' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
 
class OpPolitician extends BaseOpPolitician {

  /**
   * intercetta il delete di un politico e invoca la rimozione del record in op_content
   * la rimozione da op_politician avviene in cascata (foreign key)
   * viene inoltre rimosso l'indice
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function delete($is_indexing =  false, $con = null)
  {
    // rimozione del documento relativo a questo politico dall'indice testuale
    if (!$is_indexing)
    {
      $iMan = new OpIndexManager();
      $iMan->removeDocument($this);
      $iMan->commit();
      unset($iMan);      
    }
    
    // fetch del record in OpContent e rimozione
    $content = OpContentPeer::retrieveByPK($this->getContentId());
    $content->delete();
    unset($content);
  }


  /*
	 * Stores the object in the database.  
	 * Overrides the method in the Object Model, taking account of
	 * the op_content relation.
	 * If the object is new, then a Content object is created and saved
	 * before saving the Politician object, so that the last one can get
	 * its content_id field from the Content object.
	 * This method wraps the doSave() worker method in a transaction.
	 *
	 * @param Boolean - se si sta già indicizzando (per evitare ricorsione e loop infiniti)
	 * @param Connection
	 * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws PropelException
	 * @see doSave()
	 */
	public function save($is_indexing = false, $con = null)
	{
        if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpPoliticianPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			if ($this->isNew()){
				$c = new OpContent();
				$c->setOpTable(OpPoliticianPeer::TABLE_NAME);
				$c->setOpClass("OpPolitician");
				$c->setHash(md5(rand(100000, 999999).$this->getContentId().time()));
				$c_affected_rows = $c->save($con);
				$this->setContentId($c->getId());
				$this->setOpContent($c);
                $this->setSlug( Utils::slugify( $this->toString() ) );
			}

      // quando il record è salvato, la data viene scritta senza ora
      if ($this->getBirthDate()) {
        $this->setBirthDate($this->getBirthDate('%Y-%m-%d') . " 00:00:00");
      }
      
      if ($this->isModified()) {
          if ( !$this->isColumnModified(OpContentPeer::UPDATED_AT))
          {
            $this->getOpContent()->setUpdatedAt(time());
          }
          if ( $this->isColumnModified(OpPoliticianPeer::FIRST_NAME) OR $this->isColumnModified(OpPoliticianPeer::LAST_NAME) ) {
              $this->setSlug( Utils::slugify( $this->toString() ) );
          }
      }
        
      // salvataggio politico
			$affectedRows = $this->doSave($con);
			
			// agiornamento campo op_user.pol_insertions
      // sono contate solo le dichiarazioni inserite
      $user_id = $this->getCreatorId();
      if ($user_id && $user_id != 1)
      {
        $user = OpUserPeer::retrieveByPK($user_id);
        $user->setPolInsertions($user->countPolInsertions());
        $user->updateLastContribution();
        $user->save($con);
        unset($user);
      }
      
			$con->commit();

  		// se l'utente è admin (importazione), la variabile $is_indexing è posta a true (evita doppie chiamate o loop infiniti)
      if (sfContext::getInstance()->getUser()->getSubscriber()->getId() == 1)
         $is_indexing = true;

      // indicizzaizone se non stiamo già indicizzando (altrimenti è loop)
      // inoltre si può usare per bloccare l'indicizzazione
      if (!$is_indexing)
      {
        
        $iMan = new OpIndexManager();
        $iMan->updateDocument($this);
        $iMan->commit();
        unset($iMan);

        // cambia lo stato di indicizzazione
        $this->setIsIndexed(1);
        $this->save(true);
      }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
		
		
	}
    

  /**
   * get start and end dates for the latest charge as charge_type, in institution_name, at location
   * if the latest charge is a current charge, then end date is null
   * if no previous or current charge is found, then both elements of the returned array are null
   *
   * @param string $institution_name  name of institution
   * @param string $location          location object
   * @param string $charge_type       name of charge_type (may be unspecified)
   * @return array of two elements (start_date, end_date)
   * @author Guglielmo Celata
   */
  public function getDatesForLastChargeIn($institution_name, $location, $charge_type = null)
  {
    $existing_start_date = null;
    $existing_end_date = null;
    $c = new Criteria();
    $c->addDescendingOrderByColumn(OpInstitutionChargePeer::DATE_START);
    $c->addDescendingOrderByColumn(OpInstitutionChargePeer::DATE_END);
    $existing_ics = OpInstitutionChargePeer::getByImportData($this, $institution_name, $location, $charge_type, $c);
    if (count($existing_ics))
    {
      $last_existing_ic = $existing_ics[0];
      $existing_start_date = $last_existing_ic->getDateStart('Y-m-d');
      $existing_end_date = $last_existing_ic->getDateEnd('Y-m-d');
    }  
    return array($existing_start_date, $existing_end_date);
  }
  
  public function compareSimilar($a, $b)
  {
    if ($a->getLastName() < $b->getLastName()) return -1;
    if ($a->getLastName() > $b->getLastName()) return 1;

    if ($a->getFirstName() < $b->getFirstName()) return -1;
    if ($a->getFirstName() >= $b->getFirstName()) return 1;
  }

  public function getMinintBirthLocation()
  {
    $original = parent::getBirthLocation();
    preg_match('/(?P<name>[^ ]+)\((?P<prov>.+)\)/', $original, $matches);

    if (count($matches))
      return sprintf("%s (%s)", $matches['name'], $matches['prov']);
    else
      return $original;
  }
  
	/**
	 * Set the value of [picture] column, starting from a file.
	 * This extends the base class, using a method of the CLOB object.
	 * If the file does not exist, then the original setPicture method is called
	 * 
	 * @param string $filename file location on server
	 * @return void
	 */
	public function setPicture($filename)
	{
		if(!stat($filename)){
			parent::setPicture($filename);
		} else {
			try {
				$this->picture = new Clob();
				$this->picture->readFromFile($filename);
				$this->modifiedColumns[] = OpPoliticianPeer::PICTURE;
			} catch (Exception $e) {
				echo("Exception " . $e . " encountered!\n");
			}
		}
	}
 
 	/*
 	 * Return first and last name if a cast to string for the object is requested
 	 */
	public function __toString()
	{
		return $this->getFirstName() . " " . $this->getLastName();
	}

 	/*
 	 * Return first and last name if a cast to string for the object is requested
 	 */
	public function toString()
	{
		return $this->getFirstName() . " " . $this->getLastName();
	}

  /**
   * return if the politician has a profession
   *
   * @return boolean
   * @author Guglielmo Celata
   */
  public function hasProfession()
  {
    return $this->getOpProfession()?true:false;
  }

  /**
   * return the normalized description of the profession
   * 
   * @return string
   * @author Guglielmo Celata
   */
  public function getProfessionNormalizedDescription()
  {
    if ($this->hasProfession()) {
      $op_profession = $this->getOpProfession();
      if ($oid = $op_profession->getOid()) {
        $op_profession = OpProfessionPeer::retrieveByPK($oid);
      }
      return $op_profession->getOdescription();
    }
  }


  /**
   * return if the politician has at least one education level
   *
   * @return boolean
   * @author Guglielmo Celata
   */
  public function hasEducationLevel()
  {
    return $this->countOpPoliticianHasOpEducationLevels()?true:false;
  }
  
  /**
   * return the last inserted education level for the politician
   *
   * @return OpPoliticianHasOpEducationLevel
   * @author Guglielmo Celata
   */
  public function getEducationLevel()
  {
    $education_levels = $this->getOpPoliticianHasOpEducationLevels();
    return count($education_levels)?$education_levels[0]:null;
  }

  /**
   * return the normalized description of th eeducation level
   * 
   * @return string
   * @author Guglielmo Celata
   */
  public function getEducationLevelNormalizedDescription()
  {
    if ($this->hasEducationLevel()) {
      $op_education_level = $this->getEducationLevel()->getOpEducationLevel();
      if ($oid = $op_education_level->getOid()) {
        $op_education_level = OpEducationLevelPeer::retrieveByPK($oid);
      }
      return $op_education_level->getDescription();
    }
  }
  
  public function getResources()
  {
		$c = new Criteria();
		$c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
		$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpResourcesPeer::CONTENT_ID);
		return $this->getOpResourcessJoinOpResourcesType($c);
  }


  /**
   * return the list of resources (joined with resources type) inserted
   * by staff's member
   *
   * @return array of OpResources
   * @author Guglielmo Celata
   */
  public function getResourcesInsertedByStaff()
  {
    $staff_ids = array(1, 31, 6194, 2313, 6, 100, 7);
		$c = new Criteria();
		$c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
		$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpResourcesPeer::CONTENT_ID);
		$c->add(OpOpenContentPeer::USER_ID, $staff_ids, Criteria::IN);
		return $this->getOpResourcessJoinOpResourcesType($c);
  }
  
  /**
   * returns the very official site
   * identified by the official_url resource type constant
   * and by the 'sito ufficiale' description
   * used to extract the official url in the op_rcs project
   * 
   * @return OpResource object
   * @author Guglielmo Celata
   */
  public function getOfficialSite()
  {
    $resources = $this->getResources();
    foreach ($resources as $resource) {
      if ($resource->getOpResourcesType()->getResourceType() == 'URL ufficiale' &&
          strtolower($resource->getDescrizione()) == 'sito ufficiale') {
        return $resource;
      }
    }
    
    return null;
  }
  

  /**
   * add an institution charge to this politician
   * use names for institution, charge_type, party and group
   * name and type for location
   * name and election_type for constituency
   *
   *
   * @param string $date_start 
   * @param string $date_end 
   * @param string $description 
   * @param string $institution 
   * @param string $charge_type 
   * @param string $location_name 
   * @param string $location_type 
   * @param string $party 
   * @param string $group 
   * @param string $constituency_name 
   * @param string $constituency_election_type 
   * @return OpInstitutionCharge
   * @author Guglielmo Celata
   */
  public function addInstitutionCharge($date_start, $date_end, $description, $institution, $charge_type, $location_name, $location_type, $party = null, $group = null, $constituency_name = null, $constituency_election_type = null)
  {
    return OpInstitutionChargePeer::addByNames($this, $date_start, $date_end, $description, $institution, $charge_type, $location_name, $location_type, $party, $group, $constituency_name, $constituency_election_type);
  }

  /**
   * return the number of institution charges this politician has
   *
   * @param string $type - (current, past, all)
   * @return Integer
   * @author Guglielmo Celata
   */
  public function countInstitutionCharges($type = 'all')
  {
  	$c = new Criteria();
  	$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID);
  	$c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);

  	if ($type == 'current')
    	$c->add(OpInstitutionChargePeer::DATE_END, null, Criteria::ISNULL);
    if ($type == 'past')
    	$c->add(OpInstitutionChargePeer::DATE_END, null, Criteria::ISNOTNULL);    

  	return $this->countOpInstitutionCharges($c);
  }



  /**
   * return all institutional charges (or filter by current, past)
   *
   * @param string $type (current | past)
   * @return array of OpInstitutionCharge objects
   * @author Guglielmo Celata
   */
  public function getPublicInstitutionCharges($type = null)
  {
  	$c = new Criteria();
		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID, Criteria::LEFT_JOIN);
  	$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID);
  	$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);
  	$c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  	if ($type == 'current')
  	{
  		$c->addAscendingOrderByColumn(OpInstitutionPeer::PRIORITY);
      $c->add(OpInstitutionChargePeer::DATE_END, null, Criteria::ISNULL);
      $c->addDescendingOrderByColumn(OpInstitutionChargePeer::DATE_START);
  	}
    if ($type == 'past')
    {
    	$c->add(OpInstitutionChargePeer::DATE_END, null, Criteria::ISNOTNULL);    
      $c->addDescendingOrderByColumn(OpInstitutionChargePeer::DATE_END);      
    }
  	return $this->getOpInstitutionCharges($c);
  }
  
  /**
   * ritorna le cariche istituzionali attuali (o l'ultima)
   *
   * @param last - boolean
   * @return un array con le cariche o l'ultima carica (se last=true)
   * @author Guglielmo Celata
   **/
	public function fetch_current_institution_charges($last = false)
	{
		$c = new Criteria();
		$c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
		$c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::ISNULL);
		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID, Criteria::LEFT_JOIN);
		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->addAscendingOrderByColumn(OpInstitutionPeer::PRIORITY);
    $c->addDescendingOrderByColumn(OpInstitutionChargePeer::DATE_START);
		$institution_charges=$this->getOpInstitutionCharges($c);

  	if ($last && count($institution_charges)>0) return $institution_charges[0];
  	else return $institution_charges;
	}

  /**
   * return all political charges (or filter by current, past)
   *
   * @param string $type (current | past)
   * @return array of OpPoliticalCharge objects
   * @author Guglielmo Celata
   */
  public function getPublicPoliticalCharges($type = null)
  {
  	$c = new Criteria();
  	$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpPoliticalChargePeer::CONTENT_ID);
  	$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);
  	$c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  	if ($type == 'current')
  	{
    	$c->add(OpPoliticalChargePeer::DATE_END, null, Criteria::ISNULL);  	  
      $c->addDescendingOrderByColumn(OpPoliticalChargePeer::DATE_START);
  	}
    if ($type == 'past'){
    	$c->add(OpPoliticalChargePeer::DATE_END, null, Criteria::ISNOTNULL);          
      $c->addDescendingOrderByColumn(OpPoliticalChargePeer::DATE_END);
    }
  	return $this->getOpPoliticalCharges($c);
  }

  /**
   * return all organization charges (or filter by current, past)
   *
   * @param string $type (current | past)
   * @return array of OpOrganizationCharge objects
   * @author Guglielmo Celata
   */
  public function getPublicOrganizationCharges($type = null)
  {
  	$c = new Criteria();
  	$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpOrganizationChargePeer::CONTENT_ID);
  	$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);
  	$c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  	if ($type == 'current')
  	{
    	$c->add(OpOrganizationChargePeer::DATE_END, null, Criteria::ISNULL);  	  
      $c->addDescendingOrderByColumn(OpOrganizationChargePeer::DATE_START);
  	}
    if ($type == 'past')
    {
    	$c->add(OpOrganizationChargePeer::DATE_END, null, Criteria::ISNOTNULL);          
      $c->addDescendingOrderByColumn(OpOrganizationChargePeer::DATE_END);
    }
  	return $this->getOpOrganizationCharges($c);
  }

  /**
   * return all resources 
   *
   * @return array of OpResources objects
   * @author Guglielmo Celata
   */
  public function getPublicResources()
  {
  	$c = new Criteria();
  	$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpResourcesPeer::CONTENT_ID);
  	$c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  	return $this->getOpResourcess($c);
  }
  
  

	

  /**
   * ritorna le cariche istituzionali non cancellate
   *
   * @return un array con le cariche
   * @author Guglielmo Celata
   **/
	public function getUndeletedInstitutionCharges()
	{
  	$c = new Criteria();
    $c->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());
    $c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
    $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
    $c->addAscendingOrderByColumn(OpInstitutionChargePeer::DATE_START); 
    return OpInstitutionChargePeer::doSelect($c);
	}
	
  
	
	
  /**
   * ritorna le cariche istituzionali PASSATE comprese tra il 21/04/2006 al 28/04/2008 (XV Legislatura)
   *
   * @param last - boolean
   * @return un array con le cariche
   * @author Ettore Di Cesare
   **/
	public function fetch_leg_institution_charges($data_inizio, $data_fine)
	{
		$c = new Criteria();
		$c->add(OpInstitutionChargePeer::DATE_START, $data_inizio, Criteria::GREATER_EQUAL);
		$c->add(OpInstitutionChargePeer::DATE_END, $data_fine, Criteria::LESS_EQUAL);
		$c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
		$crit1= $c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, '4', Criteria::EQUAL);
		$crit2= $c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, '5', Criteria::EQUAL);
		$crit2 -> addOr($crit1);
		$c->add($crit2);
		
		$c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID, Criteria::LEFT_JOIN);
		$c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
		$c->addAscendingOrderByColumn(OpInstitutionPeer::PRIORITY);
		$institution_charges=$this->getOpInstitutionCharges($c);
		$last = false;

  	if ($last && count($institution_charges)>0) return $institution_charges[0];
  	else return $institution_charges;
	}
	
	
	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this OpPolitician is new, it will return
	 * an empty collection; or if this OpPolitician has previously
	 * been saved, it will retrieve related OpDeclarations from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in OpPolitician.
	 */
	public function getOpDeclarationsJoinOpOpenContent($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseOpDeclarationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpDeclarations === null) {
			if ($this->isNew()) {
				$this->collOpDeclarations = array();
			} else {

				$criteria->add(OpDeclarationPeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpDeclarations = OpDeclarationPeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(OpDeclarationPeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpDeclarationCriteria) || !$this->lastOpDeclarationCriteria->equals($criteria)) {
				$this->collOpDeclarations = OpDeclarationPeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		}
		$this->lastOpDeclarationCriteria = $criteria;

		return $this->collOpDeclarations;
	}  
	
	
	/**
	 * torna il numero di dichiarazioni associate a temi per un politico (qualsiasi tema)
	 *
	 * @return integer
	 * @author Guglielmo Celata
	 **/
  public function getNbDeclarationsAssociatedToThemes()
  {
    $c = new Criteria();
    $c->addJoin(OpDeclarationPeer::CONTENT_ID, OpThemeHasDeclarationPeer::DECLARATION_ID);
    $c->add(OpDeclarationPeer::POLITICIAN_ID, $this->getContentId());
    return OpThemeHasDeclarationPeer::doCount($c);
  }
  
  /**
   * torna la coalizione elettorale (OpParty) cui è associato il politico (o null)
   *
   * @return OpParty/null
   * @author Guglielmo Celata
   **/
  public function getElectoralCoalition()
  {
    // determina la candidatura per le politiche 2008
    $charge = OpPoliticalChargePeer::retrieveVsqCandidation($this->getContentId());
    
    // torna il partito associato alla carica o il valore null
    if ($charge instanceof OpPoliticalCharge)    
      return $charge->getOpParty();
    else 
      return null;
  }


  /**
   * ritorna le cariche istituzionali non cancellate
   *
   * @return un array con le cariche
   * @author Guglielmo Celata
   **/
  public function getTax4Politician()
  {
      $c = new Criteria();
      $c->add(OpPoliticianPeer::CONTENT_ID, $this->getContentId());
      $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpTaxDeclarationPeer::POLITICIAN_ID);
      return OpTaxDeclarationPeer::doSelect($c);
  }
		

} // OpPolitician

?>
