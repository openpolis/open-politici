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
 * user actions.
 *
 * @package    openpolis
 * @subpackage user
 * @author     Guglielmo Celata
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class userActions extends sfActions
{

  /**
   * mostra la pagina dell'utente
   * se è stato passato l'hash,
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeShow()
  {
		if ($this->hasRequestParameter('hash'))
	  	$this->subscriber = OpUserPeer::getUserFromHash($this->getRequestParameter('hash'));
		else
	  	$this->subscriber = $this->getUser()->getSubscriber();
	
		$this->forward404Unless($this->subscriber);

	  $this->hash = $this->getRequestParameter('hash');
		$this->setShowVars();
		
		$fullname = $this->subscriber->getPublicName() ? 
			$this->subscriber->getFirstName().' '.$this->subscriber->getLastName() : 				
			$this->subscriber->getNickname() ;
		
		$this->response->setTitle( 'Pagina personale di '. $fullname." | comunita' | openpolis");
		$this->response->addMeta('description', 'La descrizione e le informazioni inserite da '. $fullname );

  }

  public function executeUpdate()
  {
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
		  	$this->forward404();
		}

		$this->subscriber = $this->getUser()->getSubscriber();
		$this->forward404Unless($this->subscriber);

		$this->updateUserFromRequest();

		// password update
		if ($this->getRequestParameter('password'))
		{
		  	$this->subscriber->setPassword($this->getRequestParameter('password'));
		}

		$this->subscriber->save();

		$this->redirect('@user_profile?hash='.$this->subscriber->getHash());
  }



  /**
   * Executes secure action
   *
   */
  public function executeSecure()
  {
  }

  public function handleErrorLogin()
  {
	  return sfView::SUCCESS;
  }

  /**
   * esegue l'aggiunta di un requiring user
   *
   * @return void
   * @author Guglielmo
   * @deprecated
   **/
  public function executeAddRequiring()
  {
		// process only POST requests
		if ($this->getRequest()->getMethod() == sfRequest::POST)
		{
		  $this->user = new OpRequiringUser();
		  $this->user->setEmail($this->getRequestParameter('prenota_email'));
		  if ($this->getRequestParameter('beta') == 1)
		    $this->user->setBeta(1);
		  $this->user->save();
			return $this->redirect('@added_requiring_user');

		} else {

      // non c'è una pagina dedicata (il form è quello di login)
			return sfView::SUCCESS;

		}

 	}

  public function handleErrorAddRequiring()
  {
    return sfView::SUCCESS;
  }

 	/**
 	 * mostra il messaggio di feedback che la mail è stata registrata
 	 *
 	 * @return void
 	 * @author Guglielmo
   * @deprecated
 	 **/
 	public function executeAddedRequiring()
 	{

 	}


  /**
   * Executes logout action
   *
   */
  public function executeLogout()
  {
		$this->getUser()->signOut();
		$this->redirect('@homepage');
  }

  /**
   * Executes password_request action
   * @deprecated
   *
   */
  public function executePasswordRequest()
  {
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
		  	// display the form
		  	return sfView::SUCCESS;
		}

		// handle the form submission
		$this->email = $this->getRequestParameter('email');
		$c = new Criteria();
		$c->add(OpUserPeer::EMAIL, $this->email);
		$user = OpUserPeer::doSelectOne($c);

		// email exists?
		if ($user instanceof OpUser && $user->getIsActive() == 1)
		{
			  // set new random password
			  $password = substr(md5(rand(100000, 999999)), 0, 6);
			  $user->setPassword($password);

			  $this->getRequest()->setAttribute('password', $password);
			  $this->getRequest()->setAttribute('nickname', $user->getNickname());

			  $raw_email = $this->sendEmail('mail', 'sendPassword');

			  // save new password
			  $user->save();

			  return 'MailSent';
		}
		else
		{
		    if ($user instanceof OpUser && $user->getIsActive() == 1)
		      $this->getRequest()->setError('email', "Non posso inviare una nuova password in quanto non hai ancora attivato la tua registrazione. <br />Ti dovrebbe essere pervenuta una mail con delle semplici istruzioni per l'attivazione. <br />Se non l'hai ricevuta scrivi a <strong>info@openpolis.it</strong>");
			  else
		  	  $this->getRequest()->setError('email', 'Non esiste un utente di openpolis registrato con questa e-mail. Riprova.');

		  	return sfView::SUCCESS;
		}
  }

 	/**
 	 * mostra il messaggio di feedback della registrazione
 	 *
 	 * @return void
 	 * @author Guglielmo
   * @deprecated
 	 **/
 	public function executeAdded()
 	{
 	  $reg_user_id = $this->getUser()->getAttribute('user_id', 0);
 	  if ($reg_user_id == 0)
 	    $this->redirect('@home');

    $this->user = OpUserPeer::retrieveByPK($reg_user_id);

 	}

  /**
   * validazione custom per il nickname, in caso di nome e cognome non pubblici
   *
   * @return boolean - se il form è validato o meno
   * @author Guglielmo Celata
   * @deprecated
   **/
  public function validateAdd()
  {
		if ($this->getRequest()->getMethod() == sfRequest::POST)
		{
      $public = $this->getRequestParameter('pubblico');
      $nickname = $this->getRequestParameter('nickname');
      if ($public != 1 && $nickname == "")
      {
        $this->getRequest()->setError('nickname', 'obbligatorio, se nome e cognome non pubblici');
        return false;
      }
    }
    
    return true;
  }

  /**
   * gestisce gli errori di validazione sul nickname
   *
   * @return void
   * @author Guglielmo Celata
   * @deprecated
   **/
  public function handleErrorAdd()
  {
    // $this->getRequest()->setError('nickname', $this->getRequest()->getError('nickname'));
  	return sfView::SUCCESS;
  }


  /**
   * registrazione nuovo utente
   *
   * @return void
   * @author Guglielmo Celata
   * @deprecated
   **/
  public function executeAdd()
  {
    // use of this page is dangerous
    $this->forward404();
    
		// process only POST requests
		if ($this->getRequest()->getMethod() == sfRequest::POST)
		{
		  $this->user = new OpUser();
		  if ($this->getRequestParameter('nickname') != '')
		    $this->user->setNickname($this->getRequestParameter('nickname'));
		  $this->user->setEmail($this->getRequestParameter('email'));
		  $this->user->setPassword($this->getRequestParameter('password'));
		  $this->user->setFirstName($this->getRequestParameter('firstname'));
		  $this->user->setLastName($this->getRequestParameter('lastname'));
		  if (!$this->hasRequestParameter('location_id') || $this->getRequestParameter('location_id') == '')
		  {
		    // a questo punto so che la location e' univoca
        $c = new Criteria();
        $c->add(OpLocationPeer::NAME, $this->getRequestParameter('location'));
        $c->add(OpLocationTypePeer::NAME, 'comune');
        $c->addJoin(OpLocationPeer::LOCATION_TYPE_ID, OpLocationTypePeer::ID);
        $location = OpLocationPeer::doSelectOne($c);
        $location_id = $location->getId();
		  } else
		    $location_id = $this->getRequestParameter('location_id');


		  $this->user->setLocationId($location_id);
		  if ($this->getRequestParameter('aggiornami') == 1)
		    $this->user->setWantNewsletter(1);
		  if ($this->getRequestParameter('pubblico') != 1)
		    $this->user->setPublicName(0);

		  $this->user->save();

		  $this->getUser()->setAttribute('user_id', $this->user->getId());

		  // send the email if in prod environment
		  if(SF_ENVIRONMENT != 'test')
		    $raw_email = $this->sendEmail('mail', 'sendRegistrationProcess');

		  $this->redirect('@added_user');
		}

  	return sfView::SUCCESS;
 	}


  /**
   * attivazione utente (da link mail)
   *
   * @return void
   * @author Guglielmo Celata
   * @deprecated
   **/
  public function executeAttivation()
  {

		$this->user_Sha1_Password = $this->getRequestParameter('hash');
		$c = new Criteria();
		$c->Add(OpUserPeer::SHA1_PASSWORD, $this->user_Sha1_Password);
		$this->user = OpUserPeer::doSelectOne($c);

		if (count($this->user) == 1 && $this->user->getIsActive() == 0)
		{
			$this->user->setCreatedAt(time());
			$this->user->Save();

			// send the email
			$this->getUser()->setAttribute('user_id', $this->user->getId());
			// $raw_email = $this->sendEmail('mail', 'sendAttivationProcess');

			$this->getRequest()->setAttribute('referer', $this->getRequest()->getReferer());
			$this->getContext()->getUser()->signIn($this->user);
		}
		else
		{
			$this->getContext()->getUser()->signOut();
			$this->redirect('@homepage');
		}

  }


  public function executeReportContent()
  {
    $this->content = OpContentPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->content);

	$con = Propel::getConnection(OpContentPeer::DATABASE_NAME);
	try {
		$con->begin();

	    $spam = new OpReport();
	    $spam->setContentId($this->content->getId());
	    $spam->setUserId($this->getUser()->getSubscriberId());
	    $spam->save();

	    $this->content->setReports($this->content->getReports() + 1);
	    $this->content->save();

		$con->commit();
	} catch (PropelException $e) {
		$con->rollback();
		throw $e;
	}

  }


  public function handleErrorPasswordRequest()
  {
    return sfView::SUCCESS;
  }

  public function handleErrorUpdate()
  {
    $this->subscriber = $this->getUser()->getSubscriber();
    $this->forward404Unless($this->subscriber);

    $this->updateUserFromRequest();
    $this->setShowVars();

    return array('user', 'showSuccess');
  }

 private function updateUserFromRequest()
  {
    $this->subscriber->setFirstName($this->getRequestParameter('first_name'));
    $this->subscriber->setLastName($this->getRequestParameter('last_name'));
    $this->subscriber->setEmail($this->getRequestParameter('email'));
    $this->subscriber->setHasPaypal($this->getRequestParameter('has_paypal'), 0);
    $this->subscriber->setWantToBeModerator($this->getRequestParameter('want_to_be_moderator'));
  }

  private function setShowVars()
  {
    sfLoader::loadHelpers('Date');

    $this->last_opencontent = $this->subscriber->getLastContribution();      
    if ($this->last_opencontent !== null) 
      $this->last_contribution = format_date($this->last_opencontent, 'dd MMMM yyyy');
    else
      $this->last_contribution = "mai";
    
  	$c = new Criteria();
  	$c->add(OpOpenContentPeer::USER_ID,$this->subscriber->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
    $n_opencontents = OpOpenContentPeer::doCount($c);
    
    $c = new Criteria();
    $c->add(OpCommentPeer::USER_ID, $this->subscriber->getId());
    $n_comments = OpCommentPeer::doCount($c);
    
    $this->n_contributions = $n_opencontents + $n_comments; 

  	$c = new Criteria();
  	$c->add(OpOpenContentPeer::USER_ID,$this->subscriber->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  	$this->n_institution_charges = OpInstitutionChargePeer::doCountJoinOpOpenContent($c);

  	$c = new Criteria();
  	$c->add(OpOpenContentPeer::USER_ID,$this->subscriber->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  	$this->n_political_charges = OpPoliticalChargePeer::doCountJoinOpOpenContent($c);

  	$c = new Criteria();
  	$c->add(OpOpenContentPeer::USER_ID,$this->subscriber->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, null, Criteria::ISNULL);
  	$this->n_organization_charges = OpOrganizationChargePeer::doCountJoinOpOpenContent($c);

    $c = new Criteria();
  	$c->add(OpOpenContentPeer::USER_ID, $this->subscriber->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
  	$c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
  	$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);
  	$c->setLimit(10);
  	$c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
  	$this->declarations = OpDeclarationPeer::doSelectJoinOpOpinableContent($c);

  	$c=new Criteria();
  	$c->add(OpCommentPeer::USER_ID, $this->subscriber->getId());
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
  	$c->addJoin(OpContentPeer::ID, OpOpenContentPeer::CONTENT_ID);
  	$c->addJoin(OpOpenContentPeer::CONTENT_ID, OpOpinableContentPeer::CONTENT_ID);
  	$c->setLimit(10);
  	$c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
  	$this->comments = OpCommentPeer::doSelectJoinOpOpinableContent($c);

  	$this->getResponse()->setTitle('OpenPolis - Profilo di '.$this->subscriber->__toString());
  }


  public function executeInterested()
  {
    $this->__vote_for_content();
  }
  
  public function executeVoteContent()
  {
    $this->__vote_for_content();
  }
  
  private function __vote_for_content()
  {
  	$this->opinableContent = OpOpinableContentPeer::retrieveByPk($this->getRequestParameter('id'));

	  $this->forward404Unless($this->opinableContent);

  	$this->getUser()->getSubscriber()->isInterestedIn($this->opinableContent);

	  switch ($this->opinableContent->getOpOpenContent()->getOpContent()->getOpTable())
	  {
	    case 'op_declaration':
	      $this->content = OpDeclarationPeer::RetrieveByPk($this->opinableContent->getContentId());
	      $this->label = "voti";
	      break;
	    case 'op_theme':
	      $this->content = OpThemePeer::RetrieveByPk($this->opinableContent->getContentId());
	      $this->label = "priorit&agrave;";
	      break;
	  }
  }

  public function executeVote()
  {
    	//$this->forward404Unless($this->comment);

    	$user = $this->getUser()->getSubscriber();

    	$op_relevancy_comment = new OpRelevancyComment();
    	$op_relevancy_comment->setCommentId($this->getRequestParameter('id'));
    	$op_relevancy_comment->setUserId(sfContext::getInstance()->getUser()->getSubscriberId());
    	$op_relevancy_comment->setScore($this->getRequestParameter('score') == 1 ? 1 : -1);
    	$op_relevancy_comment->save();

		$this->comment = OpCommentPeer::retrieveByPk($this->getRequestParameter('id'));

  }

  public function executeUsersList()
  {
    // valori di default per regione e location
    $this->region_id = $this->getRequestParameter('region_id', '-1');
    $this->location_id = $this->getRequestParameter('location_id', '-1');
    
    // valori di default per sort_field e sort_order
    $this->sort_field = $this->getRequestParameter('sort_field', 'none');
    $this->sort_order = $this->getRequestParameter('sort_order', 'DESC');

    // gestisce il caso di submit del form senza selezione dell'autocompleter
	  if ($this->hasRequestParameter('location') && $this->getRequestParameter('location') != 'Inserisci il nome del comune' &&
	      (!$this->hasRequestParameter('location_id') || 
	        strlen($this->getRequestParameter('location_id')) == 0 || 
	        $this->getRequestParameter('location_id') == -1) )
  	  {
  	    // a questo punto so che la location e' univoca
        $c = new Criteria();
        $c->add(OpLocationPeer::NAME, $this->getRequestParameter('location'));
        $c->add(OpLocationTypePeer::NAME, 'comune');
        $c->addJoin(OpLocationPeer::LOCATION_TYPE_ID, OpLocationTypePeer::ID);
        $location = OpLocationPeer::doSelectOne($c);
        $this->location_id = $location->getId();
      }

  }

  
  public function executeAttivita()
  {
    $this->hash = $this->getRequestParameter('hash');
  }

  public function executeCharges()
  {
    $this->hash = $this->getRequestParameter('hash');
    $this->upsert = $this->getRequestParameter('upsert', 'all');
  }

  public function executeResources()
  {
    $this->hash = $this->getRequestParameter('hash');
    $this->upsert = $this->getRequestParameter('upsert', 'all');
  }

  public function executeAdoptions()
  {
    $this->hash = $this->getRequestParameter('hash');
  }

  public function executePolinsertions()
  {
    $this->hash = $this->getRequestParameter('hash');
  }

  public function executeRemovals()
  {
    $this->hash = $this->getRequestParameter('hash');
  }


  public function executeDeclarations()
  {
    $this->hash = $this->getRequestParameter('hash');
    $this->upsert = $this->getRequestParameter('upsert', 'all');
  }

  public function executeThemes()
  {
    $this->hash = $this->getRequestParameter('hash');
  }

  public function executeComments()
  {
    $this->hash = $this->getRequestParameter('hash');
  }


  public function executePicture()
  {
    $hash = $this->getRequestParameter('hash');
  	$user = OpUserPeer::getUserFromHash($this->getRequestParameter('hash'));
  	$this->forward404Unless($user);
  	$or_im = imagecreatefromstring($user->getPicture()->__toString());
	//echo "wwww".strlen($user->getPicture()->__toString());

    // se è specificata una classe, opera un resample
    if ($this->hasRequestParameter('class'))
    {
      $class = $this->getRequestParameter('class');
      $w = sfConfig::get("app_imageclass_$class", imagesx($or_im));
      $h = sfConfig::get("app_imageclass_$class", imagesy($or_im));

      $res_im = imagecreatetruecolor($w, $h);
      imagecopyresampled($res_im, $or_im, 0, 0, 0, 0, $w, $h, imagesx($or_im), imagesy($or_im));
      $im = $res_im;
    } else {
      $im = $or_im;
    }

  	// immagazzina la versione png dell'immagine in $this->picture
  	ob_start();
    imagepng($im);
    $this->picture = ob_get_contents();
    ob_end_clean();

    $this->getResponse()->setHttpHeader('Content-Length', strlen($this->picture));

  }


  public function executeDeletePicture()
  {
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
		if ($this->getUser()->getSubscriber()->getHash()==$this->getRequestParameter('hash') ||
		    $this->getUser()->hasCredential('administrator'))
	  	$this->user = OpUserPeer::getUserFromHash($this->getRequestParameter('hash'));
		$this->forward404Unless($this->user);

    $this->user->setPicture(null);
    $this->user->save();
		$this->redirect('@user_profile?hash=' . $this->user->getHash());
  }

  public function executeEditPicture()
  {
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
		if ($this->getUser()->getSubscriber()->getHash()==$this->getRequestParameter('hash') ||
		    $this->getUser()->hasCredential('administrator'))
	  	$this->user = OpUserPeer::getUserFromHash($this->getRequestParameter('hash'));
		$this->forward404Unless($this->user);

		// process only POST requests
		if ($this->getRequest()->getMethod() == sfRequest::POST)
		{
      if($_FILES['picture']['tmp_name'] != '')
			  $this->user->setPicture($_FILES['picture']['tmp_name']);

      $this->user->save();
			$this->redirect('@user_profile?hash=' . $this->user->getHash());
	  }

  }

  public function handleErrorEditPicture()
  {
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $this->user = $this->getUser()->getSubscriber();
    return sfView::SUCCESS;
  }

  public function executeEditNotes()
  {
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
		if ($this->getUser()->getSubscriber()->getHash()==$this->getRequestParameter('hash') ||
		    $this->getUser()->hasCredential('administrator'))
	  	$this->user = OpUserPeer::getUserFromHash($this->getRequestParameter('hash'));
		$this->forward404Unless($this->user);

		// process only POST requests
		if ($this->getRequest()->getMethod() == sfRequest::POST)
		{
  		// salva le note, con strip dei tag tranne di quelli permessi
  		$this->user->setNotes(strip_tags($this->getRequestParameter('notes'),
  		                                  "<b><i><ul><li><br><a><hr><p><h2><h3><h4>"));
      $this->user->save();
			$this->redirect('@user_profile?hash=' . $this->user->getHash());
    }

  }

  public function handleErrorEditNotes()
  {
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $this->user = $this->getUser()->getSubscriber();
    return sfView::SUCCESS;
  }


  public function executeEditPassword()
  {
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $this->user = $this->getUser()->getSubscriber();

		// process only POST requests
		if ($this->getRequest()->getMethod() == sfRequest::POST)
		{
  		// salva la nuova password
		  $this->user->setPassword($this->getRequestParameter('password'));
		  $this->user->save();
      $this->getUser()->signOut();
      $this->getUser()->signIn($this->user);
  		$this->redirect('/user/');
    }

  }

  public function handleErrorEditPassword()
  {
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $this->user = $this->getUser()->getSubscriber();
    return sfView::SUCCESS;
  }

  public function executeEditLocation()
  {
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $this->user = $this->getUser()->getSubscriber();

		// process only POST requests
		if ($this->getRequest()->getMethod() == sfRequest::POST)
		{
  		// salva la nuova location
		  $this->user->setLocationId($this->getRequestParameter('location_id'));
      $this->user->save();
  		$this->redirect('/user/');
    }

  }

  public function handleErrorEditLocation()
  {
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $this->user = $this->getUser()->getSubscriber();
    return sfView::SUCCESS;
  }



  public function executeEditUrl()
  {
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $this->user = $this->getUser()->getSubscriber();

		// process only POST requests
		if ($this->getRequest()->getMethod() == sfRequest::POST)
		{
  		// salva la nuova location
  		if ($this->getRequestParameter('url_personal_website') == "http://")
  		  $this->user->setUrlPersonalWebsite("");
  		else
		    $this->user->setUrlPersonalWebsite($this->getRequestParameter('url_personal_website'));

      $this->user->save();
  		$this->redirect('/user/');
    }

  }

  public function handleErrorEditUrl()
  {
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $this->user = $this->getUser()->getSubscriber();
    return sfView::SUCCESS;
  }

  public function executeSwitch_wtbm()
  {
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $this->user = $this->getUser()->getSubscriber();

    if ($this->user->getWantToBeModerator()==1)
      $this->user->setWantToBeModerator(0);
    else
      $this->user->setWantToBeModerator(1);

    $this->user->save();
    return sfView::SUCCESS;
  }



  /**
   * l'utente richiede di adottare un politico
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executePol_adopt()
  {
    // retrieve del politico
    $pol_id = $this->getRequestParameter('content_id');
    $this->pol = OpPoliticianPeer::retrieveByPK($pol_id);

    // memorizza il referrer
    $this->referer = $this->getRequestParameter('referer');

    // controllo utente registrato
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $user = $this->getUser()->getSubscriber();

    // crea l'adozione
    if ( OpPolAdoptionPeer::retrieveByPK($user->getId(), $pol_id)) return 'RequestExists';
    $adoption = new OpPolAdoption();
    $adoption->setOpUser($user);
    $adoption->setOpPolitician($this->pol);
    $adoption->setRequestedAt(time());
    $adoption->save();
    
	  // invia la notifica
	  $raw_email = $this->sendEmail('mail', "sendPolAdoptionRequest");
    $this->logMessage($raw_email, 'debug');     
    
  }
    

  /**
   * l'utente richiede di adottare una localita'
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeLoc_adopt()
  {
    // retrieve del politico
    $loc_id = $this->getRequestParameter('location_id');    
    $this->loc = OpLocationPeer::retrieveByPK($loc_id);

    // memorizza il referrer
    $this->referer = $this->getRequestParameter('referer');

    // controllo utente registrato
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $user = $this->getUser()->getSubscriber();
    
    // crea l'adozione
    if ( OpLocAdoptionPeer::retrieveByPK($user->getId(), $loc_id)) return 'RequestExists';
    $adoption = new OpLocAdoption();
    $adoption->setOpUser($user);
    $adoption->setOpLocation($this->loc);
    $adoption->setRequestedAt(time());
    $adoption->save();
    
	  // invia la notifica
	  $raw_email = $this->sendEmail('mail', "sendLocAdoptionRequest");

  }
  

  /**
   * funzione che legge i parametri e mostra la pagina intermedia
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeAdoption()
  {

    // memorizza il referrer
    $this->referer = $this->getRequest()->getReferer();

    // memorizza type e adoptee_id
    $this->type = $this->getRequestParameter('type');
    $this->adoptee_id = $this->getRequestParameter('adoptee_id');
    
    $this->form_action = $this->type == 'pol' ? '@adotta_politico' : '@adotta_localita';
     
  }



}

?>
