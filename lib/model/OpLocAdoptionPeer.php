<?php

  // include base peer class
  require_once 'lib/model/om/BaseOpLocAdoptionPeer.php';

  // include object class
  include_once 'lib/model/OpLocAdoption.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_loc_adoption' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpLocAdoptionPeer extends BaseOpLocAdoptionPeer {

  public function getAdoptersForLocation($loc_id)
  {
    $c = new Criteria();
    $c->add(self::LOCATION_ID, $loc_id);
    $c->add(self::GRANTED_AT, null, Criteria::NOT_EQUAL);
    $c->add(self::REVOKED_AT, null, Criteria::EQUAL);
    $adoptions = self::doSelect($c);
    
    $user_ids = array();
    foreach ($adoptions as $adoption)
    {
      $user_ids []= $adoption->getUserId();
    }
    
    return array_unique($user_ids);
  }

  /**
   * torna un array di oggetti OpLocAdoption adottati dall'utente
   *
   * @param ID user_id - l'id dell'utente
   * @return array of OpLocAdoption
   * @author Guglielmo Celata
   **/
  public function getAdoptees($user_id)
  {
    $c = new Criteria();
    $c->add(self::USER_ID, $user_id);
    $c->add(self::GRANTED_AT, null, Criteria::NOT_EQUAL);
    $c->add(self::REVOKED_AT, null, Criteria::EQUAL);
    $adoptees = self::doSelect($c);
    return $adoptees;
  }


} // OpLocAdoptionPeer
