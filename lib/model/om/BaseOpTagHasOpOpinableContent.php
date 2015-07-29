<?php


abstract class BaseOpTagHasOpOpinableContent extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $tag_id;


	
	protected $opinable_content_id;


	
	protected $user_id;


	
	protected $is_obscured = 0;

	
	protected $aOpTag;

	
	protected $aOpOpinableContent;

	
	protected $aOpUser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getTagId()
	{

		return $this->tag_id;
	}

	
	public function getOpinableContentId()
	{

		return $this->opinable_content_id;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getIsObscured()
	{

		return $this->is_obscured;
	}

	
	public function setTagId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tag_id !== $v) {
			$this->tag_id = $v;
			$this->modifiedColumns[] = OpTagHasOpOpinableContentPeer::TAG_ID;
		}

		if ($this->aOpTag !== null && $this->aOpTag->getId() !== $v) {
			$this->aOpTag = null;
		}

	} 
	
	public function setOpinableContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->opinable_content_id !== $v) {
			$this->opinable_content_id = $v;
			$this->modifiedColumns[] = OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID;
		}

		if ($this->aOpOpinableContent !== null && $this->aOpOpinableContent->getContentId() !== $v) {
			$this->aOpOpinableContent = null;
		}

	} 
	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = OpTagHasOpOpinableContentPeer::USER_ID;
		}

		if ($this->aOpUser !== null && $this->aOpUser->getId() !== $v) {
			$this->aOpUser = null;
		}

	} 
	
	public function setIsObscured($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_obscured !== $v || $v === 0) {
			$this->is_obscured = $v;
			$this->modifiedColumns[] = OpTagHasOpOpinableContentPeer::IS_OBSCURED;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->tag_id = $rs->getInt($startcol + 0);

			$this->opinable_content_id = $rs->getInt($startcol + 1);

			$this->user_id = $rs->getInt($startcol + 2);

			$this->is_obscured = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpTagHasOpOpinableContent object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpTagHasOpOpinableContentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpTagHasOpOpinableContentPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpTagHasOpOpinableContentPeer::DATABASE_NAME);
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


												
			if ($this->aOpTag !== null) {
				if ($this->aOpTag->isModified()) {
					$affectedRows += $this->aOpTag->save($con);
				}
				$this->setOpTag($this->aOpTag);
			}

			if ($this->aOpOpinableContent !== null) {
				if ($this->aOpOpinableContent->isModified()) {
					$affectedRows += $this->aOpOpinableContent->save($con);
				}
				$this->setOpOpinableContent($this->aOpOpinableContent);
			}

			if ($this->aOpUser !== null) {
				if ($this->aOpUser->isModified()) {
					$affectedRows += $this->aOpUser->save($con);
				}
				$this->setOpUser($this->aOpUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpTagHasOpOpinableContentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpTagHasOpOpinableContentPeer::doUpdate($this, $con);
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


												
			if ($this->aOpTag !== null) {
				if (!$this->aOpTag->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpTag->getValidationFailures());
				}
			}

			if ($this->aOpOpinableContent !== null) {
				if (!$this->aOpOpinableContent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpOpinableContent->getValidationFailures());
				}
			}

			if ($this->aOpUser !== null) {
				if (!$this->aOpUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUser->getValidationFailures());
				}
			}


			if (($retval = OpTagHasOpOpinableContentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpTagHasOpOpinableContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getTagId();
				break;
			case 1:
				return $this->getOpinableContentId();
				break;
			case 2:
				return $this->getUserId();
				break;
			case 3:
				return $this->getIsObscured();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpTagHasOpOpinableContentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getTagId(),
			$keys[1] => $this->getOpinableContentId(),
			$keys[2] => $this->getUserId(),
			$keys[3] => $this->getIsObscured(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpTagHasOpOpinableContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setTagId($value);
				break;
			case 1:
				$this->setOpinableContentId($value);
				break;
			case 2:
				$this->setUserId($value);
				break;
			case 3:
				$this->setIsObscured($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpTagHasOpOpinableContentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setTagId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOpinableContentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsObscured($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpTagHasOpOpinableContentPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpTagHasOpOpinableContentPeer::TAG_ID)) $criteria->add(OpTagHasOpOpinableContentPeer::TAG_ID, $this->tag_id);
		if ($this->isColumnModified(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID)) $criteria->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $this->opinable_content_id);
		if ($this->isColumnModified(OpTagHasOpOpinableContentPeer::USER_ID)) $criteria->add(OpTagHasOpOpinableContentPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(OpTagHasOpOpinableContentPeer::IS_OBSCURED)) $criteria->add(OpTagHasOpOpinableContentPeer::IS_OBSCURED, $this->is_obscured);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpTagHasOpOpinableContentPeer::DATABASE_NAME);

		$criteria->add(OpTagHasOpOpinableContentPeer::TAG_ID, $this->tag_id);
		$criteria->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $this->opinable_content_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getTagId();

		$pks[1] = $this->getOpinableContentId();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setTagId($keys[0]);

		$this->setOpinableContentId($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setIsObscured($this->is_obscured);


		$copyObj->setNew(true);

		$copyObj->setTagId(NULL); 
		$copyObj->setOpinableContentId(NULL); 
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
			self::$peer = new OpTagHasOpOpinableContentPeer();
		}
		return self::$peer;
	}

	
	public function setOpTag($v)
	{


		if ($v === null) {
			$this->setTagId(NULL);
		} else {
			$this->setTagId($v->getId());
		}


		$this->aOpTag = $v;
	}


	
	public function getOpTag($con = null)
	{
		if ($this->aOpTag === null && ($this->tag_id !== null)) {
						include_once 'lib/model/om/BaseOpTagPeer.php';

			$this->aOpTag = OpTagPeer::retrieveByPK($this->tag_id, $con);

			
		}
		return $this->aOpTag;
	}

	
	public function setOpOpinableContent($v)
	{


		if ($v === null) {
			$this->setOpinableContentId(NULL);
		} else {
			$this->setOpinableContentId($v->getContentId());
		}


		$this->aOpOpinableContent = $v;
	}


	
	public function getOpOpinableContent($con = null)
	{
		if ($this->aOpOpinableContent === null && ($this->opinable_content_id !== null)) {
						include_once 'lib/model/om/BaseOpOpinableContentPeer.php';

			$this->aOpOpinableContent = OpOpinableContentPeer::retrieveByPK($this->opinable_content_id, $con);

			
		}
		return $this->aOpOpinableContent;
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