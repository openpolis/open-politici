<?php


abstract class BaseOpFaq extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $answer;


	
	protected $question;


	
	protected $faq_group_id;


	
	protected $id;

	
	protected $aOpFaqGroup;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getAnswer()
	{

		return $this->answer;
	}

	
	public function getQuestion()
	{

		return $this->question;
	}

	
	public function getFaqGroupId()
	{

		return $this->faq_group_id;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setAnswer($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->answer !== $v) {
			$this->answer = $v;
			$this->modifiedColumns[] = OpFaqPeer::ANSWER;
		}

	} 
	
	public function setQuestion($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->question !== $v) {
			$this->question = $v;
			$this->modifiedColumns[] = OpFaqPeer::QUESTION;
		}

	} 
	
	public function setFaqGroupId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->faq_group_id !== $v) {
			$this->faq_group_id = $v;
			$this->modifiedColumns[] = OpFaqPeer::FAQ_GROUP_ID;
		}

		if ($this->aOpFaqGroup !== null && $this->aOpFaqGroup->getId() !== $v) {
			$this->aOpFaqGroup = null;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpFaqPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->answer = $rs->getString($startcol + 0);

			$this->question = $rs->getString($startcol + 1);

			$this->faq_group_id = $rs->getInt($startcol + 2);

			$this->id = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpFaq object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpFaqPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpFaqPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpFaqPeer::DATABASE_NAME);
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


												
			if ($this->aOpFaqGroup !== null) {
				if ($this->aOpFaqGroup->isModified()) {
					$affectedRows += $this->aOpFaqGroup->save($con);
				}
				$this->setOpFaqGroup($this->aOpFaqGroup);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpFaqPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpFaqPeer::doUpdate($this, $con);
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


												
			if ($this->aOpFaqGroup !== null) {
				if (!$this->aOpFaqGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpFaqGroup->getValidationFailures());
				}
			}


			if (($retval = OpFaqPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpFaqPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getAnswer();
				break;
			case 1:
				return $this->getQuestion();
				break;
			case 2:
				return $this->getFaqGroupId();
				break;
			case 3:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpFaqPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getAnswer(),
			$keys[1] => $this->getQuestion(),
			$keys[2] => $this->getFaqGroupId(),
			$keys[3] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpFaqPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setAnswer($value);
				break;
			case 1:
				$this->setQuestion($value);
				break;
			case 2:
				$this->setFaqGroupId($value);
				break;
			case 3:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpFaqPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setAnswer($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setQuestion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFaqGroupId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setId($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpFaqPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpFaqPeer::ANSWER)) $criteria->add(OpFaqPeer::ANSWER, $this->answer);
		if ($this->isColumnModified(OpFaqPeer::QUESTION)) $criteria->add(OpFaqPeer::QUESTION, $this->question);
		if ($this->isColumnModified(OpFaqPeer::FAQ_GROUP_ID)) $criteria->add(OpFaqPeer::FAQ_GROUP_ID, $this->faq_group_id);
		if ($this->isColumnModified(OpFaqPeer::ID)) $criteria->add(OpFaqPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpFaqPeer::DATABASE_NAME);

		$criteria->add(OpFaqPeer::ID, $this->id);

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

		$copyObj->setAnswer($this->answer);

		$copyObj->setQuestion($this->question);

		$copyObj->setFaqGroupId($this->faq_group_id);


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
			self::$peer = new OpFaqPeer();
		}
		return self::$peer;
	}

	
	public function setOpFaqGroup($v)
	{


		if ($v === null) {
			$this->setFaqGroupId(NULL);
		} else {
			$this->setFaqGroupId($v->getId());
		}


		$this->aOpFaqGroup = $v;
	}


	
	public function getOpFaqGroup($con = null)
	{
		if ($this->aOpFaqGroup === null && ($this->faq_group_id !== null)) {
						include_once 'lib/model/om/BaseOpFaqGroupPeer.php';

			$this->aOpFaqGroup = OpFaqGroupPeer::retrieveByPK($this->faq_group_id, $con);

			
		}
		return $this->aOpFaqGroup;
	}

} 