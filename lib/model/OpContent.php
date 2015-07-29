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

require_once 'lib/model/om/BaseOpContent.php';


/**
 * Skeleton subclass for representing a row from the 'op_content' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpContent extends BaseOpContent {

  


  public function deleteReports()
  {
    $reports = $this->getOpReports();
    foreach ($reports as $report)
    {
      $report->delete();
    }

    $this->setReports(0);
  }

	public function getContentId(){
		return parent::getId();
	}
	
  /**
   * returns the real, instanced object, starting from model and id
   *
   * @return object of variable class
   * @author Guglielmo Celata
   */
	public function getInstancedObject()
	{
	  return call_user_func(array($this->getOpClass().'Peer', 'retrieveByPK'), $this->getId());
	}
	
	public function hasBeenModified()
	{
	  return $this->getCreatedAt() != $this->getUpdatedAt();
	}
	
} // OpContent
