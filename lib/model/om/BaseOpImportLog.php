<?php


abstract class BaseOpImportLog extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $import_id;


	
	protected $counter;


	
	protected $type;


	
	protected $created_at;


	
	protected $importing_data;


	
	protected $status;


	
	protected $message;


	
	protected $id;

	
	protected $aOpImport;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getImportId()
	{

		return $this->import_id;
	}

	
	public function getCounter()
	{

		return $this->counter;
	}

	
	public function getType()
	{

		return $this->type;
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

	
	public function getImportingData()
	{

		return $this->importing_data;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getMessage()
	{

		return $this->message;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setImportId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->import_id !== $v) {
			$this->import_id = $v;
			$this->modifiedColumns[] = OpImportLogPeer::IMPORT_ID;
		}

		if ($this->aOpImport !== null && $this->aOpImport->getId() !== $v) {
			$this->aOpImport = null;
		}

	} 
	
	public function setCounter($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->counter !== $v) {
			$this->counter = $v;
			$this->modifiedColumns[] = OpImportLogPeer::COUNTER;
		}

	} 
	
	public function setType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = OpImportLogPeer::TYPE;
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
			$this->modifiedColumns[] = OpImportLogPeer::CREATED_AT;
		}

	} 
	
	public function setImportingData($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->importing_data !== $v) {
			$this->importing_data = $v;
			$this->modifiedColumns[] = OpImportLogPeer::IMPORTING_DATA;
		}

	} 
	
	public function setStatus($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = OpImportLogPeer::STATUS;
		}

	} 
	
	public function setMessage($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->message !== $v) {
			$this->message = $v;
			$this->modifiedColumns[] = OpImportLogPeer::MESSAGE;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpImportLogPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->import_id = $rs->getInt($startcol + 0);

			$this->counter = $rs->getInt($startcol + 1);

			$this->type = $rs->getString($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->importing_data = $rs->getString($startcol + 4);

			$this->status = $rs->getString($startcol + 5);

			$this->message = $rs->getString($startcol + 6);

			$this->id = $rs->getInt($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpImportLog object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpImportLogPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpImportLogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpImportLogPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpImportLogPeer::DATABASE_NAME);
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


												
			if ($this->aOpImport !== null) {
				if ($this->aOpImport->isModified()) {
					$affectedRows += $this->aOpImport->save($con);
				}
				$this->setOpImport($this->aOpImport);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpImportLogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpImportLogPeer::doUpdate($this, $con);
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


												
			if ($this->aOpImport !== null) {
				if (!$this->aOpImport->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpImport->getValidationFailures());
				}
			}


			if (($retval = OpImportLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpImportLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getImportId();
				break;
			case 1:
				return $this->getCounter();
				break;
			case 2:
				return $this->getType();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
				return $this->getImportingData();
				break;
			case 5:
				return $this->getStatus();
				break;
			case 6:
				return $this->getMessage();
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
		$keys = OpImportLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getImportId(),
			$keys[1] => $this->getCounter(),
			$keys[2] => $this->getType(),
			$keys[3] => $this->getCreatedAt(),
			$keys[4] => $this->getImportingData(),
			$keys[5] => $this->getStatus(),
			$keys[6] => $this->getMessage(),
			$keys[7] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpImportLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setImportId($value);
				break;
			case 1:
				$this->setCounter($value);
				break;
			case 2:
				$this->setType($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setImportingData($value);
				break;
			case 5:
				$this->setStatus($value);
				break;
			case 6:
				$this->setMessage($value);
				break;
			case 7:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpImportLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setImportId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCounter($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setImportingData($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setStatus($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setMessage($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setId($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpImportLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpImportLogPeer::IMPORT_ID)) $criteria->add(OpImportLogPeer::IMPORT_ID, $this->import_id);
		if ($this->isColumnModified(OpImportLogPeer::COUNTER)) $criteria->add(OpImportLogPeer::COUNTER, $this->counter);
		if ($this->isColumnModified(OpImportLogPeer::TYPE)) $criteria->add(OpImportLogPeer::TYPE, $this->type);
		if ($this->isColumnModified(OpImportLogPeer::CREATED_AT)) $criteria->add(OpImportLogPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpImportLogPeer::IMPORTING_DATA)) $criteria->add(OpImportLogPeer::IMPORTING_DATA, $this->importing_data);
		if ($this->isColumnModified(OpImportLogPeer::STATUS)) $criteria->add(OpImportLogPeer::STATUS, $this->status);
		if ($this->isColumnModified(OpImportLogPeer::MESSAGE)) $criteria->add(OpImportLogPeer::MESSAGE, $this->message);
		if ($this->isColumnModified(OpImportLogPeer::ID)) $criteria->add(OpImportLogPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpImportLogPeer::DATABASE_NAME);

		$criteria->add(OpImportLogPeer::ID, $this->id);

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

		$copyObj->setImportId($this->import_id);

		$copyObj->setCounter($this->counter);

		$copyObj->setType($this->type);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setImportingData($this->importing_data);

		$copyObj->setStatus($this->status);

		$copyObj->setMessage($this->message);


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
			self::$peer = new OpImportLogPeer();
		}
		return self::$peer;
	}

	
	public function setOpImport($v)
	{


		if ($v === null) {
			$this->setImportId(NULL);
		} else {
			$this->setImportId($v->getId());
		}


		$this->aOpImport = $v;
	}


	
	public function getOpImport($con = null)
	{
		if ($this->aOpImport === null && ($this->import_id !== null)) {
						include_once 'lib/model/om/BaseOpImportPeer.php';

			$this->aOpImport = OpImportPeer::retrieveByPK($this->import_id, $con);

			
		}
		return $this->aOpImport;
	}

} 