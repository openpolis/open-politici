<?php


abstract class BaseOpImport extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $import_type_id;


	
	protected $import_minint_id;


	
	protected $import_file;


	
	protected $import_location;


	
	protected $started_at;


	
	protected $finished_at;


	
	protected $run_type;


	
	protected $total;


	
	protected $errors;


	
	protected $warnings;


	
	protected $inserted;


	
	protected $id;

	
	protected $aOpImportType;

	
	protected $aOpImportMinint;

	
	protected $collOpImportLogs;

	
	protected $lastOpImportLogCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getImportTypeId()
	{

		return $this->import_type_id;
	}

	
	public function getImportMinintId()
	{

		return $this->import_minint_id;
	}

	
	public function getImportFile()
	{

		return $this->import_file;
	}

	
	public function getImportLocation()
	{

		return $this->import_location;
	}

	
	public function getStartedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->started_at === null || $this->started_at === '') {
			return null;
		} elseif (!is_int($this->started_at)) {
						$ts = strtotime($this->started_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [started_at] as date/time value: " . var_export($this->started_at, true));
			}
		} else {
			$ts = $this->started_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getFinishedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->finished_at === null || $this->finished_at === '') {
			return null;
		} elseif (!is_int($this->finished_at)) {
						$ts = strtotime($this->finished_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [finished_at] as date/time value: " . var_export($this->finished_at, true));
			}
		} else {
			$ts = $this->finished_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getRunType()
	{

		return $this->run_type;
	}

	
	public function getTotal()
	{

		return $this->total;
	}

	
	public function getErrors()
	{

		return $this->errors;
	}

	
	public function getWarnings()
	{

		return $this->warnings;
	}

	
	public function getInserted()
	{

		return $this->inserted;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setImportTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->import_type_id !== $v) {
			$this->import_type_id = $v;
			$this->modifiedColumns[] = OpImportPeer::IMPORT_TYPE_ID;
		}

		if ($this->aOpImportType !== null && $this->aOpImportType->getId() !== $v) {
			$this->aOpImportType = null;
		}

	} 
	
	public function setImportMinintId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->import_minint_id !== $v) {
			$this->import_minint_id = $v;
			$this->modifiedColumns[] = OpImportPeer::IMPORT_MININT_ID;
		}

		if ($this->aOpImportMinint !== null && $this->aOpImportMinint->getId() !== $v) {
			$this->aOpImportMinint = null;
		}

	} 
	
	public function setImportFile($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->import_file !== $v) {
			$this->import_file = $v;
			$this->modifiedColumns[] = OpImportPeer::IMPORT_FILE;
		}

	} 
	
	public function setImportLocation($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->import_location !== $v) {
			$this->import_location = $v;
			$this->modifiedColumns[] = OpImportPeer::IMPORT_LOCATION;
		}

	} 
	
	public function setStartedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [started_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->started_at !== $ts) {
			$this->started_at = $ts;
			$this->modifiedColumns[] = OpImportPeer::STARTED_AT;
		}

	} 
	
	public function setFinishedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [finished_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->finished_at !== $ts) {
			$this->finished_at = $ts;
			$this->modifiedColumns[] = OpImportPeer::FINISHED_AT;
		}

	} 
	
	public function setRunType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->run_type !== $v) {
			$this->run_type = $v;
			$this->modifiedColumns[] = OpImportPeer::RUN_TYPE;
		}

	} 
	
	public function setTotal($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total !== $v) {
			$this->total = $v;
			$this->modifiedColumns[] = OpImportPeer::TOTAL;
		}

	} 
	
	public function setErrors($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->errors !== $v) {
			$this->errors = $v;
			$this->modifiedColumns[] = OpImportPeer::ERRORS;
		}

	} 
	
	public function setWarnings($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->warnings !== $v) {
			$this->warnings = $v;
			$this->modifiedColumns[] = OpImportPeer::WARNINGS;
		}

	} 
	
	public function setInserted($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->inserted !== $v) {
			$this->inserted = $v;
			$this->modifiedColumns[] = OpImportPeer::INSERTED;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpImportPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->import_type_id = $rs->getInt($startcol + 0);

			$this->import_minint_id = $rs->getInt($startcol + 1);

			$this->import_file = $rs->getString($startcol + 2);

			$this->import_location = $rs->getString($startcol + 3);

			$this->started_at = $rs->getTimestamp($startcol + 4, null);

			$this->finished_at = $rs->getTimestamp($startcol + 5, null);

			$this->run_type = $rs->getString($startcol + 6);

			$this->total = $rs->getInt($startcol + 7);

			$this->errors = $rs->getInt($startcol + 8);

			$this->warnings = $rs->getInt($startcol + 9);

			$this->inserted = $rs->getInt($startcol + 10);

			$this->id = $rs->getInt($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpImport object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpImportPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpImportPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpImportPeer::DATABASE_NAME);
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


												
			if ($this->aOpImportType !== null) {
				if ($this->aOpImportType->isModified()) {
					$affectedRows += $this->aOpImportType->save($con);
				}
				$this->setOpImportType($this->aOpImportType);
			}

			if ($this->aOpImportMinint !== null) {
				if ($this->aOpImportMinint->isModified()) {
					$affectedRows += $this->aOpImportMinint->save($con);
				}
				$this->setOpImportMinint($this->aOpImportMinint);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpImportPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpImportPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpImportLogs !== null) {
				foreach($this->collOpImportLogs as $referrerFK) {
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


												
			if ($this->aOpImportType !== null) {
				if (!$this->aOpImportType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpImportType->getValidationFailures());
				}
			}

			if ($this->aOpImportMinint !== null) {
				if (!$this->aOpImportMinint->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpImportMinint->getValidationFailures());
				}
			}


			if (($retval = OpImportPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpImportLogs !== null) {
					foreach($this->collOpImportLogs as $referrerFK) {
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
		$pos = OpImportPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getImportTypeId();
				break;
			case 1:
				return $this->getImportMinintId();
				break;
			case 2:
				return $this->getImportFile();
				break;
			case 3:
				return $this->getImportLocation();
				break;
			case 4:
				return $this->getStartedAt();
				break;
			case 5:
				return $this->getFinishedAt();
				break;
			case 6:
				return $this->getRunType();
				break;
			case 7:
				return $this->getTotal();
				break;
			case 8:
				return $this->getErrors();
				break;
			case 9:
				return $this->getWarnings();
				break;
			case 10:
				return $this->getInserted();
				break;
			case 11:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpImportPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getImportTypeId(),
			$keys[1] => $this->getImportMinintId(),
			$keys[2] => $this->getImportFile(),
			$keys[3] => $this->getImportLocation(),
			$keys[4] => $this->getStartedAt(),
			$keys[5] => $this->getFinishedAt(),
			$keys[6] => $this->getRunType(),
			$keys[7] => $this->getTotal(),
			$keys[8] => $this->getErrors(),
			$keys[9] => $this->getWarnings(),
			$keys[10] => $this->getInserted(),
			$keys[11] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpImportPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setImportTypeId($value);
				break;
			case 1:
				$this->setImportMinintId($value);
				break;
			case 2:
				$this->setImportFile($value);
				break;
			case 3:
				$this->setImportLocation($value);
				break;
			case 4:
				$this->setStartedAt($value);
				break;
			case 5:
				$this->setFinishedAt($value);
				break;
			case 6:
				$this->setRunType($value);
				break;
			case 7:
				$this->setTotal($value);
				break;
			case 8:
				$this->setErrors($value);
				break;
			case 9:
				$this->setWarnings($value);
				break;
			case 10:
				$this->setInserted($value);
				break;
			case 11:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpImportPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setImportTypeId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setImportMinintId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setImportFile($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setImportLocation($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStartedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFinishedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setRunType($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTotal($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setErrors($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setWarnings($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setInserted($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setId($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpImportPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpImportPeer::IMPORT_TYPE_ID)) $criteria->add(OpImportPeer::IMPORT_TYPE_ID, $this->import_type_id);
		if ($this->isColumnModified(OpImportPeer::IMPORT_MININT_ID)) $criteria->add(OpImportPeer::IMPORT_MININT_ID, $this->import_minint_id);
		if ($this->isColumnModified(OpImportPeer::IMPORT_FILE)) $criteria->add(OpImportPeer::IMPORT_FILE, $this->import_file);
		if ($this->isColumnModified(OpImportPeer::IMPORT_LOCATION)) $criteria->add(OpImportPeer::IMPORT_LOCATION, $this->import_location);
		if ($this->isColumnModified(OpImportPeer::STARTED_AT)) $criteria->add(OpImportPeer::STARTED_AT, $this->started_at);
		if ($this->isColumnModified(OpImportPeer::FINISHED_AT)) $criteria->add(OpImportPeer::FINISHED_AT, $this->finished_at);
		if ($this->isColumnModified(OpImportPeer::RUN_TYPE)) $criteria->add(OpImportPeer::RUN_TYPE, $this->run_type);
		if ($this->isColumnModified(OpImportPeer::TOTAL)) $criteria->add(OpImportPeer::TOTAL, $this->total);
		if ($this->isColumnModified(OpImportPeer::ERRORS)) $criteria->add(OpImportPeer::ERRORS, $this->errors);
		if ($this->isColumnModified(OpImportPeer::WARNINGS)) $criteria->add(OpImportPeer::WARNINGS, $this->warnings);
		if ($this->isColumnModified(OpImportPeer::INSERTED)) $criteria->add(OpImportPeer::INSERTED, $this->inserted);
		if ($this->isColumnModified(OpImportPeer::ID)) $criteria->add(OpImportPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpImportPeer::DATABASE_NAME);

		$criteria->add(OpImportPeer::ID, $this->id);

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

		$copyObj->setImportTypeId($this->import_type_id);

		$copyObj->setImportMinintId($this->import_minint_id);

		$copyObj->setImportFile($this->import_file);

		$copyObj->setImportLocation($this->import_location);

		$copyObj->setStartedAt($this->started_at);

		$copyObj->setFinishedAt($this->finished_at);

		$copyObj->setRunType($this->run_type);

		$copyObj->setTotal($this->total);

		$copyObj->setErrors($this->errors);

		$copyObj->setWarnings($this->warnings);

		$copyObj->setInserted($this->inserted);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpImportLogs() as $relObj) {
				$copyObj->addOpImportLog($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new OpImportPeer();
		}
		return self::$peer;
	}

	
	public function setOpImportType($v)
	{


		if ($v === null) {
			$this->setImportTypeId(NULL);
		} else {
			$this->setImportTypeId($v->getId());
		}


		$this->aOpImportType = $v;
	}


	
	public function getOpImportType($con = null)
	{
		if ($this->aOpImportType === null && ($this->import_type_id !== null)) {
						include_once 'lib/model/om/BaseOpImportTypePeer.php';

			$this->aOpImportType = OpImportTypePeer::retrieveByPK($this->import_type_id, $con);

			
		}
		return $this->aOpImportType;
	}

	
	public function setOpImportMinint($v)
	{


		if ($v === null) {
			$this->setImportMinintId(NULL);
		} else {
			$this->setImportMinintId($v->getId());
		}


		$this->aOpImportMinint = $v;
	}


	
	public function getOpImportMinint($con = null)
	{
		if ($this->aOpImportMinint === null && ($this->import_minint_id !== null)) {
						include_once 'lib/model/om/BaseOpImportMinintPeer.php';

			$this->aOpImportMinint = OpImportMinintPeer::retrieveByPK($this->import_minint_id, $con);

			
		}
		return $this->aOpImportMinint;
	}

	
	public function initOpImportLogs()
	{
		if ($this->collOpImportLogs === null) {
			$this->collOpImportLogs = array();
		}
	}

	
	public function getOpImportLogs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpImportLogs === null) {
			if ($this->isNew()) {
			   $this->collOpImportLogs = array();
			} else {

				$criteria->add(OpImportLogPeer::IMPORT_ID, $this->getId());

				OpImportLogPeer::addSelectColumns($criteria);
				$this->collOpImportLogs = OpImportLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpImportLogPeer::IMPORT_ID, $this->getId());

				OpImportLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpImportLogCriteria) || !$this->lastOpImportLogCriteria->equals($criteria)) {
					$this->collOpImportLogs = OpImportLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpImportLogCriteria = $criteria;
		return $this->collOpImportLogs;
	}

	
	public function countOpImportLogs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportLogPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpImportLogPeer::IMPORT_ID, $this->getId());

		return OpImportLogPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpImportLog(OpImportLog $l)
	{
		$this->collOpImportLogs[] = $l;
		$l->setOpImport($this);
	}

} 