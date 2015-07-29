<?php


abstract class BaseOpImportModifications extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $rec_type;


	
	protected $context;


	
	protected $csv_rec;


	
	protected $action_type;


	
	protected $blocked_at;


	
	protected $concretised_at;


	
	protected $import_id;


	
	protected $location_id;


	
	protected $id;

	
	protected $aOpImportMinint;

	
	protected $aOpLocation;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getRecType()
	{

		return $this->rec_type;
	}

	
	public function getContext()
	{

		return $this->context;
	}

	
	public function getCsvRec()
	{

		return $this->csv_rec;
	}

	
	public function getActionType()
	{

		return $this->action_type;
	}

	
	public function getBlockedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->blocked_at === null || $this->blocked_at === '') {
			return null;
		} elseif (!is_int($this->blocked_at)) {
						$ts = strtotime($this->blocked_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [blocked_at] as date/time value: " . var_export($this->blocked_at, true));
			}
		} else {
			$ts = $this->blocked_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getConcretisedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->concretised_at === null || $this->concretised_at === '') {
			return null;
		} elseif (!is_int($this->concretised_at)) {
						$ts = strtotime($this->concretised_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [concretised_at] as date/time value: " . var_export($this->concretised_at, true));
			}
		} else {
			$ts = $this->concretised_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getImportId()
	{

		return $this->import_id;
	}

	
	public function getLocationId()
	{

		return $this->location_id;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setRecType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->rec_type !== $v) {
			$this->rec_type = $v;
			$this->modifiedColumns[] = OpImportModificationsPeer::REC_TYPE;
		}

	} 
	
	public function setContext($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->context !== $v) {
			$this->context = $v;
			$this->modifiedColumns[] = OpImportModificationsPeer::CONTEXT;
		}

	} 
	
	public function setCsvRec($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->csv_rec !== $v) {
			$this->csv_rec = $v;
			$this->modifiedColumns[] = OpImportModificationsPeer::CSV_REC;
		}

	} 
	
	public function setActionType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->action_type !== $v) {
			$this->action_type = $v;
			$this->modifiedColumns[] = OpImportModificationsPeer::ACTION_TYPE;
		}

	} 
	
	public function setBlockedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [blocked_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->blocked_at !== $ts) {
			$this->blocked_at = $ts;
			$this->modifiedColumns[] = OpImportModificationsPeer::BLOCKED_AT;
		}

	} 
	
	public function setConcretisedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [concretised_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->concretised_at !== $ts) {
			$this->concretised_at = $ts;
			$this->modifiedColumns[] = OpImportModificationsPeer::CONCRETISED_AT;
		}

	} 
	
	public function setImportId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->import_id !== $v) {
			$this->import_id = $v;
			$this->modifiedColumns[] = OpImportModificationsPeer::IMPORT_ID;
		}

		if ($this->aOpImportMinint !== null && $this->aOpImportMinint->getId() !== $v) {
			$this->aOpImportMinint = null;
		}

	} 
	
	public function setLocationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_id !== $v) {
			$this->location_id = $v;
			$this->modifiedColumns[] = OpImportModificationsPeer::LOCATION_ID;
		}

		if ($this->aOpLocation !== null && $this->aOpLocation->getId() !== $v) {
			$this->aOpLocation = null;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpImportModificationsPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->rec_type = $rs->getString($startcol + 0);

			$this->context = $rs->getString($startcol + 1);

			$this->csv_rec = $rs->getString($startcol + 2);

			$this->action_type = $rs->getString($startcol + 3);

			$this->blocked_at = $rs->getTimestamp($startcol + 4, null);

			$this->concretised_at = $rs->getTimestamp($startcol + 5, null);

			$this->import_id = $rs->getInt($startcol + 6);

			$this->location_id = $rs->getInt($startcol + 7);

			$this->id = $rs->getInt($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpImportModifications object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpImportModificationsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpImportModificationsPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpImportModificationsPeer::DATABASE_NAME);
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


												
			if ($this->aOpImportMinint !== null) {
				if ($this->aOpImportMinint->isModified()) {
					$affectedRows += $this->aOpImportMinint->save($con);
				}
				$this->setOpImportMinint($this->aOpImportMinint);
			}

			if ($this->aOpLocation !== null) {
				if ($this->aOpLocation->isModified()) {
					$affectedRows += $this->aOpLocation->save($con);
				}
				$this->setOpLocation($this->aOpLocation);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpImportModificationsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpImportModificationsPeer::doUpdate($this, $con);
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


												
			if ($this->aOpImportMinint !== null) {
				if (!$this->aOpImportMinint->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpImportMinint->getValidationFailures());
				}
			}

			if ($this->aOpLocation !== null) {
				if (!$this->aOpLocation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpLocation->getValidationFailures());
				}
			}


			if (($retval = OpImportModificationsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpImportModificationsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getRecType();
				break;
			case 1:
				return $this->getContext();
				break;
			case 2:
				return $this->getCsvRec();
				break;
			case 3:
				return $this->getActionType();
				break;
			case 4:
				return $this->getBlockedAt();
				break;
			case 5:
				return $this->getConcretisedAt();
				break;
			case 6:
				return $this->getImportId();
				break;
			case 7:
				return $this->getLocationId();
				break;
			case 8:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpImportModificationsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getRecType(),
			$keys[1] => $this->getContext(),
			$keys[2] => $this->getCsvRec(),
			$keys[3] => $this->getActionType(),
			$keys[4] => $this->getBlockedAt(),
			$keys[5] => $this->getConcretisedAt(),
			$keys[6] => $this->getImportId(),
			$keys[7] => $this->getLocationId(),
			$keys[8] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpImportModificationsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setRecType($value);
				break;
			case 1:
				$this->setContext($value);
				break;
			case 2:
				$this->setCsvRec($value);
				break;
			case 3:
				$this->setActionType($value);
				break;
			case 4:
				$this->setBlockedAt($value);
				break;
			case 5:
				$this->setConcretisedAt($value);
				break;
			case 6:
				$this->setImportId($value);
				break;
			case 7:
				$this->setLocationId($value);
				break;
			case 8:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpImportModificationsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setRecType($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setContext($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCsvRec($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setActionType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setBlockedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setConcretisedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setImportId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLocationId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setId($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpImportModificationsPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpImportModificationsPeer::REC_TYPE)) $criteria->add(OpImportModificationsPeer::REC_TYPE, $this->rec_type);
		if ($this->isColumnModified(OpImportModificationsPeer::CONTEXT)) $criteria->add(OpImportModificationsPeer::CONTEXT, $this->context);
		if ($this->isColumnModified(OpImportModificationsPeer::CSV_REC)) $criteria->add(OpImportModificationsPeer::CSV_REC, $this->csv_rec);
		if ($this->isColumnModified(OpImportModificationsPeer::ACTION_TYPE)) $criteria->add(OpImportModificationsPeer::ACTION_TYPE, $this->action_type);
		if ($this->isColumnModified(OpImportModificationsPeer::BLOCKED_AT)) $criteria->add(OpImportModificationsPeer::BLOCKED_AT, $this->blocked_at);
		if ($this->isColumnModified(OpImportModificationsPeer::CONCRETISED_AT)) $criteria->add(OpImportModificationsPeer::CONCRETISED_AT, $this->concretised_at);
		if ($this->isColumnModified(OpImportModificationsPeer::IMPORT_ID)) $criteria->add(OpImportModificationsPeer::IMPORT_ID, $this->import_id);
		if ($this->isColumnModified(OpImportModificationsPeer::LOCATION_ID)) $criteria->add(OpImportModificationsPeer::LOCATION_ID, $this->location_id);
		if ($this->isColumnModified(OpImportModificationsPeer::ID)) $criteria->add(OpImportModificationsPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpImportModificationsPeer::DATABASE_NAME);

		$criteria->add(OpImportModificationsPeer::ID, $this->id);

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

		$copyObj->setRecType($this->rec_type);

		$copyObj->setContext($this->context);

		$copyObj->setCsvRec($this->csv_rec);

		$copyObj->setActionType($this->action_type);

		$copyObj->setBlockedAt($this->blocked_at);

		$copyObj->setConcretisedAt($this->concretised_at);

		$copyObj->setImportId($this->import_id);

		$copyObj->setLocationId($this->location_id);


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
			self::$peer = new OpImportModificationsPeer();
		}
		return self::$peer;
	}

	
	public function setOpImportMinint($v)
	{


		if ($v === null) {
			$this->setImportId(NULL);
		} else {
			$this->setImportId($v->getId());
		}


		$this->aOpImportMinint = $v;
	}


	
	public function getOpImportMinint($con = null)
	{
		if ($this->aOpImportMinint === null && ($this->import_id !== null)) {
						include_once 'lib/model/om/BaseOpImportMinintPeer.php';

			$this->aOpImportMinint = OpImportMinintPeer::retrieveByPK($this->import_id, $con);

			
		}
		return $this->aOpImportMinint;
	}

	
	public function setOpLocation($v)
	{


		if ($v === null) {
			$this->setLocationId(NULL);
		} else {
			$this->setLocationId($v->getId());
		}


		$this->aOpLocation = $v;
	}


	
	public function getOpLocation($con = null)
	{
		if ($this->aOpLocation === null && ($this->location_id !== null)) {
						include_once 'lib/model/om/BaseOpLocationPeer.php';

			$this->aOpLocation = OpLocationPeer::retrieveByPK($this->location_id, $con);

			
		}
		return $this->aOpLocation;
	}

} 