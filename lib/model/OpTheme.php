<?php

require_once 'lib/model/om/BaseOpTheme.php';


/**
 * Skeleton subclass for representing a row from the 'op_theme' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpTheme extends BaseOpTheme {

	/**
	 * @var OpOpenContent
	 */
	protected $aOpOpenContent;

  /**
	 * Stores the object in the database.  
	 * Overrides the method in the Object Model, taking account of
	 * the op_content relation.
	 * If the object is new, then an OpinableContent object is created and saved
	 * before saving the Theme object, so that the last one can get
	 * its content_id field from the OpinableContent object.
	 * This method wraps the doSave() worker method in a transaction.
	 *
	 * @param Connection $con
	 * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws PropelException
	 * @see doSave()
	 */
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
			$c_affected_rows='';
			if ($this->isNew()){
				$c = new OpOpinableContent();
				$c_affected_rows = $c->save($con);
				$this->setContentId($c->getContentId());
				$this->setOpOpinableContent($c);
				
				// set op_table and hash fields in op_content table
				$cc = $c->getOpOpenContent()->getOpContent();
				$cc->setOpTable(OpThemePeer::TABLE_NAME);
				$cc->setOpClass("OpTheme");
				$cc->setHash(md5(rand(100000, 999999).$this->getContentId().time()));
				$cc->save($con);
				
			}
			$affectedRows = $this->doSave($con);

      // agiornamento campo op_user.themes (TBD)
      $user = $this->getOpOpenContent()->getOpUser();
      $user->setThemes($user->countThemes());
      $user->save($con);
      unset($user);

			// aggiornamento dell'indice testuale
      $iMan = new OpIndexManager();
      $iMan->updateDocument($this);
      $iMan->commit();
      unset($iMan);

			$con->commit();
      
			
			return $c_affected_rows + $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function getPopularComments()
  	{
    	$c = new Criteria();
    	$c->add(OpCommentPeer::COMMENT_ID, $this->getContentId());
    	$c->addAsColumn('relevancy', OpCommentPeer::RELEVANCY_SCORE_UP.' / ('.OpCommentPeer::RELEVANCY_SCORE_UP.' + '.OpCommentPeer::RELEVANCY_SCORE_DOWN.')');
    	$c->addDescendingOrderByColumn('relevancy');
    	$c->addDescendingOrderByColumn(OpCommentPeer::RELEVANCY_SCORE_UP);

    	return OpCommentPeer::doSelect($c);
  	}
	
	public function getTags()
	{
		return $this->getOpOpinableContent()->getOpTagHasOpOpinableContents();
	}
	
		
	/**
	 * torna il numero di posizioni associate a un tema
	 *
	 * @return integer
	 * @author Guglielmo Celata
	 **/
	public function getPositionsNumber()
	{
	  $c = new Criteria();
    $c->add(OpThemeHasDeclarationPeer::THEME_ID, $this->getContentId());
    return OpThemeHasDeclarationPeer::doCount($c);
	}
	
	/**
	 * Declares an association between this object and a OpOpenContent object.
	 *
	 * @param OpOpenContent $v
	 * @return void
	 * @throws PropelException
	 */
	public function setOpOpenContent($v)
	{


		if ($v === null) {
			$this->setContentId('0');
		} else {
			$this->setContentId($v->getContentId());
		}

		$this->aOpOpenContent = $v;
	}
	
	/**
	 * Get the associated OpOpenContent object
	 *
	 * @param Connection Optional Connection object.
	 * @return OpOpenContent The associated OpOpinableContent object.
	 * @throws PropelException
	 */
	public function getOpOpenContent($con = null)
	{
		// include the related Peer class
		include_once 'lib/model/om/BaseOpOpenContentPeer.php';

		if ($this->aOpOpenContent === null && ($this->content_id !== null)) {

			$this->aOpOpenContent = OpOpenContentPeer::retrieveByPK($this->content_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = OpOpenContentPeer::retrieveByPK($this->content_id, $con);
			   $obj->addOpOpenContents($this);
			 */
		}
		return $this->aOpOpenContent;
	}
	
	public function getStrippedTitle()
	{
		  $text = strtolower($this->getTitle());
		 
		  // strip all non word chars
		  $text = preg_replace('/\W/', ' ', $text);
		  // replace all white space sections with a dash
		  $text = preg_replace('/\ +/', '-', $text);
		  // trim dashes
		  $text = preg_replace('/\-$/', '', $text);
		  $text = preg_replace('/^\-/', '', $text);
		 
		  return $text;
	}
	
	
	/**
	 * torna un array di IDs di location associate al tema
	 * dalla tabella theme_has_location
	 *
	 * @return array di ID
	 * @author Guglielmo Celata
	 **/
	public function getLocationIDs()
	{
	  $locations = $this->getOpThemeHasLocations();
	  $locationIDs = array();
	  foreach ($locations as $loc) 
	    $locationIDs []= $loc->getLocationId();
	  return $locationIDs;
	}
	
	
	public function getAreaTematica()
	{
	  $tags = $this->getTags();
	  return $tags[0]->getOpTag()->getTag();
	}

} // OpTheme
