<?php


abstract class BaseOpTheme extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $content_id;


	
	protected $title;


	
	protected $description;


	
	protected $relevancy_score = 0;


	
	protected $vsq08;

	
	protected $aOpOpinableContent;

	
	protected $collOpHolderHasPositionOnThemes;

	
	protected $lastOpHolderHasPositionOnThemeCriteria = null;

	
	protected $collOpThemeHasDeclarations;

	
	protected $lastOpThemeHasDeclarationCriteria = null;

	
	protected $collOpThemeHasLocations;

	
	protected $lastOpThemeHasLocationCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getContentId()
	{

		return $this->content_id;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getRelevancyScore()
	{

		return $this->relevancy_score;
	}

	
	public function getVsq08()
	{

		return $this->vsq08;
	}

	
	public function setContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->content_id !== $v) {
			$this->content_id = $v;
			$this->modifiedColumns[] = OpThemePeer::CONTENT_ID;
		}

		if ($this->aOpOpinableContent !== null && $this->aOpOpinableContent->getContentId() !== $v) {
			$this->aOpOpinableContent = null;
		}

	} 
	
	public function setTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = OpThemePeer::TITLE;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = OpThemePeer::DESCRIPTION;
		}

	} 
	
	public function setRelevancyScore($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->relevancy_score !== $v || $v === 0) {
			$this->relevancy_score = $v;
			$this->modifiedColumns[] = OpThemePeer::RELEVANCY_SCORE;
		}

	} 
	
	public function setVsq08($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->vsq08 !== $v) {
			$this->vsq08 = $v;
			$this->modifiedColumns[] = OpThemePeer::VSQ08;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->content_id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->relevancy_score = $rs->getInt($startcol + 3);

			$this->vsq08 = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpTheme object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpThemePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpThemePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpThemePeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpThemePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpThemePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpHolderHasPositionOnThemes !== null) {
				foreach($this->collOpHolderHasPositionOnThemes as $referrerFK) {
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

			if ($this->collOpThemeHasLocations !== null) {
				foreach($this->collOpThemeHasLocations as $referrerFK) {
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


			if (($retval = OpThemePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpHolderHasPositionOnThemes !== null) {
					foreach($this->collOpHolderHasPositionOnThemes as $referrerFK) {
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

				if ($this->collOpThemeHasLocations !== null) {
					foreach($this->collOpThemeHasLocations as $referrerFK) {
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
		$pos = OpThemePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getContentId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getRelevancyScore();
				break;
			case 4:
				return $this->getVsq08();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpThemePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getContentId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getRelevancyScore(),
			$keys[4] => $this->getVsq08(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpThemePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setContentId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setRelevancyScore($value);
				break;
			case 4:
				$this->setVsq08($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpThemePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setContentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRelevancyScore($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setVsq08($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpThemePeer::DATABASE_NAME);

		if ($this->isColumnModified(OpThemePeer::CONTENT_ID)) $criteria->add(OpThemePeer::CONTENT_ID, $this->content_id);
		if ($this->isColumnModified(OpThemePeer::TITLE)) $criteria->add(OpThemePeer::TITLE, $this->title);
		if ($this->isColumnModified(OpThemePeer::DESCRIPTION)) $criteria->add(OpThemePeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(OpThemePeer::RELEVANCY_SCORE)) $criteria->add(OpThemePeer::RELEVANCY_SCORE, $this->relevancy_score);
		if ($this->isColumnModified(OpThemePeer::VSQ08)) $criteria->add(OpThemePeer::VSQ08, $this->vsq08);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpThemePeer::DATABASE_NAME);

		$criteria->add(OpThemePeer::CONTENT_ID, $this->content_id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setDescription($this->description);

		$copyObj->setRelevancyScore($this->relevancy_score);

		$copyObj->setVsq08($this->vsq08);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpHolderHasPositionOnThemes() as $relObj) {
				$copyObj->addOpHolderHasPositionOnTheme($relObj->copy($deepCopy));
			}

			foreach($this->getOpThemeHasDeclarations() as $relObj) {
				$copyObj->addOpThemeHasDeclaration($relObj->copy($deepCopy));
			}

			foreach($this->getOpThemeHasLocations() as $relObj) {
				$copyObj->addOpThemeHasLocation($relObj->copy($deepCopy));
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
			self::$peer = new OpThemePeer();
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

				$criteria->add(OpHolderHasPositionOnThemePeer::THEME_ID, $this->getContentId());

				OpHolderHasPositionOnThemePeer::addSelectColumns($criteria);
				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpHolderHasPositionOnThemePeer::THEME_ID, $this->getContentId());

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

		$criteria->add(OpHolderHasPositionOnThemePeer::THEME_ID, $this->getContentId());

		return OpHolderHasPositionOnThemePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpHolderHasPositionOnTheme(OpHolderHasPositionOnTheme $l)
	{
		$this->collOpHolderHasPositionOnThemes[] = $l;
		$l->setOpTheme($this);
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

				$criteria->add(OpHolderHasPositionOnThemePeer::THEME_ID, $this->getContentId());

				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpHolderHasPositionOnThemePeer::THEME_ID, $this->getContentId());

			if (!isset($this->lastOpHolderHasPositionOnThemeCriteria) || !$this->lastOpHolderHasPositionOnThemeCriteria->equals($criteria)) {
				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelectJoinOpParty($criteria, $con);
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

				$criteria->add(OpHolderHasPositionOnThemePeer::THEME_ID, $this->getContentId());

				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpHolderHasPositionOnThemePeer::THEME_ID, $this->getContentId());

			if (!isset($this->lastOpHolderHasPositionOnThemeCriteria) || !$this->lastOpHolderHasPositionOnThemeCriteria->equals($criteria)) {
				$this->collOpHolderHasPositionOnThemes = OpHolderHasPositionOnThemePeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpHolderHasPositionOnThemeCriteria = $criteria;

		return $this->collOpHolderHasPositionOnThemes;
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

				$criteria->add(OpThemeHasDeclarationPeer::THEME_ID, $this->getContentId());

				OpThemeHasDeclarationPeer::addSelectColumns($criteria);
				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpThemeHasDeclarationPeer::THEME_ID, $this->getContentId());

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

		$criteria->add(OpThemeHasDeclarationPeer::THEME_ID, $this->getContentId());

		return OpThemeHasDeclarationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpThemeHasDeclaration(OpThemeHasDeclaration $l)
	{
		$this->collOpThemeHasDeclarations[] = $l;
		$l->setOpTheme($this);
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

				$criteria->add(OpThemeHasDeclarationPeer::THEME_ID, $this->getContentId());

				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelectJoinOpDeclaration($criteria, $con);
			}
		} else {
									
			$criteria->add(OpThemeHasDeclarationPeer::THEME_ID, $this->getContentId());

			if (!isset($this->lastOpThemeHasDeclarationCriteria) || !$this->lastOpThemeHasDeclarationCriteria->equals($criteria)) {
				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelectJoinOpDeclaration($criteria, $con);
			}
		}
		$this->lastOpThemeHasDeclarationCriteria = $criteria;

		return $this->collOpThemeHasDeclarations;
	}


	
	public function getOpThemeHasDeclarationsJoinOpParty($criteria = null, $con = null)
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

				$criteria->add(OpThemeHasDeclarationPeer::THEME_ID, $this->getContentId());

				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpThemeHasDeclarationPeer::THEME_ID, $this->getContentId());

			if (!isset($this->lastOpThemeHasDeclarationCriteria) || !$this->lastOpThemeHasDeclarationCriteria->equals($criteria)) {
				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelectJoinOpParty($criteria, $con);
			}
		}
		$this->lastOpThemeHasDeclarationCriteria = $criteria;

		return $this->collOpThemeHasDeclarations;
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

				$criteria->add(OpThemeHasLocationPeer::THEME_ID, $this->getContentId());

				OpThemeHasLocationPeer::addSelectColumns($criteria);
				$this->collOpThemeHasLocations = OpThemeHasLocationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpThemeHasLocationPeer::THEME_ID, $this->getContentId());

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

		$criteria->add(OpThemeHasLocationPeer::THEME_ID, $this->getContentId());

		return OpThemeHasLocationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpThemeHasLocation(OpThemeHasLocation $l)
	{
		$this->collOpThemeHasLocations[] = $l;
		$l->setOpTheme($this);
	}


	
	public function getOpThemeHasLocationsJoinOpLocation($criteria = null, $con = null)
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

				$criteria->add(OpThemeHasLocationPeer::THEME_ID, $this->getContentId());

				$this->collOpThemeHasLocations = OpThemeHasLocationPeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpThemeHasLocationPeer::THEME_ID, $this->getContentId());

			if (!isset($this->lastOpThemeHasLocationCriteria) || !$this->lastOpThemeHasLocationCriteria->equals($criteria)) {
				$this->collOpThemeHasLocations = OpThemeHasLocationPeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpThemeHasLocationCriteria = $criteria;

		return $this->collOpThemeHasLocations;
	}

} 