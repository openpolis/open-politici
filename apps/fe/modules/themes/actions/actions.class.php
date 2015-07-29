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
 * themes actions.
 *
 * @package    openpolis
 * @subpackage themes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class themesActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->redirect('@themes_list?sort=vsq08');
  }
  
  public function executeShow()
  {
    $this->theme = OpThemePeer::retrieveByPK($this->getRequestParameter('theme_id'));
    $this->response->setTitle(Text::shorten($this->theme->getTitle(), 100).' | posizioni | openpolis');
  }
  
  public function executeList()
  {
    $this->response->setTitle('posizioni | openpolis');
    $this->sort = $this->getRequestParameter('sort', 'random');
    $this->area = $this->getRequestParameter('area', 'x');
    $this->page = $this->getRequestParameter('page', 1);
  }
  
  public function executeThemesList()
  {
    $this->sort = $this->getRequestParameter('sort', 'random');
    $this->area = $this->getRequestParameter('area', 'x');
    $this->page = $this->getRequestParameter('page', 1);
  }
  
  public function executeCreate()
  {
    $this->mode = $this->getRequestParameter('mode');
    $this->theme = new OpTheme();

    // costruisce l'array associativo di aree tematiche per la select (edit)
    $areas = sfConfig::get('app_area_for_theme'); 
    $selectables[''] = "== Seleziona un'area ==";
    foreach ($areas as $a){
      $selectables[myTag::normalize($a)] = $a;
    }
    $this->selectable_areas = $selectables;

    $this->setTemplate('edit');
  }


  public function executeObscure()
  {
    $this->theme_id = $this->getRequestParameter('theme_id');
  }	

  public function executeDelete()
  {
    $theme = OpThemePeer::retrieveByPk($this->getRequestParameter('content_id'));
    $this->forward404Unless($theme instanceof OpTheme);

    //settaggio del campo deleted at di open content
    $open_content=OpOpenContentPeer::RetrieveByPk($this->getRequestParameter('content_id'));
    $open_content->setDeletedAt(time());
    $open_content->save();

    //inserimento nella tabella obscured content
    $obscured_content = new OpObscuredContent();
    $obscured_content->setUserId($this->getRequestParameter('user_id'));
    $obscured_content->setContentId($this->getRequestParameter('content_id'));
    $obscured_content->setReason($this->getRequestParameter('reason'));
    $obscured_content->save();

    // rimozione del tema dall'indice testuale
    $iMan = new OpIndexManager();
    $iMan->removeDocument($theme);
    $iMan->commit();
    unset($iMan);


    // aggiornamento dela cache info utente op_user.last_contribution e op_user.themes
    $user = OpUserPeer::retrieveByPK($this->getRequestParameter('user_id'));
    $user->updateLastContribution();
    $user->setThemes($user->countThemes());
    $user->save();
    
    // oscuramento dei tag associati
    $c = new Criteria();
    $c->Add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $theme->getContentId(), Criteria::EQUAL);
    $tags = OpTagHasOpOpinableContentPeer::doSelect($c);
    foreach($tags as $tag)
    {	
      $tag->setIsObscured(1);
      $tag->save();
    }			
		
    //invio email di notifica
  	$raw_email = $this->sendEmail('mail', 'sendThemeObscurationNotification');  

    return $this->redirect('@themes_list');
    
  }

  public function executeEdit()
  {
    $this->mode = $this->getRequestParameter('mode', '');
    $this->theme = OpThemePeer::retrieveByPk($this->getRequestParameter('content_id'));
    $this->forward404Unless($this->theme instanceof OpTheme);

    // costruisce l'array associativo di aree tematiche per la select (edit)
    $areas = sfConfig::get('app_area_for_theme'); 
    $selectables[''] = "== Seleziona un'area ==";
    foreach ($areas as $a){
      $selectables[myTag::normalize($a)] = $a;
    }
    $this->selectable_areas = $selectables;


    // determina l'area tematica (primo tag del tema, obbligatoria)
    $this->tags = $this->theme->getTags();
    if (count($this->tags))
      $this->area_tematica = $this->tags[0]->getOpTag()->getNormalizedTag();

  }
  
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('content_id'))
      $theme = new OpTheme();
    else
    {
      $theme = OpThemePeer::retrieveByPk($this->getRequestParameter('content_id'));
      $this->forward404Unless($theme);
    }

    $theme->setTitle(strip_tags($this->getRequestParameter('title')));
    $theme->setDescription(strip_tags($this->getRequestParameter('description'), "<b><i><ul><li><br><a><hr><p><h2><h3><h4>"));
    $theme->save();
		
		// aggiunta della location per il tema
		$locationIDs = $theme->getLocationIDs();
		if ($this->hasRequestParameter('location_id'))
		{
		  $loc = OpLocationPeer::retrieveByPK($this->getRequestParameter('location_id'));
		} else {
		  // default Italia
		  $c = new Criteria();
		  $c->add(OpLocationPeer::NAME, 'Italia');
		  $loc = OpLocationPeer::doSelectOne($c);
		}
		if (!in_array($loc->getId(), $locationIDs))
	  {
  		$theme_loc = new OpThemeHasLocation();
  		$theme_loc->setOpTheme($theme);
  		$theme_loc->setOpLocation($loc);
  		$theme_loc->save();	    
	  }
		
		// gestione dell'area tematica
    if($this->hasRequestParameter('tags'))
    {      
      $new_tag = $this->getRequestParameter('tags');
      $new_normalized_tag = myTag::normalize($new_tag);
		  
		  // cerca il tag in OpTag, se non esiste lo crea
      $c = new Criteria();
      $c->add(OpTagPeer::NORMALIZED_TAG, $new_normalized_tag, Criteria::EQUAL);
      $tag = OpTagPeer::doSelectOne($c);
      unset($c);         
      if (!$tag instanceof OpTag)
      {
        //il tag non esiste, crealo
        $tag = new OpTag();
        $tag->setTag($new_tag);
        $tag->setNormalizedTag($new_normalized_tag);
        $tag->save();        
      } else {
        //il tag esiste, aggiornalo (tiene conto delle ultime associazioni)
  			$tag->setUpdatedAt(time());
  			$tag->save();        
      }   

      // rimuove i tag associati al tema
			$c = new Criteria();
      $c->add(OpTagHasOpOpinableContentPeer::OPINABLE_CONTENT_ID, $theme->getContentId());
      $associated_tags = OpTagHasOpOpinableContentPeer::doSelect($c);
      foreach ($associated_tags as $associated_tag)
        $associated_tag->delete();
      unset($c);
      
      // associa il nuovo tag
		  $new_associated_tag= new OpTagHasOpOpinableContent();
		  $new_associated_tag->setTagId($tag->getId());
		  $new_associated_tag->setOpinableContentId($theme->getContentId());
		  $new_associated_tag->setUserId(sfContext::getInstance()->getUser()->getSubscriberId());
		  $new_associated_tag->save();      
      unset($new_associated_tag);
      unset($tag);
    }      
    
    if (!$this->getRequestParameter('content_id'))
      $this->redirect('@spread_new_theme?theme_id=' . $theme->getContentId());
    
    return $this->redirect('@themes_list');
  }

  public function handleErrorUpdate()
  {
    
    if($this->getRequestParameter('content_id'))
    {
      $this->theme = OpThemePeer::retrieveByPk($this->getRequestParameter('content_id'));
      
      // determina l'area tematica (primo tag del tema, obbligatoria)
      $this->tags = $this->theme->getTags();
      if (count($this->tags))
        $this->area_tematica = $this->tags[0]->getOpTag()->getNormalizedTag();      
    }
    else
      $this->theme = new OpTheme();

    // costruisce l'array associativo di aree tematiche per la select (edit)
    $areas = sfConfig::get('app_area_for_theme'); 
    $selectables[''] = "== Seleziona un'area ==";
    foreach ($areas as $a){
      $selectables[myTag::normalize($a)] = $a;
    }
    $this->selectable_areas = $selectables;
    
    $this->mode = 'add';

    $this->setTemplate('edit');
    return sfView::SUCCESS;
  }

  /**
   * pagina per diffondere i nuovi temi agli amici
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeSpreadNewTheme()
  {
    $this->theme_id = $this->getRequestParameter('theme_id');
    $this->theme = OpThemePeer::retrieveByPk($this->theme_id);    
  }

  /**
   * Validazione custom per l'azione sendNewTheme
   * controlla il formato delle email nella textarea
   * questo metodo è invocato prima che venga parsato validate/sendNewTheme.yml
   */
  public function validateSendNewTheme()
  {
  	$mail_amici = $this->getRequestParameter('mail_amici');
  	$mails = preg_split("/[\s,]+/", $mail_amici);

  	// il pattern per la verifica di un indirizzo e-mail
  	// /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/i

  	// controllo mail non valide
  	$invalid_mails = array();
  	foreach ($mails as $mail) {
  		if (!self::_is_valid_email_address($mail))
  		  array_push($invalid_mails, $mail); 
  	}
	
  	if (trim($mail_amici) == "")
  	{
  		$this->getRequest()->setError('mail_amici',
  		                              "Inserisci almeno un indirizzo");
  		return false;
  	}
  	if (count($invalid_mails)) 
  	{
  		$this->getRequest()->setError('mail_amici',
  		                              "Questi indirizzi non sono validi: " . implode(",", $invalid_mails));
  		return false;
  	}

  	// genera l'errore da mostrare, se ci sono più di max_spread_mails indirizzi
  	$max_mails = sfConfig::get('app_max_spread_mails');
  	if (count($mails) > $max_mails) {
  		$this->getRequest()->setError('mail_amici',"Puoi inviare fino a $max_mails e-mail per volta");
  		return false;
  	}

  	// se tutto va liscio ritorna true e prosegui
    return true;
  }

  /**
   * invio della mail, log e redirect alla pagina di successo
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeSendNewTheme()
  {

   	$this->theme_id = $this->getRequestParameter('theme_id');
   	$mail_amici = $this->getRequestParameter('mail_amici');
  	$this->friends = preg_split("/[\s,]+/", $mail_amici);

    // send the email
    $raw_email = $this->sendEmail('mail', 'sendNewThemeNotification');  

    // log the email
    $this->logMessage($raw_email, 'debug');
    
  }
  
  public function handleErrorSendNewTheme()
  {    
    $this->theme_id = $this->getRequestParameter('theme_id');
    $this->theme = OpThemePeer::retrieveByPk($this->theme_id);    

    $this->setTemplate('spreadNewTheme');
    return sfView::SUCCESS;
  }

  /* funzioni private */
  private static function _is_valid_email_address($email){
    $qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
    $dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
    $atom = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c'.
       '\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
    $quoted_pair = '\\x5c\\x00-\\x7f';
    $domain_literal = "\\x5b($dtext|$quoted_pair)*\\x5d";
    $quoted_string = "\\x22($qtext|$quoted_pair)*\\x22";
    $domain_ref = $atom;
    $sub_domain = "($domain_ref|$domain_literal)";
    $word = "($atom|$quoted_string)";
    $domain = "$sub_domain(\\x2e$sub_domain)*";
    $local_part = "$word(\\x2e$word)*";
    $addr_spec = "$local_part\\x40$domain";
    return preg_match("!^$addr_spec$!", $email) ? 1 : 0;
  }
  
  
  /**
   * genera la pagina per aggiungere un'associazione tra dichiarazione e tema
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeAddDeclarationForTheme()
  {
    $this->theme_id = $this->getRequestParameter('theme_id');
    $this->theme = OpThemePeer::retrieveByPk($this->theme_id);
    
    // memorizza l'id del tema in una variabile di sessione
    $this->getUser()->setAttribute('theme_id', $this->theme_id);  
  }

  /**
   * crea l'associazione nel modello e redireziona alla pagina del tema
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeAddedDeclarationForTheme()
  {
    if($this->hasRequestParameter('theme_id') && 
       $this->hasRequestParameter('declaration_id') &&
       $this->hasRequestParameter('position'))
    {
      $theme_id = $this->getRequestParameter('theme_id');
      $declaration_id = $this->getRequestParameter('declaration_id');      
    } else {
      $this->forward404();
    }
        
    // salvataggio dei valori nel DB
    // uso direttamente gli ID perché subito dopo c'è il redirect)
    $association = new OpThemeHasDeclaration();
    $association->setThemeId($theme_id);
    $association->setDeclarationId($declaration_id);
    $association->setPosition($this->getRequestParameter('position'));
    $association->save();
    
    // redirect alla pagina del tema
    $this->redirect('@tema?theme_id=' . $theme_id);
  }

  /**
   * rimuove l'associazione dal modello e redireziona alla pagina del tema
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeRemoveDeclarationForTheme()
  {
    // qui vengono preparati i dati per il template
    // $this->_prepareDataEditDeclarationForTheme();

    $this->theme_id = $this->getRequestParameter('theme_id');
    $this->declaration_id = $this->getRequestParameter('declaration_id');      
    $this->association = OpThemeHasDeclarationPeer::retrieveByPK($this->declaration_id, $this->theme_id);

    $this->forward404Unless($this->association instanceof OpThemeHasDeclaration);
    
    $this->association->delete();
    
    return $this->redirect('@tema?theme_id='.$this->theme_id);
  }  
  
    
}
