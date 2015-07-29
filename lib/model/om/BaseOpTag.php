<?php


abstract class BaseOpTag extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $tag;


	
	protected $normalized_tag;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $id;

	
	protected $collOpTagHasOpOpinableContents;

	
	protected $lastOpTagHasOpOpinableContentCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getTag()
	{

		return $this->tag;
	}

	
	public function getNormalizedTag()
	{

		return $this->normalized_tag;
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

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setTag($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag !== $v) {
			$this->tag = $v;
			$this->modifiedColumns[] = OpTagPeer::TAG;
		}

	} 
	
	public function setNormalizedTag($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->normalized_tag !== $v) {
			$this->normalized_tag = $v;
			$this->modifiedColumns[] = OpTagPeer::NORMALIZED_TAG;
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
			$this->modifiedColumns[] = OpTagPeer::CREATED_AT;
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
			$this->modifiedColumns[] = OpTagPeer::UPDATED_AT;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpTagPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->tag = $rs->getString($startcol + 0);

			$this->normalized_tag = $rs->getString($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->updated_at = $rs->getTimestamp($startcol + 3, null);

			$this->id = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpTag object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpTagPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpTagPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpTagPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(OpTagPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpTagPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpTagPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpTagPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpTagHasOpOpinableContents !== null) {
				foreach($this->collOpTagHasOpOpinableContents as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = OpTagPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpTagHasOpOpinableContents !== null) {
					foreach($this->collOpTagHasOpOpinableContents as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getTag();
				break;
			case 1:
				return $this->getNormalizedTag();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getUpdatedAt();
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
		$keys = OpTagPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getTag(),
			$keys[1] => $this->getNormalizedTag(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getUpdatedAt(),
			$keys[4] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpTagPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setTag($value);
				break;
			case 1:
				$this->setNormalizedTag($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setUpdatedAt($value);
				break;
			case 4:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpTagPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setTag($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNormalizedTag($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setId($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpTagPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpTagPeer::TAG)) $criteria->add(OpTagPeer::TAG, $this->tag);
		if ($this->isColumnModified(OpTagPeer::NORMALIZED_TAG)) $criteria->add(OpTagPeer::NORMALIZED_TAG, $this->normalized_tag);
		if ($this->isColumnModified(OpTagPeer::CREATED_AT)) $criteria->add(OpTagPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpTagPeer::UPDATED_AT)) $criteria->add(OpTagPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(OpTagPeer::ID)) $criteria->add(OpTagPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpTagPeer::DATABASE_NAME);

		$criteria->add(OpTagPeer::ID, $this->id);

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

		$copyObj->setTag($this->tag);

		$copyObj->setNormalizedTag($this->normalized_tag);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpTagHasOpOpinableContents() as $relObj) {
				$copyObj->addOpTagHasOpOpinableContent($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new OpTagPeer();
		}
		return self::$peer;
	}

	
	public function initOpTagHasOpOpinableContents()
	{
		if ($this->collOpTagHasOpOpinableContents === null) {
			$this->collOpTagHasOpOpinableContents = array();
		}
	}

	
	public function getOpTagHasOpOpinableContents($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpTagHasOpOpinableContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpTagHasOpOpinableContents === null) {
			if ($this->isNew()) {
			   $this->collOpTagHasOpOpinableContents = array();
			} else {

				$criteria->add(OpTagHasOpOpinableContentPeer::TAG_ID, $this->getId());

				OpTagHasOpOpinableContentPeer::addSelectColumns($criteria);
				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpTagHasOpOpinableContentPeer::TAG_ID, $this->getId());

				OpTagHasOpOpinableContentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpTagHasOpOpinableContentCriteria) || !$this->lastOpTagHasOpOpinableContentCriteria->equals($criteria)) {
					$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpTagHasOpOpinableContentCriteria = $criteria;
		return $this->collOpTagHasOpOpinableContents;
	}

	
	public function countOpTagHasOpOpinableContents($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpTagHasOpOpinableContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpTagHasOpOpinableContentPeer::TAG_ID, $this->getId());

		return OpTagHasOpOpinableContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpTagHasOpOpinableContent(OpTagHasOpOpinableContent $l)
	{
		$this->collOpTagHasOpOpinableContents[] = $l;
		$l->setOpTag($this);
	}


	
	public function getOpTagHasOpOpinableContentsJoinOpOpinableContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpTagHasOpOpinableContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpTagHasOpOpinableContents === null) {
			if ($this->isNew()) {
				$this->collOpTagHasOpOpinableContents = array();
			} else {

				$criteria->add(OpTagHasOpOpinableContentPeer::TAG_ID, $this->getId());

				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelectJoinOpOpinableContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpTagHasOpOpinableContentPeer::TAG_ID, $this->getId());

			if (!isset($this->lastOpTagHasOpOpinableContentCriteria) || !$this->lastOpTagHasOpOpinableContentCriteria->equals($criteria)) {
				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelectJoinOpOpinableContent($criteria, $con);
			}
		}
		$this->lastOpTagHasOpOpinableContentCriteria = $criteria;

		return $this->collOpTagHasOpOpinableContents;
	}


	
	public function getOpTagHasOpOpinableContentsJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpTagHasOpOpinableContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpTagHasOpOpinableContents === null) {
			if ($this->isNew()) {
				$this->collOpTagHasOpOpinableContents = array();
			} else {

				$criteria->add(OpTagHasOpOpinableContentPeer::TAG_ID, $this->getId());

				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpTagHasOpOpinableContentPeer::TAG_ID, $this->getId());

			if (!isset($this->lastOpTagHasOpOpinableContentCriteria) || !$this->lastOpTagHasOpOpinableContentCriteria->equals($criteria)) {
				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpTagHasOpOpinableContentCriteria = $criteria;

		return $this->collOpTagHasOpOpinableContents;
	}

} 