<?php


abstract class BaseOpConstituencyLocation extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $constituency_id;


	
	protected $location_id;

	
	protected $aOpConstituency;

	
	protected $aOpLocation;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getConstituencyId()
	{

		return $this->constituency_id;
	}

	
	public function getLocationId()
	{

		return $this->location_id;
	}

	
	public function setConstituencyId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->constituency_id !== $v) {
			$this->constituency_id = $v;
			$this->modifiedColumns[] = OpConstituencyLocationPeer::CONSTITUENCY_ID;
		}

		if ($this->aOpConstituency !== null && $this->aOpConstituency->getId() !== $v) {
			$this->aOpConstituency = null;
		}

	} 
	
	public function setLocationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_id !== $v) {
			$this->location_id = $v;
			$this->modifiedColumns[] = OpConstituencyLocationPeer::LOCATION_ID;
		}

		if ($this->aOpLocation !== null && $this->aOpLocation->getId() !== $v) {
			$this->aOpLocation = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->constituency_id = $rs->getInt($startcol + 0);

			$this->location_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpConstituencyLocation object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpConstituencyLocationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpConstituencyLocationPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpConstituencyLocationPeer::DATABASE_NAME);
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


												
			if ($this->aOpConstituency !== null) {
				if ($this->aOpConstituency->isModified()) {
					$affectedRows += $this->aOpConstituency->save($con);
				}
				$this->setOpConstituency($this->aOpConstituency);
			}

			if ($this->aOpLocation !== null) {
				if ($this->aOpLocation->isModified()) {
					$affectedRows += $this->aOpLocation->save($con);
				}
				$this->setOpLocation($this->aOpLocation);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpConstituencyLocationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpConstituencyLocationPeer::doUpdate($this, $con);
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


												
			if ($this->aOpConstituency !== null) {
				if (!$this->aOpConstituency->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpConstituency->getValidationFailures());
				}
			}

			if ($this->aOpLocation !== null) {
				if (!$this->aOpLocation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpLocation->getValidationFailures());
				}
			}


			if (($retval = OpConstituencyLocationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpConstituencyLocationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getConstituencyId();
				break;
			case 1:
				return $this->getLocationId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpConstituencyLocationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getConstituencyId(),
			$keys[1] => $this->getLocationId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpConstituencyLocationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setConstituencyId($value);
				break;
			case 1:
				$this->setLocationId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpConstituencyLocationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setConstituencyId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setLocationId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpConstituencyLocationPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpConstituencyLocationPeer::CONSTITUENCY_ID)) $criteria->add(OpConstituencyLocationPeer::CONSTITUENCY_ID, $this->constituency_id);
		if ($this->isColumnModified(OpConstituencyLocationPeer::LOCATION_ID)) $criteria->add(OpConstituencyLocationPeer::LOCATION_ID, $this->location_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpConstituencyLocationPeer::DATABASE_NAME);

		$criteria->add(OpConstituencyLocationPeer::CONSTITUENCY_ID, $this->constituency_id);
		$criteria->add(OpConstituencyLocationPeer::LOCATION_ID, $this->location_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getConstituencyId();

		$pks[1] = $this->getLocationId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setConstituencyId($keys[0]);

		$this->setLocationId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setConstituencyId(NULL); 
		$copyObj->setLocationId(NULL); 
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
			self::$peer = new OpConstituencyLocationPeer();
		}
		return self::$peer;
	}

	
	public function setOpConstituency($v)
	{


		if ($v === null) {
			$this->setConstituencyId(NULL);
		} else {
			$this->setConstituencyId($v->getId());
		}


		$this->aOpConstituency = $v;
	}


	
	public function getOpConstituency($con = null)
	{
		if ($this->aOpConstituency === null && ($this->constituency_id !== null)) {
						include_once 'lib/model/om/BaseOpConstituencyPeer.php';

			$this->aOpConstituency = OpConstituencyPeer::retrieveByPK($this->constituency_id, $con);

			
		}
		return $this->aOpConstituency;
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