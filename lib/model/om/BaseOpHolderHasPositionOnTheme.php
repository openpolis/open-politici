<?php


abstract class BaseOpHolderHasPositionOnTheme extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $theme_id;


	
	protected $party_id;


	
	protected $politician_id;


	
	protected $holder_type;


	
	protected $id;

	
	protected $aOpTheme;

	
	protected $aOpParty;

	
	protected $aOpPolitician;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getThemeId()
	{

		return $this->theme_id;
	}

	
	public function getPartyId()
	{

		return $this->party_id;
	}

	
	public function getPoliticianId()
	{

		return $this->politician_id;
	}

	
	public function getHolderType()
	{

		return $this->holder_type;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setThemeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->theme_id !== $v) {
			$this->theme_id = $v;
			$this->modifiedColumns[] = OpHolderHasPositionOnThemePeer::THEME_ID;
		}

		if ($this->aOpTheme !== null && $this->aOpTheme->getContentId() !== $v) {
			$this->aOpTheme = null;
		}

	} 
	
	public function setPartyId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->party_id !== $v) {
			$this->party_id = $v;
			$this->modifiedColumns[] = OpHolderHasPositionOnThemePeer::PARTY_ID;
		}

		if ($this->aOpParty !== null && $this->aOpParty->getId() !== $v) {
			$this->aOpParty = null;
		}

	} 
	
	public function setPoliticianId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->politician_id !== $v) {
			$this->politician_id = $v;
			$this->modifiedColumns[] = OpHolderHasPositionOnThemePeer::POLITICIAN_ID;
		}

		if ($this->aOpPolitician !== null && $this->aOpPolitician->getContentId() !== $v) {
			$this->aOpPolitician = null;
		}

	} 
	
	public function setHolderType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->holder_type !== $v) {
			$this->holder_type = $v;
			$this->modifiedColumns[] = OpHolderHasPositionOnThemePeer::HOLDER_TYPE;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpHolderHasPositionOnThemePeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->theme_id = $rs->getInt($startcol + 0);

			$this->party_id = $rs->getInt($startcol + 1);

			$this->politician_id = $rs->getInt($startcol + 2);

			$this->holder_type = $rs->getString($startcol + 3);

			$this->id = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpHolderHasPositionOnTheme object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpHolderHasPositionOnThemePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpHolderHasPositionOnThemePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpHolderHasPositionOnThemePeer::DATABASE_NAME);
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

			if ($this->aOpParty !== null) {
				if ($this->aOpParty->isModified()) {
					$affectedRows += $this->aOpParty->save($con);
				}
				$this->setOpParty($this->aOpParty);
			}

			if ($this->aOpPolitician !== null) {
				if ($this->aOpPolitician->isModified()) {
					$affectedRows += $this->aOpPolitician->save($con);
				}
				$this->setOpPolitician($this->aOpPolitician);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpHolderHasPositionOnThemePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpHolderHasPositionOnThemePeer::doUpdate($this, $con);
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

			if ($this->aOpParty !== null) {
				if (!$this->aOpParty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpParty->getValidationFailures());
				}
			}

			if ($this->aOpPolitician !== null) {
				if (!$this->aOpPolitician->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpPolitician->getValidationFailures());
				}
			}


			if (($retval = OpHolderHasPositionOnThemePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpHolderHasPositionOnThemePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getThemeId();
				break;
			case 1:
				return $this->getPartyId();
				break;
			case 2:
				return $this->getPoliticianId();
				break;
			case 3:
				return $this->getHolderType();
				break;
			case 4:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpHolderHasPositionOnThemePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getThemeId(),
			$keys[1] => $this->getPartyId(),
			$keys[2] => $this->getPoliticianId(),
			$keys[3] => $this->getHolderType(),
			$keys[4] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpHolderHasPositionOnThemePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setThemeId($value);
				break;
			case 1:
				$this->setPartyId($value);
				break;
			case 2:
				$this->setPoliticianId($value);
				break;
			case 3:
				$this->setHolderType($value);
				break;
			case 4:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpHolderHasPositionOnThemePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setThemeId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPartyId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPoliticianId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHolderType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setId($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpHolderHasPositionOnThemePeer::DATABASE_NAME);

		if ($this->isColumnModified(OpHolderHasPositionOnThemePeer::THEME_ID)) $criteria->add(OpHolderHasPositionOnThemePeer::THEME_ID, $this->theme_id);
		if ($this->isColumnModified(OpHolderHasPositionOnThemePeer::PARTY_ID)) $criteria->add(OpHolderHasPositionOnThemePeer::PARTY_ID, $this->party_id);
		if ($this->isColumnModified(OpHolderHasPositionOnThemePeer::POLITICIAN_ID)) $criteria->add(OpHolderHasPositionOnThemePeer::POLITICIAN_ID, $this->politician_id);
		if ($this->isColumnModified(OpHolderHasPositionOnThemePeer::HOLDER_TYPE)) $criteria->add(OpHolderHasPositionOnThemePeer::HOLDER_TYPE, $this->holder_type);
		if ($this->isColumnModified(OpHolderHasPositionOnThemePeer::ID)) $criteria->add(OpHolderHasPositionOnThemePeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpHolderHasPositionOnThemePeer::DATABASE_NAME);

		$criteria->add(OpHolderHasPositionOnThemePeer::ID, $this->id);

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

		$copyObj->setThemeId($this->theme_id);

		$copyObj->setPartyId($this->party_id);

		$copyObj->setPoliticianId($this->politician_id);

		$copyObj->setHolderType($this->holder_type);


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
			self::$peer = new OpHolderHasPositionOnThemePeer();
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

	
	public function setOpParty($v)
	{


		if ($v === null) {
			$this->setPartyId(NULL);
		} else {
			$this->setPartyId($v->getId());
		}


		$this->aOpParty = $v;
	}


	
	public function getOpParty($con = null)
	{
		if ($this->aOpParty === null && ($this->party_id !== null)) {
						include_once 'lib/model/om/BaseOpPartyPeer.php';

			$this->aOpParty = OpPartyPeer::retrieveByPK($this->party_id, $con);

			
		}
		return $this->aOpParty;
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

} 