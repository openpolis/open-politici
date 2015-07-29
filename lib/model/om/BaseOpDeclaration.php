<?php


abstract class BaseOpDeclaration extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $content_id;


	
	protected $politician_id;


	
	protected $date;


	
	protected $title;


	
	protected $text;


	
	protected $relevancy_score = 0;


	
	protected $source_name;


	
	protected $source_url;


	
	protected $source_file;


	
	protected $source_mime;


	
	protected $source_size;


	
	protected $slug;

	
	protected $aOpOpinableContent;

	
	protected $aOpPolitician;

	
	protected $collOpThemeHasDeclarations;

	
	protected $lastOpThemeHasDeclarationCriteria = null;

	
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

	
	public function getDate($format = 'Y-m-d H:i:s')
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

	
	public function getText()
	{

		return $this->text;
	}

	
	public function getRelevancyScore()
	{

		return $this->relevancy_score;
	}

	
	public function getSourceName()
	{

		return $this->source_name;
	}

	
	public function getSourceUrl()
	{

		return $this->source_url;
	}

	
	public function getSourceFile()
	{

		return $this->source_file;
	}

	
	public function getSourceMime()
	{

		return $this->source_mime;
	}

	
	public function getSourceSize()
	{

		return $this->source_size;
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
			$this->modifiedColumns[] = OpDeclarationPeer::CONTENT_ID;
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
			$this->modifiedColumns[] = OpDeclarationPeer::POLITICIAN_ID;
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
			$this->modifiedColumns[] = OpDeclarationPeer::DATE;
		}

	} 
	
	public function setTitle($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = OpDeclarationPeer::TITLE;
		}

	} 
	
	public function setText($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->text !== $v) {
			$this->text = $v;
			$this->modifiedColumns[] = OpDeclarationPeer::TEXT;
		}

	} 
	
	public function setRelevancyScore($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->relevancy_score !== $v || $v === 0) {
			$this->relevancy_score = $v;
			$this->modifiedColumns[] = OpDeclarationPeer::RELEVANCY_SCORE;
		}

	} 
	
	public function setSourceName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->source_name !== $v) {
			$this->source_name = $v;
			$this->modifiedColumns[] = OpDeclarationPeer::SOURCE_NAME;
		}

	} 
	
	public function setSourceUrl($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->source_url !== $v) {
			$this->source_url = $v;
			$this->modifiedColumns[] = OpDeclarationPeer::SOURCE_URL;
		}

	} 
	
	public function setSourceFile($v)
	{

								if ($v instanceof Lob && $v === $this->source_file) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->source_file !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->source_file = $obj;
			$this->modifiedColumns[] = OpDeclarationPeer::SOURCE_FILE;
		}

	} 
	
	public function setSourceMime($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->source_mime !== $v) {
			$this->source_mime = $v;
			$this->modifiedColumns[] = OpDeclarationPeer::SOURCE_MIME;
		}

	} 
	
	public function setSourceSize($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->source_size !== $v) {
			$this->source_size = $v;
			$this->modifiedColumns[] = OpDeclarationPeer::SOURCE_SIZE;
		}

	} 
	
	public function setSlug($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->slug !== $v) {
			$this->slug = $v;
			$this->modifiedColumns[] = OpDeclarationPeer::SLUG;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->content_id = $rs->getInt($startcol + 0);

			$this->politician_id = $rs->getInt($startcol + 1);

			$this->date = $rs->getTimestamp($startcol + 2, null);

			$this->title = $rs->getString($startcol + 3);

			$this->text = $rs->getString($startcol + 4);

			$this->relevancy_score = $rs->getInt($startcol + 5);

			$this->source_name = $rs->getString($startcol + 6);

			$this->source_url = $rs->getString($startcol + 7);

			$this->source_file = $rs->getBlob($startcol + 8);

			$this->source_mime = $rs->getString($startcol + 9);

			$this->source_size = $rs->getInt($startcol + 10);

			$this->slug = $rs->getString($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpDeclaration object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpDeclarationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpDeclarationPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpDeclarationPeer::DATABASE_NAME);
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
					$pk = OpDeclarationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpDeclarationPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


			if (($retval = OpDeclarationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = OpDeclarationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getText();
				break;
			case 5:
				return $this->getRelevancyScore();
				break;
			case 6:
				return $this->getSourceName();
				break;
			case 7:
				return $this->getSourceUrl();
				break;
			case 8:
				return $this->getSourceFile();
				break;
			case 9:
				return $this->getSourceMime();
				break;
			case 10:
				return $this->getSourceSize();
				break;
			case 11:
				return $this->getSlug();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpDeclarationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getContentId(),
			$keys[1] => $this->getPoliticianId(),
			$keys[2] => $this->getDate(),
			$keys[3] => $this->getTitle(),
			$keys[4] => $this->getText(),
			$keys[5] => $this->getRelevancyScore(),
			$keys[6] => $this->getSourceName(),
			$keys[7] => $this->getSourceUrl(),
			$keys[8] => $this->getSourceFile(),
			$keys[9] => $this->getSourceMime(),
			$keys[10] => $this->getSourceSize(),
			$keys[11] => $this->getSlug(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpDeclarationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setText($value);
				break;
			case 5:
				$this->setRelevancyScore($value);
				break;
			case 6:
				$this->setSourceName($value);
				break;
			case 7:
				$this->setSourceUrl($value);
				break;
			case 8:
				$this->setSourceFile($value);
				break;
			case 9:
				$this->setSourceMime($value);
				break;
			case 10:
				$this->setSourceSize($value);
				break;
			case 11:
				$this->setSlug($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpDeclarationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setContentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPoliticianId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDate($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setText($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRelevancyScore($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSourceName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSourceUrl($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSourceFile($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSourceMime($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setSourceSize($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setSlug($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpDeclarationPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpDeclarationPeer::CONTENT_ID)) $criteria->add(OpDeclarationPeer::CONTENT_ID, $this->content_id);
		if ($this->isColumnModified(OpDeclarationPeer::POLITICIAN_ID)) $criteria->add(OpDeclarationPeer::POLITICIAN_ID, $this->politician_id);
		if ($this->isColumnModified(OpDeclarationPeer::DATE)) $criteria->add(OpDeclarationPeer::DATE, $this->date);
		if ($this->isColumnModified(OpDeclarationPeer::TITLE)) $criteria->add(OpDeclarationPeer::TITLE, $this->title);
		if ($this->isColumnModified(OpDeclarationPeer::TEXT)) $criteria->add(OpDeclarationPeer::TEXT, $this->text);
		if ($this->isColumnModified(OpDeclarationPeer::RELEVANCY_SCORE)) $criteria->add(OpDeclarationPeer::RELEVANCY_SCORE, $this->relevancy_score);
		if ($this->isColumnModified(OpDeclarationPeer::SOURCE_NAME)) $criteria->add(OpDeclarationPeer::SOURCE_NAME, $this->source_name);
		if ($this->isColumnModified(OpDeclarationPeer::SOURCE_URL)) $criteria->add(OpDeclarationPeer::SOURCE_URL, $this->source_url);
		if ($this->isColumnModified(OpDeclarationPeer::SOURCE_FILE)) $criteria->add(OpDeclarationPeer::SOURCE_FILE, $this->source_file);
		if ($this->isColumnModified(OpDeclarationPeer::SOURCE_MIME)) $criteria->add(OpDeclarationPeer::SOURCE_MIME, $this->source_mime);
		if ($this->isColumnModified(OpDeclarationPeer::SOURCE_SIZE)) $criteria->add(OpDeclarationPeer::SOURCE_SIZE, $this->source_size);
		if ($this->isColumnModified(OpDeclarationPeer::SLUG)) $criteria->add(OpDeclarationPeer::SLUG, $this->slug);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpDeclarationPeer::DATABASE_NAME);

		$criteria->add(OpDeclarationPeer::CONTENT_ID, $this->content_id);

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

		$copyObj->setText($this->text);

		$copyObj->setRelevancyScore($this->relevancy_score);

		$copyObj->setSourceName($this->source_name);

		$copyObj->setSourceUrl($this->source_url);

		$copyObj->setSourceFile($this->source_file);

		$copyObj->setSourceMime($this->source_mime);

		$copyObj->setSourceSize($this->source_size);

		$copyObj->setSlug($this->slug);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpThemeHasDeclarations() as $relObj) {
				$copyObj->addOpThemeHasDeclaration($relObj->copy($deepCopy));
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
			self::$peer = new OpDeclarationPeer();
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

				$criteria->add(OpThemeHasDeclarationPeer::DECLARATION_ID, $this->getContentId());

				OpThemeHasDeclarationPeer::addSelectColumns($criteria);
				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpThemeHasDeclarationPeer::DECLARATION_ID, $this->getContentId());

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

		$criteria->add(OpThemeHasDeclarationPeer::DECLARATION_ID, $this->getContentId());

		return OpThemeHasDeclarationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpThemeHasDeclaration(OpThemeHasDeclaration $l)
	{
		$this->collOpThemeHasDeclarations[] = $l;
		$l->setOpDeclaration($this);
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

				$criteria->add(OpThemeHasDeclarationPeer::DECLARATION_ID, $this->getContentId());

				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelectJoinOpTheme($criteria, $con);
			}
		} else {
									
			$criteria->add(OpThemeHasDeclarationPeer::DECLARATION_ID, $this->getContentId());

			if (!isset($this->lastOpThemeHasDeclarationCriteria) || !$this->lastOpThemeHasDeclarationCriteria->equals($criteria)) {
				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelectJoinOpTheme($criteria, $con);
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

				$criteria->add(OpThemeHasDeclarationPeer::DECLARATION_ID, $this->getContentId());

				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelectJoinOpParty($criteria, $con);
			}
		} else {
									
			$criteria->add(OpThemeHasDeclarationPeer::DECLARATION_ID, $this->getContentId());

			if (!isset($this->lastOpThemeHasDeclarationCriteria) || !$this->lastOpThemeHasDeclarationCriteria->equals($criteria)) {
				$this->collOpThemeHasDeclarations = OpThemeHasDeclarationPeer::doSelectJoinOpParty($criteria, $con);
			}
		}
		$this->lastOpThemeHasDeclarationCriteria = $criteria;

		return $this->collOpThemeHasDeclarations;
	}

} 