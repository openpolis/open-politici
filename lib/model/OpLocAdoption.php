<?php

require_once 'lib/model/om/BaseOpLocAdoption.php';


/**
 * Skeleton subclass for representing a row from the 'op_loc_adoption' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpLocAdoption extends BaseOpLocAdoption {

  /**
   * torna lo status di un'adozione
   * req, gra, ref, rev
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function getStatus()
  {
    if ($this->getGrantedAt() == null && $this->getRefusedAt() == null) return 'req';
    if ($this->getRevokedAt() !== null) return 'rev';
    if ($this->getGrantedAt() !== null) return 'gra';
    if ($this->getRefusedAt() !== null) return 'ref';
  }

  public function __toString()
  {
    return $this->getOpLocation()->__toString();
  }

  public function toLink()
  {
    $loctype = strtolower($this->getOpLocation()->getOpLocationType()->getName());
    return link_to((string)$this, "@$loctype?location_id=" . $this->getLocationId());
  }


} // OpLocAdoption
