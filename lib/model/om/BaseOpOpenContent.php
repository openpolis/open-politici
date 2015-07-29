<?php


abstract class BaseOpOpenContent extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $content_id;


	
	protected $user_id;


	
	protected $updater_id;


	
	protected $verified_at;


	
	protected $deleted_at;

	
	protected $aOpContent;

	
	protected $aOpUserRelatedByUserId;

	
	protected $aOpUserRelatedByUpdaterId;

	
	protected $collOpInstitutionCharges;

	
	protected $lastOpInstitutionChargeCriteria = null;

	
	protected $collOpObscuredContents;

	
	protected $lastOpObscuredContentCriteria = null;

	
	protected $collOpVerifiedContents;

	
	protected $lastOpVerifiedContentCriteria = null;

	
	protected $collOpOpinableContents;

	
	protected $lastOpOpinableContentCriteria = null;

	
	protected $collOpOrganizationCharges;

	
	protected $lastOpOrganizationChargeCriteria = null;

	
	protected $collOpPoliticalCharges;

	
	protected $lastOpPoliticalChargeCriteria = null;

	
	protected $collOpResourcess;

	
	protected $lastOpResourcesCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getContentId()
	{

		return $this->content_id;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getUpdaterId()
	{

		return $this->updater_id;
	}

	
	public function getVerifiedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->verified_at === null || $this->verified_at === '') {
			return null;
		} elseif (!is_int($this->verified_at)) {
						$ts = strtotime($this->verified_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [verified_at] as date/time value: " . var_export($this->verified_at, true));
			}
		} else {
			$ts = $this->verified_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDeletedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->deleted_at === null || $this->deleted_at === '') {
			return null;
		} elseif (!is_int($this->deleted_at)) {
						$ts = strtotime($this->deleted_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [deleted_at] as date/time value: " . var_export($this->deleted_at, true));
			}
		} else {
			$ts = $this->deleted_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->content_id !== $v) {
			$this->content_id = $v;
			$this->modifiedColumns[] = OpOpenContentPeer::CONTENT_ID;
		}

		if ($this->aOpContent !== null && $this->aOpContent->getId() !== $v) {
			$this->aOpContent = null;
		}

	} 
	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = OpOpenContentPeer::USER_ID;
		}

		if ($this->aOpUserRelatedByUserId !== null && $this->aOpUserRelatedByUserId->getId() !== $v) {
			$this->aOpUserRelatedByUserId = null;
		}

	} 
	
	public function setUpdaterId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->updater_id !== $v) {
			$this->updater_id = $v;
			$this->modifiedColumns[] = OpOpenContentPeer::UPDATER_ID;
		}

		if ($this->aOpUserRelatedByUpdaterId !== null && $this->aOpUserRelatedByUpdaterId->getId() !== $v) {
			$this->aOpUserRelatedByUpdaterId = null;
		}

	} 
	
	public function setVerifiedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [verified_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->verified_at !== $ts) {
			$this->verified_at = $ts;
			$this->modifiedColumns[] = OpOpenContentPeer::VERIFIED_AT;
		}

	} 
	
	public function setDeletedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [deleted_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->deleted_at !== $ts) {
			$this->deleted_at = $ts;
			$this->modifiedColumns[] = OpOpenContentPeer::DELETED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->content_id = $rs->getInt($startcol + 0);

			$this->user_id = $rs->getInt($startcol + 1);

			$this->updater_id = $rs->getInt($startcol + 2);

			$this->verified_at = $rs->getTimestamp($startcol + 3, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpOpenContent object", $e);
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
			OpOpenContentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
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
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aOpContent !== null) {
				if ($this->aOpContent->isModified()) {
					$affectedRows += $this->aOpContent->save($con);
				}
				$this->setOpContent($this->aOpContent);
			}

			if ($this->aOpUserRelatedByUserId !== null) {
				if ($this->aOpUserRelatedByUserId->isModified()) {
					$affectedRows += $this->aOpUserRelatedByUserId->save($con);
				}
				$this->setOpUserRelatedByUserId($this->aOpUserRelatedByUserId);
			}

			if ($this->aOpUserRelatedByUpdaterId !== null) {
				if ($this->aOpUserRelatedByUpdaterId->isModified()) {
					$affectedRows += $this->aOpUserRelatedByUpdaterId->save($con);
				}
				$this->setOpUserRelatedByUpdaterId($this->aOpUserRelatedByUpdaterId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpOpenContentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpOpenContentPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpInstitutionCharges !== null) {
				foreach($this->collOpInstitutionCharges as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpObscuredContents !== null) {
				foreach($this->collOpObscuredContents as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpVerifiedContents !== null) {
				foreach($this->collOpVerifiedContents as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpOpinableContents !== null) {
				foreach($this->collOpOpinableContents as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpOrganizationCharges !== null) {
				foreach($this->collOpOrganizationCharges as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpPoliticalCharges !== null) {
				foreach($this->collOpPoliticalCharges as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpResourcess !== null) {
				foreach($this->collOpResourcess as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aOpContent !== null) {
				if (!$this->aOpContent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpContent->getValidationFailures());
				}
			}

			if ($this->aOpUserRelatedByUserId !== null) {
				if (!$this->aOpUserRelatedByUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUserRelatedByUserId->getValidationFailures());
				}
			}

			if ($this->aOpUserRelatedByUpdaterId !== null) {
				if (!$this->aOpUserRelatedByUpdaterId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUserRelatedByUpdaterId->getValidationFailures());
				}
			}


			if (($retval = OpOpenContentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpInstitutionCharges !== null) {
					foreach($this->collOpInstitutionCharges as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpObscuredContents !== null) {
					foreach($this->collOpObscuredContents as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpVerifiedContents !== null) {
					foreach($this->collOpVerifiedContents as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpOpinableContents !== null) {
					foreach($this->collOpOpinableContents as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpOrganizationCharges !== null) {
					foreach($this->collOpOrganizationCharges as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpPoliticalCharges !== null) {
					foreach($this->collOpPoliticalCharges as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpResourcess !== null) {
					foreach($this->collOpResourcess as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpOpenContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getContentId();
				break;
			case 1:
				return $this->getUserId();
				break;
			case 2:
				return $this->getUpdaterId();
				break;
			case 3:
				return $this->getVerifiedAt();
				break;
			case 4:
				return $this->getDeletedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpOpenContentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getContentId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getUpdaterId(),
			$keys[3] => $this->getVerifiedAt(),
			$keys[4] => $this->getDeletedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpOpenContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setContentId($value);
				break;
			case 1:
				$this->setUserId($value);
				break;
			case 2:
				$this->setUpdaterId($value);
				break;
			case 3:
				$this->setVerifiedAt($value);
				break;
			case 4:
				$this->setDeletedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpOpenContentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setContentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdaterId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setVerifiedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDeletedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpOpenContentPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpOpenContentPeer::CONTENT_ID)) $criteria->add(OpOpenContentPeer::CONTENT_ID, $this->content_id);
		if ($this->isColumnModified(OpOpenContentPeer::USER_ID)) $criteria->add(OpOpenContentPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(OpOpenContentPeer::UPDATER_ID)) $criteria->add(OpOpenContentPeer::UPDATER_ID, $this->updater_id);
		if ($this->isColumnModified(OpOpenContentPeer::VERIFIED_AT)) $criteria->add(OpOpenContentPeer::VERIFIED_AT, $this->verified_at);
		if ($this->isColumnModified(OpOpenContentPeer::DELETED_AT)) $criteria->add(OpOpenContentPeer::DELETED_AT, $this->deleted_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpOpenContentPeer::DATABASE_NAME);

		$criteria->add(OpOpenContentPeer::CONTENT_ID, $this->content_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getContentId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setContentId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setUpdaterId($this->updater_id);

		$copyObj->setVerifiedAt($this->verified_at);

		$copyObj->setDeletedAt($this->deleted_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpInstitutionCharges() as $relObj) {
				$copyObj->addOpInstitutionCharge($relObj->copy($deepCopy));
			}

			foreach($this->getOpObscuredContents() as $relObj) {
				$copyObj->addOpObscuredContent($relObj->copy($deepCopy));
			}

			foreach($this->getOpVerifiedContents() as $relObj) {
				$copyObj->addOpVerifiedContent($relObj->copy($deepCopy));
			}

			foreach($this->getOpOpinableContents() as $relObj) {
				$copyObj->addOpOpinableContent($relObj->copy($deepCopy));
			}

			foreach($this->getOpOrganizationCharges() as $relObj) {
				$copyObj->addOpOrganizationCharge($relObj->copy($deepCopy));
			}

			foreach($this->getOpPoliticalCharges() as $relObj) {
				$copyObj->addOpPoliticalCharge($relObj->copy($deepCopy));
			}

			foreach($this->getOpResourcess() as $relObj) {
				$copyObj->addOpResources($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setContentId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new OpOpenContentPeer();
		}
		return self::$peer;
	}

	
	public function setOpContent($v)
	{


		if ($v === null) {
			$this->setContentId(NULL);
		} else {
			$this->setContentId($v->getId());
		}


		$this->aOpContent = $v;
	}


	
	public function getOpContent($con = null)
	{
		if ($this->aOpContent === null && ($this->content_id !== null)) {
						include_once 'lib/model/om/BaseOpContentPeer.php';

			$this->aOpContent = OpContentPeer::retrieveByPK($this->content_id, $con);

			
		}
		return $this->aOpContent;
	}

	
	public function setOpUserRelatedByUserId($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->aOpUserRelatedByUserId = $v;
	}


	
	public function getOpUserRelatedByUserId($con = null)
	{
		if ($this->aOpUserRelatedByUserId === null && ($this->user_id !== null)) {
						include_once 'lib/model/om/BaseOpUserPeer.php';

			$this->aOpUserRelatedByUserId = OpUserPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->aOpUserRelatedByUserId;
	}

	
	public function setOpUserRelatedByUpdaterId($v)
	{


		if ($v === null) {
			$this->setUpdaterId(NULL);
		} else {
			$this->setUpdaterId($v->getId());
		}


		$this->aOpUserRelatedByUpdaterId = $v;
	}


	
	public function getOpUserRelatedByUpdaterId($con = null)
	{
		if ($this->aOpUserRelatedByUpdaterId === null && ($this->updater_id !== null)) {
						include_once 'lib/model/om/BaseOpUserPeer.php';

			$this->aOpUserRelatedByUpdaterId = OpUserPeer::retrieveByPK($this->updater_id, $con);

			
		}
		return $this->aOpUserRelatedByUpdaterId;
	}

	
	public function initOpInstitutionCharges()
	{
		if ($this->collOpInstitutionCharges === null) {
			$this->collOpInstitutionCharges = array();
		}
	}

	
	public function getOpInstitutionCharges($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
			   $this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

				OpInstitutionChargePeer::addSelectColumns($criteria);
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

				OpInstitutionChargePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
					$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;
		return $this->collOpInstitutionCharges;
	}

	
	public function countOpInstitutionCharges($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

		return OpInstitutionChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpInstitutionCharge(OpInstitutionCharge $l)
	{
		$this->collOpInstitutionCharges[] = $l;
		$l->setOpOpenContent($this);
	}


	
	public function getOpInstitutionChargesJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpInstitution($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpInstitution($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpInstitution($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpChargeType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpLocation($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpConstituency($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpConstituency($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpConstituency($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpParty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpGroup($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpGroup($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpGroup($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}

	
	public function initOpObscuredContents()
	{
		if ($this->collOpObscuredContents === null) {
			$this->collOpObscuredContents = array();
		}
	}

	
	public function getOpObscuredContents($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpObscuredContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpObscuredContents === null) {
			if ($this->isNew()) {
			   $this->collOpObscuredContents = array();
			} else {

				$criteria->add(OpObscuredContentPeer::CONTENT_ID, $this->getContentId());

				OpObscuredContentPeer::addSelectColumns($criteria);
				$this->collOpObscuredContents = OpObscuredContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpObscuredContentPeer::CONTENT_ID, $this->getContentId());

				OpObscuredContentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpObscuredContentCriteria) || !$this->lastOpObscuredContentCriteria->equals($criteria)) {
					$this->collOpObscuredContents = OpObscuredContentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpObscuredContentCriteria = $criteria;
		return $this->collOpObscuredContents;
	}

	
	public function countOpObscuredContents($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpObscuredContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpObscuredContentPeer::CONTENT_ID, $this->getContentId());

		return OpObscuredContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpObscuredContent(OpObscuredContent $l)
	{
		$this->collOpObscuredContents[] = $l;
		$l->setOpOpenContent($this);
	}


	
	public function getOpObscuredContentsJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpObscuredContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpObscuredContents === null) {
			if ($this->isNew()) {
				$this->collOpObscuredContents = array();
			} else {

				$criteria->add(OpObscuredContentPeer::CONTENT_ID, $this->getContentId());

				$this->collOpObscuredContents = OpObscuredContentPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpObscuredContentPeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpObscuredContentCriteria) || !$this->lastOpObscuredContentCriteria->equals($criteria)) {
				$this->collOpObscuredContents = OpObscuredContentPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpObscuredContentCriteria = $criteria;

		return $this->collOpObscuredContents;
	}

	
	public function initOpVerifiedContents()
	{
		if ($this->collOpVerifiedContents === null) {
			$this->collOpVerifiedContents = array();
		}
	}

	
	public function getOpVerifiedContents($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpVerifiedContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpVerifiedContents === null) {
			if ($this->isNew()) {
			   $this->collOpVerifiedContents = array();
			} else {

				$criteria->add(OpVerifiedContentPeer::CONTENT_ID, $this->getContentId());

				OpVerifiedContentPeer::addSelectColumns($criteria);
				$this->collOpVerifiedContents = OpVerifiedContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpVerifiedContentPeer::CONTENT_ID, $this->getContentId());

				OpVerifiedContentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpVerifiedContentCriteria) || !$this->lastOpVerifiedContentCriteria->equals($criteria)) {
					$this->collOpVerifiedContents = OpVerifiedContentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpVerifiedContentCriteria = $criteria;
		return $this->collOpVerifiedContents;
	}

	
	public function countOpVerifiedContents($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpVerifiedContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpVerifiedContentPeer::CONTENT_ID, $this->getContentId());

		return OpVerifiedContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpVerifiedContent(OpVerifiedContent $l)
	{
		$this->collOpVerifiedContents[] = $l;
		$l->setOpOpenContent($this);
	}


	
	public function getOpVerifiedContentsJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpVerifiedContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpVerifiedContents === null) {
			if ($this->isNew()) {
				$this->collOpVerifiedContents = array();
			} else {

				$criteria->add(OpVerifiedContentPeer::CONTENT_ID, $this->getContentId());

				$this->collOpVerifiedContents = OpVerifiedContentPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpVerifiedContentPeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpVerifiedContentCriteria) || !$this->lastOpVerifiedContentCriteria->equals($criteria)) {
				$this->collOpVerifiedContents = OpVerifiedContentPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpVerifiedContentCriteria = $criteria;

		return $this->collOpVerifiedContents;
	}

	
	public function initOpOpinableContents()
	{
		if ($this->collOpOpinableContents === null) {
			$this->collOpOpinableContents = array();
		}
	}

	
	public function getOpOpinableContents($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOpinableContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOpinableContents === null) {
			if ($this->isNew()) {
			   $this->collOpOpinableContents = array();
			} else {

				$criteria->add(OpOpinableContentPeer::CONTENT_ID, $this->getContentId());

				OpOpinableContentPeer::addSelectColumns($criteria);
				$this->collOpOpinableContents = OpOpinableContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpOpinableContentPeer::CONTENT_ID, $this->getContentId());

				OpOpinableContentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpOpinableContentCriteria) || !$this->lastOpOpinableContentCriteria->equals($criteria)) {
					$this->collOpOpinableContents = OpOpinableContentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpOpinableContentCriteria = $criteria;
		return $this->collOpOpinableContents;
	}

	
	public function countOpOpinableContents($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpOpinableContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpOpinableContentPeer::CONTENT_ID, $this->getContentId());

		return OpOpinableContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpOpinableContent(OpOpinableContent $l)
	{
		$this->collOpOpinableContents[] = $l;
		$l->setOpOpenContent($this);
	}

	
	public function initOpOrganizationCharges()
	{
		if ($this->collOpOrganizationCharges === null) {
			$this->collOpOrganizationCharges = array();
		}
	}

	
	public function getOpOrganizationCharges($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOrganizationCharges === null) {
			if ($this->isNew()) {
			   $this->collOpOrganizationCharges = array();
			} else {

				$criteria->add(OpOrganizationChargePeer::CONTENT_ID, $this->getContentId());

				OpOrganizationChargePeer::addSelectColumns($criteria);
				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpOrganizationChargePeer::CONTENT_ID, $this->getContentId());

				OpOrganizationChargePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpOrganizationChargeCriteria) || !$this->lastOpOrganizationChargeCriteria->equals($criteria)) {
					$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpOrganizationChargeCriteria = $criteria;
		return $this->collOpOrganizationCharges;
	}

	
	public function countOpOrganizationCharges($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpOrganizationChargePeer::CONTENT_ID, $this->getContentId());

		return OpOrganizationChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpOrganizationCharge(OpOrganizationCharge $l)
	{
		$this->collOpOrganizationCharges[] = $l;
		$l->setOpOpenContent($this);
	}


	
	public function getOpOrganizationChargesJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOrganizationCharges === null) {
			if ($this->isNew()) {
				$this->collOpOrganizationCharges = array();
			} else {

				$criteria->add(OpOrganizationChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpOrganizationChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpOrganizationChargeCriteria) || !$this->lastOpOrganizationChargeCriteria->equals($criteria)) {
				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpOrganizationChargeCriteria = $criteria;

		return $this->collOpOrganizationCharges;
	}


	
	public function getOpOrganizationChargesJoinOpOrganization($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOrganizationCharges === null) {
			if ($this->isNew()) {
				$this->collOpOrganizationCharges = array();
			} else {

				$criteria->add(OpOrganizationChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelectJoinOpOrganization($criteria, $con);
			}
		} else {
									
			$criteria->add(OpOrganizationChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpOrganizationChargeCriteria) || !$this->lastOpOrganizationChargeCriteria->equals($criteria)) {
				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelectJoinOpOrganization($criteria, $con);
			}
		}
		$this->lastOpOrganizationChargeCriteria = $criteria;

		return $this->collOpOrganizationCharges;
	}

	
	public function initOpPoliticalCharges()
	{
		if ($this->collOpPoliticalCharges === null) {
			$this->collOpPoliticalCharges = array();
		}
	}

	
	public function getOpPoliticalCharges($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
			   $this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->getContentId());

				OpPoliticalChargePeer::addSelectColumns($criteria);
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->getContentId());

				OpPoliticalChargePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
					$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;
		return $this->collOpPoliticalCharges;
	}

	
	public function countOpPoliticalCharges($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->getContentId());

		return OpPoliticalChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPoliticalCharge(OpPoliticalCharge $l)
	{
		$this->collOpPoliticalCharges[] = $l;
		$l->setOpOpenContent($this);
	}


	
	public function getOpPoliticalChargesJoinOpChargeType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
				$this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}


	
	public function getOpPoliticalChargesJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
				$this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}


	
	public function getOpPoliticalChargesJoinOpLocation($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
				$this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}


	
	public function getOpPoliticalChargesJoinOpParty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
				$this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->getContentId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}

	
	public function initOpResourcess()
	{
		if ($this->collOpResourcess === null) {
			$this->collOpResourcess = array();
		}
	}

	
	public function getOpResourcess($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpResourcesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpResourcess === null) {
			if ($this->isNew()) {
			   $this->collOpResourcess = array();
			} else {

				$criteria->add(OpResourcesPeer::CONTENT_ID, $this->getContentId());

				OpResourcesPeer::addSelectColumns($criteria);
				$this->collOpResourcess = OpResourcesPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpResourcesPeer::CONTENT_ID, $this->getContentId());

				OpResourcesPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpResourcesCriteria) || !$this->lastOpResourcesCriteria->equals($criteria)) {
					$this->collOpResourcess = OpResourcesPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpResourcesCriteria = $criteria;
		return $this->collOpResourcess;
	}

	
	public function countOpResourcess($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpResourcesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpResourcesPeer::CONTENT_ID, $this->getContentId());

		return OpResourcesPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpResources(OpResources $l)
	{
		$this->collOpResourcess[] = $l;
		$l->setOpOpenContent($this);
	}


	
	public function getOpResourcessJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpResourcesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpResourcess === null) {
			if ($this->isNew()) {
				$this->collOpResourcess = array();
			} else {

				$criteria->add(OpResourcesPeer::CONTENT_ID, $this->getContentId());

				$this->collOpResourcess = OpResourcesPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpResourcesPeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpResourcesCriteria) || !$this->lastOpResourcesCriteria->equals($criteria)) {
				$this->collOpResourcess = OpResourcesPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpResourcesCriteria = $criteria;

		return $this->collOpResourcess;
	}


	
	public function getOpResourcessJoinOpResourcesType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpResourcesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpResourcess === null) {
			if ($this->isNew()) {
				$this->collOpResourcess = array();
			} else {

				$criteria->add(OpResourcesPeer::CONTENT_ID, $this->getContentId());

				$this->collOpResourcess = OpResourcesPeer::doSelectJoinOpResourcesType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpResourcesPeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpResourcesCriteria) || !$this->lastOpResourcesCriteria->equals($criteria)) {
				$this->collOpResourcess = OpResourcesPeer::doSelectJoinOpResourcesType($criteria, $con);
			}
		}
		$this->lastOpResourcesCriteria = $criteria;

		return $this->collOpResourcess;
	}

} 