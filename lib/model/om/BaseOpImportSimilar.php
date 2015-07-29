<?php


abstract class BaseOpImportSimilar extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $new_csv_rec;


	
	protected $old_csv_rec;


	
	protected $context;


	
	protected $location_id;


	
	protected $created_at;


	
	protected $deleted_at;


	
	protected $deleting_user_id;


	
	protected $n_diffs;


	
	protected $charges_differ;


	
	protected $names_differ;


	
	protected $birth_dates_differ;


	
	protected $birth_places_differ;


	
	protected $id;

	
	protected $aOpLocation;

	
	protected $aOpUser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getNewCsvRec()
	{

		return $this->new_csv_rec;
	}

	
	public function getOldCsvRec()
	{

		return $this->old_csv_rec;
	}

	
	public function getContext()
	{

		return $this->context;
	}

	
	public function getLocationId()
	{

		return $this->location_id;
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

	
	public function getDeletedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->deleted_at === null || $this->deleted_at === '') {
			return null;
		} elseif (!is_int($this->deleted_at)) {
						$ts = strtotime($this->deleted_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [deleted_at] as date/time value: " . var_export($this->deleted_at, true));
			}
		} else {
			$ts = $this->deleted_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDeletingUserId()
	{

		return $this->deleting_user_id;
	}

	
	public function getNDiffs()
	{

		return $this->n_diffs;
	}

	
	public function getChargesDiffer()
	{

		return $this->charges_differ;
	}

	
	public function getNamesDiffer()
	{

		return $this->names_differ;
	}

	
	public function getBirthDatesDiffer()
	{

		return $this->birth_dates_differ;
	}

	
	public function getBirthPlacesDiffer()
	{

		return $this->birth_places_differ;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setNewCsvRec($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->new_csv_rec !== $v) {
			$this->new_csv_rec = $v;
			$this->modifiedColumns[] = OpImportSimilarPeer::NEW_CSV_REC;
		}

	} 
	
	public function setOldCsvRec($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->old_csv_rec !== $v) {
			$this->old_csv_rec = $v;
			$this->modifiedColumns[] = OpImportSimilarPeer::OLD_CSV_REC;
		}

	} 
	
	public function setContext($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->context !== $v) {
			$this->context = $v;
			$this->modifiedColumns[] = OpImportSimilarPeer::CONTEXT;
		}

	} 
	
	public function setLocationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_id !== $v) {
			$this->location_id = $v;
			$this->modifiedColumns[] = OpImportSimilarPeer::LOCATION_ID;
		}

		if ($this->aOpLocation !== null && $this->aOpLocation->getId() !== $v) {
			$this->aOpLocation = null;
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
			$this->modifiedColumns[] = OpImportSimilarPeer::CREATED_AT;
		}

	} 
	
	public function setDeletedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [deleted_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->deleted_at !== $ts) {
			$this->deleted_at = $ts;
			$this->modifiedColumns[] = OpImportSimilarPeer::DELETED_AT;
		}

	} 
	
	public function setDeletingUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deleting_user_id !== $v) {
			$this->deleting_user_id = $v;
			$this->modifiedColumns[] = OpImportSimilarPeer::DELETING_USER_ID;
		}

		if ($this->aOpUser !== null && $this->aOpUser->getId() !== $v) {
			$this->aOpUser = null;
		}

	} 
	
	public function setNDiffs($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->n_diffs !== $v) {
			$this->n_diffs = $v;
			$this->modifiedColumns[] = OpImportSimilarPeer::N_DIFFS;
		}

	} 
	
	public function setChargesDiffer($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->charges_differ !== $v) {
			$this->charges_differ = $v;
			$this->modifiedColumns[] = OpImportSimilarPeer::CHARGES_DIFFER;
		}

	} 
	
	public function setNamesDiffer($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->names_differ !== $v) {
			$this->names_differ = $v;
			$this->modifiedColumns[] = OpImportSimilarPeer::NAMES_DIFFER;
		}

	} 
	
	public function setBirthDatesDiffer($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->birth_dates_differ !== $v) {
			$this->birth_dates_differ = $v;
			$this->modifiedColumns[] = OpImportSimilarPeer::BIRTH_DATES_DIFFER;
		}

	} 
	
	public function setBirthPlacesDiffer($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->birth_places_differ !== $v) {
			$this->birth_places_differ = $v;
			$this->modifiedColumns[] = OpImportSimilarPeer::BIRTH_PLACES_DIFFER;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpImportSimilarPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->new_csv_rec = $rs->getString($startcol + 0);

			$this->old_csv_rec = $rs->getString($startcol + 1);

			$this->context = $rs->getString($startcol + 2);

			$this->location_id = $rs->getInt($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->deleted_at = $rs->getTimestamp($startcol + 5, null);

			$this->deleting_user_id = $rs->getInt($startcol + 6);

			$this->n_diffs = $rs->getInt($startcol + 7);

			$this->charges_differ = $rs->getInt($startcol + 8);

			$this->names_differ = $rs->getInt($startcol + 9);

			$this->birth_dates_differ = $rs->getInt($startcol + 10);

			$this->birth_places_differ = $rs->getInt($startcol + 11);

			$this->id = $rs->getInt($startcol + 12);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpImportSimilar object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpImportSimilarPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpImportSimilarPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpImportSimilarPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpImportSimilarPeer::DATABASE_NAME);
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


												
			if ($this->aOpLocation !== null) {
				if ($this->aOpLocation->isModified()) {
					$affectedRows += $this->aOpLocation->save($con);
				}
				$this->setOpLocation($this->aOpLocation);
			}

			if ($this->aOpUser !== null) {
				if ($this->aOpUser->isModified()) {
					$affectedRows += $this->aOpUser->save($con);
				}
				$this->setOpUser($this->aOpUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpImportSimilarPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpImportSimilarPeer::doUpdate($this, $con);
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


												
			if ($this->aOpLocation !== null) {
				if (!$this->aOpLocation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpLocation->getValidationFailures());
				}
			}

			if ($this->aOpUser !== null) {
				if (!$this->aOpUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUser->getValidationFailures());
				}
			}


			if (($retval = OpImportSimilarPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpImportSimilarPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getNewCsvRec();
				break;
			case 1:
				return $this->getOldCsvRec();
				break;
			case 2:
				return $this->getContext();
				break;
			case 3:
				return $this->getLocationId();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getDeletedAt();
				break;
			case 6:
				return $this->getDeletingUserId();
				break;
			case 7:
				return $this->getNDiffs();
				break;
			case 8:
				return $this->getChargesDiffer();
				break;
			case 9:
				return $this->getNamesDiffer();
				break;
			case 10:
				return $this->getBirthDatesDiffer();
				break;
			case 11:
				return $this->getBirthPlacesDiffer();
				break;
			case 12:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpImportSimilarPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getNewCsvRec(),
			$keys[1] => $this->getOldCsvRec(),
			$keys[2] => $this->getContext(),
			$keys[3] => $this->getLocationId(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getDeletedAt(),
			$keys[6] => $this->getDeletingUserId(),
			$keys[7] => $this->getNDiffs(),
			$keys[8] => $this->getChargesDiffer(),
			$keys[9] => $this->getNamesDiffer(),
			$keys[10] => $this->getBirthDatesDiffer(),
			$keys[11] => $this->getBirthPlacesDiffer(),
			$keys[12] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpImportSimilarPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setNewCsvRec($value);
				break;
			case 1:
				$this->setOldCsvRec($value);
				break;
			case 2:
				$this->setContext($value);
				break;
			case 3:
				$this->setLocationId($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setDeletedAt($value);
				break;
			case 6:
				$this->setDeletingUserId($value);
				break;
			case 7:
				$this->setNDiffs($value);
				break;
			case 8:
				$this->setChargesDiffer($value);
				break;
			case 9:
				$this->setNamesDiffer($value);
				break;
			case 10:
				$this->setBirthDatesDiffer($value);
				break;
			case 11:
				$this->setBirthPlacesDiffer($value);
				break;
			case 12:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpImportSimilarPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setNewCsvRec($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOldCsvRec($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContext($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLocationId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDeletedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDeletingUserId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setNDiffs($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setChargesDiffer($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setNamesDiffer($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setBirthDatesDiffer($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setBirthPlacesDiffer($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setId($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpImportSimilarPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpImportSimilarPeer::NEW_CSV_REC)) $criteria->add(OpImportSimilarPeer::NEW_CSV_REC, $this->new_csv_rec);
		if ($this->isColumnModified(OpImportSimilarPeer::OLD_CSV_REC)) $criteria->add(OpImportSimilarPeer::OLD_CSV_REC, $this->old_csv_rec);
		if ($this->isColumnModified(OpImportSimilarPeer::CONTEXT)) $criteria->add(OpImportSimilarPeer::CONTEXT, $this->context);
		if ($this->isColumnModified(OpImportSimilarPeer::LOCATION_ID)) $criteria->add(OpImportSimilarPeer::LOCATION_ID, $this->location_id);
		if ($this->isColumnModified(OpImportSimilarPeer::CREATED_AT)) $criteria->add(OpImportSimilarPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpImportSimilarPeer::DELETED_AT)) $criteria->add(OpImportSimilarPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(OpImportSimilarPeer::DELETING_USER_ID)) $criteria->add(OpImportSimilarPeer::DELETING_USER_ID, $this->deleting_user_id);
		if ($this->isColumnModified(OpImportSimilarPeer::N_DIFFS)) $criteria->add(OpImportSimilarPeer::N_DIFFS, $this->n_diffs);
		if ($this->isColumnModified(OpImportSimilarPeer::CHARGES_DIFFER)) $criteria->add(OpImportSimilarPeer::CHARGES_DIFFER, $this->charges_differ);
		if ($this->isColumnModified(OpImportSimilarPeer::NAMES_DIFFER)) $criteria->add(OpImportSimilarPeer::NAMES_DIFFER, $this->names_differ);
		if ($this->isColumnModified(OpImportSimilarPeer::BIRTH_DATES_DIFFER)) $criteria->add(OpImportSimilarPeer::BIRTH_DATES_DIFFER, $this->birth_dates_differ);
		if ($this->isColumnModified(OpImportSimilarPeer::BIRTH_PLACES_DIFFER)) $criteria->add(OpImportSimilarPeer::BIRTH_PLACES_DIFFER, $this->birth_places_differ);
		if ($this->isColumnModified(OpImportSimilarPeer::ID)) $criteria->add(OpImportSimilarPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpImportSimilarPeer::DATABASE_NAME);

		$criteria->add(OpImportSimilarPeer::ID, $this->id);

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

		$copyObj->setNewCsvRec($this->new_csv_rec);

		$copyObj->setOldCsvRec($this->old_csv_rec);

		$copyObj->setContext($this->context);

		$copyObj->setLocationId($this->location_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setDeletedAt($this->deleted_at);

		$copyObj->setDeletingUserId($this->deleting_user_id);

		$copyObj->setNDiffs($this->n_diffs);

		$copyObj->setChargesDiffer($this->charges_differ);

		$copyObj->setNamesDiffer($this->names_differ);

		$copyObj->setBirthDatesDiffer($this->birth_dates_differ);

		$copyObj->setBirthPlacesDiffer($this->birth_places_differ);


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
			self::$peer = new OpImportSimilarPeer();
		}
		return self::$peer;
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

	
	public function setOpUser($v)
	{


		if ($v === null) {
			$this->setDeletingUserId(NULL);
		} else {
			$this->setDeletingUserId($v->getId());
		}


		$this->aOpUser = $v;
	}


	
	public function getOpUser($con = null)
	{
		if ($this->aOpUser === null && ($this->deleting_user_id !== null)) {
						include_once 'lib/model/om/BaseOpUserPeer.php';

			$this->aOpUser = OpUserPeer::retrieveByPK($this->deleting_user_id, $con);

			
		}
		return $this->aOpUser;
	}

} 