<?php


abstract class BaseOpLocation extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $location_type_id;


	
	protected $name;


	
	protected $macroregional_id;


	
	protected $regional_id;


	
	protected $provincial_id;


	
	protected $city_id;


	
	protected $prov;


	
	protected $inhabitants;


	
	protected $last_charge_update;


	
	protected $alternative_name;


	
	protected $minint_regional_code;


	
	protected $minint_provincial_code;


	
	protected $minint_city_code;


	
	protected $date_end;


	
	protected $date_start;


	
	protected $new_location_id;


	
	protected $gps_lat;


	
	protected $gps_lon;


	
	protected $slug;


	
	protected $id;

	
	protected $aOpLocationType;

	
	protected $collOpConstituencyLocations;

	
	protected $lastOpConstituencyLocationCriteria = null;

	
	protected $collOpGroupLocations;

	
	protected $lastOpGroupLocationCriteria = null;

	
	protected $collOpInstitutionCharges;

	
	protected $lastOpInstitutionChargeCriteria = null;

	
	protected $collOpLocAdoptions;

	
	protected $lastOpLocAdoptionCriteria = null;

	
	protected $collOpElections;

	
	protected $lastOpElectionCriteria = null;

	
	protected $collOpPartyLocations;

	
	protected $lastOpPartyLocationCriteria = null;

	
	protected $collOpPoliticalCharges;

	
	protected $lastOpPoliticalChargeCriteria = null;

	
	protected $collOpThemeHasLocations;

	
	protected $lastOpThemeHasLocationCriteria = null;

	
	protected $collOpUsers;

	
	protected $lastOpUserCriteria = null;

	
	protected $collOpImportSimilars;

	
	protected $lastOpImportSimilarCriteria = null;

	
	protected $collOpImportModificationss;

	
	protected $lastOpImportModificationsCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getLocationTypeId()
	{

		return $this->location_type_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getMacroregionalId()
	{

		return $this->macroregional_id;
	}

	
	public function getRegionalId()
	{

		return $this->regional_id;
	}

	
	public function getProvincialId()
	{

		return $this->provincial_id;
	}

	
	public function getCityId()
	{

		return $this->city_id;
	}

	
	public function getProv()
	{

		return $this->prov;
	}

	
	public function getInhabitants()
	{

		return $this->inhabitants;
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

	
	public function getAlternativeName()
	{

		return $this->alternative_name;
	}

	
	public function getMinintRegionalCode()
	{

		return $this->minint_regional_code;
	}

	
	public function getMinintProvincialCode()
	{

		return $this->minint_provincial_code;
	}

	
	public function getMinintCityCode()
	{

		return $this->minint_city_code;
	}

	
	public function getDateEnd($format = 'Y-m-d')
	{

		if ($this->date_end === null || $this->date_end === '') {
			return null;
		} elseif (!is_int($this->date_end)) {
						$ts = strtotime($this->date_end);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [date_end] as date/time value: " . var_export($this->date_end, true));
			}
		} else {
			$ts = $this->date_end;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDateStart($format = 'Y-m-d')
	{

		if ($this->date_start === null || $this->date_start === '') {
			return null;
		} elseif (!is_int($this->date_start)) {
						$ts = strtotime($this->date_start);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [date_start] as date/time value: " . var_export($this->date_start, true));
			}
		} else {
			$ts = $this->date_start;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getNewLocationId()
	{

		return $this->new_location_id;
	}

	
	public function getGpsLat()
	{

		return $this->gps_lat;
	}

	
	public function getGpsLon()
	{

		return $this->gps_lon;
	}

	
	public function getSlug()
	{

		return $this->slug;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setLocationTypeId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_type_id !== $v) {
			$this->location_type_id = $v;
			$this->modifiedColumns[] = OpLocationPeer::LOCATION_TYPE_ID;
		}

		if ($this->aOpLocationType !== null && $this->aOpLocationType->getId() !== $v) {
			$this->aOpLocationType = null;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = OpLocationPeer::NAME;
		}

	} 
	
	public function setMacroregionalId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->macroregional_id !== $v) {
			$this->macroregional_id = $v;
			$this->modifiedColumns[] = OpLocationPeer::MACROREGIONAL_ID;
		}

	} 
	
	public function setRegionalId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->regional_id !== $v) {
			$this->regional_id = $v;
			$this->modifiedColumns[] = OpLocationPeer::REGIONAL_ID;
		}

	} 
	
	public function setProvincialId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->provincial_id !== $v) {
			$this->provincial_id = $v;
			$this->modifiedColumns[] = OpLocationPeer::PROVINCIAL_ID;
		}

	} 
	
	public function setCityId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->city_id !== $v) {
			$this->city_id = $v;
			$this->modifiedColumns[] = OpLocationPeer::CITY_ID;
		}

	} 
	
	public function setProv($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->prov !== $v) {
			$this->prov = $v;
			$this->modifiedColumns[] = OpLocationPeer::PROV;
		}

	} 
	
	public function setInhabitants($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->inhabitants !== $v) {
			$this->inhabitants = $v;
			$this->modifiedColumns[] = OpLocationPeer::INHABITANTS;
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
			$this->modifiedColumns[] = OpLocationPeer::LAST_CHARGE_UPDATE;
		}

	} 
	
	public function setAlternativeName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->alternative_name !== $v) {
			$this->alternative_name = $v;
			$this->modifiedColumns[] = OpLocationPeer::ALTERNATIVE_NAME;
		}

	} 
	
	public function setMinintRegionalCode($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->minint_regional_code !== $v) {
			$this->minint_regional_code = $v;
			$this->modifiedColumns[] = OpLocationPeer::MININT_REGIONAL_CODE;
		}

	} 
	
	public function setMinintProvincialCode($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->minint_provincial_code !== $v) {
			$this->minint_provincial_code = $v;
			$this->modifiedColumns[] = OpLocationPeer::MININT_PROVINCIAL_CODE;
		}

	} 
	
	public function setMinintCityCode($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->minint_city_code !== $v) {
			$this->minint_city_code = $v;
			$this->modifiedColumns[] = OpLocationPeer::MININT_CITY_CODE;
		}

	} 
	
	public function setDateEnd($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [date_end] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->date_end !== $ts) {
			$this->date_end = $ts;
			$this->modifiedColumns[] = OpLocationPeer::DATE_END;
		}

	} 
	
	public function setDateStart($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [date_start] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->date_start !== $ts) {
			$this->date_start = $ts;
			$this->modifiedColumns[] = OpLocationPeer::DATE_START;
		}

	} 
	
	public function setNewLocationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->new_location_id !== $v) {
			$this->new_location_id = $v;
			$this->modifiedColumns[] = OpLocationPeer::NEW_LOCATION_ID;
		}

	} 
	
	public function setGpsLat($v)
	{

		if ($this->gps_lat !== $v) {
			$this->gps_lat = $v;
			$this->modifiedColumns[] = OpLocationPeer::GPS_LAT;
		}

	} 
	
	public function setGpsLon($v)
	{

		if ($this->gps_lon !== $v) {
			$this->gps_lon = $v;
			$this->modifiedColumns[] = OpLocationPeer::GPS_LON;
		}

	} 
	
	public function setSlug($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->slug !== $v) {
			$this->slug = $v;
			$this->modifiedColumns[] = OpLocationPeer::SLUG;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpLocationPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->location_type_id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->macroregional_id = $rs->getInt($startcol + 2);

			$this->regional_id = $rs->getInt($startcol + 3);

			$this->provincial_id = $rs->getInt($startcol + 4);

			$this->city_id = $rs->getInt($startcol + 5);

			$this->prov = $rs->getString($startcol + 6);

			$this->inhabitants = $rs->getInt($startcol + 7);

			$this->last_charge_update = $rs->getTimestamp($startcol + 8, null);

			$this->alternative_name = $rs->getString($startcol + 9);

			$this->minint_regional_code = $rs->getInt($startcol + 10);

			$this->minint_provincial_code = $rs->getInt($startcol + 11);

			$this->minint_city_code = $rs->getInt($startcol + 12);

			$this->date_end = $rs->getDate($startcol + 13, null);

			$this->date_start = $rs->getDate($startcol + 14, null);

			$this->new_location_id = $rs->getInt($startcol + 15);

			$this->gps_lat = $rs->getFloat($startcol + 16);

			$this->gps_lon = $rs->getFloat($startcol + 17);

			$this->slug = $rs->getString($startcol + 18);

			$this->id = $rs->getInt($startcol + 19);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 20; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpLocation object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpLocationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpLocationPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpLocationPeer::DATABASE_NAME);
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


												
			if ($this->aOpLocationType !== null) {
				if ($this->aOpLocationType->isModified()) {
					$affectedRows += $this->aOpLocationType->save($con);
				}
				$this->setOpLocationType($this->aOpLocationType);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpLocationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += OpLocationPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpConstituencyLocations !== null) {
				foreach($this->collOpConstituencyLocations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpGroupLocations !== null) {
				foreach($this->collOpGroupLocations as $referrerFK) {
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

			if ($this->collOpLocAdoptions !== null) {
				foreach($this->collOpLocAdoptions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpElections !== null) {
				foreach($this->collOpElections as $referrerFK) {
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

			if ($this->collOpThemeHasLocations !== null) {
				foreach($this->collOpThemeHasLocations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpUsers !== null) {
				foreach($this->collOpUsers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpImportSimilars !== null) {
				foreach($this->collOpImportSimilars as $referrerFK) {
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


												
			if ($this->aOpLocationType !== null) {
				if (!$this->aOpLocationType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpLocationType->getValidationFailures());
				}
			}


			if (($retval = OpLocationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpConstituencyLocations !== null) {
					foreach($this->collOpConstituencyLocations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpGroupLocations !== null) {
					foreach($this->collOpGroupLocations as $referrerFK) {
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

				if ($this->collOpLocAdoptions !== null) {
					foreach($this->collOpLocAdoptions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpElections !== null) {
					foreach($this->collOpElections as $referrerFK) {
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

				if ($this->collOpThemeHasLocations !== null) {
					foreach($this->collOpThemeHasLocations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpUsers !== null) {
					foreach($this->collOpUsers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpImportSimilars !== null) {
					foreach($this->collOpImportSimilars as $referrerFK) {
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
		$pos = OpLocationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getLocationTypeId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getMacroregionalId();
				break;
			case 3:
				return $this->getRegionalId();
				break;
			case 4:
				return $this->getProvincialId();
				break;
			case 5:
				return $this->getCityId();
				break;
			case 6:
				return $this->getProv();
				break;
			case 7:
				return $this->getInhabitants();
				break;
			case 8:
				return $this->getLastChargeUpdate();
				break;
			case 9:
				return $this->getAlternativeName();
				break;
			case 10:
				return $this->getMinintRegionalCode();
				break;
			case 11:
				return $this->getMinintProvincialCode();
				break;
			case 12:
				return $this->getMinintCityCode();
				break;
			case 13:
				return $this->getDateEnd();
				break;
			case 14:
				return $this->getDateStart();
				break;
			case 15:
				return $this->getNewLocationId();
				break;
			case 16:
				return $this->getGpsLat();
				break;
			case 17:
				return $this->getGpsLon();
				break;
			case 18:
				return $this->getSlug();
				break;
			case 19:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpLocationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getLocationTypeId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getMacroregionalId(),
			$keys[3] => $this->getRegionalId(),
			$keys[4] => $this->getProvincialId(),
			$keys[5] => $this->getCityId(),
			$keys[6] => $this->getProv(),
			$keys[7] => $this->getInhabitants(),
			$keys[8] => $this->getLastChargeUpdate(),
			$keys[9] => $this->getAlternativeName(),
			$keys[10] => $this->getMinintRegionalCode(),
			$keys[11] => $this->getMinintProvincialCode(),
			$keys[12] => $this->getMinintCityCode(),
			$keys[13] => $this->getDateEnd(),
			$keys[14] => $this->getDateStart(),
			$keys[15] => $this->getNewLocationId(),
			$keys[16] => $this->getGpsLat(),
			$keys[17] => $this->getGpsLon(),
			$keys[18] => $this->getSlug(),
			$keys[19] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpLocationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setLocationTypeId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setMacroregionalId($value);
				break;
			case 3:
				$this->setRegionalId($value);
				break;
			case 4:
				$this->setProvincialId($value);
				break;
			case 5:
				$this->setCityId($value);
				break;
			case 6:
				$this->setProv($value);
				break;
			case 7:
				$this->setInhabitants($value);
				break;
			case 8:
				$this->setLastChargeUpdate($value);
				break;
			case 9:
				$this->setAlternativeName($value);
				break;
			case 10:
				$this->setMinintRegionalCode($value);
				break;
			case 11:
				$this->setMinintProvincialCode($value);
				break;
			case 12:
				$this->setMinintCityCode($value);
				break;
			case 13:
				$this->setDateEnd($value);
				break;
			case 14:
				$this->setDateStart($value);
				break;
			case 15:
				$this->setNewLocationId($value);
				break;
			case 16:
				$this->setGpsLat($value);
				break;
			case 17:
				$this->setGpsLon($value);
				break;
			case 18:
				$this->setSlug($value);
				break;
			case 19:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpLocationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setLocationTypeId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMacroregionalId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRegionalId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setProvincialId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCityId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setProv($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setInhabitants($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLastChargeUpdate($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAlternativeName($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setMinintRegionalCode($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setMinintProvincialCode($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setMinintCityCode($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setDateEnd($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setDateStart($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setNewLocationId($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setGpsLat($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setGpsLon($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setSlug($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setId($arr[$keys[19]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpLocationPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpLocationPeer::LOCATION_TYPE_ID)) $criteria->add(OpLocationPeer::LOCATION_TYPE_ID, $this->location_type_id);
		if ($this->isColumnModified(OpLocationPeer::NAME)) $criteria->add(OpLocationPeer::NAME, $this->name);
		if ($this->isColumnModified(OpLocationPeer::MACROREGIONAL_ID)) $criteria->add(OpLocationPeer::MACROREGIONAL_ID, $this->macroregional_id);
		if ($this->isColumnModified(OpLocationPeer::REGIONAL_ID)) $criteria->add(OpLocationPeer::REGIONAL_ID, $this->regional_id);
		if ($this->isColumnModified(OpLocationPeer::PROVINCIAL_ID)) $criteria->add(OpLocationPeer::PROVINCIAL_ID, $this->provincial_id);
		if ($this->isColumnModified(OpLocationPeer::CITY_ID)) $criteria->add(OpLocationPeer::CITY_ID, $this->city_id);
		if ($this->isColumnModified(OpLocationPeer::PROV)) $criteria->add(OpLocationPeer::PROV, $this->prov);
		if ($this->isColumnModified(OpLocationPeer::INHABITANTS)) $criteria->add(OpLocationPeer::INHABITANTS, $this->inhabitants);
		if ($this->isColumnModified(OpLocationPeer::LAST_CHARGE_UPDATE)) $criteria->add(OpLocationPeer::LAST_CHARGE_UPDATE, $this->last_charge_update);
		if ($this->isColumnModified(OpLocationPeer::ALTERNATIVE_NAME)) $criteria->add(OpLocationPeer::ALTERNATIVE_NAME, $this->alternative_name);
		if ($this->isColumnModified(OpLocationPeer::MININT_REGIONAL_CODE)) $criteria->add(OpLocationPeer::MININT_REGIONAL_CODE, $this->minint_regional_code);
		if ($this->isColumnModified(OpLocationPeer::MININT_PROVINCIAL_CODE)) $criteria->add(OpLocationPeer::MININT_PROVINCIAL_CODE, $this->minint_provincial_code);
		if ($this->isColumnModified(OpLocationPeer::MININT_CITY_CODE)) $criteria->add(OpLocationPeer::MININT_CITY_CODE, $this->minint_city_code);
		if ($this->isColumnModified(OpLocationPeer::DATE_END)) $criteria->add(OpLocationPeer::DATE_END, $this->date_end);
		if ($this->isColumnModified(OpLocationPeer::DATE_START)) $criteria->add(OpLocationPeer::DATE_START, $this->date_start);
		if ($this->isColumnModified(OpLocationPeer::NEW_LOCATION_ID)) $criteria->add(OpLocationPeer::NEW_LOCATION_ID, $this->new_location_id);
		if ($this->isColumnModified(OpLocationPeer::GPS_LAT)) $criteria->add(OpLocationPeer::GPS_LAT, $this->gps_lat);
		if ($this->isColumnModified(OpLocationPeer::GPS_LON)) $criteria->add(OpLocationPeer::GPS_LON, $this->gps_lon);
		if ($this->isColumnModified(OpLocationPeer::SLUG)) $criteria->add(OpLocationPeer::SLUG, $this->slug);
		if ($this->isColumnModified(OpLocationPeer::ID)) $criteria->add(OpLocationPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpLocationPeer::DATABASE_NAME);

		$criteria->add(OpLocationPeer::ID, $this->id);

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

		$copyObj->setLocationTypeId($this->location_type_id);

		$copyObj->setName($this->name);

		$copyObj->setMacroregionalId($this->macroregional_id);

		$copyObj->setRegionalId($this->regional_id);

		$copyObj->setProvincialId($this->provincial_id);

		$copyObj->setCityId($this->city_id);

		$copyObj->setProv($this->prov);

		$copyObj->setInhabitants($this->inhabitants);

		$copyObj->setLastChargeUpdate($this->last_charge_update);

		$copyObj->setAlternativeName($this->alternative_name);

		$copyObj->setMinintRegionalCode($this->minint_regional_code);

		$copyObj->setMinintProvincialCode($this->minint_provincial_code);

		$copyObj->setMinintCityCode($this->minint_city_code);

		$copyObj->setDateEnd($this->date_end);

		$copyObj->setDateStart($this->date_start);

		$copyObj->setNewLocationId($this->new_location_id);

		$copyObj->setGpsLat($this->gps_lat);

		$copyObj->setGpsLon($this->gps_lon);

		$copyObj->setSlug($this->slug);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpConstituencyLocations() as $relObj) {
				$copyObj->addOpConstituencyLocation($relObj->copy($deepCopy));
			}

			foreach($this->getOpGroupLocations() as $relObj) {
				$copyObj->addOpGroupLocation($relObj->copy($deepCopy));
			}

			foreach($this->getOpInstitutionCharges() as $relObj) {
				$copyObj->addOpInstitutionCharge($relObj->copy($deepCopy));
			}

			foreach($this->getOpLocAdoptions() as $relObj) {
				$copyObj->addOpLocAdoption($relObj->copy($deepCopy));
			}

			foreach($this->getOpElections() as $relObj) {
				$copyObj->addOpElection($relObj->copy($deepCopy));
			}

			foreach($this->getOpPartyLocations() as $relObj) {
				$copyObj->addOpPartyLocation($relObj->copy($deepCopy));
			}

			foreach($this->getOpPoliticalCharges() as $relObj) {
				$copyObj->addOpPoliticalCharge($relObj->copy($deepCopy));
			}

			foreach($this->getOpThemeHasLocations() as $relObj) {
				$copyObj->addOpThemeHasLocation($relObj->copy($deepCopy));
			}

			foreach($this->getOpUsers() as $relObj) {
				$copyObj->addOpUser($relObj->copy($deepCopy));
			}

			foreach($this->getOpImportSimilars() as $relObj) {
				$copyObj->addOpImportSimilar($relObj->copy($deepCopy));
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
			self::$peer = new OpLocationPeer();
		}
		return self::$peer;
	}

	
	public function setOpLocationType($v)
	{


		if ($v === null) {
			$this->setLocationTypeId(NULL);
		} else {
			$this->setLocationTypeId($v->getId());
		}


		$this->aOpLocationType = $v;
	}


	
	public function getOpLocationType($con = null)
	{
		if ($this->aOpLocationType === null && ($this->location_type_id !== null)) {
						include_once 'lib/model/om/BaseOpLocationTypePeer.php';

			$this->aOpLocationType = OpLocationTypePeer::retrieveByPK($this->location_type_id, $con);

			
		}
		return $this->aOpLocationType;
	}

	
	public function initOpConstituencyLocations()
	{
		if ($this->collOpConstituencyLocations === null) {
			$this->collOpConstituencyLocations = array();
		}
	}

	
	public function getOpConstituencyLocations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpConstituencyLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpConstituencyLocations === null) {
			if ($this->isNew()) {
			   $this->collOpConstituencyLocations = array();
			} else {

				$criteria->add(OpConstituencyLocationPeer::LOCATION_ID, $this->getId());

				OpConstituencyLocationPeer::addSelectColumns($criteria);
				$this->collOpConstituencyLocations = OpConstituencyLocationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpConstituencyLocationPeer::LOCATION_ID, $this->getId());

				OpConstituencyLocationPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpConstituencyLocationCriteria) || !$this->lastOpConstituencyLocationCriteria->equals($criteria)) {
					$this->collOpConstituencyLocations = OpConstituencyLocationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpConstituencyLocationCriteria = $criteria;
		return $this->collOpConstituencyLocations;
	}

	
	public function countOpConstituencyLocations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpConstituencyLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpConstituencyLocationPeer::LOCATION_ID, $this->getId());

		return OpConstituencyLocationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpConstituencyLocation(OpConstituencyLocation $l)
	{
		$this->collOpConstituencyLocations[] = $l;
		$l->setOpLocation($this);
	}


	
	public function getOpConstituencyLocationsJoinOpConstituency($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpConstituencyLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpConstituencyLocations === null) {
			if ($this->isNew()) {
				$this->collOpConstituencyLocations = array();
			} else {

				$criteria->add(OpConstituencyLocationPeer::LOCATION_ID, $this->getId());

				$this->collOpConstituencyLocations = OpConstituencyLocationPeer::doSelectJoinOpConstituency($criteria, $con);
			}
		} else {
									
			$criteria->add(OpConstituencyLocationPeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastOpConstituencyLocationCriteria) || !$this->lastOpConstituencyLocationCriteria->equals($criteria)) {
				$this->collOpConstituencyLocations = OpConstituencyLocationPeer::doSelectJoinOpConstituency($criteria, $con);
			}
		}
		$this->lastOpConstituencyLocationCriteria = $criteria;

		return $this->collOpConstituencyLocations;
	}

	
	public function initOpGroupLocations()
	{
		if ($this->collOpGroupLocations === null) {
			$this->collOpGroupLocations = array();
		}
	}

	
	public function getOpGroupLocations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpGroupLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpGroupLocations === null) {
			if ($this->isNew()) {
			   $this->collOpGroupLocations = array();
			} else {

				$criteria->add(OpGroupLocationPeer::LOCATION_ID, $this->getId());

				OpGroupLocationPeer::addSelectColumns($criteria);
				$this->collOpGroupLocations = OpGroupLocationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpGroupLocationPeer::LOCATION_ID, $this->getId());

				OpGroupLocationPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpGroupLocationCriteria) || !$this->lastOpGroupLocationCriteria->equals($criteria)) {
					$this->collOpGroupLocations = OpGroupLocationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpGroupLocationCriteria = $criteria;
		return $this->collOpGroupLocations;
	}

	
	public function countOpGroupLocations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpGroupLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpGroupLocationPeer::LOCATION_ID, $this->getId());

		return OpGroupLocationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpGroupLocation(OpGroupLocation $l)
	{
		$this->collOpGroupLocations[] = $l;
		$l->setOpLocation($this);
	}


	
	public function getOpGroupLocationsJoinOpGroup($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpGroupLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpGroupLocations === null) {
			if ($this->isNew()) {
				$this->collOpGroupLocations = array();
			} else {

				$criteria->add(OpGroupLocationPeer::LOCATION_ID, $this->getId());

				$this->collOpGroupLocations = OpGroupLocationPeer::doSelectJoinOpGroup($criteria, $con);
			}
		} else {
									
			$criteria->add(OpGroupLocationPeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastOpGroupLocationCriteria) || !$this->lastOpGroupLocationCriteria->equals($criteria)) {
				$this->collOpGroupLocations = OpGroupLocationPeer::doSelectJoinOpGroup($criteria, $con);
			}
		}
		$this->lastOpGroupLocationCriteria = $criteria;

		return $this->collOpGroupLocations;
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

				$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

				OpInstitutionChargePeer::addSelectColumns($criteria);
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

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

		$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

		return OpInstitutionChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpInstitutionCharge(OpInstitutionCharge $l)
	{
		$this->collOpInstitutionCharges[] = $l;
		$l->setOpLocation($this);
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

				$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

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

				$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

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

				$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpInstitution($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

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

				$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpChargeType($criteria, $con);
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

				$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpConstituency($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

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

				$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

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

				$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpGroup($criteria, $con);
			}
		} else {
									
			$criteria->add(OpInstitutionChargePeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastOpInstitutionChargeCriteria) || !$this->lastOpInstitutionChargeCriteria->equals($criteria)) {
				$this->collOpInstitutionCharges = OpInstitutionChargePeer::doSelectJoinOpGroup($criteria, $con);
			}
		}
		$this->lastOpInstitutionChargeCriteria = $criteria;

		return $this->collOpInstitutionCharges;
	}

	
	public function initOpLocAdoptions()
	{
		if ($this->collOpLocAdoptions === null) {
			$this->collOpLocAdoptions = array();
		}
	}

	
	public function getOpLocAdoptions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpLocAdoptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpLocAdoptions === null) {
			if ($this->isNew()) {
			   $this->collOpLocAdoptions = array();
			} else {

				$criteria->add(OpLocAdoptionPeer::LOCATION_ID, $this->getId());

				OpLocAdoptionPeer::addSelectColumns($criteria);
				$this->collOpLocAdoptions = OpLocAdoptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpLocAdoptionPeer::LOCATION_ID, $this->getId());

				OpLocAdoptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpLocAdoptionCriteria) || !$this->lastOpLocAdoptionCriteria->equals($criteria)) {
					$this->collOpLocAdoptions = OpLocAdoptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpLocAdoptionCriteria = $criteria;
		return $this->collOpLocAdoptions;
	}

	
	public function countOpLocAdoptions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpLocAdoptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpLocAdoptionPeer::LOCATION_ID, $this->getId());

		return OpLocAdoptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpLocAdoption(OpLocAdoption $l)
	{
		$this->collOpLocAdoptions[] = $l;
		$l->setOpLocation($this);
	}


	
	public function getOpLocAdoptionsJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpLocAdoptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpLocAdoptions === null) {
			if ($this->isNew()) {
				$this->collOpLocAdoptions = array();
			} else {

				$criteria->add(OpLocAdoptionPeer::LOCATION_ID, $this->getId());

				$this->collOpLocAdoptions = OpLocAdoptionPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpLocAdoptionPeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastOpLocAdoptionCriteria) || !$this->lastOpLocAdoptionCriteria->equals($criteria)) {
				$this->collOpLocAdoptions = OpLocAdoptionPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpLocAdoptionCriteria = $criteria;

		return $this->collOpLocAdoptions;
	}

	
	public function initOpElections()
	{
		if ($this->collOpElections === null) {
			$this->collOpElections = array();
		}
	}

	
	public function getOpElections($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpElectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpElections === null) {
			if ($this->isNew()) {
			   $this->collOpElections = array();
			} else {

				$criteria->add(OpElectionPeer::LOCATION_ID, $this->getId());

				OpElectionPeer::addSelectColumns($criteria);
				$this->collOpElections = OpElectionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpElectionPeer::LOCATION_ID, $this->getId());

				OpElectionPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpElectionCriteria) || !$this->lastOpElectionCriteria->equals($criteria)) {
					$this->collOpElections = OpElectionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpElectionCriteria = $criteria;
		return $this->collOpElections;
	}

	
	public function countOpElections($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpElectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpElectionPeer::LOCATION_ID, $this->getId());

		return OpElectionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpElection(OpElection $l)
	{
		$this->collOpElections[] = $l;
		$l->setOpLocation($this);
	}


	
	public function getOpElectionsJoinOpElectionType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpElectionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpElections === null) {
			if ($this->isNew()) {
				$this->collOpElections = array();
			} else {

				$criteria->add(OpElectionPeer::LOCATION_ID, $this->getId());

				$this->collOpElections = OpElectionPeer::doSelectJoinOpElectionType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpElectionPeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastOpElectionCriteria) || !$this->lastOpElectionCriteria->equals($criteria)) {
				$this->collOpElections = OpElectionPeer::doSelectJoinOpElectionType($criteria, $con);
			}
		}
		$this->lastOpElectionCriteria = $criteria;

		return $this->collOpElections;
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

				$criteria->add(OpPartyLocationPeer::LOCATION_ID, $this->getId());

				OpPartyLocationPeer::addSelectColumns($criteria);
				$this->collOpPartyLocations = OpPartyLocationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPartyLocationPeer::LOCATION_ID, $this->getId());

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

		$criteria->add(OpPartyLocationPeer::LOCATION_ID, $this->getId());

		return OpPartyLocationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPartyLocation(OpPartyLocation $l)
	{
		$this->collOpPartyLocations[] = $l;
		$l->setOpLocation($this);
	}


	
	public function getOpPartyLocationsJoinOpParty($criteria = null, $con = null)
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

				$criteria->add(OpPartyLocationPeer::LOCATION_ID, $this->getId());

				$this->collOpPartyLocations = OpPartyLocationPeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPartyLocationPeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastOpPartyLocationCriteria) || !$this->lastOpPartyLocationCriteria->equals($criteria)) {
				$this->collOpPartyLocations = OpPartyLocationPeer::doSelectJoinOpParty($criteria, $con);
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

				$criteria->add(OpPoliticalChargePeer::LOCATION_ID, $this->getId());

				OpPoliticalChargePeer::addSelectColumns($criteria);
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPoliticalChargePeer::LOCATION_ID, $this->getId());

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

		$criteria->add(OpPoliticalChargePeer::LOCATION_ID, $this->getId());

		return OpPoliticalChargePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPoliticalCharge(OpPoliticalCharge $l)
	{
		$this->collOpPoliticalCharges[] = $l;
		$l->setOpLocation($this);
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

				$criteria->add(OpPoliticalChargePeer::LOCATION_ID, $this->getId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::LOCATION_ID, $this->getId());

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

				$criteria->add(OpPoliticalChargePeer::LOCATION_ID, $this->getId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpChargeType($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::LOCATION_ID, $this->getId());

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

				$criteria->add(OpPoliticalChargePeer::LOCATION_ID, $this->getId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpPolitician($criteria, $con);
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

				$criteria->add(OpPoliticalChargePeer::LOCATION_ID, $this->getId());

				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticalChargePeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastOpPoliticalChargeCriteria) || !$this->lastOpPoliticalChargeCriteria->equals($criteria)) {
				$this->collOpPoliticalCharges = OpPoliticalChargePeer::doSelectJoinOpParty($criteria, $con);
			}
		}
		$this->lastOpPoliticalChargeCriteria = $criteria;

		return $this->collOpPoliticalCharges;
	}

	
	public function initOpThemeHasLocations()
	{
		if ($this->collOpThemeHasLocations === null) {
			$this->collOpThemeHasLocations = array();
		}
	}

	
	public function getOpThemeHasLocations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpThemeHasLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpThemeHasLocations === null) {
			if ($this->isNew()) {
			   $this->collOpThemeHasLocations = array();
			} else {

				$criteria->add(OpThemeHasLocationPeer::LOCATION_ID, $this->getId());

				OpThemeHasLocationPeer::addSelectColumns($criteria);
				$this->collOpThemeHasLocations = OpThemeHasLocationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpThemeHasLocationPeer::LOCATION_ID, $this->getId());

				OpThemeHasLocationPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpThemeHasLocationCriteria) || !$this->lastOpThemeHasLocationCriteria->equals($criteria)) {
					$this->collOpThemeHasLocations = OpThemeHasLocationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpThemeHasLocationCriteria = $criteria;
		return $this->collOpThemeHasLocations;
	}

	
	public function countOpThemeHasLocations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpThemeHasLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpThemeHasLocationPeer::LOCATION_ID, $this->getId());

		return OpThemeHasLocationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpThemeHasLocation(OpThemeHasLocation $l)
	{
		$this->collOpThemeHasLocations[] = $l;
		$l->setOpLocation($this);
	}


	
	public function getOpThemeHasLocationsJoinOpTheme($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpThemeHasLocationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpThemeHasLocations === null) {
			if ($this->isNew()) {
				$this->collOpThemeHasLocations = array();
			} else {

				$criteria->add(OpThemeHasLocationPeer::LOCATION_ID, $this->getId());

				$this->collOpThemeHasLocations = OpThemeHasLocationPeer::doSelectJoinOpTheme($criteria, $con);
			}
		} else {
									
			$criteria->add(OpThemeHasLocationPeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastOpThemeHasLocationCriteria) || !$this->lastOpThemeHasLocationCriteria->equals($criteria)) {
				$this->collOpThemeHasLocations = OpThemeHasLocationPeer::doSelectJoinOpTheme($criteria, $con);
			}
		}
		$this->lastOpThemeHasLocationCriteria = $criteria;

		return $this->collOpThemeHasLocations;
	}

	
	public function initOpUsers()
	{
		if ($this->collOpUsers === null) {
			$this->collOpUsers = array();
		}
	}

	
	public function getOpUsers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpUsers === null) {
			if ($this->isNew()) {
			   $this->collOpUsers = array();
			} else {

				$criteria->add(OpUserPeer::LOCATION_ID, $this->getId());

				OpUserPeer::addSelectColumns($criteria);
				$this->collOpUsers = OpUserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpUserPeer::LOCATION_ID, $this->getId());

				OpUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpUserCriteria) || !$this->lastOpUserCriteria->equals($criteria)) {
					$this->collOpUsers = OpUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpUserCriteria = $criteria;
		return $this->collOpUsers;
	}

	
	public function countOpUsers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpUserPeer::LOCATION_ID, $this->getId());

		return OpUserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpUser(OpUser $l)
	{
		$this->collOpUsers[] = $l;
		$l->setOpLocation($this);
	}

	
	public function initOpImportSimilars()
	{
		if ($this->collOpImportSimilars === null) {
			$this->collOpImportSimilars = array();
		}
	}

	
	public function getOpImportSimilars($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportSimilarPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpImportSimilars === null) {
			if ($this->isNew()) {
			   $this->collOpImportSimilars = array();
			} else {

				$criteria->add(OpImportSimilarPeer::LOCATION_ID, $this->getId());

				OpImportSimilarPeer::addSelectColumns($criteria);
				$this->collOpImportSimilars = OpImportSimilarPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpImportSimilarPeer::LOCATION_ID, $this->getId());

				OpImportSimilarPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpImportSimilarCriteria) || !$this->lastOpImportSimilarCriteria->equals($criteria)) {
					$this->collOpImportSimilars = OpImportSimilarPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpImportSimilarCriteria = $criteria;
		return $this->collOpImportSimilars;
	}

	
	public function countOpImportSimilars($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportSimilarPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpImportSimilarPeer::LOCATION_ID, $this->getId());

		return OpImportSimilarPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpImportSimilar(OpImportSimilar $l)
	{
		$this->collOpImportSimilars[] = $l;
		$l->setOpLocation($this);
	}


	
	public function getOpImportSimilarsJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportSimilarPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpImportSimilars === null) {
			if ($this->isNew()) {
				$this->collOpImportSimilars = array();
			} else {

				$criteria->add(OpImportSimilarPeer::LOCATION_ID, $this->getId());

				$this->collOpImportSimilars = OpImportSimilarPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpImportSimilarPeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastOpImportSimilarCriteria) || !$this->lastOpImportSimilarCriteria->equals($criteria)) {
				$this->collOpImportSimilars = OpImportSimilarPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpImportSimilarCriteria = $criteria;

		return $this->collOpImportSimilars;
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

				$criteria->add(OpImportModificationsPeer::LOCATION_ID, $this->getId());

				OpImportModificationsPeer::addSelectColumns($criteria);
				$this->collOpImportModificationss = OpImportModificationsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpImportModificationsPeer::LOCATION_ID, $this->getId());

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

		$criteria->add(OpImportModificationsPeer::LOCATION_ID, $this->getId());

		return OpImportModificationsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpImportModifications(OpImportModifications $l)
	{
		$this->collOpImportModificationss[] = $l;
		$l->setOpLocation($this);
	}


	
	public function getOpImportModificationssJoinOpImportMinint($criteria = null, $con = null)
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

				$criteria->add(OpImportModificationsPeer::LOCATION_ID, $this->getId());

				$this->collOpImportModificationss = OpImportModificationsPeer::doSelectJoinOpImportMinint($criteria, $con);
			}
		} else {
									
			$criteria->add(OpImportModificationsPeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastOpImportModificationsCriteria) || !$this->lastOpImportModificationsCriteria->equals($criteria)) {
				$this->collOpImportModificationss = OpImportModificationsPeer::doSelectJoinOpImportMinint($criteria, $con);
			}
		}
		$this->lastOpImportModificationsCriteria = $criteria;

		return $this->collOpImportModificationss;
	}

} 