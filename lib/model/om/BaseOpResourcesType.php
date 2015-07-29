<?php


abstract class BaseOpResourcesType extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $resource_type;


	
	protected $id;

	
	protected $collOpResourcess;

	
	protected $lastOpResourcesCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getResourceType()
	{

		return $this->resource_type;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setResourceType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->resource_type !== $v) {
			$this->resource_type = $v;
			$this->modifiedColumns[] = OpResourcesTypePeer::RESOURCE_TYPE;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpResourcesTypePeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->resource_type = $rs->getString($startcol + 0);

			$this->id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpResourcesType object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpResourcesTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpResourcesTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpResourcesTypePeer::DATABASE_NAME);
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
					$pk = OpResourcesTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpResourcesTypePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpResourcess !== null) {
				foreach($this->collOpResourcess as $referrerFK) {
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


			if (($retval = OpResourcesTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpResourcess !== null) {
					foreach($this->collOpResourcess as $referrerFK) {
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
		$pos = OpResourcesTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getResourceType();
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
		$keys = OpResourcesTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getResourceType(),
			$keys[1] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpResourcesTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setResourceType($value);
				break;
			case 1:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpResourcesTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setResourceType($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpResourcesTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(OpResourcesTypePeer::RESOURCE_TYPE)) $criteria->add(OpResourcesTypePeer::RESOURCE_TYPE, $this->resource_type);
		if ($this->isColumnModified(OpResourcesTypePeer::ID)) $criteria->add(OpResourcesTypePeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpResourcesTypePeer::DATABASE_NAME);

		$criteria->add(OpResourcesTypePeer::ID, $this->id);

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

		$copyObj->setResourceType($this->resource_type);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpResourcess() as $relObj) {
				$copyObj->addOpResources($relObj->copy($deepCopy));
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
			self::$peer = new OpResourcesTypePeer();
		}
		return self::$peer;
	}

	
	public function initOpResourcess()
	{
		if ($this->collOpResourcess === null) {
			$this->collOpResourcess = array();
		}
	}

	
	public function getOpResourcess($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpResourcesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpResourcess === null) {
			if ($this->isNew()) {
			   $this->collOpResourcess = array();
			} else {

				$criteria->add(OpResourcesPeer::RESOURCES_TYPE_ID, $this->getId());

				OpResourcesPeer::addSelectColumns($criteria);
				$this->collOpResourcess = OpResourcesPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpResourcesPeer::RESOURCES_TYPE_ID, $this->getId());

				OpResourcesPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpResourcesCriteria) || !$this->lastOpResourcesCriteria->equals($criteria)) {
					$this->collOpResourcess = OpResourcesPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpResourcesCriteria = $criteria;
		return $this->collOpResourcess;
	}

	
	public function countOpResourcess($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpResourcesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpResourcesPeer::RESOURCES_TYPE_ID, $this->getId());

		return OpResourcesPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpResources(OpResources $l)
	{
		$this->collOpResourcess[] = $l;
		$l->setOpResourcesType($this);
	}


	
	public function getOpResourcessJoinOpOpenContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpResourcesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpResourcess === null) {
			if ($this->isNew()) {
				$this->collOpResourcess = array();
			} else {

				$criteria->add(OpResourcesPeer::RESOURCES_TYPE_ID, $this->getId());

				$this->collOpResourcess = OpResourcesPeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpResourcesPeer::RESOURCES_TYPE_ID, $this->getId());

			if (!isset($this->lastOpResourcesCriteria) || !$this->lastOpResourcesCriteria->equals($criteria)) {
				$this->collOpResourcess = OpResourcesPeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		}
		$this->lastOpResourcesCriteria = $criteria;

		return $this->collOpResourcess;
	}


	
	public function getOpResourcessJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpResourcesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpResourcess === null) {
			if ($this->isNew()) {
				$this->collOpResourcess = array();
			} else {

				$criteria->add(OpResourcesPeer::RESOURCES_TYPE_ID, $this->getId());

				$this->collOpResourcess = OpResourcesPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpResourcesPeer::RESOURCES_TYPE_ID, $this->getId());

			if (!isset($this->lastOpResourcesCriteria) || !$this->lastOpResourcesCriteria->equals($criteria)) {
				$this->collOpResourcess = OpResourcesPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpResourcesCriteria = $criteria;

		return $this->collOpResourcess;
	}

} 