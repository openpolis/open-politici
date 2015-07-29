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

require_once 'lib/model/om/BaseOpReport.php';


/**
 * Skeleton subclass for representing a row from the 'op_report' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpReport extends BaseOpReport {

	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified('created_at'))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpReportPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			
			if ($this->isNew())
			{
        // aggiunta di un nuovo report, va incrementato il numero di report
        
        // retrieve del content cui il report si riferisce
				$content = OpContentPeer::RetrieveByPk($this->getContentId());

  			// calcola quanti report per questo contenuto esistono
  			$c = new Criteria();
  			$c->add(OpReportPeer::CONTENT_ID, $this->getContentId());
  			$n_reports = OpReportPeer::doCount($c);

        // incremento del numero di reports per il content
  			$content->setReports($n_reports + 1);
				$content_affected_rows = $content->save($con);	
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
			$con = Propel::getConnection(OpReportPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$content = OpContentPeer::RetrieveByPk($this->getContentId());

			// calcola quanti report per questo contenuto esistono
			$c = new Criteria();
			$c->add(OpReportPeer::CONTENT_ID, $this->getContentId());
			$n_reports = OpReportPeer::doCount($c);
      
      // decremento del numero di report per il contenuto
			$content->setReports($n_reports - 1);
			$content_affected_rows = $content->save($con);
			
			// cancellazione del report
			OpReportPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

}