<?php


abstract class BaseOpPoliticianHasOpEducationLevel extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $politician_id;


	
	protected $education_level_id;


	
	protected $description;

	
	protected $aOpPolitician;

	
	protected $aOpEducationLevel;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getPoliticianId()
	{

		return $this->politician_id;
	}

	
	public function getEducationLevelId()
	{

		return $this->education_level_id;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function setPoliticianId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->politician_id !== $v) {
			$this->politician_id = $v;
			$this->modifiedColumns[] = OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID;
		}

		if ($this->aOpPolitician !== null && $this->aOpPolitician->getContentId() !== $v) {
			$this->aOpPolitician = null;
		}

	} 
	
	public function setEducationLevelId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->education_level_id !== $v) {
			$this->education_level_id = $v;
			$this->modifiedColumns[] = OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID;
		}

		if ($this->aOpEducationLevel !== null && $this->aOpEducationLevel->getId() !== $v) {
			$this->aOpEducationLevel = null;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = OpPoliticianHasOpEducationLevelPeer::DESCRIPTION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->politician_id = $rs->getInt($startcol + 0);

			$this->education_level_id = $rs->getInt($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpPoliticianHasOpEducationLevel object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpPoliticianHasOpEducationLevelPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpPoliticianHasOpEducationLevelPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpPoliticianHasOpEducationLevelPeer::DATABASE_NAME);
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


												
			if ($this->aOpPolitician !== null) {
				if ($this->aOpPolitician->isModified()) {
					$affectedRows += $this->aOpPolitician->save($con);
				}
				$this->setOpPolitician($this->aOpPolitician);
			}

			if ($this->aOpEducationLevel !== null) {
				if ($this->aOpEducationLevel->isModified()) {
					$affectedRows += $this->aOpEducationLevel->save($con);
				}
				$this->setOpEducationLevel($this->aOpEducationLevel);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpPoliticianHasOpEducationLevelPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpPoliticianHasOpEducationLevelPeer::doUpdate($this, $con);
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


												
			if ($this->aOpPolitician !== null) {
				if (!$this->aOpPolitician->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpPolitician->getValidationFailures());
				}
			}

			if ($this->aOpEducationLevel !== null) {
				if (!$this->aOpEducationLevel->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpEducationLevel->getValidationFailures());
				}
			}


			if (($retval = OpPoliticianHasOpEducationLevelPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpPoliticianHasOpEducationLevelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getPoliticianId();
				break;
			case 1:
				return $this->getEducationLevelId();
				break;
			case 2:
				return $this->getDescription();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpPoliticianHasOpEducationLevelPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getPoliticianId(),
			$keys[1] => $this->getEducationLevelId(),
			$keys[2] => $this->getDescription(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpPoliticianHasOpEducationLevelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setPoliticianId($value);
				break;
			case 1:
				$this->setEducationLevelId($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpPoliticianHasOpEducationLevelPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPoliticianId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEducationLevelId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpPoliticianHasOpEducationLevelPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID)) $criteria->add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $this->politician_id);
		if ($this->isColumnModified(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID)) $criteria->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, $this->education_level_id);
		if ($this->isColumnModified(OpPoliticianHasOpEducationLevelPeer::DESCRIPTION)) $criteria->add(OpPoliticianHasOpEducationLevelPeer::DESCRIPTION, $this->description);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpPoliticianHasOpEducationLevelPeer::DATABASE_NAME);

		$criteria->add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $this->politician_id);
		$criteria->add(OpPoliticianHasOpEducationLevelPeer::EDUCATION_LEVEL_ID, $this->education_level_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getPoliticianId();

		$pks[1] = $this->getEducationLevelId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setPoliticianId($keys[0]);

		$this->setEducationLevelId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setDescription($this->description);


		$copyObj->setNew(true);

		$copyObj->setPoliticianId(NULL); 
		$copyObj->setEducationLevelId(NULL); 
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
			self::$peer = new OpPoliticianHasOpEducationLevelPeer();
		}
		return self::$peer;
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

	
	public function setOpEducationLevel($v)
	{


		if ($v === null) {
			$this->setEducationLevelId(NULL);
		} else {
			$this->setEducationLevelId($v->getId());
		}


		$this->aOpEducationLevel = $v;
	}


	
	public function getOpEducationLevel($con = null)
	{
		if ($this->aOpEducationLevel === null && ($this->education_level_id !== null)) {
						include_once 'lib/model/om/BaseOpEducationLevelPeer.php';

			$this->aOpEducationLevel = OpEducationLevelPeer::retrieveByPK($this->education_level_id, $con);

			
		}
		return $this->aOpEducationLevel;
	}

} 