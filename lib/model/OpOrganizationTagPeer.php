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
  require_once 'lib/model/om/BaseOpOrganizationTagPeer.php';
  
  // include object class
  include_once 'lib/model/OpOrganizationTag.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_organization_tag' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpOrganizationTagPeer extends BaseOpOrganizationTagPeer {

  /**
   * retrieve an OpOrganizationTag object starting from a name
   *
   * @return void
   * @param string - the name of the tag
   * @author Guglielmo Celata
   **/
  public function retrieveByName($name)
  {
    $c = new Criteria();
		$c->add(OpOrganizationTagPeer::NAME, $name);
		$res = OpOrganizationTagPeer::doSelect($c);
	  
		if (count($res) == 1) return $res[0];
		if (count($res) == 0) return null;
		if (count($res) > 1) throw new Exception("More than one record returned");
  }

  /**
   * retrieve an OpOrganizationTag object, starting from a name
   * if the name is not in the list, then create a new object and return it
   *
   * @return OpOrganizationTag
   * @param string - the name of the tag to lookup or create
   * @author Guglielmo Celata
   **/
  public function retrieveOrCreate($tag_name)
  {
    $tag = self::retrieveByName($tag_name);
    if (!$tag instanceof OpOrganizationTag)
    {
      $tag = new OpOrganizationTag();
      $tag->setName($tag_name);
      $tag->save();
    }
    
    return $tag;
  }
} // OpOrganizationTagPeer
