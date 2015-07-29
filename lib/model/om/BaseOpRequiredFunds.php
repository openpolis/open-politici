<?php


abstract class BaseOpRequiredFunds extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $donors;


	
	protected $needed = 0;


	
	protected $raised = 0;


	
	protected $spent;


	
	protected $created_at;


	
	protected $id;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getDonors()
	{

		return $this->donors;
	}

	
	public function getNeeded()
	{

		return $this->needed;
	}

	
	public function getRaised()
	{

		return $this->raised;
	}

	
	public function getSpent()
	{

		return $this->spent;
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

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setDonors($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->donors !== $v) {
			$this->donors = $v;
			$this->modifiedColumns[] = OpRequiredFundsPeer::DONORS;
		}

	} 
	
	public function setNeeded($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->needed !== $v || $v === 0) {
			$this->needed = $v;
			$this->modifiedColumns[] = OpRequiredFundsPeer::NEEDED;
		}

	} 
	
	public function setRaised($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->raised !== $v || $v === 0) {
			$this->raised = $v;
			$this->modifiedColumns[] = OpRequiredFundsPeer::RAISED;
		}

	} 
	
	public function setSpent($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->spent !== $v) {
			$this->spent = $v;
			$this->modifiedColumns[] = OpRequiredFundsPeer::SPENT;
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
			$this->modifiedColumns[] = OpRequiredFundsPeer::CREATED_AT;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpRequiredFundsPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->donors = $rs->getInt($startcol + 0);

			$this->needed = $rs->getInt($startcol + 1);

			$this->raised = $rs->getInt($startcol + 2);

			$this->spent = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->id = $rs->getInt($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpRequiredFunds object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpRequiredFundsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpRequiredFundsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpRequiredFundsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpRequiredFundsPeer::DATABASE_NAME);
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
					$pk = OpRequiredFundsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpRequiredFundsPeer::doUpdate($this, $con);
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


			if (($retval = OpRequiredFundsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpRequiredFundsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getDonors();
				break;
			case 1:
				return $this->getNeeded();
				break;
			case 2:
				return $this->getRaised();
				break;
			case 3:
				return $this->getSpent();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpRequiredFundsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getDonors(),
			$keys[1] => $this->getNeeded(),
			$keys[2] => $this->getRaised(),
			$keys[3] => $this->getSpent(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpRequiredFundsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setDonors($value);
				break;
			case 1:
				$this->setNeeded($value);
				break;
			case 2:
				$this->setRaised($value);
				break;
			case 3:
				$this->setSpent($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpRequiredFundsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setDonors($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNeeded($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRaised($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSpent($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setId($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpRequiredFundsPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpRequiredFundsPeer::DONORS)) $criteria->add(OpRequiredFundsPeer::DONORS, $this->donors);
		if ($this->isColumnModified(OpRequiredFundsPeer::NEEDED)) $criteria->add(OpRequiredFundsPeer::NEEDED, $this->needed);
		if ($this->isColumnModified(OpRequiredFundsPeer::RAISED)) $criteria->add(OpRequiredFundsPeer::RAISED, $this->raised);
		if ($this->isColumnModified(OpRequiredFundsPeer::SPENT)) $criteria->add(OpRequiredFundsPeer::SPENT, $this->spent);
		if ($this->isColumnModified(OpRequiredFundsPeer::CREATED_AT)) $criteria->add(OpRequiredFundsPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpRequiredFundsPeer::ID)) $criteria->add(OpRequiredFundsPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpRequiredFundsPeer::DATABASE_NAME);

		$criteria->add(OpRequiredFundsPeer::ID, $this->id);

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

		$copyObj->setDonors($this->donors);

		$copyObj->setNeeded($this->needed);

		$copyObj->setRaised($this->raised);

		$copyObj->setSpent($this->spent);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new OpRequiredFundsPeer();
		}
		return self::$peer;
	}

} 