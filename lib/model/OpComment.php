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

require_once 'lib/model/om/BaseOpComment.php';


/**
 * Skeleton subclass for representing a row from the 'op_comment' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpComment extends BaseOpComment {
  
 	public function save($con = null)
 	{
 	  if ($this->isNew()) $to_index = true;
 	  else $to_index = false;

		if ($con === null) {
			$con = Propel::getConnection(OpDeclarationPeer::DATABASE_NAME);
		}

		try 
		{
			$con->begin();
  		parent::save($con);
 	  
   	  // aggiornamento del campo op_user.comments
      $user = $this->getOpUser();
      $user->setComments($user->countOpComments());
      $user->updateLastContribution();
      $user->save($con);
      unset($user);

   	  if ($to_index){
  			// aggiunta all'indice testuale
        $iMan = new OpIndexManager();
        $iMan->addDocument($this);
        $iMan->commit();
        unset($iMan); 	    
  		}
  		
	    $con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
		
 	}

 	public function delete($con = null)
 	{
		if ($con === null) {
			$con = Propel::getConnection(OpDeclarationPeer::DATABASE_NAME);
		}

		try 
		{
			$con->begin();
  		// rimozione dall'indice testuale
      $iMan = new OpIndexManager();
      $iMan->removeDocument($this);
      $iMan->commit();
      unset($iMan); 	    

  		parent::delete();

      // eventuale aggiornamento del campo op_user.last_contribution
      $user = $this->getOpUser();
      $user->updateLastContribution();
      $user->save();

   	  // aggiornamento del campo op_user.comments
      $user = $this->getOpUser();
      $user->setComments($user->countOpComments());
      $user->save($con);
      unset($user);

	    $con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
  		
 	}
  
  
  public function getRelevancyUpPercent()
  {
    $total = $this->getRelevancyScoreUp() + $this->getRelevancyScoreDown();
    return $total ? sprintf('%.0f', $this->getRelevancyScoreUp() * 100 / $total) : 0;
  }

  public function getRelevancyDownPercent()
  {
    $total = $this->getRelevancyScoreUp() + $this->getRelevancyScoreDown();
    return $total ? sprintf('%.0f', $this->getRelevancyScoreDown() * 100 / $total) : 0;
  }

} // OpComment
?>