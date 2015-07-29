<?php


abstract class BaseOpInstitutionCharge extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $content_id;


	
	protected $politician_id;


	
	protected $institution_id;


	
	protected $charge_type_id;


	
	protected $location_id;


	
	protected $constituency_id;


	
	protected $party_id = 1;


	
	protected $group_id = 1;


	
	protected $date_start;


	
	protected $date_end;


	
	protected $description;


	
	protected $minint_verified_at;

	
	protected $aOpOpenContent;

	
	protected $aOpPolitician;

	
	protected $aOpInstitution;

	
	protected $aOpChargeType;

	
	protected $aOpLocation;

	
	protected $aOpConstituency;

	
	protected $aOpParty;

	
	protected $aOpGroup;

	
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

	
	public function getInstitutionId()
	{

		return $this->institution_id;
	}

	
	public function getChargeTypeId()
	{

		return $this->charge_type_id;
	}

	
	public function getLocationId()
	{

		return $this->location_id;
	}

	
	public function getConstituencyId()
	{

		return $this->constituency_id;
	}

	
	public function getPartyId()
	{

		return $this->party_id;
	}

	
	public function getGroupId()
	{

		return $this->group_id;
	}

	
	public function getDateStart($format = 'Y-m-d')
	{

		if ($this->date_start === null || $this->date_start === '') {
			return null;
		} elseif (!is_int($this->date_start)) {
						$ts = strtotime($this->date_start);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [date_start] as date/time value: " . var_export($this->date_start, true));
			}
		} else {
			$ts = $this->date_start;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDateEnd($format = 'Y-m-d')
	{

		if ($this->date_end === null || $this->date_end === '') {
			return null;
		} elseif (!is_int($this->date_end)) {
						$ts = strtotime($this->date_end);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [date_end] as date/time value: " . var_export($this->date_end, true));
			}
		} else {
			$ts = $this->date_end;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getMinintVerifiedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->minint_verified_at === null || $this->minint_verified_at === '') {
			return null;
		} elseif (!is_int($this->minint_verified_at)) {
						$ts = strtotime($this->minint_verified_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [minint_verified_at] as date/time value: " . var_export($this->minint_verified_at, true));
			}
		} else {
			$ts = $this->minint_verified_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->content_id !== $v) {
			$this->content_id = $v;
			$this->modifiedColumns[] = OpInstitutionChargePeer::CONTENT_ID;
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
			$this->modifiedColumns[] = OpInstitutionChargePeer::POLITICIAN_ID;
		}

		if ($this->aOpPolitician !== null && $this->aOpPolitician->getContentId() !== $v) {
			$this->aOpPolitician = null;
		}

	} 
	
	public function setInstitutionId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->institution_id !== $v) {
			$this->institution_id = $v;
			$this->modifiedColumns[] = OpInstitutionChargePeer::INSTITUTION_ID;
		}

		if ($this->aOpInstitution !== null && $this->aOpInstitution->getId() !== $v) {
			$this->aOpInstitution = null;
		}

	} 
	
	public function setChargeTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->charge_type_id !== $v) {
			$this->charge_type_id = $v;
			$this->modifiedColumns[] = OpInstitutionChargePeer::CHARGE_TYPE_ID;
		}

		if ($this->aOpChargeType !== null && $this->aOpChargeType->getId() !== $v) {
			$this->aOpChargeType = null;
		}

	} 
	
	public function setLocationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_id !== $v) {
			$this->location_id = $v;
			$this->modifiedColumns[] = OpInstitutionChargePeer::LOCATION_ID;
		}

		if ($this->aOpLocation !== null && $this->aOpLocation->getId() !== $v) {
			$this->aOpLocation = null;
		}

	} 
	
	public function setConstituencyId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->constituency_id !== $v) {
			$this->constituency_id = $v;
			$this->modifiedColumns[] = OpInstitutionChargePeer::CONSTITUENCY_ID;
		}

		if ($this->aOpConstituency !== null && $this->aOpConstituency->getId() !== $v) {
			$this->aOpConstituency = null;
		}

	} 
	
	public function setPartyId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->party_id !== $v || $v === 1) {
			$this->party_id = $v;
			$this->modifiedColumns[] = OpInstitutionChargePeer::PARTY_ID;
		}

		if ($this->aOpParty !== null && $this->aOpParty->getId() !== $v) {
			$this->aOpParty = null;
		}

	} 
	
	public function setGroupId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->group_id !== $v || $v === 1) {
			$this->group_id = $v;
			$this->modifiedColumns[] = OpInstitutionChargePeer::GROUP_ID;
		}

		if ($this->aOpGroup !== null && $this->aOpGroup->getId() !== $v) {
			$this->aOpGroup = null;
		}

	} 
	
	public function setDateStart($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [date_start] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->date_start !== $ts) {
			$this->date_start = $ts;
			$this->modifiedColumns[] = OpInstitutionChargePeer::DATE_START;
		}

	} 
	
	public function setDateEnd($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [date_end] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->date_end !== $ts) {
			$this->date_end = $ts;
			$this->modifiedColumns[] = OpInstitutionChargePeer::DATE_END;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = OpInstitutionChargePeer::DESCRIPTION;
		}

	} 
	
	public function setMinintVerifiedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [minint_verified_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->minint_verified_at !== $ts) {
			$this->minint_verified_at = $ts;
			$this->modifiedColumns[] = OpInstitutionChargePeer::MININT_VERIFIED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->content_id = $rs->getInt($startcol + 0);

			$this->politician_id = $rs->getInt($startcol + 1);

			$this->institution_id = $rs->getInt($startcol + 2);

			$this->charge_type_id = $rs->getInt($startcol + 3);

			$this->location_id = $rs->getInt($startcol + 4);

			$this->constituency_id = $rs->getInt($startcol + 5);

			$this->party_id = $rs->getInt($startcol + 6);

			$this->group_id = $rs->getInt($startcol + 7);

			$this->date_start = $rs->getDate($startcol + 8, null);

			$this->date_end = $rs->getDate($startcol + 9, null);

			$this->description = $rs->getString($startcol + 10);

			$this->minint_verified_at = $rs->getTimestamp($startcol + 11, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpInstitutionCharge object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpInstitutionChargePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpInstitutionChargePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpInstitutionChargePeer::DATABASE_NAME);
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

			if ($this->aOpInstitution !== null) {
				if ($this->aOpInstitution->isModified()) {
					$affectedRows += $this->aOpInstitution->save($con);
				}
				$this->setOpInstitution($this->aOpInstitution);
			}

			if ($this->aOpChargeType !== null) {
				if ($this->aOpChargeType->isModified()) {
					$affectedRows += $this->aOpChargeType->save($con);
				}
				$this->setOpChargeType($this->aOpChargeType);
			}

			if ($this->aOpLocation !== null) {
				if ($this->aOpLocation->isModified()) {
					$affectedRows += $this->aOpLocation->save($con);
				}
				$this->setOpLocation($this->aOpLocation);
			}

			if ($this->aOpConstituency !== null) {
				if ($this->aOpConstituency->isModified()) {
					$affectedRows += $this->aOpConstituency->save($con);
				}
				$this->setOpConstituency($this->aOpConstituency);
			}

			if ($this->aOpParty !== null) {
				if ($this->aOpParty->isModified()) {
					$affectedRows += $this->aOpParty->save($con);
				}
				$this->setOpParty($this->aOpParty);
			}

			if ($this->aOpGroup !== null) {
				if ($this->aOpGroup->isModified()) {
					$affectedRows += $this->aOpGroup->save($con);
				}
				$this->setOpGroup($this->aOpGroup);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpInstitutionChargePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpInstitutionChargePeer::doUpdate($this, $con);
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

			if ($this->aOpInstitution !== null) {
				if (!$this->aOpInstitution->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpInstitution->getValidationFailures());
				}
			}

			if ($this->aOpChargeType !== null) {
				if (!$this->aOpChargeType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpChargeType->getValidationFailures());
				}
			}

			if ($this->aOpLocation !== null) {
				if (!$this->aOpLocation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpLocation->getValidationFailures());
				}
			}

			if ($this->aOpConstituency !== null) {
				if (!$this->aOpConstituency->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpConstituency->getValidationFailures());
				}
			}

			if ($this->aOpParty !== null) {
				if (!$this->aOpParty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpParty->getValidationFailures());
				}
			}

			if ($this->aOpGroup !== null) {
				if (!$this->aOpGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpGroup->getValidationFailures());
				}
			}


			if (($retval = OpInstitutionChargePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpInstitutionChargePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getInstitutionId();
				break;
			case 3:
				return $this->getChargeTypeId();
				break;
			case 4:
				return $this->getLocationId();
				break;
			case 5:
				return $this->getConstituencyId();
				break;
			case 6:
				return $this->getPartyId();
				break;
			case 7:
				return $this->getGroupId();
				break;
			case 8:
				return $this->getDateStart();
				break;
			case 9:
				return $this->getDateEnd();
				break;
			case 10:
				return $this->getDescription();
				break;
			case 11:
				return $this->getMinintVerifiedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpInstitutionChargePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getContentId(),
			$keys[1] => $this->getPoliticianId(),
			$keys[2] => $this->getInstitutionId(),
			$keys[3] => $this->getChargeTypeId(),
			$keys[4] => $this->getLocationId(),
			$keys[5] => $this->getConstituencyId(),
			$keys[6] => $this->getPartyId(),
			$keys[7] => $this->getGroupId(),
			$keys[8] => $this->getDateStart(),
			$keys[9] => $this->getDateEnd(),
			$keys[10] => $this->getDescription(),
			$keys[11] => $this->getMinintVerifiedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpInstitutionChargePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setInstitutionId($value);
				break;
			case 3:
				$this->setChargeTypeId($value);
				break;
			case 4:
				$this->setLocationId($value);
				break;
			case 5:
				$this->setConstituencyId($value);
				break;
			case 6:
				$this->setPartyId($value);
				break;
			case 7:
				$this->setGroupId($value);
				break;
			case 8:
				$this->setDateStart($value);
				break;
			case 9:
				$this->setDateEnd($value);
				break;
			case 10:
				$this->setDescription($value);
				break;
			case 11:
				$this->setMinintVerifiedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpInstitutionChargePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setContentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPoliticianId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setInstitutionId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setChargeTypeId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLocationId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setConstituencyId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPartyId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setGroupId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDateStart($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDateEnd($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDescription($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setMinintVerifiedAt($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpInstitutionChargePeer::DATABASE_NAME);

		if ($this->isColumnModified(OpInstitutionChargePeer::CONTENT_ID)) $criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->content_id);
		if ($this->isColumnModified(OpInstitutionChargePeer::POLITICIAN_ID)) $criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->politician_id);
		if ($this->isColumnModified(OpInstitutionChargePeer::INSTITUTION_ID)) $criteria->add(OpInstitutionChargePeer::INSTITUTION_ID, $this->institution_id);
		if ($this->isColumnModified(OpInstitutionChargePeer::CHARGE_TYPE_ID)) $criteria->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, $this->charge_type_id);
		if ($this->isColumnModified(OpInstitutionChargePeer::LOCATION_ID)) $criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->location_id);
		if ($this->isColumnModified(OpInstitutionChargePeer::CONSTITUENCY_ID)) $criteria->add(OpInstitutionChargePeer::CONSTITUENCY_ID, $this->constituency_id);
		if ($this->isColumnModified(OpInstitutionChargePeer::PARTY_ID)) $criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->party_id);
		if ($this->isColumnModified(OpInstitutionChargePeer::GROUP_ID)) $criteria->add(OpInstitutionChargePeer::GROUP_ID, $this->group_id);
		if ($this->isColumnModified(OpInstitutionChargePeer::DATE_START)) $criteria->add(OpInstitutionChargePeer::DATE_START, $this->date_start);
		if ($this->isColumnModified(OpInstitutionChargePeer::DATE_END)) $criteria->add(OpInstitutionChargePeer::DATE_END, $this->date_end);
		if ($this->isColumnModified(OpInstitutionChargePeer::DESCRIPTION)) $criteria->add(OpInstitutionChargePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(OpInstitutionChargePeer::MININT_VERIFIED_AT)) $criteria->add(OpInstitutionChargePeer::MININT_VERIFIED_AT, $this->minint_verified_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpInstitutionChargePeer::DATABASE_NAME);

		$criteria->add(OpInstitutionChargePeer::CONTENT_ID, $this->content_id);

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

		$copyObj->setInstitutionId($this->institution_id);

		$copyObj->setChargeTypeId($this->charge_type_id);

		$copyObj->setLocationId($this->location_id);

		$copyObj->setConstituencyId($this->constituency_id);

		$copyObj->setPartyId($this->party_id);

		$copyObj->setGroupId($this->group_id);

		$copyObj->setDateStart($this->date_start);

		$copyObj->setDateEnd($this->date_end);

		$copyObj->setDescription($this->description);

		$copyObj->setMinintVerifiedAt($this->minint_verified_at);


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
			self::$peer = new OpInstitutionChargePeer();
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

	
	public function setOpInstitution($v)
	{


		if ($v === null) {
			$this->setInstitutionId(NULL);
		} else {
			$this->setInstitutionId($v->getId());
		}


		$this->aOpInstitution = $v;
	}


	
	public function getOpInstitution($con = null)
	{
		if ($this->aOpInstitution === null && ($this->institution_id !== null)) {
						include_once 'lib/model/om/BaseOpInstitutionPeer.php';

			$this->aOpInstitution = OpInstitutionPeer::retrieveByPK($this->institution_id, $con);

			
		}
		return $this->aOpInstitution;
	}

	
	public function setOpChargeType($v)
	{


		if ($v === null) {
			$this->setChargeTypeId(NULL);
		} else {
			$this->setChargeTypeId($v->getId());
		}


		$this->aOpChargeType = $v;
	}


	
	public function getOpChargeType($con = null)
	{
		if ($this->aOpChargeType === null && ($this->charge_type_id !== null)) {
						include_once 'lib/model/om/BaseOpChargeTypePeer.php';

			$this->aOpChargeType = OpChargeTypePeer::retrieveByPK($this->charge_type_id, $con);

			
		}
		return $this->aOpChargeType;
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

	
	public function setOpConstituency($v)
	{


		if ($v === null) {
			$this->setConstituencyId(NULL);
		} else {
			$this->setConstituencyId($v->getId());
		}


		$this->aOpConstituency = $v;
	}


	
	public function getOpConstituency($con = null)
	{
		if ($this->aOpConstituency === null && ($this->constituency_id !== null)) {
						include_once 'lib/model/om/BaseOpConstituencyPeer.php';

			$this->aOpConstituency = OpConstituencyPeer::retrieveByPK($this->constituency_id, $con);

			
		}
		return $this->aOpConstituency;
	}

	
	public function setOpParty($v)
	{


		if ($v === null) {
			$this->setPartyId('1');
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

	
	public function setOpGroup($v)
	{


		if ($v === null) {
			$this->setGroupId('1');
		} else {
			$this->setGroupId($v->getId());
		}


		$this->aOpGroup = $v;
	}


	
	public function getOpGroup($con = null)
	{
		if ($this->aOpGroup === null && ($this->group_id !== null)) {
						include_once 'lib/model/om/BaseOpGroupPeer.php';

			$this->aOpGroup = OpGroupPeer::retrieveByPK($this->group_id, $con);

			
		}
		return $this->aOpGroup;
	}

} 