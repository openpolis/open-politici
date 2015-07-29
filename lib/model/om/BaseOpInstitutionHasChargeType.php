<?php


abstract class BaseOpInstitutionHasChargeType extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $institution_id;


	
	protected $charge_type_id;

	
	protected $aOpInstitution;

	
	protected $aOpChargeType;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getInstitutionId()
	{

		return $this->institution_id;
	}

	
	public function getChargeTypeId()
	{

		return $this->charge_type_id;
	}

	
	public function setInstitutionId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->institution_id !== $v) {
			$this->institution_id = $v;
			$this->modifiedColumns[] = OpInstitutionHasChargeTypePeer::INSTITUTION_ID;
		}

		if ($this->aOpInstitution !== null && $this->aOpInstitution->getId() !== $v) {
			$this->aOpInstitution = null;
		}

	} 
	
	public function setChargeTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->charge_type_id !== $v) {
			$this->charge_type_id = $v;
			$this->modifiedColumns[] = OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID;
		}

		if ($this->aOpChargeType !== null && $this->aOpChargeType->getId() !== $v) {
			$this->aOpChargeType = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->institution_id = $rs->getInt($startcol + 0);

			$this->charge_type_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpInstitutionHasChargeType object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpInstitutionHasChargeTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpInstitutionHasChargeTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpInstitutionHasChargeTypePeer::DATABASE_NAME);
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


												
			if ($this->aOpInstitution !== null) {
				if ($this->aOpInstitution->isModified()) {
					$affectedRows += $this->aOpInstitution->save($con);
				}
				$this->setOpInstitution($this->aOpInstitution);
			}

			if ($this->aOpChargeType !== null) {
				if ($this->aOpChargeType->isModified()) {
					$affectedRows += $this->aOpChargeType->save($con);
				}
				$this->setOpChargeType($this->aOpChargeType);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpInstitutionHasChargeTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpInstitutionHasChargeTypePeer::doUpdate($this, $con);
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


												
			if ($this->aOpInstitution !== null) {
				if (!$this->aOpInstitution->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpInstitution->getValidationFailures());
				}
			}

			if ($this->aOpChargeType !== null) {
				if (!$this->aOpChargeType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpChargeType->getValidationFailures());
				}
			}


			if (($retval = OpInstitutionHasChargeTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpInstitutionHasChargeTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getInstitutionId();
				break;
			case 1:
				return $this->getChargeTypeId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpInstitutionHasChargeTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getInstitutionId(),
			$keys[1] => $this->getChargeTypeId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpInstitutionHasChargeTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setInstitutionId($value);
				break;
			case 1:
				$this->setChargeTypeId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpInstitutionHasChargeTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setInstitutionId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setChargeTypeId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpInstitutionHasChargeTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(OpInstitutionHasChargeTypePeer::INSTITUTION_ID)) $criteria->add(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, $this->institution_id);
		if ($this->isColumnModified(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID)) $criteria->add(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, $this->charge_type_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpInstitutionHasChargeTypePeer::DATABASE_NAME);

		$criteria->add(OpInstitutionHasChargeTypePeer::INSTITUTION_ID, $this->institution_id);
		$criteria->add(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, $this->charge_type_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getInstitutionId();

		$pks[1] = $this->getChargeTypeId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setInstitutionId($keys[0]);

		$this->setChargeTypeId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setInstitutionId(NULL); 
		$copyObj->setChargeTypeId(NULL); 
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
			self::$peer = new OpInstitutionHasChargeTypePeer();
		}
		return self::$peer;
	}

	
	public function setOpInstitution($v)
	{


		if ($v === null) {
			$this->setInstitutionId(NULL);
		} else {
			$this->setInstitutionId($v->getId());
		}


		$this->aOpInstitution = $v;
	}


	
	public function getOpInstitution($con = null)
	{
		if ($this->aOpInstitution === null && ($this->institution_id !== null)) {
						include_once 'lib/model/om/BaseOpInstitutionPeer.php';

			$this->aOpInstitution = OpInstitutionPeer::retrieveByPK($this->institution_id, $con);

			
		}
		return $this->aOpInstitution;
	}

	
	public function setOpChargeType($v)
	{


		if ($v === null) {
			$this->setChargeTypeId(NULL);
		} else {
			$this->setChargeTypeId($v->getId());
		}


		$this->aOpChargeType = $v;
	}


	
	public function getOpChargeType($con = null)
	{
		if ($this->aOpChargeType === null && ($this->charge_type_id !== null)) {
						include_once 'lib/model/om/BaseOpChargeTypePeer.php';

			$this->aOpChargeType = OpChargeTypePeer::retrieveByPK($this->charge_type_id, $con);

			
		}
		return $this->aOpChargeType;
	}

} 