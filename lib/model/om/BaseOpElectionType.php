<?php


abstract class BaseOpElectionType extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $name;


	
	protected $id;

	
	protected $collOpConstituencys;

	
	protected $lastOpConstituencyCriteria = null;

	
	protected $collOpElections;

	
	protected $lastOpElectionCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getName()
	{

		return $this->name;
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
			$this->modifiedColumns[] = OpElectionTypePeer::NAME;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpElectionTypePeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->name = $rs->getString($startcol + 0);

			$this->id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpElectionType object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpElectionTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpElectionTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpElectionTypePeer::DATABASE_NAME);
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
					$pk = OpElectionTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpElectionTypePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpConstituencys !== null) {
				foreach($this->collOpConstituencys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpElections !== null) {
				foreach($this->collOpElections as $referrerFK) {
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


			if (($retval = OpElectionTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpConstituencys !== null) {
					foreach($this->collOpConstituencys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpElections !== null) {
					foreach($this->collOpElections as $referrerFK) {
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
		$pos = OpElectionTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getName();
				break;
			case 1:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpElectionTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getName(),
			$keys[1] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpElectionTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setName($value);
				break;
			case 1:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpElectionTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setName($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpElectionTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(OpElectionTypePeer::NAME)) $criteria->add(OpElectionTypePeer::NAME, $this->name);
		if ($this->isColumnModified(OpElectionTypePeer::ID)) $criteria->add(OpElectionTypePeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpElectionTypePeer::DATABASE_NAME);

		$criteria->add(OpElectionTypePeer::ID, $this->id);

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


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpConstituencys() as $relObj) {
				$copyObj->addOpConstituency($relObj->copy($deepCopy));
			}

			foreach($this->getOpElections() as $relObj) {
				$copyObj->addOpElection($relObj->copy($deepCopy));
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
			self::$peer = new OpElectionTypePeer();
		}
		return self::$peer;
	}

	
	public function initOpConstituencys()
	{
		if ($this->collOpConstituencys === null) {
			$this->collOpConstituencys = array();
		}
	}

	
	public function getOpConstituencys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpConstituencyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpConstituencys === null) {
			if ($this->isNew()) {
			   $this->collOpConstituencys = array();
			} else {

				$criteria->add(OpConstituencyPeer::ELECTION_TYPE_ID, $this->getId());

				OpConstituencyPeer::addSelectColumns($criteria);
				$this->collOpConstituencys = OpConstituencyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpConstituencyPeer::ELECTION_TYPE_ID, $this->getId());

				OpConstituencyPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpConstituencyCriteria) || !$this->lastOpConstituencyCriteria->equals($criteria)) {
					$this->collOpConstituencys = OpConstituencyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpConstituencyCriteria = $criteria;
		return $this->collOpConstituencys;
	}

	
	public function countOpConstituencys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpConstituencyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpConstituencyPeer::ELECTION_TYPE_ID, $this->getId());

		return OpConstituencyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpConstituency(OpConstituency $l)
	{
		$this->collOpConstituencys[] = $l;
		$l->setOpElectionType($this);
	}

	
	public function initOpElections()
	{
		if ($this->collOpElections === null) {
			$this->collOpElections = array();
		}
	}

	
	public function getOpElections($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpElectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpElections === null) {
			if ($this->isNew()) {
			   $this->collOpElections = array();
			} else {

				$criteria->add(OpElectionPeer::ELECTION_TYPE_ID, $this->getId());

				OpElectionPeer::addSelectColumns($criteria);
				$this->collOpElections = OpElectionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpElectionPeer::ELECTION_TYPE_ID, $this->getId());

				OpElectionPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpElectionCriteria) || !$this->lastOpElectionCriteria->equals($criteria)) {
					$this->collOpElections = OpElectionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpElectionCriteria = $criteria;
		return $this->collOpElections;
	}

	
	public function countOpElections($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpElectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpElectionPeer::ELECTION_TYPE_ID, $this->getId());

		return OpElectionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpElection(OpElection $l)
	{
		$this->collOpElections[] = $l;
		$l->setOpElectionType($this);
	}


	
	public function getOpElectionsJoinOpLocation($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpElectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpElections === null) {
			if ($this->isNew()) {
				$this->collOpElections = array();
			} else {

				$criteria->add(OpElectionPeer::ELECTION_TYPE_ID, $this->getId());

				$this->collOpElections = OpElectionPeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpElectionPeer::ELECTION_TYPE_ID, $this->getId());

			if (!isset($this->lastOpElectionCriteria) || !$this->lastOpElectionCriteria->equals($criteria)) {
				$this->collOpElections = OpElectionPeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpElectionCriteria = $criteria;

		return $this->collOpElections;
	}

} 