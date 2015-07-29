<?php

  // include base peer class
  require_once 'lib/model/om/BaseOpImportTypePeer.php';

  // include object class
  include_once 'lib/model/OpImportType.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_import_type' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpImportTypePeer extends BaseOpImportTypePeer {
  
  /**
   * return the OpImportType propel object retrieving it by its name
   * since name is a unique index, the doSelectOne can be safely used
   *
   * @return OpImportType
   * @author Guglielmo Celata
   **/
  public function retrieveFromName($name)
  {
    $c = new Criteria();
    $c->add(OpImportTypePeer::NAME, $name);
    return OpImportTypePeer::doSelectOne($c);
  }

} // OpImportTypePeer
