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

require_once 'lib/model/om/BaseOpUser.php';


/**
 * Skeleton subclass for representing a row from the 'op_user' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpUser extends BaseOpUser {

  public function __toString()
  {
    if ($this->getId() == 1) {
      return 'admin';
    }
    if ($this->getPublicName())
    {
      return ucfirst(strtolower($this->getFirstName())).' '.strtoupper($this->getLastName());
    }
    else
    {
      return $this->getNickname();
    }
  }
  
  
  public function getActivities()
  {
    $activities = array();
    $activities['last_opencontent'] = $this->getLastContribution('d F Y');      
    if ($activities['last_opencontent'] !== null) 
      $activities['last_contribution'] = $activities['last_opencontent'];
    else
      $activities['last_contribution'] = "mai";
    
  	$c = new Criteria();
  	$c->add(OpOpenContentPeer::USER_ID,$this->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
    $n_opencontents = OpOpenContentPeer::doCount($c);
    
    $c = new Criteria();
    $c->add(OpCommentPeer::USER_ID, $this->getId());
    $n_comments = OpCommentPeer::doCount($c);
    
    $activities['n_contributions'] = $n_opencontents + $n_comments; 

  	$c = new Criteria();
  	$c->add(OpOpenContentPeer::USER_ID,$this->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  	$activities['n_institution_charges'] = OpInstitutionChargePeer::doCountJoinOpOpenContent($c);

  	$c = new Criteria();
  	$c->add(OpOpenContentPeer::USER_ID,$this->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  	$activities['n_political_charges'] = OpPoliticalChargePeer::doCountJoinOpOpenContent($c);

  	$c = new Criteria();
  	$c->add(OpOpenContentPeer::USER_ID,$this->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  	$activities['n_organization_charges'] = OpOrganizationChargePeer::doCountJoinOpOpenContent($c);

    return $activities;
  }
  
  /**
   * ritorna un hash univoco per l'utente (per ora la sua sha1 password)
   *
   * @return l'hash dell'utente
   * @author Guglielmo Celata
   **/
  public function getHash()
  {
    return $this->getSha1Password();
  }

  /*
   * override to store a single password in the salt and sha1_password fields
   */
  public function setPassword($password){
  	$salt = md5(rand(100000, 999999).$this->__toString().$this->getEmail());
  	$this->setSalt($salt);
  	$this->setSha1Password(sha1($salt.$password));
  }
  
  /**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param Connection $con
	 * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws PropelException
	 * @see doSave()
	 */
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified('created_at'))
    {
      //$this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpUserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Set the value of [picture] column, starting from a file.
	 * This extends the base class, using a method of the CLOB object.
	 * If the file does not exist, then the original setPicture method is called
	 * 
	 * @param string $filename file location on server
	 * @return void
	 */
	public function setPicture($filename)
	{
	  // forza manualmente la messa a null del campo
	  if ($filename === null)
	  {
	    $this->picture = null;
			$this->modifiedColumns[] = OpUserPeer::PICTURE;
	  }
	  
		if(!stat($filename)){
			parent::setPicture($filename);
		} else {
			try {
				$this->picture = new Clob();
				$this->picture->readFromFile($filename);
				$this->modifiedColumns[] = OpUserPeer::PICTURE;
			} catch (Exception $e) {
				echo("Exception " . $e . " encountered!\n");
			}
		}
	}
	
	public function isInterestedIn($opinableContent)
  	{
    	$relevancy = new OpRelevancy();
    	$relevancy->setContentId($opinableContent->getContentId());
    	$relevancy->setUserId($this->getId());
		  $relevancy->setScore('1');
    	$relevancy->save();
		
		  switch ($opinableContent->getOpOpenContent()->getOpContent()->getOpTable())
		  {
		    case 'op_declaration':
		      $content = OpDeclarationPeer::RetrieveByPk($opinableContent->getContentId());
		      break;
		    case 'op_theme':
  	      $content = OpThemePeer::RetrieveByPk($opinableContent->getContentId());
  	      break;
		  }
		  $content->setRelevancyScore($content->getRelevancyScore()+1);
		  $content->save();
  	}
	
  public function getRole()
  {
    if($this->getIsAdministrator())
	    return 'amministratore';
	  elseif($this->getIsAggiungitor())
	    return 'aggiungitore';
	  elseif ($this->getIsModerator())
	    return 'moderatore';
	  else
	    return 'utente';    	
  }
  
  /**
   * DEPRECATED
   * TODO: remove
   *
   * @return void
   * @author Guglielmo Celata
   */
  public function countDeclaration()
  {
    return $this->countDeclarations();
  }
  

  /**
   * criterio estrazione dichiarazioni inserite e/o modificate dall'utente
   *
   * @param string $upsert 
   * @return void
   * @author Guglielmo Celata
   */
  public function declarationsCriteria($upsert)
  {
    $c = new Criteria();
    if ($upsert == 'insert') {
      $c->add(OpOpenContentPeer::USER_ID, $this->getId());
    } else if ($upsert == 'update') {      
      $c->add(OpOpenContentPeer::UPDATER_ID, $this->getId());
    } else {
      $c1 = $c->getNewCriterion(OpOpenContentPeer::USER_ID, $this->getId());
      $c2 = $c->getNewCriterion(OpOpenContentPeer::UPDATER_ID, $this->getId());
      $c1->addOr($c2);
    	$c->add($c1);
    }
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
  	$c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
  	$c->addJoin(OpDeclarationPeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
  	return $c;
  }

  /**
   * torna il numero di dichiarazioni non oscurate inserite e/o modificate dall'utente
   * di default torna quelle inserite
   *
   * @return integer
   * @author Guglielmo Celata
   **/
  public function countDeclarations($upsert = 'insert')
  {
    $c = $this->declarationsCriteria($upsert);
  	return OpDeclarationPeer::doCount($c);
  }
  
  public function getAllDeclarations($limit=0, $upsert='both')
  {
    $c = $this->declarationsCriteria($upsert);
  	if ($limit)
  	  $c->setLimit($limit);
  	$c->addDescendingOrderByColumn(OpContentPeer::UPDATED_AT);
  	return OpDeclarationPeer::doSelect($c);
  }

  /**
   * torna il numero di temi non oscurati inseriti dall'utente
   *
   * @return integer
   * @author Guglielmo Celata
   **/
  public function countThemes()
  {
     $c = new Criteria();
  	 $c->addJoin(OpThemePeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
  	 $c->addJoin(OpOpinableContentPeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
  	 $c->Add(OpOpenContentPeer::USER_ID, $this->getId(), Criteria::EQUAL);
  	 $c->Add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
  	 return OpThemePeer::doCount($c);
  }
  
  /**
   * torna il timestamp dell'ultimo commento inserito
   *
   * @return integer (timestamp)
   * @author Guglielmo Celata
   **/
  public function getLastCommentTS()
  {
    $c = new Criteria();
    $c->add(OpCommentPeer::USER_ID, $this->getId());
  	$c->addDescendingOrderByColumn(OpCommentPeer::CREATED_AT);
    $last = OpCommentPeer::doSelectOne($c);
    if ($last instanceof OpComment)
      return $last->getCreatedAt();
    else
      return -1;
  }
  
  
  
  /**
   * torna il timestamp dell'ultima dichiarazione inserita (e non oscurata)
   *
   * @return integer (timestamp)
   * @author Guglielmo Celata
   **/
  public function getLastDeclarationTS()
  {
    $c = new Criteria();
    $c->addJoin(OpDeclarationPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->addJoin(OpOpinableContentPeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID, Criteria::LEFT_JOIN);
    $c->add(OpOpenContentPeer::USER_ID, $this->getId(), Criteria::EQUAL);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    $last = OpDeclarationPeer::doSelectOne($c);
    if ($last instanceof OpDeclaration)
      return $last->getOpOpinableContent()->getOpOpenContent()->getOpContent()->getCreatedAt();
    else
      return -1;
  }

  /**
   * torna il timestamp dell'ultimo tema inserito (e non oscurato)
   *
   * @return integer (timestamp)
   * @author Guglielmo Celata
   **/
  public function getLastThemeTS()
  {
    $c = new Criteria();
    $c->addJoin(OpDeclarationPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->addJoin(OpOpinableContentPeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID, Criteria::LEFT_JOIN);
    $c->add(OpOpenContentPeer::USER_ID, $this->getId(), Criteria::EQUAL);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    $last = OpThemePeer::doSelectOne($c);
    if ($last instanceof OpTheme)
      return $last->getOpOpinableContent()->getOpOpenContent()->getOpContent()->getCreatedAt();
    else
      return -1;
  }
  
  /**
   * torna il TS dell'ultimo open content inserito dall'utente
   *
   * @return timestamp / -1
   * @author Guglielmo Celata
   **/
  public function getLastOpenContentContributedTS()
  {
    $c = new Criteria();
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpContentPeer::ID);
    $c->add(OpOpenContentPeer::USER_ID, $this->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, NULL);
    $c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    $last =  OpContentPeer::doSelectOne($c);      
    
    if ($last instanceof OpContent)
      return $last->getCreatedAt();
    else
      return -1;
  }
  
  /**
   * aggiorna il campo last_contribution, 
   * leggendo l'ultimo open content non deleted 
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function updateLastContribution()
  {
    if (max(self::getLastCommentTS(), self::getLastOpenContentContributedTS()) > 0)
      self::setLastContribution(max(self::getLastCommentTS(), self::getLastOpenContentContributedTS()));
    else
      self::setLastContribution( null );  	  
  }
  

  /**
   * criterio estrazione incarichi inseriti e/o modificati dall'utente
   *
   * @param string $upsert 
   * @return void
   * @author Guglielmo Celata
   */
  public function chargesCriteria($upsert)
  {
    $c = new Criteria();
    if ($upsert == 'insert') {
      $c->add(OpOpenContentPeer::USER_ID, $this->getId());
    } else if ($upsert == 'update') {      
      $c->add(OpOpenContentPeer::UPDATER_ID, $this->getId());
    } else {
      $c1 = $c->getNewCriterion(OpOpenContentPeer::USER_ID, $this->getId());
      $c2 = $c->getNewCriterion(OpOpenContentPeer::UPDATER_ID, $this->getId());
      $c1->addOr($c2);
    	$c->add($c1);
    }
    $c->add(OpContentPeer::OP_CLASS, 
            array('OpInstitutionCharge', 'OpPoliticalCharge', 'OpOrganizationCharge'), Criteria::IN);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
  	$c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
  	return $c;
  }


  /**
   * conta il numero di incarichi inseriti dall'utente
   *
   * @return integer
   * @author Guglielmo Celata
   **/
  public function countCharges($upsert='insert')
  {
    $c = $this->chargesCriteria($upsert);
    return OpOpenContentPeer::doCount($c);
  }
  

  /**
   * estrae gli incarichi inseriti dall'autore (non rimossi)
   *
   * @return array of OpOpenContent
   * @author Guglielmo Celata
   */
  public function getAllCharges($limit=0, $upsert='both')
  {
    $c = $this->chargesCriteria($upsert);
  	$c->addDescendingOrderByColumn(OpContentPeer::UPDATED_AT);
    return OpOpenContentPeer::doSelect($c);
  }



  /**
   * criterio estrazione incarichi inseriti e/o modificati dall'utente
   *
   * @param string $upsert 
   * @return void
   * @author Guglielmo Celata
   */
  public function resourcesCriteria($upsert)
  {
    $c = new Criteria();
    if ($upsert == 'insert') {
      $c->add(OpOpenContentPeer::USER_ID, $this->getId());
    } else if ($upsert == 'update') {      
      $c->add(OpOpenContentPeer::UPDATER_ID, $this->getId());
    } else {
      $c1 = $c->getNewCriterion(OpOpenContentPeer::USER_ID, $this->getId());
      $c2 = $c->getNewCriterion(OpOpenContentPeer::UPDATER_ID, $this->getId());
      $c1->addOr($c2);
    	$c->add($c1);
    }
    $c->addJoin(OpResourcesPeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
  	$c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
  	return $c;
  }

  /**
   * conta il numero di risorse inseriti dall'utente
   *
   * @return integer
   * @author Guglielmo Celata
   **/
  public function countResources($upsert='insert')
  {
    $c = $this->resourcesCriteria($upsert);
    return OpOpenContentPeer::doCount($c);
  }

  /**
   * estrae le risorse inserite dall'autore (non rimossi)
   *
   * @return array of OpOpenContent
   * @author Guglielmo Celata
   */
  public function getAllResources($limit=0, $upsert='both')
  {
    $c = $this->resourcesCriteria($upsert);
    if ($limit) {
      $c->setLimit($limit);
    }
  	$c->addDescendingOrderByColumn(OpContentPeer::UPDATED_AT);
    return OpOpenContentPeer::doSelect($c);
  }

  
  
  public function polInsertionsCriteria()
  {
    $c = new Criteria();
    $c->addJoin(OpContentPeer::ID, OpPoliticianPeer::CONTENT_ID);
    $c->add(OpPoliticianPeer::CREATOR_ID, $this->getId());
  	return $c;
  }

  public function countPolInsertions()
  {
    $c = $this->polInsertionsCriteria();
    return OpPoliticianPeer::doCount($c);    
  }

  public function getAllPolInsertions($limit=0)
  {
    $c = $this->polInsertionsCriteria();
    if ($limit) {
      $c->setLimit($limit);
    }
  	$c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
    return OpPoliticianPeer::doSelect($c);    
  }
  
  
  public function getAllRemovals($limit = 0)
  {
    $c = new Criteria();
    $c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
    $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpObscuredContentPeer::CONTENT_ID);
    $c->add(OpObscuredContentPeer::USER_ID, $this->getId());
    if ($limit) {
      $c->setLimit($limit);
    }
  	$c->addDescendingOrderByColumn(OpObscuredContentPeer::CREATED_AT);
    return OpObscuredContentPeer::doSelect($c);
  }
		
	
} // OpUser
