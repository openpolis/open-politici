<?php

  // include base peer class
  require_once 'lib/model/om/BaseOpElectionPeer.php';

  // include object class
  include_once 'lib/model/OpElection.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_election' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpElectionPeer extends BaseOpElectionPeer {
  
  /**
   * retrieve the election object having the latest election_date
   *
   * @param OpLocation $op_location 
   * @return OpElection
   * @author Guglielmo Celata
   */
  public static function retrieveLastElectionForLocation($op_location)
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn(self::ELECTION_DATE);
    $c->add(self::LOCATION_ID, $op_location->getId());
    return self::doSelectOne($c);
  }
} // OpElectionPeer
