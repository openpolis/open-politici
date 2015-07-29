<?php
/*****************************************************************************
 *    Questo file e' parte del progetto openpolis.
 * 
 *    openpolis - la politica trasparente
 *    copyright (C) 2008
 *    Ass. Democrazia Elettronica e Partecipazione Pubblica, 
 *    Via Luigi Montuori 5, 00154 - Roma, Italia
 *
 *    openpolis e' free software; e' possibile redistribuirlo o modificarlo
 *    nei termini della General Public License GNU, versione 2 o successive;
 *    secondo quanto pubblicato dalla Free Software Foundation.
 *
 *    openpolis e' distribuito nella speranza che risulti utile, 
 *    ma SENZA ALCUNA GARANZIA.
 *    
 *    Potete trovare la licenza GPL e altre informazioni su licenze e 
 *    copyright, nella cartella "licenze" del package.
 *
 *    $HeadURL$
 *    $LastChangedDate$
 *    $LastChangedBy$
 *    $LastChangedRevision$
 *
 ****************************************************************************/
?>
<?php

  // include base peer class
  require_once 'lib/model/om/BaseOpResourcesPeer.php';
  
  // include object class
  include_once 'lib/model/OpResources.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_resources' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpResourcesPeer extends BaseOpResourcesPeer {

  /**
   * compara due risorse e torna true se hanno uguali:
   * - politician_id (solo se richiesto)
   * - resources_type_id
   * - valore
   *
   * Nel caso in cui si comparino risorse di due politici doppioni,
   * il confronto tra politician_id non è necessario
   *
   * @param OpResources $o1 
   * @param OpResources $o2 
   * @param boolean $compare_politician_id
   * @return void
   * @author Guglielmo Celata
   */
  public static function compare($o1, $o2, $compare_politician_id = false)
  {
    if (!$o1 instanceof OpResources ||
        !$o2 instanceof OpResources )
      throw new Exception("Wrong parameters: both must be OpResources classes");
    
    $res = false;
    /*
    printf("\ncomparing %6d and %6d\n %6d => %6d\n %6d => %6d\n %s => %s\n",
           $o1->getContentId(), $o2->getContentId(),
           $o1->getPoliticianId(), $o2->getPoliticianId(),
           $o1->getResourcesTypeId(), $o2->getResourcesTypeId(),
           $o1->getValore(), $o2->getValore();
    */         
    if ($o1->getResourcesTypeId() == $o2->getResourcesTypeId() &&
        $o1->getValore() == $o2->getValore())
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


  public static function countTouchedResources($last_updated_at)
  {
    $con = Propel::getConnection(self::DATABASE_NAME);
    $sql = "SELECT count(*) " .
           " FROM op_resources r, op_open_content oc, op_content c " .
           " WHERE r.CONTENT_ID=oc.CONTENT_ID AND oc.CONTENT_ID=c.ID  AND (" .
           "  oc.DELETED_AT IS NULL AND c.UPDATED_AT > c.CREATED_AT AND c.UPDATED_AT > '$last_updated_at' OR ".
           "  oc.DELETED_AT IS NULL AND c.CREATED_AT > '$last_updated_at' OR ".
           "  oc.DELETED_AT > '$last_updated_at')";
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_NUM);

    if($rs->next())
      return $rs->getInt(1);
    else
      return 0;
  }

  public static function getPoliticiansIdsWithTouchedResources($last_updated_at)
  {
    $con = Propel::getConnection(self::DATABASE_NAME);
    $sql = "SELECT DISTINCT r.POLITICIAN_ID " .
           " FROM op_resources r, op_open_content oc, op_content c " .
           " WHERE r.CONTENT_ID=oc.CONTENT_ID AND oc.CONTENT_ID=c.ID  AND (" .
           "  oc.DELETED_AT IS NULL AND c.UPDATED_AT > c.CREATED_AT AND c.UPDATED_AT > '$last_updated_at' OR ".
           "  oc.DELETED_AT IS NULL AND c.CREATED_AT > '$last_updated_at' OR ".
           "  oc.DELETED_AT > '$last_updated_at' )";
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    $politicians_ids = array();
    while($rs->next()){
      $politicians_ids []= $rs->getInt('POLITICIAN_ID');
    }
    return $politicians_ids;  
  }
  

} // OpResourcesPeer
