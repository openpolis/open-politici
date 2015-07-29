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
  require_once 'lib/model/om/BaseOpOrganizationHasOpOrganizationTagPeer.php';
  
  // include object class
  include_once 'lib/model/OpOrganizationHasOpOrganizationTag.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_organization_has_op_organization_tag' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpOrganizationHasOpOrganizationTagPeer extends BaseOpOrganizationHasOpOrganizationTagPeer {

  /**
   * insert a record in the MN table connecting Organizations and their Tags
   * only if the record is not already there
   *
   * @return void
   * @param OpOrganizationTag - the tag 
   * @param OpOrganization    - the organization
   * @author Guglielmo Celata
   **/
  public function controlledInsert($tag, $org)
  {
    $res = self::retrieveByPK($tag->getId(), $org->getId());
    if (!$res)
    {
      $obj = new OpOrganizationHasOpOrganizationTag();
      $obj->setOpOrganizationTag($tag);
      $obj->setOpOrganization($org);
      $obj->save();
    }
  }
} // OpOrganizationHasOpOrganizationTagPeer
