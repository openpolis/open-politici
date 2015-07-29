<?php


abstract class BaseOpConstituency extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $election_type_id;


	
	protected $name;


	
	protected $valid;


	
	protected $slug;


	
	protected $id;

	
	protected $aOpElectionType;

	
	protected $collOpConstituencyLocations;

	
	protected $lastOpConstituencyLocationCriteria = null;

	
	protected $collOpInstitutionCharges;

	
	protected $lastOpInstitutionChargeCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getElectionTypeId()
	{

		return $this->election_type_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getValid()
	{

		return $this->valid;
	}

	
	public function getSlug()
	{

		return $this->slug;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setElectionTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->election_type_id !== $v) {
			$this->election_type_id = $v;
			$this->modifiedColumns[] = OpConstituencyPeer::ELECTION_TYPE_ID;
		}

		if ($this->aOpElectionType !== null && $this->aOpElectionType->getId() !== $v) {
			$this->aOpElectionType = null;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = OpConstituencyPeer::NAME;
		}

	} 
	
	public function setValid($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->valid !== $v) {
			$this->valid = $v;
			$this->modifiedColumns[] = OpConstituencyPeer::VALID;
		}

	} 
	
	public function setSlug($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->slug !== $v) {
			$this->slug = $v;
			$this->modifiedColumns[] = OpConstituencyPeer::SLUG;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpConstituencyPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->election_type_id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->valid = $rs->getInt($startcol + 2);

			$this->slug = $rs->getString($startcol + 3);

			$this->id = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpConstituency object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpConstituencyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpConstituencyPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpConstituencyPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpConstituencyPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpConstituencyPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpConstituencyLocations !== null) {
				foreach($this->collOpConstituencyLocations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpInstitutionCharges !== null) {
				foreach($this->collOpInstitutionCharges as $referrerFK) {
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


												
			if ($this->aOpElectionType !== null) {
				if (!$this->aOpElectionType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpElectionType->getValidationFailures());
				}
			}


			if (($retval = OpConstituencyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpConstituencyLocations !== null) {
					foreach($this->collOpConstituencyLocations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpInstitutionCharges !== null) {
					foreach($this->collOpInstitutionCharges as $referrerFK) {
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
		$pos = OpConstituencyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getElectionTypeId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getValid();
				break;
			case 3:
				return $this->getSlug();
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
		$keys = OpConstituencyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getElectionTypeId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getValid(),
			$keys[3] => $this->getSlug(),
			$keys[4] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpConstituencyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setElectionTypeId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setValid($value);
				break;
			case 3:
				$this->setSlug($value);
				break;
			case 4:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpConstituencyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setElectionTypeId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setValid($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSlug($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setId($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpConstituencyPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpConstituencyPeer::ELECTION_TYPE_ID)) $criteria->add(OpConstituencyPeer::ELECTION_TYPE_ID, $this->election_type_id);
		if ($this->isColumnModified(OpConstituencyPeer::NAME)) $criteria->add(OpConstituencyPeer::NAME, $this->name);
		if ($this->isColumnModified(OpConstituencyPeer::VALID)) $criteria->add(OpConstituencyPeer::VALID, $this->valid);
		if ($this->isColumnModified(OpConstituencyPeer::SLUG)) $criteria->add(OpConstituencyPeer::SLUG, $this->slug);
		if ($this->isColumnModified(OpConstituencyPeer::ID)) $criteria->add(OpConstituencyPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpConstituencyPeer::DATABASE_NAME);

		$criteria->add(OpConstituencyPeer::ID, $this->id);

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

		$copyObj->setElectionTypeId($this->election_type_id);

		$copyObj->setName($this->name);

		$copyObj->setValid($this->valid);

		$copyObj->setSlug($this->slug);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpConstituencyLocations() as $relObj) {
				$copyObj->addOpConstituencyLocation($relObj->copy($deepCopy));
			}

			foreach($this->getOpInstitutionCharges() as $relObj) {
				$copyObj->addOpInstitutionCharge($relObj->copy($deepCopy));
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
			self::$peer = new OpConstituencyPeer();
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

	
	public function initOpConstituencyLocations()
	{
		if ($this->collOpConstituencyLocations === null) {
			$this->collOpConstituencyLocations = array();
		}
	}

	
	public function getOpConstituencyLocations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpConstituencyLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpConstituencyLocations === null) {
			if ($this->isNew()) {
			   $this->collOpConstituencyLocations = array();
			} else {

				$criteria->add(OpConstituencyLocationPeer::CONSTITUENCY_ID, $this->getId());

				OpConstituencyLocationPeer::addSelectColumns($criteria);
				$this->collOpConstituencyLocations = OpConstituencyLocationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpConstituencyLocationPeer::CONSTITUENCY_ID, $this->getId());

				OpConstituencyLocationPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpConstituencyLocationCriteria) || !$this->lastOpConstituencyLocationCriteria->equals($criteria)) {
					$this->collOpConstituencyLocations = OpConstituencyLocationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpConstituencyLocationCriteria = $criteria;
		return $this->collOpConstituencyLocations;
	}

	
	public function countOpConstituencyLocations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpConstituencyLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpConstituencyLocationPeer::CONSTITUENCY_ID, $this->getId());

		return OpConstituencyLocationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpConstituencyLocation(OpConstituencyLocation $l)
	{
		$this->collOpConstituencyLocations[] = $l;
		$l->setOpConstituency($this);
	}


	
	public function getOpConstituencyLocationsJoinOpLocation($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpConstituencyLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpConstituencyLocations === null) {
			if ($this->isNew()) {
				$this->collOpConstituencyLocations = array();
			} else {

				$criteria->add(OpConstituencyLocationPeer::CONSTITUENCY_ID, $this->getId());

				$this->collOpConstituencyLocations = OpConstituencyLocationPeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpConstituencyLocationPeer::CONSTITUENCY_ID, $this->getId());

			if (!isset($this->lastOpConstituencyLocationCriteria) || !$this->lastOpConstituencyLocationCriteria->equals($criteria)) {
				$this->collOpConstituencyLocations = OpConstituencyLocationPeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpConstituencyLocationCriteria = $criteria;

		return $this->collOpConstituencyLocations;
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

				$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

				OpInstitutionChargePeer::addSelectColumns($criteria);
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

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

		$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

		return OpInstitutionChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpInstitutionCharge(OpInstitutionCharge $l)
	{
		$this->collOpInstitutionCharges[] = $l;
		$l->setOpConstituency($this);
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

				$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

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

				$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

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

				$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpInstitution($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpInstitution($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpChargeType($criteria = null, $con = null)
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

				$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpChargeType($criteria, $con);
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

				$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpLocation($criteria, $con);
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

				$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

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

				$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpGroup($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpGroup($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}

} 