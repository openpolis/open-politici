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

require_once 'lib/model/om/BaseOpOpenContent.php';


/**
 * Skeleton subclass for representing a row from the 'op_open_content' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpOpenContent extends BaseOpOpenContent {

  /**
   * Stores the object in the database.  
   * Overrides the method in the Object Model, taking account of
   * the op_content relation.
   * If the object is new, then a Content object is created and saved
   * before saving the OpenContent object, so that the last one can get
   * its content_id field from the Content object.
   * This method wraps the doSave() worker method in a transaction.
   *
   * @param Connection $con
   * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
   * @throws PropelException
   * @see doSave()	
   */
  public function save($con = null)
  {

    if ($this->isDeleted()) {
      throw new PropelException("You cannot save an object that has been deleted.");
    }

    if ($con === null) {
      $con = Propel::getConnection(OpOpenContentPeer::DATABASE_NAME);
    }

    try {
      $con->begin();
      $c_affected_rows=0;
      if ($this->isNew()){
        $c = new OpContent();
        $c_affected_rows = $c->save($con);
        $this->setContentId($c->getId());
        $this->setOpContent($c);
      }
      $affectedRows = $this->doSave($con);
      
      $con->commit();

      // aggiornamento campo last_contribution
      $user = $this->getOpUser();
      $user->setLastContribution(mktime());
      $user->save($con);
      unset($user);

			
      return  $c_affected_rows + $affectedRows;
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
      $con = Propel::getConnection(OpOpenContentPeer::DATABASE_NAME);
    }

    try {
      $con->begin();
      $user = $this->getOpUser();

      $c = $this->getOpContent();
      OpOpenContentPeer::doDelete($this, $con);
      $c->delete();
      $this->setDeleted(true);

      // agiornamento campo op_user.charges
      $user->setCharges($user->countCharges());
      $user->setResources($user->countResources());
      $user->save($con);
      unset($user);

      $con->commit();
    } catch (PropelException $e) {
      $con->rollback();
      throw $e;
    }
  }
	
	public function getOpUser($con = null)
	{
	  return $this->getOpUserRelatedByUserId($con);
	}

	public function getOpUpdater($con = null)
	{
	  return $this->getOpUserRelatedByUpdaterId($con);
	}
	
	/**
	 * Collection to store aggregation of collOpDeclarations.
	 * @var array
	 */
	protected $collOpDeclarations;

	/**
	 * The criteria used to select the current contents of collOpDeclarations.
	 * @var Criteria
	 */
	protected $lastOpDeclarationCriteria = null;
	
	/**
	 * Temporary storage of collOpDeclarations to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return void
	 */
	public function initOpDeclarations()
	{
		if ($this->collOpDeclarations === null) {
			$this->collOpDeclarations = array();
		}
	}
	
	/**
	 * Method called to associate a OpDeclaration object to this object
	 * through the OpDeclaration foreign key attribute
	 *
	 * @param OpDeclaration $l OpDeclaration
	 * @return void
	 * @throws PropelException
	 */
	public function addOpDeclaration(OpDeclaration $l)
	{
		$this->collOpDeclarations[] = $l;
		$l->setOpOpenContent($this);
	}


  public function getOpInstitutionCharge()
  {
    $charges = $this->getOpInstitutionCharges();
    if (count($charges))
      return $charges[0];
    else return null;
  }


  public function getStatus()
  {
    if ($this->getVerifiedAt()) {
      if (!is_null($this->getDeletedAt()))
        return 'R';
      else
        return 'A';
    } else {
      return '';      
    }
  }
  
  
  public function accept($user)
  {
    if (!is_null($this->getDeletedAt())) {
      # restore contenuto
      $this->removeObscuredContents();
      $this->addVerificationRecord($user->getSubscriberId(), 'ripristinato');
      $this->setDeletedAt(null);
      $this->setVerifiedAt(time());
      $this->save();
      return array('type' => 'notice', 'message' => "L'inserimento è stato ripristinato", 
                   'operation' => 'ripristinato');
    } else {
      if (is_null($this->getVerifiedAt())) {
        # accetta contenuto
        $this->addVerificationRecord($user->getSubscriberId(), 'accettato');
        $this->setVerifiedAt(time());
        $this->save();
        return array('type' => 'notice', 'message' => "L'inserimento è stato accettato", 
                     'operation' => 'accettato');
      } else {
        # contenuto giò accettato
        return array('type' => 'warning', 'message' => "L'inserimento è già accettato, lo status non è cambiato",
                     'operation' => '');
      }
    }
  }
  
  public function reject($user)
  {
    if (!is_null($this->getDeletedAt())) {
      # contenuto già respinto
      return array('type' => 'warning', 'message' => "L'inserimento è già rifiutato, lo status non è cambiato", 
                   'operation' => '');
    } else {
      # respingi contenuto
      $now = time();
      $this->addObscuredRecord($user->getSubscriberId(), 'non passa la verifica');
      $this->addVerificationRecord($user->getSubscriberId(), 'rifiutato');
      $this->setVerifiedAt($now);
      $this->setDeletedAt($now);
      $this->save();
      return array('type' => 'notice', 'message' => "L'inserimento è stato rifiutato", 
                   'operation' => 'rifiutato');
    }    
  }
  
  public function removeObscuredContents()
  {
    $obscured_contents = $this->getOpObscuredContents();
    foreach ($obscured_contents as  $oc) {
      $oc->delete();
    }
  }

  public function addObscuredRecord($user_id, $reason)
  {
    $op_obscured_content = new OpObscuredContent();
    $op_obscured_content->setContentId($this->getContentId());
    $op_obscured_content->setUserId($user_id);
    $op_obscured_content->setReason($reason);
    $op_obscured_content->save();
  }
  
  public function addVerificationRecord($user_id, $operation)
  {
    $op_verified_content = new OpVerifiedContent();
    $op_verified_content->setContentId($this->getContentId());
    $op_verified_content->setUserId($user_id);
    $op_verified_content->setOperation($operation);
    $op_verified_content->save();
  }



} // OpOpenContent
