<?php


abstract class BaseOpParty extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $istat_code;


	
	protected $name;


	
	protected $acronym;


	
	protected $party = 0;


	
	protected $main = 0;


	
	protected $electoral = 0;


	
	protected $oid;


	
	protected $oname;


	
	protected $logo;


	
	protected $id;

	
	protected $collOpHolderHasPositionOnThemes;

	
	protected $lastOpHolderHasPositionOnThemeCriteria = null;

	
	protected $collOpInstitutionCharges;

	
	protected $lastOpInstitutionChargeCriteria = null;

	
	protected $collOpPartyLocations;

	
	protected $lastOpPartyLocationCriteria = null;

	
	protected $collOpPoliticalCharges;

	
	protected $lastOpPoliticalChargeCriteria = null;

	
	protected $collOpThemeHasDeclarations;

	
	protected $lastOpThemeHasDeclarationCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIstatCode()
	{

		return $this->istat_code;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getAcronym()
	{

		return $this->acronym;
	}

	
	public function getParty()
	{

		return $this->party;
	}

	
	public function getMain()
	{

		return $this->main;
	}

	
	public function getElectoral()
	{

		return $this->electoral;
	}

	
	public function getOid()
	{

		return $this->oid;
	}

	
	public function getOname()
	{

		return $this->oname;
	}

	
	public function getLogo()
	{

		return $this->logo;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setIstatCode($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->istat_code !== $v) {
			$this->istat_code = $v;
			$this->modifiedColumns[] = OpPartyPeer::ISTAT_CODE;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = OpPartyPeer::NAME;
		}

	} 
	
	public function setAcronym($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->acronym !== $v) {
			$this->acronym = $v;
			$this->modifiedColumns[] = OpPartyPeer::ACRONYM;
		}

	} 
	
	public function setParty($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->party !== $v || $v === 0) {
			$this->party = $v;
			$this->modifiedColumns[] = OpPartyPeer::PARTY;
		}

	} 
	
	public function setMain($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->main !== $v || $v === 0) {
			$this->main = $v;
			$this->modifiedColumns[] = OpPartyPeer::MAIN;
		}

	} 
	
	public function setElectoral($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->electoral !== $v || $v === 0) {
			$this->electoral = $v;
			$this->modifiedColumns[] = OpPartyPeer::ELECTORAL;
		}

	} 
	
	public function setOid($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->oid !== $v) {
			$this->oid = $v;
			$this->modifiedColumns[] = OpPartyPeer::OID;
		}

	} 
	
	public function setOname($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->oname !== $v) {
			$this->oname = $v;
			$this->modifiedColumns[] = OpPartyPeer::ONAME;
		}

	} 
	
	public function setLogo($v)
	{

								if ($v instanceof Lob && $v === $this->logo) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->logo !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->logo = $obj;
			$this->modifiedColumns[] = OpPartyPeer::LOGO;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpPartyPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->istat_code = $rs->getString($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->acronym = $rs->getString($startcol + 2);

			$this->party = $rs->getInt($startcol + 3);

			$this->main = $rs->getInt($startcol + 4);

			$this->electoral = $rs->getInt($startcol + 5);

			$this->oid = $rs->getInt($startcol + 6);

			$this->oname = $rs->getString($startcol + 7);

			$this->logo = $rs->getBlob($startcol + 8);

			$this->id = $rs->getInt($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpParty object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpPartyPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpPartyPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpPartyPeer::DATABASE_NAME);
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
					$pk = OpPartyPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpPartyPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpHolderHasPositionOnThemes !== null) {
				foreach($this->collOpHolderHasPositionOnThemes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpInstitutionCharges !== null) {
				foreach($this->collOpInstitutionCharges as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpPartyLocations !== null) {
				foreach($this->collOpPartyLocations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpPoliticalCharges !== null) {
				foreach($this->collOpPoliticalCharges as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpThemeHasDeclarations !== null) {
				foreach($this->collOpThemeHasDeclarations as $referrerFK) {
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


			if (($retval = OpPartyPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpHolderHasPositionOnThemes !== null) {
					foreach($this->collOpHolderHasPositionOnThemes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpInstitutionCharges !== null) {
					foreach($this->collOpInstitutionCharges as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpPartyLocations !== null) {
					foreach($this->collOpPartyLocations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpPoliticalCharges !== null) {
					foreach($this->collOpPoliticalCharges as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpThemeHasDeclarations !== null) {
					foreach($this->collOpThemeHasDeclarations as $referrerFK) {
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
		$pos = OpPartyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIstatCode();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getAcronym();
				break;
			case 3:
				return $this->getParty();
				break;
			case 4:
				return $this->getMain();
				break;
			case 5:
				return $this->getElectoral();
				break;
			case 6:
				return $this->getOid();
				break;
			case 7:
				return $this->getOname();
				break;
			case 8:
				return $this->getLogo();
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
		$keys = OpPartyPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIstatCode(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getAcronym(),
			$keys[3] => $this->getParty(),
			$keys[4] => $this->getMain(),
			$keys[5] => $this->getElectoral(),
			$keys[6] => $this->getOid(),
			$keys[7] => $this->getOname(),
			$keys[8] => $this->getLogo(),
			$keys[9] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpPartyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIstatCode($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setAcronym($value);
				break;
			case 3:
				$this->setParty($value);
				break;
			case 4:
				$this->setMain($value);
				break;
			case 5:
				$this->setElectoral($value);
				break;
			case 6:
				$this->setOid($value);
				break;
			case 7:
				$this->setOname($value);
				break;
			case 8:
				$this->setLogo($value);
				break;
			case 9:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpPartyPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIstatCode($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAcronym($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setParty($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMain($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setElectoral($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setOid($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setOname($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLogo($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setId($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpPartyPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpPartyPeer::ISTAT_CODE)) $criteria->add(OpPartyPeer::ISTAT_CODE, $this->istat_code);
		if ($this->isColumnModified(OpPartyPeer::NAME)) $criteria->add(OpPartyPeer::NAME, $this->name);
		if ($this->isColumnModified(OpPartyPeer::ACRONYM)) $criteria->add(OpPartyPeer::ACRONYM, $this->acronym);
		if ($this->isColumnModified(OpPartyPeer::PARTY)) $criteria->add(OpPartyPeer::PARTY, $this->party);
		if ($this->isColumnModified(OpPartyPeer::MAIN)) $criteria->add(OpPartyPeer::MAIN, $this->main);
		if ($this->isColumnModified(OpPartyPeer::ELECTORAL)) $criteria->add(OpPartyPeer::ELECTORAL, $this->electoral);
		if ($this->isColumnModified(OpPartyPeer::OID)) $criteria->add(OpPartyPeer::OID, $this->oid);
		if ($this->isColumnModified(OpPartyPeer::ONAME)) $criteria->add(OpPartyPeer::ONAME, $this->oname);
		if ($this->isColumnModified(OpPartyPeer::LOGO)) $criteria->add(OpPartyPeer::LOGO, $this->logo);
		if ($this->isColumnModified(OpPartyPeer::ID)) $criteria->add(OpPartyPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpPartyPeer::DATABASE_NAME);

		$criteria->add(OpPartyPeer::ID, $this->id);

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

		$copyObj->setIstatCode($this->istat_code);

		$copyObj->setName($this->name);

		$copyObj->setAcronym($this->acronym);

		$copyObj->setParty($this->party);

		$copyObj->setMain($this->main);

		$copyObj->setElectoral($this->electoral);

		$copyObj->setOid($this->oid);

		$copyObj->setOname($this->oname);

		$copyObj->setLogo($this->logo);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpHolderHasPositionOnThemes() as $relObj) {
				$copyObj->addOpHolderHasPositionOnTheme($relObj->copy($deepCopy));
			}

			foreach($this->getOpInstitutionCharges() as $relObj) {
				$copyObj->addOpInstitutionCharge($relObj->copy($deepCopy));
			}

			foreach($this->getOpPartyLocations() as $relObj) {
				$copyObj->addOpPartyLocation($relObj->copy($deepCopy));
			}

			foreach($this->getOpPoliticalCharges() as $relObj) {
				$copyObj->addOpPoliticalCharge($relObj->copy($deepCopy));
			}

			foreach($this->getOpThemeHasDeclarations() as $relObj) {
				$copyObj->addOpThemeHasDeclaration($relObj->copy($deepCopy));
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
			self::$peer = new OpPartyPeer();
		}
		return self::$peer;
	}

	
	public function initOpHolderHasPositionOnThemes()
	{
		if ($this->collOpHolderHasPositionOnThemes === null) {
			$this->collOpHolderHasPositionOnThemes = array();
		}
	}

	
	public function getOpHolderHasPositionOnThemes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpHolderHasPositionOnThemePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpHolderHasPositionOnThemes === null) {
			if ($this->isNew()) {
			   $this->collOpHolderHasPositionOnThemes = array();
			} else {

				$criteria->add(OpHolderHasPositionOnThemePeer::PARTY_ID, $this->getId());

				OpHolderHasPositionOnThemePeer::addSelectColumns($criteria);
				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpHolderHasPositionOnThemePeer::PARTY_ID, $this->getId());

				OpHolderHasPositionOnThemePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpHolderHasPositionOnThemeCriteria) || !$this->lastOpHolderHasPositionOnThemeCriteria->equals($criteria)) {
					$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpHolderHasPositionOnThemeCriteria = $criteria;
		return $this->collOpHolderHasPositionOnThemes;
	}

	
	public function countOpHolderHasPositionOnThemes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpHolderHasPositionOnThemePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpHolderHasPositionOnThemePeer::PARTY_ID, $this->getId());

		return OpHolderHasPositionOnThemePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpHolderHasPositionOnTheme(OpHolderHasPositionOnTheme $l)
	{
		$this->collOpHolderHasPositionOnThemes[] = $l;
		$l->setOpParty($this);
	}


	
	public function getOpHolderHasPositionOnThemesJoinOpTheme($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpHolderHasPositionOnThemePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpHolderHasPositionOnThemes === null) {
			if ($this->isNew()) {
				$this->collOpHolderHasPositionOnThemes = array();
			} else {

				$criteria->add(OpHolderHasPositionOnThemePeer::PARTY_ID, $this->getId());

				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelectJoinOpTheme($criteria, $con);
			}
		} else {
									
			$criteria->add(OpHolderHasPositionOnThemePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpHolderHasPositionOnThemeCriteria) || !$this->lastOpHolderHasPositionOnThemeCriteria->equals($criteria)) {
				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelectJoinOpTheme($criteria, $con);
			}
		}
		$this->lastOpHolderHasPositionOnThemeCriteria = $criteria;

		return $this->collOpHolderHasPositionOnThemes;
	}


	
	public function getOpHolderHasPositionOnThemesJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpHolderHasPositionOnThemePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpHolderHasPositionOnThemes === null) {
			if ($this->isNew()) {
				$this->collOpHolderHasPositionOnThemes = array();
			} else {

				$criteria->add(OpHolderHasPositionOnThemePeer::PARTY_ID, $this->getId());

				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpHolderHasPositionOnThemePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpHolderHasPositionOnThemeCriteria) || !$this->lastOpHolderHasPositionOnThemeCriteria->equals($criteria)) {
				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpHolderHasPositionOnThemeCriteria = $criteria;

		return $this->collOpHolderHasPositionOnThemes;
	}

	
	public function initOpInstitutionCharges()
	{
		if ($this->collOpInstitutionCharges === null) {
			$this->collOpInstitutionCharges = array();
		}
	}

	
	public function getOpInstitutionCharges($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
			   $this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

				OpInstitutionChargePeer::addSelectColumns($criteria);
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

				OpInstitutionChargePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
					$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;
		return $this->collOpInstitutionCharges;
	}

	
	public function countOpInstitutionCharges($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

		return OpInstitutionChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpInstitutionCharge(OpInstitutionCharge $l)
	{
		$this->collOpInstitutionCharges[] = $l;
		$l->setOpParty($this);
	}


	
	public function getOpInstitutionChargesJoinOpOpenContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpInstitution($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpInstitution($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpInstitution($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpChargeType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpLocation($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpConstituency($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpConstituency($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpConstituency($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpGroup($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpInstitutionChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpInstitutionCharges === null) {
			if ($this->isNew()) {
				$this->collOpInstitutionCharges = array();
			} else {

				$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpGroup($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpGroup($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}

	
	public function initOpPartyLocations()
	{
		if ($this->collOpPartyLocations === null) {
			$this->collOpPartyLocations = array();
		}
	}

	
	public function getOpPartyLocations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPartyLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPartyLocations === null) {
			if ($this->isNew()) {
			   $this->collOpPartyLocations = array();
			} else {

				$criteria->add(OpPartyLocationPeer::PARTY_ID, $this->getId());

				OpPartyLocationPeer::addSelectColumns($criteria);
				$this->collOpPartyLocations = OpPartyLocationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPartyLocationPeer::PARTY_ID, $this->getId());

				OpPartyLocationPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpPartyLocationCriteria) || !$this->lastOpPartyLocationCriteria->equals($criteria)) {
					$this->collOpPartyLocations = OpPartyLocationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpPartyLocationCriteria = $criteria;
		return $this->collOpPartyLocations;
	}

	
	public function countOpPartyLocations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpPartyLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpPartyLocationPeer::PARTY_ID, $this->getId());

		return OpPartyLocationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPartyLocation(OpPartyLocation $l)
	{
		$this->collOpPartyLocations[] = $l;
		$l->setOpParty($this);
	}


	
	public function getOpPartyLocationsJoinOpLocation($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPartyLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPartyLocations === null) {
			if ($this->isNew()) {
				$this->collOpPartyLocations = array();
			} else {

				$criteria->add(OpPartyLocationPeer::PARTY_ID, $this->getId());

				$this->collOpPartyLocations = OpPartyLocationPeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPartyLocationPeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpPartyLocationCriteria) || !$this->lastOpPartyLocationCriteria->equals($criteria)) {
				$this->collOpPartyLocations = OpPartyLocationPeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpPartyLocationCriteria = $criteria;

		return $this->collOpPartyLocations;
	}

	
	public function initOpPoliticalCharges()
	{
		if ($this->collOpPoliticalCharges === null) {
			$this->collOpPoliticalCharges = array();
		}
	}

	
	public function getOpPoliticalCharges($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
			   $this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::PARTY_ID, $this->getId());

				OpPoliticalChargePeer::addSelectColumns($criteria);
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPoliticalChargePeer::PARTY_ID, $this->getId());

				OpPoliticalChargePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
					$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;
		return $this->collOpPoliticalCharges;
	}

	
	public function countOpPoliticalCharges($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpPoliticalChargePeer::PARTY_ID, $this->getId());

		return OpPoliticalChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPoliticalCharge(OpPoliticalCharge $l)
	{
		$this->collOpPoliticalCharges[] = $l;
		$l->setOpParty($this);
	}


	
	public function getOpPoliticalChargesJoinOpOpenContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
				$this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::PARTY_ID, $this->getId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}


	
	public function getOpPoliticalChargesJoinOpChargeType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
				$this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::PARTY_ID, $this->getId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}


	
	public function getOpPoliticalChargesJoinOpPolitician($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
				$this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::PARTY_ID, $this->getId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}


	
	public function getOpPoliticalChargesJoinOpLocation($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticalCharges === null) {
			if ($this->isNew()) {
				$this->collOpPoliticalCharges = array();
			} else {

				$criteria->add(OpPoliticalChargePeer::PARTY_ID, $this->getId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}

	
	public function initOpThemeHasDeclarations()
	{
		if ($this->collOpThemeHasDeclarations === null) {
			$this->collOpThemeHasDeclarations = array();
		}
	}

	
	public function getOpThemeHasDeclarations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpThemeHasDeclarationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpThemeHasDeclarations === null) {
			if ($this->isNew()) {
			   $this->collOpThemeHasDeclarations = array();
			} else {

				$criteria->add(OpThemeHasDeclarationPeer::PARTY_ID, $this->getId());

				OpThemeHasDeclarationPeer::addSelectColumns($criteria);
				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpThemeHasDeclarationPeer::PARTY_ID, $this->getId());

				OpThemeHasDeclarationPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpThemeHasDeclarationCriteria) || !$this->lastOpThemeHasDeclarationCriteria->equals($criteria)) {
					$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpThemeHasDeclarationCriteria = $criteria;
		return $this->collOpThemeHasDeclarations;
	}

	
	public function countOpThemeHasDeclarations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpThemeHasDeclarationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpThemeHasDeclarationPeer::PARTY_ID, $this->getId());

		return OpThemeHasDeclarationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpThemeHasDeclaration(OpThemeHasDeclaration $l)
	{
		$this->collOpThemeHasDeclarations[] = $l;
		$l->setOpParty($this);
	}


	
	public function getOpThemeHasDeclarationsJoinOpDeclaration($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpThemeHasDeclarationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpThemeHasDeclarations === null) {
			if ($this->isNew()) {
				$this->collOpThemeHasDeclarations = array();
			} else {

				$criteria->add(OpThemeHasDeclarationPeer::PARTY_ID, $this->getId());

				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelectJoinOpDeclaration($criteria, $con);
			}
		} else {
									
			$criteria->add(OpThemeHasDeclarationPeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpThemeHasDeclarationCriteria) || !$this->lastOpThemeHasDeclarationCriteria->equals($criteria)) {
				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelectJoinOpDeclaration($criteria, $con);
			}
		}
		$this->lastOpThemeHasDeclarationCriteria = $criteria;

		return $this->collOpThemeHasDeclarations;
	}


	
	public function getOpThemeHasDeclarationsJoinOpTheme($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpThemeHasDeclarationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpThemeHasDeclarations === null) {
			if ($this->isNew()) {
				$this->collOpThemeHasDeclarations = array();
			} else {

				$criteria->add(OpThemeHasDeclarationPeer::PARTY_ID, $this->getId());

				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelectJoinOpTheme($criteria, $con);
			}
		} else {
									
			$criteria->add(OpThemeHasDeclarationPeer::PARTY_ID, $this->getId());

			if (!isset($this->lastOpThemeHasDeclarationCriteria) || !$this->lastOpThemeHasDeclarationCriteria->equals($criteria)) {
				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelectJoinOpTheme($criteria, $con);
			}
		}
		$this->lastOpThemeHasDeclarationCriteria = $criteria;

		return $this->collOpThemeHasDeclarations;
	}

} 