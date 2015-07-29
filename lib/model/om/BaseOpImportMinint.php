<?php


abstract class BaseOpImportMinint extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $agg_date = '00000000';


	
	protected $type;


	
	protected $description;


	
	protected $id;

	
	protected $collOpImports;

	
	protected $lastOpImportCriteria = null;

	
	protected $collOpImportModificationss;

	
	protected $lastOpImportModificationsCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getAggDate()
	{

		return $this->agg_date;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setAggDate($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->agg_date !== $v || $v === '00000000') {
			$this->agg_date = $v;
			$this->modifiedColumns[] = OpImportMinintPeer::AGG_DATE;
		}

	} 
	
	public function setType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = OpImportMinintPeer::TYPE;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = OpImportMinintPeer::DESCRIPTION;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpImportMinintPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->agg_date = $rs->getString($startcol + 0);

			$this->type = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->id = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpImportMinint object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpImportMinintPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpImportMinintPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpImportMinintPeer::DATABASE_NAME);
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
					$pk = OpImportMinintPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpImportMinintPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpImports !== null) {
				foreach($this->collOpImports as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpImportModificationss !== null) {
				foreach($this->collOpImportModificationss as $referrerFK) {
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


			if (($retval = OpImportMinintPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpImports !== null) {
					foreach($this->collOpImports as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpImportModificationss !== null) {
					foreach($this->collOpImportModificationss as $referrerFK) {
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
		$pos = OpImportMinintPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getAggDate();
				break;
			case 1:
				return $this->getType();
				break;
			case 2:
				return $this->getDescription();
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
		$keys = OpImportMinintPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getAggDate(),
			$keys[1] => $this->getType(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpImportMinintPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setAggDate($value);
				break;
			case 1:
				$this->setType($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpImportMinintPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setAggDate($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setType($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setId($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpImportMinintPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpImportMinintPeer::AGG_DATE)) $criteria->add(OpImportMinintPeer::AGG_DATE, $this->agg_date);
		if ($this->isColumnModified(OpImportMinintPeer::TYPE)) $criteria->add(OpImportMinintPeer::TYPE, $this->type);
		if ($this->isColumnModified(OpImportMinintPeer::DESCRIPTION)) $criteria->add(OpImportMinintPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(OpImportMinintPeer::ID)) $criteria->add(OpImportMinintPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpImportMinintPeer::DATABASE_NAME);

		$criteria->add(OpImportMinintPeer::ID, $this->id);

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

		$copyObj->setAggDate($this->agg_date);

		$copyObj->setType($this->type);

		$copyObj->setDescription($this->description);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpImports() as $relObj) {
				$copyObj->addOpImport($relObj->copy($deepCopy));
			}

			foreach($this->getOpImportModificationss() as $relObj) {
				$copyObj->addOpImportModifications($relObj->copy($deepCopy));
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
			self::$peer = new OpImportMinintPeer();
		}
		return self::$peer;
	}

	
	public function initOpImports()
	{
		if ($this->collOpImports === null) {
			$this->collOpImports = array();
		}
	}

	
	public function getOpImports($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpImports === null) {
			if ($this->isNew()) {
			   $this->collOpImports = array();
			} else {

				$criteria->add(OpImportPeer::IMPORT_MININT_ID, $this->getId());

				OpImportPeer::addSelectColumns($criteria);
				$this->collOpImports = OpImportPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpImportPeer::IMPORT_MININT_ID, $this->getId());

				OpImportPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpImportCriteria) || !$this->lastOpImportCriteria->equals($criteria)) {
					$this->collOpImports = OpImportPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpImportCriteria = $criteria;
		return $this->collOpImports;
	}

	
	public function countOpImports($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpImportPeer::IMPORT_MININT_ID, $this->getId());

		return OpImportPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpImport(OpImport $l)
	{
		$this->collOpImports[] = $l;
		$l->setOpImportMinint($this);
	}


	
	public function getOpImportsJoinOpImportType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpImports === null) {
			if ($this->isNew()) {
				$this->collOpImports = array();
			} else {

				$criteria->add(OpImportPeer::IMPORT_MININT_ID, $this->getId());

				$this->collOpImports = OpImportPeer::doSelectJoinOpImportType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpImportPeer::IMPORT_MININT_ID, $this->getId());

			if (!isset($this->lastOpImportCriteria) || !$this->lastOpImportCriteria->equals($criteria)) {
				$this->collOpImports = OpImportPeer::doSelectJoinOpImportType($criteria, $con);
			}
		}
		$this->lastOpImportCriteria = $criteria;

		return $this->collOpImports;
	}

	
	public function initOpImportModificationss()
	{
		if ($this->collOpImportModificationss === null) {
			$this->collOpImportModificationss = array();
		}
	}

	
	public function getOpImportModificationss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportModificationsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpImportModificationss === null) {
			if ($this->isNew()) {
			   $this->collOpImportModificationss = array();
			} else {

				$criteria->add(OpImportModificationsPeer::IMPORT_ID, $this->getId());

				OpImportModificationsPeer::addSelectColumns($criteria);
				$this->collOpImportModificationss = OpImportModificationsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpImportModificationsPeer::IMPORT_ID, $this->getId());

				OpImportModificationsPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpImportModificationsCriteria) || !$this->lastOpImportModificationsCriteria->equals($criteria)) {
					$this->collOpImportModificationss = OpImportModificationsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpImportModificationsCriteria = $criteria;
		return $this->collOpImportModificationss;
	}

	
	public function countOpImportModificationss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportModificationsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpImportModificationsPeer::IMPORT_ID, $this->getId());

		return OpImportModificationsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpImportModifications(OpImportModifications $l)
	{
		$this->collOpImportModificationss[] = $l;
		$l->setOpImportMinint($this);
	}


	
	public function getOpImportModificationssJoinOpLocation($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportModificationsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpImportModificationss === null) {
			if ($this->isNew()) {
				$this->collOpImportModificationss = array();
			} else {

				$criteria->add(OpImportModificationsPeer::IMPORT_ID, $this->getId());

				$this->collOpImportModificationss = OpImportModificationsPeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpImportModificationsPeer::IMPORT_ID, $this->getId());

			if (!isset($this->lastOpImportModificationsCriteria) || !$this->lastOpImportModificationsCriteria->equals($criteria)) {
				$this->collOpImportModificationss = OpImportModificationsPeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpImportModificationsCriteria = $criteria;

		return $this->collOpImportModificationss;
	}

} 