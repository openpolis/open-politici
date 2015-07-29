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

require_once 'lib/model/om/BaseOpPartyMembership.php';


/**
 * Skeleton subclass for representing a row from the 'op_party_membership' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpPartyMembership extends BaseOpPartyMembership {

    /*
	 * Stores the object in the database.  
	 * Overrides the method in the Object Model, taking account of
	 * the op_content relation.
	 * If the object is new, then an OpenContent object is created and saved
	 * before saving the PartyMembership object, so that the last one can get
	 * its content_id field from the OpenContent object.
	 * This method wraps the doSave() worker method in a transaction.
	 *
	 * @param Connection $con
	 * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws PropelException
	 * @see doSave()
	 */
	public function save($con = null)
	{
		$c_affected_rows = 0;
		
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpPartyMembershipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			if ($this->isNew()){
				$c = new OpOpenContent();
				$c->setUserId(sfContext::getInstance()->getUser()->getAttribute('subscriber_id', '', 'subscriber')?sfContext::getInstance()->getUser()->getSubscriberId():1);
				$c_affected_rows = $c->save($con);
				$this->setContentId($c->getContentId());
				$this->setOpOpenContent($c);

				// set op_table and hash fields in op_content table
				$cc = $c->getOpContent();
				$cc->setOpClass("OpPartyMembership");
				$cc->setOpTable(OpPartyMembershipPeer::TABLE_NAME);
				$cc->setHash(md5(rand(100000, 999999).$this->getContentId().time()));
				$cc->save();
			} else if ($this->isModified()){
				$this->getOpOpenContent()->getOpContent()->setUpdatedAt(time());
				$this->getOpOpenContent()->getOpContent()->save();				
			}
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $c_affected_rows + $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpPartyMembershipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$c = $this->getOpOpenContent();
			$c->delete();
			OpPartyMembershipPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

} // OpPartyMembership
