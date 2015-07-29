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

/**
 * polDeclarations actions.
 *
 * @package    openpolis
 * @subpackage polDeclarations
 * @author     Gianluca Canale
 * @version    SVN: $Id: actions.class.php 1814 2006-08-24 12:20:11Z fabien $
 */
class polDeclarationsActions extends sfActions
{
  /**
   * elenco di tutte le dichiarazioni paginato
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeDeclarationsList()
  {
  }

  /**
   * elenco delle ultime n dichiarazioni
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeLastDeclarations()
  {
    $this->response->setTitle('Le ultime dichiarazioni dei politici italiani | openpolis');
    $this->response->addMeta('description','Lista delle ultime dichiarazioni dei politici italiani',true);
	$this->amount = $this->getRequestParameter('amount');
  }
  
  /**************************************/
  public function executeCreate()
  {
    $this->hasLayout = $this->getRequestParameter('has_layout');
    if ($this->hasRequestParameter('theme_id'))
    {
      $this->theme_id = $this->getRequestParameter('theme_id');
      $this->theme = OpThemePeer::retrieveByPk($this->getRequestParameter('theme_id'));      
    }

    if ($this->hasRequestParameter('politician_id'))
    {
      $this->politician_id = $this->getRequestParameter('politician_id');
      if($this->hasLayout == 'true')
        $this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));
    }
 
    // costruisce l'array associativo per le posizioni
    $positions = sfConfig::get('app_position_on_theme'); 
    $selectables[''] = "== Seleziona una posizione ==";
    foreach ($positions as $i => $pos){
      $selectables[$i] = $pos;
    }
    $this->selectable_positions = $selectables;
    
    $this->mode = $this->getRequestParameter('mode');
    $this->declaration = new OpDeclaration();

    $this->setTemplate('edit');
  }
	
  /**************************************/
  public function executeEdit()
  {
    //$this->setLayout('noColumnLayout');
    
    $this->hasLayout = $this->getRequestParameter('has_layout');
    $this->mode = $this->getRequestParameter('mode', '');
    $this->declaration = OpDeclarationPeer::retrieveByPk($this->getRequestParameter('content_id'));

    $this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));
    $this->politician_id=$this->politician->getContentId();

    $this->forward404Unless($this->declaration);
    //$this->setLayout('politiciansLayout');
  }
  
  /**********************************************/
  public function executeAddFromBookmarklet()
  {
    $this->setLayout(true);
    $this->setLayout('bookmarkletLayout');
    $this->hasLayout = $this->getRequestParameter('has_layout');
    
    
    
    if ($this->hasRequestParameter('theme_id'))
    {
      $this->theme_id = $this->getRequestParameter('theme_id');
      $this->theme = OpThemePeer::retrieveByPk($this->getRequestParameter('theme_id'));      
    }

    if ($this->hasRequestParameter('politician_id'))
    {
      $this->politician_id = $this->getRequestParameter('politician_id');
      if($this->hasLayout == 'true')
        $this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));
    }
 
    
    $this->mode = 'add';
    $this->declaration = new OpDeclaration();
    
    // Prendi i valori di input
    
    $this->titolo=$this->getRequestParameter('t');
    if (substr_count($this->titolo,"-")>0)
    {
      $titolo=explode("-",$this->titolo);
      $tit="";
      for ($x=0;$x<count($titolo)-1;$x++)
      {
        $tit=$tit.$titolo[$x];
      }
      $this->titolo=$tit;
    }
    
     if (substr_count($this->titolo,"|")>0)
      {
        $titolo=explode("|",$this->titolo);
        $tit="";
        for ($x=0;$x<count($titolo)-1;$x++)
        {
          $tit=$tit.$titolo[$x];
        }
        $this->titolo=$tit;
      }
    
    $this->testo=$this->getRequestParameter('s');
    $this->link=$this->getRequestParameter('u');
    $this->fonte=$this->getRequestParameter('h');

    $this->setTemplate('addFromBookmarklet');
    
  }
  
  public function executeBookmarkletClose()
  {
    if ($this->getRequestParameter('declaration_id'))
      $this->declaration_id=$this->getRequestParameter('declaration_id');
    else
      $this->declaration_id=0;
      
    $this->setLayout('bookmarkletLayout');
  }  
  
  /**************************************/
  
  public function executeUpdate()
  {
    $this->hasLayout = $this->getRequestParameter('has_layout');
    if (!$this->getRequestParameter('content_id'))
    {
      $declaration = new OpDeclaration();
      $declaration->setPoliticianId($this->getRequestParameter('politician_id'));
    }
    else
    {
      $declaration = OpDeclarationPeer::retrieveByPk($this->getRequestParameter('content_id'));
      $this->forward404Unless($declaration);
    }
    
      

    $declaration->setTitle(strip_tags($this->getRequestParameter('title')));
    $declaration->setText(strip_tags($this->getRequestParameter('text'), "<b><i><ul><li><br><a><hr><p><h2><h3><h4>"));
    list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('date'), $this->getUser()->getCulture());
    $declaration->setDate("$y-$m-$d");
    $declaration->setSourceName(strip_tags($this->getRequestParameter('source_name')));
    if ($this->getRequestParameter('remove'))
    {
      $declaration->setSourceMime(NULL);
      $declaration->setSourceSize(NULL);
      $declaration->setSourceFile(NULL);
    }	
    $filename = $this->getRequest()->getFileName('source_attach');
    if($filename != '')
    {
      $declaration->setSourceMime($this->getRequest()->getFileType('source_attach'));
      $declaration->setSourceSize($this->getRequest()->getFileSize('source_attach'));
      $file = new Blob();
      $file->readFromFile($_FILES['source_attach']['tmp_name']);
      $declaration->setSourceFile($file);
    }

    if($this->getRequestParameter('source_url'))
    {
      $declaration->setSourceUrl(strip_tags($this->getRequestParameter('source_url')));
    }

    $declaration->save();
		
		
		// gestione dei tag (solo per la fase di add)
    if($this->hasRequestParameter('tags'))
    {
      $tags = strip_tags($this->getRequestParameter('tags',''));
      if (strlen($tags)!=0)
      {
        $tags=split(',',$this->getRequestParameter('tags'));
        foreach($tags as $tag)
        {
          $tag = trim(strip_tags($tag));
		  
		      //controllo se il tag gia esiste
          $normalized_tag = myTag::normalize($tag);
          $c = new Criteria();
          $c->Add(OpTagPeer::NORMALIZED_TAG, $normalized_tag, Criteria::EQUAL);
          $existing_tag=OpTagPeer::DoSelectOne($c);
          
		      if($existing_tag)
          {
            //il tag esiste:
            //aggiorno il campo update_at del tag
      			$existing_tag->setUpdatedAt(time());
      			$existing_tag->save();
					
      			//controllo se è gia associato alla dichiarazione
      			$c1=new Criteria();
            $c1->Add(OpTagHasOpOpinableContentPeer::TAG_ID,$existing_tag->getId());
            $c1->Add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID,$declaration->getContentId());
            $m2m_tag = OpTagHasOpOpinableContentPeer::doSelectOne($c1);

            if(!$m2m_tag)
            {
              //il tag esiste e non è associato alla dichiarazione
      			  $new_m2m_tag=new OpTagHasOpOpinableContent();
      			  $new_m2m_tag->setTagId($existing_tag->getId());
      			  $new_m2m_tag->setOpinableContentId($declaration->getContentId());
      			  $new_m2m_tag->setUserId(sfContext::getInstance()->getUser()->getSubscriberId());
      			  $new_m2m_tag->save();
			      }
          }
          else
          {
            //il tag non esiste
            $new_tag = new OpTag();
            $new_tag->setTag($tag);
            $new_tag->setNormalizedTag(myTag::normalize($tag));
            $new_tag->save();

            $new_m2m_tag = new OpTagHasOpOpinableContent();
            $new_m2m_tag->setTagId($new_tag->getId());
            $new_m2m_tag->setOpinableContentId($declaration->getContentId());
            $new_m2m_tag->setUserId(sfContext::getInstance()->getUser()->getSubscriberId());
            $new_m2m_tag->save();
          }
        }
      }
    }
    
    // eventuale associazione con un tema
    if ($this->getRequestParameter('theme_id'))
    {
      $association = new OpThemeHasDeclaration();
      $association->setThemeId($this->getRequestParameter('theme_id'));
      $association->setDeclarationId($declaration->getContentId());
      $association->setPosition($this->getRequestParameter('position', 0) - 4);
      $association->save();      
    }
      
    // redirect
    if ($this->getRequestParameter('theme_id'))
      return $this->redirect("@tema?theme_id=".$this->getRequestParameter('theme_id'));
    else
    {
      if ($this->getRequestParameter('bookmarklet'))
        return $this->redirect('/polDeclarations/bookmarkletClose?declaration_id='.$declaration->getContentId());
      else
        return $this->redirect('@dichiarazione?declaration_id='.$declaration->getContentId());
    }
  }

 
  
  /*************************************/
  public function handleErrorUpdate()
  {
    if($this->getRequestParameter('content_id'))
      $this->declaration = OpDeclarationPeer::retrieveByPk($this->getRequestParameter('content_id'));
    else
      $this->declaration = new OpDeclaration();

    if ($this->hasRequestParameter('theme_id'))
    {
      $this->theme_id = $this->getRequestParameter('theme_id');
      $this->theme = OpThemePeer::retrieveByPk($this->getRequestParameter('theme_id'));
      $position = $this->getRequestParameter('position');     
      
      // costruisce l'array associativo per le posizioni
      $positions = sfConfig::get('app_position_on_theme'); 
      $selectables[''] = "== Seleziona una posizione ==";
      foreach ($positions as $i => $pos){
        $selectables[$i] = $pos;
      }
      $this->selectable_positions = $selectables;
      
    }

    if ($this->hasRequestParameter('politician_id') || $this->getRequestParameter('bookmarklet'))
    {
      $this->politician_id = $this->getRequestParameter('politician_id');
      if($this->hasLayout == 'true')
        $this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));
    }
    
    $this->hasLayout = 'true';
    $this->mode = 'add';
    
    if ($this->getRequestParameter('bookmarklet'))
    {
        $this->setTemplate('addFromBookmarklet');
        $this->setLayout('bookmarkletLayout');
        $this->bookmarklet=1;
    }
    else
    {
      $this->setTemplate('edit');
      $this->setLayout('politiciansLayout');
    }  

    return sfView::SUCCESS;
  }
  
  /*************************************/
  
  public function executeObscureDeclaration()
  {
    $this->declaration_id = $this->getRequestParameter('declaration_id');
  }	
  
  /**************************************/
  public function executeDelete()
  {
    $declaration = OpDeclarationPeer::retrieveByPk($this->getRequestParameter('content_id'));
    $this->forward404Unless($declaration);

    //settaggio del campo deleted at di open content
    $open_content=OpOpenContentPeer::retrieveByPk($this->getRequestParameter('content_id'));
    $open_content->setDeletedAt(time());
    $open_content->save();

    //inserimento nella tabella obscured content
    $obscured_content = new OpObscuredContent();
    $obscured_content->setUserId($this->getRequestParameter('user_id'));
    $obscured_content->setContentId($this->getRequestParameter('content_id'));
    $obscured_content->setReason($this->getRequestParameter('reason'));
    $obscured_content->save();

    // rimozione della dichiarazione dall'indice testuale
    $iMan = new OpIndexManager();
    $iMan->removeDocument($declaration);
    $iMan->commit();
    unset($iMan);

    //oscuramento dei tag associati
    $c = new Criteria();
    $c->Add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $declaration->getContentId(), Criteria::EQUAL);
    $tags = OpTagHasOpOpinableContentPeer::doSelect($c);

    // eventuale aggiornamento della cache info utente op_user.last_contribution e op_user.declarations
    $user = OpUserPeer::retrieveByPK($this->getRequestParameter('user_id'));
    $user->updateLastContribution();
    $user->setDeclarations($user->countDeclarations());
    $user->save();

    foreach($tags as $tag)
    {	
      $tag->setIsObscured(1);
      $tag->save();
    }			
		
    //invio email di notifica
  	$raw_email = $this->sendEmail('mail', 'sendObscurationNotification');  

    //invio messaggistica
    //TODO
    //return $this->redirect('politician/page?content_id='.$declaration->getPoliticianId());
    return $this->redirect('@politico_new?content_id='.$declaration->getPoliticianId().'&slug='. $declaration->getOpPolitician()->getSlug() );
  }

  /**************************************/
  public function executeShowdeclarations()
  {
    $this->hasLayout = $this->getRequestParameter('has_layout');
    $this->op_politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('content_id'));
    $this->forward404Unless($this->op_politician);
    $this->declarations = $this->op_politician->getOpDeclarations();
  }

  /**************************************/
  public function executeAddTags()
  {
    $this->content_id=$this->getRequestParameter('content_id');
    $this->declaration = OpDeclarationPeer::retrieveByPk($this->getRequestParameter('content_id'));
    $this->politician = OpPoliticianPeer::retrieveByPk($this->getRequestParameter('politician_id'));
    $this->setLayout('politiciansLayout');
  }

  /**************************************/
  public function executeIndex()
  {	
	$id = $this->getRequestParameter('declaration_id');
	
    $this->declaration=OpDeclarationPeer::retrieveByPk($this->getRequestParameter('declaration_id'));
    $this->forward404Unless($this->declaration);
	
	  $this->response->setTitle(ucwords(strtolower($this->declaration->getOpPolitician()->getFirstName())).' '.$this->declaration->getOpPolitician()->getLastName().": ".Text::shorten($this->declaration->getTitle(), 100).' | openpolis');
    
    // preparazione parametri per bottone facebbok
    $this->response->addMeta('description',str_replace(array("\n","\t","\r"),"",strip_tags($this->declaration->getDeclarationAbstract())));
    $this->response->addMeta ('link','cccc');
    if ($this->declaration->getOpPolitician()->getPicture())
    {
      $immagine = imagecreatefromstring($this->declaration->getOpPolitician()->getPicture());
			$width=imagesx($immagine);
			$this->image_src='http://www.openpolis.it/politician/picture?content_id='.$this->declaration->getOpPolitician()->getContentId();
  	}
  	else
  	  $this->image_src='http://www.openpolis.it/images/openpolis-logo-small-white.jpg';
  	  
  	// preparazione parametri per bottone twitter
  	$title_twitter=ucwords(strtolower($this->declaration->getOpPolitician()->getFirstName())).' '.$this->declaration->getOpPolitician()->getLastName().": ".str_replace(array('"'),'',$this->declaration->getTitle());
	$declarationUrl = 'dichiarazione/'. implode('/', $this->declaration->getSlugArray() ) .'/';
	$lunghezza=strlen($title_twitter." www.openpolis.it/dichiarazione/".$this->declaration->getContentId());
  	
  	if ($lunghezza >140)
  	  $this->twitter=Text::shorten($title_twitter, 140 - strlen(" ".$declarationUrl)).$declarationUrl;
  	else
  	  $this->twitter=$title_twitter." ".$declarationUrl;
  	    
  }

  /**************************************/
  public function executeAttachment()
  {
    $declaration=OpDeclarationPeer::retrieveByPk($this->getRequestParameter('declaration_id'));
    $this->getResponse()->addHttpMeta('content-type',$declaration->getSourceMime());
    $this->getResponse()->addHttpMeta('content-disposition','attachment');
    $this->getResponse()->addHttpMeta('content-length', $declaration->getSourceSize());
    $this->getResponse()->addHttpMeta('filename','allegato');
    $this->attachment = $declaration->getSourceFile();
    $this->forward404Unless($declaration);
  }

  /**************************************/
  public function executeReportForm()
  {
    $this->user_id=$this->getRequestParameter('user_id');
    $this->comment_id=$this->getRequestParameter('comment_id');
    $this->comment=OpCommentPeer::RetrieveByPk($this->comment_id);

    $this->report=OpCommentReportPeer::RetrieveByPk($this->user_id, $this->comment_id);
    $this->notes='';
    $this->report_type='';

    if($this->report)
    { 
      $this->notes=$this->report->getNotes();
      $this->report_type=$this->report->getReportType();
    }
    //$this->setLayout('politiciansLayout');		
  }
	
  /**************************************/
  public function executeReport()
  {
    $user_id=$this->getRequestParameter('user_id');
    $comment_id=$this->getRequestParameter('comment_id');
    $notes=$this->getRequestParameter('notes');
    $comment=OpCommentPeer::RetrieveByPk($comment_id);

    switch($this->getRequestParameter('report_type'))
    {
      case '2': 
        $report_type='o';
        break;
      case '3': 
        $report_type='s';
        break;	
      default:
        $report_type='e';	
        break; 
    }

    //verifico se l'utente ha già inviato il report in precedenza
    $this->report=OpCommentReportPeer::RetrieveByPk($user_id, $comment_id);
    if(!$this->report)
    {
      //creazione report
      $this->report=new OpCommentReport();
      $this->report->setUserId($user_id);
      $this->report->setCommentId($comment_id);
    }

    $this->report->setReportType($report_type);
    $this->report->setNotes($notes);
    $this->report->save();
    return $this->redirect('polDeclarations/index?declaration_id='.$comment->getContentId());
  }

  public function executeBlockForPoliticianPage()
  {
    $this->politician_id = $this->getRequestParameter('politician_id');
  	$this->sort = $this->getRequestParameter('sort');
  	$this->limit = $this->getRequestParameter('limit');
  	$this->total = $this->getRequestParameter('total');	
  }
  
  public function executeBlockForArgumentPage()
  {
    $this->politician_id = $this->getRequestParameter('politician_id');
  	$this->tag_id = $this->getRequestParameter('tag_id');
  	$this->sort = $this->getRequestParameter('sort');
  	$this->limit = $this->getRequestParameter('limit');
  	$this->total = $this->getRequestParameter('total');		
  }

  public function executeBlockForThemePage()
  {
  	$this->theme_id = $this->getRequestParameter('theme_id');
  	$this->sort = $this->getRequestParameter('sort');
  }
  
    
  public function executeSelectableList()
  {
  }
  
  
		
}
?>