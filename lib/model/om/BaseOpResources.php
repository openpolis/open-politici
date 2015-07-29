<?php


abstract class BaseOpResources extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $content_id;


	
	protected $politician_id;


	
	protected $resources_type_id;


	
	protected $valore;


	
	protected $descrizione;

	
	protected $aOpOpenContent;

	
	protected $aOpPolitician;

	
	protected $aOpResourcesType;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getContentId()
	{

		return $this->content_id;
	}

	
	public function getPoliticianId()
	{

		return $this->politician_id;
	}

	
	public function getResourcesTypeId()
	{

		return $this->resources_type_id;
	}

	
	public function getValore()
	{

		return $this->valore;
	}

	
	public function getDescrizione()
	{

		return $this->descrizione;
	}

	
	public function setContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->content_id !== $v) {
			$this->content_id = $v;
			$this->modifiedColumns[] = OpResourcesPeer::CONTENT_ID;
		}

		if ($this->aOpOpenContent !== null && $this->aOpOpenContent->getContentId() !== $v) {
			$this->aOpOpenContent = null;
		}

	} 
	
	public function setPoliticianId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->politician_id !== $v) {
			$this->politician_id = $v;
			$this->modifiedColumns[] = OpResourcesPeer::POLITICIAN_ID;
		}

		if ($this->aOpPolitician !== null && $this->aOpPolitician->getContentId() !== $v) {
			$this->aOpPolitician = null;
		}

	} 
	
	public function setResourcesTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->resources_type_id !== $v) {
			$this->resources_type_id = $v;
			$this->modifiedColumns[] = OpResourcesPeer::RESOURCES_TYPE_ID;
		}

		if ($this->aOpResourcesType !== null && $this->aOpResourcesType->getId() !== $v) {
			$this->aOpResourcesType = null;
		}

	} 
	
	public function setValore($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->valore !== $v) {
			$this->valore = $v;
			$this->modifiedColumns[] = OpResourcesPeer::VALORE;
		}

	} 
	
	public function setDescrizione($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descrizione !== $v) {
			$this->descrizione = $v;
			$this->modifiedColumns[] = OpResourcesPeer::DESCRIZIONE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->content_id = $rs->getInt($startcol + 0);

			$this->politician_id = $rs->getInt($startcol + 1);

			$this->resources_type_id = $rs->getInt($startcol + 2);

			$this->valore = $rs->getString($startcol + 3);

			$this->descrizione = $rs->getString($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpResources object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpResourcesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpResourcesPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpResourcesPeer::DATABASE_NAME);
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


												
			if ($this->aOpOpenContent !== null) {
				if ($this->aOpOpenContent->isModified()) {
					$affectedRows += $this->aOpOpenContent->save($con);
				}
				$this->setOpOpenContent($this->aOpOpenContent);
			}

			if ($this->aOpPolitician !== null) {
				if ($this->aOpPolitician->isModified()) {
					$affectedRows += $this->aOpPolitician->save($con);
				}
				$this->setOpPolitician($this->aOpPolitician);
			}

			if ($this->aOpResourcesType !== null) {
				if ($this->aOpResourcesType->isModified()) {
					$affectedRows += $this->aOpResourcesType->save($con);
				}
				$this->setOpResourcesType($this->aOpResourcesType);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpResourcesPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpResourcesPeer::doUpdate($this, $con);
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


												
			if ($this->aOpOpenContent !== null) {
				if (!$this->aOpOpenContent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpOpenContent->getValidationFailures());
				}
			}

			if ($this->aOpPolitician !== null) {
				if (!$this->aOpPolitician->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpPolitician->getValidationFailures());
				}
			}

			if ($this->aOpResourcesType !== null) {
				if (!$this->aOpResourcesType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpResourcesType->getValidationFailures());
				}
			}


			if (($retval = OpResourcesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpResourcesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getContentId();
				break;
			case 1:
				return $this->getPoliticianId();
				break;
			case 2:
				return $this->getResourcesTypeId();
				break;
			case 3:
				return $this->getValore();
				break;
			case 4:
				return $this->getDescrizione();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpResourcesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getContentId(),
			$keys[1] => $this->getPoliticianId(),
			$keys[2] => $this->getResourcesTypeId(),
			$keys[3] => $this->getValore(),
			$keys[4] => $this->getDescrizione(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpResourcesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setContentId($value);
				break;
			case 1:
				$this->setPoliticianId($value);
				break;
			case 2:
				$this->setResourcesTypeId($value);
				break;
			case 3:
				$this->setValore($value);
				break;
			case 4:
				$this->setDescrizione($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpResourcesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setContentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPoliticianId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setResourcesTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setValore($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescrizione($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpResourcesPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpResourcesPeer::CONTENT_ID)) $criteria->add(OpResourcesPeer::CONTENT_ID, $this->content_id);
		if ($this->isColumnModified(OpResourcesPeer::POLITICIAN_ID)) $criteria->add(OpResourcesPeer::POLITICIAN_ID, $this->politician_id);
		if ($this->isColumnModified(OpResourcesPeer::RESOURCES_TYPE_ID)) $criteria->add(OpResourcesPeer::RESOURCES_TYPE_ID, $this->resources_type_id);
		if ($this->isColumnModified(OpResourcesPeer::VALORE)) $criteria->add(OpResourcesPeer::VALORE, $this->valore);
		if ($this->isColumnModified(OpResourcesPeer::DESCRIZIONE)) $criteria->add(OpResourcesPeer::DESCRIZIONE, $this->descrizione);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpResourcesPeer::DATABASE_NAME);

		$criteria->add(OpResourcesPeer::CONTENT_ID, $this->content_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getContentId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setContentId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPoliticianId($this->politician_id);

		$copyObj->setResourcesTypeId($this->resources_type_id);

		$copyObj->setValore($this->valore);

		$copyObj->setDescrizione($this->descrizione);


		$copyObj->setNew(true);

		$copyObj->setContentId(NULL); 
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
			self::$peer = new OpResourcesPeer();
		}
		return self::$peer;
	}

	
	public function setOpOpenContent($v)
	{


		if ($v === null) {
			$this->setContentId(NULL);
		} else {
			$this->setContentId($v->getContentId());
		}


		$this->aOpOpenContent = $v;
	}


	
	public function getOpOpenContent($con = null)
	{
		if ($this->aOpOpenContent === null && ($this->content_id !== null)) {
						include_once 'lib/model/om/BaseOpOpenContentPeer.php';

			$this->aOpOpenContent = OpOpenContentPeer::retrieveByPK($this->content_id, $con);

			
		}
		return $this->aOpOpenContent;
	}

	
	public function setOpPolitician($v)
	{


		if ($v === null) {
			$this->setPoliticianId(NULL);
		} else {
			$this->setPoliticianId($v->getContentId());
		}


		$this->aOpPolitician = $v;
	}


	
	public function getOpPolitician($con = null)
	{
		if ($this->aOpPolitician === null && ($this->politician_id !== null)) {
						include_once 'lib/model/om/BaseOpPoliticianPeer.php';

			$this->aOpPolitician = OpPoliticianPeer::retrieveByPK($this->politician_id, $con);

			
		}
		return $this->aOpPolitician;
	}

	
	public function setOpResourcesType($v)
	{


		if ($v === null) {
			$this->setResourcesTypeId(NULL);
		} else {
			$this->setResourcesTypeId($v->getId());
		}


		$this->aOpResourcesType = $v;
	}


	
	public function getOpResourcesType($con = null)
	{
		if ($this->aOpResourcesType === null && ($this->resources_type_id !== null)) {
						include_once 'lib/model/om/BaseOpResourcesTypePeer.php';

			$this->aOpResourcesType = OpResourcesTypePeer::retrieveByPK($this->resources_type_id, $con);

			
		}
		return $this->aOpResourcesType;
	}

} 