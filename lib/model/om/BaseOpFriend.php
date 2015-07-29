<?php


abstract class BaseOpFriend extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $user_id;


	
	protected $friend_id;

	
	protected $aOpUserRelatedByUserId;

	
	protected $aOpUserRelatedByFriendId;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getFriendId()
	{

		return $this->friend_id;
	}

	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = OpFriendPeer::USER_ID;
		}

		if ($this->aOpUserRelatedByUserId !== null && $this->aOpUserRelatedByUserId->getId() !== $v) {
			$this->aOpUserRelatedByUserId = null;
		}

	} 
	
	public function setFriendId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->friend_id !== $v) {
			$this->friend_id = $v;
			$this->modifiedColumns[] = OpFriendPeer::FRIEND_ID;
		}

		if ($this->aOpUserRelatedByFriendId !== null && $this->aOpUserRelatedByFriendId->getId() !== $v) {
			$this->aOpUserRelatedByFriendId = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->user_id = $rs->getInt($startcol + 0);

			$this->friend_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpFriend object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpFriendPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpFriendPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpFriendPeer::DATABASE_NAME);
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


												
			if ($this->aOpUserRelatedByUserId !== null) {
				if ($this->aOpUserRelatedByUserId->isModified()) {
					$affectedRows += $this->aOpUserRelatedByUserId->save($con);
				}
				$this->setOpUserRelatedByUserId($this->aOpUserRelatedByUserId);
			}

			if ($this->aOpUserRelatedByFriendId !== null) {
				if ($this->aOpUserRelatedByFriendId->isModified()) {
					$affectedRows += $this->aOpUserRelatedByFriendId->save($con);
				}
				$this->setOpUserRelatedByFriendId($this->aOpUserRelatedByFriendId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpFriendPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpFriendPeer::doUpdate($this, $con);
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


												
			if ($this->aOpUserRelatedByUserId !== null) {
				if (!$this->aOpUserRelatedByUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUserRelatedByUserId->getValidationFailures());
				}
			}

			if ($this->aOpUserRelatedByFriendId !== null) {
				if (!$this->aOpUserRelatedByFriendId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUserRelatedByFriendId->getValidationFailures());
				}
			}


			if (($retval = OpFriendPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpFriendPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUserId();
				break;
			case 1:
				return $this->getFriendId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpFriendPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUserId(),
			$keys[1] => $this->getFriendId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpFriendPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUserId($value);
				break;
			case 1:
				$this->setFriendId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpFriendPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFriendId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpFriendPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpFriendPeer::USER_ID)) $criteria->add(OpFriendPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(OpFriendPeer::FRIEND_ID)) $criteria->add(OpFriendPeer::FRIEND_ID, $this->friend_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpFriendPeer::DATABASE_NAME);

		$criteria->add(OpFriendPeer::USER_ID, $this->user_id);
		$criteria->add(OpFriendPeer::FRIEND_ID, $this->friend_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getUserId();

		$pks[1] = $this->getFriendId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setUserId($keys[0]);

		$this->setFriendId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setUserId(NULL); 
		$copyObj->setFriendId(NULL); 
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
			self::$peer = new OpFriendPeer();
		}
		return self::$peer;
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

	
	public function setOpUserRelatedByFriendId($v)
	{


		if ($v === null) {
			$this->setFriendId(NULL);
		} else {
			$this->setFriendId($v->getId());
		}


		$this->aOpUserRelatedByFriendId = $v;
	}


	
	public function getOpUserRelatedByFriendId($con = null)
	{
		if ($this->aOpUserRelatedByFriendId === null && ($this->friend_id !== null)) {
						include_once 'lib/model/om/BaseOpUserPeer.php';

			$this->aOpUserRelatedByFriendId = OpUserPeer::retrieveByPK($this->friend_id, $con);

			
		}
		return $this->aOpUserRelatedByFriendId;
	}

} 