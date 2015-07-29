<?php

  // include base peer class
  require_once 'lib/model/om/BaseOpImportModificationsPeer.php';

  // include object class
  include_once 'lib/model/OpImportModifications.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_import_modifications' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpImportModificationsPeer extends BaseOpImportModificationsPeer {

  const CHARGE_ONLY = 'I';
  const POLITICIAN_AND_CHARGE = 'PI';
  const HAS_SIMILAR_POLITICIANS = 'S';
  const CHARGE_BY_MININT_AKA = 'IA';
  const DUPLICATE_POLITICIAN = 'D';
  
  public static $op_import_minint_date = null;
  public static $context = '';
  public static $processed_records = array();
  public static $original_records = array();
  
  /**
   * Escape a string to be used as a regular expression pattern
   * Ex: escape_string_for_regex('http://www.example.com/s?q=php.net+docs')
   * returns http:\/\/www\.example\.com\/s\?q=php\.net\+docs
   *
   * @param string $str 
   * @return str
   * @author Guglielmo Celata
   */
  function escapeStringForRegex($str)
  {

    $patterns = array('/\//', '/\^/', '/\./', '/\$/', '/\|/',
                      '/\(/', '/\)/', '/\[/', '/\]/', '/\*/', '/\+/', 
                      '/\?/', '/\{/', '/\}/', '/\,/');
    $replace = array('\/', '\^', '\.', '\$', '\|', 
                     '\(', '\)', '\[', '\]', '\*', 
                     '\+', '\?', '\{', '\}', '\,');

    return preg_replace($patterns,$replace, $str);
  }
  
  
  /**
   * get a db date (format YYYY-MM-DD) from other formats
   *
   * @param string $date (formats: d/m/Y OR Ymd)
   * @return string
   * @author Guglielmo Celata
   */
  public static function getDBDate($date)
  {
    $d = strptime($date, "%d/%m/%Y");
    if ($d === false)
      $d = strptime($date, "%Y%m%d");

    if ($d === false)
      return false;
    
    return sprintf("%4d-%02d-%02d", 1900+$d['tm_year'], 1+$d['tm_mon'], $d['tm_mday']);
  }


  /**
   * get a hash from a csv in a context
   * the csv record must have the original minint format
   *
   * @param string $context 
   * @param string $csv_rec 
   * @return hash
   * @author Guglielmo Celata
   */
  public static function getHashFromCSV($context, $csv_rec)
  {
		if ($context != 'reg' && $context != 'prov' && !strpos($context, 'com') === false) {
		  throw new Exception(sprintf("context %s does not exist", $context));
		}

    $v = explode(";", $csv_rec);
    switch ($context) {
      case 'reg':
        if (count($v) != 14) {
          throw new Exception(sprintf("OpImportModificationsPeer::getHashFromCSV - csv does not have the right number of fields for this context %s (14)\ncsv_rec:%s", count($v), $csv_rec));
        }
        $hash = array(
          'minint_regional_code' => $v[0],
          'minint_provincial_code' => null,
          'minint_city_code' => null,
          'last_name'   => $v[3],
          'first_name'  => $v[4],
          'sex'         => $v[5],
          'birth_date'  => self::getDBDate($v[6]),
          'birth_place' => $v[7],
          'education'   => $v[12],
          'profession'  => $v[13],
          'charge_desc' => $v[8],
          'charge_start_date' => self::getDBDate($v[10]),
          'charge_list' => $v[11]
        );
        break;

      case 'prov':
        if (count($v) != 16) {
          throw new Exception(sprintf("OpImportModificationsPeer::getHashFromCSV - csv does not have the right number of fields for this context %s (16)\ncsv_rec:%s", count($v), $csv_rec));
        }
        $hash = array(
          'minint_regional_code' => $v[0],
          'minint_provincial_code' => $v[1],
          'minint_city_code' => null,
          'last_name'   => $v[5],
          'first_name'  => $v[6],
          'sex'         => $v[7],
          'birth_date'  => self::getDBDate($v[8]),
          'birth_place' => $v[9],
          'education'   => $v[14],
          'profession'  => $v[15],
          'charge_desc' => $v[10],
          'charge_start_date' => self::getDBDate($v[12]),
          'charge_list' => $v[13]          
        );
        break;
      
      default:
        if (count($v) != 18) {
          throw new Exception(sprintf("OpImportModificationsPeer::getHashFromCSV - csv does not have the right number of fields for this context: %s (18)\ncsv_rec:%s", count($v), $csv_rec));
        }
        $hash = array(
          'minint_regional_code' => $v[0],
          'minint_provincial_code' => $v[1],
          'minint_city_code' => $v[2],
          'last_name'   => $v[7],
          'first_name'  => $v[8],
          'sex'         => $v[9],
          'birth_date'  => self::getDBDate($v[10]),
          'birth_place' => $v[11],
          'education'   => $v[16],
          'profession'  => $v[17],
          'charge_desc' => $v[12],
          'charge_start_date' => self::getDBDate($v[14]),
          'charge_list' => $v[15]          
        );
        break;
    }
    return $hash;
  }
  


  /**
   * get a hash from a csv in a context
   * the csv record must have the processed/reduced format
   *
   * @param string $context 
   * @param string $csv_rec 
   * @return hash
   * @author Guglielmo Celata
   */
  public static function getHashFromReducedCSV($context, $csv_rec)
  {
		if ($context != 'reg' && $context != 'prov' && !strpos($context, 'com') === false) {
		  throw new Exception(sprintf("context %s does not exist", $context));
		}

    $v = explode("|", $csv_rec);
    switch ($context) {
      case 'reg':
        if (count($v) != 9) {
          throw new Exception(sprintf("OpImportModificationsPeer::getHashFromReducedCSV - csv does not have the right number of fields for context %s: %d/8", $context, count($v)));
        }
        $hash = array(
          'minint_regional_code' => $v[0],
          'minint_provincial_code' => null,
          'minint_city_code' => null,
          'location_name'    => $v[1],
          'location_prov'    => null,
          'last_name'   => $v[2],
          'first_name'  => $v[3],
          'sex'         => $v[4],
          'birth_date'  => self::getDBDate($v[5]),
          'birth_place' => $v[6],
          'charge_desc' => $v[7],
          'charge_start_date' => $v[8]
        );
        break;

      case 'prov':
        if (count($v) != 11) {
          throw new Exception(sprintf("OpImportModificationsPeer::getHashFromReducedCSV - csv does not have the right number of fields for context %s: %d/10", $context, count($v)));
        }
        $hash = array(
          'minint_regional_code' => $v[0],
          'minint_provincial_code' => $v[1],
          'minint_city_code' => null,
          'location_name'    => $v[2],
          'location_prov'    => $v[3],
          'last_name'   => $v[4],
          'first_name'  => $v[5],
          'sex'         => $v[6],
          'birth_date'  => self::getDBDate($v[7]),
          'birth_place' => $v[8],
          'charge_desc' => $v[9],
          'charge_start_date' => $v[10]          
        );
        break;
      
      default:
        if (count($v) != 12) {
          throw new Exception(sprintf("OpImportModificationsPeer::getHashFromReducedCSV - csv does not have the right number of fields for context %s: %d/11", $context, count($v)));
        }
        $hash = array(
          'minint_regional_code' => $v[0],
          'minint_provincial_code' => $v[1],
          'minint_city_code' => $v[2],
          'location_name'    => $v[3],
          'location_prov'    => $v[4],
          'last_name'   => $v[5],
          'first_name'  => $v[6],
          'sex'         => $v[7],
          'birth_date'  => self::getDBDate($v[8]),
          'birth_place' => $v[9],
          'charge_desc' => $v[10],
          'charge_start_date' => $v[11]
        );
        break;
    }
    return $hash;
  }
  

  public static function getInstitutionChargeFromReducedCSV($context, $csv_rec, $op_politician = null)
  {
		if ($context != 'reg' && $context != 'prov' && !strpos($context, 'com') == false) {
		  throw new Exception(sprintf("context %s does not exist", $context));
		}
		
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

    $h = self::getHashFromReducedCSV($context, $csv_rec);

    if (is_null($op_politician))
    {
      $op_politician = OpPoliticianPeer::retrieveByAnagraficaWithBirthLocation(
        $h['first_name'], $h['last_name'], $h['birth_date'], $h['birth_place']
      );
      if (!$op_politician instanceof OpPolitician &&
          $op_politician == OpPoliticianPeer::NO_RECORD)
        throw new Exception("OpImportModificationsPeer::getInstitutionChargeFromReducedCSV - politician not found");
    }
    
    $op_location = OpLocationPeer::retrieveByMinIntCodes(
      $loc_type,
      $h['minint_regional_code'],
      $h['minint_provincial_code'],
      $h['minint_city_code']
    );      

    list($institution, $charge) = OpInstitutionChargePeer::getInstitutionAndChargeTypeFromChargeDescr($context, $h['charge_desc']);

    $ic = OpInstitutionChargePeer::retrieveCurrentByImportData($op_politician, $institution, $op_location, $charge);
    if (is_int($ic) && $ic == OpInstitutionChargePeer::DUPLICATE_RECORD)
      throw new Exception("OpImportModificationsPeer::getInstitutionChargeFromReducedCSV - more than one charge found!");
      
    if (!$ic instanceof OpInstitutionCharge)
      throw new Exception("OpImportModificationsPeer::getInstitutionChargeFromReducedCSV - no charge found!");
      
    return $ic;
  }

  
  
  
  
  /**
   * retrieve original csv_rec from normalized one
   *
   * @param string $op_import_minint_date 
   * @param string $context 
   * @param string $csv_rec 
   * @return string
   * @author Guglielmo Celata
   */
  public static function getOriginalCsvRec($op_import_minint_date, $context, $csv_rec)
  {
		if ($context != 'reg' && $context != 'prov' && !strpos($context, 'com') == false) {
		  throw new Exception(sprintf("context %s does not exist", $context));
		}

    $op_data_path = sfConfig::get('sf_op_data_path', '/home/op/op_data');
    $original_csv = sprintf("%s/aggiornamenti/minint_%s/amm%s.sorted.correct.txt", 
                            $op_data_path, $op_import_minint_date, $context);
    $processed_csv = sprintf("%s/aggiornamenti/minint_%s/amm%s.normalized.sorted.correct.txt", 
                            $op_data_path, $op_import_minint_date, $context);

    if (!file_exists($original_csv)) {
      throw new Exception("could not find file $original_csv");
    }
    
    # this allows some speed up and memory save
    if ($op_import_minint_date != self::$op_import_minint_date || $context != self::$context)                      
    {
      self::$op_import_minint_date = $op_import_minint_date;
      self::$context = $context;
      self::$original_records = file($original_csv, FILE_IGNORE_NEW_LINES);
      self::$processed_records = file($processed_csv, FILE_IGNORE_NEW_LINES);      
      if (SF_DEBUG) 
        sfContext::getInstance()->getLogger()->info("{OpImportModificationsPeer::getOriginalCsvRec} reading file content into array");
    }

    $pos = array_search($csv_rec, self::$processed_records);
    if ($pos === false)
      return null;

    $logger = sfContext::getInstance()->getLogger();
    $logger->info("{debug} pos: $pos");
    
    return trim(self::$original_records[$pos]);
    
  }


  /**
   * get all record by rec_type, context, location and date
   * concretised record are not fetched
   *
   * @param string $rec_type (old|new) 
   * @param context $rec_type (reg|prov|com.xxx) 
   * @param string $location_id
   * @return array of OpImportModifications
   * @author Guglielmo Celata
   */
  public static function getByRecTypeContextLocationIdDate($rec_type, $date, $context = null, $location_id = null)
  {
    if (!in_array($rec_type, array('old', 'new')))
      throw new Exception("rec_type parameter must be 'old' or 'new'");

    if (!is_null($context) && !in_array($context, array('reg', 'prov')) && strpos('com', $context) !== false)
      throw new Exception("context parameter must be 'reg', 'prov' or 'com.xxx'");

    if (!is_null($location_id) && !is_int($location_id))
      throw new Exception("location_id parameter must be an integer");

    if (is_null($date))
      throw new Exception("date parameter must be specified");
      
    $c = new Criteria();
    $c->add(self::REC_TYPE, $rec_type);
    if (!is_null($context)) {
      $c->add(self::CONTEXT, $context);
    }
    if (!is_null($location_id)) {
      $c->add(self::LOCATION_ID, $location_id);
    }

    if (!is_null($date)) {
      $import = OpImportMinintPeer::retrieveFromAggDate($date);
      $c->add(self::IMPORT_ID, $import->getId());
    }
    
    $c->add(self::CONCRETISED_AT, null, Criteria::ISNULL);
    return self::doSelect($c);
  }


  /**
   * get all record by rec_type value
   * concretised record are not fetched
   *
   * @param string $rec_type (old|new) 
   * @param context $rec_type (reg|prov|com.xxx) 
   * @param string $location_id
   * @return array of OpImportModifications
   * @author Guglielmo Celata
   */
  public static function getByRecTypeContextLocationId($rec_type, $context = null, $location_id = null)
  {
    if (!in_array($rec_type, array('old', 'new')))
      throw new Exception("rec_type parameter must be 'old' or 'new'");

    if (!is_null($context) && !in_array($context, array('reg', 'prov')) && strpos('com', $context) !== false)
      throw new Exception("context parameter must be 'reg', 'prov' or 'com.xxx'");

    if (!is_null($location_id) && !is_int($location_id))
      throw new Exception("location_id parameter must be an integer");
      
    $c = new Criteria();
    $c->add(self::REC_TYPE, $rec_type);
    if (!is_null($context)) {
      $c->add(self::CONTEXT, $context);
    }
    if (!is_null($location_id)) {
      $c->add(self::LOCATION_ID, $location_id);
    }
    
    $c->add(self::CONCRETISED_AT, null, Criteria::ISNULL);
    return self::doSelect($c);
  }
  
  /**
   * starting from a normalized csv record, insert data in the DB
   * if the OpPolitician record is not already there then it is created
   * an OpInstitutionCharge record, with corresponding data is then added
   * need to access the original csv record
   *
   * @param string $op_import_minint 
   * @param string $context 
   * @param string $csv_rec reduced, correct, normalized csv
   * @param string $con 
   * @param string $status
   * @return void
   * @author Guglielmo Celata
   */
  public static function addFromCSV($op_import_minint_date, $context, $csv_rec, $con = null, $status = '')
  {
    if (is_null($con))
		  $con = Propel::getConnection(self::DATABASE_NAME);
		  
		if ($context != 'reg' && $context != 'prov' && !strpos($context, 'com') == false) {
		  throw new Exception(sprintf("context %s does not exist", $context));
		}

    // get values from processed (minint) csv
    $v = OpImportModificationsPeer::getHashFromReducedCSV($context, $csv_rec);

    $original_csv_rec = self::getOriginalCsvRec($op_import_minint_date, $context, $csv_rec);
    
    if (is_null($original_csv_rec)) {
      throw new Exception(sprintf("original csv record not found for: %s", $csv_rec));
    }
    
    // compute status from values (if not given)
    if ($status == '')
    {
      $res = OpPoliticianPeer::computePoliticianAndActionTypeFromAnagraphicalData($v);
      $p = $res['politician'];
      $status = $res['action_type'];
    } else {
      // if status is given
      if ($status == 'I')
        $p = OpPoliticianPeer::retrieveByAnagrafica($v['first_name'], $v['last_name'], $v['birth_date'], false);
      if ($status == 'IA')
      {
        $minint_aka = sprintf("%s+%s", $v['first_name'], $v['last_name']);
        if ($v['birth_date'] != '')
          $minint_aka .= "+" . date('Y/m/d', strtotime($v['birth_date']));
        $p = OpPoliticianPeer::retrieveByMinintAka($minint_aka);        
      }
    }

    if ($status == 'PI')
      $p = OpPoliticianPeer::addFromCSV($context, $original_csv_rec, $con);

    if (in_array($status, array('PI', 'I', 'IA')))
      OpInstitutionChargePeer::addFromCSV($context, $original_csv_rec, $p, $con);
    else
      throw new Exception(sprintf("Error: status for csv_rec: %s is: %s", $csv_rec, $status));
      
  }


  /**
   * starting from a processed csv record, close an institution charge data in the DB
   * if the OpPolitician record is not already there then an exception is thrown
   * an OpInstitutionCharge record is then closed, by setting its date_end field to the import date
   *
   * @param string $op_import_minint_date 
   * @param string $context 
   * @param string $csv_rec 
   * @param string $con 
   * @return void
   * @author Guglielmo Celata
   */
  public static function closeFromCSV($op_import_minint_date, $context, $csv_rec, $con = null)
  {
    if (is_null($con))
		  $con = Propel::getConnection(self::DATABASE_NAME);

		if ($context != 'reg' && $context != 'prov' && !strpos($context, 'com') == false) {
		  throw new Exception(sprintf("context %s does not exist", $context));
		}

    $v = OpImportModificationsPeer::getHashFromReducedCSV($context, $csv_rec);
    $p = OpPoliticianPeer::retrieveByAnagrafica($v['first_name'], $v['last_name'], $v['birth_date'], false);

    if (!$p instanceof OpPolitician)
      throw new Exception(sprintf("Politician not found. CSV: %s", $csv_rec));
    
    OpInstitutionChargePeer::closeFromCSV($context, $csv_rec, $p, $con);
  }



  public static function getDistinctLocationsIdsWithNamesForRecType($context, $rec_type, $con = null)
  {
    if (is_null($con))
		  $con = Propel::getConnection(self::DATABASE_NAME);

    if ($context == '') return array('' => 'Selezionare un contesto');

    switch ($context) 
    {
      case 'reg':
        $sql = sprintf("select distinct l.id, l.name from op_import_modifications m, op_location l where l.id=m.location_id and l.location_type_id=4 and m.rec_type='%s';", $rec_type);
        break;
      case 'prov':
        $sql = sprintf("select distinct l.id, l.name from op_import_modifications m, op_location l where l.id=m.location_id and l.location_type_id=5 and m.rec_type='%s';", $rec_type);
        break;
      default:
        list($label, $prov_code) = explode(".", $context);
        $sql = sprintf("select distinct l.id, l.name from op_import_modifications m, op_location l where l.id=m.location_id and l.location_type_id=6 and l.minint_provincial_code=%s and m.rec_type='%s';", (int)$prov_code, $rec_type);
        break;
    }
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    $items = array('' => 'qualsiasi');
    while ($rs->next()) {
      $row = $rs->getRow();
      $items [$row['id']]= $row['name'];
    }

    return $items;
  }


  public static function getDistinctContextsForRecType($rec_type, $con = null)
  {
    if (is_null($con))
		  $con = Propel::getConnection(self::DATABASE_NAME);

    $sql = sprintf("select m.context, l2.name from op_import_modifications m, op_location l1, op_location l2 where l1.id=m.location_id and l1.provincial_id=l2.provincial_id and l2.location_type_id=5 and m.rec_type='%s' and m.context like 'com%%' group by m.context, l1.prov order by l2.name;", $rec_type);
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    $items = array('' => 'qualsiasi', 'reg' => 'regioni', 'prov' => 'provincie');
    while ($rs->next()) {
      $row = $rs->getRow();
      $context = $row['context'];
      $items [$context]= "comuni di " . $row['name'];
    }

    return $items;
  }

  public static function getDistinctImportsForRecType($rec_type, $con = null)
  {
    if (is_null($con))
		  $con = Propel::getConnection(self::DATABASE_NAME);

    $sql = sprintf("select i.id, i.agg_date, i.type from op_import_modifications m, op_import_minint i where m.import_id=i.id and rec_type='%s' group by i.agg_date order by agg_date desc;", $rec_type);
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    $items = array('' => 'qualsiasi');
    while ($rs->next()) {
      $row = $rs->getRow();
      $import_id = $row['id'];
      $items [$import_id]=  sprintf("%s (%s)", $row['agg_date'], $row['type']);
    }

    return $items;
  }


  public static function doConcretise($selected_items_ids, $op_import_minint_date)
  {
    foreach ($selected_items_ids as $item_id) {
      $item = self::retrieveByPK($item_id);
      if (substr($item->getActionType(), 0, 1) != 'S' && is_null($item->getBlockedAt()))
        $msg = $item->concretise($op_import_miint_date);
    }
  }

  public static function doReject($selected_items_ids, $user)
  {
    foreach ($selected_items_ids as $item_id) {
      $item = self::retrieveByPK($item_id);
      if (substr($item->getActionType(), 0, 1) != 'S')
        $msg = $item->reject($user);
    }
  }

  public static function doRestore($selected_items_ids)
  {
    foreach ($selected_items_ids as $item_id) {
      $item = self::retrieveByPK($item_id);
      if (substr($item->getActionType(), 0, 1) != 'S')
        $msg = $item->restore();
    }
  }

} // OpImportModificationsPeer
