<?php


abstract class BaseOpOpinableContent extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $content_id;

	
	protected $aOpOpenContent;

	
	protected $collOpComments;

	
	protected $lastOpCommentCriteria = null;

	
	protected $collOpDeclarations;

	
	protected $lastOpDeclarationCriteria = null;

	
	protected $collOpProcedimentos;

	
	protected $lastOpProcedimentoCriteria = null;

	
	protected $collOpRelevancys;

	
	protected $lastOpRelevancyCriteria = null;

	
	protected $collOpTagHasOpOpinableContents;

	
	protected $lastOpTagHasOpOpinableContentCriteria = null;

	
	protected $collOpThemes;

	
	protected $lastOpThemeCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getContentId()
	{

		return $this->content_id;
	}

	
	public function setContentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->content_id !== $v) {
			$this->content_id = $v;
			$this->modifiedColumns[] = OpOpinableContentPeer::CONTENT_ID;
		}

		if ($this->aOpOpenContent !== null && $this->aOpOpenContent->getContentId() !== $v) {
			$this->aOpOpenContent = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->content_id = $rs->getInt($startcol + 0);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 1; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpOpinableContent object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpOpinableContentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpOpinableContentPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(OpOpinableContentPeer::DATABASE_NAME);
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


												
			if ($this->aOpOpenContent !== null) {
				if ($this->aOpOpenContent->isModified()) {
					$affectedRows += $this->aOpOpenContent->save($con);
				}
				$this->setOpOpenContent($this->aOpOpenContent);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpOpinableContentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpOpinableContentPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpComments !== null) {
				foreach($this->collOpComments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpDeclarations !== null) {
				foreach($this->collOpDeclarations as $referrerFK) {
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

			if ($this->collOpRelevancys !== null) {
				foreach($this->collOpRelevancys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpTagHasOpOpinableContents !== null) {
				foreach($this->collOpTagHasOpOpinableContents as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpThemes !== null) {
				foreach($this->collOpThemes as $referrerFK) {
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


												
			if ($this->aOpOpenContent !== null) {
				if (!$this->aOpOpenContent->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpOpenContent->getValidationFailures());
				}
			}


			if (($retval = OpOpinableContentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpComments !== null) {
					foreach($this->collOpComments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpDeclarations !== null) {
					foreach($this->collOpDeclarations as $referrerFK) {
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

				if ($this->collOpRelevancys !== null) {
					foreach($this->collOpRelevancys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpTagHasOpOpinableContents !== null) {
					foreach($this->collOpTagHasOpOpinableContents as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpThemes !== null) {
					foreach($this->collOpThemes as $referrerFK) {
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
		$pos = OpOpinableContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getContentId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpOpinableContentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getContentId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpOpinableContentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setContentId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpOpinableContentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setContentId($arr[$keys[0]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpOpinableContentPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpOpinableContentPeer::CONTENT_ID)) $criteria->add(OpOpinableContentPeer::CONTENT_ID, $this->content_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpOpinableContentPeer::DATABASE_NAME);

		$criteria->add(OpOpinableContentPeer::CONTENT_ID, $this->content_id);

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


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpComments() as $relObj) {
				$copyObj->addOpComment($relObj->copy($deepCopy));
			}

			foreach($this->getOpDeclarations() as $relObj) {
				$copyObj->addOpDeclaration($relObj->copy($deepCopy));
			}

			foreach($this->getOpProcedimentos() as $relObj) {
				$copyObj->addOpProcedimento($relObj->copy($deepCopy));
			}

			foreach($this->getOpRelevancys() as $relObj) {
				$copyObj->addOpRelevancy($relObj->copy($deepCopy));
			}

			foreach($this->getOpTagHasOpOpinableContents() as $relObj) {
				$copyObj->addOpTagHasOpOpinableContent($relObj->copy($deepCopy));
			}

			foreach($this->getOpThemes() as $relObj) {
				$copyObj->addOpTheme($relObj->copy($deepCopy));
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
			self::$peer = new OpOpinableContentPeer();
		}
		return self::$peer;
	}

	
	public function setOpOpenContent($v)
	{


		if ($v === null) {
			$this->setContentId(NULL);
		} else {
			$this->setContentId($v->getContentId());
		}


		$this->aOpOpenContent = $v;
	}


	
	public function getOpOpenContent($con = null)
	{
		if ($this->aOpOpenContent === null && ($this->content_id !== null)) {
						include_once 'lib/model/om/BaseOpOpenContentPeer.php';

			$this->aOpOpenContent = OpOpenContentPeer::retrieveByPK($this->content_id, $con);

			
		}
		return $this->aOpOpenContent;
	}

	
	public function initOpComments()
	{
		if ($this->collOpComments === null) {
			$this->collOpComments = array();
		}
	}

	
	public function getOpComments($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpComments === null) {
			if ($this->isNew()) {
			   $this->collOpComments = array();
			} else {

				$criteria->add(OpCommentPeer::CONTENT_ID, $this->getContentId());

				OpCommentPeer::addSelectColumns($criteria);
				$this->collOpComments = OpCommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpCommentPeer::CONTENT_ID, $this->getContentId());

				OpCommentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpCommentCriteria) || !$this->lastOpCommentCriteria->equals($criteria)) {
					$this->collOpComments = OpCommentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpCommentCriteria = $criteria;
		return $this->collOpComments;
	}

	
	public function countOpComments($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpCommentPeer::CONTENT_ID, $this->getContentId());

		return OpCommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpComment(OpComment $l)
	{
		$this->collOpComments[] = $l;
		$l->setOpOpinableContent($this);
	}


	
	public function getOpCommentsJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpComments === null) {
			if ($this->isNew()) {
				$this->collOpComments = array();
			} else {

				$criteria->add(OpCommentPeer::CONTENT_ID, $this->getContentId());

				$this->collOpComments = OpCommentPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpCommentPeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpCommentCriteria) || !$this->lastOpCommentCriteria->equals($criteria)) {
				$this->collOpComments = OpCommentPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpCommentCriteria = $criteria;

		return $this->collOpComments;
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

				$criteria->add(OpDeclarationPeer::CONTENT_ID, $this->getContentId());

				OpDeclarationPeer::addSelectColumns($criteria);
				$this->collOpDeclarations = OpDeclarationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpDeclarationPeer::CONTENT_ID, $this->getContentId());

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

		$criteria->add(OpDeclarationPeer::CONTENT_ID, $this->getContentId());

		return OpDeclarationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpDeclaration(OpDeclaration $l)
	{
		$this->collOpDeclarations[] = $l;
		$l->setOpOpinableContent($this);
	}


	
	public function getOpDeclarationsJoinOpPolitician($criteria = null, $con = null)
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

				$criteria->add(OpDeclarationPeer::CONTENT_ID, $this->getContentId());

				$this->collOpDeclarations = OpDeclarationPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpDeclarationPeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpDeclarationCriteria) || !$this->lastOpDeclarationCriteria->equals($criteria)) {
				$this->collOpDeclarations = OpDeclarationPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpDeclarationCriteria = $criteria;

		return $this->collOpDeclarations;
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

				$criteria->add(OpProcedimentoPeer::CONTENT_ID, $this->getContentId());

				OpProcedimentoPeer::addSelectColumns($criteria);
				$this->collOpProcedimentos = OpProcedimentoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpProcedimentoPeer::CONTENT_ID, $this->getContentId());

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

		$criteria->add(OpProcedimentoPeer::CONTENT_ID, $this->getContentId());

		return OpProcedimentoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpProcedimento(OpProcedimento $l)
	{
		$this->collOpProcedimentos[] = $l;
		$l->setOpOpinableContent($this);
	}


	
	public function getOpProcedimentosJoinOpPolitician($criteria = null, $con = null)
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

				$criteria->add(OpProcedimentoPeer::CONTENT_ID, $this->getContentId());

				$this->collOpProcedimentos = OpProcedimentoPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpProcedimentoPeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpProcedimentoCriteria) || !$this->lastOpProcedimentoCriteria->equals($criteria)) {
				$this->collOpProcedimentos = OpProcedimentoPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpProcedimentoCriteria = $criteria;

		return $this->collOpProcedimentos;
	}

	
	public function initOpRelevancys()
	{
		if ($this->collOpRelevancys === null) {
			$this->collOpRelevancys = array();
		}
	}

	
	public function getOpRelevancys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpRelevancyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpRelevancys === null) {
			if ($this->isNew()) {
			   $this->collOpRelevancys = array();
			} else {

				$criteria->add(OpRelevancyPeer::CONTENT_ID, $this->getContentId());

				OpRelevancyPeer::addSelectColumns($criteria);
				$this->collOpRelevancys = OpRelevancyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpRelevancyPeer::CONTENT_ID, $this->getContentId());

				OpRelevancyPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpRelevancyCriteria) || !$this->lastOpRelevancyCriteria->equals($criteria)) {
					$this->collOpRelevancys = OpRelevancyPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpRelevancyCriteria = $criteria;
		return $this->collOpRelevancys;
	}

	
	public function countOpRelevancys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpRelevancyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpRelevancyPeer::CONTENT_ID, $this->getContentId());

		return OpRelevancyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpRelevancy(OpRelevancy $l)
	{
		$this->collOpRelevancys[] = $l;
		$l->setOpOpinableContent($this);
	}


	
	public function getOpRelevancysJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpRelevancyPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpRelevancys === null) {
			if ($this->isNew()) {
				$this->collOpRelevancys = array();
			} else {

				$criteria->add(OpRelevancyPeer::CONTENT_ID, $this->getContentId());

				$this->collOpRelevancys = OpRelevancyPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpRelevancyPeer::CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpRelevancyCriteria) || !$this->lastOpRelevancyCriteria->equals($criteria)) {
				$this->collOpRelevancys = OpRelevancyPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpRelevancyCriteria = $criteria;

		return $this->collOpRelevancys;
	}

	
	public function initOpTagHasOpOpinableContents()
	{
		if ($this->collOpTagHasOpOpinableContents === null) {
			$this->collOpTagHasOpOpinableContents = array();
		}
	}

	
	public function getOpTagHasOpOpinableContents($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpTagHasOpOpinableContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpTagHasOpOpinableContents === null) {
			if ($this->isNew()) {
			   $this->collOpTagHasOpOpinableContents = array();
			} else {

				$criteria->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $this->getContentId());

				OpTagHasOpOpinableContentPeer::addSelectColumns($criteria);
				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $this->getContentId());

				OpTagHasOpOpinableContentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpTagHasOpOpinableContentCriteria) || !$this->lastOpTagHasOpOpinableContentCriteria->equals($criteria)) {
					$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpTagHasOpOpinableContentCriteria = $criteria;
		return $this->collOpTagHasOpOpinableContents;
	}

	
	public function countOpTagHasOpOpinableContents($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpTagHasOpOpinableContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $this->getContentId());

		return OpTagHasOpOpinableContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpTagHasOpOpinableContent(OpTagHasOpOpinableContent $l)
	{
		$this->collOpTagHasOpOpinableContents[] = $l;
		$l->setOpOpinableContent($this);
	}


	
	public function getOpTagHasOpOpinableContentsJoinOpTag($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpTagHasOpOpinableContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpTagHasOpOpinableContents === null) {
			if ($this->isNew()) {
				$this->collOpTagHasOpOpinableContents = array();
			} else {

				$criteria->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $this->getContentId());

				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelectJoinOpTag($criteria, $con);
			}
		} else {
									
			$criteria->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpTagHasOpOpinableContentCriteria) || !$this->lastOpTagHasOpOpinableContentCriteria->equals($criteria)) {
				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelectJoinOpTag($criteria, $con);
			}
		}
		$this->lastOpTagHasOpOpinableContentCriteria = $criteria;

		return $this->collOpTagHasOpOpinableContents;
	}


	
	public function getOpTagHasOpOpinableContentsJoinOpUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpTagHasOpOpinableContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpTagHasOpOpinableContents === null) {
			if ($this->isNew()) {
				$this->collOpTagHasOpOpinableContents = array();
			} else {

				$criteria->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $this->getContentId());

				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelectJoinOpUser($criteria, $con);
			}
		} else {
									
			$criteria->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $this->getContentId());

			if (!isset($this->lastOpTagHasOpOpinableContentCriteria) || !$this->lastOpTagHasOpOpinableContentCriteria->equals($criteria)) {
				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelectJoinOpUser($criteria, $con);
			}
		}
		$this->lastOpTagHasOpOpinableContentCriteria = $criteria;

		return $this->collOpTagHasOpOpinableContents;
	}

	
	public function initOpThemes()
	{
		if ($this->collOpThemes === null) {
			$this->collOpThemes = array();
		}
	}

	
	public function getOpThemes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpThemePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpThemes === null) {
			if ($this->isNew()) {
			   $this->collOpThemes = array();
			} else {

				$criteria->add(OpThemePeer::CONTENT_ID, $this->getContentId());

				OpThemePeer::addSelectColumns($criteria);
				$this->collOpThemes = OpThemePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpThemePeer::CONTENT_ID, $this->getContentId());

				OpThemePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpThemeCriteria) || !$this->lastOpThemeCriteria->equals($criteria)) {
					$this->collOpThemes = OpThemePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpThemeCriteria = $criteria;
		return $this->collOpThemes;
	}

	
	public function countOpThemes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpThemePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpThemePeer::CONTENT_ID, $this->getContentId());

		return OpThemePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpTheme(OpTheme $l)
	{
		$this->collOpThemes[] = $l;
		$l->setOpOpinableContent($this);
	}

} 