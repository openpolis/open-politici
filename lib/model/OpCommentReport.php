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

require_once 'lib/model/om/BaseOpCommentReport.php';


/**
 * Skeleton subclass for representing a row from the 'op_comment_report' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpCommentReport extends BaseOpCommentReport {

	public function save($con = null,$id=0)
	{
    if ($this->isNew() && !$this->isColumnModified('created_at'))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpCommentReportPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			
			if ($this->isNew())
			{
				$comment=OpCommentPeer::RetrieveByPk($this->getCommentId());
				$rep_number=$comment->getReports();
				$rep_number=$rep_number + 1;
				$comment->setReports($rep_number);
				$comment_affected_rows = $comment->save($con);	
			}
			
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
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
			$con = Propel::getConnection(OpCommentReportPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$comment=OpCommentPeer::RetrieveByPk($this->getCommentId());
			$rep_number=$comment->getReports();
				$rep_number=$rep_number - 1;
			$comment->setReports($rep_number);
			$comment_affected_rows = $comment->save($con);
			
			OpCommentReportPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

} // OpCommentReport

?>
