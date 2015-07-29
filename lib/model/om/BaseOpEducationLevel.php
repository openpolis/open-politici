<?php


abstract class BaseOpEducationLevel extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $description;


	
	protected $oid;


	
	protected $odescription;


	
	protected $id;

	
	protected $collOpPoliticianHasOpEducationLevels;

	
	protected $lastOpPoliticianHasOpEducationLevelCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getOid()
	{

		return $this->oid;
	}

	
	public function getOdescription()
	{

		return $this->odescription;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = OpEducationLevelPeer::DESCRIPTION;
		}

	} 
	
	public function setOid($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->oid !== $v) {
			$this->oid = $v;
			$this->modifiedColumns[] = OpEducationLevelPeer::OID;
		}

	} 
	
	public function setOdescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->odescription !== $v) {
			$this->odescription = $v;
			$this->modifiedColumns[] = OpEducationLevelPeer::ODESCRIPTION;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpEducationLevelPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->description = $rs->getString($startcol + 0);

			$this->oid = $rs->getInt($startcol + 1);

			$this->odescription = $rs->getString($startcol + 2);

			$this->id = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpEducationLevel object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpEducationLevelPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpEducationLevelPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpEducationLevelPeer::DATABASE_NAME);
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
					$pk = OpEducationLevelPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpEducationLevelPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpPoliticianHasOpEducationLevels !== null) {
				foreach($this->collOpPoliticianHasOpEducationLevels as $referrerFK) {
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


			if (($retval = OpEducationLevelPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpPoliticianHasOpEducationLevels !== null) {
					foreach($this->collOpPoliticianHasOpEducationLevels as $referrerFK) {
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
		$pos = OpEducationLevelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getDescription();
				break;
			case 1:
				return $this->getOid();
				break;
			case 2:
				return $this->getOdescription();
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
		$keys = OpEducationLevelPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getDescription(),
			$keys[1] => $this->getOid(),
			$keys[2] => $this->getOdescription(),
			$keys[3] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpEducationLevelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setDescription($value);
				break;
			case 1:
				$this->setOid($value);
				break;
			case 2:
				$this->setOdescription($value);
				break;
			case 3:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpEducationLevelPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setDescription($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOid($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setOdescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setId($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpEducationLevelPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpEducationLevelPeer::DESCRIPTION)) $criteria->add(OpEducationLevelPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(OpEducationLevelPeer::OID)) $criteria->add(OpEducationLevelPeer::OID, $this->oid);
		if ($this->isColumnModified(OpEducationLevelPeer::ODESCRIPTION)) $criteria->add(OpEducationLevelPeer::ODESCRIPTION, $this->odescription);
		if ($this->isColumnModified(OpEducationLevelPeer::ID)) $criteria->add(OpEducationLevelPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpEducationLevelPeer::DATABASE_NAME);

		$criteria->add(OpEducationLevelPeer::ID, $this->id);

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

		$copyObj->setDescription($this->description);

		$copyObj->setOid($this->oid);

		$copyObj->setOdescription($this->odescription);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpPoliticianHasOpEducationLevels() as $relObj) {
				$copyObj->addOpPoliticianHasOpEducationLevel($relObj->copy($deepCopy));
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
			self::$peer = new OpEducationLevelPeer();
		}
		return self::$peer;
	}

	
	public function initOpPoliticianHasOpEducationLevels()
	{
		if ($this->collOpPoliticianHasOpEducationLevels === null) {
			$this->collOpPoliticianHasOpEducationLevels = array();
		}
	}

	
	public function getOpPoliticianHasOpEducationLevels($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianHasOpEducationLevelPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticianHasOpEducationLevels === null) {
			if ($this->isNew()) {
			   $this->collOpPoliticianHasOpEducationLevels = array();
			} else {

				$criteria->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, $this->getId());

				OpPoliticianHasOpEducationLevelPeer::addSelectColumns($criteria);
				$this->collOpPoliticianHasOpEducationLevels = OpPoliticianHasOpEducationLevelPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, $this->getId());

				OpPoliticianHasOpEducationLevelPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpPoliticianHasOpEducationLevelCriteria) || !$this->lastOpPoliticianHasOpEducationLevelCriteria->equals($criteria)) {
					$this->collOpPoliticianHasOpEducationLevels = OpPoliticianHasOpEducationLevelPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpPoliticianHasOpEducationLevelCriteria = $criteria;
		return $this->collOpPoliticianHasOpEducationLevels;
	}

	
	public function countOpPoliticianHasOpEducationLevels($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianHasOpEducationLevelPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, $this->getId());

		return OpPoliticianHasOpEducationLevelPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPoliticianHasOpEducationLevel(OpPoliticianHasOpEducationLevel $l)
	{
		$this->collOpPoliticianHasOpEducationLevels[] = $l;
		$l->setOpEducationLevel($this);
	}


	
	public function getOpPoliticianHasOpEducationLevelsJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianHasOpEducationLevelPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticianHasOpEducationLevels === null) {
			if ($this->isNew()) {
				$this->collOpPoliticianHasOpEducationLevels = array();
			} else {

				$criteria->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, $this->getId());

				$this->collOpPoliticianHasOpEducationLevels = OpPoliticianHasOpEducationLevelPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, $this->getId());

			if (!isset($this->lastOpPoliticianHasOpEducationLevelCriteria) || !$this->lastOpPoliticianHasOpEducationLevelCriteria->equals($criteria)) {
				$this->collOpPoliticianHasOpEducationLevels = OpPoliticianHasOpEducationLevelPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpPoliticianHasOpEducationLevelCriteria = $criteria;

		return $this->collOpPoliticianHasOpEducationLevels;
	}

} 