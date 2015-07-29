<?php


abstract class BaseOpThemeHasDeclaration extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $declaration_id;


	
	protected $theme_id;


	
	protected $party_id;


	
	protected $position = 0;


	
	protected $created_at;

	
	protected $aOpDeclaration;

	
	protected $aOpTheme;

	
	protected $aOpParty;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getDeclarationId()
	{

		return $this->declaration_id;
	}

	
	public function getThemeId()
	{

		return $this->theme_id;
	}

	
	public function getPartyId()
	{

		return $this->party_id;
	}

	
	public function getPosition()
	{

		return $this->position;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setDeclarationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->declaration_id !== $v) {
			$this->declaration_id = $v;
			$this->modifiedColumns[] = OpThemeHasDeclarationPeer::DECLARATION_ID;
		}

		if ($this->aOpDeclaration !== null && $this->aOpDeclaration->getContentId() !== $v) {
			$this->aOpDeclaration = null;
		}

	} 
	
	public function setThemeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->theme_id !== $v) {
			$this->theme_id = $v;
			$this->modifiedColumns[] = OpThemeHasDeclarationPeer::THEME_ID;
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
			$this->modifiedColumns[] = OpThemeHasDeclarationPeer::PARTY_ID;
		}

		if ($this->aOpParty !== null && $this->aOpParty->getId() !== $v) {
			$this->aOpParty = null;
		}

	} 
	
	public function setPosition($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->position !== $v || $v === 0) {
			$this->position = $v;
			$this->modifiedColumns[] = OpThemeHasDeclarationPeer::POSITION;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = OpThemeHasDeclarationPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->declaration_id = $rs->getInt($startcol + 0);

			$this->theme_id = $rs->getInt($startcol + 1);

			$this->party_id = $rs->getInt($startcol + 2);

			$this->position = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpThemeHasDeclaration object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpThemeHasDeclarationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpThemeHasDeclarationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpThemeHasDeclarationPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpThemeHasDeclarationPeer::DATABASE_NAME);
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


												
			if ($this->aOpDeclaration !== null) {
				if ($this->aOpDeclaration->isModified()) {
					$affectedRows += $this->aOpDeclaration->save($con);
				}
				$this->setOpDeclaration($this->aOpDeclaration);
			}

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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpThemeHasDeclarationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpThemeHasDeclarationPeer::doUpdate($this, $con);
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


												
			if ($this->aOpDeclaration !== null) {
				if (!$this->aOpDeclaration->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpDeclaration->getValidationFailures());
				}
			}

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


			if (($retval = OpThemeHasDeclarationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpThemeHasDeclarationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getDeclarationId();
				break;
			case 1:
				return $this->getThemeId();
				break;
			case 2:
				return $this->getPartyId();
				break;
			case 3:
				return $this->getPosition();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpThemeHasDeclarationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getDeclarationId(),
			$keys[1] => $this->getThemeId(),
			$keys[2] => $this->getPartyId(),
			$keys[3] => $this->getPosition(),
			$keys[4] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpThemeHasDeclarationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setDeclarationId($value);
				break;
			case 1:
				$this->setThemeId($value);
				break;
			case 2:
				$this->setPartyId($value);
				break;
			case 3:
				$this->setPosition($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpThemeHasDeclarationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setDeclarationId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setThemeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPartyId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPosition($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpThemeHasDeclarationPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpThemeHasDeclarationPeer::DECLARATION_ID)) $criteria->add(OpThemeHasDeclarationPeer::DECLARATION_ID, $this->declaration_id);
		if ($this->isColumnModified(OpThemeHasDeclarationPeer::THEME_ID)) $criteria->add(OpThemeHasDeclarationPeer::THEME_ID, $this->theme_id);
		if ($this->isColumnModified(OpThemeHasDeclarationPeer::PARTY_ID)) $criteria->add(OpThemeHasDeclarationPeer::PARTY_ID, $this->party_id);
		if ($this->isColumnModified(OpThemeHasDeclarationPeer::POSITION)) $criteria->add(OpThemeHasDeclarationPeer::POSITION, $this->position);
		if ($this->isColumnModified(OpThemeHasDeclarationPeer::CREATED_AT)) $criteria->add(OpThemeHasDeclarationPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpThemeHasDeclarationPeer::DATABASE_NAME);

		$criteria->add(OpThemeHasDeclarationPeer::DECLARATION_ID, $this->declaration_id);
		$criteria->add(OpThemeHasDeclarationPeer::THEME_ID, $this->theme_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getDeclarationId();

		$pks[1] = $this->getThemeId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setDeclarationId($keys[0]);

		$this->setThemeId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPartyId($this->party_id);

		$copyObj->setPosition($this->position);

		$copyObj->setCreatedAt($this->created_at);


		$copyObj->setNew(true);

		$copyObj->setDeclarationId(NULL); 
		$copyObj->setThemeId(NULL); 
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
			self::$peer = new OpThemeHasDeclarationPeer();
		}
		return self::$peer;
	}

	
	public function setOpDeclaration($v)
	{


		if ($v === null) {
			$this->setDeclarationId(NULL);
		} else {
			$this->setDeclarationId($v->getContentId());
		}


		$this->aOpDeclaration = $v;
	}


	
	public function getOpDeclaration($con = null)
	{
		if ($this->aOpDeclaration === null && ($this->declaration_id !== null)) {
						include_once 'lib/model/om/BaseOpDeclarationPeer.php';

			$this->aOpDeclaration = OpDeclarationPeer::retrieveByPK($this->declaration_id, $con);

			
		}
		return $this->aOpDeclaration;
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

} 