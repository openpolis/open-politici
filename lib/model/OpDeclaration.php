<?php
/*****************************************************************************
 *    Questo file e' parte del progetto openpolis.
 * 
 *    openpolis - la politica trasparente
 *    copyright (C) 2008
 *    Ass. Democrazia Elettronica e Partecipazione Pubblica, 
 *    Via Luigi Montuori 5, 00154 - Roma, Italia
 *
 *    openpolis e' free software; e' possibile redistribuirlo o modificarlo
 *    nei termini della General Public License GNU, versione 2 o successive;
 *    secondo quanto pubblicato dalla Free Software Foundation.
 *
 *    openpolis e' distribuito nella speranza che risulti utile, 
 *    ma SENZA ALCUNA GARANZIA.
 *    
 *    Potete trovare la licenza GPL e altre informazioni su licenze e 
 *    copyright, nella cartella "licenze" del package.
 *
 *    $HeadURL$
 *    $LastChangedDate$
 *    $LastChangedBy$
 *    $LastChangedRevision$
 *
 ****************************************************************************/
?>
<?php

require_once 'lib/model/om/BaseOpDeclaration.php';


/**
 * Skeleton subclass for representing a row from the 'op_declaration' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
 
class OpDeclaration extends BaseOpDeclaration {

	/**
	 * @var OpOpenContent
	 */
	protected $aOpOpenContent;
	
	
	
	public function getDeclarationAbstract($length=30)
	{
	  function trunc_text($text, $length, $truncate_string = '...', $truncate_lastspace = false)
    {
      if ($text == '')
      {
        return '';
      }

      if (strlen($text) > $length)
      {
        $truncate_text = substr($text, 0, $length - strlen($truncate_string));
        if ($truncate_lastspace)
        {
          $truncate_text = preg_replace('/\s+?(\S+)?$/', '', $truncate_text);
        }

        return $truncate_text.$truncate_string;
      }
      else
      {
        return $text;
      }
    }
	  //return $this->getTitle();
	  return trunc_text(strip_tags($this->getText()), 200 , '...');
	}
	

  /**
	 * Stores the object in the database.  
	 * Overrides the method in the Object Model, taking account of
	 * the op_content relation.
	 * If the object is new, then an OpinableContent object is created and saved
	 * before saving the Declaration object, so that the last one can get
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
			$con = Propel::getConnection(OpDeclarationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$c_affected_rows='';
			if ($this->isNew()){
				$c = new OpOpinableContent();
				$c_affected_rows = $c->save($con);
				$this->setContentId($c->getContentId());
				$this->setOpOpinableContent($c);
                $this->setSlug( Utils::slugify( $this->getTitle() ) );
				
				// set op_table and hash fields in op_content table
				$cc = $c->getOpOpenContent()->getOpContent();
				$cc->setOpTable(OpDeclarationPeer::TABLE_NAME);
				$cc->setOpClass("OpDeclaration");
				$cc->setHash(md5(rand(100000, 999999).$this->getContentId().time()));
				$cc->save($con);

			} else if ($this->isModified()){
				$this->getOpOpenContent()->setUpdaterId(sfContext::getInstance()->getUser()->getAttribute('subscriber_id', '', 'subscriber')?sfContext::getInstance()->getUser()->getSubscriberId():1);
				$this->getOpOpenContent()->save();
				$this->getOpOpenContent()->getOpContent()->setUpdatedAt(time());
				$this->getOpOpenContent()->getOpContent()->save();
                $this->setSlug( Utils::slugify( $this->getTitle() ) );
			}
			
			// aggiorna il timestamp dell'ultimo incarico per un politico e una location
			$this->getOpPolitician()->setLastChargeUpdate(time());
			
			// salva la dichiarazione
			$affectedRows = $this->doSave($con);

      // agiornamento campo op_user.declarations
      // sono contate solo le dichiarazioni inserite
      $user_id = $this->getOpOpenContent()->getUserId();
      if ($user_id != 1)
      {
        $user = $this->getOpOpenContent()->getOpUser();
        $user->setDeclarations($user->countDeclarations());
        $user->save($con);
        unset($user);
      }
      
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

	
	/**
	 * Set the value of [sourch_attach] column, starting from a file.
	 * This extends the base class, using a method of the CLOB object.
	 * If the file does not exist, then the original setSourchAttach method is called
	 * 
	 * @param string $filename file location on server
	 * @return void
	 */
	public function setSourceAttach($filename)
	{
		if(!stat($filename)){
			parent::setSourceAttach($filename);
		} else {
			try {
				$this->source_attach = new Blob();
				$this->source_attach->readFromFile($filename);
				$this->modifiedColumns[] = OpDeclarationPeer::SOURCE_ATTACH;
			} catch (Exception $e) {
				echo("Exception " . $e . " encountered!\n");
			}
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
		return $this->getOpOpinableContent()->getOpTagHasOpOpinableContentsJoinOpTag();
	}
	
	public function getTagsIds()
	{
	  return OpTagHasOpOpinableContentPeer::getTagsIdsForContent($this->getContentId());
	}
	
	public function getTagsAsArrayOfStrings()
	{
	  $tags = array();
	  foreach ($this->getTags() as $tag)
    {
      $tags[] = $tag->getOpTag()->getTag();
    }
    return $tags;
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
	
	
	public function getAssociatedTheme($theme_id)
	{
	  $c = new Criteria();
	  $c->add(OpThemeHasDeclarationPeer::THEME_ID, $theme_id);
	  
	  $associations = $this->getOpThemeHasDeclarations($c);
	  
	  return $associations[0];
	}
	
	public function getSlugUrl()
	{
		$parts = array();
		foreach ( $this->getSlugArray() as $part => $value )
		{
			$parts[] = $part .'='. $value;
		}
		return implode('&', $parts);
	}
	
	public function getSlugArray()
	{
		$date = explode( '/', date( 'Y/m/d', strtotime($this->getDate())  ) );
		return array(
			'year' => $date[0],
			'month' => $date[1],
			'day' => $date[2],
			'politician' => $this->getOpPolitician()->getSlug(),
			'slug' => $this->getSlug(),
			'declaration_id' => $this->getContentId()
		);
	}
	
	
} // OpDeclaration

?>
