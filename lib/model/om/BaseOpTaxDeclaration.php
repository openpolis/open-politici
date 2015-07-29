<?php


abstract class BaseOpTaxDeclaration extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $content_id;


	
	protected $politician_id;


	
	protected $year;


	
	protected $url;

	
	protected $aOpContent;

	
	protected $aOpPolitician;

	
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

	
	public function getYear()
	{

		return $this->year;
	}

	
	public function getUrl()
	{

		return $this->url;
	}

	
	public function setContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->content_id !== $v) {
			$this->content_id = $v;
			$this->modifiedColumns[] = OpTaxDeclarationPeer::CONTENT_ID;
		}

		if ($this->aOpContent !== null && $this->aOpContent->getId() !== $v) {
			$this->aOpContent = null;
		}

	} 
	
	public function setPoliticianId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->politician_id !== $v) {
			$this->politician_id = $v;
			$this->modifiedColumns[] = OpTaxDeclarationPeer::POLITICIAN_ID;
		}

		if ($this->aOpPolitician !== null && $this->aOpPolitician->getContentId() !== $v) {
			$this->aOpPolitician = null;
		}

	} 
	
	public function setYear($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->year !== $v) {
			$this->year = $v;
			$this->modifiedColumns[] = OpTaxDeclarationPeer::YEAR;
		}

	} 
	
	public function setUrl($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = OpTaxDeclarationPeer::URL;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->content_id = $rs->getInt($startcol + 0);

			$this->politician_id = $rs->getInt($startcol + 1);

			$this->year = $rs->getInt($startcol + 2);

			$this->url = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpTaxDeclaration object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpTaxDeclarationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpTaxDeclarationPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpTaxDeclarationPeer::DATABASE_NAME);
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


												
			if ($this->aOpContent !== null) {
				if ($this->aOpContent->isModified()) {
					$affectedRows += $this->aOpContent->save($con);
				}
				$this->setOpContent($this->aOpContent);
			}

			if ($this->aOpPolitician !== null) {
				if ($this->aOpPolitician->isModified()) {
					$affectedRows += $this->aOpPolitician->save($con);
				}
				$this->setOpPolitician($this->aOpPolitician);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpTaxDeclarationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpTaxDeclarationPeer::doUpdate($this, $con);
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


												
			if ($this->aOpContent !== null) {
				if (!$this->aOpContent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpContent->getValidationFailures());
				}
			}

			if ($this->aOpPolitician !== null) {
				if (!$this->aOpPolitician->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpPolitician->getValidationFailures());
				}
			}


			if (($retval = OpTaxDeclarationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpTaxDeclarationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getYear();
				break;
			case 3:
				return $this->getUrl();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpTaxDeclarationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getContentId(),
			$keys[1] => $this->getPoliticianId(),
			$keys[2] => $this->getYear(),
			$keys[3] => $this->getUrl(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpTaxDeclarationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setYear($value);
				break;
			case 3:
				$this->setUrl($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpTaxDeclarationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setContentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPoliticianId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setYear($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUrl($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpTaxDeclarationPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpTaxDeclarationPeer::CONTENT_ID)) $criteria->add(OpTaxDeclarationPeer::CONTENT_ID, $this->content_id);
		if ($this->isColumnModified(OpTaxDeclarationPeer::POLITICIAN_ID)) $criteria->add(OpTaxDeclarationPeer::POLITICIAN_ID, $this->politician_id);
		if ($this->isColumnModified(OpTaxDeclarationPeer::YEAR)) $criteria->add(OpTaxDeclarationPeer::YEAR, $this->year);
		if ($this->isColumnModified(OpTaxDeclarationPeer::URL)) $criteria->add(OpTaxDeclarationPeer::URL, $this->url);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpTaxDeclarationPeer::DATABASE_NAME);

		$criteria->add(OpTaxDeclarationPeer::CONTENT_ID, $this->content_id);

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

		$copyObj->setYear($this->year);

		$copyObj->setUrl($this->url);


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
			self::$peer = new OpTaxDeclarationPeer();
		}
		return self::$peer;
	}

	
	public function setOpContent($v)
	{


		if ($v === null) {
			$this->setContentId(NULL);
		} else {
			$this->setContentId($v->getId());
		}


		$this->aOpContent = $v;
	}


	
	public function getOpContent($con = null)
	{
		if ($this->aOpContent === null && ($this->content_id !== null)) {
						include_once 'lib/model/om/BaseOpContentPeer.php';

			$this->aOpContent = OpContentPeer::retrieveByPK($this->content_id, $con);

			
		}
		return $this->aOpContent;
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

} 