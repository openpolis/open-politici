<?php


abstract class BaseOpComment extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $user_id;


	
	protected $content_id;


	
	protected $body;


	
	protected $html_body;


	
	protected $relevancy_score_up = 0;


	
	protected $relevancy_score_down;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $reports = 0;


	
	protected $id;

	
	protected $aOpUser;

	
	protected $aOpOpinableContent;

	
	protected $collOpCommentReports;

	
	protected $lastOpCommentReportCriteria = null;

	
	protected $collOpRelevancyComments;

	
	protected $lastOpRelevancyCommentCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getContentId()
	{

		return $this->content_id;
	}

	
	public function getBody()
	{

		return $this->body;
	}

	
	public function getHtmlBody()
	{

		return $this->html_body;
	}

	
	public function getRelevancyScoreUp()
	{

		return $this->relevancy_score_up;
	}

	
	public function getRelevancyScoreDown()
	{

		return $this->relevancy_score_down;
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

	
	public function getReports()
	{

		return $this->reports;
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
			$this->modifiedColumns[] = OpCommentPeer::USER_ID;
		}

		if ($this->aOpUser !== null && $this->aOpUser->getId() !== $v) {
			$this->aOpUser = null;
		}

	} 
	
	public function setContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->content_id !== $v) {
			$this->content_id = $v;
			$this->modifiedColumns[] = OpCommentPeer::CONTENT_ID;
		}

		if ($this->aOpOpinableContent !== null && $this->aOpOpinableContent->getContentId() !== $v) {
			$this->aOpOpinableContent = null;
		}

	} 
	
	public function setBody($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->body !== $v) {
			$this->body = $v;
			$this->modifiedColumns[] = OpCommentPeer::BODY;
		}

	} 
	
	public function setHtmlBody($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->html_body !== $v) {
			$this->html_body = $v;
			$this->modifiedColumns[] = OpCommentPeer::HTML_BODY;
		}

	} 
	
	public function setRelevancyScoreUp($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->relevancy_score_up !== $v || $v === 0) {
			$this->relevancy_score_up = $v;
			$this->modifiedColumns[] = OpCommentPeer::RELEVANCY_SCORE_UP;
		}

	} 
	
	public function setRelevancyScoreDown($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->relevancy_score_down !== $v) {
			$this->relevancy_score_down = $v;
			$this->modifiedColumns[] = OpCommentPeer::RELEVANCY_SCORE_DOWN;
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
			$this->modifiedColumns[] = OpCommentPeer::CREATED_AT;
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
			$this->modifiedColumns[] = OpCommentPeer::UPDATED_AT;
		}

	} 
	
	public function setReports($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->reports !== $v || $v === 0) {
			$this->reports = $v;
			$this->modifiedColumns[] = OpCommentPeer::REPORTS;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpCommentPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->user_id = $rs->getInt($startcol + 0);

			$this->content_id = $rs->getInt($startcol + 1);

			$this->body = $rs->getString($startcol + 2);

			$this->html_body = $rs->getString($startcol + 3);

			$this->relevancy_score_up = $rs->getInt($startcol + 4);

			$this->relevancy_score_down = $rs->getInt($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->reports = $rs->getInt($startcol + 8);

			$this->id = $rs->getInt($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpComment object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpCommentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpCommentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpCommentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(OpCommentPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpCommentPeer::DATABASE_NAME);
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

			if ($this->aOpOpinableContent !== null) {
				if ($this->aOpOpinableContent->isModified()) {
					$affectedRows += $this->aOpOpinableContent->save($con);
				}
				$this->setOpOpinableContent($this->aOpOpinableContent);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpCommentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpCommentPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpCommentReports !== null) {
				foreach($this->collOpCommentReports as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpRelevancyComments !== null) {
				foreach($this->collOpRelevancyComments as $referrerFK) {
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


												
			if ($this->aOpUser !== null) {
				if (!$this->aOpUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUser->getValidationFailures());
				}
			}

			if ($this->aOpOpinableContent !== null) {
				if (!$this->aOpOpinableContent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpOpinableContent->getValidationFailures());
				}
			}


			if (($retval = OpCommentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpCommentReports !== null) {
					foreach($this->collOpCommentReports as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpRelevancyComments !== null) {
					foreach($this->collOpRelevancyComments as $referrerFK) {
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
		$pos = OpCommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUserId();
				break;
			case 1:
				return $this->getContentId();
				break;
			case 2:
				return $this->getBody();
				break;
			case 3:
				return $this->getHtmlBody();
				break;
			case 4:
				return $this->getRelevancyScoreUp();
				break;
			case 5:
				return $this->getRelevancyScoreDown();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			case 8:
				return $this->getReports();
				break;
			case 9:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpCommentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUserId(),
			$keys[1] => $this->getContentId(),
			$keys[2] => $this->getBody(),
			$keys[3] => $this->getHtmlBody(),
			$keys[4] => $this->getRelevancyScoreUp(),
			$keys[5] => $this->getRelevancyScoreDown(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
			$keys[8] => $this->getReports(),
			$keys[9] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpCommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUserId($value);
				break;
			case 1:
				$this->setContentId($value);
				break;
			case 2:
				$this->setBody($value);
				break;
			case 3:
				$this->setHtmlBody($value);
				break;
			case 4:
				$this->setRelevancyScoreUp($value);
				break;
			case 5:
				$this->setRelevancyScoreDown($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
			case 8:
				$this->setReports($value);
				break;
			case 9:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpCommentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUserId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setContentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBody($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHtmlBody($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRelevancyScoreUp($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRelevancyScoreDown($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setReports($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setId($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpCommentPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpCommentPeer::USER_ID)) $criteria->add(OpCommentPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(OpCommentPeer::CONTENT_ID)) $criteria->add(OpCommentPeer::CONTENT_ID, $this->content_id);
		if ($this->isColumnModified(OpCommentPeer::BODY)) $criteria->add(OpCommentPeer::BODY, $this->body);
		if ($this->isColumnModified(OpCommentPeer::HTML_BODY)) $criteria->add(OpCommentPeer::HTML_BODY, $this->html_body);
		if ($this->isColumnModified(OpCommentPeer::RELEVANCY_SCORE_UP)) $criteria->add(OpCommentPeer::RELEVANCY_SCORE_UP, $this->relevancy_score_up);
		if ($this->isColumnModified(OpCommentPeer::RELEVANCY_SCORE_DOWN)) $criteria->add(OpCommentPeer::RELEVANCY_SCORE_DOWN, $this->relevancy_score_down);
		if ($this->isColumnModified(OpCommentPeer::CREATED_AT)) $criteria->add(OpCommentPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpCommentPeer::UPDATED_AT)) $criteria->add(OpCommentPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(OpCommentPeer::REPORTS)) $criteria->add(OpCommentPeer::REPORTS, $this->reports);
		if ($this->isColumnModified(OpCommentPeer::ID)) $criteria->add(OpCommentPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpCommentPeer::DATABASE_NAME);

		$criteria->add(OpCommentPeer::ID, $this->id);

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

		$copyObj->setContentId($this->content_id);

		$copyObj->setBody($this->body);

		$copyObj->setHtmlBody($this->html_body);

		$copyObj->setRelevancyScoreUp($this->relevancy_score_up);

		$copyObj->setRelevancyScoreDown($this->relevancy_score_down);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setReports($this->reports);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpCommentReports() as $relObj) {
				$copyObj->addOpCommentReport($relObj->copy($deepCopy));
			}

			foreach($this->getOpRelevancyComments() as $relObj) {
				$copyObj->addOpRelevancyComment($relObj->copy($deepCopy));
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
			self::$peer = new OpCommentPeer();
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

	
	public function setOpOpinableContent($v)
	{


		if ($v === null) {
			$this->setContentId(NULL);
		} else {
			$this->setContentId($v->getContentId());
		}


		$this->aOpOpinableContent = $v;
	}


	
	public function getOpOpinableContent($con = null)
	{
		if ($this->aOpOpinableContent === null && ($this->content_id !== null)) {
						include_once 'lib/model/om/BaseOpOpinableContentPeer.php';

			$this->aOpOpinableContent = OpOpinableContentPeer::retrieveByPK($this->content_id, $con);

			
		}
		return $this->aOpOpinableContent;
	}

	
	public function initOpCommentReports()
	{
		if ($this->collOpCommentReports === null) {
			$this->collOpCommentReports = array();
		}
	}

	
	public function getOpCommentReports($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpCommentReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpCommentReports === null) {
			if ($this->isNew()) {
			   $this->collOpCommentReports = array();
			} else {

				$criteria->add(OpCommentReportPeer::COMMENT_ID, $this->getId());

				OpCommentReportPeer::addSelectColumns($criteria);
				$this->collOpCommentReports = OpCommentReportPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpCommentReportPeer::COMMENT_ID, $this->getId());

				OpCommentReportPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpCommentReportCriteria) || !$this->lastOpCommentReportCriteria->equals($criteria)) {
					$this->collOpCommentReports = OpCommentReportPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpCommentReportCriteria = $criteria;
		return $this->collOpCommentReports;
	}

	
	public function countOpCommentReports($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpCommentReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpCommentReportPeer::COMMENT_ID, $this->getId());

		return OpCommentReportPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpCommentReport(OpCommentReport $l)
	{
		$this->collOpCommentReports[] = $l;
		$l->setOpComment($this);
	}


	
	public function getOpCommentReportsJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpCommentReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpCommentReports === null) {
			if ($this->isNew()) {
				$this->collOpCommentReports = array();
			} else {

				$criteria->add(OpCommentReportPeer::COMMENT_ID, $this->getId());

				$this->collOpCommentReports = OpCommentReportPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpCommentReportPeer::COMMENT_ID, $this->getId());

			if (!isset($this->lastOpCommentReportCriteria) || !$this->lastOpCommentReportCriteria->equals($criteria)) {
				$this->collOpCommentReports = OpCommentReportPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpCommentReportCriteria = $criteria;

		return $this->collOpCommentReports;
	}

	
	public function initOpRelevancyComments()
	{
		if ($this->collOpRelevancyComments === null) {
			$this->collOpRelevancyComments = array();
		}
	}

	
	public function getOpRelevancyComments($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpRelevancyCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpRelevancyComments === null) {
			if ($this->isNew()) {
			   $this->collOpRelevancyComments = array();
			} else {

				$criteria->add(OpRelevancyCommentPeer::COMMENT_ID, $this->getId());

				OpRelevancyCommentPeer::addSelectColumns($criteria);
				$this->collOpRelevancyComments = OpRelevancyCommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpRelevancyCommentPeer::COMMENT_ID, $this->getId());

				OpRelevancyCommentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpRelevancyCommentCriteria) || !$this->lastOpRelevancyCommentCriteria->equals($criteria)) {
					$this->collOpRelevancyComments = OpRelevancyCommentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpRelevancyCommentCriteria = $criteria;
		return $this->collOpRelevancyComments;
	}

	
	public function countOpRelevancyComments($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpRelevancyCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpRelevancyCommentPeer::COMMENT_ID, $this->getId());

		return OpRelevancyCommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpRelevancyComment(OpRelevancyComment $l)
	{
		$this->collOpRelevancyComments[] = $l;
		$l->setOpComment($this);
	}


	
	public function getOpRelevancyCommentsJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpRelevancyCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpRelevancyComments === null) {
			if ($this->isNew()) {
				$this->collOpRelevancyComments = array();
			} else {

				$criteria->add(OpRelevancyCommentPeer::COMMENT_ID, $this->getId());

				$this->collOpRelevancyComments = OpRelevancyCommentPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpRelevancyCommentPeer::COMMENT_ID, $this->getId());

			if (!isset($this->lastOpRelevancyCommentCriteria) || !$this->lastOpRelevancyCommentCriteria->equals($criteria)) {
				$this->collOpRelevancyComments = OpRelevancyCommentPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpRelevancyCommentCriteria = $criteria;

		return $this->collOpRelevancyComments;
	}

} 