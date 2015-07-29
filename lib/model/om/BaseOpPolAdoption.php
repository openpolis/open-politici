<?php


abstract class BaseOpPolAdoption extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $user_id;


	
	protected $politician_id;


	
	protected $requested_at;


	
	protected $granted_at;


	
	protected $revoked_at;


	
	protected $refused_at;

	
	protected $aOpUser;

	
	protected $aOpPolitician;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getPoliticianId()
	{

		return $this->politician_id;
	}

	
	public function getRequestedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->requested_at === null || $this->requested_at === '') {
			return null;
		} elseif (!is_int($this->requested_at)) {
						$ts = strtotime($this->requested_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [requested_at] as date/time value: " . var_export($this->requested_at, true));
			}
		} else {
			$ts = $this->requested_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getGrantedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->granted_at === null || $this->granted_at === '') {
			return null;
		} elseif (!is_int($this->granted_at)) {
						$ts = strtotime($this->granted_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [granted_at] as date/time value: " . var_export($this->granted_at, true));
			}
		} else {
			$ts = $this->granted_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getRevokedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->revoked_at === null || $this->revoked_at === '') {
			return null;
		} elseif (!is_int($this->revoked_at)) {
						$ts = strtotime($this->revoked_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [revoked_at] as date/time value: " . var_export($this->revoked_at, true));
			}
		} else {
			$ts = $this->revoked_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getRefusedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->refused_at === null || $this->refused_at === '') {
			return null;
		} elseif (!is_int($this->refused_at)) {
						$ts = strtotime($this->refused_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [refused_at] as date/time value: " . var_export($this->refused_at, true));
			}
		} else {
			$ts = $this->refused_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = OpPolAdoptionPeer::USER_ID;
		}

		if ($this->aOpUser !== null && $this->aOpUser->getId() !== $v) {
			$this->aOpUser = null;
		}

	} 
	
	public function setPoliticianId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->politician_id !== $v) {
			$this->politician_id = $v;
			$this->modifiedColumns[] = OpPolAdoptionPeer::POLITICIAN_ID;
		}

		if ($this->aOpPolitician !== null && $this->aOpPolitician->getContentId() !== $v) {
			$this->aOpPolitician = null;
		}

	} 
	
	public function setRequestedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [requested_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->requested_at !== $ts) {
			$this->requested_at = $ts;
			$this->modifiedColumns[] = OpPolAdoptionPeer::REQUESTED_AT;
		}

	} 
	
	public function setGrantedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [granted_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->granted_at !== $ts) {
			$this->granted_at = $ts;
			$this->modifiedColumns[] = OpPolAdoptionPeer::GRANTED_AT;
		}

	} 
	
	public function setRevokedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [revoked_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->revoked_at !== $ts) {
			$this->revoked_at = $ts;
			$this->modifiedColumns[] = OpPolAdoptionPeer::REVOKED_AT;
		}

	} 
	
	public function setRefusedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [refused_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->refused_at !== $ts) {
			$this->refused_at = $ts;
			$this->modifiedColumns[] = OpPolAdoptionPeer::REFUSED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->user_id = $rs->getInt($startcol + 0);

			$this->politician_id = $rs->getInt($startcol + 1);

			$this->requested_at = $rs->getTimestamp($startcol + 2, null);

			$this->granted_at = $rs->getTimestamp($startcol + 3, null);

			$this->revoked_at = $rs->getTimestamp($startcol + 4, null);

			$this->refused_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpPolAdoption object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpPolAdoptionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpPolAdoptionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpPolAdoptionPeer::DATABASE_NAME);
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


												
			if ($this->aOpUser !== null) {
				if ($this->aOpUser->isModified()) {
					$affectedRows += $this->aOpUser->save($con);
				}
				$this->setOpUser($this->aOpUser);
			}

			if ($this->aOpPolitician !== null) {
				if ($this->aOpPolitician->isModified()) {
					$affectedRows += $this->aOpPolitician->save($con);
				}
				$this->setOpPolitician($this->aOpPolitician);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpPolAdoptionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpPolAdoptionPeer::doUpdate($this, $con);
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


												
			if ($this->aOpUser !== null) {
				if (!$this->aOpUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUser->getValidationFailures());
				}
			}

			if ($this->aOpPolitician !== null) {
				if (!$this->aOpPolitician->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpPolitician->getValidationFailures());
				}
			}


			if (($retval = OpPolAdoptionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpPolAdoptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUserId();
				break;
			case 1:
				return $this->getPoliticianId();
				break;
			case 2:
				return $this->getRequestedAt();
				break;
			case 3:
				return $this->getGrantedAt();
				break;
			case 4:
				return $this->getRevokedAt();
				break;
			case 5:
				return $this->getRefusedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpPolAdoptionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUserId(),
			$keys[1] => $this->getPoliticianId(),
			$keys[2] => $this->getRequestedAt(),
			$keys[3] => $this->getGrantedAt(),
			$keys[4] => $this->getRevokedAt(),
			$keys[5] => $this->getRefusedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpPolAdoptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUserId($value);
				break;
			case 1:
				$this->setPoliticianId($value);
				break;
			case 2:
				$this->setRequestedAt($value);
				break;
			case 3:
				$this->setGrantedAt($value);
				break;
			case 4:
				$this->setRevokedAt($value);
				break;
			case 5:
				$this->setRefusedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpPolAdoptionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPoliticianId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRequestedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setGrantedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRevokedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRefusedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpPolAdoptionPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpPolAdoptionPeer::USER_ID)) $criteria->add(OpPolAdoptionPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(OpPolAdoptionPeer::POLITICIAN_ID)) $criteria->add(OpPolAdoptionPeer::POLITICIAN_ID, $this->politician_id);
		if ($this->isColumnModified(OpPolAdoptionPeer::REQUESTED_AT)) $criteria->add(OpPolAdoptionPeer::REQUESTED_AT, $this->requested_at);
		if ($this->isColumnModified(OpPolAdoptionPeer::GRANTED_AT)) $criteria->add(OpPolAdoptionPeer::GRANTED_AT, $this->granted_at);
		if ($this->isColumnModified(OpPolAdoptionPeer::REVOKED_AT)) $criteria->add(OpPolAdoptionPeer::REVOKED_AT, $this->revoked_at);
		if ($this->isColumnModified(OpPolAdoptionPeer::REFUSED_AT)) $criteria->add(OpPolAdoptionPeer::REFUSED_AT, $this->refused_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpPolAdoptionPeer::DATABASE_NAME);

		$criteria->add(OpPolAdoptionPeer::USER_ID, $this->user_id);
		$criteria->add(OpPolAdoptionPeer::POLITICIAN_ID, $this->politician_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getUserId();

		$pks[1] = $this->getPoliticianId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setUserId($keys[0]);

		$this->setPoliticianId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setRequestedAt($this->requested_at);

		$copyObj->setGrantedAt($this->granted_at);

		$copyObj->setRevokedAt($this->revoked_at);

		$copyObj->setRefusedAt($this->refused_at);


		$copyObj->setNew(true);

		$copyObj->setUserId(NULL); 
		$copyObj->setPoliticianId(NULL); 
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
			self::$peer = new OpPolAdoptionPeer();
		}
		return self::$peer;
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

	
	public function setOpPolitician($v)
	{


		if ($v === null) {
			$this->setPoliticianId(NULL);
		} else {
			$this->setPoliticianId($v->getContentId());
		}


		$this->aOpPolitician = $v;
	}


	
	public function getOpPolitician($con = null)
	{
		if ($this->aOpPolitician === null && ($this->politician_id !== null)) {
						include_once 'lib/model/om/BaseOpPoliticianPeer.php';

			$this->aOpPolitician = OpPoliticianPeer::retrieveByPK($this->politician_id, $con);

			
		}
		return $this->aOpPolitician;
	}

} 