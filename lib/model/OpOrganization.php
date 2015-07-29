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

require_once 'lib/model/om/BaseOpOrganization.php';


/**
 * Skeleton subclass for representing a row from the 'op_organization' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpOrganization extends BaseOpOrganization {

	public function getTags()
	{
	  $c = new Criteria();
	  $c->add(OpOrganizationTagsPeer::ORGANIZATION_ID, $this->getId());
	  $tags_id=OpOrganizationTagsPeer::doSelect($c);
	  
	  $tags = array();
	  
	  foreach($tags_id as $tag_id)
	  {
	  	$tag=OpOrganizationTagPeer::RetrieveByPk($tag_id->getOrganizationTagId());
		$tags[] = $tag->getName();
	  }
	 
	  return $tags;
	}
	
	public function getTagsAsString()
	{
	  $tags = $this->getOpOrganizationHasOpOrganizationTagsJoinOpOrganizationTag();
	  $tags_as_string = '';
	  foreach ($tags as $tag) {
	   $tags_as_string .= $tag->getOpOrganizationTag()->getName() . ", ";
	  }
	  return trim($tags_as_string, ", ");
	}
	
	/**
	 * set tags related to an organization
	 * inserting new tags, when needed
	 * tags are removed first
	 *
	 * @return void
	 * @param string - the string containing the tags; tags are separated by a "," char
	 * @author Guglielmo Celata
	 **/
	public function setTagsFromString( $string )
	{
	  
	  // remove all tags related to this organization
	  $c = new Criteria();
	  $c->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, $this->getId());
    OpOrganizationHasOpOrganizationTagPeer::doDelete($c);
    
    // re-insert all tags, taking them from the string
    $tags_names = split(",", $string);
    foreach ($tags_names as $tag_name) {
      $tag = OpOrganizationTagPeer::retrieveOrCreate(trim($tag_name));
      OpOrganizationHasOpOrganizationTagPeer::controlledInsert($tag, $this);
    }
	}

} // OpOrganization
?>
