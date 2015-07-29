<?php

  // include base peer class
  require_once 'lib/model/om/BaseOpImportSimilarPeer.php';

  // include object class
  include_once 'lib/model/OpImportSimilar.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_import_similar' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpImportSimilarPeer extends BaseOpImportSimilarPeer {


  /**
   * get all record by context and locationid
   * deleted record are not fetched
   *
   * @param context $context (reg|prov|com.xxx) 
   * @param string $location_id
   * @return array of OpImportSimilar
   * @author Guglielmo Celata
   */
  public static function getByContextLocationId($context = null, $location_id = null)
  {
    if (!is_null($context) && !in_array($context, array('reg', 'prov')) && strpos('com', $context) !== false)
      throw new Exception("context parameter must be 'reg', 'prov' or 'com.xxx'");

    if (!is_null($location_id) && !is_int($location_id))
      throw new Exception("location_id parameter must be an integer");
      
    $c = new Criteria();
    if (!is_null($context)) {
      $c->add(self::CONTEXT, $context);
    }
    if (!is_null($location_id)) {
      $c->add(self::LOCATION_ID, $location_id);
    }
    
    $c->add(self::DELETED_AT, null, Criteria::ISNULL);
    return self::doSelect($c);
  }


  public static function getDistinctLocationsIdsWithNames($context, $con = null)
  {
    if (is_null($con))
		  $con = Propel::getConnection(self::DATABASE_NAME);

    if ($context == '') return array('' => 'Selezionare un contesto');

    switch ($context) 
    {
      case 'reg':
        $sql = sprintf("select distinct l.id, l.name from op_import_similar s, op_location l where l.id=s.location_id and l.location_type_id=4;");
        break;
      case 'prov':
        $sql = sprintf("select distinct l.id, l.name from op_import_similar s, op_location l where l.id=s.location_id and l.location_type_id=5;");
        break;
      default:
        list($label, $prov_code) = explode(".", $context);
        $sql = sprintf("select distinct l.id, l.name from op_import_similar s, op_location l where l.id=s.location_id and l.location_type_id=6 and l.minint_provincial_code=%s;", (int)$prov_code);
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


  public static function getDistinctContexts($con = null)
  {
    if (is_null($con))
		  $con = Propel::getConnection(self::DATABASE_NAME);

    $sql = sprintf("select s.context, l2.name from op_import_similar s, op_location l1, op_location l2 where l1.id=s.location_id and l1.provincial_id=l2.provincial_id and l2.location_type_id=5 and s.context like 'com%%' group by s.context, l1.prov order by l2.name;");
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

  
  public static function doReject($selected_items_ids, $user)
  {
    foreach ($selected_items_ids as $item_id) {
      $item = self::retrieveByPK($item_id);
      $msg = $item->reject($user);
    }
  }

  public static function doRestore($selected_items_ids)
  {
    foreach ($selected_items_ids as $item_id) {
      $item = self::retrieveByPK($item_id);
      $msg = $item->restore();
    }
  }
  
  public static function getLocationsFromIds($selected_items_ids)
  {
    $locations = array();
    foreach ($selected_items_ids as $item_id) {
      $item = self::retrieveByPK($item_id);
      $context = $item->getContext();
      $location_id = $item->getLocationId();
      
      if (!array_key_exists($context, $locations)) {
        $locations[$context] = array();
      }
      $locations[$context][] = $location_id;
    }
    return $locations;
  }

} // OpImportSimilarPeer
