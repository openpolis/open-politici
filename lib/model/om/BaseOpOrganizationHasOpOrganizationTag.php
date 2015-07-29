<?php


abstract class BaseOpOrganizationHasOpOrganizationTag extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $organization_id;


	
	protected $organization_tag_id;

	
	protected $aOpOrganization;

	
	protected $aOpOrganizationTag;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getOrganizationId()
	{

		return $this->organization_id;
	}

	
	public function getOrganizationTagId()
	{

		return $this->organization_tag_id;
	}

	
	public function setOrganizationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->organization_id !== $v) {
			$this->organization_id = $v;
			$this->modifiedColumns[] = OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID;
		}

		if ($this->aOpOrganization !== null && $this->aOpOrganization->getId() !== $v) {
			$this->aOpOrganization = null;
		}

	} 
	
	public function setOrganizationTagId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->organization_tag_id !== $v) {
			$this->organization_tag_id = $v;
			$this->modifiedColumns[] = OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID;
		}

		if ($this->aOpOrganizationTag !== null && $this->aOpOrganizationTag->getId() !== $v) {
			$this->aOpOrganizationTag = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->organization_id = $rs->getInt($startcol + 0);

			$this->organization_tag_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpOrganizationHasOpOrganizationTag object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpOrganizationHasOpOrganizationTagPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpOrganizationHasOpOrganizationTagPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpOrganizationHasOpOrganizationTagPeer::DATABASE_NAME);
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


												
			if ($this->aOpOrganization !== null) {
				if ($this->aOpOrganization->isModified()) {
					$affectedRows += $this->aOpOrganization->save($con);
				}
				$this->setOpOrganization($this->aOpOrganization);
			}

			if ($this->aOpOrganizationTag !== null) {
				if ($this->aOpOrganizationTag->isModified()) {
					$affectedRows += $this->aOpOrganizationTag->save($con);
				}
				$this->setOpOrganizationTag($this->aOpOrganizationTag);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpOrganizationHasOpOrganizationTagPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpOrganizationHasOpOrganizationTagPeer::doUpdate($this, $con);
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


												
			if ($this->aOpOrganization !== null) {
				if (!$this->aOpOrganization->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpOrganization->getValidationFailures());
				}
			}

			if ($this->aOpOrganizationTag !== null) {
				if (!$this->aOpOrganizationTag->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpOrganizationTag->getValidationFailures());
				}
			}


			if (($retval = OpOrganizationHasOpOrganizationTagPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpOrganizationHasOpOrganizationTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getOrganizationId();
				break;
			case 1:
				return $this->getOrganizationTagId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpOrganizationHasOpOrganizationTagPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOrganizationId(),
			$keys[1] => $this->getOrganizationTagId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpOrganizationHasOpOrganizationTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setOrganizationId($value);
				break;
			case 1:
				$this->setOrganizationTagId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpOrganizationHasOpOrganizationTagPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOrganizationId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOrganizationTagId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpOrganizationHasOpOrganizationTagPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID)) $criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, $this->organization_id);
		if ($this->isColumnModified(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID)) $criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, $this->organization_tag_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpOrganizationHasOpOrganizationTagPeer::DATABASE_NAME);

		$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_ID, $this->organization_id);
		$criteria->add(OpOrganizationHasOpOrganizationTagPeer::ORGANIZATION_TAG_ID, $this->organization_tag_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getOrganizationId();

		$pks[1] = $this->getOrganizationTagId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setOrganizationId($keys[0]);

		$this->setOrganizationTagId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setOrganizationId(NULL); 
		$copyObj->setOrganizationTagId(NULL); 
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
			self::$peer = new OpOrganizationHasOpOrganizationTagPeer();
		}
		return self::$peer;
	}

	
	public function setOpOrganization($v)
	{


		if ($v === null) {
			$this->setOrganizationId(NULL);
		} else {
			$this->setOrganizationId($v->getId());
		}


		$this->aOpOrganization = $v;
	}


	
	public function getOpOrganization($con = null)
	{
		if ($this->aOpOrganization === null && ($this->organization_id !== null)) {
						include_once 'lib/model/om/BaseOpOrganizationPeer.php';

			$this->aOpOrganization = OpOrganizationPeer::retrieveByPK($this->organization_id, $con);

			
		}
		return $this->aOpOrganization;
	}

	
	public function setOpOrganizationTag($v)
	{


		if ($v === null) {
			$this->setOrganizationTagId(NULL);
		} else {
			$this->setOrganizationTagId($v->getId());
		}


		$this->aOpOrganizationTag = $v;
	}


	
	public function getOpOrganizationTag($con = null)
	{
		if ($this->aOpOrganizationTag === null && ($this->organization_tag_id !== null)) {
						include_once 'lib/model/om/BaseOpOrganizationTagPeer.php';

			$this->aOpOrganizationTag = OpOrganizationTagPeer::retrieveByPK($this->organization_tag_id, $con);

			
		}
		return $this->aOpOrganizationTag;
	}

} 