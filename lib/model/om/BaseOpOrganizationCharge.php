<?php


abstract class BaseOpOrganizationCharge extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $content_id;


	
	protected $politician_id;


	
	protected $date_start;


	
	protected $date_end;


	
	protected $charge_name;


	
	protected $organization_id;


	
	protected $current;

	
	protected $aOpOpenContent;

	
	protected $aOpPolitician;

	
	protected $aOpOrganization;

	
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

	
	public function getChargeName()
	{

		return $this->charge_name;
	}

	
	public function getOrganizationId()
	{

		return $this->organization_id;
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
			$this->modifiedColumns[] = OpOrganizationChargePeer::CONTENT_ID;
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
			$this->modifiedColumns[] = OpOrganizationChargePeer::POLITICIAN_ID;
		}

		if ($this->aOpPolitician !== null && $this->aOpPolitician->getContentId() !== $v) {
			$this->aOpPolitician = null;
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
			$this->modifiedColumns[] = OpOrganizationChargePeer::DATE_START;
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
			$this->modifiedColumns[] = OpOrganizationChargePeer::DATE_END;
		}

	} 
	
	public function setChargeName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->charge_name !== $v) {
			$this->charge_name = $v;
			$this->modifiedColumns[] = OpOrganizationChargePeer::CHARGE_NAME;
		}

	} 
	
	public function setOrganizationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->organization_id !== $v) {
			$this->organization_id = $v;
			$this->modifiedColumns[] = OpOrganizationChargePeer::ORGANIZATION_ID;
		}

		if ($this->aOpOrganization !== null && $this->aOpOrganization->getId() !== $v) {
			$this->aOpOrganization = null;
		}

	} 
	
	public function setCurrent($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->current !== $v) {
			$this->current = $v;
			$this->modifiedColumns[] = OpOrganizationChargePeer::CURRENT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->content_id = $rs->getInt($startcol + 0);

			$this->politician_id = $rs->getInt($startcol + 1);

			$this->date_start = $rs->getDate($startcol + 2, null);

			$this->date_end = $rs->getDate($startcol + 3, null);

			$this->charge_name = $rs->getString($startcol + 4);

			$this->organization_id = $rs->getInt($startcol + 5);

			$this->current = $rs->getInt($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpOrganizationCharge object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpOrganizationChargePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpOrganizationChargePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpOrganizationChargePeer::DATABASE_NAME);
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

			if ($this->aOpOrganization !== null) {
				if ($this->aOpOrganization->isModified()) {
					$affectedRows += $this->aOpOrganization->save($con);
				}
				$this->setOpOrganization($this->aOpOrganization);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpOrganizationChargePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpOrganizationChargePeer::doUpdate($this, $con);
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

			if ($this->aOpOrganization !== null) {
				if (!$this->aOpOrganization->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpOrganization->getValidationFailures());
				}
			}


			if (($retval = OpOrganizationChargePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpOrganizationChargePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDateStart();
				break;
			case 3:
				return $this->getDateEnd();
				break;
			case 4:
				return $this->getChargeName();
				break;
			case 5:
				return $this->getOrganizationId();
				break;
			case 6:
				return $this->getCurrent();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpOrganizationChargePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getContentId(),
			$keys[1] => $this->getPoliticianId(),
			$keys[2] => $this->getDateStart(),
			$keys[3] => $this->getDateEnd(),
			$keys[4] => $this->getChargeName(),
			$keys[5] => $this->getOrganizationId(),
			$keys[6] => $this->getCurrent(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpOrganizationChargePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDateStart($value);
				break;
			case 3:
				$this->setDateEnd($value);
				break;
			case 4:
				$this->setChargeName($value);
				break;
			case 5:
				$this->setOrganizationId($value);
				break;
			case 6:
				$this->setCurrent($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpOrganizationChargePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setContentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPoliticianId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDateStart($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDateEnd($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setChargeName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setOrganizationId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCurrent($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpOrganizationChargePeer::DATABASE_NAME);

		if ($this->isColumnModified(OpOrganizationChargePeer::CONTENT_ID)) $criteria->add(OpOrganizationChargePeer::CONTENT_ID, $this->content_id);
		if ($this->isColumnModified(OpOrganizationChargePeer::POLITICIAN_ID)) $criteria->add(OpOrganizationChargePeer::POLITICIAN_ID, $this->politician_id);
		if ($this->isColumnModified(OpOrganizationChargePeer::DATE_START)) $criteria->add(OpOrganizationChargePeer::DATE_START, $this->date_start);
		if ($this->isColumnModified(OpOrganizationChargePeer::DATE_END)) $criteria->add(OpOrganizationChargePeer::DATE_END, $this->date_end);
		if ($this->isColumnModified(OpOrganizationChargePeer::CHARGE_NAME)) $criteria->add(OpOrganizationChargePeer::CHARGE_NAME, $this->charge_name);
		if ($this->isColumnModified(OpOrganizationChargePeer::ORGANIZATION_ID)) $criteria->add(OpOrganizationChargePeer::ORGANIZATION_ID, $this->organization_id);
		if ($this->isColumnModified(OpOrganizationChargePeer::CURRENT)) $criteria->add(OpOrganizationChargePeer::CURRENT, $this->current);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpOrganizationChargePeer::DATABASE_NAME);

		$criteria->add(OpOrganizationChargePeer::CONTENT_ID, $this->content_id);

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

		$copyObj->setDateStart($this->date_start);

		$copyObj->setDateEnd($this->date_end);

		$copyObj->setChargeName($this->charge_name);

		$copyObj->setOrganizationId($this->organization_id);

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
			self::$peer = new OpOrganizationChargePeer();
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

} 