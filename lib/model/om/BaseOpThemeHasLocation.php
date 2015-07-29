<?php


abstract class BaseOpThemeHasLocation extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $theme_id;


	
	protected $location_id;

	
	protected $aOpTheme;

	
	protected $aOpLocation;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getThemeId()
	{

		return $this->theme_id;
	}

	
	public function getLocationId()
	{

		return $this->location_id;
	}

	
	public function setThemeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->theme_id !== $v) {
			$this->theme_id = $v;
			$this->modifiedColumns[] = OpThemeHasLocationPeer::THEME_ID;
		}

		if ($this->aOpTheme !== null && $this->aOpTheme->getContentId() !== $v) {
			$this->aOpTheme = null;
		}

	} 
	
	public function setLocationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_id !== $v) {
			$this->location_id = $v;
			$this->modifiedColumns[] = OpThemeHasLocationPeer::LOCATION_ID;
		}

		if ($this->aOpLocation !== null && $this->aOpLocation->getId() !== $v) {
			$this->aOpLocation = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->theme_id = $rs->getInt($startcol + 0);

			$this->location_id = $rs->getInt($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpThemeHasLocation object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpThemeHasLocationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpThemeHasLocationPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpThemeHasLocationPeer::DATABASE_NAME);
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


												
			if ($this->aOpTheme !== null) {
				if ($this->aOpTheme->isModified()) {
					$affectedRows += $this->aOpTheme->save($con);
				}
				$this->setOpTheme($this->aOpTheme);
			}

			if ($this->aOpLocation !== null) {
				if ($this->aOpLocation->isModified()) {
					$affectedRows += $this->aOpLocation->save($con);
				}
				$this->setOpLocation($this->aOpLocation);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpThemeHasLocationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpThemeHasLocationPeer::doUpdate($this, $con);
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


												
			if ($this->aOpTheme !== null) {
				if (!$this->aOpTheme->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpTheme->getValidationFailures());
				}
			}

			if ($this->aOpLocation !== null) {
				if (!$this->aOpLocation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpLocation->getValidationFailures());
				}
			}


			if (($retval = OpThemeHasLocationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpThemeHasLocationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getThemeId();
				break;
			case 1:
				return $this->getLocationId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpThemeHasLocationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getThemeId(),
			$keys[1] => $this->getLocationId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpThemeHasLocationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setThemeId($value);
				break;
			case 1:
				$this->setLocationId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpThemeHasLocationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setThemeId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setLocationId($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpThemeHasLocationPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpThemeHasLocationPeer::THEME_ID)) $criteria->add(OpThemeHasLocationPeer::THEME_ID, $this->theme_id);
		if ($this->isColumnModified(OpThemeHasLocationPeer::LOCATION_ID)) $criteria->add(OpThemeHasLocationPeer::LOCATION_ID, $this->location_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpThemeHasLocationPeer::DATABASE_NAME);

		$criteria->add(OpThemeHasLocationPeer::THEME_ID, $this->theme_id);
		$criteria->add(OpThemeHasLocationPeer::LOCATION_ID, $this->location_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getThemeId();

		$pks[1] = $this->getLocationId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setThemeId($keys[0]);

		$this->setLocationId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setThemeId(NULL); 
		$copyObj->setLocationId(NULL); 
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
			self::$peer = new OpThemeHasLocationPeer();
		}
		return self::$peer;
	}

	
	public function setOpTheme($v)
	{


		if ($v === null) {
			$this->setThemeId(NULL);
		} else {
			$this->setThemeId($v->getContentId());
		}


		$this->aOpTheme = $v;
	}


	
	public function getOpTheme($con = null)
	{
		if ($this->aOpTheme === null && ($this->theme_id !== null)) {
						include_once 'lib/model/om/BaseOpThemePeer.php';

			$this->aOpTheme = OpThemePeer::retrieveByPK($this->theme_id, $con);

			
		}
		return $this->aOpTheme;
	}

	
	public function setOpLocation($v)
	{


		if ($v === null) {
			$this->setLocationId(NULL);
		} else {
			$this->setLocationId($v->getId());
		}


		$this->aOpLocation = $v;
	}


	
	public function getOpLocation($con = null)
	{
		if ($this->aOpLocation === null && ($this->location_id !== null)) {
						include_once 'lib/model/om/BaseOpLocationPeer.php';

			$this->aOpLocation = OpLocationPeer::retrieveByPK($this->location_id, $con);

			
		}
		return $this->aOpLocation;
	}

} 