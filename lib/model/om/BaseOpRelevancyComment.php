<?php


abstract class BaseOpRelevancyComment extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $comment_id;


	
	protected $user_id;


	
	protected $score = 0;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aOpComment;

	
	protected $aOpUser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getCommentId()
	{

		return $this->comment_id;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getScore()
	{

		return $this->score;
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

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setCommentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->comment_id !== $v) {
			$this->comment_id = $v;
			$this->modifiedColumns[] = OpRelevancyCommentPeer::COMMENT_ID;
		}

		if ($this->aOpComment !== null && $this->aOpComment->getId() !== $v) {
			$this->aOpComment = null;
		}

	} 
	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = OpRelevancyCommentPeer::USER_ID;
		}

		if ($this->aOpUser !== null && $this->aOpUser->getId() !== $v) {
			$this->aOpUser = null;
		}

	} 
	
	public function setScore($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->score !== $v || $v === 0) {
			$this->score = $v;
			$this->modifiedColumns[] = OpRelevancyCommentPeer::SCORE;
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
			$this->modifiedColumns[] = OpRelevancyCommentPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = OpRelevancyCommentPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->comment_id = $rs->getInt($startcol + 0);

			$this->user_id = $rs->getInt($startcol + 1);

			$this->score = $rs->getInt($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpRelevancyComment object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpRelevancyCommentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpRelevancyCommentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpRelevancyCommentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(OpRelevancyCommentPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpRelevancyCommentPeer::DATABASE_NAME);
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


												
			if ($this->aOpComment !== null) {
				if ($this->aOpComment->isModified()) {
					$affectedRows += $this->aOpComment->save($con);
				}
				$this->setOpComment($this->aOpComment);
			}

			if ($this->aOpUser !== null) {
				if ($this->aOpUser->isModified()) {
					$affectedRows += $this->aOpUser->save($con);
				}
				$this->setOpUser($this->aOpUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpRelevancyCommentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpRelevancyCommentPeer::doUpdate($this, $con);
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


												
			if ($this->aOpComment !== null) {
				if (!$this->aOpComment->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpComment->getValidationFailures());
				}
			}

			if ($this->aOpUser !== null) {
				if (!$this->aOpUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUser->getValidationFailures());
				}
			}


			if (($retval = OpRelevancyCommentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpRelevancyCommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCommentId();
				break;
			case 1:
				return $this->getUserId();
				break;
			case 2:
				return $this->getScore();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpRelevancyCommentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCommentId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getScore(),
			$keys[3] => $this->getCreatedAt(),
			$keys[4] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpRelevancyCommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCommentId($value);
				break;
			case 1:
				$this->setUserId($value);
				break;
			case 2:
				$this->setScore($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpRelevancyCommentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCommentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setScore($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpRelevancyCommentPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpRelevancyCommentPeer::COMMENT_ID)) $criteria->add(OpRelevancyCommentPeer::COMMENT_ID, $this->comment_id);
		if ($this->isColumnModified(OpRelevancyCommentPeer::USER_ID)) $criteria->add(OpRelevancyCommentPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(OpRelevancyCommentPeer::SCORE)) $criteria->add(OpRelevancyCommentPeer::SCORE, $this->score);
		if ($this->isColumnModified(OpRelevancyCommentPeer::CREATED_AT)) $criteria->add(OpRelevancyCommentPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpRelevancyCommentPeer::UPDATED_AT)) $criteria->add(OpRelevancyCommentPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpRelevancyCommentPeer::DATABASE_NAME);

		$criteria->add(OpRelevancyCommentPeer::COMMENT_ID, $this->comment_id);
		$criteria->add(OpRelevancyCommentPeer::USER_ID, $this->user_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCommentId();

		$pks[1] = $this->getUserId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCommentId($keys[0]);

		$this->setUserId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setScore($this->score);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setCommentId(NULL); 
		$copyObj->setUserId(NULL); 
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
			self::$peer = new OpRelevancyCommentPeer();
		}
		return self::$peer;
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

} 