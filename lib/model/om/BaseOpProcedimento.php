<?php


abstract class BaseOpProcedimento extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $content_id;


	
	protected $politician_id;


	
	protected $date;


	
	protected $title;


	
	protected $description;


	
	protected $alleged_crimes;

	
	protected $aOpOpinableContent;

	
	protected $aOpPolitician;

	
	protected $collOpProcPhases;

	
	protected $lastOpProcPhaseCriteria = null;

	
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

	
	public function getDate($format = 'Y-m-d')
	{

		if ($this->date === null || $this->date === '') {
			return null;
		} elseif (!is_int($this->date)) {
						$ts = strtotime($this->date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [date] as date/time value: " . var_export($this->date, true));
			}
		} else {
			$ts = $this->date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getAllegedCrimes()
	{

		return $this->alleged_crimes;
	}

	
	public function setContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->content_id !== $v) {
			$this->content_id = $v;
			$this->modifiedColumns[] = OpProcedimentoPeer::CONTENT_ID;
		}

		if ($this->aOpOpinableContent !== null && $this->aOpOpinableContent->getContentId() !== $v) {
			$this->aOpOpinableContent = null;
		}

	} 
	
	public function setPoliticianId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->politician_id !== $v) {
			$this->politician_id = $v;
			$this->modifiedColumns[] = OpProcedimentoPeer::POLITICIAN_ID;
		}

		if ($this->aOpPolitician !== null && $this->aOpPolitician->getContentId() !== $v) {
			$this->aOpPolitician = null;
		}

	} 
	
	public function setDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->date !== $ts) {
			$this->date = $ts;
			$this->modifiedColumns[] = OpProcedimentoPeer::DATE;
		}

	} 
	
	public function setTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = OpProcedimentoPeer::TITLE;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = OpProcedimentoPeer::DESCRIPTION;
		}

	} 
	
	public function setAllegedCrimes($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->alleged_crimes !== $v) {
			$this->alleged_crimes = $v;
			$this->modifiedColumns[] = OpProcedimentoPeer::ALLEGED_CRIMES;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->content_id = $rs->getInt($startcol + 0);

			$this->politician_id = $rs->getInt($startcol + 1);

			$this->date = $rs->getDate($startcol + 2, null);

			$this->title = $rs->getString($startcol + 3);

			$this->description = $rs->getString($startcol + 4);

			$this->alleged_crimes = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpProcedimento object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpProcedimentoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpProcedimentoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpProcedimentoPeer::DATABASE_NAME);
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


												
			if ($this->aOpOpinableContent !== null) {
				if ($this->aOpOpinableContent->isModified()) {
					$affectedRows += $this->aOpOpinableContent->save($con);
				}
				$this->setOpOpinableContent($this->aOpOpinableContent);
			}

			if ($this->aOpPolitician !== null) {
				if ($this->aOpPolitician->isModified()) {
					$affectedRows += $this->aOpPolitician->save($con);
				}
				$this->setOpPolitician($this->aOpPolitician);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpProcedimentoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpProcedimentoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpProcPhases !== null) {
				foreach($this->collOpProcPhases as $referrerFK) {
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


												
			if ($this->aOpOpinableContent !== null) {
				if (!$this->aOpOpinableContent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpOpinableContent->getValidationFailures());
				}
			}

			if ($this->aOpPolitician !== null) {
				if (!$this->aOpPolitician->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpPolitician->getValidationFailures());
				}
			}


			if (($retval = OpProcedimentoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpProcPhases !== null) {
					foreach($this->collOpProcPhases as $referrerFK) {
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
		$pos = OpProcedimentoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDate();
				break;
			case 3:
				return $this->getTitle();
				break;
			case 4:
				return $this->getDescription();
				break;
			case 5:
				return $this->getAllegedCrimes();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpProcedimentoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getContentId(),
			$keys[1] => $this->getPoliticianId(),
			$keys[2] => $this->getDate(),
			$keys[3] => $this->getTitle(),
			$keys[4] => $this->getDescription(),
			$keys[5] => $this->getAllegedCrimes(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpProcedimentoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDate($value);
				break;
			case 3:
				$this->setTitle($value);
				break;
			case 4:
				$this->setDescription($value);
				break;
			case 5:
				$this->setAllegedCrimes($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpProcedimentoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setContentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPoliticianId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDate($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAllegedCrimes($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpProcedimentoPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpProcedimentoPeer::CONTENT_ID)) $criteria->add(OpProcedimentoPeer::CONTENT_ID, $this->content_id);
		if ($this->isColumnModified(OpProcedimentoPeer::POLITICIAN_ID)) $criteria->add(OpProcedimentoPeer::POLITICIAN_ID, $this->politician_id);
		if ($this->isColumnModified(OpProcedimentoPeer::DATE)) $criteria->add(OpProcedimentoPeer::DATE, $this->date);
		if ($this->isColumnModified(OpProcedimentoPeer::TITLE)) $criteria->add(OpProcedimentoPeer::TITLE, $this->title);
		if ($this->isColumnModified(OpProcedimentoPeer::DESCRIPTION)) $criteria->add(OpProcedimentoPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(OpProcedimentoPeer::ALLEGED_CRIMES)) $criteria->add(OpProcedimentoPeer::ALLEGED_CRIMES, $this->alleged_crimes);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpProcedimentoPeer::DATABASE_NAME);

		$criteria->add(OpProcedimentoPeer::CONTENT_ID, $this->content_id);

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

		$copyObj->setDate($this->date);

		$copyObj->setTitle($this->title);

		$copyObj->setDescription($this->description);

		$copyObj->setAllegedCrimes($this->alleged_crimes);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpProcPhases() as $relObj) {
				$copyObj->addOpProcPhase($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new OpProcedimentoPeer();
		}
		return self::$peer;
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

	
	public function initOpProcPhases()
	{
		if ($this->collOpProcPhases === null) {
			$this->collOpProcPhases = array();
		}
	}

	
	public function getOpProcPhases($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpProcPhasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpProcPhases === null) {
			if ($this->isNew()) {
			   $this->collOpProcPhases = array();
			} else {

				$criteria->add(OpProcPhasePeer::PROCEDIMENTO_ID, $this->getContentId());

				OpProcPhasePeer::addSelectColumns($criteria);
				$this->collOpProcPhases = OpProcPhasePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpProcPhasePeer::PROCEDIMENTO_ID, $this->getContentId());

				OpProcPhasePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpProcPhaseCriteria) || !$this->lastOpProcPhaseCriteria->equals($criteria)) {
					$this->collOpProcPhases = OpProcPhasePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpProcPhaseCriteria = $criteria;
		return $this->collOpProcPhases;
	}

	
	public function countOpProcPhases($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpProcPhasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpProcPhasePeer::PROCEDIMENTO_ID, $this->getContentId());

		return OpProcPhasePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpProcPhase(OpProcPhase $l)
	{
		$this->collOpProcPhases[] = $l;
		$l->setOpProcedimento($this);
	}


	
	public function getOpProcPhasesJoinOpStatusType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpProcPhasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpProcPhases === null) {
			if ($this->isNew()) {
				$this->collOpProcPhases = array();
			} else {

				$criteria->add(OpProcPhasePeer::PROCEDIMENTO_ID, $this->getContentId());

				$this->collOpProcPhases = OpProcPhasePeer::doSelectJoinOpStatusType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpProcPhasePeer::PROCEDIMENTO_ID, $this->getContentId());

			if (!isset($this->lastOpProcPhaseCriteria) || !$this->lastOpProcPhaseCriteria->equals($criteria)) {
				$this->collOpProcPhases = OpProcPhasePeer::doSelectJoinOpStatusType($criteria, $con);
			}
		}
		$this->lastOpProcPhaseCriteria = $criteria;

		return $this->collOpProcPhases;
	}


	
	public function getOpProcPhasesJoinOpPhaseType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpProcPhasePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpProcPhases === null) {
			if ($this->isNew()) {
				$this->collOpProcPhases = array();
			} else {

				$criteria->add(OpProcPhasePeer::PROCEDIMENTO_ID, $this->getContentId());

				$this->collOpProcPhases = OpProcPhasePeer::doSelectJoinOpPhaseType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpProcPhasePeer::PROCEDIMENTO_ID, $this->getContentId());

			if (!isset($this->lastOpProcPhaseCriteria) || !$this->lastOpProcPhaseCriteria->equals($criteria)) {
				$this->collOpProcPhases = OpProcPhasePeer::doSelectJoinOpPhaseType($criteria, $con);
			}
		}
		$this->lastOpProcPhaseCriteria = $criteria;

		return $this->collOpProcPhases;
	}

} 