<?php


abstract class BaseOpObscuredContent extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $user_id;


	
	protected $content_id;


	
	protected $created_at;


	
	protected $reason;

	
	protected $aOpUser;

	
	protected $aOpOpenContent;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getContentId()
	{

		return $this->content_id;
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

	
	public function getReason()
	{

		return $this->reason;
	}

	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = OpObscuredContentPeer::USER_ID;
		}

		if ($this->aOpUser !== null && $this->aOpUser->getId() !== $v) {
			$this->aOpUser = null;
		}

	} 
	
	public function setContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->content_id !== $v) {
			$this->content_id = $v;
			$this->modifiedColumns[] = OpObscuredContentPeer::CONTENT_ID;
		}

		if ($this->aOpOpenContent !== null && $this->aOpOpenContent->getContentId() !== $v) {
			$this->aOpOpenContent = null;
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
			$this->modifiedColumns[] = OpObscuredContentPeer::CREATED_AT;
		}

	} 
	
	public function setReason($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->reason !== $v) {
			$this->reason = $v;
			$this->modifiedColumns[] = OpObscuredContentPeer::REASON;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->user_id = $rs->getInt($startcol + 0);

			$this->content_id = $rs->getInt($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->reason = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpObscuredContent object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpObscuredContentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpObscuredContentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpObscuredContentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpObscuredContentPeer::DATABASE_NAME);
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

			if ($this->aOpOpenContent !== null) {
				if ($this->aOpOpenContent->isModified()) {
					$affectedRows += $this->aOpOpenContent->save($con);
				}
				$this->setOpOpenContent($this->aOpOpenContent);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpObscuredContentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpObscuredContentPeer::doUpdate($this, $con);
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

			if ($this->aOpOpenContent !== null) {
				if (!$this->aOpOpenContent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpOpenContent->getValidationFailures());
				}
			}


			if (($retval = OpObscuredContentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpObscuredContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUserId();
				break;
			case 1:
				return $this->getContentId();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getReason();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpObscuredContentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUserId(),
			$keys[1] => $this->getContentId(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getReason(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpObscuredContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUserId($value);
				break;
			case 1:
				$this->setContentId($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setReason($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpObscuredContentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setContentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setReason($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpObscuredContentPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpObscuredContentPeer::USER_ID)) $criteria->add(OpObscuredContentPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(OpObscuredContentPeer::CONTENT_ID)) $criteria->add(OpObscuredContentPeer::CONTENT_ID, $this->content_id);
		if ($this->isColumnModified(OpObscuredContentPeer::CREATED_AT)) $criteria->add(OpObscuredContentPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpObscuredContentPeer::REASON)) $criteria->add(OpObscuredContentPeer::REASON, $this->reason);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpObscuredContentPeer::DATABASE_NAME);

		$criteria->add(OpObscuredContentPeer::USER_ID, $this->user_id);
		$criteria->add(OpObscuredContentPeer::CONTENT_ID, $this->content_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getUserId();

		$pks[1] = $this->getContentId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setUserId($keys[0]);

		$this->setContentId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setReason($this->reason);


		$copyObj->setNew(true);

		$copyObj->setUserId(NULL); 
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
			self::$peer = new OpObscuredContentPeer();
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

	
	public function setOpOpenContent($v)
	{


		if ($v === null) {
			$this->setContentId(NULL);
		} else {
			$this->setContentId($v->getContentId());
		}


		$this->aOpOpenContent = $v;
	}


	
	public function getOpOpenContent($con = null)
	{
		if ($this->aOpOpenContent === null && ($this->content_id !== null)) {
						include_once 'lib/model/om/BaseOpOpenContentPeer.php';

			$this->aOpOpenContent = OpOpenContentPeer::retrieveByPK($this->content_id, $con);

			
		}
		return $this->aOpOpenContent;
	}

} 