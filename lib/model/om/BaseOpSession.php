<?php


abstract class BaseOpSession extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $sess_id;


	
	protected $sess_data;


	
	protected $sess_time = 0;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getSessId()
	{

		return $this->sess_id;
	}

	
	public function getSessData()
	{

		return $this->sess_data;
	}

	
	public function getSessTime()
	{

		return $this->sess_time;
	}

	
	public function setSessId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sess_id !== $v) {
			$this->sess_id = $v;
			$this->modifiedColumns[] = OpSessionPeer::SESS_ID;
		}

	} 
	
	public function setSessData($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sess_data !== $v) {
			$this->sess_data = $v;
			$this->modifiedColumns[] = OpSessionPeer::SESS_DATA;
		}

	} 
	
	public function setSessTime($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sess_time !== $v || $v === 0) {
			$this->sess_time = $v;
			$this->modifiedColumns[] = OpSessionPeer::SESS_TIME;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->sess_id = $rs->getString($startcol + 0);

			$this->sess_data = $rs->getString($startcol + 1);

			$this->sess_time = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpSession object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpSessionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpSessionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpSessionPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpSessionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpSessionPeer::doUpdate($this, $con);
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


			if (($retval = OpSessionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpSessionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getSessId();
				break;
			case 1:
				return $this->getSessData();
				break;
			case 2:
				return $this->getSessTime();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpSessionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getSessId(),
			$keys[1] => $this->getSessData(),
			$keys[2] => $this->getSessTime(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpSessionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setSessId($value);
				break;
			case 1:
				$this->setSessData($value);
				break;
			case 2:
				$this->setSessTime($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpSessionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setSessId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSessData($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSessTime($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpSessionPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpSessionPeer::SESS_ID)) $criteria->add(OpSessionPeer::SESS_ID, $this->sess_id);
		if ($this->isColumnModified(OpSessionPeer::SESS_DATA)) $criteria->add(OpSessionPeer::SESS_DATA, $this->sess_data);
		if ($this->isColumnModified(OpSessionPeer::SESS_TIME)) $criteria->add(OpSessionPeer::SESS_TIME, $this->sess_time);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpSessionPeer::DATABASE_NAME);

		$criteria->add(OpSessionPeer::SESS_ID, $this->sess_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getSessId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setSessId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSessData($this->sess_data);

		$copyObj->setSessTime($this->sess_time);


		$copyObj->setNew(true);

		$copyObj->setSessId(NULL); 
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
			self::$peer = new OpSessionPeer();
		}
		return self::$peer;
	}

} 