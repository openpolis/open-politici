<?php

require_once 'lib/model/om/BaseOpPolAdoption.php';


/**
 * Skeleton subclass for representing a row from the 'op_pol_adoption' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpPolAdoption extends BaseOpPolAdoption {
  
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
    return $this->getOpPolitician()->__toString();
  }
  
  public function toLink()
  {
    return link_to((string)$this, '@politico?content_id=' . $this->getPoliticianId());
  }
  
} // OpPolAdoption
