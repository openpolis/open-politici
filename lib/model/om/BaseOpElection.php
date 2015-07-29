<?php


abstract class BaseOpElection extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $election_date;


	
	protected $election_type_id;


	
	protected $location_id;


	
	protected $id;

	
	protected $aOpElectionType;

	
	protected $aOpLocation;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getElectionDate($format = 'Y-m-d')
	{

		if ($this->election_date === null || $this->election_date === '') {
			return null;
		} elseif (!is_int($this->election_date)) {
						$ts = strtotime($this->election_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [election_date] as date/time value: " . var_export($this->election_date, true));
			}
		} else {
			$ts = $this->election_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getElectionTypeId()
	{

		return $this->election_type_id;
	}

	
	public function getLocationId()
	{

		return $this->location_id;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setElectionDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [election_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->election_date !== $ts) {
			$this->election_date = $ts;
			$this->modifiedColumns[] = OpElectionPeer::ELECTION_DATE;
		}

	} 
	
	public function setElectionTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->election_type_id !== $v) {
			$this->election_type_id = $v;
			$this->modifiedColumns[] = OpElectionPeer::ELECTION_TYPE_ID;
		}

		if ($this->aOpElectionType !== null && $this->aOpElectionType->getId() !== $v) {
			$this->aOpElectionType = null;
		}

	} 
	
	public function setLocationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_id !== $v) {
			$this->location_id = $v;
			$this->modifiedColumns[] = OpElectionPeer::LOCATION_ID;
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
			$this->modifiedColumns[] = OpElectionPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->election_date = $rs->getDate($startcol + 0, null);

			$this->election_type_id = $rs->getInt($startcol + 1);

			$this->location_id = $rs->getInt($startcol + 2);

			$this->id = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpElection object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpElectionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpElectionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpElectionPeer::DATABASE_NAME);
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


												
			if ($this->aOpElectionType !== null) {
				if ($this->aOpElectionType->isModified()) {
					$affectedRows += $this->aOpElectionType->save($con);
				}
				$this->setOpElectionType($this->aOpElectionType);
			}

			if ($this->aOpLocation !== null) {
				if ($this->aOpLocation->isModified()) {
					$affectedRows += $this->aOpLocation->save($con);
				}
				$this->setOpLocation($this->aOpLocation);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpElectionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpElectionPeer::doUpdate($this, $con);
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


												
			if ($this->aOpElectionType !== null) {
				if (!$this->aOpElectionType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpElectionType->getValidationFailures());
				}
			}

			if ($this->aOpLocation !== null) {
				if (!$this->aOpLocation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpLocation->getValidationFailures());
				}
			}


			if (($retval = OpElectionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpElectionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getElectionDate();
				break;
			case 1:
				return $this->getElectionTypeId();
				break;
			case 2:
				return $this->getLocationId();
				break;
			case 3:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpElectionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getElectionDate(),
			$keys[1] => $this->getElectionTypeId(),
			$keys[2] => $this->getLocationId(),
			$keys[3] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpElectionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setElectionDate($value);
				break;
			case 1:
				$this->setElectionTypeId($value);
				break;
			case 2:
				$this->setLocationId($value);
				break;
			case 3:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpElectionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setElectionDate($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setElectionTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLocationId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setId($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpElectionPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpElectionPeer::ELECTION_DATE)) $criteria->add(OpElectionPeer::ELECTION_DATE, $this->election_date);
		if ($this->isColumnModified(OpElectionPeer::ELECTION_TYPE_ID)) $criteria->add(OpElectionPeer::ELECTION_TYPE_ID, $this->election_type_id);
		if ($this->isColumnModified(OpElectionPeer::LOCATION_ID)) $criteria->add(OpElectionPeer::LOCATION_ID, $this->location_id);
		if ($this->isColumnModified(OpElectionPeer::ID)) $criteria->add(OpElectionPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpElectionPeer::DATABASE_NAME);

		$criteria->add(OpElectionPeer::ID, $this->id);

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

		$copyObj->setElectionDate($this->election_date);

		$copyObj->setElectionTypeId($this->election_type_id);

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
			self::$peer = new OpElectionPeer();
		}
		return self::$peer;
	}

	
	public function setOpElectionType($v)
	{


		if ($v === null) {
			$this->setElectionTypeId(NULL);
		} else {
			$this->setElectionTypeId($v->getId());
		}


		$this->aOpElectionType = $v;
	}


	
	public function getOpElectionType($con = null)
	{
		if ($this->aOpElectionType === null && ($this->election_type_id !== null)) {
						include_once 'lib/model/om/BaseOpElectionTypePeer.php';

			$this->aOpElectionType = OpElectionTypePeer::retrieveByPK($this->election_type_id, $con);

			
		}
		return $this->aOpElectionType;
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