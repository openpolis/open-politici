<?php

/**
 * opinableContent actions.
 *
 * @package    openpolis
 * @subpackage opinableContent
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class opinableContentActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
  
  
  
  public function executeBlockForComments()
  {
  	$this->content_id = $this->getRequestParameter('content_id');
	  $this->sort = $this->getRequestParameter('sort');
  }
 
  
  public function executeAddComment()
  {
    $this->sort = $this->getRequestParameter('sort', 'date');
	  $this->content_id = $this->getRequestParameter('content_id');
    $this->content = OpOpinableContentPeer::retrieveByPk($this->content_id);
    $this->forward404Unless($this->content);
    
	  if ($this->getRequestParameter('body'))
    {
      // create comment
      $this->comment = new OpComment();
      $this->comment->setContentId($this->content_id);
      $this->comment->setUserId(sfContext::getInstance()->getUser()->getAttribute('subscriber_id', '', 'subscriber')?sfContext::getInstance()->getUser()->getSubscriberId():1);
      $this->comment->setBody($this->getRequestParameter('body'));
      $this->comment->setHtmlBody($this->getRequestParameter('body'));

      $this->comment->save();
    }
    
  }
  
  public function executeDelComment()
  {
    $comment = OpCommentPeer::RetrieveByPk($this->getRequestParameter('comment_id'));

	  if ($comment instanceof OpComment)
	  {
    	$this->sort = $this->getRequestParameter('sort', 'date');
    	$this->content_id = $comment->getContentId();
    	$comment->delete();	    
	  }
  }	

  
  public function executeAddTags()
  {
    $this->content_id = $this->getRequestParameter('content_id');
    $this->opinableContent = OpOpinableContent::retrieveByPk($this->getRequestParameter('content_id'));
  }

  public function executeAddTag()
  {
    $tags = strip_tags($this->getRequestParameter('tags',''));
    $this->content_id = $this->getRequestParameter('content_id');
    $this->content = OpContentPeer::getRealContent($this->content_id);


    //validazione
    if (strlen($tags)!=0)
    {
      $tags=split(',',$this->getRequestParameter('tags'));
      foreach($tags as $tag)
      {
        if (trim($tag) == '') continue;
        
        //$tag = trim(strip_tags($tag));
		
		    //controllo se il tag gia esiste
        $normalized_tag=myTag::normalize($tag);
        $c=new Criteria();
        $c->Add(OpTagPeer::NORMALIZED_TAG, $normalized_tag);
        $existing_tag=OpTagPeer::DoSelectOne($c);

        if($existing_tag)
        {
          if (myTag::normalize($tag) != '')
          { 
            //aggiorno il campo update_at del tag
    		    $existing_tag->setUpdatedAt(time());
    		    $existing_tag->save();
		  
		        //il tag esiste
            //controllo se è gia associato alla dichiarazione
            $c1=new Criteria();
            $c1->Add(OpTagHasOpOpinableContentPeer::TAG_ID,$existing_tag->getId());
            $c1->Add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $this->content_id);
            $m2m_tag=OpTagHasOpOpinableContentPeer::doSelectOne($c1);

            if(!$m2m_tag)
            {
              //il tag esiste e non è associato alla dichiarazione
              $new_m2m_tag=new OpTagHasOpOpinableContent();
      			  $new_m2m_tag->setTagId($existing_tag->getId());
      			  $new_m2m_tag->setOpinableContentId($this->content_id);
      			  $new_m2m_tag->setUserId(sfContext::getInstance()->getUser()->getSubscriberId());
      			  $new_m2m_tag->save();
            }
          }  	
        }
        else
        {
          if (myTag::normalize($tag) != '')
          {  
            //il tag non esiste
            $new_tag=new OpTag();
            $new_tag->setTag($tag);
            $new_tag->setNormalizedTag(myTag::normalize($tag));
            $new_tag->save();

            $new_m2m_tag=new OpTagHasOpOpinableContent();
            $new_m2m_tag->setTagId($new_tag->getId());
            $new_m2m_tag->setOpinableContentId($this->content_id);
            $new_m2m_tag->setUserId(sfContext::getInstance()->getUser()->getSubscriberId());
            $new_m2m_tag->save();
          }
        }					
      }
    }
  }

  public function executeDelTags()
  {
    $this->content_id = $this->getRequestParameter('content_id');
    $this->content = OpContentPeer::getRealContent($this->content_id);
    $cont = $this->getRequestParameter('cont');

    for($i=0; $i<$cont; $i++)
    {
      if($this->getRequestParameter('tag_'.$i))
      {
        $c=new Criteria();
        $c->Add(OpTagHasOpOpinableContentPeer::TAG_ID, $this->getRequestParameter('tag_'.$i));
        $c->Add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID,$this->content_id);
        $related_tag=OpTagHasOpOpinableContentPeer::doSelectOne($c);
        $related_tag->delete();
      }
    }
    $this->setTemplate('addTag');		
  }	

  
}
