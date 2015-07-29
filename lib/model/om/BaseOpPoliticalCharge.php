<?php


abstract class BaseOpPoliticalCharge extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $content_id;


	
	protected $charge_type_id;


	
	protected $politician_id;


	
	protected $location_id;


	
	protected $party_id;


	
	protected $date_start;


	
	protected $date_end;


	
	protected $description;


	
	protected $current;

	
	protected $aOpOpenContent;

	
	protected $aOpChargeType;

	
	protected $aOpPolitician;

	
	protected $aOpLocation;

	
	protected $aOpParty;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getContentId()
	{

		return $this->content_id;
	}

	
	public function getChargeTypeId()
	{

		return $this->charge_type_id;
	}

	
	public function getPoliticianId()
	{

		return $this->politician_id;
	}

	
	public function getLocationId()
	{

		return $this->location_id;
	}

	
	public function getPartyId()
	{

		return $this->party_id;
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

	
	public function getCurrent()
	{

		return $this->current;
	}

	
	public function setContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->content_id !== $v) {
			$this->content_id = $v;
			$this->modifiedColumns[] = OpPoliticalChargePeer::CONTENT_ID;
		}

		if ($this->aOpOpenContent !== null && $this->aOpOpenContent->getContentId() !== $v) {
			$this->aOpOpenContent = null;
		}

	} 
	
	public function setChargeTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->charge_type_id !== $v) {
			$this->charge_type_id = $v;
			$this->modifiedColumns[] = OpPoliticalChargePeer::CHARGE_TYPE_ID;
		}

		if ($this->aOpChargeType !== null && $this->aOpChargeType->getId() !== $v) {
			$this->aOpChargeType = null;
		}

	} 
	
	public function setPoliticianId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->politician_id !== $v) {
			$this->politician_id = $v;
			$this->modifiedColumns[] = OpPoliticalChargePeer::POLITICIAN_ID;
		}

		if ($this->aOpPolitician !== null && $this->aOpPolitician->getContentId() !== $v) {
			$this->aOpPolitician = null;
		}

	} 
	
	public function setLocationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_id !== $v) {
			$this->location_id = $v;
			$this->modifiedColumns[] = OpPoliticalChargePeer::LOCATION_ID;
		}

		if ($this->aOpLocation !== null && $this->aOpLocation->getId() !== $v) {
			$this->aOpLocation = null;
		}

	} 
	
	public function setPartyId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->party_id !== $v) {
			$this->party_id = $v;
			$this->modifiedColumns[] = OpPoliticalChargePeer::PARTY_ID;
		}

		if ($this->aOpParty !== null && $this->aOpParty->getId() !== $v) {
			$this->aOpParty = null;
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
			$this->modifiedColumns[] = OpPoliticalChargePeer::DATE_START;
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
			$this->modifiedColumns[] = OpPoliticalChargePeer::DATE_END;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = OpPoliticalChargePeer::DESCRIPTION;
		}

	} 
	
	public function setCurrent($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->current !== $v) {
			$this->current = $v;
			$this->modifiedColumns[] = OpPoliticalChargePeer::CURRENT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->content_id = $rs->getInt($startcol + 0);

			$this->charge_type_id = $rs->getInt($startcol + 1);

			$this->politician_id = $rs->getInt($startcol + 2);

			$this->location_id = $rs->getInt($startcol + 3);

			$this->party_id = $rs->getInt($startcol + 4);

			$this->date_start = $rs->getDate($startcol + 5, null);

			$this->date_end = $rs->getDate($startcol + 6, null);

			$this->description = $rs->getString($startcol + 7);

			$this->current = $rs->getInt($startcol + 8);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpPoliticalCharge object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpPoliticalChargePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpPoliticalChargePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpPoliticalChargePeer::DATABASE_NAME);
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

			if ($this->aOpChargeType !== null) {
				if ($this->aOpChargeType->isModified()) {
					$affectedRows += $this->aOpChargeType->save($con);
				}
				$this->setOpChargeType($this->aOpChargeType);
			}

			if ($this->aOpPolitician !== null) {
				if ($this->aOpPolitician->isModified()) {
					$affectedRows += $this->aOpPolitician->save($con);
				}
				$this->setOpPolitician($this->aOpPolitician);
			}

			if ($this->aOpLocation !== null) {
				if ($this->aOpLocation->isModified()) {
					$affectedRows += $this->aOpLocation->save($con);
				}
				$this->setOpLocation($this->aOpLocation);
			}

			if ($this->aOpParty !== null) {
				if ($this->aOpParty->isModified()) {
					$affectedRows += $this->aOpParty->save($con);
				}
				$this->setOpParty($this->aOpParty);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpPoliticalChargePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpPoliticalChargePeer::doUpdate($this, $con);
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

			if ($this->aOpChargeType !== null) {
				if (!$this->aOpChargeType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpChargeType->getValidationFailures());
				}
			}

			if ($this->aOpPolitician !== null) {
				if (!$this->aOpPolitician->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpPolitician->getValidationFailures());
				}
			}

			if ($this->aOpLocation !== null) {
				if (!$this->aOpLocation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpLocation->getValidationFailures());
				}
			}

			if ($this->aOpParty !== null) {
				if (!$this->aOpParty->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpParty->getValidationFailures());
				}
			}


			if (($retval = OpPoliticalChargePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpPoliticalChargePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getContentId();
				break;
			case 1:
				return $this->getChargeTypeId();
				break;
			case 2:
				return $this->getPoliticianId();
				break;
			case 3:
				return $this->getLocationId();
				break;
			case 4:
				return $this->getPartyId();
				break;
			case 5:
				return $this->getDateStart();
				break;
			case 6:
				return $this->getDateEnd();
				break;
			case 7:
				return $this->getDescription();
				break;
			case 8:
				return $this->getCurrent();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpPoliticalChargePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getContentId(),
			$keys[1] => $this->getChargeTypeId(),
			$keys[2] => $this->getPoliticianId(),
			$keys[3] => $this->getLocationId(),
			$keys[4] => $this->getPartyId(),
			$keys[5] => $this->getDateStart(),
			$keys[6] => $this->getDateEnd(),
			$keys[7] => $this->getDescription(),
			$keys[8] => $this->getCurrent(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpPoliticalChargePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setContentId($value);
				break;
			case 1:
				$this->setChargeTypeId($value);
				break;
			case 2:
				$this->setPoliticianId($value);
				break;
			case 3:
				$this->setLocationId($value);
				break;
			case 4:
				$this->setPartyId($value);
				break;
			case 5:
				$this->setDateStart($value);
				break;
			case 6:
				$this->setDateEnd($value);
				break;
			case 7:
				$this->setDescription($value);
				break;
			case 8:
				$this->setCurrent($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpPoliticalChargePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setContentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setChargeTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPoliticianId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLocationId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPartyId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDateStart($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDateEnd($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDescription($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCurrent($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpPoliticalChargePeer::DATABASE_NAME);

		if ($this->isColumnModified(OpPoliticalChargePeer::CONTENT_ID)) $criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->content_id);
		if ($this->isColumnModified(OpPoliticalChargePeer::CHARGE_TYPE_ID)) $criteria->add(OpPoliticalChargePeer::CHARGE_TYPE_ID, $this->charge_type_id);
		if ($this->isColumnModified(OpPoliticalChargePeer::POLITICIAN_ID)) $criteria->add(OpPoliticalChargePeer::POLITICIAN_ID, $this->politician_id);
		if ($this->isColumnModified(OpPoliticalChargePeer::LOCATION_ID)) $criteria->add(OpPoliticalChargePeer::LOCATION_ID, $this->location_id);
		if ($this->isColumnModified(OpPoliticalChargePeer::PARTY_ID)) $criteria->add(OpPoliticalChargePeer::PARTY_ID, $this->party_id);
		if ($this->isColumnModified(OpPoliticalChargePeer::DATE_START)) $criteria->add(OpPoliticalChargePeer::DATE_START, $this->date_start);
		if ($this->isColumnModified(OpPoliticalChargePeer::DATE_END)) $criteria->add(OpPoliticalChargePeer::DATE_END, $this->date_end);
		if ($this->isColumnModified(OpPoliticalChargePeer::DESCRIPTION)) $criteria->add(OpPoliticalChargePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(OpPoliticalChargePeer::CURRENT)) $criteria->add(OpPoliticalChargePeer::CURRENT, $this->current);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpPoliticalChargePeer::DATABASE_NAME);

		$criteria->add(OpPoliticalChargePeer::CONTENT_ID, $this->content_id);

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

		$copyObj->setChargeTypeId($this->charge_type_id);

		$copyObj->setPoliticianId($this->politician_id);

		$copyObj->setLocationId($this->location_id);

		$copyObj->setPartyId($this->party_id);

		$copyObj->setDateStart($this->date_start);

		$copyObj->setDateEnd($this->date_end);

		$copyObj->setDescription($this->description);

		$copyObj->setCurrent($this->current);


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
			self::$peer = new OpPoliticalChargePeer();
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