<?php


abstract class BaseOpChargeType extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $name;


	
	protected $short_name;


	
	protected $priority = 0;


	
	protected $category = 'I';


	
	protected $id;

	
	protected $collOpInstitutionCharges;

	
	protected $lastOpInstitutionChargeCriteria = null;

	
	protected $collOpInstitutionHasChargeTypes;

	
	protected $lastOpInstitutionHasChargeTypeCriteria = null;

	
	protected $collOpPoliticalCharges;

	
	protected $lastOpPoliticalChargeCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getShortName()
	{

		return $this->short_name;
	}

	
	public function getPriority()
	{

		return $this->priority;
	}

	
	public function getCategory()
	{

		return $this->category;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = OpChargeTypePeer::NAME;
		}

	} 
	
	public function setShortName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->short_name !== $v) {
			$this->short_name = $v;
			$this->modifiedColumns[] = OpChargeTypePeer::SHORT_NAME;
		}

	} 
	
	public function setPriority($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->priority !== $v || $v === 0) {
			$this->priority = $v;
			$this->modifiedColumns[] = OpChargeTypePeer::PRIORITY;
		}

	} 
	
	public function setCategory($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->category !== $v || $v === 'I') {
			$this->category = $v;
			$this->modifiedColumns[] = OpChargeTypePeer::CATEGORY;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpChargeTypePeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->name = $rs->getString($startcol + 0);

			$this->short_name = $rs->getString($startcol + 1);

			$this->priority = $rs->getInt($startcol + 2);

			$this->category = $rs->getString($startcol + 3);

			$this->id = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpChargeType object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpChargeTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpChargeTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpChargeTypePeer::DATABASE_NAME);
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
					$pk = OpChargeTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpChargeTypePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpInstitutionCharges !== null) {
				foreach($this->collOpInstitutionCharges as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpInstitutionHasChargeTypes !== null) {
				foreach($this->collOpInstitutionHasChargeTypes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpPoliticalCharges !== null) {
				foreach($this->collOpPoliticalCharges as $referrerFK) {
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


			if (($retval = OpChargeTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpInstitutionCharges !== null) {
					foreach($this->collOpInstitutionCharges as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpInstitutionHasChargeTypes !== null) {
					foreach($this->collOpInstitutionHasChargeTypes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpPoliticalCharges !== null) {
					foreach($this->collOpPoliticalCharges as $referrerFK) {
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
		$pos = OpChargeTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getName();
				break;
			case 1:
				return $this->getShortName();
				break;
			case 2:
				return $this->getPriority();
				break;
			case 3:
				return $this->getCategory();
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
		$keys = OpChargeTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getName(),
			$keys[1] => $this->getShortName(),
			$keys[2] => $this->getPriority(),
			$keys[3] => $this->getCategory(),
			$keys[4] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpChargeTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setName($value);
				break;
			case 1:
				$this->setShortName($value);
				break;
			case 2:
				$this->setPriority($value);
				break;
			case 3:
				$this->setCategory($value);
				break;
			case 4:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpChargeTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setName($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setShortName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPriority($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCategory($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setId($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpChargeTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(OpChargeTypePeer::NAME)) $criteria->add(OpChargeTypePeer::NAME, $this->name);
		if ($this->isColumnModified(OpChargeTypePeer::SHORT_NAME)) $criteria->add(OpChargeTypePeer::SHORT_NAME, $this->short_name);
		if ($this->isColumnModified(OpChargeTypePeer::PRIORITY)) $criteria->add(OpChargeTypePeer::PRIORITY, $this->priority);
		if ($this->isColumnModified(OpChargeTypePeer::CATEGORY)) $criteria->add(OpChargeTypePeer::CATEGORY, $this->category);
		if ($this->isColumnModified(OpChargeTypePeer::ID)) $criteria->add(OpChargeTypePeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpChargeTypePeer::DATABASE_NAME);

		$criteria->add(OpChargeTypePeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setShortName($this->short_name);

		$copyObj->setPriority($this->priority);

		$copyObj->setCategory($this->category);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpInstitutionCharges() as $relObj) {
				$copyObj->addOpInstitutionCharge($relObj->copy($deepCopy));
			}

			foreach($this->getOpInstitutionHasChargeTypes() as $relObj) {
				$copyObj->addOpInstitutionHasChargeType($relObj->copy($deepCopy));
			}

			foreach($this->getOpPoliticalCharges() as $relObj) {
				$copyObj->addOpPoliticalCharge($relObj->copy($deepCopy));
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
			self::$peer = new OpChargeTypePeer();
		}
		return self::$peer;
	}

	
	public function initOpInstitutionCharges()
	{
		if ($this->collOpInstitutionCharges === null) {
			$this->collOpInstitutionCharges = array();
		}
	}

	
	public function getOpInstitutionCharges($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
			   $this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

				OpInstitutionChargePeer::addSelectColumns($criteria);
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

				OpInstitutionChargePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
					$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;
		return $this->collOpInstitutionCharges;
	}

	
	public function countOpInstitutionCharges($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

		return OpInstitutionChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpInstitutionCharge(OpInstitutionCharge $l)
	{
		$this->collOpInstitutionCharges[] = $l;
		$l->setOpChargeType($this);
	}


	
	public function getOpInstitutionChargesJoinOpOpenContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpInstitution($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpInstitution($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpInstitution($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpLocation($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpConstituency($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpConstituency($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpConstituency($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpParty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpGroup($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpGroup($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpGroup($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}

	
	public function initOpInstitutionHasChargeTypes()
	{
		if ($this->collOpInstitutionHasChargeTypes === null) {
			$this->collOpInstitutionHasChargeTypes = array();
		}
	}

	
	public function getOpInstitutionHasChargeTypes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionHasChargeTypePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionHasChargeTypes === null) {
			if ($this->isNew()) {
			   $this->collOpInstitutionHasChargeTypes = array();
			} else {

				$criteria->add(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, $this->getId());

				OpInstitutionHasChargeTypePeer::addSelectColumns($criteria);
				$this->collOpInstitutionHasChargeTypes = OpInstitutionHasChargeTypePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, $this->getId());

				OpInstitutionHasChargeTypePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpInstitutionHasChargeTypeCriteria) || !$this->lastOpInstitutionHasChargeTypeCriteria->equals($criteria)) {
					$this->collOpInstitutionHasChargeTypes = OpInstitutionHasChargeTypePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpInstitutionHasChargeTypeCriteria = $criteria;
		return $this->collOpInstitutionHasChargeTypes;
	}

	
	public function countOpInstitutionHasChargeTypes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionHasChargeTypePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, $this->getId());

		return OpInstitutionHasChargeTypePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpInstitutionHasChargeType(OpInstitutionHasChargeType $l)
	{
		$this->collOpInstitutionHasChargeTypes[] = $l;
		$l->setOpChargeType($this);
	}


	
	public function getOpInstitutionHasChargeTypesJoinOpInstitution($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionHasChargeTypePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionHasChargeTypes === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionHasChargeTypes = array();
			} else {

				$criteria->add(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, $this->getId());

				$this->collOpInstitutionHasChargeTypes = OpInstitutionHasChargeTypePeer::doSelectJoinOpInstitution($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionHasChargeTypePeer::CHARGE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpInstitutionHasChargeTypeCriteria) || !$this->lastOpInstitutionHasChargeTypeCriteria->equals($criteria)) {
				$this->collOpInstitutionHasChargeTypes = OpInstitutionHasChargeTypePeer::doSelectJoinOpInstitution($criteria, $con);
			}
		}
		$this->lastOpInstitutionHasChargeTypeCriteria = $criteria;

		return $this->collOpInstitutionHasChargeTypes;
	}

	
	public function initOpPoliticalCharges()
	{
		if ($this->collOpPoliticalCharges === null) {
			$this->collOpPoliticalCharges = array();
		}
	}

	
	public function getOpPoliticalCharges($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
			   $this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::CHARGE_TYPE_ID, $this->getId());

				OpPoliticalChargePeer::addSelectColumns($criteria);
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPoliticalChargePeer::CHARGE_TYPE_ID, $this->getId());

				OpPoliticalChargePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
					$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;
		return $this->collOpPoliticalCharges;
	}

	
	public function countOpPoliticalCharges($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpPoliticalChargePeer::CHARGE_TYPE_ID, $this->getId());

		return OpPoliticalChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPoliticalCharge(OpPoliticalCharge $l)
	{
		$this->collOpPoliticalCharges[] = $l;
		$l->setOpChargeType($this);
	}


	
	public function getOpPoliticalChargesJoinOpOpenContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
				$this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::CHARGE_TYPE_ID, $this->getId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::CHARGE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}


	
	public function getOpPoliticalChargesJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
				$this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::CHARGE_TYPE_ID, $this->getId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::CHARGE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}


	
	public function getOpPoliticalChargesJoinOpLocation($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
				$this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::CHARGE_TYPE_ID, $this->getId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::CHARGE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}


	
	public function getOpPoliticalChargesJoinOpParty($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
				$this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::CHARGE_TYPE_ID, $this->getId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::CHARGE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}

} 