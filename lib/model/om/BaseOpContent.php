<?php


abstract class BaseOpContent extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $reports = 0;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $op_table;


	
	protected $op_class;


	
	protected $hash;


	
	protected $id;

	
	protected $collOpOpenContents;

	
	protected $lastOpOpenContentCriteria = null;

	
	protected $collOpPoliticians;

	
	protected $lastOpPoliticianCriteria = null;

	
	protected $collOpReports;

	
	protected $lastOpReportCriteria = null;

	
	protected $collOpTaxDeclarations;

	
	protected $lastOpTaxDeclarationCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getReports()
	{

		return $this->reports;
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

	
	public function getOpTable()
	{

		return $this->op_table;
	}

	
	public function getOpClass()
	{

		return $this->op_class;
	}

	
	public function getHash()
	{

		return $this->hash;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setReports($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->reports !== $v || $v === 0) {
			$this->reports = $v;
			$this->modifiedColumns[] = OpContentPeer::REPORTS;
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
			$this->modifiedColumns[] = OpContentPeer::CREATED_AT;
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
			$this->modifiedColumns[] = OpContentPeer::UPDATED_AT;
		}

	} 
	
	public function setOpTable($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->op_table !== $v) {
			$this->op_table = $v;
			$this->modifiedColumns[] = OpContentPeer::OP_TABLE;
		}

	} 
	
	public function setOpClass($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->op_class !== $v) {
			$this->op_class = $v;
			$this->modifiedColumns[] = OpContentPeer::OP_CLASS;
		}

	} 
	
	public function setHash($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->hash !== $v) {
			$this->hash = $v;
			$this->modifiedColumns[] = OpContentPeer::HASH;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpContentPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->reports = $rs->getInt($startcol + 0);

			$this->created_at = $rs->getTimestamp($startcol + 1, null);

			$this->updated_at = $rs->getTimestamp($startcol + 2, null);

			$this->op_table = $rs->getString($startcol + 3);

			$this->op_class = $rs->getString($startcol + 4);

			$this->hash = $rs->getString($startcol + 5);

			$this->id = $rs->getInt($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpContent object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpContentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpContentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpContentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(OpContentPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpContentPeer::DATABASE_NAME);
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
					$pk = OpContentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpContentPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpOpenContents !== null) {
				foreach($this->collOpOpenContents as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpPoliticians !== null) {
				foreach($this->collOpPoliticians as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpReports !== null) {
				foreach($this->collOpReports as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpTaxDeclarations !== null) {
				foreach($this->collOpTaxDeclarations as $referrerFK) {
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


			if (($retval = OpContentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpOpenContents !== null) {
					foreach($this->collOpOpenContents as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpPoliticians !== null) {
					foreach($this->collOpPoliticians as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpReports !== null) {
					foreach($this->collOpReports as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpTaxDeclarations !== null) {
					foreach($this->collOpTaxDeclarations as $referrerFK) {
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
		$pos = OpContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getReports();
				break;
			case 1:
				return $this->getCreatedAt();
				break;
			case 2:
				return $this->getUpdatedAt();
				break;
			case 3:
				return $this->getOpTable();
				break;
			case 4:
				return $this->getOpClass();
				break;
			case 5:
				return $this->getHash();
				break;
			case 6:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpContentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getReports(),
			$keys[1] => $this->getCreatedAt(),
			$keys[2] => $this->getUpdatedAt(),
			$keys[3] => $this->getOpTable(),
			$keys[4] => $this->getOpClass(),
			$keys[5] => $this->getHash(),
			$keys[6] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setReports($value);
				break;
			case 1:
				$this->setCreatedAt($value);
				break;
			case 2:
				$this->setUpdatedAt($value);
				break;
			case 3:
				$this->setOpTable($value);
				break;
			case 4:
				$this->setOpClass($value);
				break;
			case 5:
				$this->setHash($value);
				break;
			case 6:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpContentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setReports($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCreatedAt($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUpdatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setOpTable($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOpClass($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setHash($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setId($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpContentPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpContentPeer::REPORTS)) $criteria->add(OpContentPeer::REPORTS, $this->reports);
		if ($this->isColumnModified(OpContentPeer::CREATED_AT)) $criteria->add(OpContentPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpContentPeer::UPDATED_AT)) $criteria->add(OpContentPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(OpContentPeer::OP_TABLE)) $criteria->add(OpContentPeer::OP_TABLE, $this->op_table);
		if ($this->isColumnModified(OpContentPeer::OP_CLASS)) $criteria->add(OpContentPeer::OP_CLASS, $this->op_class);
		if ($this->isColumnModified(OpContentPeer::HASH)) $criteria->add(OpContentPeer::HASH, $this->hash);
		if ($this->isColumnModified(OpContentPeer::ID)) $criteria->add(OpContentPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpContentPeer::DATABASE_NAME);

		$criteria->add(OpContentPeer::ID, $this->id);

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

		$copyObj->setReports($this->reports);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setOpTable($this->op_table);

		$copyObj->setOpClass($this->op_class);

		$copyObj->setHash($this->hash);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpOpenContents() as $relObj) {
				$copyObj->addOpOpenContent($relObj->copy($deepCopy));
			}

			foreach($this->getOpPoliticians() as $relObj) {
				$copyObj->addOpPolitician($relObj->copy($deepCopy));
			}

			foreach($this->getOpReports() as $relObj) {
				$copyObj->addOpReport($relObj->copy($deepCopy));
			}

			foreach($this->getOpTaxDeclarations() as $relObj) {
				$copyObj->addOpTaxDeclaration($relObj->copy($deepCopy));
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
			self::$peer = new OpContentPeer();
		}
		return self::$peer;
	}

	
	public function initOpOpenContents()
	{
		if ($this->collOpOpenContents === null) {
			$this->collOpOpenContents = array();
		}
	}

	
	public function getOpOpenContents($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOpenContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOpenContents === null) {
			if ($this->isNew()) {
			   $this->collOpOpenContents = array();
			} else {

				$criteria->add(OpOpenContentPeer::CONTENT_ID, $this->getId());

				OpOpenContentPeer::addSelectColumns($criteria);
				$this->collOpOpenContents = OpOpenContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpOpenContentPeer::CONTENT_ID, $this->getId());

				OpOpenContentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpOpenContentCriteria) || !$this->lastOpOpenContentCriteria->equals($criteria)) {
					$this->collOpOpenContents = OpOpenContentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpOpenContentCriteria = $criteria;
		return $this->collOpOpenContents;
	}

	
	public function countOpOpenContents($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpOpenContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpOpenContentPeer::CONTENT_ID, $this->getId());

		return OpOpenContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpOpenContent(OpOpenContent $l)
	{
		$this->collOpOpenContents[] = $l;
		$l->setOpContent($this);
	}


	
	public function getOpOpenContentsJoinOpUserRelatedByUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOpenContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOpenContents === null) {
			if ($this->isNew()) {
				$this->collOpOpenContents = array();
			} else {

				$criteria->add(OpOpenContentPeer::CONTENT_ID, $this->getId());

				$this->collOpOpenContents = OpOpenContentPeer::doSelectJoinOpUserRelatedByUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(OpOpenContentPeer::CONTENT_ID, $this->getId());

			if (!isset($this->lastOpOpenContentCriteria) || !$this->lastOpOpenContentCriteria->equals($criteria)) {
				$this->collOpOpenContents = OpOpenContentPeer::doSelectJoinOpUserRelatedByUserId($criteria, $con);
			}
		}
		$this->lastOpOpenContentCriteria = $criteria;

		return $this->collOpOpenContents;
	}


	
	public function getOpOpenContentsJoinOpUserRelatedByUpdaterId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOpenContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOpenContents === null) {
			if ($this->isNew()) {
				$this->collOpOpenContents = array();
			} else {

				$criteria->add(OpOpenContentPeer::CONTENT_ID, $this->getId());

				$this->collOpOpenContents = OpOpenContentPeer::doSelectJoinOpUserRelatedByUpdaterId($criteria, $con);
			}
		} else {
									
			$criteria->add(OpOpenContentPeer::CONTENT_ID, $this->getId());

			if (!isset($this->lastOpOpenContentCriteria) || !$this->lastOpOpenContentCriteria->equals($criteria)) {
				$this->collOpOpenContents = OpOpenContentPeer::doSelectJoinOpUserRelatedByUpdaterId($criteria, $con);
			}
		}
		$this->lastOpOpenContentCriteria = $criteria;

		return $this->collOpOpenContents;
	}

	
	public function initOpPoliticians()
	{
		if ($this->collOpPoliticians === null) {
			$this->collOpPoliticians = array();
		}
	}

	
	public function getOpPoliticians($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticians === null) {
			if ($this->isNew()) {
			   $this->collOpPoliticians = array();
			} else {

				$criteria->add(OpPoliticianPeer::CONTENT_ID, $this->getId());

				OpPoliticianPeer::addSelectColumns($criteria);
				$this->collOpPoliticians = OpPoliticianPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPoliticianPeer::CONTENT_ID, $this->getId());

				OpPoliticianPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpPoliticianCriteria) || !$this->lastOpPoliticianCriteria->equals($criteria)) {
					$this->collOpPoliticians = OpPoliticianPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpPoliticianCriteria = $criteria;
		return $this->collOpPoliticians;
	}

	
	public function countOpPoliticians($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpPoliticianPeer::CONTENT_ID, $this->getId());

		return OpPoliticianPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPolitician(OpPolitician $l)
	{
		$this->collOpPoliticians[] = $l;
		$l->setOpContent($this);
	}


	
	public function getOpPoliticiansJoinOpProfession($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticians === null) {
			if ($this->isNew()) {
				$this->collOpPoliticians = array();
			} else {

				$criteria->add(OpPoliticianPeer::CONTENT_ID, $this->getId());

				$this->collOpPoliticians = OpPoliticianPeer::doSelectJoinOpProfession($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticianPeer::CONTENT_ID, $this->getId());

			if (!isset($this->lastOpPoliticianCriteria) || !$this->lastOpPoliticianCriteria->equals($criteria)) {
				$this->collOpPoliticians = OpPoliticianPeer::doSelectJoinOpProfession($criteria, $con);
			}
		}
		$this->lastOpPoliticianCriteria = $criteria;

		return $this->collOpPoliticians;
	}


	
	public function getOpPoliticiansJoinOpUserRelatedByUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticians === null) {
			if ($this->isNew()) {
				$this->collOpPoliticians = array();
			} else {

				$criteria->add(OpPoliticianPeer::CONTENT_ID, $this->getId());

				$this->collOpPoliticians = OpPoliticianPeer::doSelectJoinOpUserRelatedByUserId($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticianPeer::CONTENT_ID, $this->getId());

			if (!isset($this->lastOpPoliticianCriteria) || !$this->lastOpPoliticianCriteria->equals($criteria)) {
				$this->collOpPoliticians = OpPoliticianPeer::doSelectJoinOpUserRelatedByUserId($criteria, $con);
			}
		}
		$this->lastOpPoliticianCriteria = $criteria;

		return $this->collOpPoliticians;
	}


	
	public function getOpPoliticiansJoinOpUserRelatedByCreatorId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticians === null) {
			if ($this->isNew()) {
				$this->collOpPoliticians = array();
			} else {

				$criteria->add(OpPoliticianPeer::CONTENT_ID, $this->getId());

				$this->collOpPoliticians = OpPoliticianPeer::doSelectJoinOpUserRelatedByCreatorId($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticianPeer::CONTENT_ID, $this->getId());

			if (!isset($this->lastOpPoliticianCriteria) || !$this->lastOpPoliticianCriteria->equals($criteria)) {
				$this->collOpPoliticians = OpPoliticianPeer::doSelectJoinOpUserRelatedByCreatorId($criteria, $con);
			}
		}
		$this->lastOpPoliticianCriteria = $criteria;

		return $this->collOpPoliticians;
	}

	
	public function initOpReports()
	{
		if ($this->collOpReports === null) {
			$this->collOpReports = array();
		}
	}

	
	public function getOpReports($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpReports === null) {
			if ($this->isNew()) {
			   $this->collOpReports = array();
			} else {

				$criteria->add(OpReportPeer::CONTENT_ID, $this->getId());

				OpReportPeer::addSelectColumns($criteria);
				$this->collOpReports = OpReportPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpReportPeer::CONTENT_ID, $this->getId());

				OpReportPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpReportCriteria) || !$this->lastOpReportCriteria->equals($criteria)) {
					$this->collOpReports = OpReportPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpReportCriteria = $criteria;
		return $this->collOpReports;
	}

	
	public function countOpReports($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpReportPeer::CONTENT_ID, $this->getId());

		return OpReportPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpReport(OpReport $l)
	{
		$this->collOpReports[] = $l;
		$l->setOpContent($this);
	}


	
	public function getOpReportsJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpReports === null) {
			if ($this->isNew()) {
				$this->collOpReports = array();
			} else {

				$criteria->add(OpReportPeer::CONTENT_ID, $this->getId());

				$this->collOpReports = OpReportPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpReportPeer::CONTENT_ID, $this->getId());

			if (!isset($this->lastOpReportCriteria) || !$this->lastOpReportCriteria->equals($criteria)) {
				$this->collOpReports = OpReportPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpReportCriteria = $criteria;

		return $this->collOpReports;
	}

	
	public function initOpTaxDeclarations()
	{
		if ($this->collOpTaxDeclarations === null) {
			$this->collOpTaxDeclarations = array();
		}
	}

	
	public function getOpTaxDeclarations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpTaxDeclarationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpTaxDeclarations === null) {
			if ($this->isNew()) {
			   $this->collOpTaxDeclarations = array();
			} else {

				$criteria->add(OpTaxDeclarationPeer::CONTENT_ID, $this->getId());

				OpTaxDeclarationPeer::addSelectColumns($criteria);
				$this->collOpTaxDeclarations = OpTaxDeclarationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpTaxDeclarationPeer::CONTENT_ID, $this->getId());

				OpTaxDeclarationPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpTaxDeclarationCriteria) || !$this->lastOpTaxDeclarationCriteria->equals($criteria)) {
					$this->collOpTaxDeclarations = OpTaxDeclarationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpTaxDeclarationCriteria = $criteria;
		return $this->collOpTaxDeclarations;
	}

	
	public function countOpTaxDeclarations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpTaxDeclarationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpTaxDeclarationPeer::CONTENT_ID, $this->getId());

		return OpTaxDeclarationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpTaxDeclaration(OpTaxDeclaration $l)
	{
		$this->collOpTaxDeclarations[] = $l;
		$l->setOpContent($this);
	}


	
	public function getOpTaxDeclarationsJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpTaxDeclarationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpTaxDeclarations === null) {
			if ($this->isNew()) {
				$this->collOpTaxDeclarations = array();
			} else {

				$criteria->add(OpTaxDeclarationPeer::CONTENT_ID, $this->getId());

				$this->collOpTaxDeclarations = OpTaxDeclarationPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpTaxDeclarationPeer::CONTENT_ID, $this->getId());

			if (!isset($this->lastOpTaxDeclarationCriteria) || !$this->lastOpTaxDeclarationCriteria->equals($criteria)) {
				$this->collOpTaxDeclarations = OpTaxDeclarationPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpTaxDeclarationCriteria = $criteria;

		return $this->collOpTaxDeclarations;
	}

} 