<?php


abstract class BaseOpMinintAka extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $politician_id;


	
	protected $minint_aka;


	
	protected $created_at;


	
	protected $verified_at;


	
	protected $id;

	
	protected $aOpPolitician;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getPoliticianId()
	{

		return $this->politician_id;
	}

	
	public function getMinintAka()
	{

		return $this->minint_aka;
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

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setPoliticianId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->politician_id !== $v) {
			$this->politician_id = $v;
			$this->modifiedColumns[] = OpMinintAkaPeer::POLITICIAN_ID;
		}

		if ($this->aOpPolitician !== null && $this->aOpPolitician->getContentId() !== $v) {
			$this->aOpPolitician = null;
		}

	} 
	
	public function setMinintAka($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->minint_aka !== $v) {
			$this->minint_aka = $v;
			$this->modifiedColumns[] = OpMinintAkaPeer::MININT_AKA;
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
			$this->modifiedColumns[] = OpMinintAkaPeer::CREATED_AT;
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
			$this->modifiedColumns[] = OpMinintAkaPeer::VERIFIED_AT;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpMinintAkaPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->politician_id = $rs->getInt($startcol + 0);

			$this->minint_aka = $rs->getString($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->verified_at = $rs->getTimestamp($startcol + 3, null);

			$this->id = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpMinintAka object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpMinintAkaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpMinintAkaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpMinintAkaPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpMinintAkaPeer::DATABASE_NAME);
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


												
			if ($this->aOpPolitician !== null) {
				if ($this->aOpPolitician->isModified()) {
					$affectedRows += $this->aOpPolitician->save($con);
				}
				$this->setOpPolitician($this->aOpPolitician);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpMinintAkaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpMinintAkaPeer::doUpdate($this, $con);
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


												
			if ($this->aOpPolitician !== null) {
				if (!$this->aOpPolitician->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpPolitician->getValidationFailures());
				}
			}


			if (($retval = OpMinintAkaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpMinintAkaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getPoliticianId();
				break;
			case 1:
				return $this->getMinintAka();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getVerifiedAt();
				break;
			case 4:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpMinintAkaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getPoliticianId(),
			$keys[1] => $this->getMinintAka(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getVerifiedAt(),
			$keys[4] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpMinintAkaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setPoliticianId($value);
				break;
			case 1:
				$this->setMinintAka($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setVerifiedAt($value);
				break;
			case 4:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpMinintAkaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPoliticianId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMinintAka($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setVerifiedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setId($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpMinintAkaPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpMinintAkaPeer::POLITICIAN_ID)) $criteria->add(OpMinintAkaPeer::POLITICIAN_ID, $this->politician_id);
		if ($this->isColumnModified(OpMinintAkaPeer::MININT_AKA)) $criteria->add(OpMinintAkaPeer::MININT_AKA, $this->minint_aka);
		if ($this->isColumnModified(OpMinintAkaPeer::CREATED_AT)) $criteria->add(OpMinintAkaPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpMinintAkaPeer::VERIFIED_AT)) $criteria->add(OpMinintAkaPeer::VERIFIED_AT, $this->verified_at);
		if ($this->isColumnModified(OpMinintAkaPeer::ID)) $criteria->add(OpMinintAkaPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpMinintAkaPeer::DATABASE_NAME);

		$criteria->add(OpMinintAkaPeer::ID, $this->id);

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

		$copyObj->setPoliticianId($this->politician_id);

		$copyObj->setMinintAka($this->minint_aka);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setVerifiedAt($this->verified_at);


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
			self::$peer = new OpMinintAkaPeer();
		}
		return self::$peer;
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