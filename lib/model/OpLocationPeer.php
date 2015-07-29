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
  require_once 'lib/model/om/BaseOpLocationPeer.php';
  
  // include object class
  include_once 'lib/model/OpLocation.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_location' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpLocationPeer extends BaseOpLocationPeer {



  /**
   * return all location corresponding to the passed ids
   *
   * @param array $ids 
   * @return array of OpLocation
   * @author Guglielmo Celata
   */
  public function getByIds($ids)
  {
    if (!is_array($ids))
      throw new Exception("ids parameter needs to be an array");
      
    $c = new Criteria();
    $c->add(self::ID, $ids, Criteria::IN);
    return self::doSelect($c);
  }
  
  /**
   * get all locations in context
   * reg: get all regions
   * prov: get all provinces
   * com.XXX: get all cities in priv identified by XXX
   *
   * @param string $context (reg, prov, com.XXX)
   * @return array of OpLocation
   * @author Guglielmo Celata
   */
  public function getByContext($context)
  {
    if ($context != 'reg' && $context != 'prov' && strpos($context, 'com') === false) {
  	  throw new Exception(sprintf("context %s does not exist", $context));
  	}

    $loc_type = self::loc_type($context);
    
    $c = new Criteria();
    $c->addJoin(self::LOCATION_TYPE_ID, OpLocationTypePeer::ID);
    $c->add(OpLocationTypePeer::NAME, ucfirst($loc_type));
    
    if ($loc_type == 'comune') {
      list($com, $minint_prov_code) = explode(".", $context);
      $unformatted_prov_code = (int)$minint_prov_code;
      $c->add(self::MININT_PROVINCIAL_CODE, $unformatted_prov_code);
    }
    
    return self::doSelect($c);
  }
  
  /**
   * DEPRECATED: use function above
   * fetch all locations of a given type
   * if location_type == 'comune', then fetch all location for the given province (if passed)
   *
   * @param string $location_type 
   * @param int    $minint_provincial_code
   * @return array of OpLocations
   * @author Guglielmo Celata
   */
  public static function fetchByMinintContext($location_type, $minint_provincial_code = null)
  {
    $c = new Criteria();
    $c->addJoin(self::LOCATION_TYPE_ID, OpLocationTypePeer::ID);
    $c->add(OpLocationTypePeer::NAME, ucfirst($location_type));
    if ($location_type == 'comune' && !is_null($minint_provincial_code)) {
      $c->add(self::MININT_PROVINCIAL_CODE, $minint_provincial_code);
    }
    
    # exclude ceased cities
    $c->add(self::DATE_END, null, Criteria::ISNULL);
    
    #define sorting
    $c->addAscendingOrderByColumn(self::MININT_REGIONAL_CODE);
    $c->addAscendingOrderByColumn(self::MININT_PROVINCIAL_CODE);
    $c->addAscendingOrderByColumn(self::MININT_CITY_CODE);
    return self::doSelect($c);
  }
  

  /**
   * returns a string identifying the context with an extended name
   *
   * @param string $context (reg, prov, com.xxx)
   * @return string (regione, provincia, comune)
   * @author Guglielmo Celata
   */
  public static function loc_type($context)
  {
    if ($context != 'reg' && $context != 'prov' && !strpos($context, 'com') == false) {
  	  throw new Exception(sprintf("context %s does not exist", $context));
  	}

    switch($context)
    {
      case 'reg':
        return "regione";
        break;
      case 'prov':
        return "provincia";
        break;
      default:
        return "comune";
        break;
    }

  }


  public static function getLocationsForAccessoAutocompleter($name_starts_with, $con = null)
  {
    if (is_null($con))
		  $con = Propel::getConnection(self::DATABASE_NAME);

    $sql = sprintf("select id, name, prov from op_location where location_type_id=6 and name like '%s%%' order by inhabitants desc;", $name_starts_with);
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    $items = array();
    while ($rs->next()) {
      $row = $rs->getRow();
      $items []= $row;
    }

    return array('locations' => $items);
  }


  public static function getLocationsForIndiceAutocompleter($name_starts_with, $con = null)
  {
    if (is_null($con))
		  $con = Propel::getConnection(self::DATABASE_NAME);

    $sql = sprintf("select lc.name, if(lc.name != lp.name, lp.name, '') as prov, c.slug as circ from op_location lc, op_location lp, op_constituency_location cl, op_constituency c, op_election_type et where lc.provincial_id=lp.provincial_id and lc.location_type_id = 6 and lp.location_type_id=5 and cl.location_id=lp.id and cl.constituency_id=c.id and c.election_type_id=et.id and et.name='Camera' and lc.name like '%s%%' order by lc.inhabitants desc;", $name_starts_with);
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    $items = array();
    while ($rs->next()) {
      $row = $rs->getRow();
      $items []= $row;
    }

    return array('locations' => $items);
  }


  /**
   * return all the cities ids contained by the location id
   * only valid cities as of now (date_end is null) are retrieved
   * @param string $location_id 
   * @param array  $const_ids
   * @return array of istat codes
   * @author Guglielmo Celata
   */
  public function getContainedCitiesIds($location_id, $const_ids)
  {
    $location = self::retrieveByPK($location_id);

    $c = new Criteria();
    $c->add(self::LOCATION_TYPE_ID, 6);
    $c->add(self::DATE_END, null, Criteria::ISNULL);
    $c->clearSelectColumns();
    $c->addSelectColumn(self::CITY_ID);
    $c->addAscendingOrderByColumn(self::CITY_ID);

    switch ($location->getLocationTypeId())
    {
      case 2:
      case 3:
        $const_provinces_ids = array();
        foreach ($const_ids as $constituency_id){
          $const_provinces_ids = array_merge($const_provinces_ids,
            OpConstituencyLocationPeer::getProvincialIdsByConstituency($constituency_id));
        }
        $const_provinces_ids = array_unique($const_provinces_ids);
        $c->add(self::PROVINCIAL_ID, $const_provinces_ids, Criteria::IN);
        break;
      case 4:
        $c->add(self::REGIONAL_ID, $location->getRegionalId());
        break;
      case 5:
        $c->add(self::PROVINCIAL_ID, $location->getProvincialId());
        break;
      case 6:
        $c->add(self::CITY_ID, $location->getCityId());
        break;
    }
    
    $ids = array();
    $rs = self::doSelectRS($c);
    while ($rs->next()) {
      $ids []= $rs->getInt(1);
    }
    
    return $ids;
    
  }

  /**
   * retriev the op_location object from the named location type
   * and minint codes
   *
   * minint_codes may be passed in any formats castable into int
   *
   * @param string $type  (regione, provincia, comune)
   * @param string $reg   01
   * @param string $prov  001
   * @param string $city  0001
   * @return OpLocation
   * @author Guglielmo Celata
   */
  public static function retrieveByMinIntCodes($type, $reg, $prov, $city)
  {
    $c = new Criteria();
    if ($reg !== null)  $c->add(self::MININT_REGIONAL_CODE, (int)$reg);
    if ($prov !== null) $c->add(self::MININT_PROVINCIAL_CODE, (int)$prov);
    if ($city !== null) $c->add(self::MININT_CITY_CODE, (int)$city);
    $c->addJoin(OpLocationTypePeer::ID, self::LOCATION_TYPE_ID);
    $c->add(OpLocationTypePeer::NAME, ucfirst($type));
    
    $res = self::doSelect($c);
    
    if (count($res) == 0) throw new sfDatabaseException('Nessun risultato', 0);
    if (count($res) >1 ) throw new sfDatabaseException('Più di un risultato', -1);
    return $res[0];
  }

  public static function retrieveByNameType($name, $type)
  {
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(self::NAME, $name);
    $crit1 = $c->getNewCriterion(self::ALTERNATIVE_NAME, $name);
    $crit0->addOr($crit1);
    $c->add($crit0);
    $c->addJoin(OpLocationTypePeer::ID, self::LOCATION_TYPE_ID);
    $c->add(OpLocationTypePeer::NAME, $type);
    return self::doSelectOne($c);
  }


  /**
   * torna l'opLocation relativo alla provincia, avendo passato la sigla
   *
   * @param string - la sigla (due lettere)
   * @return opLocation
   * @author Guglielmo Celata
   **/
  public function retrieveProvBySigla($sigla)
  {
    $c = new Criteria();
    $c->add(self::PROV, $sigla);
    $c->add(self::LOCATION_TYPE_ID, 5);
    $loc = self::doSelectOne($c);
    return $loc;
  }
  
  
  public static function getProvSiglaByName($name)
  {
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(self::NAME, $name);
    $crit1 = $c->getNewCriterion(self::ALTERNATIVE_NAME, $name);
    $crit0->addOr($crit1);
    $c->add($crit0);
    $c->add(self::LOCATION_TYPE_ID, 5);
    $loc = self::doSelectOne($c);
    if ($loc instanceof OpLocation)
      return $loc->getProv();
    else
      return null;
  }


  public static function retrieveProvByMinintProvincialCode($id, $con = null)
  {
    $c = new Criteria();
    $c->add(self::MININT_PROVINCIAL_CODE, $id);
    $c->add(self::LOCATION_TYPE_ID, 5);
    return self::doSelectOne($c, $con);
  }

  public static function retrieveByProvName($name, $con = null)
  {
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(self::NAME, $name);
    $crit1 = $c->getNewCriterion(self::ALTERNATIVE_NAME, $name);
    $crit0->addOr($crit1);
    $c->add($crit0);
    $c->add(self::LOCATION_TYPE_ID, 5);
    return self::doSelectOne($c, $con);
  }

  public static function retrieveByCityName($name, $con = null)
  {
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(self::NAME, $name);
    $crit1 = $c->getNewCriterion(self::ALTERNATIVE_NAME, $name);
    $crit0->addOr($crit1);
    $c->add($crit0);
    $c->add(self::LOCATION_TYPE_ID, 6);
    return self::doSelectOne($c, $con);
  }

  public static function retrieveByCityNameProvSigla($name, $prov_sigla)
  {
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(self::NAME, $name);
    $crit1 = $c->getNewCriterion(self::ALTERNATIVE_NAME, $name);
    $crit0->addOr($crit1);
    $c->add($crit0);
    $c->add(self::PROV, $prov_sigla);
    $c->add(self::LOCATION_TYPE_ID, 6);
    return self::doSelectOne($c);
  }

  public static function retrieveByCityNameProvSigleArray($name, $prov_array)
  {
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(self::NAME, $name);
    $crit1 = $c->getNewCriterion(self::ALTERNATIVE_NAME, $name);
    $crit0->addOr($crit1);
    $c->add($crit0);

    // aggiunge le province nell'array
    $cProv = new Criteria();
    if (count($prov_array))
    {
      $critProv = $cProv->getNewCriterion(self::PROV, array_shift($prov_array));
      foreach ($prov_array as $prov)
      {
        $critProvI = $cProv->getNewCriterion(self::PROV, $prov);
        $critProv->addOr($critProvI);
      }
      $c->add($critProv);      
    }
    
    $c->add(self::LOCATION_TYPE_ID, 6);
    return self::doSelectOne($c);
  }


  /**
   * retrieve a location object from the location type and istat code
   *
   * @param string $location_type 
   * @param id $istat_code 
   * @return OpLocation
   * @author Guglielmo Celata
   */
  public static function retrieveByTypeAndIstatCode($location_type_name, $istat_code) 
  {
    $location_type = OpLocationTypePeer::retrieveByName($location_type_name);
    
    $c = new Criteria();
    $c->add(self::LOCATION_TYPE_ID, $location_type->getId());
    switch (strtolower($location_type_name)) {
      case 'regione':
        $c->add(self::REGIONAL_ID, $istat_code);
        break;
      case 'provincia':
        $c->add(self::PROVINCIAL_ID, $istat_code);
        break;
      case 'comune':
        $c->add(self::CITY_ID, $istat_code);
        break;
      
      default:
        throw new Exception("Allowed location types: Regione, Provincia, Comune");
        break;
    }
    $res = self::doSelect($c);
    if (count($res) == 0) throw new sfDatabaseException('No results');
    if (count($res) >1 ) throw new sfDatabaseException('More than one result');
    return $res[0];
  }

  public static function retrieveCityByIstatCodes($prov_code, $city_code) 
  {
    $c = new Criteria();
    $c->add(self::LOCATION_TYPE_ID, 6);
    $c->add(self::PROVINCIAL_ID, $prov_code);
    $c->add(self::CITY_ID, $city_code);
    $res = self::doSelect($c);
    if (count($res) == 0) throw new sfDatabaseException('Nessun risultato');
    if (count($res) >1 ) throw new sfDatabaseException('Più di un risultato');
    return $res[0];
  }
  
  public static function retrieveRegionByRegionId($regional_id)
  {
     $c = new Criteria();
     $c->add(self::LOCATION_TYPE_ID, 4);
     $c->add(self::REGIONAL_ID, $regional_id);
     $res = self::doSelect($c);
     if (count($res) == 0) throw new sfDatabaseException('Nessun risultato');
     if (count($res) >1 ) throw new sfDatabaseException('Più di un risultato');
     return $res[0];
  }


	public static function getContinent()
	{
		$c = new Criteria();
		$c->Add(self::LOCATION_TYPE_ID, '2');
		return $continent = self::doSelect($c);
	}
	
	public static function getNation()
	{
		$c = new Criteria();
		$c->Add(self::LOCATION_TYPE_ID, '3');
		return $nation = self::doSelect($c);
	}
	
	public static function getRegions()
	{
		$c = new Criteria();
		$c->Add(self::LOCATION_TYPE_ID, '4');
		$c->addAscendingOrderByColumn(self::NAME);
		return $regions = self::doSelect($c);
	}
	
	public static function getAllProvincials()
	{
		$provincials = new OpLocation();
		$c = new Criteria();
		$c->Add(self::LOCATION_TYPE_ID, '5');
		$c->Add(self::NAME, '', Criteria::NOT_EQUAL);
		$c->addAscendingOrderByColumn(self::NAME); 
		return $provincials = self::doSelect($c);
	}
	
	public static function getProvincials($region_id)
	{
		$c = new Criteria();
		$c->Add(self::ID, $region_id);
		$region = self::doSelectOne($c);
				
		$c1 = new Criteria();
		$c1->Add(self::LOCATION_TYPE_ID, '5');
		$c1->Add(self::REGIONAL_ID, $region->getRegionalId());
		$c1->addAscendingOrderByColumn(self::NAME);
		return $provincials = self::doSelect($c1);
	}
	
	public static function getComuns($provincial_id)
	{
		$c = new Criteria();
		$c->Add(self::ID, $provincial_id);
		$provincial = self::doSelectOne($c);
				
		$c1 = new Criteria();
		$c1->Add(self::LOCATION_TYPE_ID, '6');
		$c1->Add(self::PROVINCIAL_ID, $provincial->getProvincialId());
		$c1->addAscendingOrderByColumn(self::NAME);
		return $provincials = self::doSelect($c1);
	}
	
	
	
	/**
	 * return all istat ids for cities (location_type_id = 6)
	 *
	 * @return array of ids
	 * @author Guglielmo Celata
	 */
	public static function getCitiesIstatIds()
	{
  	$c = new Criteria();
	  $c->add(self::LOCATION_TYPE_ID, 6);
	  $c->addAscendingOrderByColumn(self::CITY_ID);
	  $c->clearSelectColumns();
	  $c->addSelectColumn(self::CITY_ID);
	 
	  $items = array();
    $rs = self::doSelectRS($c);
    while($rs->next()){
      $items []= $rs->getInt(1);
    }
    return $items;   
	}

	/**
	 * count number cities (location_type_id = 6)
	 *
	 * @return integer
	 * @author Guglielmo Celata
	 */
	public static function countCities()
	{
  	$c = new Criteria();
	  $c->add(self::LOCATION_TYPE_ID, 6);
	  return self::doCount($c);
	}
	
	
  /**
   * torna un OpLocation a partire da un id e un loc_type field
   * 
   * @param integer - l'id della location (city, provincial op regional)
   * @param string - nome del tipo di location (Regione, Provincia, Comune)
   * @return OpLocation 
   * @author Guglielmo Celata
   **/
  public function getLocationFromIdAndLocationTypeField($id, $loc_type)
  {

    switch (strtolower($loc_type))
    {
      case "regione":
        $loc_field = self::REGIONAL_ID;
        break;

      case "provincia":
        $loc_field = self::PROVINCIAL_ID;
        break;
    
      case "comune":
        $loc_field = self::CITY_ID;
        break;
        
      // in caso di parametro errato, ritorna null
      default:
        return null;
    }

    $c = new Criteria();
    $c->add($loc_field, $id);
    $c->addJoin(OpLocationTypePeer::ID, self::LOCATION_TYPE_ID);
    $c->add(OpLocationTypePeer::NAME, ucfirst($loc_type));
    return self::doSelectOne($c);    
  }
  
	

} // OpLocationPeer
?>
