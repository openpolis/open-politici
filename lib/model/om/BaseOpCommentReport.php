<?php


abstract class BaseOpCommentReport extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $user_id;


	
	protected $comment_id;


	
	protected $created_at;


	
	protected $notes;


	
	protected $report_type;

	
	protected $aOpUser;

	
	protected $aOpComment;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getCommentId()
	{

		return $this->comment_id;
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

	
	public function getNotes()
	{

		return $this->notes;
	}

	
	public function getReportType()
	{

		return $this->report_type;
	}

	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = OpCommentReportPeer::USER_ID;
		}

		if ($this->aOpUser !== null && $this->aOpUser->getId() !== $v) {
			$this->aOpUser = null;
		}

	} 
	
	public function setCommentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->comment_id !== $v) {
			$this->comment_id = $v;
			$this->modifiedColumns[] = OpCommentReportPeer::COMMENT_ID;
		}

		if ($this->aOpComment !== null && $this->aOpComment->getId() !== $v) {
			$this->aOpComment = null;
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
			$this->modifiedColumns[] = OpCommentReportPeer::CREATED_AT;
		}

	} 
	
	public function setNotes($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->notes !== $v) {
			$this->notes = $v;
			$this->modifiedColumns[] = OpCommentReportPeer::NOTES;
		}

	} 
	
	public function setReportType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->report_type !== $v) {
			$this->report_type = $v;
			$this->modifiedColumns[] = OpCommentReportPeer::REPORT_TYPE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->user_id = $rs->getInt($startcol + 0);

			$this->comment_id = $rs->getInt($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->notes = $rs->getString($startcol + 3);

			$this->report_type = $rs->getString($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpCommentReport object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpCommentReportPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpCommentReportPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpCommentReportPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpCommentReportPeer::DATABASE_NAME);
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


												
			if ($this->aOpUser !== null) {
				if ($this->aOpUser->isModified()) {
					$affectedRows += $this->aOpUser->save($con);
				}
				$this->setOpUser($this->aOpUser);
			}

			if ($this->aOpComment !== null) {
				if ($this->aOpComment->isModified()) {
					$affectedRows += $this->aOpComment->save($con);
				}
				$this->setOpComment($this->aOpComment);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpCommentReportPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpCommentReportPeer::doUpdate($this, $con);
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


												
			if ($this->aOpUser !== null) {
				if (!$this->aOpUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUser->getValidationFailures());
				}
			}

			if ($this->aOpComment !== null) {
				if (!$this->aOpComment->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpComment->getValidationFailures());
				}
			}


			if (($retval = OpCommentReportPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpCommentReportPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUserId();
				break;
			case 1:
				return $this->getCommentId();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getNotes();
				break;
			case 4:
				return $this->getReportType();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpCommentReportPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUserId(),
			$keys[1] => $this->getCommentId(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getNotes(),
			$keys[4] => $this->getReportType(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpCommentReportPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUserId($value);
				break;
			case 1:
				$this->setCommentId($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setNotes($value);
				break;
			case 4:
				$this->setReportType($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpCommentReportPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCommentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNotes($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setReportType($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpCommentReportPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpCommentReportPeer::USER_ID)) $criteria->add(OpCommentReportPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(OpCommentReportPeer::COMMENT_ID)) $criteria->add(OpCommentReportPeer::COMMENT_ID, $this->comment_id);
		if ($this->isColumnModified(OpCommentReportPeer::CREATED_AT)) $criteria->add(OpCommentReportPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpCommentReportPeer::NOTES)) $criteria->add(OpCommentReportPeer::NOTES, $this->notes);
		if ($this->isColumnModified(OpCommentReportPeer::REPORT_TYPE)) $criteria->add(OpCommentReportPeer::REPORT_TYPE, $this->report_type);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpCommentReportPeer::DATABASE_NAME);

		$criteria->add(OpCommentReportPeer::USER_ID, $this->user_id);
		$criteria->add(OpCommentReportPeer::COMMENT_ID, $this->comment_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getUserId();

		$pks[1] = $this->getCommentId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setUserId($keys[0]);

		$this->setCommentId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setNotes($this->notes);

		$copyObj->setReportType($this->report_type);


		$copyObj->setNew(true);

		$copyObj->setUserId(NULL); 
		$copyObj->setCommentId(NULL); 
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
			self::$peer = new OpCommentReportPeer();
		}
		return self::$peer;
	}

	
	public function setOpUser($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->aOpUser = $v;
	}


	
	public function getOpUser($con = null)
	{
		if ($this->aOpUser === null && ($this->user_id !== null)) {
						include_once 'lib/model/om/BaseOpUserPeer.php';

			$this->aOpUser = OpUserPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->aOpUser;
	}

	
	public function setOpComment($v)
	{


		if ($v === null) {
			$this->setCommentId(NULL);
		} else {
			$this->setCommentId($v->getId());
		}


		$this->aOpComment = $v;
	}


	
	public function getOpComment($con = null)
	{
		if ($this->aOpComment === null && ($this->comment_id !== null)) {
						include_once 'lib/model/om/BaseOpCommentPeer.php';

			$this->aOpComment = OpCommentPeer::retrieveByPK($this->comment_id, $con);

			
		}
		return $this->aOpComment;
	}

} 