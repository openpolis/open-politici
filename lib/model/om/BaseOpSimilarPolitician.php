<?php


abstract class BaseOpSimilarPolitician extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $original_id;


	
	protected $similar_id;


	
	protected $is_resolved = 0;


	
	protected $compares_birth_locations = 0;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $user_id;


	
	protected $id;

	
	protected $aOpPoliticianRelatedByOriginalId;

	
	protected $aOpPoliticianRelatedBySimilarId;

	
	protected $aOpUser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getOriginalId()
	{

		return $this->original_id;
	}

	
	public function getSimilarId()
	{

		return $this->similar_id;
	}

	
	public function getIsResolved()
	{

		return $this->is_resolved;
	}

	
	public function getComparesBirthLocations()
	{

		return $this->compares_birth_locations;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setOriginalId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->original_id !== $v) {
			$this->original_id = $v;
			$this->modifiedColumns[] = OpSimilarPoliticianPeer::ORIGINAL_ID;
		}

		if ($this->aOpPoliticianRelatedByOriginalId !== null && $this->aOpPoliticianRelatedByOriginalId->getContentId() !== $v) {
			$this->aOpPoliticianRelatedByOriginalId = null;
		}

	} 
	
	public function setSimilarId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->similar_id !== $v) {
			$this->similar_id = $v;
			$this->modifiedColumns[] = OpSimilarPoliticianPeer::SIMILAR_ID;
		}

		if ($this->aOpPoliticianRelatedBySimilarId !== null && $this->aOpPoliticianRelatedBySimilarId->getContentId() !== $v) {
			$this->aOpPoliticianRelatedBySimilarId = null;
		}

	} 
	
	public function setIsResolved($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_resolved !== $v || $v === 0) {
			$this->is_resolved = $v;
			$this->modifiedColumns[] = OpSimilarPoliticianPeer::IS_RESOLVED;
		}

	} 
	
	public function setComparesBirthLocations($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->compares_birth_locations !== $v || $v === 0) {
			$this->compares_birth_locations = $v;
			$this->modifiedColumns[] = OpSimilarPoliticianPeer::COMPARES_BIRTH_LOCATIONS;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = OpSimilarPoliticianPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = OpSimilarPoliticianPeer::UPDATED_AT;
		}

	} 
	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = OpSimilarPoliticianPeer::USER_ID;
		}

		if ($this->aOpUser !== null && $this->aOpUser->getId() !== $v) {
			$this->aOpUser = null;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpSimilarPoliticianPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->original_id = $rs->getInt($startcol + 0);

			$this->similar_id = $rs->getInt($startcol + 1);

			$this->is_resolved = $rs->getInt($startcol + 2);

			$this->compares_birth_locations = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->user_id = $rs->getInt($startcol + 6);

			$this->id = $rs->getInt($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpSimilarPolitician object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpSimilarPoliticianPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpSimilarPoliticianPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpSimilarPoliticianPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(OpSimilarPoliticianPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpSimilarPoliticianPeer::DATABASE_NAME);
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


												
			if ($this->aOpPoliticianRelatedByOriginalId !== null) {
				if ($this->aOpPoliticianRelatedByOriginalId->isModified()) {
					$affectedRows += $this->aOpPoliticianRelatedByOriginalId->save($con);
				}
				$this->setOpPoliticianRelatedByOriginalId($this->aOpPoliticianRelatedByOriginalId);
			}

			if ($this->aOpPoliticianRelatedBySimilarId !== null) {
				if ($this->aOpPoliticianRelatedBySimilarId->isModified()) {
					$affectedRows += $this->aOpPoliticianRelatedBySimilarId->save($con);
				}
				$this->setOpPoliticianRelatedBySimilarId($this->aOpPoliticianRelatedBySimilarId);
			}

			if ($this->aOpUser !== null) {
				if ($this->aOpUser->isModified()) {
					$affectedRows += $this->aOpUser->save($con);
				}
				$this->setOpUser($this->aOpUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpSimilarPoliticianPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpSimilarPoliticianPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aOpPoliticianRelatedByOriginalId !== null) {
				if (!$this->aOpPoliticianRelatedByOriginalId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpPoliticianRelatedByOriginalId->getValidationFailures());
				}
			}

			if ($this->aOpPoliticianRelatedBySimilarId !== null) {
				if (!$this->aOpPoliticianRelatedBySimilarId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpPoliticianRelatedBySimilarId->getValidationFailures());
				}
			}

			if ($this->aOpUser !== null) {
				if (!$this->aOpUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUser->getValidationFailures());
				}
			}


			if (($retval = OpSimilarPoliticianPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpSimilarPoliticianPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getOriginalId();
				break;
			case 1:
				return $this->getSimilarId();
				break;
			case 2:
				return $this->getIsResolved();
				break;
			case 3:
				return $this->getComparesBirthLocations();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			case 6:
				return $this->getUserId();
				break;
			case 7:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpSimilarPoliticianPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOriginalId(),
			$keys[1] => $this->getSimilarId(),
			$keys[2] => $this->getIsResolved(),
			$keys[3] => $this->getComparesBirthLocations(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
			$keys[6] => $this->getUserId(),
			$keys[7] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpSimilarPoliticianPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setOriginalId($value);
				break;
			case 1:
				$this->setSimilarId($value);
				break;
			case 2:
				$this->setIsResolved($value);
				break;
			case 3:
				$this->setComparesBirthLocations($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
			case 6:
				$this->setUserId($value);
				break;
			case 7:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpSimilarPoliticianPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOriginalId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSimilarId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsResolved($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setComparesBirthLocations($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUserId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setId($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpSimilarPoliticianPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpSimilarPoliticianPeer::ORIGINAL_ID)) $criteria->add(OpSimilarPoliticianPeer::ORIGINAL_ID, $this->original_id);
		if ($this->isColumnModified(OpSimilarPoliticianPeer::SIMILAR_ID)) $criteria->add(OpSimilarPoliticianPeer::SIMILAR_ID, $this->similar_id);
		if ($this->isColumnModified(OpSimilarPoliticianPeer::IS_RESOLVED)) $criteria->add(OpSimilarPoliticianPeer::IS_RESOLVED, $this->is_resolved);
		if ($this->isColumnModified(OpSimilarPoliticianPeer::COMPARES_BIRTH_LOCATIONS)) $criteria->add(OpSimilarPoliticianPeer::COMPARES_BIRTH_LOCATIONS, $this->compares_birth_locations);
		if ($this->isColumnModified(OpSimilarPoliticianPeer::CREATED_AT)) $criteria->add(OpSimilarPoliticianPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpSimilarPoliticianPeer::UPDATED_AT)) $criteria->add(OpSimilarPoliticianPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(OpSimilarPoliticianPeer::USER_ID)) $criteria->add(OpSimilarPoliticianPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(OpSimilarPoliticianPeer::ID)) $criteria->add(OpSimilarPoliticianPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpSimilarPoliticianPeer::DATABASE_NAME);

		$criteria->add(OpSimilarPoliticianPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOriginalId($this->original_id);

		$copyObj->setSimilarId($this->similar_id);

		$copyObj->setIsResolved($this->is_resolved);

		$copyObj->setComparesBirthLocations($this->compares_birth_locations);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setUserId($this->user_id);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
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
			self::$peer = new OpSimilarPoliticianPeer();
		}
		return self::$peer;
	}

	
	public function setOpPoliticianRelatedByOriginalId($v)
	{


		if ($v === null) {
			$this->setOriginalId(NULL);
		} else {
			$this->setOriginalId($v->getContentId());
		}


		$this->aOpPoliticianRelatedByOriginalId = $v;
	}


	
	public function getOpPoliticianRelatedByOriginalId($con = null)
	{
		if ($this->aOpPoliticianRelatedByOriginalId === null && ($this->original_id !== null)) {
						include_once 'lib/model/om/BaseOpPoliticianPeer.php';

			$this->aOpPoliticianRelatedByOriginalId = OpPoliticianPeer::retrieveByPK($this->original_id, $con);

			
		}
		return $this->aOpPoliticianRelatedByOriginalId;
	}

	
	public function setOpPoliticianRelatedBySimilarId($v)
	{


		if ($v === null) {
			$this->setSimilarId(NULL);
		} else {
			$this->setSimilarId($v->getContentId());
		}


		$this->aOpPoliticianRelatedBySimilarId = $v;
	}


	
	public function getOpPoliticianRelatedBySimilarId($con = null)
	{
		if ($this->aOpPoliticianRelatedBySimilarId === null && ($this->similar_id !== null)) {
						include_once 'lib/model/om/BaseOpPoliticianPeer.php';

			$this->aOpPoliticianRelatedBySimilarId = OpPoliticianPeer::retrieveByPK($this->similar_id, $con);

			
		}
		return $this->aOpPoliticianRelatedBySimilarId;
	}

	
	public function setOpUser($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->aOpUser = $v;
	}


	
	public function getOpUser($con = null)
	{
		if ($this->aOpUser === null && ($this->user_id !== null)) {
						include_once 'lib/model/om/BaseOpUserPeer.php';

			$this->aOpUser = OpUserPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->aOpUser;
	}

} 