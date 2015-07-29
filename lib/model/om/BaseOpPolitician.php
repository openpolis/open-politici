<?php


abstract class BaseOpPolitician extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $content_id;


	
	protected $profession_id;


	
	protected $user_id;


	
	protected $creator_id;


	
	protected $first_name;


	
	protected $last_name;


	
	protected $sex;


	
	protected $picture;


	
	protected $birth_date;


	
	protected $birth_location;


	
	protected $death_date;


	
	protected $last_charge_update;


	
	protected $is_indexed = 0;


	
	protected $minint_aka;


	
	protected $slug;

	
	protected $aOpContent;

	
	protected $aOpProfession;

	
	protected $aOpUserRelatedByUserId;

	
	protected $aOpUserRelatedByCreatorId;

	
	protected $collOpDeclarations;

	
	protected $lastOpDeclarationCriteria = null;

	
	protected $collOpHolderHasPositionOnThemes;

	
	protected $lastOpHolderHasPositionOnThemeCriteria = null;

	
	protected $collOpInstitutionCharges;

	
	protected $lastOpInstitutionChargeCriteria = null;

	
	protected $collOpOrganizationCharges;

	
	protected $lastOpOrganizationChargeCriteria = null;

	
	protected $collOpPolAdoptions;

	
	protected $lastOpPolAdoptionCriteria = null;

	
	protected $collOpPoliticalCharges;

	
	protected $lastOpPoliticalChargeCriteria = null;

	
	protected $collOpPoliticianHasOpEducationLevels;

	
	protected $lastOpPoliticianHasOpEducationLevelCriteria = null;

	
	protected $collOpProcedimentos;

	
	protected $lastOpProcedimentoCriteria = null;

	
	protected $collOpResourcess;

	
	protected $lastOpResourcesCriteria = null;

	
	protected $collOpTaxDeclarations;

	
	protected $lastOpTaxDeclarationCriteria = null;

	
	protected $collOpSimilarPoliticiansRelatedByOriginalId;

	
	protected $lastOpSimilarPoliticianRelatedByOriginalIdCriteria = null;

	
	protected $collOpSimilarPoliticiansRelatedBySimilarId;

	
	protected $lastOpSimilarPoliticianRelatedBySimilarIdCriteria = null;

	
	protected $collOpMinintAkas;

	
	protected $lastOpMinintAkaCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getContentId()
	{

		return $this->content_id;
	}

	
	public function getProfessionId()
	{

		return $this->profession_id;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getCreatorId()
	{

		return $this->creator_id;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getSex()
	{

		return $this->sex;
	}

	
	public function getPicture()
	{

		return $this->picture;
	}

	
	public function getBirthDate($format = 'Y-m-d H:i:s')
	{

		if ($this->birth_date === null || $this->birth_date === '') {
			return null;
		} elseif (!is_int($this->birth_date)) {
						$ts = strtotime($this->birth_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [birth_date] as date/time value: " . var_export($this->birth_date, true));
			}
		} else {
			$ts = $this->birth_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getBirthLocation()
	{

		return $this->birth_location;
	}

	
	public function getDeathDate($format = 'Y-m-d H:i:s')
	{

		if ($this->death_date === null || $this->death_date === '') {
			return null;
		} elseif (!is_int($this->death_date)) {
						$ts = strtotime($this->death_date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [death_date] as date/time value: " . var_export($this->death_date, true));
			}
		} else {
			$ts = $this->death_date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getLastChargeUpdate($format = 'Y-m-d H:i:s')
	{

		if ($this->last_charge_update === null || $this->last_charge_update === '') {
			return null;
		} elseif (!is_int($this->last_charge_update)) {
						$ts = strtotime($this->last_charge_update);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [last_charge_update] as date/time value: " . var_export($this->last_charge_update, true));
			}
		} else {
			$ts = $this->last_charge_update;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getIsIndexed()
	{

		return $this->is_indexed;
	}

	
	public function getMinintAka()
	{

		return $this->minint_aka;
	}

	
	public function getSlug()
	{

		return $this->slug;
	}

	
	public function setContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->content_id !== $v) {
			$this->content_id = $v;
			$this->modifiedColumns[] = OpPoliticianPeer::CONTENT_ID;
		}

		if ($this->aOpContent !== null && $this->aOpContent->getId() !== $v) {
			$this->aOpContent = null;
		}

	} 
	
	public function setProfessionId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->profession_id !== $v) {
			$this->profession_id = $v;
			$this->modifiedColumns[] = OpPoliticianPeer::PROFESSION_ID;
		}

		if ($this->aOpProfession !== null && $this->aOpProfession->getId() !== $v) {
			$this->aOpProfession = null;
		}

	} 
	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = OpPoliticianPeer::USER_ID;
		}

		if ($this->aOpUserRelatedByUserId !== null && $this->aOpUserRelatedByUserId->getId() !== $v) {
			$this->aOpUserRelatedByUserId = null;
		}

	} 
	
	public function setCreatorId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->creator_id !== $v) {
			$this->creator_id = $v;
			$this->modifiedColumns[] = OpPoliticianPeer::CREATOR_ID;
		}

		if ($this->aOpUserRelatedByCreatorId !== null && $this->aOpUserRelatedByCreatorId->getId() !== $v) {
			$this->aOpUserRelatedByCreatorId = null;
		}

	} 
	
	public function setFirstName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = OpPoliticianPeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = OpPoliticianPeer::LAST_NAME;
		}

	} 
	
	public function setSex($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sex !== $v) {
			$this->sex = $v;
			$this->modifiedColumns[] = OpPoliticianPeer::SEX;
		}

	} 
	
	public function setPicture($v)
	{

								if ($v instanceof Lob && $v === $this->picture) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->picture !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->picture = $obj;
			$this->modifiedColumns[] = OpPoliticianPeer::PICTURE;
		}

	} 
	
	public function setBirthDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [birth_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->birth_date !== $ts) {
			$this->birth_date = $ts;
			$this->modifiedColumns[] = OpPoliticianPeer::BIRTH_DATE;
		}

	} 
	
	public function setBirthLocation($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->birth_location !== $v) {
			$this->birth_location = $v;
			$this->modifiedColumns[] = OpPoliticianPeer::BIRTH_LOCATION;
		}

	} 
	
	public function setDeathDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [death_date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->death_date !== $ts) {
			$this->death_date = $ts;
			$this->modifiedColumns[] = OpPoliticianPeer::DEATH_DATE;
		}

	} 
	
	public function setLastChargeUpdate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [last_charge_update] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_charge_update !== $ts) {
			$this->last_charge_update = $ts;
			$this->modifiedColumns[] = OpPoliticianPeer::LAST_CHARGE_UPDATE;
		}

	} 
	
	public function setIsIndexed($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_indexed !== $v || $v === 0) {
			$this->is_indexed = $v;
			$this->modifiedColumns[] = OpPoliticianPeer::IS_INDEXED;
		}

	} 
	
	public function setMinintAka($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->minint_aka !== $v) {
			$this->minint_aka = $v;
			$this->modifiedColumns[] = OpPoliticianPeer::MININT_AKA;
		}

	} 
	
	public function setSlug($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->slug !== $v) {
			$this->slug = $v;
			$this->modifiedColumns[] = OpPoliticianPeer::SLUG;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->content_id = $rs->getInt($startcol + 0);

			$this->profession_id = $rs->getInt($startcol + 1);

			$this->user_id = $rs->getInt($startcol + 2);

			$this->creator_id = $rs->getInt($startcol + 3);

			$this->first_name = $rs->getString($startcol + 4);

			$this->last_name = $rs->getString($startcol + 5);

			$this->sex = $rs->getString($startcol + 6);

			$this->picture = $rs->getBlob($startcol + 7);

			$this->birth_date = $rs->getTimestamp($startcol + 8, null);

			$this->birth_location = $rs->getString($startcol + 9);

			$this->death_date = $rs->getTimestamp($startcol + 10, null);

			$this->last_charge_update = $rs->getTimestamp($startcol + 11, null);

			$this->is_indexed = $rs->getInt($startcol + 12);

			$this->minint_aka = $rs->getString($startcol + 13);

			$this->slug = $rs->getString($startcol + 14);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 15; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpPolitician object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpPoliticianPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpPoliticianPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpPoliticianPeer::DATABASE_NAME);
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

			if ($this->aOpProfession !== null) {
				if ($this->aOpProfession->isModified()) {
					$affectedRows += $this->aOpProfession->save($con);
				}
				$this->setOpProfession($this->aOpProfession);
			}

			if ($this->aOpUserRelatedByUserId !== null) {
				if ($this->aOpUserRelatedByUserId->isModified()) {
					$affectedRows += $this->aOpUserRelatedByUserId->save($con);
				}
				$this->setOpUserRelatedByUserId($this->aOpUserRelatedByUserId);
			}

			if ($this->aOpUserRelatedByCreatorId !== null) {
				if ($this->aOpUserRelatedByCreatorId->isModified()) {
					$affectedRows += $this->aOpUserRelatedByCreatorId->save($con);
				}
				$this->setOpUserRelatedByCreatorId($this->aOpUserRelatedByCreatorId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpPoliticianPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpPoliticianPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpDeclarations !== null) {
				foreach($this->collOpDeclarations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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

			if ($this->collOpOrganizationCharges !== null) {
				foreach($this->collOpOrganizationCharges as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpPolAdoptions !== null) {
				foreach($this->collOpPolAdoptions as $referrerFK) {
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

			if ($this->collOpPoliticianHasOpEducationLevels !== null) {
				foreach($this->collOpPoliticianHasOpEducationLevels as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpProcedimentos !== null) {
				foreach($this->collOpProcedimentos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpResourcess !== null) {
				foreach($this->collOpResourcess as $referrerFK) {
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

			if ($this->collOpSimilarPoliticiansRelatedByOriginalId !== null) {
				foreach($this->collOpSimilarPoliticiansRelatedByOriginalId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpSimilarPoliticiansRelatedBySimilarId !== null) {
				foreach($this->collOpSimilarPoliticiansRelatedBySimilarId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpMinintAkas !== null) {
				foreach($this->collOpMinintAkas as $referrerFK) {
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


												
			if ($this->aOpContent !== null) {
				if (!$this->aOpContent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpContent->getValidationFailures());
				}
			}

			if ($this->aOpProfession !== null) {
				if (!$this->aOpProfession->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpProfession->getValidationFailures());
				}
			}

			if ($this->aOpUserRelatedByUserId !== null) {
				if (!$this->aOpUserRelatedByUserId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUserRelatedByUserId->getValidationFailures());
				}
			}

			if ($this->aOpUserRelatedByCreatorId !== null) {
				if (!$this->aOpUserRelatedByCreatorId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpUserRelatedByCreatorId->getValidationFailures());
				}
			}


			if (($retval = OpPoliticianPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpDeclarations !== null) {
					foreach($this->collOpDeclarations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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

				if ($this->collOpOrganizationCharges !== null) {
					foreach($this->collOpOrganizationCharges as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpPolAdoptions !== null) {
					foreach($this->collOpPolAdoptions as $referrerFK) {
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

				if ($this->collOpPoliticianHasOpEducationLevels !== null) {
					foreach($this->collOpPoliticianHasOpEducationLevels as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpProcedimentos !== null) {
					foreach($this->collOpProcedimentos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpResourcess !== null) {
					foreach($this->collOpResourcess as $referrerFK) {
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

				if ($this->collOpSimilarPoliticiansRelatedByOriginalId !== null) {
					foreach($this->collOpSimilarPoliticiansRelatedByOriginalId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpSimilarPoliticiansRelatedBySimilarId !== null) {
					foreach($this->collOpSimilarPoliticiansRelatedBySimilarId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpMinintAkas !== null) {
					foreach($this->collOpMinintAkas as $referrerFK) {
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
		$pos = OpPoliticianPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getContentId();
				break;
			case 1:
				return $this->getProfessionId();
				break;
			case 2:
				return $this->getUserId();
				break;
			case 3:
				return $this->getCreatorId();
				break;
			case 4:
				return $this->getFirstName();
				break;
			case 5:
				return $this->getLastName();
				break;
			case 6:
				return $this->getSex();
				break;
			case 7:
				return $this->getPicture();
				break;
			case 8:
				return $this->getBirthDate();
				break;
			case 9:
				return $this->getBirthLocation();
				break;
			case 10:
				return $this->getDeathDate();
				break;
			case 11:
				return $this->getLastChargeUpdate();
				break;
			case 12:
				return $this->getIsIndexed();
				break;
			case 13:
				return $this->getMinintAka();
				break;
			case 14:
				return $this->getSlug();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpPoliticianPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getContentId(),
			$keys[1] => $this->getProfessionId(),
			$keys[2] => $this->getUserId(),
			$keys[3] => $this->getCreatorId(),
			$keys[4] => $this->getFirstName(),
			$keys[5] => $this->getLastName(),
			$keys[6] => $this->getSex(),
			$keys[7] => $this->getPicture(),
			$keys[8] => $this->getBirthDate(),
			$keys[9] => $this->getBirthLocation(),
			$keys[10] => $this->getDeathDate(),
			$keys[11] => $this->getLastChargeUpdate(),
			$keys[12] => $this->getIsIndexed(),
			$keys[13] => $this->getMinintAka(),
			$keys[14] => $this->getSlug(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpPoliticianPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setContentId($value);
				break;
			case 1:
				$this->setProfessionId($value);
				break;
			case 2:
				$this->setUserId($value);
				break;
			case 3:
				$this->setCreatorId($value);
				break;
			case 4:
				$this->setFirstName($value);
				break;
			case 5:
				$this->setLastName($value);
				break;
			case 6:
				$this->setSex($value);
				break;
			case 7:
				$this->setPicture($value);
				break;
			case 8:
				$this->setBirthDate($value);
				break;
			case 9:
				$this->setBirthLocation($value);
				break;
			case 10:
				$this->setDeathDate($value);
				break;
			case 11:
				$this->setLastChargeUpdate($value);
				break;
			case 12:
				$this->setIsIndexed($value);
				break;
			case 13:
				$this->setMinintAka($value);
				break;
			case 14:
				$this->setSlug($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpPoliticianPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setContentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setProfessionId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUserId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatorId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFirstName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLastName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSex($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPicture($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setBirthDate($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setBirthLocation($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDeathDate($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLastChargeUpdate($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIsIndexed($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setMinintAka($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setSlug($arr[$keys[14]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpPoliticianPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpPoliticianPeer::CONTENT_ID)) $criteria->add(OpPoliticianPeer::CONTENT_ID, $this->content_id);
		if ($this->isColumnModified(OpPoliticianPeer::PROFESSION_ID)) $criteria->add(OpPoliticianPeer::PROFESSION_ID, $this->profession_id);
		if ($this->isColumnModified(OpPoliticianPeer::USER_ID)) $criteria->add(OpPoliticianPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(OpPoliticianPeer::CREATOR_ID)) $criteria->add(OpPoliticianPeer::CREATOR_ID, $this->creator_id);
		if ($this->isColumnModified(OpPoliticianPeer::FIRST_NAME)) $criteria->add(OpPoliticianPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(OpPoliticianPeer::LAST_NAME)) $criteria->add(OpPoliticianPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(OpPoliticianPeer::SEX)) $criteria->add(OpPoliticianPeer::SEX, $this->sex);
		if ($this->isColumnModified(OpPoliticianPeer::PICTURE)) $criteria->add(OpPoliticianPeer::PICTURE, $this->picture);
		if ($this->isColumnModified(OpPoliticianPeer::BIRTH_DATE)) $criteria->add(OpPoliticianPeer::BIRTH_DATE, $this->birth_date);
		if ($this->isColumnModified(OpPoliticianPeer::BIRTH_LOCATION)) $criteria->add(OpPoliticianPeer::BIRTH_LOCATION, $this->birth_location);
		if ($this->isColumnModified(OpPoliticianPeer::DEATH_DATE)) $criteria->add(OpPoliticianPeer::DEATH_DATE, $this->death_date);
		if ($this->isColumnModified(OpPoliticianPeer::LAST_CHARGE_UPDATE)) $criteria->add(OpPoliticianPeer::LAST_CHARGE_UPDATE, $this->last_charge_update);
		if ($this->isColumnModified(OpPoliticianPeer::IS_INDEXED)) $criteria->add(OpPoliticianPeer::IS_INDEXED, $this->is_indexed);
		if ($this->isColumnModified(OpPoliticianPeer::MININT_AKA)) $criteria->add(OpPoliticianPeer::MININT_AKA, $this->minint_aka);
		if ($this->isColumnModified(OpPoliticianPeer::SLUG)) $criteria->add(OpPoliticianPeer::SLUG, $this->slug);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpPoliticianPeer::DATABASE_NAME);

		$criteria->add(OpPoliticianPeer::CONTENT_ID, $this->content_id);

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

		$copyObj->setProfessionId($this->profession_id);

		$copyObj->setUserId($this->user_id);

		$copyObj->setCreatorId($this->creator_id);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setSex($this->sex);

		$copyObj->setPicture($this->picture);

		$copyObj->setBirthDate($this->birth_date);

		$copyObj->setBirthLocation($this->birth_location);

		$copyObj->setDeathDate($this->death_date);

		$copyObj->setLastChargeUpdate($this->last_charge_update);

		$copyObj->setIsIndexed($this->is_indexed);

		$copyObj->setMinintAka($this->minint_aka);

		$copyObj->setSlug($this->slug);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpDeclarations() as $relObj) {
				$copyObj->addOpDeclaration($relObj->copy($deepCopy));
			}

			foreach($this->getOpHolderHasPositionOnThemes() as $relObj) {
				$copyObj->addOpHolderHasPositionOnTheme($relObj->copy($deepCopy));
			}

			foreach($this->getOpInstitutionCharges() as $relObj) {
				$copyObj->addOpInstitutionCharge($relObj->copy($deepCopy));
			}

			foreach($this->getOpOrganizationCharges() as $relObj) {
				$copyObj->addOpOrganizationCharge($relObj->copy($deepCopy));
			}

			foreach($this->getOpPolAdoptions() as $relObj) {
				$copyObj->addOpPolAdoption($relObj->copy($deepCopy));
			}

			foreach($this->getOpPoliticalCharges() as $relObj) {
				$copyObj->addOpPoliticalCharge($relObj->copy($deepCopy));
			}

			foreach($this->getOpPoliticianHasOpEducationLevels() as $relObj) {
				$copyObj->addOpPoliticianHasOpEducationLevel($relObj->copy($deepCopy));
			}

			foreach($this->getOpProcedimentos() as $relObj) {
				$copyObj->addOpProcedimento($relObj->copy($deepCopy));
			}

			foreach($this->getOpResourcess() as $relObj) {
				$copyObj->addOpResources($relObj->copy($deepCopy));
			}

			foreach($this->getOpTaxDeclarations() as $relObj) {
				$copyObj->addOpTaxDeclaration($relObj->copy($deepCopy));
			}

			foreach($this->getOpSimilarPoliticiansRelatedByOriginalId() as $relObj) {
				$copyObj->addOpSimilarPoliticianRelatedByOriginalId($relObj->copy($deepCopy));
			}

			foreach($this->getOpSimilarPoliticiansRelatedBySimilarId() as $relObj) {
				$copyObj->addOpSimilarPoliticianRelatedBySimilarId($relObj->copy($deepCopy));
			}

			foreach($this->getOpMinintAkas() as $relObj) {
				$copyObj->addOpMinintAka($relObj->copy($deepCopy));
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
			self::$peer = new OpPoliticianPeer();
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

	
	public function setOpProfession($v)
	{


		if ($v === null) {
			$this->setProfessionId(NULL);
		} else {
			$this->setProfessionId($v->getId());
		}


		$this->aOpProfession = $v;
	}


	
	public function getOpProfession($con = null)
	{
		if ($this->aOpProfession === null && ($this->profession_id !== null)) {
						include_once 'lib/model/om/BaseOpProfessionPeer.php';

			$this->aOpProfession = OpProfessionPeer::retrieveByPK($this->profession_id, $con);

			
		}
		return $this->aOpProfession;
	}

	
	public function setOpUserRelatedByUserId($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->aOpUserRelatedByUserId = $v;
	}


	
	public function getOpUserRelatedByUserId($con = null)
	{
		if ($this->aOpUserRelatedByUserId === null && ($this->user_id !== null)) {
						include_once 'lib/model/om/BaseOpUserPeer.php';

			$this->aOpUserRelatedByUserId = OpUserPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->aOpUserRelatedByUserId;
	}

	
	public function setOpUserRelatedByCreatorId($v)
	{


		if ($v === null) {
			$this->setCreatorId(NULL);
		} else {
			$this->setCreatorId($v->getId());
		}


		$this->aOpUserRelatedByCreatorId = $v;
	}


	
	public function getOpUserRelatedByCreatorId($con = null)
	{
		if ($this->aOpUserRelatedByCreatorId === null && ($this->creator_id !== null)) {
						include_once 'lib/model/om/BaseOpUserPeer.php';

			$this->aOpUserRelatedByCreatorId = OpUserPeer::retrieveByPK($this->creator_id, $con);

			
		}
		return $this->aOpUserRelatedByCreatorId;
	}

	
	public function initOpDeclarations()
	{
		if ($this->collOpDeclarations === null) {
			$this->collOpDeclarations = array();
		}
	}

	
	public function getOpDeclarations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpDeclarationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpDeclarations === null) {
			if ($this->isNew()) {
			   $this->collOpDeclarations = array();
			} else {

				$criteria->add(OpDeclarationPeer::POLITICIAN_ID, $this->getContentId());

				OpDeclarationPeer::addSelectColumns($criteria);
				$this->collOpDeclarations = OpDeclarationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpDeclarationPeer::POLITICIAN_ID, $this->getContentId());

				OpDeclarationPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpDeclarationCriteria) || !$this->lastOpDeclarationCriteria->equals($criteria)) {
					$this->collOpDeclarations = OpDeclarationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpDeclarationCriteria = $criteria;
		return $this->collOpDeclarations;
	}

	
	public function countOpDeclarations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpDeclarationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpDeclarationPeer::POLITICIAN_ID, $this->getContentId());

		return OpDeclarationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpDeclaration(OpDeclaration $l)
	{
		$this->collOpDeclarations[] = $l;
		$l->setOpPolitician($this);
	}


	
	public function getOpDeclarationsJoinOpOpinableContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpDeclarationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpDeclarations === null) {
			if ($this->isNew()) {
				$this->collOpDeclarations = array();
			} else {

				$criteria->add(OpDeclarationPeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpDeclarations = OpDeclarationPeer::doSelectJoinOpOpinableContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpDeclarationPeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpDeclarationCriteria) || !$this->lastOpDeclarationCriteria->equals($criteria)) {
				$this->collOpDeclarations = OpDeclarationPeer::doSelectJoinOpOpinableContent($criteria, $con);
			}
		}
		$this->lastOpDeclarationCriteria = $criteria;

		return $this->collOpDeclarations;
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

				$criteria->add(OpHolderHasPositionOnThemePeer::POLITICIAN_ID, $this->getContentId());

				OpHolderHasPositionOnThemePeer::addSelectColumns($criteria);
				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpHolderHasPositionOnThemePeer::POLITICIAN_ID, $this->getContentId());

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

		$criteria->add(OpHolderHasPositionOnThemePeer::POLITICIAN_ID, $this->getContentId());

		return OpHolderHasPositionOnThemePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpHolderHasPositionOnTheme(OpHolderHasPositionOnTheme $l)
	{
		$this->collOpHolderHasPositionOnThemes[] = $l;
		$l->setOpPolitician($this);
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

				$criteria->add(OpHolderHasPositionOnThemePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelectJoinOpTheme($criteria, $con);
			}
		} else {
									
			$criteria->add(OpHolderHasPositionOnThemePeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpHolderHasPositionOnThemeCriteria) || !$this->lastOpHolderHasPositionOnThemeCriteria->equals($criteria)) {
				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelectJoinOpTheme($criteria, $con);
			}
		}
		$this->lastOpHolderHasPositionOnThemeCriteria = $criteria;

		return $this->collOpHolderHasPositionOnThemes;
	}


	
	public function getOpHolderHasPositionOnThemesJoinOpParty($criteria = null, $con = null)
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

				$criteria->add(OpHolderHasPositionOnThemePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpHolderHasPositionOnThemePeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpHolderHasPositionOnThemeCriteria) || !$this->lastOpHolderHasPositionOnThemeCriteria->equals($criteria)) {
				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelectJoinOpParty($criteria, $con);
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

				$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

				OpInstitutionChargePeer::addSelectColumns($criteria);
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

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

		$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

		return OpInstitutionChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpInstitutionCharge(OpInstitutionCharge $l)
	{
		$this->collOpInstitutionCharges[] = $l;
		$l->setOpPolitician($this);
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

				$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpOpenContent($criteria, $con);
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

				$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpInstitution($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

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

				$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

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

				$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

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

				$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpConstituency($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpConstituency($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}


	
	public function getOpInstitutionChargesJoinOpParty($criteria = null, $con = null)
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

				$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpParty($criteria, $con);
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

				$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpGroup($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpGroup($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}

	
	public function initOpOrganizationCharges()
	{
		if ($this->collOpOrganizationCharges === null) {
			$this->collOpOrganizationCharges = array();
		}
	}

	
	public function getOpOrganizationCharges($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOrganizationCharges === null) {
			if ($this->isNew()) {
			   $this->collOpOrganizationCharges = array();
			} else {

				$criteria->add(OpOrganizationChargePeer::POLITICIAN_ID, $this->getContentId());

				OpOrganizationChargePeer::addSelectColumns($criteria);
				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpOrganizationChargePeer::POLITICIAN_ID, $this->getContentId());

				OpOrganizationChargePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpOrganizationChargeCriteria) || !$this->lastOpOrganizationChargeCriteria->equals($criteria)) {
					$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpOrganizationChargeCriteria = $criteria;
		return $this->collOpOrganizationCharges;
	}

	
	public function countOpOrganizationCharges($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpOrganizationChargePeer::POLITICIAN_ID, $this->getContentId());

		return OpOrganizationChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpOrganizationCharge(OpOrganizationCharge $l)
	{
		$this->collOpOrganizationCharges[] = $l;
		$l->setOpPolitician($this);
	}


	
	public function getOpOrganizationChargesJoinOpOpenContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOrganizationCharges === null) {
			if ($this->isNew()) {
				$this->collOpOrganizationCharges = array();
			} else {

				$criteria->add(OpOrganizationChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpOrganizationChargePeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpOrganizationChargeCriteria) || !$this->lastOpOrganizationChargeCriteria->equals($criteria)) {
				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		}
		$this->lastOpOrganizationChargeCriteria = $criteria;

		return $this->collOpOrganizationCharges;
	}


	
	public function getOpOrganizationChargesJoinOpOrganization($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOrganizationChargePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOrganizationCharges === null) {
			if ($this->isNew()) {
				$this->collOpOrganizationCharges = array();
			} else {

				$criteria->add(OpOrganizationChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelectJoinOpOrganization($criteria, $con);
			}
		} else {
									
			$criteria->add(OpOrganizationChargePeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpOrganizationChargeCriteria) || !$this->lastOpOrganizationChargeCriteria->equals($criteria)) {
				$this->collOpOrganizationCharges = OpOrganizationChargePeer::doSelectJoinOpOrganization($criteria, $con);
			}
		}
		$this->lastOpOrganizationChargeCriteria = $criteria;

		return $this->collOpOrganizationCharges;
	}

	
	public function initOpPolAdoptions()
	{
		if ($this->collOpPolAdoptions === null) {
			$this->collOpPolAdoptions = array();
		}
	}

	
	public function getOpPolAdoptions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPolAdoptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPolAdoptions === null) {
			if ($this->isNew()) {
			   $this->collOpPolAdoptions = array();
			} else {

				$criteria->add(OpPolAdoptionPeer::POLITICIAN_ID, $this->getContentId());

				OpPolAdoptionPeer::addSelectColumns($criteria);
				$this->collOpPolAdoptions = OpPolAdoptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPolAdoptionPeer::POLITICIAN_ID, $this->getContentId());

				OpPolAdoptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpPolAdoptionCriteria) || !$this->lastOpPolAdoptionCriteria->equals($criteria)) {
					$this->collOpPolAdoptions = OpPolAdoptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpPolAdoptionCriteria = $criteria;
		return $this->collOpPolAdoptions;
	}

	
	public function countOpPolAdoptions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpPolAdoptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpPolAdoptionPeer::POLITICIAN_ID, $this->getContentId());

		return OpPolAdoptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPolAdoption(OpPolAdoption $l)
	{
		$this->collOpPolAdoptions[] = $l;
		$l->setOpPolitician($this);
	}


	
	public function getOpPolAdoptionsJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPolAdoptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPolAdoptions === null) {
			if ($this->isNew()) {
				$this->collOpPolAdoptions = array();
			} else {

				$criteria->add(OpPolAdoptionPeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpPolAdoptions = OpPolAdoptionPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPolAdoptionPeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpPolAdoptionCriteria) || !$this->lastOpPolAdoptionCriteria->equals($criteria)) {
				$this->collOpPolAdoptions = OpPolAdoptionPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpPolAdoptionCriteria = $criteria;

		return $this->collOpPolAdoptions;
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

				$criteria->add(OpPoliticalChargePeer::POLITICIAN_ID, $this->getContentId());

				OpPoliticalChargePeer::addSelectColumns($criteria);
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPoliticalChargePeer::POLITICIAN_ID, $this->getContentId());

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

		$criteria->add(OpPoliticalChargePeer::POLITICIAN_ID, $this->getContentId());

		return OpPoliticalChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPoliticalCharge(OpPoliticalCharge $l)
	{
		$this->collOpPoliticalCharges[] = $l;
		$l->setOpPolitician($this);
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

				$criteria->add(OpPoliticalChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::POLITICIAN_ID, $this->getContentId());

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

				$criteria->add(OpPoliticalChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpChargeType($criteria, $con);
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

				$criteria->add(OpPoliticalChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}


	
	public function getOpPoliticalChargesJoinOpParty($criteria = null, $con = null)
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

				$criteria->add(OpPoliticalChargePeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}

	
	public function initOpPoliticianHasOpEducationLevels()
	{
		if ($this->collOpPoliticianHasOpEducationLevels === null) {
			$this->collOpPoliticianHasOpEducationLevels = array();
		}
	}

	
	public function getOpPoliticianHasOpEducationLevels($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianHasOpEducationLevelPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticianHasOpEducationLevels === null) {
			if ($this->isNew()) {
			   $this->collOpPoliticianHasOpEducationLevels = array();
			} else {

				$criteria->add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $this->getContentId());

				OpPoliticianHasOpEducationLevelPeer::addSelectColumns($criteria);
				$this->collOpPoliticianHasOpEducationLevels = OpPoliticianHasOpEducationLevelPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $this->getContentId());

				OpPoliticianHasOpEducationLevelPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpPoliticianHasOpEducationLevelCriteria) || !$this->lastOpPoliticianHasOpEducationLevelCriteria->equals($criteria)) {
					$this->collOpPoliticianHasOpEducationLevels = OpPoliticianHasOpEducationLevelPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpPoliticianHasOpEducationLevelCriteria = $criteria;
		return $this->collOpPoliticianHasOpEducationLevels;
	}

	
	public function countOpPoliticianHasOpEducationLevels($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianHasOpEducationLevelPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $this->getContentId());

		return OpPoliticianHasOpEducationLevelPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPoliticianHasOpEducationLevel(OpPoliticianHasOpEducationLevel $l)
	{
		$this->collOpPoliticianHasOpEducationLevels[] = $l;
		$l->setOpPolitician($this);
	}


	
	public function getOpPoliticianHasOpEducationLevelsJoinOpEducationLevel($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianHasOpEducationLevelPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticianHasOpEducationLevels === null) {
			if ($this->isNew()) {
				$this->collOpPoliticianHasOpEducationLevels = array();
			} else {

				$criteria->add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpPoliticianHasOpEducationLevels = OpPoliticianHasOpEducationLevelPeer::doSelectJoinOpEducationLevel($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticianHasOpEducationLevelPeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpPoliticianHasOpEducationLevelCriteria) || !$this->lastOpPoliticianHasOpEducationLevelCriteria->equals($criteria)) {
				$this->collOpPoliticianHasOpEducationLevels = OpPoliticianHasOpEducationLevelPeer::doSelectJoinOpEducationLevel($criteria, $con);
			}
		}
		$this->lastOpPoliticianHasOpEducationLevelCriteria = $criteria;

		return $this->collOpPoliticianHasOpEducationLevels;
	}

	
	public function initOpProcedimentos()
	{
		if ($this->collOpProcedimentos === null) {
			$this->collOpProcedimentos = array();
		}
	}

	
	public function getOpProcedimentos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpProcedimentoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpProcedimentos === null) {
			if ($this->isNew()) {
			   $this->collOpProcedimentos = array();
			} else {

				$criteria->add(OpProcedimentoPeer::POLITICIAN_ID, $this->getContentId());

				OpProcedimentoPeer::addSelectColumns($criteria);
				$this->collOpProcedimentos = OpProcedimentoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpProcedimentoPeer::POLITICIAN_ID, $this->getContentId());

				OpProcedimentoPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpProcedimentoCriteria) || !$this->lastOpProcedimentoCriteria->equals($criteria)) {
					$this->collOpProcedimentos = OpProcedimentoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpProcedimentoCriteria = $criteria;
		return $this->collOpProcedimentos;
	}

	
	public function countOpProcedimentos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpProcedimentoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpProcedimentoPeer::POLITICIAN_ID, $this->getContentId());

		return OpProcedimentoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpProcedimento(OpProcedimento $l)
	{
		$this->collOpProcedimentos[] = $l;
		$l->setOpPolitician($this);
	}


	
	public function getOpProcedimentosJoinOpOpinableContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpProcedimentoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpProcedimentos === null) {
			if ($this->isNew()) {
				$this->collOpProcedimentos = array();
			} else {

				$criteria->add(OpProcedimentoPeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpProcedimentos = OpProcedimentoPeer::doSelectJoinOpOpinableContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpProcedimentoPeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpProcedimentoCriteria) || !$this->lastOpProcedimentoCriteria->equals($criteria)) {
				$this->collOpProcedimentos = OpProcedimentoPeer::doSelectJoinOpOpinableContent($criteria, $con);
			}
		}
		$this->lastOpProcedimentoCriteria = $criteria;

		return $this->collOpProcedimentos;
	}

	
	public function initOpResourcess()
	{
		if ($this->collOpResourcess === null) {
			$this->collOpResourcess = array();
		}
	}

	
	public function getOpResourcess($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpResourcesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpResourcess === null) {
			if ($this->isNew()) {
			   $this->collOpResourcess = array();
			} else {

				$criteria->add(OpResourcesPeer::POLITICIAN_ID, $this->getContentId());

				OpResourcesPeer::addSelectColumns($criteria);
				$this->collOpResourcess = OpResourcesPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpResourcesPeer::POLITICIAN_ID, $this->getContentId());

				OpResourcesPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpResourcesCriteria) || !$this->lastOpResourcesCriteria->equals($criteria)) {
					$this->collOpResourcess = OpResourcesPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpResourcesCriteria = $criteria;
		return $this->collOpResourcess;
	}

	
	public function countOpResourcess($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpResourcesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpResourcesPeer::POLITICIAN_ID, $this->getContentId());

		return OpResourcesPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpResources(OpResources $l)
	{
		$this->collOpResourcess[] = $l;
		$l->setOpPolitician($this);
	}


	
	public function getOpResourcessJoinOpOpenContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpResourcesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpResourcess === null) {
			if ($this->isNew()) {
				$this->collOpResourcess = array();
			} else {

				$criteria->add(OpResourcesPeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpResourcess = OpResourcesPeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpResourcesPeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpResourcesCriteria) || !$this->lastOpResourcesCriteria->equals($criteria)) {
				$this->collOpResourcess = OpResourcesPeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		}
		$this->lastOpResourcesCriteria = $criteria;

		return $this->collOpResourcess;
	}


	
	public function getOpResourcessJoinOpResourcesType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpResourcesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpResourcess === null) {
			if ($this->isNew()) {
				$this->collOpResourcess = array();
			} else {

				$criteria->add(OpResourcesPeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpResourcess = OpResourcesPeer::doSelectJoinOpResourcesType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpResourcesPeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpResourcesCriteria) || !$this->lastOpResourcesCriteria->equals($criteria)) {
				$this->collOpResourcess = OpResourcesPeer::doSelectJoinOpResourcesType($criteria, $con);
			}
		}
		$this->lastOpResourcesCriteria = $criteria;

		return $this->collOpResourcess;
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

				$criteria->add(OpTaxDeclarationPeer::POLITICIAN_ID, $this->getContentId());

				OpTaxDeclarationPeer::addSelectColumns($criteria);
				$this->collOpTaxDeclarations = OpTaxDeclarationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpTaxDeclarationPeer::POLITICIAN_ID, $this->getContentId());

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

		$criteria->add(OpTaxDeclarationPeer::POLITICIAN_ID, $this->getContentId());

		return OpTaxDeclarationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpTaxDeclaration(OpTaxDeclaration $l)
	{
		$this->collOpTaxDeclarations[] = $l;
		$l->setOpPolitician($this);
	}


	
	public function getOpTaxDeclarationsJoinOpContent($criteria = null, $con = null)
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

				$criteria->add(OpTaxDeclarationPeer::POLITICIAN_ID, $this->getContentId());

				$this->collOpTaxDeclarations = OpTaxDeclarationPeer::doSelectJoinOpContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpTaxDeclarationPeer::POLITICIAN_ID, $this->getContentId());

			if (!isset($this->lastOpTaxDeclarationCriteria) || !$this->lastOpTaxDeclarationCriteria->equals($criteria)) {
				$this->collOpTaxDeclarations = OpTaxDeclarationPeer::doSelectJoinOpContent($criteria, $con);
			}
		}
		$this->lastOpTaxDeclarationCriteria = $criteria;

		return $this->collOpTaxDeclarations;
	}

	
	public function initOpSimilarPoliticiansRelatedByOriginalId()
	{
		if ($this->collOpSimilarPoliticiansRelatedByOriginalId === null) {
			$this->collOpSimilarPoliticiansRelatedByOriginalId = array();
		}
	}

	
	public function getOpSimilarPoliticiansRelatedByOriginalId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpSimilarPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpSimilarPoliticiansRelatedByOriginalId === null) {
			if ($this->isNew()) {
			   $this->collOpSimilarPoliticiansRelatedByOriginalId = array();
			} else {

				$criteria->add(OpSimilarPoliticianPeer::ORIGINAL_ID, $this->getContentId());

				OpSimilarPoliticianPeer::addSelectColumns($criteria);
				$this->collOpSimilarPoliticiansRelatedByOriginalId = OpSimilarPoliticianPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpSimilarPoliticianPeer::ORIGINAL_ID, $this->getContentId());

				OpSimilarPoliticianPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpSimilarPoliticianRelatedByOriginalIdCriteria) || !$this->lastOpSimilarPoliticianRelatedByOriginalIdCriteria->equals($criteria)) {
					$this->collOpSimilarPoliticiansRelatedByOriginalId = OpSimilarPoliticianPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpSimilarPoliticianRelatedByOriginalIdCriteria = $criteria;
		return $this->collOpSimilarPoliticiansRelatedByOriginalId;
	}

	
	public function countOpSimilarPoliticiansRelatedByOriginalId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpSimilarPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpSimilarPoliticianPeer::ORIGINAL_ID, $this->getContentId());

		return OpSimilarPoliticianPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpSimilarPoliticianRelatedByOriginalId(OpSimilarPolitician $l)
	{
		$this->collOpSimilarPoliticiansRelatedByOriginalId[] = $l;
		$l->setOpPoliticianRelatedByOriginalId($this);
	}


	
	public function getOpSimilarPoliticiansRelatedByOriginalIdJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpSimilarPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpSimilarPoliticiansRelatedByOriginalId === null) {
			if ($this->isNew()) {
				$this->collOpSimilarPoliticiansRelatedByOriginalId = array();
			} else {

				$criteria->add(OpSimilarPoliticianPeer::ORIGINAL_ID, $this->getContentId());

				$this->collOpSimilarPoliticiansRelatedByOriginalId = OpSimilarPoliticianPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpSimilarPoliticianPeer::ORIGINAL_ID, $this->getContentId());

			if (!isset($this->lastOpSimilarPoliticianRelatedByOriginalIdCriteria) || !$this->lastOpSimilarPoliticianRelatedByOriginalIdCriteria->equals($criteria)) {
				$this->collOpSimilarPoliticiansRelatedByOriginalId = OpSimilarPoliticianPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpSimilarPoliticianRelatedByOriginalIdCriteria = $criteria;

		return $this->collOpSimilarPoliticiansRelatedByOriginalId;
	}

	
	public function initOpSimilarPoliticiansRelatedBySimilarId()
	{
		if ($this->collOpSimilarPoliticiansRelatedBySimilarId === null) {
			$this->collOpSimilarPoliticiansRelatedBySimilarId = array();
		}
	}

	
	public function getOpSimilarPoliticiansRelatedBySimilarId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpSimilarPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpSimilarPoliticiansRelatedBySimilarId === null) {
			if ($this->isNew()) {
			   $this->collOpSimilarPoliticiansRelatedBySimilarId = array();
			} else {

				$criteria->add(OpSimilarPoliticianPeer::SIMILAR_ID, $this->getContentId());

				OpSimilarPoliticianPeer::addSelectColumns($criteria);
				$this->collOpSimilarPoliticiansRelatedBySimilarId = OpSimilarPoliticianPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpSimilarPoliticianPeer::SIMILAR_ID, $this->getContentId());

				OpSimilarPoliticianPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpSimilarPoliticianRelatedBySimilarIdCriteria) || !$this->lastOpSimilarPoliticianRelatedBySimilarIdCriteria->equals($criteria)) {
					$this->collOpSimilarPoliticiansRelatedBySimilarId = OpSimilarPoliticianPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpSimilarPoliticianRelatedBySimilarIdCriteria = $criteria;
		return $this->collOpSimilarPoliticiansRelatedBySimilarId;
	}

	
	public function countOpSimilarPoliticiansRelatedBySimilarId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpSimilarPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpSimilarPoliticianPeer::SIMILAR_ID, $this->getContentId());

		return OpSimilarPoliticianPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpSimilarPoliticianRelatedBySimilarId(OpSimilarPolitician $l)
	{
		$this->collOpSimilarPoliticiansRelatedBySimilarId[] = $l;
		$l->setOpPoliticianRelatedBySimilarId($this);
	}


	
	public function getOpSimilarPoliticiansRelatedBySimilarIdJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpSimilarPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpSimilarPoliticiansRelatedBySimilarId === null) {
			if ($this->isNew()) {
				$this->collOpSimilarPoliticiansRelatedBySimilarId = array();
			} else {

				$criteria->add(OpSimilarPoliticianPeer::SIMILAR_ID, $this->getContentId());

				$this->collOpSimilarPoliticiansRelatedBySimilarId = OpSimilarPoliticianPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpSimilarPoliticianPeer::SIMILAR_ID, $this->getContentId());

			if (!isset($this->lastOpSimilarPoliticianRelatedBySimilarIdCriteria) || !$this->lastOpSimilarPoliticianRelatedBySimilarIdCriteria->equals($criteria)) {
				$this->collOpSimilarPoliticiansRelatedBySimilarId = OpSimilarPoliticianPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpSimilarPoliticianRelatedBySimilarIdCriteria = $criteria;

		return $this->collOpSimilarPoliticiansRelatedBySimilarId;
	}

	
	public function initOpMinintAkas()
	{
		if ($this->collOpMinintAkas === null) {
			$this->collOpMinintAkas = array();
		}
	}

	
	public function getOpMinintAkas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpMinintAkaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpMinintAkas === null) {
			if ($this->isNew()) {
			   $this->collOpMinintAkas = array();
			} else {

				$criteria->add(OpMinintAkaPeer::POLITICIAN_ID, $this->getContentId());

				OpMinintAkaPeer::addSelectColumns($criteria);
				$this->collOpMinintAkas = OpMinintAkaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpMinintAkaPeer::POLITICIAN_ID, $this->getContentId());

				OpMinintAkaPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpMinintAkaCriteria) || !$this->lastOpMinintAkaCriteria->equals($criteria)) {
					$this->collOpMinintAkas = OpMinintAkaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpMinintAkaCriteria = $criteria;
		return $this->collOpMinintAkas;
	}

	
	public function countOpMinintAkas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpMinintAkaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpMinintAkaPeer::POLITICIAN_ID, $this->getContentId());

		return OpMinintAkaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpMinintAka(OpMinintAka $l)
	{
		$this->collOpMinintAkas[] = $l;
		$l->setOpPolitician($this);
	}

} 