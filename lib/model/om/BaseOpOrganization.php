<?php


abstract class BaseOpOrganization extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $name;


	
	protected $url;


	
	protected $id;

	
	protected $collOpOrganizationCharges;

	
	protected $lastOpOrganizationChargeCriteria = null;

	
	protected $collOpOrganizationHasOpOrganizationTags;

	
	protected $lastOpOrganizationHasOpOrganizationTagCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getUrl()
	{

		return $this->url;
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
			$this->modifiedColumns[] = OpOrganizationPeer::NAME;
		}

	} 
	
	public function setUrl($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = OpOrganizationPeer::URL;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpOrganizationPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->name = $rs->getString($startcol + 0);

			$this->url = $rs->getString($startcol + 1);

			$this->id = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpOrganization object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpOrganizationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpOrganizationPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpOrganizationPeer::DATABASE_NAME);
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
					$pk = OpOrganizationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpOrganizationPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpOrganizationCharges !== null) {
				foreach($this->collOpOrganizationCharges as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = OpOrganizationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpOrganizationCharges !== null) {
					foreach($this->collOpOrganizationCharges as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = OpOrganizationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getName();
				break;
			case 1:
				return $this->getUrl();
				break;
			case 2:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpOrganizationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getName(),
			$keys[1] => $this->getUrl(),
			$keys[2] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpOrganizationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setName($value);
				break;
			case 1:
				$this->setUrl($value);
				break;
			case 2:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpOrganizationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setName($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUrl($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setId($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpOrganizationPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpOrganizationPeer::NAME)) $criteria->add(OpOrganizationPeer::NAME, $this->name);
		if ($this->isColumnModified(OpOrganizationPeer::URL)) $criteria->add(OpOrganizationPeer::URL, $this->url);
		if ($this->isColumnModified(OpOrganizationPeer::ID)) $criteria->add(OpOrganizationPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpOrganizationPeer::DATABASE_NAME);

		$criteria->add(OpOrganizationPeer::ID, $this->id);

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

		$copyObj->setUrl($this->url);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpOrganizationCharges() as $relObj) {
				$copyObj->addOpOrganizationCharge($relObj->copy($deepCopy));
			}

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
			self::$peer = new OpOrganizationPeer();
		}
		return self::$peer;
	}

	
	public function initOpOrganizationCharges()
	{
		if ($this->collOpOrganizationCharges === null) {
			$this->collOpOrganizationCharges = array();
		}
	}

	
	public function getOpOrganizationCharges($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOrganizationCharges === null) {
			if ($this->isNew()) {
			   $this->collOpOrganizationCharges = array();
			} else {

				$criteria->add(OpOrganizationChargePeer::ORGANIZATION_ID, $this->getId());

				OpOrganizationChargePeer::addSelectColumns($criteria);
				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpOrganizationChargePeer::ORGANIZATION_ID, $this->getId());

				OpOrganizationChargePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpOrganizationChargeCriteria) || !$this->lastOpOrganizationChargeCriteria->equals($criteria)) {
					$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpOrganizationChargeCriteria = $criteria;
		return $this->collOpOrganizationCharges;
	}

	
	public function countOpOrganizationCharges($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpOrganizationChargePeer::ORGANIZATION_ID, $this->getId());

		return OpOrganizationChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpOrganizationCharge(OpOrganizationCharge $l)
	{
		$this->collOpOrganizationCharges[] = $l;
		$l->setOpOrganization($this);
	}


	
	public function getOpOrganizationChargesJoinOpOpenContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOrganizationCharges === null) {
			if ($this->isNew()) {
				$this->collOpOrganizationCharges = array();
			} else {

				$criteria->add(OpOrganizationChargePeer::ORGANIZATION_ID, $this->getId());

				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpOrganizationChargePeer::ORGANIZATION_ID, $this->getId());

			if (!isset($this->lastOpOrganizationChargeCriteria) || !$this->lastOpOrganizationChargeCriteria->equals($criteria)) {
				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		}
		$this->lastOpOrganizationChargeCriteria = $criteria;

		return $this->collOpOrganizationCharges;
	}


	
	public function getOpOrganizationChargesJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOrganizationCharges === null) {
			if ($this->isNew()) {
				$this->collOpOrganizationCharges = array();
			} else {

				$criteria->add(OpOrganizationChargePeer::ORGANIZATION_ID, $this->getId());

				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpOrganizationChargePeer::ORGANIZATION_ID, $this->getId());

			if (!isset($this->lastOpOrganizationChargeCriteria) || !$this->lastOpOrganizationChargeCriteria->equals($criteria)) {
				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpOrganizationChargeCriteria = $criteria;

		return $this->collOpOrganizationCharges;
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

				$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, $this->getId());

				OpOrganizationHasOpOrganizationTagPeer::addSelectColumns($criteria);
				$this->collOpOrganizationHasOpOrganizationTags = OpOrganizationHasOpOrganizationTagPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, $this->getId());

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

		$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, $this->getId());

		return OpOrganizationHasOpOrganizationTagPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpOrganizationHasOpOrganizationTag(OpOrganizationHasOpOrganizationTag $l)
	{
		$this->collOpOrganizationHasOpOrganizationTags[] = $l;
		$l->setOpOrganization($this);
	}


	
	public function getOpOrganizationHasOpOrganizationTagsJoinOpOrganizationTag($criteria = null, $con = null)
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

				$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, $this->getId());

				$this->collOpOrganizationHasOpOrganizationTags = OpOrganizationHasOpOrganizationTagPeer::doSelectJoinOpOrganizationTag($criteria, $con);
			}
		} else {
									
			$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, $this->getId());

			if (!isset($this->lastOpOrganizationHasOpOrganizationTagCriteria) || !$this->lastOpOrganizationHasOpOrganizationTagCriteria->equals($criteria)) {
				$this->collOpOrganizationHasOpOrganizationTags = OpOrganizationHasOpOrganizationTagPeer::doSelectJoinOpOrganizationTag($criteria, $con);
			}
		}
		$this->lastOpOrganizationHasOpOrganizationTagCriteria = $criteria;

		return $this->collOpOrganizationHasOpOrganizationTags;
	}

} 