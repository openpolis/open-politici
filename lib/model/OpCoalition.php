<?php

require_once 'lib/model/om/BaseOpCoalition.php';


/**
 * Skeleton subclass for representing a row from the 'op_coalition' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpCoalition extends BaseOpCoalition {

  public function __toString()
  {
    return $this->getName();
  }
} // OpCoalition
