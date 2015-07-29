<?php

  // include base peer class
  require_once 'lib/model/om/BaseOpImportMinintPeer.php';

  // include object class
  include_once 'lib/model/OpImportMinint.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_import_minint' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpImportMinintPeer extends BaseOpImportMinintPeer {
  /**
   * return the OpImportMinint propel object retrieving it by its agg_date field
   * (which is a unique field)
   *
   * @return OpImportMinint
   * @author Guglielmo Celata
   **/
  public function retrieveFromAggDate($date)
  {
    $c = new Criteria();
    $c->add(self::AGG_DATE, $date);
    return self::doSelectOne($c);
  }
  
  
  public function getLastImport()
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn(self::AGG_DATE);
    return self::doSelectOne($c);
  }
  
  /**
   * DEPRECATED
   *
   * @return void
   * @author Guglielmo Celata
   */
  public function getLastImportDate()
  {
    return self::getLastImport();
  }

} // OpImportMinintPeer
