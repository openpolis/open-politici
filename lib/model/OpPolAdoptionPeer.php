<?php

  // include base peer class
  require_once 'lib/model/om/BaseOpPolAdoptionPeer.php';

  // include object class
  include_once 'lib/model/OpPolAdoption.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_pol_adoption' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpPolAdoptionPeer extends BaseOpPolAdoptionPeer {
  
  /**
   * compara due risorse e torna true se hanno uguali:
   * - politician_id (solo se richiesto)
   * - user_id
   *
   * Nel caso in cui si comparino risorse di due politici doppioni,
   * il confronto tra politician_id non è necessario
   *
   * @param OpPolAdoption $o1 
   * @param OpPolAdoption $o2 
   * @param boolean $compare_politician_id
   * @return void
   * @author Guglielmo Celata
   */
  public static function compare($o1, $o2, $compare_politician_id = false)
  {
    if (!$o1 instanceof OpPolAdoption ||
        !$o2 instanceof OpPolAdoption )
      throw new Exception("Wrong parameters: both must be OpPolAdoption classes");
    
    $res = false;
    /*
    printf("\ncomparing %6d and %6d\n %6d  => %6d\n",
           $o1->getPoliticianId(), $o2->getPoliticianId(),
           $o1->getUserId(), $o2->getUserId();
    */         
    if ($o1->getUserId() == $o2->getUserId())
    {
      $res = true;      
    }
    
    if ($compare_politician_id)
    {
      $res = $res && ($o1->getPoliticianId() == $o2->getPoliticianId());
    }
    
    // printf("res: %s\n", $res?'uguali':'diverse');
    return $res;
  }
  
  
  public function getAdoptersForPolitician($pol_id)
  {
    $c = new Criteria();
    $c->add(self::POLITICIAN_ID, $pol_id);
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
   * torna un array di oggetti OpPolAdoption adottati dall'utente
   *
   * @param ID user_id - l'id dell'utente
   * @return array of OpPolAdoption
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

} // OpPolAdoptionPeer
