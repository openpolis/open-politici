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
  require_once 'lib/model/om/BaseOpTagHasOpOpinableContentPeer.php';
  
  // include object class
  include_once 'lib/model/OpTagHasOpOpinableContent.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_tag_has_op_opinable_content' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpTagHasOpOpinableContentPeer extends BaseOpTagHasOpOpinableContentPeer {
  
  
  public static function getTagsIdsForContent($opinable_content_id)
  {
    $c = new Criteria();
    $c->add(self::OPINABLE_CONTENT_ID, $opinable_content_id);
    $c->add(self::IS_OBSCURED, null, Criteria::ISNOTNULL);
    $c->clearSelectColumns();
    $c->addSelectColumn(self::TAG_ID);

    $ids = array();
    $rs = self::doSelectRS($c);
    while ($rs->next()) {
      $ids[] = $rs->getInt(1);
    }
    return $ids; 
  }
  
  public function CountTagForDeclaration()
  {
    $con = Propel::getConnection(self::DATABASE_NAME);

    $sql = sprintf("select count(*) as cn, t.id as id, t.tag as value from op_tag_has_op_opinable_content tg,op_tag t where t.id=tg.tag_id and tg.is_obscured=0 group by t.id order by cn desc");
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);

    $ids = array();
    while ($rs->next()) {
      $row = $rs->getRow();
      $ids [$row['id']]= array($row['value'], $row['cn']);
    }

    return $ids;
  }

} // OpTagHasOpOpinableContentPeer
