<?php


abstract class BaseOpUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $location_id;


	
	protected $first_name;


	
	protected $last_name;


	
	protected $nickname;


	
	protected $is_active = 0;


	
	protected $email = '';


	
	protected $sha1_password;


	
	protected $salt;


	
	protected $want_to_be_moderator = 0;


	
	protected $is_moderator = 0;


	
	protected $is_administrator = 0;


	
	protected $is_aggiungitor = 0;


	
	protected $is_premium;


	
	protected $is_adhoc;


	
	protected $deletions;


	
	protected $created_at;


	
	protected $picture;


	
	protected $url_personal_website;


	
	protected $notes;


	
	protected $has_paypal = 0;


	
	protected $remember_key;


	
	protected $wants_newsletter = 0;


	
	protected $public_name = 1;


	
	protected $charges = 0;


	
	protected $resources = 0;


	
	protected $declarations = 0;


	
	protected $pol_insertions = 0;


	
	protected $themes = 0;


	
	protected $comments = 0;


	
	protected $last_contribution;

	
	protected $aOpLocation;

	
	protected $collOpComments;

	
	protected $lastOpCommentCriteria = null;

	
	protected $collOpCommentReports;

	
	protected $lastOpCommentReportCriteria = null;

	
	protected $collOpFriendsRelatedByUserId;

	
	protected $lastOpFriendRelatedByUserIdCriteria = null;

	
	protected $collOpFriendsRelatedByFriendId;

	
	protected $lastOpFriendRelatedByFriendIdCriteria = null;

	
	protected $collOpImportUserChecks;

	
	protected $lastOpImportUserCheckCriteria = null;

	
	protected $collOpLocAdoptions;

	
	protected $lastOpLocAdoptionCriteria = null;

	
	protected $collOpMessages;

	
	protected $lastOpMessageCriteria = null;

	
	protected $collOpObscuredContents;

	
	protected $lastOpObscuredContentCriteria = null;

	
	protected $collOpOpenContentsRelatedByUserId;

	
	protected $lastOpOpenContentRelatedByUserIdCriteria = null;

	
	protected $collOpOpenContentsRelatedByUpdaterId;

	
	protected $lastOpOpenContentRelatedByUpdaterIdCriteria = null;

	
	protected $collOpVerifiedContents;

	
	protected $lastOpVerifiedContentCriteria = null;

	
	protected $collOpPolAdoptions;

	
	protected $lastOpPolAdoptionCriteria = null;

	
	protected $collOpPoliticiansRelatedByUserId;

	
	protected $lastOpPoliticianRelatedByUserIdCriteria = null;

	
	protected $collOpPoliticiansRelatedByCreatorId;

	
	protected $lastOpPoliticianRelatedByCreatorIdCriteria = null;

	
	protected $collOpRelevancys;

	
	protected $lastOpRelevancyCriteria = null;

	
	protected $collOpRelevancyComments;

	
	protected $lastOpRelevancyCommentCriteria = null;

	
	protected $collOpReports;

	
	protected $lastOpReportCriteria = null;

	
	protected $collOpTagHasOpOpinableContents;

	
	protected $lastOpTagHasOpOpinableContentCriteria = null;

	
	protected $collOpSimilarPoliticians;

	
	protected $lastOpSimilarPoliticianCriteria = null;

	
	protected $collOpImportSimilars;

	
	protected $lastOpImportSimilarCriteria = null;

	
	protected $collOpImportBlocks;

	
	protected $lastOpImportBlockCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getLocationId()
	{

		return $this->location_id;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getNickname()
	{

		return $this->nickname;
	}

	
	public function getIsActive()
	{

		return $this->is_active;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getSha1Password()
	{

		return $this->sha1_password;
	}

	
	public function getSalt()
	{

		return $this->salt;
	}

	
	public function getWantToBeModerator()
	{

		return $this->want_to_be_moderator;
	}

	
	public function getIsModerator()
	{

		return $this->is_moderator;
	}

	
	public function getIsAdministrator()
	{

		return $this->is_administrator;
	}

	
	public function getIsAggiungitor()
	{

		return $this->is_aggiungitor;
	}

	
	public function getIsPremium()
	{

		return $this->is_premium;
	}

	
	public function getIsAdhoc()
	{

		return $this->is_adhoc;
	}

	
	public function getDeletions()
	{

		return $this->deletions;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getPicture()
	{

		return $this->picture;
	}

	
	public function getUrlPersonalWebsite()
	{

		return $this->url_personal_website;
	}

	
	public function getNotes()
	{

		return $this->notes;
	}

	
	public function getHasPaypal()
	{

		return $this->has_paypal;
	}

	
	public function getRememberKey()
	{

		return $this->remember_key;
	}

	
	public function getWantsNewsletter()
	{

		return $this->wants_newsletter;
	}

	
	public function getPublicName()
	{

		return $this->public_name;
	}

	
	public function getCharges()
	{

		return $this->charges;
	}

	
	public function getResources()
	{

		return $this->resources;
	}

	
	public function getDeclarations()
	{

		return $this->declarations;
	}

	
	public function getPolInsertions()
	{

		return $this->pol_insertions;
	}

	
	public function getThemes()
	{

		return $this->themes;
	}

	
	public function getComments()
	{

		return $this->comments;
	}

	
	public function getLastContribution($format = 'Y-m-d H:i:s')
	{

		if ($this->last_contribution === null || $this->last_contribution === '') {
			return null;
		} elseif (!is_int($this->last_contribution)) {
						$ts = strtotime($this->last_contribution);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [last_contribution] as date/time value: " . var_export($this->last_contribution, true));
			}
		} else {
			$ts = $this->last_contribution;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = OpUserPeer::ID;
		}

	} 
	
	public function setLocationId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_id !== $v) {
			$this->location_id = $v;
			$this->modifiedColumns[] = OpUserPeer::LOCATION_ID;
		}

		if ($this->aOpLocation !== null && $this->aOpLocation->getId() !== $v) {
			$this->aOpLocation = null;
		}

	} 
	
	public function setFirstName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = OpUserPeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = OpUserPeer::LAST_NAME;
		}

	} 
	
	public function setNickname($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nickname !== $v) {
			$this->nickname = $v;
			$this->modifiedColumns[] = OpUserPeer::NICKNAME;
		}

	} 
	
	public function setIsActive($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_active !== $v || $v === 0) {
			$this->is_active = $v;
			$this->modifiedColumns[] = OpUserPeer::IS_ACTIVE;
		}

	} 
	
	public function setEmail($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v || $v === '') {
			$this->email = $v;
			$this->modifiedColumns[] = OpUserPeer::EMAIL;
		}

	} 
	
	public function setSha1Password($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sha1_password !== $v) {
			$this->sha1_password = $v;
			$this->modifiedColumns[] = OpUserPeer::SHA1_PASSWORD;
		}

	} 
	
	public function setSalt($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = OpUserPeer::SALT;
		}

	} 
	
	public function setWantToBeModerator($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->want_to_be_moderator !== $v || $v === 0) {
			$this->want_to_be_moderator = $v;
			$this->modifiedColumns[] = OpUserPeer::WANT_TO_BE_MODERATOR;
		}

	} 
	
	public function setIsModerator($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_moderator !== $v || $v === 0) {
			$this->is_moderator = $v;
			$this->modifiedColumns[] = OpUserPeer::IS_MODERATOR;
		}

	} 
	
	public function setIsAdministrator($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_administrator !== $v || $v === 0) {
			$this->is_administrator = $v;
			$this->modifiedColumns[] = OpUserPeer::IS_ADMINISTRATOR;
		}

	} 
	
	public function setIsAggiungitor($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->is_aggiungitor !== $v || $v === 0) {
			$this->is_aggiungitor = $v;
			$this->modifiedColumns[] = OpUserPeer::IS_AGGIUNGITOR;
		}

	} 
	
	public function setIsPremium($v)
	{

		if ($this->is_premium !== $v) {
			$this->is_premium = $v;
			$this->modifiedColumns[] = OpUserPeer::IS_PREMIUM;
		}

	} 
	
	public function setIsAdhoc($v)
	{

		if ($this->is_adhoc !== $v) {
			$this->is_adhoc = $v;
			$this->modifiedColumns[] = OpUserPeer::IS_ADHOC;
		}

	} 
	
	public function setDeletions($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->deletions !== $v) {
			$this->deletions = $v;
			$this->modifiedColumns[] = OpUserPeer::DELETIONS;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = OpUserPeer::CREATED_AT;
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
			$this->modifiedColumns[] = OpUserPeer::PICTURE;
		}

	} 
	
	public function setUrlPersonalWebsite($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url_personal_website !== $v) {
			$this->url_personal_website = $v;
			$this->modifiedColumns[] = OpUserPeer::URL_PERSONAL_WEBSITE;
		}

	} 
	
	public function setNotes($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->notes !== $v) {
			$this->notes = $v;
			$this->modifiedColumns[] = OpUserPeer::NOTES;
		}

	} 
	
	public function setHasPaypal($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->has_paypal !== $v || $v === 0) {
			$this->has_paypal = $v;
			$this->modifiedColumns[] = OpUserPeer::HAS_PAYPAL;
		}

	} 
	
	public function setRememberKey($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->remember_key !== $v) {
			$this->remember_key = $v;
			$this->modifiedColumns[] = OpUserPeer::REMEMBER_KEY;
		}

	} 
	
	public function setWantsNewsletter($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->wants_newsletter !== $v || $v === 0) {
			$this->wants_newsletter = $v;
			$this->modifiedColumns[] = OpUserPeer::WANTS_NEWSLETTER;
		}

	} 
	
	public function setPublicName($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->public_name !== $v || $v === 1) {
			$this->public_name = $v;
			$this->modifiedColumns[] = OpUserPeer::PUBLIC_NAME;
		}

	} 
	
	public function setCharges($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->charges !== $v || $v === 0) {
			$this->charges = $v;
			$this->modifiedColumns[] = OpUserPeer::CHARGES;
		}

	} 
	
	public function setResources($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->resources !== $v || $v === 0) {
			$this->resources = $v;
			$this->modifiedColumns[] = OpUserPeer::RESOURCES;
		}

	} 
	
	public function setDeclarations($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->declarations !== $v || $v === 0) {
			$this->declarations = $v;
			$this->modifiedColumns[] = OpUserPeer::DECLARATIONS;
		}

	} 
	
	public function setPolInsertions($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pol_insertions !== $v || $v === 0) {
			$this->pol_insertions = $v;
			$this->modifiedColumns[] = OpUserPeer::POL_INSERTIONS;
		}

	} 
	
	public function setThemes($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->themes !== $v || $v === 0) {
			$this->themes = $v;
			$this->modifiedColumns[] = OpUserPeer::THEMES;
		}

	} 
	
	public function setComments($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->comments !== $v || $v === 0) {
			$this->comments = $v;
			$this->modifiedColumns[] = OpUserPeer::COMMENTS;
		}

	} 
	
	public function setLastContribution($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [last_contribution] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->last_contribution !== $ts) {
			$this->last_contribution = $ts;
			$this->modifiedColumns[] = OpUserPeer::LAST_CONTRIBUTION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->location_id = $rs->getInt($startcol + 1);

			$this->first_name = $rs->getString($startcol + 2);

			$this->last_name = $rs->getString($startcol + 3);

			$this->nickname = $rs->getString($startcol + 4);

			$this->is_active = $rs->getInt($startcol + 5);

			$this->email = $rs->getString($startcol + 6);

			$this->sha1_password = $rs->getString($startcol + 7);

			$this->salt = $rs->getString($startcol + 8);

			$this->want_to_be_moderator = $rs->getInt($startcol + 9);

			$this->is_moderator = $rs->getInt($startcol + 10);

			$this->is_administrator = $rs->getInt($startcol + 11);

			$this->is_aggiungitor = $rs->getInt($startcol + 12);

			$this->is_premium = $rs->getBoolean($startcol + 13);

			$this->is_adhoc = $rs->getBoolean($startcol + 14);

			$this->deletions = $rs->getInt($startcol + 15);

			$this->created_at = $rs->getTimestamp($startcol + 16, null);

			$this->picture = $rs->getBlob($startcol + 17);

			$this->url_personal_website = $rs->getString($startcol + 18);

			$this->notes = $rs->getString($startcol + 19);

			$this->has_paypal = $rs->getInt($startcol + 20);

			$this->remember_key = $rs->getString($startcol + 21);

			$this->wants_newsletter = $rs->getInt($startcol + 22);

			$this->public_name = $rs->getInt($startcol + 23);

			$this->charges = $rs->getInt($startcol + 24);

			$this->resources = $rs->getInt($startcol + 25);

			$this->declarations = $rs->getInt($startcol + 26);

			$this->pol_insertions = $rs->getInt($startcol + 27);

			$this->themes = $rs->getInt($startcol + 28);

			$this->comments = $rs->getInt($startcol + 29);

			$this->last_contribution = $rs->getTimestamp($startcol + 30, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 31; 
		} catch (Exception $e) {
			throw new PropelException("Error populating OpUser object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpUserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			OpUserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(OpUserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpUserPeer::DATABASE_NAME);
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


												
			if ($this->aOpLocation !== null) {
				if ($this->aOpLocation->isModified()) {
					$affectedRows += $this->aOpLocation->save($con);
				}
				$this->setOpLocation($this->aOpLocation);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = OpUserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += OpUserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collOpComments !== null) {
				foreach($this->collOpComments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpCommentReports !== null) {
				foreach($this->collOpCommentReports as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpFriendsRelatedByUserId !== null) {
				foreach($this->collOpFriendsRelatedByUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpFriendsRelatedByFriendId !== null) {
				foreach($this->collOpFriendsRelatedByFriendId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpImportUserChecks !== null) {
				foreach($this->collOpImportUserChecks as $referrerFK) {
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

			if ($this->collOpMessages !== null) {
				foreach($this->collOpMessages as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpObscuredContents !== null) {
				foreach($this->collOpObscuredContents as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpOpenContentsRelatedByUserId !== null) {
				foreach($this->collOpOpenContentsRelatedByUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpOpenContentsRelatedByUpdaterId !== null) {
				foreach($this->collOpOpenContentsRelatedByUpdaterId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpVerifiedContents !== null) {
				foreach($this->collOpVerifiedContents as $referrerFK) {
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

			if ($this->collOpPoliticiansRelatedByUserId !== null) {
				foreach($this->collOpPoliticiansRelatedByUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpPoliticiansRelatedByCreatorId !== null) {
				foreach($this->collOpPoliticiansRelatedByCreatorId as $referrerFK) {
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

			if ($this->collOpRelevancyComments !== null) {
				foreach($this->collOpRelevancyComments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collOpReports !== null) {
				foreach($this->collOpReports as $referrerFK) {
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

			if ($this->collOpSimilarPoliticians !== null) {
				foreach($this->collOpSimilarPoliticians as $referrerFK) {
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

			if ($this->collOpImportBlocks !== null) {
				foreach($this->collOpImportBlocks as $referrerFK) {
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


												
			if ($this->aOpLocation !== null) {
				if (!$this->aOpLocation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOpLocation->getValidationFailures());
				}
			}


			if (($retval = OpUserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collOpComments !== null) {
					foreach($this->collOpComments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpCommentReports !== null) {
					foreach($this->collOpCommentReports as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpFriendsRelatedByUserId !== null) {
					foreach($this->collOpFriendsRelatedByUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpFriendsRelatedByFriendId !== null) {
					foreach($this->collOpFriendsRelatedByFriendId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpImportUserChecks !== null) {
					foreach($this->collOpImportUserChecks as $referrerFK) {
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

				if ($this->collOpMessages !== null) {
					foreach($this->collOpMessages as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpObscuredContents !== null) {
					foreach($this->collOpObscuredContents as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpOpenContentsRelatedByUserId !== null) {
					foreach($this->collOpOpenContentsRelatedByUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpOpenContentsRelatedByUpdaterId !== null) {
					foreach($this->collOpOpenContentsRelatedByUpdaterId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpVerifiedContents !== null) {
					foreach($this->collOpVerifiedContents as $referrerFK) {
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

				if ($this->collOpPoliticiansRelatedByUserId !== null) {
					foreach($this->collOpPoliticiansRelatedByUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpPoliticiansRelatedByCreatorId !== null) {
					foreach($this->collOpPoliticiansRelatedByCreatorId as $referrerFK) {
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

				if ($this->collOpRelevancyComments !== null) {
					foreach($this->collOpRelevancyComments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collOpReports !== null) {
					foreach($this->collOpReports as $referrerFK) {
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

				if ($this->collOpSimilarPoliticians !== null) {
					foreach($this->collOpSimilarPoliticians as $referrerFK) {
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

				if ($this->collOpImportBlocks !== null) {
					foreach($this->collOpImportBlocks as $referrerFK) {
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
		$pos = OpUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getLocationId();
				break;
			case 2:
				return $this->getFirstName();
				break;
			case 3:
				return $this->getLastName();
				break;
			case 4:
				return $this->getNickname();
				break;
			case 5:
				return $this->getIsActive();
				break;
			case 6:
				return $this->getEmail();
				break;
			case 7:
				return $this->getSha1Password();
				break;
			case 8:
				return $this->getSalt();
				break;
			case 9:
				return $this->getWantToBeModerator();
				break;
			case 10:
				return $this->getIsModerator();
				break;
			case 11:
				return $this->getIsAdministrator();
				break;
			case 12:
				return $this->getIsAggiungitor();
				break;
			case 13:
				return $this->getIsPremium();
				break;
			case 14:
				return $this->getIsAdhoc();
				break;
			case 15:
				return $this->getDeletions();
				break;
			case 16:
				return $this->getCreatedAt();
				break;
			case 17:
				return $this->getPicture();
				break;
			case 18:
				return $this->getUrlPersonalWebsite();
				break;
			case 19:
				return $this->getNotes();
				break;
			case 20:
				return $this->getHasPaypal();
				break;
			case 21:
				return $this->getRememberKey();
				break;
			case 22:
				return $this->getWantsNewsletter();
				break;
			case 23:
				return $this->getPublicName();
				break;
			case 24:
				return $this->getCharges();
				break;
			case 25:
				return $this->getResources();
				break;
			case 26:
				return $this->getDeclarations();
				break;
			case 27:
				return $this->getPolInsertions();
				break;
			case 28:
				return $this->getThemes();
				break;
			case 29:
				return $this->getComments();
				break;
			case 30:
				return $this->getLastContribution();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpUserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getLocationId(),
			$keys[2] => $this->getFirstName(),
			$keys[3] => $this->getLastName(),
			$keys[4] => $this->getNickname(),
			$keys[5] => $this->getIsActive(),
			$keys[6] => $this->getEmail(),
			$keys[7] => $this->getSha1Password(),
			$keys[8] => $this->getSalt(),
			$keys[9] => $this->getWantToBeModerator(),
			$keys[10] => $this->getIsModerator(),
			$keys[11] => $this->getIsAdministrator(),
			$keys[12] => $this->getIsAggiungitor(),
			$keys[13] => $this->getIsPremium(),
			$keys[14] => $this->getIsAdhoc(),
			$keys[15] => $this->getDeletions(),
			$keys[16] => $this->getCreatedAt(),
			$keys[17] => $this->getPicture(),
			$keys[18] => $this->getUrlPersonalWebsite(),
			$keys[19] => $this->getNotes(),
			$keys[20] => $this->getHasPaypal(),
			$keys[21] => $this->getRememberKey(),
			$keys[22] => $this->getWantsNewsletter(),
			$keys[23] => $this->getPublicName(),
			$keys[24] => $this->getCharges(),
			$keys[25] => $this->getResources(),
			$keys[26] => $this->getDeclarations(),
			$keys[27] => $this->getPolInsertions(),
			$keys[28] => $this->getThemes(),
			$keys[29] => $this->getComments(),
			$keys[30] => $this->getLastContribution(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = OpUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setLocationId($value);
				break;
			case 2:
				$this->setFirstName($value);
				break;
			case 3:
				$this->setLastName($value);
				break;
			case 4:
				$this->setNickname($value);
				break;
			case 5:
				$this->setIsActive($value);
				break;
			case 6:
				$this->setEmail($value);
				break;
			case 7:
				$this->setSha1Password($value);
				break;
			case 8:
				$this->setSalt($value);
				break;
			case 9:
				$this->setWantToBeModerator($value);
				break;
			case 10:
				$this->setIsModerator($value);
				break;
			case 11:
				$this->setIsAdministrator($value);
				break;
			case 12:
				$this->setIsAggiungitor($value);
				break;
			case 13:
				$this->setIsPremium($value);
				break;
			case 14:
				$this->setIsAdhoc($value);
				break;
			case 15:
				$this->setDeletions($value);
				break;
			case 16:
				$this->setCreatedAt($value);
				break;
			case 17:
				$this->setPicture($value);
				break;
			case 18:
				$this->setUrlPersonalWebsite($value);
				break;
			case 19:
				$this->setNotes($value);
				break;
			case 20:
				$this->setHasPaypal($value);
				break;
			case 21:
				$this->setRememberKey($value);
				break;
			case 22:
				$this->setWantsNewsletter($value);
				break;
			case 23:
				$this->setPublicName($value);
				break;
			case 24:
				$this->setCharges($value);
				break;
			case 25:
				$this->setResources($value);
				break;
			case 26:
				$this->setDeclarations($value);
				break;
			case 27:
				$this->setPolInsertions($value);
				break;
			case 28:
				$this->setThemes($value);
				break;
			case 29:
				$this->setComments($value);
				break;
			case 30:
				$this->setLastContribution($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = OpUserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setLocationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFirstName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLastName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNickname($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsActive($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEmail($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSha1Password($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSalt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setWantToBeModerator($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setIsModerator($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setIsAdministrator($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIsAggiungitor($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIsPremium($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setIsAdhoc($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setDeletions($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCreatedAt($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setPicture($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setUrlPersonalWebsite($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setNotes($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setHasPaypal($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setRememberKey($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setWantsNewsletter($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setPublicName($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCharges($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setResources($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setDeclarations($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setPolInsertions($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setThemes($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setComments($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setLastContribution($arr[$keys[30]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(OpUserPeer::DATABASE_NAME);

		if ($this->isColumnModified(OpUserPeer::ID)) $criteria->add(OpUserPeer::ID, $this->id);
		if ($this->isColumnModified(OpUserPeer::LOCATION_ID)) $criteria->add(OpUserPeer::LOCATION_ID, $this->location_id);
		if ($this->isColumnModified(OpUserPeer::FIRST_NAME)) $criteria->add(OpUserPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(OpUserPeer::LAST_NAME)) $criteria->add(OpUserPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(OpUserPeer::NICKNAME)) $criteria->add(OpUserPeer::NICKNAME, $this->nickname);
		if ($this->isColumnModified(OpUserPeer::IS_ACTIVE)) $criteria->add(OpUserPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(OpUserPeer::EMAIL)) $criteria->add(OpUserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(OpUserPeer::SHA1_PASSWORD)) $criteria->add(OpUserPeer::SHA1_PASSWORD, $this->sha1_password);
		if ($this->isColumnModified(OpUserPeer::SALT)) $criteria->add(OpUserPeer::SALT, $this->salt);
		if ($this->isColumnModified(OpUserPeer::WANT_TO_BE_MODERATOR)) $criteria->add(OpUserPeer::WANT_TO_BE_MODERATOR, $this->want_to_be_moderator);
		if ($this->isColumnModified(OpUserPeer::IS_MODERATOR)) $criteria->add(OpUserPeer::IS_MODERATOR, $this->is_moderator);
		if ($this->isColumnModified(OpUserPeer::IS_ADMINISTRATOR)) $criteria->add(OpUserPeer::IS_ADMINISTRATOR, $this->is_administrator);
		if ($this->isColumnModified(OpUserPeer::IS_AGGIUNGITOR)) $criteria->add(OpUserPeer::IS_AGGIUNGITOR, $this->is_aggiungitor);
		if ($this->isColumnModified(OpUserPeer::IS_PREMIUM)) $criteria->add(OpUserPeer::IS_PREMIUM, $this->is_premium);
		if ($this->isColumnModified(OpUserPeer::IS_ADHOC)) $criteria->add(OpUserPeer::IS_ADHOC, $this->is_adhoc);
		if ($this->isColumnModified(OpUserPeer::DELETIONS)) $criteria->add(OpUserPeer::DELETIONS, $this->deletions);
		if ($this->isColumnModified(OpUserPeer::CREATED_AT)) $criteria->add(OpUserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(OpUserPeer::PICTURE)) $criteria->add(OpUserPeer::PICTURE, $this->picture);
		if ($this->isColumnModified(OpUserPeer::URL_PERSONAL_WEBSITE)) $criteria->add(OpUserPeer::URL_PERSONAL_WEBSITE, $this->url_personal_website);
		if ($this->isColumnModified(OpUserPeer::NOTES)) $criteria->add(OpUserPeer::NOTES, $this->notes);
		if ($this->isColumnModified(OpUserPeer::HAS_PAYPAL)) $criteria->add(OpUserPeer::HAS_PAYPAL, $this->has_paypal);
		if ($this->isColumnModified(OpUserPeer::REMEMBER_KEY)) $criteria->add(OpUserPeer::REMEMBER_KEY, $this->remember_key);
		if ($this->isColumnModified(OpUserPeer::WANTS_NEWSLETTER)) $criteria->add(OpUserPeer::WANTS_NEWSLETTER, $this->wants_newsletter);
		if ($this->isColumnModified(OpUserPeer::PUBLIC_NAME)) $criteria->add(OpUserPeer::PUBLIC_NAME, $this->public_name);
		if ($this->isColumnModified(OpUserPeer::CHARGES)) $criteria->add(OpUserPeer::CHARGES, $this->charges);
		if ($this->isColumnModified(OpUserPeer::RESOURCES)) $criteria->add(OpUserPeer::RESOURCES, $this->resources);
		if ($this->isColumnModified(OpUserPeer::DECLARATIONS)) $criteria->add(OpUserPeer::DECLARATIONS, $this->declarations);
		if ($this->isColumnModified(OpUserPeer::POL_INSERTIONS)) $criteria->add(OpUserPeer::POL_INSERTIONS, $this->pol_insertions);
		if ($this->isColumnModified(OpUserPeer::THEMES)) $criteria->add(OpUserPeer::THEMES, $this->themes);
		if ($this->isColumnModified(OpUserPeer::COMMENTS)) $criteria->add(OpUserPeer::COMMENTS, $this->comments);
		if ($this->isColumnModified(OpUserPeer::LAST_CONTRIBUTION)) $criteria->add(OpUserPeer::LAST_CONTRIBUTION, $this->last_contribution);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(OpUserPeer::DATABASE_NAME);

		$criteria->add(OpUserPeer::ID, $this->id);

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

		$copyObj->setLocationId($this->location_id);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setNickname($this->nickname);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setEmail($this->email);

		$copyObj->setSha1Password($this->sha1_password);

		$copyObj->setSalt($this->salt);

		$copyObj->setWantToBeModerator($this->want_to_be_moderator);

		$copyObj->setIsModerator($this->is_moderator);

		$copyObj->setIsAdministrator($this->is_administrator);

		$copyObj->setIsAggiungitor($this->is_aggiungitor);

		$copyObj->setIsPremium($this->is_premium);

		$copyObj->setIsAdhoc($this->is_adhoc);

		$copyObj->setDeletions($this->deletions);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setPicture($this->picture);

		$copyObj->setUrlPersonalWebsite($this->url_personal_website);

		$copyObj->setNotes($this->notes);

		$copyObj->setHasPaypal($this->has_paypal);

		$copyObj->setRememberKey($this->remember_key);

		$copyObj->setWantsNewsletter($this->wants_newsletter);

		$copyObj->setPublicName($this->public_name);

		$copyObj->setCharges($this->charges);

		$copyObj->setResources($this->resources);

		$copyObj->setDeclarations($this->declarations);

		$copyObj->setPolInsertions($this->pol_insertions);

		$copyObj->setThemes($this->themes);

		$copyObj->setComments($this->comments);

		$copyObj->setLastContribution($this->last_contribution);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getOpComments() as $relObj) {
				$copyObj->addOpComment($relObj->copy($deepCopy));
			}

			foreach($this->getOpCommentReports() as $relObj) {
				$copyObj->addOpCommentReport($relObj->copy($deepCopy));
			}

			foreach($this->getOpFriendsRelatedByUserId() as $relObj) {
				$copyObj->addOpFriendRelatedByUserId($relObj->copy($deepCopy));
			}

			foreach($this->getOpFriendsRelatedByFriendId() as $relObj) {
				$copyObj->addOpFriendRelatedByFriendId($relObj->copy($deepCopy));
			}

			foreach($this->getOpImportUserChecks() as $relObj) {
				$copyObj->addOpImportUserCheck($relObj->copy($deepCopy));
			}

			foreach($this->getOpLocAdoptions() as $relObj) {
				$copyObj->addOpLocAdoption($relObj->copy($deepCopy));
			}

			foreach($this->getOpMessages() as $relObj) {
				$copyObj->addOpMessage($relObj->copy($deepCopy));
			}

			foreach($this->getOpObscuredContents() as $relObj) {
				$copyObj->addOpObscuredContent($relObj->copy($deepCopy));
			}

			foreach($this->getOpOpenContentsRelatedByUserId() as $relObj) {
				$copyObj->addOpOpenContentRelatedByUserId($relObj->copy($deepCopy));
			}

			foreach($this->getOpOpenContentsRelatedByUpdaterId() as $relObj) {
				$copyObj->addOpOpenContentRelatedByUpdaterId($relObj->copy($deepCopy));
			}

			foreach($this->getOpVerifiedContents() as $relObj) {
				$copyObj->addOpVerifiedContent($relObj->copy($deepCopy));
			}

			foreach($this->getOpPolAdoptions() as $relObj) {
				$copyObj->addOpPolAdoption($relObj->copy($deepCopy));
			}

			foreach($this->getOpPoliticiansRelatedByUserId() as $relObj) {
				$copyObj->addOpPoliticianRelatedByUserId($relObj->copy($deepCopy));
			}

			foreach($this->getOpPoliticiansRelatedByCreatorId() as $relObj) {
				$copyObj->addOpPoliticianRelatedByCreatorId($relObj->copy($deepCopy));
			}

			foreach($this->getOpRelevancys() as $relObj) {
				$copyObj->addOpRelevancy($relObj->copy($deepCopy));
			}

			foreach($this->getOpRelevancyComments() as $relObj) {
				$copyObj->addOpRelevancyComment($relObj->copy($deepCopy));
			}

			foreach($this->getOpReports() as $relObj) {
				$copyObj->addOpReport($relObj->copy($deepCopy));
			}

			foreach($this->getOpTagHasOpOpinableContents() as $relObj) {
				$copyObj->addOpTagHasOpOpinableContent($relObj->copy($deepCopy));
			}

			foreach($this->getOpSimilarPoliticians() as $relObj) {
				$copyObj->addOpSimilarPolitician($relObj->copy($deepCopy));
			}

			foreach($this->getOpImportSimilars() as $relObj) {
				$copyObj->addOpImportSimilar($relObj->copy($deepCopy));
			}

			foreach($this->getOpImportBlocks() as $relObj) {
				$copyObj->addOpImportBlock($relObj->copy($deepCopy));
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
			self::$peer = new OpUserPeer();
		}
		return self::$peer;
	}

	
	public function setOpLocation($v)
	{


		if ($v === null) {
			$this->setLocationId(NULL);
		} else {
			$this->setLocationId($v->getId());
		}


		$this->aOpLocation = $v;
	}


	
	public function getOpLocation($con = null)
	{
		if ($this->aOpLocation === null && ($this->location_id !== null)) {
						include_once 'lib/model/om/BaseOpLocationPeer.php';

			$this->aOpLocation = OpLocationPeer::retrieveByPK($this->location_id, $con);

			
		}
		return $this->aOpLocation;
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

				$criteria->add(OpCommentPeer::USER_ID, $this->getId());

				OpCommentPeer::addSelectColumns($criteria);
				$this->collOpComments = OpCommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpCommentPeer::USER_ID, $this->getId());

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

		$criteria->add(OpCommentPeer::USER_ID, $this->getId());

		return OpCommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpComment(OpComment $l)
	{
		$this->collOpComments[] = $l;
		$l->setOpUser($this);
	}


	
	public function getOpCommentsJoinOpOpinableContent($criteria = null, $con = null)
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

				$criteria->add(OpCommentPeer::USER_ID, $this->getId());

				$this->collOpComments = OpCommentPeer::doSelectJoinOpOpinableContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpCommentPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpCommentCriteria) || !$this->lastOpCommentCriteria->equals($criteria)) {
				$this->collOpComments = OpCommentPeer::doSelectJoinOpOpinableContent($criteria, $con);
			}
		}
		$this->lastOpCommentCriteria = $criteria;

		return $this->collOpComments;
	}

	
	public function initOpCommentReports()
	{
		if ($this->collOpCommentReports === null) {
			$this->collOpCommentReports = array();
		}
	}

	
	public function getOpCommentReports($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpCommentReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpCommentReports === null) {
			if ($this->isNew()) {
			   $this->collOpCommentReports = array();
			} else {

				$criteria->add(OpCommentReportPeer::USER_ID, $this->getId());

				OpCommentReportPeer::addSelectColumns($criteria);
				$this->collOpCommentReports = OpCommentReportPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpCommentReportPeer::USER_ID, $this->getId());

				OpCommentReportPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpCommentReportCriteria) || !$this->lastOpCommentReportCriteria->equals($criteria)) {
					$this->collOpCommentReports = OpCommentReportPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpCommentReportCriteria = $criteria;
		return $this->collOpCommentReports;
	}

	
	public function countOpCommentReports($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpCommentReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpCommentReportPeer::USER_ID, $this->getId());

		return OpCommentReportPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpCommentReport(OpCommentReport $l)
	{
		$this->collOpCommentReports[] = $l;
		$l->setOpUser($this);
	}


	
	public function getOpCommentReportsJoinOpComment($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpCommentReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpCommentReports === null) {
			if ($this->isNew()) {
				$this->collOpCommentReports = array();
			} else {

				$criteria->add(OpCommentReportPeer::USER_ID, $this->getId());

				$this->collOpCommentReports = OpCommentReportPeer::doSelectJoinOpComment($criteria, $con);
			}
		} else {
									
			$criteria->add(OpCommentReportPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpCommentReportCriteria) || !$this->lastOpCommentReportCriteria->equals($criteria)) {
				$this->collOpCommentReports = OpCommentReportPeer::doSelectJoinOpComment($criteria, $con);
			}
		}
		$this->lastOpCommentReportCriteria = $criteria;

		return $this->collOpCommentReports;
	}

	
	public function initOpFriendsRelatedByUserId()
	{
		if ($this->collOpFriendsRelatedByUserId === null) {
			$this->collOpFriendsRelatedByUserId = array();
		}
	}

	
	public function getOpFriendsRelatedByUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpFriendPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpFriendsRelatedByUserId === null) {
			if ($this->isNew()) {
			   $this->collOpFriendsRelatedByUserId = array();
			} else {

				$criteria->add(OpFriendPeer::USER_ID, $this->getId());

				OpFriendPeer::addSelectColumns($criteria);
				$this->collOpFriendsRelatedByUserId = OpFriendPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpFriendPeer::USER_ID, $this->getId());

				OpFriendPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpFriendRelatedByUserIdCriteria) || !$this->lastOpFriendRelatedByUserIdCriteria->equals($criteria)) {
					$this->collOpFriendsRelatedByUserId = OpFriendPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpFriendRelatedByUserIdCriteria = $criteria;
		return $this->collOpFriendsRelatedByUserId;
	}

	
	public function countOpFriendsRelatedByUserId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpFriendPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpFriendPeer::USER_ID, $this->getId());

		return OpFriendPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpFriendRelatedByUserId(OpFriend $l)
	{
		$this->collOpFriendsRelatedByUserId[] = $l;
		$l->setOpUserRelatedByUserId($this);
	}

	
	public function initOpFriendsRelatedByFriendId()
	{
		if ($this->collOpFriendsRelatedByFriendId === null) {
			$this->collOpFriendsRelatedByFriendId = array();
		}
	}

	
	public function getOpFriendsRelatedByFriendId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpFriendPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpFriendsRelatedByFriendId === null) {
			if ($this->isNew()) {
			   $this->collOpFriendsRelatedByFriendId = array();
			} else {

				$criteria->add(OpFriendPeer::FRIEND_ID, $this->getId());

				OpFriendPeer::addSelectColumns($criteria);
				$this->collOpFriendsRelatedByFriendId = OpFriendPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpFriendPeer::FRIEND_ID, $this->getId());

				OpFriendPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpFriendRelatedByFriendIdCriteria) || !$this->lastOpFriendRelatedByFriendIdCriteria->equals($criteria)) {
					$this->collOpFriendsRelatedByFriendId = OpFriendPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpFriendRelatedByFriendIdCriteria = $criteria;
		return $this->collOpFriendsRelatedByFriendId;
	}

	
	public function countOpFriendsRelatedByFriendId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpFriendPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpFriendPeer::FRIEND_ID, $this->getId());

		return OpFriendPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpFriendRelatedByFriendId(OpFriend $l)
	{
		$this->collOpFriendsRelatedByFriendId[] = $l;
		$l->setOpUserRelatedByFriendId($this);
	}

	
	public function initOpImportUserChecks()
	{
		if ($this->collOpImportUserChecks === null) {
			$this->collOpImportUserChecks = array();
		}
	}

	
	public function getOpImportUserChecks($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportUserCheckPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpImportUserChecks === null) {
			if ($this->isNew()) {
			   $this->collOpImportUserChecks = array();
			} else {

				$criteria->add(OpImportUserCheckPeer::USER_ID, $this->getId());

				OpImportUserCheckPeer::addSelectColumns($criteria);
				$this->collOpImportUserChecks = OpImportUserCheckPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpImportUserCheckPeer::USER_ID, $this->getId());

				OpImportUserCheckPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpImportUserCheckCriteria) || !$this->lastOpImportUserCheckCriteria->equals($criteria)) {
					$this->collOpImportUserChecks = OpImportUserCheckPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpImportUserCheckCriteria = $criteria;
		return $this->collOpImportUserChecks;
	}

	
	public function countOpImportUserChecks($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportUserCheckPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpImportUserCheckPeer::USER_ID, $this->getId());

		return OpImportUserCheckPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpImportUserCheck(OpImportUserCheck $l)
	{
		$this->collOpImportUserChecks[] = $l;
		$l->setOpUser($this);
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

				$criteria->add(OpLocAdoptionPeer::USER_ID, $this->getId());

				OpLocAdoptionPeer::addSelectColumns($criteria);
				$this->collOpLocAdoptions = OpLocAdoptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpLocAdoptionPeer::USER_ID, $this->getId());

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

		$criteria->add(OpLocAdoptionPeer::USER_ID, $this->getId());

		return OpLocAdoptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpLocAdoption(OpLocAdoption $l)
	{
		$this->collOpLocAdoptions[] = $l;
		$l->setOpUser($this);
	}


	
	public function getOpLocAdoptionsJoinOpLocation($criteria = null, $con = null)
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

				$criteria->add(OpLocAdoptionPeer::USER_ID, $this->getId());

				$this->collOpLocAdoptions = OpLocAdoptionPeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpLocAdoptionPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpLocAdoptionCriteria) || !$this->lastOpLocAdoptionCriteria->equals($criteria)) {
				$this->collOpLocAdoptions = OpLocAdoptionPeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpLocAdoptionCriteria = $criteria;

		return $this->collOpLocAdoptions;
	}

	
	public function initOpMessages()
	{
		if ($this->collOpMessages === null) {
			$this->collOpMessages = array();
		}
	}

	
	public function getOpMessages($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpMessages === null) {
			if ($this->isNew()) {
			   $this->collOpMessages = array();
			} else {

				$criteria->add(OpMessagePeer::USER_ID, $this->getId());

				OpMessagePeer::addSelectColumns($criteria);
				$this->collOpMessages = OpMessagePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpMessagePeer::USER_ID, $this->getId());

				OpMessagePeer::addSelectColumns($criteria);
				if (!isset($this->lastOpMessageCriteria) || !$this->lastOpMessageCriteria->equals($criteria)) {
					$this->collOpMessages = OpMessagePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpMessageCriteria = $criteria;
		return $this->collOpMessages;
	}

	
	public function countOpMessages($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpMessagePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpMessagePeer::USER_ID, $this->getId());

		return OpMessagePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpMessage(OpMessage $l)
	{
		$this->collOpMessages[] = $l;
		$l->setOpUser($this);
	}

	
	public function initOpObscuredContents()
	{
		if ($this->collOpObscuredContents === null) {
			$this->collOpObscuredContents = array();
		}
	}

	
	public function getOpObscuredContents($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpObscuredContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpObscuredContents === null) {
			if ($this->isNew()) {
			   $this->collOpObscuredContents = array();
			} else {

				$criteria->add(OpObscuredContentPeer::USER_ID, $this->getId());

				OpObscuredContentPeer::addSelectColumns($criteria);
				$this->collOpObscuredContents = OpObscuredContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpObscuredContentPeer::USER_ID, $this->getId());

				OpObscuredContentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpObscuredContentCriteria) || !$this->lastOpObscuredContentCriteria->equals($criteria)) {
					$this->collOpObscuredContents = OpObscuredContentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpObscuredContentCriteria = $criteria;
		return $this->collOpObscuredContents;
	}

	
	public function countOpObscuredContents($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpObscuredContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpObscuredContentPeer::USER_ID, $this->getId());

		return OpObscuredContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpObscuredContent(OpObscuredContent $l)
	{
		$this->collOpObscuredContents[] = $l;
		$l->setOpUser($this);
	}


	
	public function getOpObscuredContentsJoinOpOpenContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpObscuredContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpObscuredContents === null) {
			if ($this->isNew()) {
				$this->collOpObscuredContents = array();
			} else {

				$criteria->add(OpObscuredContentPeer::USER_ID, $this->getId());

				$this->collOpObscuredContents = OpObscuredContentPeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpObscuredContentPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpObscuredContentCriteria) || !$this->lastOpObscuredContentCriteria->equals($criteria)) {
				$this->collOpObscuredContents = OpObscuredContentPeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		}
		$this->lastOpObscuredContentCriteria = $criteria;

		return $this->collOpObscuredContents;
	}

	
	public function initOpOpenContentsRelatedByUserId()
	{
		if ($this->collOpOpenContentsRelatedByUserId === null) {
			$this->collOpOpenContentsRelatedByUserId = array();
		}
	}

	
	public function getOpOpenContentsRelatedByUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOpenContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOpenContentsRelatedByUserId === null) {
			if ($this->isNew()) {
			   $this->collOpOpenContentsRelatedByUserId = array();
			} else {

				$criteria->add(OpOpenContentPeer::USER_ID, $this->getId());

				OpOpenContentPeer::addSelectColumns($criteria);
				$this->collOpOpenContentsRelatedByUserId = OpOpenContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpOpenContentPeer::USER_ID, $this->getId());

				OpOpenContentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpOpenContentRelatedByUserIdCriteria) || !$this->lastOpOpenContentRelatedByUserIdCriteria->equals($criteria)) {
					$this->collOpOpenContentsRelatedByUserId = OpOpenContentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpOpenContentRelatedByUserIdCriteria = $criteria;
		return $this->collOpOpenContentsRelatedByUserId;
	}

	
	public function countOpOpenContentsRelatedByUserId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpOpenContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpOpenContentPeer::USER_ID, $this->getId());

		return OpOpenContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpOpenContentRelatedByUserId(OpOpenContent $l)
	{
		$this->collOpOpenContentsRelatedByUserId[] = $l;
		$l->setOpUserRelatedByUserId($this);
	}


	
	public function getOpOpenContentsRelatedByUserIdJoinOpContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOpenContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOpenContentsRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collOpOpenContentsRelatedByUserId = array();
			} else {

				$criteria->add(OpOpenContentPeer::USER_ID, $this->getId());

				$this->collOpOpenContentsRelatedByUserId = OpOpenContentPeer::doSelectJoinOpContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpOpenContentPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpOpenContentRelatedByUserIdCriteria) || !$this->lastOpOpenContentRelatedByUserIdCriteria->equals($criteria)) {
				$this->collOpOpenContentsRelatedByUserId = OpOpenContentPeer::doSelectJoinOpContent($criteria, $con);
			}
		}
		$this->lastOpOpenContentRelatedByUserIdCriteria = $criteria;

		return $this->collOpOpenContentsRelatedByUserId;
	}

	
	public function initOpOpenContentsRelatedByUpdaterId()
	{
		if ($this->collOpOpenContentsRelatedByUpdaterId === null) {
			$this->collOpOpenContentsRelatedByUpdaterId = array();
		}
	}

	
	public function getOpOpenContentsRelatedByUpdaterId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOpenContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOpenContentsRelatedByUpdaterId === null) {
			if ($this->isNew()) {
			   $this->collOpOpenContentsRelatedByUpdaterId = array();
			} else {

				$criteria->add(OpOpenContentPeer::UPDATER_ID, $this->getId());

				OpOpenContentPeer::addSelectColumns($criteria);
				$this->collOpOpenContentsRelatedByUpdaterId = OpOpenContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpOpenContentPeer::UPDATER_ID, $this->getId());

				OpOpenContentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpOpenContentRelatedByUpdaterIdCriteria) || !$this->lastOpOpenContentRelatedByUpdaterIdCriteria->equals($criteria)) {
					$this->collOpOpenContentsRelatedByUpdaterId = OpOpenContentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpOpenContentRelatedByUpdaterIdCriteria = $criteria;
		return $this->collOpOpenContentsRelatedByUpdaterId;
	}

	
	public function countOpOpenContentsRelatedByUpdaterId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpOpenContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpOpenContentPeer::UPDATER_ID, $this->getId());

		return OpOpenContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpOpenContentRelatedByUpdaterId(OpOpenContent $l)
	{
		$this->collOpOpenContentsRelatedByUpdaterId[] = $l;
		$l->setOpUserRelatedByUpdaterId($this);
	}


	
	public function getOpOpenContentsRelatedByUpdaterIdJoinOpContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpOpenContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpOpenContentsRelatedByUpdaterId === null) {
			if ($this->isNew()) {
				$this->collOpOpenContentsRelatedByUpdaterId = array();
			} else {

				$criteria->add(OpOpenContentPeer::UPDATER_ID, $this->getId());

				$this->collOpOpenContentsRelatedByUpdaterId = OpOpenContentPeer::doSelectJoinOpContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpOpenContentPeer::UPDATER_ID, $this->getId());

			if (!isset($this->lastOpOpenContentRelatedByUpdaterIdCriteria) || !$this->lastOpOpenContentRelatedByUpdaterIdCriteria->equals($criteria)) {
				$this->collOpOpenContentsRelatedByUpdaterId = OpOpenContentPeer::doSelectJoinOpContent($criteria, $con);
			}
		}
		$this->lastOpOpenContentRelatedByUpdaterIdCriteria = $criteria;

		return $this->collOpOpenContentsRelatedByUpdaterId;
	}

	
	public function initOpVerifiedContents()
	{
		if ($this->collOpVerifiedContents === null) {
			$this->collOpVerifiedContents = array();
		}
	}

	
	public function getOpVerifiedContents($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpVerifiedContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpVerifiedContents === null) {
			if ($this->isNew()) {
			   $this->collOpVerifiedContents = array();
			} else {

				$criteria->add(OpVerifiedContentPeer::USER_ID, $this->getId());

				OpVerifiedContentPeer::addSelectColumns($criteria);
				$this->collOpVerifiedContents = OpVerifiedContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpVerifiedContentPeer::USER_ID, $this->getId());

				OpVerifiedContentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpVerifiedContentCriteria) || !$this->lastOpVerifiedContentCriteria->equals($criteria)) {
					$this->collOpVerifiedContents = OpVerifiedContentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpVerifiedContentCriteria = $criteria;
		return $this->collOpVerifiedContents;
	}

	
	public function countOpVerifiedContents($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpVerifiedContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpVerifiedContentPeer::USER_ID, $this->getId());

		return OpVerifiedContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpVerifiedContent(OpVerifiedContent $l)
	{
		$this->collOpVerifiedContents[] = $l;
		$l->setOpUser($this);
	}


	
	public function getOpVerifiedContentsJoinOpOpenContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpVerifiedContentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpVerifiedContents === null) {
			if ($this->isNew()) {
				$this->collOpVerifiedContents = array();
			} else {

				$criteria->add(OpVerifiedContentPeer::USER_ID, $this->getId());

				$this->collOpVerifiedContents = OpVerifiedContentPeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpVerifiedContentPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpVerifiedContentCriteria) || !$this->lastOpVerifiedContentCriteria->equals($criteria)) {
				$this->collOpVerifiedContents = OpVerifiedContentPeer::doSelectJoinOpOpenContent($criteria, $con);
			}
		}
		$this->lastOpVerifiedContentCriteria = $criteria;

		return $this->collOpVerifiedContents;
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

				$criteria->add(OpPolAdoptionPeer::USER_ID, $this->getId());

				OpPolAdoptionPeer::addSelectColumns($criteria);
				$this->collOpPolAdoptions = OpPolAdoptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPolAdoptionPeer::USER_ID, $this->getId());

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

		$criteria->add(OpPolAdoptionPeer::USER_ID, $this->getId());

		return OpPolAdoptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPolAdoption(OpPolAdoption $l)
	{
		$this->collOpPolAdoptions[] = $l;
		$l->setOpUser($this);
	}


	
	public function getOpPolAdoptionsJoinOpPolitician($criteria = null, $con = null)
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

				$criteria->add(OpPolAdoptionPeer::USER_ID, $this->getId());

				$this->collOpPolAdoptions = OpPolAdoptionPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPolAdoptionPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpPolAdoptionCriteria) || !$this->lastOpPolAdoptionCriteria->equals($criteria)) {
				$this->collOpPolAdoptions = OpPolAdoptionPeer::doSelectJoinOpPolitician($criteria, $con);
			}
		}
		$this->lastOpPolAdoptionCriteria = $criteria;

		return $this->collOpPolAdoptions;
	}

	
	public function initOpPoliticiansRelatedByUserId()
	{
		if ($this->collOpPoliticiansRelatedByUserId === null) {
			$this->collOpPoliticiansRelatedByUserId = array();
		}
	}

	
	public function getOpPoliticiansRelatedByUserId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticiansRelatedByUserId === null) {
			if ($this->isNew()) {
			   $this->collOpPoliticiansRelatedByUserId = array();
			} else {

				$criteria->add(OpPoliticianPeer::USER_ID, $this->getId());

				OpPoliticianPeer::addSelectColumns($criteria);
				$this->collOpPoliticiansRelatedByUserId = OpPoliticianPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPoliticianPeer::USER_ID, $this->getId());

				OpPoliticianPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpPoliticianRelatedByUserIdCriteria) || !$this->lastOpPoliticianRelatedByUserIdCriteria->equals($criteria)) {
					$this->collOpPoliticiansRelatedByUserId = OpPoliticianPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpPoliticianRelatedByUserIdCriteria = $criteria;
		return $this->collOpPoliticiansRelatedByUserId;
	}

	
	public function countOpPoliticiansRelatedByUserId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpPoliticianPeer::USER_ID, $this->getId());

		return OpPoliticianPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPoliticianRelatedByUserId(OpPolitician $l)
	{
		$this->collOpPoliticiansRelatedByUserId[] = $l;
		$l->setOpUserRelatedByUserId($this);
	}


	
	public function getOpPoliticiansRelatedByUserIdJoinOpContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticiansRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collOpPoliticiansRelatedByUserId = array();
			} else {

				$criteria->add(OpPoliticianPeer::USER_ID, $this->getId());

				$this->collOpPoliticiansRelatedByUserId = OpPoliticianPeer::doSelectJoinOpContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticianPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpPoliticianRelatedByUserIdCriteria) || !$this->lastOpPoliticianRelatedByUserIdCriteria->equals($criteria)) {
				$this->collOpPoliticiansRelatedByUserId = OpPoliticianPeer::doSelectJoinOpContent($criteria, $con);
			}
		}
		$this->lastOpPoliticianRelatedByUserIdCriteria = $criteria;

		return $this->collOpPoliticiansRelatedByUserId;
	}


	
	public function getOpPoliticiansRelatedByUserIdJoinOpProfession($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticiansRelatedByUserId === null) {
			if ($this->isNew()) {
				$this->collOpPoliticiansRelatedByUserId = array();
			} else {

				$criteria->add(OpPoliticianPeer::USER_ID, $this->getId());

				$this->collOpPoliticiansRelatedByUserId = OpPoliticianPeer::doSelectJoinOpProfession($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticianPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpPoliticianRelatedByUserIdCriteria) || !$this->lastOpPoliticianRelatedByUserIdCriteria->equals($criteria)) {
				$this->collOpPoliticiansRelatedByUserId = OpPoliticianPeer::doSelectJoinOpProfession($criteria, $con);
			}
		}
		$this->lastOpPoliticianRelatedByUserIdCriteria = $criteria;

		return $this->collOpPoliticiansRelatedByUserId;
	}

	
	public function initOpPoliticiansRelatedByCreatorId()
	{
		if ($this->collOpPoliticiansRelatedByCreatorId === null) {
			$this->collOpPoliticiansRelatedByCreatorId = array();
		}
	}

	
	public function getOpPoliticiansRelatedByCreatorId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticiansRelatedByCreatorId === null) {
			if ($this->isNew()) {
			   $this->collOpPoliticiansRelatedByCreatorId = array();
			} else {

				$criteria->add(OpPoliticianPeer::CREATOR_ID, $this->getId());

				OpPoliticianPeer::addSelectColumns($criteria);
				$this->collOpPoliticiansRelatedByCreatorId = OpPoliticianPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpPoliticianPeer::CREATOR_ID, $this->getId());

				OpPoliticianPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpPoliticianRelatedByCreatorIdCriteria) || !$this->lastOpPoliticianRelatedByCreatorIdCriteria->equals($criteria)) {
					$this->collOpPoliticiansRelatedByCreatorId = OpPoliticianPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpPoliticianRelatedByCreatorIdCriteria = $criteria;
		return $this->collOpPoliticiansRelatedByCreatorId;
	}

	
	public function countOpPoliticiansRelatedByCreatorId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpPoliticianPeer::CREATOR_ID, $this->getId());

		return OpPoliticianPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpPoliticianRelatedByCreatorId(OpPolitician $l)
	{
		$this->collOpPoliticiansRelatedByCreatorId[] = $l;
		$l->setOpUserRelatedByCreatorId($this);
	}


	
	public function getOpPoliticiansRelatedByCreatorIdJoinOpContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticiansRelatedByCreatorId === null) {
			if ($this->isNew()) {
				$this->collOpPoliticiansRelatedByCreatorId = array();
			} else {

				$criteria->add(OpPoliticianPeer::CREATOR_ID, $this->getId());

				$this->collOpPoliticiansRelatedByCreatorId = OpPoliticianPeer::doSelectJoinOpContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticianPeer::CREATOR_ID, $this->getId());

			if (!isset($this->lastOpPoliticianRelatedByCreatorIdCriteria) || !$this->lastOpPoliticianRelatedByCreatorIdCriteria->equals($criteria)) {
				$this->collOpPoliticiansRelatedByCreatorId = OpPoliticianPeer::doSelectJoinOpContent($criteria, $con);
			}
		}
		$this->lastOpPoliticianRelatedByCreatorIdCriteria = $criteria;

		return $this->collOpPoliticiansRelatedByCreatorId;
	}


	
	public function getOpPoliticiansRelatedByCreatorIdJoinOpProfession($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpPoliticiansRelatedByCreatorId === null) {
			if ($this->isNew()) {
				$this->collOpPoliticiansRelatedByCreatorId = array();
			} else {

				$criteria->add(OpPoliticianPeer::CREATOR_ID, $this->getId());

				$this->collOpPoliticiansRelatedByCreatorId = OpPoliticianPeer::doSelectJoinOpProfession($criteria, $con);
			}
		} else {
									
			$criteria->add(OpPoliticianPeer::CREATOR_ID, $this->getId());

			if (!isset($this->lastOpPoliticianRelatedByCreatorIdCriteria) || !$this->lastOpPoliticianRelatedByCreatorIdCriteria->equals($criteria)) {
				$this->collOpPoliticiansRelatedByCreatorId = OpPoliticianPeer::doSelectJoinOpProfession($criteria, $con);
			}
		}
		$this->lastOpPoliticianRelatedByCreatorIdCriteria = $criteria;

		return $this->collOpPoliticiansRelatedByCreatorId;
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

				$criteria->add(OpRelevancyPeer::USER_ID, $this->getId());

				OpRelevancyPeer::addSelectColumns($criteria);
				$this->collOpRelevancys = OpRelevancyPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpRelevancyPeer::USER_ID, $this->getId());

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

		$criteria->add(OpRelevancyPeer::USER_ID, $this->getId());

		return OpRelevancyPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpRelevancy(OpRelevancy $l)
	{
		$this->collOpRelevancys[] = $l;
		$l->setOpUser($this);
	}


	
	public function getOpRelevancysJoinOpOpinableContent($criteria = null, $con = null)
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

				$criteria->add(OpRelevancyPeer::USER_ID, $this->getId());

				$this->collOpRelevancys = OpRelevancyPeer::doSelectJoinOpOpinableContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpRelevancyPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpRelevancyCriteria) || !$this->lastOpRelevancyCriteria->equals($criteria)) {
				$this->collOpRelevancys = OpRelevancyPeer::doSelectJoinOpOpinableContent($criteria, $con);
			}
		}
		$this->lastOpRelevancyCriteria = $criteria;

		return $this->collOpRelevancys;
	}

	
	public function initOpRelevancyComments()
	{
		if ($this->collOpRelevancyComments === null) {
			$this->collOpRelevancyComments = array();
		}
	}

	
	public function getOpRelevancyComments($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpRelevancyCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpRelevancyComments === null) {
			if ($this->isNew()) {
			   $this->collOpRelevancyComments = array();
			} else {

				$criteria->add(OpRelevancyCommentPeer::USER_ID, $this->getId());

				OpRelevancyCommentPeer::addSelectColumns($criteria);
				$this->collOpRelevancyComments = OpRelevancyCommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpRelevancyCommentPeer::USER_ID, $this->getId());

				OpRelevancyCommentPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpRelevancyCommentCriteria) || !$this->lastOpRelevancyCommentCriteria->equals($criteria)) {
					$this->collOpRelevancyComments = OpRelevancyCommentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpRelevancyCommentCriteria = $criteria;
		return $this->collOpRelevancyComments;
	}

	
	public function countOpRelevancyComments($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpRelevancyCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpRelevancyCommentPeer::USER_ID, $this->getId());

		return OpRelevancyCommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpRelevancyComment(OpRelevancyComment $l)
	{
		$this->collOpRelevancyComments[] = $l;
		$l->setOpUser($this);
	}


	
	public function getOpRelevancyCommentsJoinOpComment($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpRelevancyCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpRelevancyComments === null) {
			if ($this->isNew()) {
				$this->collOpRelevancyComments = array();
			} else {

				$criteria->add(OpRelevancyCommentPeer::USER_ID, $this->getId());

				$this->collOpRelevancyComments = OpRelevancyCommentPeer::doSelectJoinOpComment($criteria, $con);
			}
		} else {
									
			$criteria->add(OpRelevancyCommentPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpRelevancyCommentCriteria) || !$this->lastOpRelevancyCommentCriteria->equals($criteria)) {
				$this->collOpRelevancyComments = OpRelevancyCommentPeer::doSelectJoinOpComment($criteria, $con);
			}
		}
		$this->lastOpRelevancyCommentCriteria = $criteria;

		return $this->collOpRelevancyComments;
	}

	
	public function initOpReports()
	{
		if ($this->collOpReports === null) {
			$this->collOpReports = array();
		}
	}

	
	public function getOpReports($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpReports === null) {
			if ($this->isNew()) {
			   $this->collOpReports = array();
			} else {

				$criteria->add(OpReportPeer::USER_ID, $this->getId());

				OpReportPeer::addSelectColumns($criteria);
				$this->collOpReports = OpReportPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpReportPeer::USER_ID, $this->getId());

				OpReportPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpReportCriteria) || !$this->lastOpReportCriteria->equals($criteria)) {
					$this->collOpReports = OpReportPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpReportCriteria = $criteria;
		return $this->collOpReports;
	}

	
	public function countOpReports($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpReportPeer::USER_ID, $this->getId());

		return OpReportPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpReport(OpReport $l)
	{
		$this->collOpReports[] = $l;
		$l->setOpUser($this);
	}


	
	public function getOpReportsJoinOpContent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpReportPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpReports === null) {
			if ($this->isNew()) {
				$this->collOpReports = array();
			} else {

				$criteria->add(OpReportPeer::USER_ID, $this->getId());

				$this->collOpReports = OpReportPeer::doSelectJoinOpContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpReportPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpReportCriteria) || !$this->lastOpReportCriteria->equals($criteria)) {
				$this->collOpReports = OpReportPeer::doSelectJoinOpContent($criteria, $con);
			}
		}
		$this->lastOpReportCriteria = $criteria;

		return $this->collOpReports;
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

				$criteria->add(OpTagHasOpOpinableContentPeer::USER_ID, $this->getId());

				OpTagHasOpOpinableContentPeer::addSelectColumns($criteria);
				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpTagHasOpOpinableContentPeer::USER_ID, $this->getId());

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

		$criteria->add(OpTagHasOpOpinableContentPeer::USER_ID, $this->getId());

		return OpTagHasOpOpinableContentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpTagHasOpOpinableContent(OpTagHasOpOpinableContent $l)
	{
		$this->collOpTagHasOpOpinableContents[] = $l;
		$l->setOpUser($this);
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

				$criteria->add(OpTagHasOpOpinableContentPeer::USER_ID, $this->getId());

				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelectJoinOpTag($criteria, $con);
			}
		} else {
									
			$criteria->add(OpTagHasOpOpinableContentPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpTagHasOpOpinableContentCriteria) || !$this->lastOpTagHasOpOpinableContentCriteria->equals($criteria)) {
				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelectJoinOpTag($criteria, $con);
			}
		}
		$this->lastOpTagHasOpOpinableContentCriteria = $criteria;

		return $this->collOpTagHasOpOpinableContents;
	}


	
	public function getOpTagHasOpOpinableContentsJoinOpOpinableContent($criteria = null, $con = null)
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

				$criteria->add(OpTagHasOpOpinableContentPeer::USER_ID, $this->getId());

				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelectJoinOpOpinableContent($criteria, $con);
			}
		} else {
									
			$criteria->add(OpTagHasOpOpinableContentPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpTagHasOpOpinableContentCriteria) || !$this->lastOpTagHasOpOpinableContentCriteria->equals($criteria)) {
				$this->collOpTagHasOpOpinableContents = OpTagHasOpOpinableContentPeer::doSelectJoinOpOpinableContent($criteria, $con);
			}
		}
		$this->lastOpTagHasOpOpinableContentCriteria = $criteria;

		return $this->collOpTagHasOpOpinableContents;
	}

	
	public function initOpSimilarPoliticians()
	{
		if ($this->collOpSimilarPoliticians === null) {
			$this->collOpSimilarPoliticians = array();
		}
	}

	
	public function getOpSimilarPoliticians($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpSimilarPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpSimilarPoliticians === null) {
			if ($this->isNew()) {
			   $this->collOpSimilarPoliticians = array();
			} else {

				$criteria->add(OpSimilarPoliticianPeer::USER_ID, $this->getId());

				OpSimilarPoliticianPeer::addSelectColumns($criteria);
				$this->collOpSimilarPoliticians = OpSimilarPoliticianPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpSimilarPoliticianPeer::USER_ID, $this->getId());

				OpSimilarPoliticianPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpSimilarPoliticianCriteria) || !$this->lastOpSimilarPoliticianCriteria->equals($criteria)) {
					$this->collOpSimilarPoliticians = OpSimilarPoliticianPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpSimilarPoliticianCriteria = $criteria;
		return $this->collOpSimilarPoliticians;
	}

	
	public function countOpSimilarPoliticians($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpSimilarPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpSimilarPoliticianPeer::USER_ID, $this->getId());

		return OpSimilarPoliticianPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpSimilarPolitician(OpSimilarPolitician $l)
	{
		$this->collOpSimilarPoliticians[] = $l;
		$l->setOpUser($this);
	}


	
	public function getOpSimilarPoliticiansJoinOpPoliticianRelatedByOriginalId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpSimilarPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpSimilarPoliticians === null) {
			if ($this->isNew()) {
				$this->collOpSimilarPoliticians = array();
			} else {

				$criteria->add(OpSimilarPoliticianPeer::USER_ID, $this->getId());

				$this->collOpSimilarPoliticians = OpSimilarPoliticianPeer::doSelectJoinOpPoliticianRelatedByOriginalId($criteria, $con);
			}
		} else {
									
			$criteria->add(OpSimilarPoliticianPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpSimilarPoliticianCriteria) || !$this->lastOpSimilarPoliticianCriteria->equals($criteria)) {
				$this->collOpSimilarPoliticians = OpSimilarPoliticianPeer::doSelectJoinOpPoliticianRelatedByOriginalId($criteria, $con);
			}
		}
		$this->lastOpSimilarPoliticianCriteria = $criteria;

		return $this->collOpSimilarPoliticians;
	}


	
	public function getOpSimilarPoliticiansJoinOpPoliticianRelatedBySimilarId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpSimilarPoliticianPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpSimilarPoliticians === null) {
			if ($this->isNew()) {
				$this->collOpSimilarPoliticians = array();
			} else {

				$criteria->add(OpSimilarPoliticianPeer::USER_ID, $this->getId());

				$this->collOpSimilarPoliticians = OpSimilarPoliticianPeer::doSelectJoinOpPoliticianRelatedBySimilarId($criteria, $con);
			}
		} else {
									
			$criteria->add(OpSimilarPoliticianPeer::USER_ID, $this->getId());

			if (!isset($this->lastOpSimilarPoliticianCriteria) || !$this->lastOpSimilarPoliticianCriteria->equals($criteria)) {
				$this->collOpSimilarPoliticians = OpSimilarPoliticianPeer::doSelectJoinOpPoliticianRelatedBySimilarId($criteria, $con);
			}
		}
		$this->lastOpSimilarPoliticianCriteria = $criteria;

		return $this->collOpSimilarPoliticians;
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

				$criteria->add(OpImportSimilarPeer::DELETING_USER_ID, $this->getId());

				OpImportSimilarPeer::addSelectColumns($criteria);
				$this->collOpImportSimilars = OpImportSimilarPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpImportSimilarPeer::DELETING_USER_ID, $this->getId());

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

		$criteria->add(OpImportSimilarPeer::DELETING_USER_ID, $this->getId());

		return OpImportSimilarPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpImportSimilar(OpImportSimilar $l)
	{
		$this->collOpImportSimilars[] = $l;
		$l->setOpUser($this);
	}


	
	public function getOpImportSimilarsJoinOpLocation($criteria = null, $con = null)
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

				$criteria->add(OpImportSimilarPeer::DELETING_USER_ID, $this->getId());

				$this->collOpImportSimilars = OpImportSimilarPeer::doSelectJoinOpLocation($criteria, $con);
			}
		} else {
									
			$criteria->add(OpImportSimilarPeer::DELETING_USER_ID, $this->getId());

			if (!isset($this->lastOpImportSimilarCriteria) || !$this->lastOpImportSimilarCriteria->equals($criteria)) {
				$this->collOpImportSimilars = OpImportSimilarPeer::doSelectJoinOpLocation($criteria, $con);
			}
		}
		$this->lastOpImportSimilarCriteria = $criteria;

		return $this->collOpImportSimilars;
	}

	
	public function initOpImportBlocks()
	{
		if ($this->collOpImportBlocks === null) {
			$this->collOpImportBlocks = array();
		}
	}

	
	public function getOpImportBlocks($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportBlockPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collOpImportBlocks === null) {
			if ($this->isNew()) {
			   $this->collOpImportBlocks = array();
			} else {

				$criteria->add(OpImportBlockPeer::CREATING_USER_ID, $this->getId());

				OpImportBlockPeer::addSelectColumns($criteria);
				$this->collOpImportBlocks = OpImportBlockPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(OpImportBlockPeer::CREATING_USER_ID, $this->getId());

				OpImportBlockPeer::addSelectColumns($criteria);
				if (!isset($this->lastOpImportBlockCriteria) || !$this->lastOpImportBlockCriteria->equals($criteria)) {
					$this->collOpImportBlocks = OpImportBlockPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastOpImportBlockCriteria = $criteria;
		return $this->collOpImportBlocks;
	}

	
	public function countOpImportBlocks($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseOpImportBlockPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(OpImportBlockPeer::CREATING_USER_ID, $this->getId());

		return OpImportBlockPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addOpImportBlock(OpImportBlock $l)
	{
		$this->collOpImportBlocks[] = $l;
		$l->setOpUser($this);
	}

} 