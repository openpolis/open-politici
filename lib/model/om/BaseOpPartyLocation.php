<?php


abstract class BaseOpPartyLocation extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $party_id;


	
	protected $location_id;

	
	protected $aOpParty;

	
	protected $aOpLocation;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getPartyId()
	{

		return $this->party_id;
	}

	
	public function getLocationId()
	{

		return $this->location_id;
	}

	
	public function setPartyId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->party_id !== $v) {
			$this->party_id = $v;
			$this->modifiedColumns[] = OpPartyLocationPeer::PARTY_ID;
		}

		if ($this->aOpParty !== null && $this->aOpParty->getId() !== $v) {
			$this->aOpParty = null;
		}

	} 
	
	public function setLocationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_id !== $v) {
			$this->location_id = $v;
			$this->modifiedColumns[] = OpPartyLocationPeer::LOCATION_ID;
		}

		if ($this->aOpLocation !== null && $this->aOpLocation->getId() !== $v) {
			$this->aOpLocation = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->party_id = $rs->getInt($startcol + 0);

			$this->location_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpPartyLocation object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpPartyLocationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpPartyLocationPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpPartyLocationPeer::DATABASE_NAME);
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


												
			if ($this->aOpParty !== null) {
				if ($this->aOpParty->isModified()) {
					$affectedRows += $this->aOpParty->save($con);
				}
				$this->setOpParty($this->aOpParty);
			}

			if ($this->aOpLocation !== null) {
				if ($this->aOpLocation->isModified()) {
					$affectedRows += $this->aOpLocation->save($con);
				}
				$this->setOpLocation($this->aOpLocation);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpPartyLocationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpPartyLocationPeer::doUpdate($this, $con);
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


												
			if ($this->aOpParty !== null) {
				if (!$this->aOpParty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpParty->getValidationFailures());
				}
			}

			if ($this->aOpLocation !== null) {
				if (!$this->aOpLocation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpLocation->getValidationFailures());
				}
			}


			if (($retval = OpPartyLocationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpPartyLocationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getPartyId();
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
		$keys = OpPartyLocationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getPartyId(),
			$keys[1] => $this->getLocationId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpPartyLocationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setPartyId($value);
				break;
			case 1:
				$this->setLocationId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpPartyLocationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPartyId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setLocationId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpPartyLocationPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpPartyLocationPeer::PARTY_ID)) $criteria->add(OpPartyLocationPeer::PARTY_ID, $this->party_id);
		if ($this->isColumnModified(OpPartyLocationPeer::LOCATION_ID)) $criteria->add(OpPartyLocationPeer::LOCATION_ID, $this->location_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpPartyLocationPeer::DATABASE_NAME);

		$criteria->add(OpPartyLocationPeer::PARTY_ID, $this->party_id);
		$criteria->add(OpPartyLocationPeer::LOCATION_ID, $this->location_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getPartyId();

		$pks[1] = $this->getLocationId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setPartyId($keys[0]);

		$this->setLocationId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setPartyId(NULL); 
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
			self::$peer = new OpPartyLocationPeer();
		}
		return self::$peer;
	}

	
	public function setOpParty($v)
	{


		if ($v === null) {
			$this->setPartyId(NULL);
		} else {
			$this->setPartyId($v->getId());
		}


		$this->aOpParty = $v;
	}


	
	public function getOpParty($con = null)
	{
		if ($this->aOpParty === null && ($this->party_id !== null)) {
						include_once 'lib/model/om/BaseOpPartyPeer.php';

			$this->aOpParty = OpPartyPeer::retrieveByPK($this->party_id, $con);

			
		}
		return $this->aOpParty;
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