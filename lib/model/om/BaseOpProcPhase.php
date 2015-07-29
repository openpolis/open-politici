<?php


abstract class BaseOpProcPhase extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $status_type_id;


	
	protected $phase_type_id;


	
	protected $procedimento_id;


	
	protected $sentence;


	
	protected $motivation;


	
	protected $source_name;


	
	protected $source_url;


	
	protected $source_attach;


	
	protected $phase_year;


	
	protected $tribunal_location;


	
	protected $id;

	
	protected $aOpStatusType;

	
	protected $aOpPhaseType;

	
	protected $aOpProcedimento;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getStatusTypeId()
	{

		return $this->status_type_id;
	}

	
	public function getPhaseTypeId()
	{

		return $this->phase_type_id;
	}

	
	public function getProcedimentoId()
	{

		return $this->procedimento_id;
	}

	
	public function getSentence()
	{

		return $this->sentence;
	}

	
	public function getMotivation()
	{

		return $this->motivation;
	}

	
	public function getSourceName()
	{

		return $this->source_name;
	}

	
	public function getSourceUrl()
	{

		return $this->source_url;
	}

	
	public function getSourceAttach()
	{

		return $this->source_attach;
	}

	
	public function getPhaseYear()
	{

		return $this->phase_year;
	}

	
	public function getTribunalLocation()
	{

		return $this->tribunal_location;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setStatusTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status_type_id !== $v) {
			$this->status_type_id = $v;
			$this->modifiedColumns[] = OpProcPhasePeer::STATUS_TYPE_ID;
		}

		if ($this->aOpStatusType !== null && $this->aOpStatusType->getId() !== $v) {
			$this->aOpStatusType = null;
		}

	} 
	
	public function setPhaseTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->phase_type_id !== $v) {
			$this->phase_type_id = $v;
			$this->modifiedColumns[] = OpProcPhasePeer::PHASE_TYPE_ID;
		}

		if ($this->aOpPhaseType !== null && $this->aOpPhaseType->getId() !== $v) {
			$this->aOpPhaseType = null;
		}

	} 
	
	public function setProcedimentoId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->procedimento_id !== $v) {
			$this->procedimento_id = $v;
			$this->modifiedColumns[] = OpProcPhasePeer::PROCEDIMENTO_ID;
		}

		if ($this->aOpProcedimento !== null && $this->aOpProcedimento->getContentId() !== $v) {
			$this->aOpProcedimento = null;
		}

	} 
	
	public function setSentence($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sentence !== $v) {
			$this->sentence = $v;
			$this->modifiedColumns[] = OpProcPhasePeer::SENTENCE;
		}

	} 
	
	public function setMotivation($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->motivation !== $v) {
			$this->motivation = $v;
			$this->modifiedColumns[] = OpProcPhasePeer::MOTIVATION;
		}

	} 
	
	public function setSourceName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->source_name !== $v) {
			$this->source_name = $v;
			$this->modifiedColumns[] = OpProcPhasePeer::SOURCE_NAME;
		}

	} 
	
	public function setSourceUrl($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->source_url !== $v) {
			$this->source_url = $v;
			$this->modifiedColumns[] = OpProcPhasePeer::SOURCE_URL;
		}

	} 
	
	public function setSourceAttach($v)
	{

								if ($v instanceof Lob && $v === $this->source_attach) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->source_attach !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->source_attach = $obj;
			$this->modifiedColumns[] = OpProcPhasePeer::SOURCE_ATTACH;
		}

	} 
	
	public function setPhaseYear($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->phase_year !== $v) {
			$this->phase_year = $v;
			$this->modifiedColumns[] = OpProcPhasePeer::PHASE_YEAR;
		}

	} 
	
	public function setTribunalLocation($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tribunal_location !== $v) {
			$this->tribunal_location = $v;
			$this->modifiedColumns[] = OpProcPhasePeer::TRIBUNAL_LOCATION;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpProcPhasePeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->status_type_id = $rs->getInt($startcol + 0);

			$this->phase_type_id = $rs->getInt($startcol + 1);

			$this->procedimento_id = $rs->getInt($startcol + 2);

			$this->sentence = $rs->getString($startcol + 3);

			$this->motivation = $rs->getString($startcol + 4);

			$this->source_name = $rs->getString($startcol + 5);

			$this->source_url = $rs->getString($startcol + 6);

			$this->source_attach = $rs->getBlob($startcol + 7);

			$this->phase_year = $rs->getInt($startcol + 8);

			$this->tribunal_location = $rs->getString($startcol + 9);

			$this->id = $rs->getInt($startcol + 10);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpProcPhase object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpProcPhasePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpProcPhasePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpProcPhasePeer::DATABASE_NAME);
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


												
			if ($this->aOpStatusType !== null) {
				if ($this->aOpStatusType->isModified()) {
					$affectedRows += $this->aOpStatusType->save($con);
				}
				$this->setOpStatusType($this->aOpStatusType);
			}

			if ($this->aOpPhaseType !== null) {
				if ($this->aOpPhaseType->isModified()) {
					$affectedRows += $this->aOpPhaseType->save($con);
				}
				$this->setOpPhaseType($this->aOpPhaseType);
			}

			if ($this->aOpProcedimento !== null) {
				if ($this->aOpProcedimento->isModified()) {
					$affectedRows += $this->aOpProcedimento->save($con);
				}
				$this->setOpProcedimento($this->aOpProcedimento);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpProcPhasePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpProcPhasePeer::doUpdate($this, $con);
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


												
			if ($this->aOpStatusType !== null) {
				if (!$this->aOpStatusType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpStatusType->getValidationFailures());
				}
			}

			if ($this->aOpPhaseType !== null) {
				if (!$this->aOpPhaseType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpPhaseType->getValidationFailures());
				}
			}

			if ($this->aOpProcedimento !== null) {
				if (!$this->aOpProcedimento->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpProcedimento->getValidationFailures());
				}
			}


			if (($retval = OpProcPhasePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpProcPhasePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getStatusTypeId();
				break;
			case 1:
				return $this->getPhaseTypeId();
				break;
			case 2:
				return $this->getProcedimentoId();
				break;
			case 3:
				return $this->getSentence();
				break;
			case 4:
				return $this->getMotivation();
				break;
			case 5:
				return $this->getSourceName();
				break;
			case 6:
				return $this->getSourceUrl();
				break;
			case 7:
				return $this->getSourceAttach();
				break;
			case 8:
				return $this->getPhaseYear();
				break;
			case 9:
				return $this->getTribunalLocation();
				break;
			case 10:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpProcPhasePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getStatusTypeId(),
			$keys[1] => $this->getPhaseTypeId(),
			$keys[2] => $this->getProcedimentoId(),
			$keys[3] => $this->getSentence(),
			$keys[4] => $this->getMotivation(),
			$keys[5] => $this->getSourceName(),
			$keys[6] => $this->getSourceUrl(),
			$keys[7] => $this->getSourceAttach(),
			$keys[8] => $this->getPhaseYear(),
			$keys[9] => $this->getTribunalLocation(),
			$keys[10] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpProcPhasePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setStatusTypeId($value);
				break;
			case 1:
				$this->setPhaseTypeId($value);
				break;
			case 2:
				$this->setProcedimentoId($value);
				break;
			case 3:
				$this->setSentence($value);
				break;
			case 4:
				$this->setMotivation($value);
				break;
			case 5:
				$this->setSourceName($value);
				break;
			case 6:
				$this->setSourceUrl($value);
				break;
			case 7:
				$this->setSourceAttach($value);
				break;
			case 8:
				$this->setPhaseYear($value);
				break;
			case 9:
				$this->setTribunalLocation($value);
				break;
			case 10:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpProcPhasePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setStatusTypeId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPhaseTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setProcedimentoId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSentence($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMotivation($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSourceName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSourceUrl($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSourceAttach($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPhaseYear($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTribunalLocation($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setId($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpProcPhasePeer::DATABASE_NAME);

		if ($this->isColumnModified(OpProcPhasePeer::STATUS_TYPE_ID)) $criteria->add(OpProcPhasePeer::STATUS_TYPE_ID, $this->status_type_id);
		if ($this->isColumnModified(OpProcPhasePeer::PHASE_TYPE_ID)) $criteria->add(OpProcPhasePeer::PHASE_TYPE_ID, $this->phase_type_id);
		if ($this->isColumnModified(OpProcPhasePeer::PROCEDIMENTO_ID)) $criteria->add(OpProcPhasePeer::PROCEDIMENTO_ID, $this->procedimento_id);
		if ($this->isColumnModified(OpProcPhasePeer::SENTENCE)) $criteria->add(OpProcPhasePeer::SENTENCE, $this->sentence);
		if ($this->isColumnModified(OpProcPhasePeer::MOTIVATION)) $criteria->add(OpProcPhasePeer::MOTIVATION, $this->motivation);
		if ($this->isColumnModified(OpProcPhasePeer::SOURCE_NAME)) $criteria->add(OpProcPhasePeer::SOURCE_NAME, $this->source_name);
		if ($this->isColumnModified(OpProcPhasePeer::SOURCE_URL)) $criteria->add(OpProcPhasePeer::SOURCE_URL, $this->source_url);
		if ($this->isColumnModified(OpProcPhasePeer::SOURCE_ATTACH)) $criteria->add(OpProcPhasePeer::SOURCE_ATTACH, $this->source_attach);
		if ($this->isColumnModified(OpProcPhasePeer::PHASE_YEAR)) $criteria->add(OpProcPhasePeer::PHASE_YEAR, $this->phase_year);
		if ($this->isColumnModified(OpProcPhasePeer::TRIBUNAL_LOCATION)) $criteria->add(OpProcPhasePeer::TRIBUNAL_LOCATION, $this->tribunal_location);
		if ($this->isColumnModified(OpProcPhasePeer::ID)) $criteria->add(OpProcPhasePeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpProcPhasePeer::DATABASE_NAME);

		$criteria->add(OpProcPhasePeer::ID, $this->id);

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

		$copyObj->setStatusTypeId($this->status_type_id);

		$copyObj->setPhaseTypeId($this->phase_type_id);

		$copyObj->setProcedimentoId($this->procedimento_id);

		$copyObj->setSentence($this->sentence);

		$copyObj->setMotivation($this->motivation);

		$copyObj->setSourceName($this->source_name);

		$copyObj->setSourceUrl($this->source_url);

		$copyObj->setSourceAttach($this->source_attach);

		$copyObj->setPhaseYear($this->phase_year);

		$copyObj->setTribunalLocation($this->tribunal_location);


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
			self::$peer = new OpProcPhasePeer();
		}
		return self::$peer;
	}

	
	public function setOpStatusType($v)
	{


		if ($v === null) {
			$this->setStatusTypeId(NULL);
		} else {
			$this->setStatusTypeId($v->getId());
		}


		$this->aOpStatusType = $v;
	}


	
	public function getOpStatusType($con = null)
	{
		if ($this->aOpStatusType === null && ($this->status_type_id !== null)) {
						include_once 'lib/model/om/BaseOpStatusTypePeer.php';

			$this->aOpStatusType = OpStatusTypePeer::retrieveByPK($this->status_type_id, $con);

			
		}
		return $this->aOpStatusType;
	}

	
	public function setOpPhaseType($v)
	{


		if ($v === null) {
			$this->setPhaseTypeId(NULL);
		} else {
			$this->setPhaseTypeId($v->getId());
		}


		$this->aOpPhaseType = $v;
	}


	
	public function getOpPhaseType($con = null)
	{
		if ($this->aOpPhaseType === null && ($this->phase_type_id !== null)) {
						include_once 'lib/model/om/BaseOpPhaseTypePeer.php';

			$this->aOpPhaseType = OpPhaseTypePeer::retrieveByPK($this->phase_type_id, $con);

			
		}
		return $this->aOpPhaseType;
	}

	
	public function setOpProcedimento($v)
	{


		if ($v === null) {
			$this->setProcedimentoId(NULL);
		} else {
			$this->setProcedimentoId($v->getContentId());
		}


		$this->aOpProcedimento = $v;
	}


	
	public function getOpProcedimento($con = null)
	{
		if ($this->aOpProcedimento === null && ($this->procedimento_id !== null)) {
						include_once 'lib/model/om/BaseOpProcedimentoPeer.php';

			$this->aOpProcedimento = OpProcedimentoPeer::retrieveByPK($this->procedimento_id, $con);

			
		}
		return $this->aOpProcedimento;
	}

} 