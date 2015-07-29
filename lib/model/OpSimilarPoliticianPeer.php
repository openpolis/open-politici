<?php

  // include base peer class
  require_once 'lib/model/om/BaseOpSimilarPoliticianPeer.php';

  // include object class
  include_once 'lib/model/OpSimilarPolitician.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_similar_politician' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpSimilarPoliticianPeer extends BaseOpSimilarPoliticianPeer {

  public static function exists($original_id, $similar_id)
  {
		$con = Propel::getConnection(self::DATABASE_NAME);

    $sql = sprintf("select count(*) as n from op_similar_politician where original_id=%d and similar_id=%d",
                   $original_id, $similar_id);
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);
    
    $rs->next();
    $row = $rs->getRow();
    $n = $row['n'];

    if ($n > 0)
      return true;
    else 
      return false;
  }

} // OpSimilarPoliticianPeer
