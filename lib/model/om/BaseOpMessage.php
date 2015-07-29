<?php


abstract class BaseOpMessage extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $user_id;


	
	protected $subject;


	
	protected $body;


	
	protected $body_html;


	
	protected $archive_status = 0;


	
	protected $delete_status;


	
	protected $created_at;


	
	protected $id;

	
	protected $aOpUser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getSubject()
	{

		return $this->subject;
	}

	
	public function getBody()
	{

		return $this->body;
	}

	
	public function getBodyHtml()
	{

		return $this->body_html;
	}

	
	public function getArchiveStatus()
	{

		return $this->archive_status;
	}

	
	public function getDeleteStatus()
	{

		return $this->delete_status;
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

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = OpMessagePeer::USER_ID;
		}

		if ($this->aOpUser !== null && $this->aOpUser->getId() !== $v) {
			$this->aOpUser = null;
		}

	} 
	
	public function setSubject($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->subject !== $v) {
			$this->subject = $v;
			$this->modifiedColumns[] = OpMessagePeer::SUBJECT;
		}

	} 
	
	public function setBody($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->body !== $v) {
			$this->body = $v;
			$this->modifiedColumns[] = OpMessagePeer::BODY;
		}

	} 
	
	public function setBodyHtml($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->body_html !== $v) {
			$this->body_html = $v;
			$this->modifiedColumns[] = OpMessagePeer::BODY_HTML;
		}

	} 
	
	public function setArchiveStatus($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->archive_status !== $v || $v === 0) {
			$this->archive_status = $v;
			$this->modifiedColumns[] = OpMessagePeer::ARCHIVE_STATUS;
		}

	} 
	
	public function setDeleteStatus($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->delete_status !== $v) {
			$this->delete_status = $v;
			$this->modifiedColumns[] = OpMessagePeer::DELETE_STATUS;
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
			$this->modifiedColumns[] = OpMessagePeer::CREATED_AT;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpMessagePeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->user_id = $rs->getInt($startcol + 0);

			$this->subject = $rs->getString($startcol + 1);

			$this->body = $rs->getString($startcol + 2);

			$this->body_html = $rs->getString($startcol + 3);

			$this->archive_status = $rs->getInt($startcol + 4);

			$this->delete_status = $rs->getInt($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->id = $rs->getInt($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpMessage object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpMessagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpMessagePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpMessagePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpMessagePeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpMessagePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpMessagePeer::doUpdate($this, $con);
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


			if (($retval = OpMessagePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpMessagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUserId();
				break;
			case 1:
				return $this->getSubject();
				break;
			case 2:
				return $this->getBody();
				break;
			case 3:
				return $this->getBodyHtml();
				break;
			case 4:
				return $this->getArchiveStatus();
				break;
			case 5:
				return $this->getDeleteStatus();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpMessagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUserId(),
			$keys[1] => $this->getSubject(),
			$keys[2] => $this->getBody(),
			$keys[3] => $this->getBodyHtml(),
			$keys[4] => $this->getArchiveStatus(),
			$keys[5] => $this->getDeleteStatus(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpMessagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUserId($value);
				break;
			case 1:
				$this->setSubject($value);
				break;
			case 2:
				$this->setBody($value);
				break;
			case 3:
				$this->setBodyHtml($value);
				break;
			case 4:
				$this->setArchiveStatus($value);
				break;
			case 5:
				$this->setDeleteStatus($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpMessagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSubject($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBody($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBodyHtml($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setArchiveStatus($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDeleteStatus($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setId($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpMessagePeer::DATABASE_NAME);

		if ($this->isColumnModified(OpMessagePeer::USER_ID)) $criteria->add(OpMessagePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(OpMessagePeer::SUBJECT)) $criteria->add(OpMessagePeer::SUBJECT, $this->subject);
		if ($this->isColumnModified(OpMessagePeer::BODY)) $criteria->add(OpMessagePeer::BODY, $this->body);
		if ($this->isColumnModified(OpMessagePeer::BODY_HTML)) $criteria->add(OpMessagePeer::BODY_HTML, $this->body_html);
		if ($this->isColumnModified(OpMessagePeer::ARCHIVE_STATUS)) $criteria->add(OpMessagePeer::ARCHIVE_STATUS, $this->archive_status);
		if ($this->isColumnModified(OpMessagePeer::DELETE_STATUS)) $criteria->add(OpMessagePeer::DELETE_STATUS, $this->delete_status);
		if ($this->isColumnModified(OpMessagePeer::CREATED_AT)) $criteria->add(OpMessagePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpMessagePeer::ID)) $criteria->add(OpMessagePeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpMessagePeer::DATABASE_NAME);

		$criteria->add(OpMessagePeer::ID, $this->id);

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

		$copyObj->setUserId($this->user_id);

		$copyObj->setSubject($this->subject);

		$copyObj->setBody($this->body);

		$copyObj->setBodyHtml($this->body_html);

		$copyObj->setArchiveStatus($this->archive_status);

		$copyObj->setDeleteStatus($this->delete_status);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new OpMessagePeer();
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

} 