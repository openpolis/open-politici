<?php


abstract class BaseOpOrganizationTag extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;

	
	protected $collOpOrganizationHasOpOrganizationTags;

	
	protected $lastOpOrganizationHasOpOrganizationTagCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpOrganizationTagPeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = OpOrganizationTagPeer::NAME;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpOrganizationTag object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpOrganizationTagPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpOrganizationTagPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpOrganizationTagPeer::DATABASE_NAME);
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
					$pk = OpOrganizationTagPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpOrganizationTagPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpOrganizationHasOpOrganizationTags !== null) {
				foreach($this->collOpOrganizationHasOpOrganizationTags as $referrerFK) {
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


			if (($retval = OpOrganizationTagPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpOrganizationHasOpOrganizationTags !== null) {
					foreach($this->collOpOrganizationHasOpOrganizationTags as $referrerFK) {
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
		$pos = OpOrganizationTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpOrganizationTagPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpOrganizationTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpOrganizationTagPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpOrganizationTagPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpOrganizationTagPeer::ID)) $criteria->add(OpOrganizationTagPeer::ID, $this->id);
		if ($this->isColumnModified(OpOrganizationTagPeer::NAME)) $criteria->add(OpOrganizationTagPeer::NAME, $this->name);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpOrganizationTagPeer::DATABASE_NAME);

		$criteria->add(OpOrganizationTagPeer::ID, $this->id);

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

			foreach($this->getOpOrganizationHasOpOrganizationTags() as $relObj) {
				$copyObj->addOpOrganizationHasOpOrganizationTag($relObj->copy($deepCopy));
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
			self::$peer = new OpOrganizationTagPeer();
		}
		return self::$peer;
	}

	
	public function initOpOrganizationHasOpOrganizationTags()
	{
		if ($this->collOpOrganizationHasOpOrganizationTags === null) {
			$this->collOpOrganizationHasOpOrganizationTags = array();
		}
	}

	
	public function getOpOrganizationHasOpOrganizationTags($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationHasOpOrganizationTagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOrganizationHasOpOrganizationTags === null) {
			if ($this->isNew()) {
			   $this->collOpOrganizationHasOpOrganizationTags = array();
			} else {

				$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, $this->getId());

				OpOrganizationHasOpOrganizationTagPeer::addSelectColumns($criteria);
				$this->collOpOrganizationHasOpOrganizationTags = OpOrganizationHasOpOrganizationTagPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, $this->getId());

				OpOrganizationHasOpOrganizationTagPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpOrganizationHasOpOrganizationTagCriteria) || !$this->lastOpOrganizationHasOpOrganizationTagCriteria->equals($criteria)) {
					$this->collOpOrganizationHasOpOrganizationTags = OpOrganizationHasOpOrganizationTagPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpOrganizationHasOpOrganizationTagCriteria = $criteria;
		return $this->collOpOrganizationHasOpOrganizationTags;
	}

	
	public function countOpOrganizationHasOpOrganizationTags($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationHasOpOrganizationTagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, $this->getId());

		return OpOrganizationHasOpOrganizationTagPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpOrganizationHasOpOrganizationTag(OpOrganizationHasOpOrganizationTag $l)
	{
		$this->collOpOrganizationHasOpOrganizationTags[] = $l;
		$l->setOpOrganizationTag($this);
	}


	
	public function getOpOrganizationHasOpOrganizationTagsJoinOpOrganization($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationHasOpOrganizationTagPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOrganizationHasOpOrganizationTags === null) {
			if ($this->isNew()) {
				$this->collOpOrganizationHasOpOrganizationTags = array();
			} else {

				$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, $this->getId());

				$this->collOpOrganizationHasOpOrganizationTags = OpOrganizationHasOpOrganizationTagPeer::doSelectJoinOpOrganization($criteria, $con);
			}
		} else {
									
			$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, $this->getId());

			if (!isset($this->lastOpOrganizationHasOpOrganizationTagCriteria) || !$this->lastOpOrganizationHasOpOrganizationTagCriteria->equals($criteria)) {
				$this->collOpOrganizationHasOpOrganizationTags = OpOrganizationHasOpOrganizationTagPeer::doSelectJoinOpOrganization($criteria, $con);
			}
		}
		$this->lastOpOrganizationHasOpOrganizationTagCriteria = $criteria;

		return $this->collOpOrganizationHasOpOrganizationTags;
	}

} 