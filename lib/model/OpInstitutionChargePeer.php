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

  // include base peer class
  require_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
  
  // include object class
  include_once 'lib/model/OpInstitutionCharge.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_institution_charge' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpInstitutionChargePeer extends BaseOpInstitutionChargePeer{
  
  const NO_RECORD = 0;
  const DUPLICATE_RECORD = -1;
  
  # constants used as result status in self::isChargeToImportOverlapping
  const OVERLAP_NO_EXISTING_CHARGES = 0;
  const OVERLAP_EXISTING_BUT_NOT_OVERLAPPING = 1;
  const OVERLAP_EXISTING_AND_OVERLAPPING = 2;
  const OVERLAP_EXISTING_CURRENT = 3;
  const OVERLAP_WRONG_STATUS = 4;
  
  # max number of locations where to look for active charges
  const MAX_LOCATIONS_LOOKUP = 50;


  /**
   * return the main active charge or null
   * main = mayor, president of the giunta 
   * if there is no active main charge, then a null is returned
   * @param OpLocation $location 
   * @return OpInstitutionCharge or null
   * @author Guglielmo Celata
   */
  public function getMainCharge($location)
  {
    $c = new Criteria();
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, self::CONTENT_ID);
    $c->add(self::LOCATION_ID, $location->getId());
    $c->add(self::DATE_END, null, Criteria::ISNULL);
    $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
    
    switch ($location->getLocationTypeId()) {
      case '4':
        $c->add(self::CHARGE_TYPE_ID, 1);
        $c->add(self::INSTITUTION_ID, 6);
        break;
      case '5':
        $c->add(self::CHARGE_TYPE_ID, 1);
        $c->add(self::INSTITUTION_ID, 8);
        break;
      case '6':
        $c->add(self::CHARGE_TYPE_ID, 14);
        $c->add(self::INSTITUTION_ID, 10);
        break;
    }
    return OpInstitutionChargePeer::doSelectOne($c);
  }

  /**
   * get all active charges (not deleted and not finished)
   * for a given set of locations
   *
   * data are joined with OpLocation
   * @param array $locations array of location_id
   * @return void
   * @author Guglielmo Celata
   */
  public function getActiveInLocations($location_ids)
  {
    if (count($location_ids) == 0)
      throw new Exception("locations array must have at least one element");
    if (count($location_ids) > self::MAX_LOCATIONS_LOOKUP)
      throw new Exception(sprintf("too many locations specified; maximum is %s", self::MAX_LOCATIONS_LOOKUP));

    $c = new Criteria();
    $c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OpLocationPeer::ID);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID);
    $c->add(self::LOCATION_ID, $location_ids, Criteria::IN);
    $c->add(OpInstitutionChargePeer::DATE_END, null, Criteria::ISNULL);
    $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);

    return OpInstitutionChargePeer::doSelect($c);
  }


  /**
   * sindaco, vicesindaco, assessore, 
   * presidente della provincia, vicepresidente della provincia
   * presidente della regione, vicepresidente della regione
   * sono i ruoli per la giunta (regionale, provinciale, comunale)
   *
   * presidente del consiglio, vicepresidente del consiglio, consigliere
   * sono i ruoli per il consiglio (regionale, provinciale, comunale)
   *
   * @param string $context 
   * @param string $charge_descr 
   * @return list with institution name and charge type name
   * @author Guglielmo Celata
   */
  public static function getInstitutionAndChargeTypeFromChargeDescr($context, $charge_descr)
  {
		if ($context != 'reg' && $context != 'prov' && !strpos($context, 'com') === false) {
		  throw new Exception(sprintf("context %s does not exist", $context));
		}
    
    # first step
    $charge_descr = preg_replace('/^presidente consiglio/i', 'Presidente del Consiglio', $charge_descr);
    $charge_descr = preg_replace('/^presidente del consiglio.*/i', 'Presidente del Consiglio', $charge_descr);
    $charge_descr = preg_replace('/^vicepresidente del consiglio.*/i', 'Vicepresidente del Consiglio', $charge_descr);
    $charge_descr = preg_replace('/^vicepresidente consiglio/i', 'Vicepresidente del Consiglio', $charge_descr);
    $charge_descr = preg_replace('/^assessore.*/i', 'Assessore', $charge_descr);
    $charge_descr = preg_replace('/^consigliere.*/i', 'Consigliere', $charge_descr);
    $charge_descr = preg_replace('/^presidente giunta - candidato presidente/i', 'Presidente', $charge_descr);
    $charge_descr = preg_replace('/^presidente giunta/i', 'Presidente', $charge_descr);
    $charge_descr = preg_replace('/^presidente della regione.*/i', 'Presidente', $charge_descr);
    $charge_descr = preg_replace('/^presidente della provincia.*/i', 'Presidente', $charge_descr);
    $charge_descr = preg_replace('/^vicepresidente giunta/i', 'Vicepresidente', $charge_descr);
    $charge_descr = preg_replace('/^vicepresidente della regione.*/i', 'Vicepresidente', $charge_descr);
    $charge_descr = preg_replace('/^vicepresidente della provincia.*/i', 'Vicepresidente', $charge_descr);
    $charge_descr = preg_replace('/^sindaco.*/i', 'Sindaco', $charge_descr);
    $charge_descr = preg_replace('/^vicesindaco.*/i', 'Vicesindaco', $charge_descr);
    $charge_descr = preg_replace('/^delega funzioni da parte del sindaco - vicesindaco/i', 'Vicesindaco', $charge_descr);
    $charge_descr = preg_replace('/^delega funzioni da parte del sindaco/i', 'Assessore', $charge_descr);
    $charge_descr = preg_replace('/^questore/i', 'Consigliere', $charge_descr);
    $charge_descr = preg_replace('/^segretario del consiglio/i', 'Consigliere', $charge_descr);
    $charge_descr = preg_replace('/^commissario prefettizio/i', 'Commissario', $charge_descr);
    $charge_descr = preg_replace('/^commissario straordinario/i', 'Commissario straordinario', $charge_descr);
    $charge_descr = preg_replace('/^commissione straordinaria/i', 'Commissario straordinario', $charge_descr);
    $charge_descr = preg_replace('/^sub commissario prefettizio/i', 'Commissario', $charge_descr);
    
    # get the institution
    if (in_array($charge_descr, array('Presidente', 'Vicepresidente', 'Assessore', 'Sottosegretario', 'Sindaco', 'Vicesindaco'))) {
      $institution = 'Giunta';
    } else if (in_array($charge_descr, array('Presidente del Consiglio', 'Vicepresidente del Consiglio', 'Consigliere'))) {
      $institution = 'Consiglio';      
    } else if (in_array($charge_descr, array('Commissario', 'Commissario straordinario'))) {
      $institution = 'Commissariamento';            
    } else {
      throw new Exception("Something's wrong with the charge description: " . $charge_descr);
    }

    # second step, presidents are just presidents
    $charge_descr = preg_replace('/^presidente del consiglio/i', 'Presidente', $charge_descr);
    $charge_descr = preg_replace('/^vicepresidente del consiglio/i', 'Vicepresidente', $charge_descr);
    
    if ($institution != 'Commissariamento')
    {
      switch ($context) {
        case 'reg':
          $institution .= " Regionale";
          break;
        case 'prov':
          $institution .= " Provinciale";
          break;

        default:
          $institution .= " Comunale";
          break;
      }      
    }
    
    return array($institution, $charge_descr);
  }

  /**
   * check whether the charge to import has an existing, overlapping charge,
   * and return a status
   *
   * @param hash $v - charge and political values from csv 
   *   first_name, last_name, birth_date, birth_location,
   *   charge_desc, minint_regional_code, minint_provincial_code, minint_city_code, charge_start_date
   *   see OpImportModificationsPeer::getHashFromReducedCSV
   * @param string $context (reg, prov, com.%3d)
   * @param OpPolitician $p (may be passed, so that it is not fetched again from DB)
   * @return hash:
   *      status - integer (see constants definitions at the top of the class)
   *      existing_start_date
   *      existing_end_date
   * @author Guglielmo Celata
   */
  public static function isChargeToImportOverlapping($v, $context, $p = null)
  {
    // retrieve p if not given
    if (is_null($p))
    {
      $res = OpPoliticianPeer::computePoliticianAndActionTypeFromAnagraphicalData($v);
      $p = $res['politician'];
    }
    
    // extract institution_name, charge_type and location from csv record
    list($institution_name, $charge_type) = self::getInstitutionAndChargeTypeFromChargeDescr($context, $v['charge_desc']);
    $location = OpLocationPeer::retrieveByMinIntCodes(OpLocationPeer::loc_type($context), 
                                                      $v['minint_regional_code'], 
                                                      $v['minint_provincial_code'], 
                                                      $v['minint_city_code']);

    // get latest current or previous charge's dates (same institution and location)
    list($existing_start_date, $existing_end_date) = $p->getDatesForLastChargeIn($institution_name, $location);


    if (is_null($existing_start_date) && is_null($existing_end_date)) {
      $status = self::OVERLAP_NO_EXISTING_CHARGES;
    } elseif (!is_null($existing_start_date) && is_null($existing_end_date)) {
      $status = self::OVERLAP_EXISTING_CURRENT;
    } elseif (!is_null($existing_start_date) && !is_null($existing_end_date)) {
      if ($existing_end_date <= OpImportModificationsPeer::getDBDate($v['charge_start_date']))
        $status = self::OVERLAP_EXISTING_BUT_NOT_OVERLAPPING;
      else 
        $status = self::OVERLAP_EXISTING_AND_OVERLAPPING;
    } else {
      # existing_start_date is null and existing_end_date is not null => Error
      $status = self::OVERLAP_WRONG_STATUS;      
    }

    return array('status' => $status, 'existing_start_date' => $existing_start_date, 'existing_end_date' => $existing_end_date);
    
  }

  /**
   * estrae informazioni statistiche riguardo i titoli di studio dei politici per una location
   * dato che l'estrazione di questa info per tutte le loclità (location_id = null)
   * è molto onerosa, è meglio usare una cache
   * ad esempio:
   * $edu_statistics = $fc->call('OpInstitutionChargePeer::getLocationEduStatistics');
   * dove $fc = new sfMemcacheFunctionCache();
   *
   * @param string $location_id 
   * @param string $con 
   * @return array ('laureati' => 31, 'non_laureati' => 15)
   * @author Guglielmo Celata
   */
	public static function getLocationEduStatistics($location_id = null, $con = null)
	{
	  if (is_null($con))
      $con = Propel::getConnection(self::DATABASE_NAME);
      
    $sql = "select count(*) as n " .
           " from op_institution_charge ic, op_open_content oc, op_politician p, op_politician_has_op_education_level pe " .
           " where ic.politician_id=p.content_id and oc.content_id=ic.content_id and p.content_id=pe.politician_id and " .
           "  oc.deleted_at is null and ic.date_end is null and pe.education_level_id in (6, 7, 11, 19) ";
           if (!is_null($location_id)) 
             $sql .= " and ic.location_id=$location_id ";
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    $edu_statistics = array();
    if ($rs->next()){
      $edu_statistics['laureati'] = $rs->getInt('n');
    }

    $sql = "select count(*) as n " .
           " from op_institution_charge ic, op_open_content oc, op_politician p, op_politician_has_op_education_level pe " .
           " where ic.politician_id=p.content_id and oc.content_id=ic.content_id and p.content_id=pe.politician_id and " .
           "  oc.deleted_at is null and ic.date_end is null and pe.education_level_id not in (6, 7, 11, 19) ";
           if (!is_null($location_id)) 
             $sql .= " and ic.location_id=$location_id ";
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    if ($rs->next()){
      $edu_statistics['non_laureati'] = $rs->getInt('n');
    }
    
    return $edu_statistics;
	}


  /**
   * estrae informazioni statistiche riguardo l'età dei politici per una location
   * dato che l'estrazione di questa info per tutte le loclità (location_id = null)
   * è molto onerosa, è meglio usare una cache
   * ad esempio:
   * $age_statistics = $fc->call('OpInstitutionChargePeer::getLocationAgeStatistics');
   * dove $fc = new sfMemcacheFunctionCache();
   *
   * @param string $location_id 
   * @param string $con 
   * @return array ('n' => 78, 'age_avg' => 47.654)
   * @author Guglielmo Celata
   */
	public static function getLocationAgeStatistics($location_id = null, $con = null)
	{
	  if (is_null($con))
      $con = Propel::getConnection(self::DATABASE_NAME);
      
    $sql = "select avg(timestampdiff(year, p.birth_date,now())) as age_avg, count(*) as n " .
           " from op_institution_charge ic, op_open_content oc, op_politician p " .
           " where ic.politician_id=p.content_id and oc.content_id=ic.content_id and " .
           "  oc.deleted_at is null and ic.date_end is null ";
           if (!is_null($location_id)) 
             $sql .= " and ic.location_id=$location_id ";
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    if ($rs->next()){
      return $rs->getRow();
    }
    return null;  
	}


  /**
   * estrae informazioni statistiche riguardo il sesso dei politici per una location
   * dato che l'estrazione di questa info per tutte le loclità (location_id = null)
   * è molto onerosa, è meglio usare una cache
   * ad esempio:
   * $sex_statistics = $fc->call('OpInstitutionChargePeer::getLocationSexStatistics');
   * dove $fc = new sfMemcacheFunctionCache();
   *
   * @param string $location_id 
   * @param string $con 
   * @return array ('m' => 74, 'f' => 4)
   * @author Guglielmo Celata
   */
	public static function getLocationSexStatistics($location_id = null, $con = null)
	{
	  if (is_null($con))
      $con = Propel::getConnection(self::DATABASE_NAME);
      
    $sql = "select p.sex, count(*) as n " .
           " from op_institution_charge ic, op_open_content oc, op_politician p " .
           " where ic.politician_id=p.content_id and oc.content_id=ic.content_id and " .
           "  oc.deleted_at is null and ic.date_end is null ";
           if (!is_null($location_id)) 
             $sql .= " and ic.location_id=$location_id ";
           $sql .= " group by p.sex order by n desc";
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    $sex_numbers = array();
    while($rs->next()){
      $sex = strtolower($rs->getString('sex'));
      $sex_numbers[$sex]= $rs->getInt('n');
    }
    return $sex_numbers;  
	}


	



  /**
   * compara due incarichi e torna true se hanno uguali:
   * - politician_id (solo se richiesto)
   * - institution_id
   * - charge_type_id
   * - location_id
   * - date_start
   * - date_end
   *
   * Nel caso in cui si comparino incarichi di due politici doppioni,
   * il confronto tra politician_id non è necessario
   *
   * @param OpInstitutionCharge $ic1 
   * @param OpInstitutionCharge $ic2 
   * @param boolean $compare_politician_id
   * @return void
   * @author Guglielmo Celata
   */
  public static function compare($ic1, $ic2, $compare_politician_id = false)
  {
    if (!$ic1 instanceof OpInstitutionCharge ||
        !$ic2 instanceof OpInstitutionCharge )
      throw new Exception("Wrong parameters: both must be OpInstitutionCharge classes");
    
    $res = false;
    /*
    printf("\ncomparing %6d and %6d\n %6d     %6d\n %6d     %6d\n %6d     %6d\n %6d     %6d\n %s    %s\n %s    %s\n",
           $ic1->getContentId(), $ic2->getContentId(),
           $ic1->getPoliticianId(), $ic2->getPoliticianId(),
           $ic1->getInstitutionId(), $ic2->getInstitutionId(),
           $ic1->getChargeTypeId(), $ic2->getChargeTypeId(),
           $ic1->getLocationId(), $ic2->getLocationId(), 
           $ic1->getDateStart('U'), $ic2->getDateStart('U'),
           $ic1->getDateEnd('U'), $ic2->getDateEnd('U'));
    */         
    if ($ic1->getInstitutionId() == $ic2->getInstitutionId() &&
        $ic1->getChargeTypeId() == $ic2->getChargeTypeId() &&
        $ic1->getLocationId() == $ic2->getLocationId() && 
        abs($ic1->getDateStart('U') - $ic2->getDateStart('U')) <= 30*86400 &&
        (abs($ic1->getDateEnd('U') - $ic2->getDateEnd('U')) <= 30*86400 || 
         is_null($ic1->getDateEnd()) && is_null($ic2->getDateEnd())))
    {
      $res = true;      
    }
    
    if ($compare_politician_id)
    {
      $res = $res && ($ic1->getPoliticianId() == $ic2->getPoliticianId());
    }
    
    // printf("res: %s\n", $res?'uguali':'diversi');
    return $res;
  }


  public static function countTouchedCharges($last_updated_at)
  {
    $con = Propel::getConnection(self::DATABASE_NAME);
    $sql = "SELECT count(*) " .
           " FROM op_institution_charge ic, op_open_content oc, op_content c " .
           " WHERE ic.CONTENT_ID=oc.CONTENT_ID AND oc.CONTENT_ID=c.ID  AND " .
           "  ic.INSTITUTION_ID >3 AND (" .
           "  oc.DELETED_AT IS NULL AND c.UPDATED_AT > c.CREATED_AT AND c.UPDATED_AT > '$last_updated_at' OR ".
           "  oc.DELETED_AT IS NULL AND c.CREATED_AT > '$last_updated_at' OR ".
           "  oc.DELETED_AT > '$last_updated_at')";
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_NUM);

    if($rs->next())
      return $rs->getInt(1);
    else
      return 0;
  }

  
  public static function getPoliticiansIdsWithTouchedCharges($last_updated_at)
  {
    $con = Propel::getConnection(self::DATABASE_NAME);
    $sql = "SELECT DISTINCT ic.POLITICIAN_ID " .
           " FROM op_institution_charge ic, op_open_content oc, op_content c " .
           " WHERE ic.CONTENT_ID=oc.CONTENT_ID AND oc.CONTENT_ID=c.ID  AND " .
           "  ic.INSTITUTION_ID >3 AND (" .
           "  oc.DELETED_AT IS NULL AND c.UPDATED_AT > c.CREATED_AT AND c.UPDATED_AT > '$last_updated_at' OR ".
           "  oc.DELETED_AT IS NULL AND c.CREATED_AT > '$last_updated_at' OR ".
           "  oc.DELETED_AT > '$last_updated_at' )";
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    $politicians_ids = array();
    while($rs->next()){
      $politicians_ids []= $rs->getInt('POLITICIAN_ID');
    }
    return $politicians_ids;  
  }


  public static function getLocationsIdsAndConstituenciesWithTouchedCharges($last_updated_at)
  {
    $con = Propel::getConnection(self::DATABASE_NAME);
    $sql = "SELECT DISTINCT ic.LOCATION_ID, ic.CONSTITUENCY_ID " .
           " FROM op_institution_charge ic, op_open_content oc, op_content c " .
           " WHERE ic.CONTENT_ID=oc.CONTENT_ID AND oc.CONTENT_ID=c.ID  AND " .
           "  ic.INSTITUTION_ID >3 AND (" .
           "  oc.DELETED_AT IS NULL AND c.UPDATED_AT > c.CREATED_AT AND c.UPDATED_AT > '$last_updated_at' OR ".
           "  oc.DELETED_AT IS NULL AND c.CREATED_AT > '$last_updated_at' OR ".
           "  oc.DELETED_AT > '$last_updated_at' )";
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    $locations = array();
    while($rs->next()){
      $loc_id = $rs->getInt('LOCATION_ID');
      $const_id = $rs->getInt('CONSTITUENCY_ID');
      if (!array_key_exists($loc_id, $locations))
      {
        $locations[$loc_id] = array();        
      }

      if (!in_array($const_id, $locations[$loc_id]))
      {
        $locations[$loc_id][] = $const_id;
      }
    }
    return $locations;  
  }


  protected static function extractLocationsIdsForCriteria(Criteria $c)
  {
    $c->setDistinct(true);
    $c->clearSelectColumns();
    $c->addSelectColumn(self::LOCATION_ID);
    $c->addSelectColumn(self::CONSTITUENCY_ID);

    $items = array();
    $rs = self::doSelectRS($c);
    while($rs->next()){
      $items[$rs->getInt(1)] = $rs->getInt(2);
    }
    return $items;  
  }
  
  protected static function getContentOpenContentJoinCriteria()
  {
    $c = new Criteria();
    $c->addJoin(self::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);
    return $c;
  }


  /**
   * add an institution charge to a given politician
   * use names for institution, charge_type, party and group
   * name and type for location
   * name and election_type for constituency
   *
   * @param string $op_politician the OpPolitician to whom the charge is added
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
  public static function addByNames($op_politician, $date_start, $date_end, $description, $institution, $charge_type, $location_name, $location_type, $party = null, $group = null, $constituency_name = null, $constituency_election_type = null)
  {
    $op_institution = OpInstitutionPeer::retrieveByName($institution);
    if (!$op_institution)
      throw new PropelException(sprintf("no known institution: %s", $institution));
      
    $op_charge_type = OpChargeTypePeer::retrieveByName($charge_type);
    if (!$op_charge_type)
      throw new PropelException(sprintf("no known charge type: %s", $charge_type));
    
    $op_location = OpLocationPeer::retrieveByNameType($location_name, $location_type);
    if (!$op_location)
      throw new PropelException(sprintf("no known location %s of type: %s", $location_name, $location_type));
      
    if (!is_null($party)) {
      $op_party = OpPartyPeer::retrieveByName($party);
      if (!$op_party)
        throw new PropelException(sprintf("no known party: %s", $party));      
    } else
      $op_party = null;

    if (!is_null($group)) {
      $op_group = OpGroupPeer::retrieveByName($group);
      if (!$op_group)
        throw new PropelException(sprintf("no known group: %s", $group));      
    } else 
      $op_group = null;
    
    if (!is_null($constituency_name) && !is_null($constituency_election_type)) {
      $op_constituency = OpConstituencyPeer::retrieveByNameElectionType($constituency_name, $constituency_election_type);
      if (!$op_constituency)
        throw new PropelException(sprintf("no known constituency: %s for election type: %s", $constituency_name, $constituency_election_type));
    } else 
      $op_constituency = null;
    
    return self::addByObjects($op_politician, $date_start, $date_end, $description, $op_institution, $op_charge_type, $op_location, $op_party, $op_group, $op_constituency);
    
  }
  
  /**
   * add an institutionCharge
   *
   * @param string $op_politician 
   * @param string $date_start 
   * @param string $date_end 
   * @param string $description 
   * @param string $op_institution 
   * @param string $op_charge_type 
   * @param string $op_location 
   * @param string $op_party 
   * @param string $op_group 
   * @param string $op_constituency 
   * @return OpInstitutionCharge
   * @author Guglielmo Celata
   */
  public static function addByObjects($op_politician, $date_start, $date_end, $description, $op_institution, $op_charge_type, $op_location, $op_party = null, $op_group = null, $op_constituency = null)
  {
    $ic = new OpInstitutionCharge();

    # op_politician
    if ($op_politician instanceof OpPolitician)
      $ic->setOpPolitician($op_politician);
    else
      throw new Exception("Politician must be an object of type OpPolitician");
          
    # date di inizio e fine incarico
    if ($date_start != "") $ic->setDateStart($date_start);
    if ($date_end != "") $ic->setDateEnd($date_end);

    # description
    if ($description != "")
      $ic->setDescription($description);

    # op_institution
    if ($op_institution instanceof OpInstitution)
      $ic->setOpInstitution($op_institution);
    else
      throw new Exception("Istitution must be an object of type OpInstitution");

    # op_charge_type
    if ($op_charge_type instanceof OpChargeType)
      $ic->setOpChargeType($op_charge_type);
    else
      throw new Exception("Charge Type must be an object of type OpChargeType");

    # location
    if ($op_location instanceof OpLocation)
      $ic->setOpLocation($op_location);
    else
      throw new Exception("Location must be an object of type OpLocation");

    # partito
    if (!is_null($op_party))
    {        
      if ($op_party instanceof OpParty)
        $ic->setOpParty($op_party);
      else 
        throw new Exception("Party must be an object of type OpParty");
    }

    # partito
    if (!is_null($op_group))
    {        
      if ($op_group instanceof OpGroup)
        $ic->setOpGroup($op_group);
      else 
        throw new Exception("Group must be an object of type OpParty");
    }

    # constituency (oggetto opConstituency)
    if (!is_null($op_constituency))
    {        
      if ($op_constituency instanceof OpConstituency)
        $ic->setOpConstituency($op_constituency);
      else 
        throw new Exception("Constituency must be an object of type OpConstituency");

    }

    # salvataggio del record
    $ic->save();
    
    return $ic;
  }


  public static function closeFromCSV($context, $csv_rec, $op_politician, $con = null)
  {
    $ic = self::getOrAddFromCSV($context, $csv_rec, $op_politician, 'get', 'reduced', $con);
    if (is_array($ic))
    {
      foreach ($ic as $i){
        $i->setDateEnd(date('Y-01-01'));
        $i->save();
      }      
    }
    else
    {
      $ic->setDateEnd(date('Y-01-01'));
      $ic->save();
    }
  }
  
  public static function addFromCSV($context, $csv_rec, $op_politician, $con = null)
  {
    $ic = self::getOrAddFromCSV($context, $csv_rec, $op_politician, 'add', 'complete', $con);    
    return $ic;
  }
  
  public static function getOrAddFromCSV($context, $csv_rec, $op_politician, $mode = null, $csv_type = 'complete', $con = null)
  {
    if (is_null($con))
		  $con = Propel::getConnection(self::DATABASE_NAME);

		if ($context != 'reg' && $context != 'prov' && !strpos($context, 'com') == false) {
		  throw new Exception(sprintf("context %s does not exist", $context));
		}
    if (!$op_politician instanceof OpPolitician) {
      throw new Exception("third parameter must be an OpPolitician");
    }
    
    if (is_null($mode) || !in_array($mode, array('get', 'add')))
      throw new Exception("fourth parameter is needed and it must be either [get] or [add]");
    
    switch ($context) {
      case 'reg':
        $loc_type = 'regione';
        break;

      case 'prov':
        $loc_type = 'provincia';
        break;
      
      default:
        $loc_type = 'comune';
        break;
    }

    if ($csv_type == 'complete') {
      $values = OpImportModificationsPeer::getHashFromCSV($context, $csv_rec);
    } else {
      $values = OpImportModificationsPeer::getHashFromReducedCSV($context, $csv_rec);
    }
    
    $op_location = OpLocationPeer::retrieveByMinIntCodes(
      $loc_type,
      $values['minint_regional_code'],
      $values['minint_provincial_code'],
      $values['minint_city_code']
    );      

    list($institution, $charge) = self::getInstitutionAndChargeTypeFromChargeDescr($context, $values['charge_desc']);

    if ($mode == 'get') {
      return self::retrieveCurrentByImportData($op_politician, $institution, $op_location, $charge, $con);
    } else {
      return self::addFromImport($values['charge_desc'], $values['charge_start_date'], null, 
                                $op_politician, $institution, $charge, $op_location,
                                $values['charge_list'], null, 
                                null, $con);
    }
  }
  

  /**
   * inserisce nel DB un incarico istituzionale, a partire da dati di import
   * 
   * @return OpInstitutionalCharge - l'oggetto appena inserito
   * @author Guglielmo Celata
   **/
  public static function addFromImport($charge_description, $date_start, $date_end, 
                                       $pol, $institution_name, $charge_type_name, $loc, 
                                       $party_name = null, $group_name = null, 
                                       $constituency_name = null, $con = null)
  {
    if ($con === null) 
      $con = Propel::getConnection(self::DATABASE_NAME);
    
    $con->setAutoCommit(false);
    
    try {

      $ic = new OpInstitutionCharge();
      
      # descrizione dell'incarico
      if ($charge_description != "" && 
          strtolower($charge_description) != strtolower($charge_type_name)) 
            $ic->setDescription(ucfirst($charge_description));
            
      # date di inizio e fine incarico
      if ($date_start != "") $ic->setDateStart($date_start);
      if ($date_end != "") $ic->setDateEnd($date_end);

      
      # politico (oggetto opPolitician)
      $ic->setOpPolitician($pol);


      # istituzione (oggetto opInstitution)
      $c = new Criteria();
      $c->add(OpInstitutionPeer::NAME, $institution_name);
      $o = OpInstitutionPeer::doSelectOne($c, $con);
      if ($o instanceof OpInstitution)
        $ic->setOpInstitution($o);
      else
        throw new Exception("Istituzione non trovata");
      unset($c); unset($o);

      # tipo di incarico (oggetto opChatgeType)
      $c = new Criteria();
      $c->add(OpChargeTypePeer::NAME, $charge_type_name);
      $o = OpChargeTypePeer::doSelectOne($c, $con);
      if ($o instanceof OpChargeType)
        $ic->setOpChargeType($o);
      else
        throw new Exception("Tipo di incarico non trovato");
      unset($c); unset($o);

      # location
      if ($loc instanceof OpLocation)
        $ic->setOpLocation($loc);
      else
        throw new Exception("Localita' non trovata");
  
      # partito
      if ($party_name !== null)
      {        
        $c = new Criteria();
        $c->add(OpPartyPeer::NAME, $party_name);
        $o = OpPartyPeer::doSelectOne($c, $con);
        if (!$o instanceof OpParty)
        {
          $o = new OpParty();
          $o->setName(ucwords($party_name));
          $o->save($con);
        }
        
        # considera l'id originale, se esiste
        if ($o->getOid() !== null && $o->getOid() != 0)
          $party_id = $o->getOid();
        else
          $party_id = $o->getId();
        $party = OpPartyPeer::retrieveByPK($party_id, $con);
          
        $ic->setOpParty($party);

        # controlla l'esistenza del record nella op_party_location
        # e, in caso, lo aggiunge
        $party_loc = OpPartyLocationPeer::retrieveByPk($party_id, $loc->getId(), $con);
        if (! $party_loc instanceof OpPartyLocation)
        {
          $pl = new OpPartyLocation();
          $pl->setOpParty($party);
          $pl->setOpLocation($loc);
          $pl->save($con);
        }

      }
      unset($c); unset($o);


      # group (considera l'id unificante)
      if ($group_name !== null)
      {        
        $c = new Criteria();
        $c->add(OpGroupPeer::NAME, $group_name);
        $o = OpGroupPeer::doSelectOne($c, $con);
        if (!$o instanceof OpGroup)
        {
          $o = new OpGroup();
          $o->setName($group);
          $o->save($con);
        }
        if ($o->getOid() !== null && $o->getOid() != 0)
          $group_id = $o->getOid();
        else
          $group_id = $o->getId();
        $group = OpGroupPeer::retrieveByPK($group_id, $con);
        $ic->setOpGroup($group);

        # controlla l'esistenza del record nella op_group_location
        # e, in caso, lo aggiunge
        $group_loc = OpGroupLocationPeer::retrieveByPk($group_id, $loc->getId(), $con);
        if (! $group_loc instanceof OpGroupLocation)
        {
          $gl = new OpGroupLocation();
          $gl->setOpGroup($group);
          $gl->setOpLocation($loca);
          $gl->save($con);
        }

      }
      unset($c); unset($o);

      # constituency (oggetto opConstituency)
      if ($constituency_name !== null)
      {        
        $c = new Criteria();
        $c->add(OpConstituencyPeer::NAME, $constituency_name);
        $o = OpConstituencyPeer::doSelectOne($c, $con);
        if (!$o instanceof OpConstituecy)
        {
          $o = new OpConstituency();
          $o->setName($constituency_name);
          $o->save($con);
        }
        $ic->setOpConstituency($o);

        # controlla l'esistenza del record nella op_contituency_location
        # e, in caso, lo aggiunge
        $const_loc = OpConstituencyLocationPeer::retrieveByPk($o->getId(), $loc->getId(), $con);
        if (! $const_loc instanceof OpConstituencyLocation)
        {
          $gl = new OpConstituencyLocation();
          $gl->setOpConstituency($o);
          $gl->setOpLocation($loc);
          $gl->save($con);
        }
      }
      unset($c); unset($o);

      # salvataggio del record, con indexing, per conto di admin (id: 1)
      $ic->save(false, $con, 1);

      $con->commit();
      
      unset($c); unset($p);
      return $ic;

    } catch (PropelException $e) {

      $con->rollback();
      throw new Exception($e->getMessage());
      return null;
      unset($ic); unset($c); unset($p);
      
    }
    
  }


  /**
   * retrieve all charges that matches various 'data'
   *
   * @param OpPolitician $politician 
   * @param string $inst_name 
   * @param OpLocation $loc 
   * @param string $charge_type_name (not needed)
   * @param string $crit 
   * @param string $con 
   * @return array of OpInstitutionCharges
   * @author Guglielmo Celata
   */
  public static function getByImportData($politician, $inst_name, $loc, $charge_type_name = null, $crit = null, $con = null)
  {
    if (is_null($crit))
      $c = new Criteria();
    else
      $c = clone $crit;
      
    $c->add(self::POLITICIAN_ID, $politician->getContentId());
    
    $c->addJoin(self::INSTITUTION_ID, OpInstitutionPeer::ID);
    $c->add(OpInstitutionPeer::NAME, $inst_name);

    if (!is_null($charge_type_name)) {
      $c->addJoin(self::CHARGE_TYPE_ID, OpChargeTypePeer::ID);
      $c->add(OpChargeTypePeer::NAME, $charge_type_name);
    }
    
    $c->addJoin(self::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
    $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
    
    $c->add(self::LOCATION_ID, $loc->getId());
    $res = self::doSelect($c, $con);
    
    unset($c);
    
    return $res;
  }


  /**
   * estrae il record dell'incarico, in base ai parametri passati
   * si considerano solo incarichi attuali
   *
   * @param politician - required - OpPolitician politico di cui si cerca l'incarico
   * @param inst - required - istituzione (Giunta Comunale, Consiglio Comunale,  Provinciale, Regionale, ...) come in OpInstitution
   * @param loc - required - OpLocation
   * @param charge_type_name - required - Nome del tipo di incarico
   * @return void
   * @author Guglielmo Celata
   **/
  public static function retrieveCurrentByImportData($politician, $inst_name, $loc, $charge_type_name, $con = null)
  {
    $c = new Criteria();
    $c->add(self::DATE_END, null, Criteria::ISNULL);
    
    $res = self::getByImportData($politician, $inst_name, $loc, $charge_type_name, $c, $con);
    unset($c);
    
    if (count($res) == 1) return $res[0];
    else if (count($res) > 1) return self::DUPLICATE_RECORD;
    else return self::NO_RECORD;
  }
  
  
  

  /**
   * fetch all members of the given organ in the given location
   *
   * @param string $organ_code (as specified in app.yml) ex: sfConfig::get('app_institution_id_GR')
   * @param int $location_id
   * @param bool $is_president (if to look for a president or for non president, null meaning: don't care)
   * @return array of opInstitutionCharge, joined with:
   *          OpPolitician, OpLocation, OpChargeType, OpParty
   * @author Guglielmo Celata
   */
  public static function fetchOrganMembers($organ_code, $location_id, $is_presidente = null)
  {
    $c = new Criteria();
    $c->add(OpInstitutionChargePeer::INSTITUTION_ID, $organ_code);  
    $c->add(OpInstitutionChargePeer::LOCATION_ID, $location_id);
    $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    if (!is_null($is_presidente))
    {
      if ($is_presidente === true)
        $c->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'));
      else
        $c->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_presidente'), Criteria::NOT_IN);
    }
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c->addAscendingOrderByColumn(OpChargeTypePeer::PRIORITY);
    $c->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
    return OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c); 
    
  }
  
  /**
   * fetch all members of the given organ, given group and gine charge_type in the given location
   *
   * @param int $institution_id
   * @param array $charge_type
   * @param int $location_id
   * @param int $group_id
   * @return array of opInstitutionCharge, joined with:
   *          OpPolitician, OpLocation, OpChargeType, OpParty
   * @author Ettore Di Cesare
   */
  public static function fetchOrganMembersByGroup($institution_id, $charge_type, $location_id, $group_id)
  {
    $c = new Criteria();
    $c->add(OpInstitutionChargePeer::INSTITUTION_ID, $institution_id);  
    $c->add(OpInstitutionChargePeer::LOCATION_ID, $location_id);
    $c->add(OpInstitutionChargePeer::GROUP_ID, $group_id);
    $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $charge_type, Criteria::IN);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c->addAscendingOrderByColumn(OpChargeTypePeer::PRIORITY);
    $c->addAscendingOrderByColumn(OpPoliticianPeer::LAST_NAME);
    return OpInstitutionChargePeer::doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty($c); 
    
  }
  
  public function getParlamentariInCarica($ramo = null,$politician_id = null)
  {
    $c = new Criteria();
     $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpInstitutionChargePeer::CONTENT_ID, Criteria::LEFT_JOIN);
     $criterion = $c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CD'), Criteria::EQUAL);
     $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_SR'), Criteria::EQUAL));
     $c->add($criterion);
    if ($ramo =='C')
      $c->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_deputato'), Criteria::EQUAL); 
    elseif ($ramo =='S')
      $c->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore'), Criteria::EQUAL);
    else
    {
      $criterion = $c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_deputato'), Criteria::EQUAL);
      $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore'), Criteria::EQUAL));
      $c->add($criterion);
    }
    
    if ($politician_id!= NULL)
      $c->add(OpInstitutionChargePeer::POLITICIAN_ID, $politician_id);
      
    $c->add(OpInstitutionChargePeer::DATE_END, NULL , Criteria::EQUAL);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    return OpInstitutionChargePeer::doSelect($c); 
  }

	public static function doSelectJoinOpPoliticianAndOpPoliticianAndOpGroupAndOpChargeType(Criteria $c, $con = null)
	{
		$c = clone $c;
	
		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}
	
		// Add select columns for OpInstitutionCharge
		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
	
		// Add select columns for OpPolitician
		OpPoliticianPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPoliticianPeer::NUM_COLUMNS ;
	
		// Add select columns for OpGroup
		OpGroupPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpGroupPeer::NUM_COLUMNS ;
		
		// Add select columns for OpConstituency
		OpConstituencyPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpConstituencyPeer::NUM_COLUMNS ;
		
		// Add select columns for OpChargeType
		OpChargeTypePeer::addSelectColumns($c);
	
		// Join methods (uso il criterio left_join so voglio il risultato anche se il campo join è vuoto
		$c->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);
		$c->addJoin(OpInstitutionChargePeer::GROUP_ID, OpGroupPeer::ID);
		$c->addJoin(OpInstitutionChargePeer::CONSTITUENCY_ID, OpConstituencyPeer::ID, Criteria::LEFT_JOIN);
		$c->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);		
	
		$rs = BasePeer::doSelect($c, $con);
		$results = array();
	
		while($rs->next())
		{
		  // Hydrate the OpInstitutionCharge object
		  $omClass = OpInstitutionChargePeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj1 = new $cls();
		  $obj1->hydrate($rs);
	
		  // Hydrate the OpPolitician object
		  $omClass = OpPoliticianPeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj2 = new $cls();
		  $obj2->hydrate($rs, $startcol2);
	
		  // Hydrate the OpGroup object
		  $omClass = OpGroupPeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj3 = new $cls();
		  $obj3->hydrate($rs, $startcol3);
		  
		  // Hydrate the OpConstituency object
		  $omClass = OpConstituencyPeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj4 = new $cls();
		  $obj4->hydrate($rs, $startcol4);
		  
		  // Hydrate the OpChargeType object
		  $omClass = OpChargeTypePeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj5 = new $cls();
		  $obj5->hydrate($rs, $startcol5);
	
		  // [NOTE 2]
		  $obj1->setOpPolitician($obj2);
		  $obj1->setOpGroup($obj3); 
		  $obj1->setOpConstituency($obj4);
		  $obj1->setOpChargeType($obj5);
		  $results[] = $obj1;
		}
			
		return $results;
	}
	  
	public static function doSelectJoinOpPoliticianAndOpLocationAndOpChargeType(Criteria $c, $con = null)
	{
		$c = clone $c;
	
		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}
	
		// Add select columns for OpInstitutionCharge
		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
	
		// Add select columns for OpPolitician
		OpPoliticianPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPoliticianPeer::NUM_COLUMNS ;
	
		// Add select columns for OpLocation
		OpLocationPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpLocationPeer::NUM_COLUMNS ;
		
		// Add select columns for OpChargeType
		OpChargeTypePeer::addSelectColumns($c);
	
		// Join methods (uso il criterio left_join so voglio il risultato anche se il campo join è vuoto
		$c->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);
		$c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OplocationPeer::ID);
		$c->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);		
	
		$rs = BasePeer::doSelect($c, $con);
		$results = array();
	
		while($rs->next())
		{
		  // Hydrate the OpInstitutionCharge object
		  $omClass = OpInstitutionChargePeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj1 = new $cls();
		  $obj1->hydrate($rs);
	
		  // Hydrate the OpPolitician object
		  $omClass = OpPoliticianPeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj2 = new $cls();
		  $obj2->hydrate($rs, $startcol2);
	
		  // Hydrate the OpLocation object
		  $omClass = OpLocationPeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj3 = new $cls();
		  $obj3->hydrate($rs, $startcol3);
		  		  
		  // Hydrate the OpChargeType object
		  $omClass = OpChargeTypePeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj4 = new $cls();
		  $obj4->hydrate($rs, $startcol4);
	
		  // 
		  $obj1->setOpPolitician($obj2);
		  $obj1->setOpLocation($obj3); 
		  $obj1->setOpChargeType($obj4);
		  $results[] = $obj1;
		}
			
		return $results;
	}
	  
	public static function doSelectJoinOpPoliticianAndOpLocationAndOpChargeTypeAndOpParty(Criteria $c, $con = null)
	{
		$c = clone $c;
	
		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}
	
		// Add select columns for OpInstitutionCharge
		OpInstitutionChargePeer::addSelectColumns($c);
		$startcol2 = (OpInstitutionChargePeer::NUM_COLUMNS - OpInstitutionChargePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
	
		// Add select columns for OpPolitician
		OpPoliticianPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + OpPoliticianPeer::NUM_COLUMNS ;
	
		// Add select columns for OpLocation
		OpLocationPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + OpLocationPeer::NUM_COLUMNS ;
		
		// Add select columns for OpChargeType
		OpChargeTypePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + OpChargeTypePeer::NUM_COLUMNS ;
		
		// Add select columns for OpParty
		OpPartyPeer::addSelectColumns($c);
	
		// Join methods (uso il criterio left_join so voglio il risultato anche se il campo join è vuoto
		$c->addJoin(OpInstitutionChargePeer::POLITICIAN_ID, OpPoliticianPeer::CONTENT_ID);
		$c->addJoin(OpInstitutionChargePeer::LOCATION_ID, OplocationPeer::ID);
		$c->addJoin(OpInstitutionChargePeer::CHARGE_TYPE_ID, OpChargeTypePeer::ID);
		$c->addJoin(OpInstitutionChargePeer::PARTY_ID, OpPartyPeer::ID);		
		$c->addGroupByColumn(OpInstitutionChargePeer::POLITICIAN_ID);
	
		$rs = BasePeer::doSelect($c, $con);
		$results = array();
	
		while($rs->next())
		{
		  // Hydrate the OpInstitutionCharge object
		  $omClass = OpInstitutionChargePeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj1 = new $cls();
		  $obj1->hydrate($rs);
	
		  // Hydrate the OpPolitician object
		  $omClass = OpPoliticianPeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj2 = new $cls();
		  $obj2->hydrate($rs, $startcol2);
	
		  // Hydrate the OpLocation object
		  $omClass = OpLocationPeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj3 = new $cls();
		  $obj3->hydrate($rs, $startcol3);
		  		  
		  // Hydrate the OpChargeType object
		  $omClass = OpChargeTypePeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj4 = new $cls();
		  $obj4->hydrate($rs, $startcol4);
		  
		  // Hydrate the OpParty object
		  $omClass = OpPartyPeer::getOMClass();
	
		  $cls = Propel::import($omClass);
		  $obj5 = new $cls();
		  $obj5->hydrate($rs, $startcol5);
	
		  // 
		  $obj1->setOpPolitician($obj2);
		  $obj1->setOpLocation($obj3); 
		  $obj1->setOpChargeType($obj4);
		  $obj1->setOpParty($obj5);
		  $results[] = $obj1;
		}
			
		return $results;
	}
	  
	public static function getChargesGroupByPolitician($institution_id=0,$sex='X',$last_name='',$limit='0')
	{
		$con = Propel::getConnection();
		  
	  	$sql = '
			SELECT '.OpInstitutionChargePeer::POLITICIAN_ID.' ,
			COUNT(*) AS cont 
			FROM '.OpInstitutionChargePeer::TABLE_NAME.'
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.'
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID;
			
		if($sex=='M' || $sex=='F')
		{
			$sql.=' LEFT JOIN '.OpPoliticianPeer::TABLE_NAME.'
			ON '.OpPoliticianPeer::CONTENT_ID.'='.OpInstitutionChargePeer::POLITICIAN_ID;
		}
		
		if($last_name!='')
		{
			$sql.=' LEFT JOIN '.OpPoliticianPeer::TABLE_NAME.' 
			ON '.OpPoliticianPeer::CONTENT_ID.'='.OpInstitutionChargePeer::POLITICIAN_ID;
		}
		$sql.=' WHERE '.OpOpenContentPeer::DELETED_AT.' IS NULL
			AND '.OpInstitutionChargePeer::DATE_END.' IS NULL';
			
		if($institution_id!=0)
		{
			$sql.=' AND '.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id;
		}
		
		if($sex=='M' || $sex=='F')
		{
			$sql.=' AND '.OpPoliticianPeer::SEX.'=\''.$sex.'\'';
		}
		if($last_name!='')
		{
			$sql.=' AND '.OpPoliticianPeer::LAST_NAME.' LIKE \'%'.$last_name.'\' ';
		}	
		$sql.=' GROUP BY '.OpInstitutionChargePeer::POLITICIAN_ID;
		if($limit!=0)
		{
			$sql.=' LIMIT '.$limit;
		}
		 
	  	$stmt = $con->prepareStatement($sql);
  		$rs = $stmt->executeQuery();
		
		$tot=0;
		while ($rs->next())
  		{
    		$tot++;	
    	}
 		
		//return parent::populateObjects($rs);
		return $tot;
	}
	
	//aggiunta 28-12-2007
	public static function getChargesGroupByPoliticianNotInst($institution_id=0,$institution_id1=0,$sex='X',$last_name='',$limit='0')
	{
		$con = Propel::getConnection();
		  
	  	$sql = '
			SELECT '.OpInstitutionChargePeer::POLITICIAN_ID.' ,
			COUNT(*) AS cont 
			FROM '.OpInstitutionChargePeer::TABLE_NAME.'
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.'
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID;
			
		if($sex=='M' || $sex=='F')
		{
			$sql.=' LEFT JOIN '.OpPoliticianPeer::TABLE_NAME.'
			ON '.OpPoliticianPeer::CONTENT_ID.'='.OpInstitutionChargePeer::POLITICIAN_ID;
		}
		
		if($last_name!='')
		{
			$sql.=' LEFT JOIN '.OpPoliticianPeer::TABLE_NAME.' 
			ON '.OpPoliticianPeer::CONTENT_ID.'='.OpInstitutionChargePeer::POLITICIAN_ID;
		}
		$sql.=' WHERE '.OpOpenContentPeer::DELETED_AT.' IS NULL
			AND '.OpInstitutionChargePeer::DATE_END.' IS NULL';
			
		if($institution_id!=0)
		{
			$sql.=' AND '.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id;
		}
		
		if($institution_id1!=0)
		{
			$sql.=' AND '.OpInstitutionChargePeer::INSTITUTION_ID.'<>'.$institution_id1;
		}

		if($sex=='M' || $sex=='F')
		{
			$sql.=' AND '.OpPoliticianPeer::SEX.'=\''.$sex.'\'';
		}
		if($last_name!='')
		{
			$sql.=' AND '.OpPoliticianPeer::LAST_NAME.' LIKE \'%'.$last_name.'\' ';
		}	
		$sql.=' GROUP BY '.OpInstitutionChargePeer::POLITICIAN_ID;
		if($limit!=0)
		{
			$sql.=' LIMIT '.$limit;
		}
		 
	  	$stmt = $con->prepareStatement($sql);
  		$rs = $stmt->executeQuery();
		
		$tot=0;
		while ($rs->next())
  		{
    		$tot++;	
    	}
 		
		//return parent::populateObjects($rs);
		return $tot;
	}

	//fine aggiunta

	public static function getChargesGroupByParty($limit=10)
	{
		$con = Propel::getConnection();
				  
	  	$sub_query = '
			( SELECT '.OpInstitutionChargePeer::POLITICIAN_ID.' ,'.
			OpInstitutionChargePeer::PARTY_ID.' ,'.
			OpPartyPeer::NAME.' ,
			COUNT(*) AS cont 
			FROM '.OpInstitutionChargePeer::TABLE_NAME.'
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.'
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID.'
			LEFT JOIN '.OpPartyPeer::TABLE_NAME.'
			ON '.OpPartyPeer::ID.'='.OpInstitutionChargePeer::PARTY_ID.'
			WHERE ('.OpOpenContentPeer::DELETED_AT.' IS NULL
			AND '.OpInstitutionChargePeer::DATE_END.' IS NULL)
			GROUP BY '.OpInstitutionChargePeer::POLITICIAN_ID. '
			) AS politician_list';
		
		$query = '
			SELECT politician_list.PARTY_ID, politician_list.NAME AS name, COUNT(*) AS party_cont FROM '.
			$sub_query.' 
			GROUP BY politician_list.PARTY_ID 
			ORDER BY party_cont DESC 
			LIMIT '.$limit;
				
		 
	  	$stmt = $con->prepareStatement($query);
  		$rs = $stmt->executeQuery();
		
		return $rs;
	}

	public static function getChargesGroupByPartyWithPoliticiansWithMoreThanOneCharge($limit=10)
	{
		$con = Propel::getConnection();
				  
	  	$sub_query = '
			( SELECT '.OpInstitutionChargePeer::POLITICIAN_ID.' ,'.
			OpInstitutionChargePeer::PARTY_ID.' ,'.
			OpPartyPeer::NAME.' ,
			COUNT(*) AS cont 
			FROM '.OpInstitutionChargePeer::TABLE_NAME.'
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.'
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID.'
			LEFT JOIN '.OpPartyPeer::TABLE_NAME.'
			ON '.OpPartyPeer::ID.'='.OpInstitutionChargePeer::PARTY_ID.'
			WHERE ('.OpOpenContentPeer::DELETED_AT.' IS NULL
			AND '.OpInstitutionChargePeer::DATE_END.' IS NULL)
			GROUP BY '.OpInstitutionChargePeer::POLITICIAN_ID. '
			HAVING cont>1) AS politician_list';
		
		$query = '
			SELECT politician_list.PARTY_ID, politician_list.NAME AS name, COUNT(*) AS party_cont FROM '.
			$sub_query.' 
			GROUP BY politician_list.PARTY_ID 
			ORDER BY party_cont DESC 
			LIMIT '.$limit;
				
		 
	  	$stmt = $con->prepareStatement($query);
  		$rs = $stmt->executeQuery();
		
		return $rs;
	}
	
	public static function getFixedChargeGroupByParty($institution_id, $charge_type_id, $limit=10)
	{
		$con = Propel::getConnection();
				  
	  	$sub_query = '
			( SELECT '.OpInstitutionChargePeer::POLITICIAN_ID.' ,'.
			OpInstitutionChargePeer::PARTY_ID.' ,'.
			OpPartyPeer::NAME.' ,
			COUNT(*) AS cont 
			FROM '.OpInstitutionChargePeer::TABLE_NAME.'
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.'
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID.'
			LEFT JOIN '.OpPartyPeer::TABLE_NAME.'
			ON '.OpPartyPeer::ID.'='.OpInstitutionChargePeer::PARTY_ID.'
			WHERE ('.OpOpenContentPeer::DELETED_AT.' IS NULL
			AND '.OpInstitutionChargePeer::DATE_END.' IS NULL
			AND '.OpInstitutionChargePeer::INSTITUTION_ID.'
			='.$institution_id.' AND '.OpInstitutionChargePeer::CHARGE_TYPE_ID.'='.$charge_type_id.')
			GROUP BY '.OpInstitutionChargePeer::POLITICIAN_ID. '
			) AS politician_list';
		
		$query = '
			SELECT politician_list.PARTY_ID, politician_list.NAME AS name, COUNT(*) AS party_cont FROM '.
			$sub_query.' 
			GROUP BY politician_list.PARTY_ID 
			ORDER BY party_cont DESC 
			LIMIT '.$limit;
				
		 
	  	$stmt = $con->prepareStatement($query);
  		$rs = $stmt->executeQuery();
		
		return $rs;
	}
	
	public static function getAverageAge($member_number=100, $limit=10)
	{
		$con = Propel::getConnection();
				  
	  	$sub_query = '
			( SELECT '.OpInstitutionChargePeer::POLITICIAN_ID.' ,'.
			OpPoliticianPeer::BIRTH_DATE.' ,'.
			OpInstitutionChargePeer::PARTY_ID.' ,'.
			OpPartyPeer::NAME.' ,
			COUNT(*) AS cont 
			FROM '.OpInstitutionChargePeer::TABLE_NAME.'
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.'
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID.'
			LEFT JOIN '.OpPartyPeer::TABLE_NAME.'
			ON '.OpPartyPeer::ID.'='.OpInstitutionChargePeer::PARTY_ID.'
			LEFT JOIN '.OpPoliticianPeer::TABLE_NAME.'
			ON '.OpPoliticianPeer::CONTENT_ID.'='.OpInstitutionChargePeer::POLITICIAN_ID.'
			WHERE ('.OpOpenContentPeer::DELETED_AT.' IS NULL
			AND '.OpInstitutionChargePeer::DATE_END.' IS NULL) 
			GROUP BY '.OpInstitutionChargePeer::POLITICIAN_ID. '
			) AS politician_list';
		
		$query = '
			SELECT politician_list.PARTY_ID, politician_list.NAME AS name, COUNT(*) AS party_cont,
			AVG(year(politician_list.BIRTH_DATE)) AS birth_date_avg FROM '.
			$sub_query.' 
			GROUP BY politician_list.PARTY_ID HAVING party_cont>'.$member_number.' 
			ORDER BY birth_date_avg ASC 
			LIMIT '.$limit;
		
		$stmt = $con->prepareStatement($query);
  		$rs = $stmt->executeQuery();
		
		return $rs;		
		
	}
	
	public static function getCountEducationLevel($education_level_id=7, $member_number=100, $limit=10)
	{
		$con = Propel::getConnection();
				  
	  	$sub_query = '
			( SELECT '.OpInstitutionChargePeer::POLITICIAN_ID.' ,'.
			OpPoliticianPeer::BIRTH_DATE.' ,'.
			OpInstitutionChargePeer::PARTY_ID.' ,'.
			OpPartyPeer::NAME.' ,
			COUNT(*) AS cont 
			FROM '.OpInstitutionChargePeer::TABLE_NAME.'
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.'
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID.'
			LEFT JOIN '.OpPartyPeer::TABLE_NAME.'
			ON '.OpPartyPeer::ID.'='.OpInstitutionChargePeer::PARTY_ID.'
			LEFT JOIN '.OpPoliticianPeer::TABLE_NAME.'
			ON '.OpPoliticianPeer::CONTENT_ID.'='.OpInstitutionChargePeer::POLITICIAN_ID.'
			LEFT JOIN '.OpPoliticianHasOpEducationLevelPeer::TABLE_NAME.' 
			ON '.OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID.'='.OpPoliticianPeer::CONTENT_ID.'
			WHERE ('.OpOpenContentPeer::DELETED_AT.' IS NULL
			AND '.OpInstitutionChargePeer::DATE_END.' IS NULL
			AND '.OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID.'='.$education_level_id.') 
			GROUP BY '.OpInstitutionChargePeer::POLITICIAN_ID. '
			) AS politician_list';
		
		$query = '
			SELECT politician_list.PARTY_ID, politician_list.NAME AS name, COUNT(*) AS party_cont FROM'.
			$sub_query.' 
			GROUP BY politician_list.PARTY_ID HAVING party_cont>'.$member_number.' 
			ORDER BY party_cont DESC 
			LIMIT '.$limit;
		
		$stmt = $con->prepareStatement($query);
  		$rs = $stmt->executeQuery();
		
		return $rs;		
		
	}
	
	public static function getInstitutionAverageAge($institution_id=2)
	{
		$con = Propel::getConnection();
				  
	  	$query = '
			SELECT COUNT(*), AVG(year('.OpPoliticianPeer::BIRTH_DATE.')) AS birth_date_avg 
			FROM '.OpInstitutionChargePeer::TABLE_NAME.' 
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.' 
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID.' 
			LEFT JOIN '.OpPoliticianPeer::TABLE_NAME .' ON '.OpPoliticianPeer::CONTENT_ID.'='.
			OpInstitutionChargePeer::POLITICIAN_ID.' 
			WHERE '.OpOpenContentPeer::DELETED_AT.' IS NULL AND '.
			OpInstitutionChargePeer::DATE_END.' IS NULL AND '.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id.' 
			GROUP BY '.OpInstitutionChargePeer::INSTITUTION_ID;
				
		 
	  	$stmt = $con->prepareStatement($query);
  		$rs = $stmt->executeQuery();
		
		$tot=0;
		while ($rs->next())
  		{
    		$tot=$rs->get('birth_date_avg');	
    	}
		
		return $tot;
	}
	
	public static function getInstitutionEducationLevel($institution_id=2, $education_level=7)
	{
		$con = Propel::getConnection();
				  
	  	$query = '
			SELECT COUNT(*) AS cont  
			FROM '.OpInstitutionChargePeer::TABLE_NAME.' 
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.' 
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID.' 
			LEFT JOIN '.OpPoliticianPeer::TABLE_NAME .' ON '.OpPoliticianPeer::CONTENT_ID.'='.
			OpInstitutionChargePeer::POLITICIAN_ID.' 
			LEFT JOIN '.OpPoliticianHasOpEducationLevelPeer::TABLE_NAME.' 
			ON  '.OpPoliticianPeer::CONTENT_ID.'='.OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID.' 
			WHERE '.OpOpenContentPeer::DELETED_AT.' IS NULL AND '.
			OpInstitutionChargePeer::DATE_END.' IS NULL AND '.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id.' 
			AND '.OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID.'='.$education_level.' 
			GROUP BY '.OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID;
				
		 
	  	$stmt = $con->prepareStatement($query);
  		$rs = $stmt->executeQuery();
		
		$tot=0;
		while ($rs->next())
  		{
    		$tot=$rs->getInt('cont');	
    	}
		
		return $tot;
	}
	
	public static function getInstitutionEducationLevelCount($institution_id=2)
	{
		$con = Propel::getConnection();
				  
	  	$query = '
			SELECT COUNT(*) AS cont  
			FROM '.OpInstitutionChargePeer::TABLE_NAME.' 
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.' 
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID.' 
			LEFT JOIN '.OpPoliticianPeer::TABLE_NAME .' ON '.OpPoliticianPeer::CONTENT_ID.'='.
			OpInstitutionChargePeer::POLITICIAN_ID.' 
			LEFT JOIN '.OpPoliticianHasOpEducationLevelPeer::TABLE_NAME.' 
			ON  '.OpPoliticianPeer::CONTENT_ID.'='.OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID.' 
			WHERE '.OpOpenContentPeer::DELETED_AT.' IS NULL AND '.
			OpInstitutionChargePeer::DATE_END.' IS NULL AND '.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id.' 
			AND '.OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID.'<>1 AND '.
			OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID.'<>2';	
				
		 
	  	$stmt = $con->prepareStatement($query);
  		$rs = $stmt->executeQuery();
		
		$tot=0;
		while ($rs->next())
  		{
    		$tot=$rs->getInt('cont');	
    	}
		
		return $tot;
	}
	
	public static function getChargesGroupByLocationPolitician($location_id,$institution_id1=0,$institution_id2=0,$sex='X')
	{
		$con = Propel::getConnection();
		  
	  	$sql = '
			SELECT '.OpInstitutionChargePeer::POLITICIAN_ID.' ,
			COUNT(*) AS cont 
			FROM '.OpInstitutionChargePeer::TABLE_NAME.'
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.'
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID;
			
		if($sex=='M' || $sex=='F')
		{
			$sql.=' LEFT JOIN '.OpPoliticianPeer::TABLE_NAME.'
			ON '.OpPoliticianPeer::CONTENT_ID.'='.OpInstitutionChargePeer::POLITICIAN_ID;
		}
		
		$sql.=' WHERE '.OpOpenContentPeer::DELETED_AT.' IS NULL
			AND '.OpInstitutionChargePeer::DATE_END.' IS NULL';
			
		if($institution_id1!=0)
		{
			$sql.=' AND ('.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id1;
		}
		
		if($institution_id2!=0)
		{
			$sql.=' OR '.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id2.')';
		}
		
		if($sex=='M' || $sex=='F')
		{
			$sql.=' AND '.OpPoliticianPeer::SEX.'=\''.$sex.'\'';
		}	
		
		$sql.=' AND '.OpInstitutionChargePeer::LOCATION_ID.'='.$location_id;
		
		$sql.=' GROUP BY '.OpInstitutionChargePeer::POLITICIAN_ID;
		 
	  	$stmt = $con->prepareStatement($sql);
  		$rs = $stmt->executeQuery();
		
		$tot=0;
		while ($rs->next())
  		{
    		$tot++;	
    	}
 		
		//return parent::populateObjects($rs);
		return $tot;
	}
	
	
	
	
	public static function getLocationAverageAge($location_id,$institution_id1=0,$institution_id2=0)
	{
		$con = Propel::getConnection();
				  
	  	$query = '
			SELECT COUNT(*), AVG(year('.OpPoliticianPeer::BIRTH_DATE.')) AS birth_date_avg 
			FROM '.OpInstitutionChargePeer::TABLE_NAME.' 
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.' 
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID.' 
			LEFT JOIN '.OpPoliticianPeer::TABLE_NAME .' ON '.OpPoliticianPeer::CONTENT_ID.'='.
			OpInstitutionChargePeer::POLITICIAN_ID.' 
			WHERE '.OpOpenContentPeer::DELETED_AT.' IS NULL AND '.
			OpInstitutionChargePeer::DATE_END.' IS NULL AND ('.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id1.' 
			OR '.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id2.') 
			AND '. OpInstitutionChargePeer::LOCATION_ID.'='.$location_id.' 
			GROUP BY '.OpInstitutionChargePeer::LOCATION_ID;
				
		 
	  	$stmt = $con->prepareStatement($query);
  		$rs = $stmt->executeQuery();
		
		$tot=0;
		while ($rs->next())
  		{
    		$tot=$rs->get('birth_date_avg');	
    	}
		
		return $tot;
	}
	
	public static function getLocationEducationLevel($location_id,$institution_id1=0,$institution_id2=0,$education_level)
	{
		$con = Propel::getConnection();
				  
	  	$query = '
			SELECT COUNT(*) AS cont  
			FROM '.OpInstitutionChargePeer::TABLE_NAME.' 
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.' 
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID.' 
			LEFT JOIN '.OpPoliticianPeer::TABLE_NAME .' ON '.OpPoliticianPeer::CONTENT_ID.'='.
			OpInstitutionChargePeer::POLITICIAN_ID.' 
			LEFT JOIN '.OpPoliticianHasOpEducationLevelPeer::TABLE_NAME.' 
			ON  '.OpPoliticianPeer::CONTENT_ID.'='.OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID.' 
			WHERE '.OpOpenContentPeer::DELETED_AT.' IS NULL AND '.
			OpInstitutionChargePeer::DATE_END.' IS NULL AND ('.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id1.' 
			OR '.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id2.') 
			AND '. OpInstitutionChargePeer::LOCATION_ID.'='.$location_id.' 
			AND '.OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID.'='.$education_level.'
	        GROUP BY '.OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID;
				
		 
	  	$stmt = $con->prepareStatement($query);
  		$rs = $stmt->executeQuery();
		
		$tot=0;
		while ($rs->next())
  		{
    		$tot=$rs->getInt('cont');	
    	}
		
		return $tot;
	}
	
	public static function getLocationEducationLevelCount($location_id,$institution_id1=0,$institution_id2=0)
	{
		$con = Propel::getConnection();
				  
	  	$query = '
			SELECT COUNT(*) AS cont  
			FROM '.OpInstitutionChargePeer::TABLE_NAME.' 
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.' 
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID.' 
			LEFT JOIN '.OpPoliticianPeer::TABLE_NAME .' ON '.OpPoliticianPeer::CONTENT_ID.'='.
			OpInstitutionChargePeer::POLITICIAN_ID.' 
			LEFT JOIN '.OpPoliticianHasOpEducationLevelPeer::TABLE_NAME.' 
			ON  '.OpPoliticianPeer::CONTENT_ID.'='.OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID.' 
			WHERE '.OpOpenContentPeer::DELETED_AT.' IS NULL AND '.
			OpInstitutionChargePeer::DATE_END.' IS NULL AND ('.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id1.' 
			OR '.OpInstitutionChargePeer::INSTITUTION_ID.'='.$institution_id2.') 
			AND '. OpInstitutionChargePeer::LOCATION_ID.'='.$location_id.' 
			AND '.OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID.'<>1 AND '.
			OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID.'<>2';	
		 
	  	$stmt = $con->prepareStatement($query);
  		$rs = $stmt->executeQuery();
		
		$tot=0;
		while ($rs->next())
  		{
    		$tot=$rs->getInt('cont');	
    	}
		
		return $tot;
	}
	
	public static function getTotalAverageAge()
	{
		$con = Propel::getConnection();
				  
	  	$query = '
			SELECT COUNT(*), AVG(year('.OpPoliticianPeer::BIRTH_DATE.')) AS birth_date_avg 
			FROM '.OpInstitutionChargePeer::TABLE_NAME.' 
			LEFT JOIN '.OpOpenContentPeer::TABLE_NAME.' 
			ON '.OpOpenContentPeer::CONTENT_ID.'='.OpInstitutionChargePeer::CONTENT_ID.' 
			LEFT JOIN '.OpPoliticianPeer::TABLE_NAME .' ON '.OpPoliticianPeer::CONTENT_ID.'='.
			OpInstitutionChargePeer::POLITICIAN_ID.' 
			WHERE '.OpOpenContentPeer::DELETED_AT.' IS NULL AND '.
			OpInstitutionChargePeer::DATE_END.' IS NULL ';
				
		 
	  	$stmt = $con->prepareStatement($query);
  		$rs = $stmt->executeQuery();
		
		$tot=0;
		while ($rs->next())
  		{
    		$tot=$rs->get('birth_date_avg');	
    	}
		
		return $tot;
	}

  public function getPoliticianChargeAtDate ($politician_id, $date)
  {
    $c=new Criteria();
    $crit0 = $c->getNewCriterion(OpInstitutionChargePeer::POLITICIAN_ID,$politician_id);
    $crit1 = $c->getNewCriterion(OpInstitutionChargePeer::DATE_START,$date,Criteria::LESS_EQUAL);
    $crit2 = $c->getNewCriterion(OpInstitutionChargePeer::DATE_END,$date,Criteria::GREATER_EQUAL);
    $crit3 = $c->getNewCriterion(OpInstitutionChargePeer::DATE_END,NULL,Criteria::ISNULL);
    $crit2->addOr($crit3);
    $crit0->addAnd($crit1);
    $crit0->addAnd($crit2);
    $c->add($crit0);
    
    return OpInstitutionChargePeer::doSelect($c);
  }

} // OpInstitutionChargePeer

?>
