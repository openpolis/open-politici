<?php


abstract class BaseOpPhaseType extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $name;


	
	protected $id;

	
	protected $collOpProcPhases;

	
	protected $lastOpProcPhaseCriteria = null;

	
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
			$this->modifiedColumns[] = OpPhaseTypePeer::NAME;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpPhaseTypePeer::ID;
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
			throw new PropelException("Error populating OpPhaseType object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpPhaseTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpPhaseTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpPhaseTypePeer::DATABASE_NAME);
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
					$pk = OpPhaseTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpPhaseTypePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpProcPhases !== null) {
				foreach($this->collOpProcPhases as $referrerFK) {
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


			if (($retval = OpPhaseTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpProcPhases !== null) {
					foreach($this->collOpProcPhases as $referrerFK) {
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
		$pos = OpPhaseTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		$keys = OpPhaseTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getName(),
			$keys[1] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpPhaseTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		$keys = OpPhaseTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setName($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpPhaseTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(OpPhaseTypePeer::NAME)) $criteria->add(OpPhaseTypePeer::NAME, $this->name);
		if ($this->isColumnModified(OpPhaseTypePeer::ID)) $criteria->add(OpPhaseTypePeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpPhaseTypePeer::DATABASE_NAME);

		$criteria->add(OpPhaseTypePeer::ID, $this->id);

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

			foreach($this->getOpProcPhases() as $relObj) {
				$copyObj->addOpProcPhase($relObj->copy($deepCopy));
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
			self::$peer = new OpPhaseTypePeer();
		}
		return self::$peer;
	}

	
	public function initOpProcPhases()
	{
		if ($this->collOpProcPhases === null) {
			$this->collOpProcPhases = array();
		}
	}

	
	public function getOpProcPhases($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpProcPhasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpProcPhases === null) {
			if ($this->isNew()) {
			   $this->collOpProcPhases = array();
			} else {

				$criteria->add(OpProcPhasePeer::PHASE_TYPE_ID, $this->getId());

				OpProcPhasePeer::addSelectColumns($criteria);
				$this->collOpProcPhases = OpProcPhasePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpProcPhasePeer::PHASE_TYPE_ID, $this->getId());

				OpProcPhasePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpProcPhaseCriteria) || !$this->lastOpProcPhaseCriteria->equals($criteria)) {
					$this->collOpProcPhases = OpProcPhasePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpProcPhaseCriteria = $criteria;
		return $this->collOpProcPhases;
	}

	
	public function countOpProcPhases($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpProcPhasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpProcPhasePeer::PHASE_TYPE_ID, $this->getId());

		return OpProcPhasePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpProcPhase(OpProcPhase $l)
	{
		$this->collOpProcPhases[] = $l;
		$l->setOpPhaseType($this);
	}


	
	public function getOpProcPhasesJoinOpStatusType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpProcPhasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpProcPhases === null) {
			if ($this->isNew()) {
				$this->collOpProcPhases = array();
			} else {

				$criteria->add(OpProcPhasePeer::PHASE_TYPE_ID, $this->getId());

				$this->collOpProcPhases = OpProcPhasePeer::doSelectJoinOpStatusType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpProcPhasePeer::PHASE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpProcPhaseCriteria) || !$this->lastOpProcPhaseCriteria->equals($criteria)) {
				$this->collOpProcPhases = OpProcPhasePeer::doSelectJoinOpStatusType($criteria, $con);
			}
		}
		$this->lastOpProcPhaseCriteria = $criteria;

		return $this->collOpProcPhases;
	}


	
	public function getOpProcPhasesJoinOpProcedimento($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpProcPhasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpProcPhases === null) {
			if ($this->isNew()) {
				$this->collOpProcPhases = array();
			} else {

				$criteria->add(OpProcPhasePeer::PHASE_TYPE_ID, $this->getId());

				$this->collOpProcPhases = OpProcPhasePeer::doSelectJoinOpProcedimento($criteria, $con);
			}
		} else {
									
			$criteria->add(OpProcPhasePeer::PHASE_TYPE_ID, $this->getId());

			if (!isset($this->lastOpProcPhaseCriteria) || !$this->lastOpProcPhaseCriteria->equals($criteria)) {
				$this->collOpProcPhases = OpProcPhasePeer::doSelectJoinOpProcedimento($criteria, $con);
			}
		}
		$this->lastOpProcPhaseCriteria = $criteria;

		return $this->collOpProcPhases;
	}

} 