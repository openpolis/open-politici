<?php


abstract class BaseOpProfession extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $description;


	
	protected $oid;


	
	protected $odescription;


	
	protected $id;

	
	protected $collOpPoliticians;

	
	protected $lastOpPoliticianCriteria = null;

	
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
			$this->modifiedColumns[] = OpProfessionPeer::DESCRIPTION;
		}

	} 
	
	public function setOid($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->oid !== $v) {
			$this->oid = $v;
			$this->modifiedColumns[] = OpProfessionPeer::OID;
		}

	} 
	
	public function setOdescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->odescription !== $v) {
			$this->odescription = $v;
			$this->modifiedColumns[] = OpProfessionPeer::ODESCRIPTION;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpProfessionPeer::ID;
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
			throw new PropelException("Error populating OpProfession object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpProfessionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpProfessionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpProfessionPeer::DATABASE_NAME);
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
					$pk = OpProfessionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpProfessionPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpPoliticians !== null) {
				foreach($this->collOpPoliticians as $referrerFK) {
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


			if (($retval = OpProfessionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpPoliticians !== null) {
					foreach($this->collOpPoliticians as $referrerFK) {
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
		$pos = OpProfessionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		$keys = OpProfessionPeer::getFieldNames($keyType);
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
		$pos = OpProfessionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		$keys = OpProfessionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setDescription($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOid($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setOdescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setId($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpProfessionPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpProfessionPeer::DESCRIPTION)) $criteria->add(OpProfessionPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(OpProfessionPeer::OID)) $criteria->add(OpProfessionPeer::OID, $this->oid);
		if ($this->isColumnModified(OpProfessionPeer::ODESCRIPTION)) $criteria->add(OpProfessionPeer::ODESCRIPTION, $this->odescription);
		if ($this->isColumnModified(OpProfessionPeer::ID)) $criteria->add(OpProfessionPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpProfessionPeer::DATABASE_NAME);

		$criteria->add(OpProfessionPeer::ID, $this->id);

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

			foreach($this->getOpPoliticians() as $relObj) {
				$copyObj->addOpPolitician($relObj->copy($deepCopy));
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
			self::$peer = new OpProfessionPeer();
		}
		return self::$peer;
	}

	
	public function initOpPoliticians()
	{
		if ($this->collOpPoliticians === null) {
			$this->collOpPoliticians = array();
		}
	}

	
	public function getOpPoliticians($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticians === null) {
			if ($this->isNew()) {
			   $this->collOpPoliticians = array();
			} else {

				$criteria->add(OpPoliticianPeer::PROFESSION_ID, $this->getId());

				OpPoliticianPeer::addSelectColumns($criteria);
				$this->collOpPoliticians = OpPoliticianPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPoliticianPeer::PROFESSION_ID, $this->getId());

				OpPoliticianPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpPoliticianCriteria) || !$this->lastOpPoliticianCriteria->equals($criteria)) {
					$this->collOpPoliticians = OpPoliticianPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpPoliticianCriteria = $criteria;
		return $this->collOpPoliticians;
	}

	
	public function countOpPoliticians($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpPoliticianPeer::PROFESSION_ID, $this->getId());

		return OpPoliticianPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPolitician(OpPolitician $l)
	{
		$this->collOpPoliticians[] = $l;
		$l->setOpProfession($this);
	}


	
	public function getOpPoliticiansJoinOpContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticians === null) {
			if ($this->isNew()) {
				$this->collOpPoliticians = array();
			} else {

				$criteria->add(OpPoliticianPeer::PROFESSION_ID, $this->getId());

				$this->collOpPoliticians = OpPoliticianPeer::doSelectJoinOpContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticianPeer::PROFESSION_ID, $this->getId());

			if (!isset($this->lastOpPoliticianCriteria) || !$this->lastOpPoliticianCriteria->equals($criteria)) {
				$this->collOpPoliticians = OpPoliticianPeer::doSelectJoinOpContent($criteria, $con);
			}
		}
		$this->lastOpPoliticianCriteria = $criteria;

		return $this->collOpPoliticians;
	}


	
	public function getOpPoliticiansJoinOpUserRelatedByUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticians === null) {
			if ($this->isNew()) {
				$this->collOpPoliticians = array();
			} else {

				$criteria->add(OpPoliticianPeer::PROFESSION_ID, $this->getId());

				$this->collOpPoliticians = OpPoliticianPeer::doSelectJoinOpUserRelatedByUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticianPeer::PROFESSION_ID, $this->getId());

			if (!isset($this->lastOpPoliticianCriteria) || !$this->lastOpPoliticianCriteria->equals($criteria)) {
				$this->collOpPoliticians = OpPoliticianPeer::doSelectJoinOpUserRelatedByUserId($criteria, $con);
			}
		}
		$this->lastOpPoliticianCriteria = $criteria;

		return $this->collOpPoliticians;
	}


	
	public function getOpPoliticiansJoinOpUserRelatedByCreatorId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticians === null) {
			if ($this->isNew()) {
				$this->collOpPoliticians = array();
			} else {

				$criteria->add(OpPoliticianPeer::PROFESSION_ID, $this->getId());

				$this->collOpPoliticians = OpPoliticianPeer::doSelectJoinOpUserRelatedByCreatorId($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticianPeer::PROFESSION_ID, $this->getId());

			if (!isset($this->lastOpPoliticianCriteria) || !$this->lastOpPoliticianCriteria->equals($criteria)) {
				$this->collOpPoliticians = OpPoliticianPeer::doSelectJoinOpUserRelatedByCreatorId($criteria, $con);
			}
		}
		$this->lastOpPoliticianCriteria = $criteria;

		return $this->collOpPoliticians;
	}

} 