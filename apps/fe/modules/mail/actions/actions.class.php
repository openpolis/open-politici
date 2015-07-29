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
 * mail actions.
 *
 * @package    openpolis
 * @subpackage mail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1814 2006-08-24 12:20:11Z fabien $
 */
class mailActions extends sfActions
{
	public function executeSendRegistrationProcess()
	{
		$this->user = OpUserPeer::RetrieveByPk($this->getUser()->getAttribute('user_id', ''));
		$this->attivation_address = sfConfig::get('app_mail_attivation_address');
		
		// inizializzazione della classe
		$mail = new sfMail();
		$mail->setCharset('utf-8');      
		$mail->setContentType('text/html');	
		
		// definizione dei parametri
		$mail->addAddress($this->getRequestParameter('email'));
		
		$mail->setSubject(sfConfig::get('app_mail_subject'));
		
		$mail->setSender(sfConfig::get('app_mail_sender_address'), sfConfig::get('app_mail_sender_name'));
		$mail->setFrom(sfConfig::get('app_mail_from_address'), sfConfig::get('app_mail_from_name'));
		$mail->addReplyTo(sfConfig::get('app_mail_reply_address'), sfConfig::get('app_mail_reply_name'));
										  
		$this->mail = $mail;    
	
	}
	
	
	public function executeSendAttivationProcess()
  	{
	
		$this->user = OpUserPeer::RetrieveByPk($this->getUser()->getAttribute('user_id', ''));
		
		// inizializzazione della classe
		$mail = new sfMail();
		$mail->setCharset('utf-8');      
		$mail->setContentType('text/html');	
		
		// definizione dei parametri
		$mail->addAddress($this->user->getEmail());
		
		$mail->setSubject(sfConfig::get('app_mail_subject2'));
		
		$mail->setSender(sfConfig::get('app_mail_sender_address'), sfConfig::get('app_mail_sender_name'));
		$mail->setFrom(sfConfig::get('app_mail_from_address'), sfConfig::get('app_mail_from_name'));
		$mail->addReplyTo(sfConfig::get('app_mail_reply_address'), sfConfig::get('app_mail_reply_name'));
										  
		$this->mail = $mail;    

  	}	  


  public function executeSendPassword()
	{
		$this->login_address = sfConfig::get('app_mail_login_address');
		
		$mail = new sfMail();
		$mail->setCharset('utf-8');      
		$mail->setContentType('text/html');	
	
		$mail->addAddress($this->getRequestParameter('email'));
		$mail->setSubject(sfConfig::get('app_mail_subject3'));
		$mail->setSender(sfConfig::get('app_mail_sender_address'), sfConfig::get('app_mail_sender_name'));
		$mail->setFrom(sfConfig::get('app_mail_from_address'), sfConfig::get('app_mail_from_name'));
		$mail->addReplyTo(sfConfig::get('app_mail_reply_address'), sfConfig::get('app_mail_reply_name'));
	
		$this->mail = $mail;
	
		$this->password = $this->getRequest()->getAttribute('password');
	}
	
	/**
	 * notifica di richiesta adozione politico
	 *
	 * @return void
	 * @author Guglielmo Celata
	 **/
	public function executeSendPolAdoptionRequest()
	{
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $this->user = $this->getUser()->getSubscriber();

	  $this->pol = OpPoliticianPeer::RetrieveByPk($this->getRequestParameter('content_id'));

		// seleziona gli administrators
		$c = new Criteria();
		$c->add(OpUserPeer::IS_ADMINISTRATOR, 1, Criteria::EQUAL);
		$c->add(OpUserPeer::EMAIL, '', Criteria::NOT_EQUAL);
  	$administrators = OpUserPeer::doSelect($c);
		
		$mail = new sfMail();
		$mail->setCharset('utf-8');      
		$mail->setContentType('text/html');		
		foreach ($administrators as $administrator)
			$mail->addBcc($administrator->getEmail());
		
		$mail->setSubject('openpolis: richiesta di adozione');
		$mail->setSender(sfConfig::get('app_mail_sender_address'), sfConfig::get('app_mail_sender_name'));
		$mail->setFrom(sfConfig::get('app_mail_from_address'), sfConfig::get('app_mail_from_name'));
		$mail->addReplyTo(sfConfig::get('app_mail_reply_address'), sfConfig::get('app_mail_reply_name'));
		
		$this->mail = $mail;
		
	}	


  /**
   * notifica di richiesta adozione località
   *
   * @return void
   * @author Guglielmo Celata
   **/
	public function executeSendLocAdoptionRequest()
	{
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $this->user = $this->getUser()->getSubscriber();

	  $this->loc = OpLocationPeer::RetrieveByPk($this->getRequestParameter('location_id'));

		// seleziona gli administrators
		$c = new Criteria();
		$c->add(OpUserPeer::IS_ADMINISTRATOR, 1, Criteria::EQUAL);
    $c->add(OpUserPeer::EMAIL, '', Criteria::NOT_EQUAL);	
  	$administrators = OpUserPeer::doSelect($c);
		
		$mail = new sfMail();
		$mail->setCharset('utf-8');      
		$mail->setContentType('text/html');		
		foreach ($administrators as $administrator)
			$mail->addBcc($administrator->getEmail());
		
		$mail->setSubject('openpolis: richiesta di adozione');
		$mail->setSender(sfConfig::get('app_mail_sender_address'), sfConfig::get('app_mail_sender_name'));
		$mail->setFrom(sfConfig::get('app_mail_from_address'), sfConfig::get('app_mail_from_name'));
		$mail->addReplyTo(sfConfig::get('app_mail_reply_address'), sfConfig::get('app_mail_reply_name'));
		
		$this->mail = $mail;
		
	}	
	
	
	public function executeSendAdoptionAccept()
	{
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $adopter_id = $this->getRequestParameter('adopter_id');
    $this->adopter = OpUserPeer::retrieveByPK($adopter_id);
    
    $this->type = $this->getRequestParameter('type');
    if ($this->type == 'pol') 
    {
      // retrieve del politico
      $adoptee_id = $this->getRequestParameter('adoptee_id');
      $this->adoptee = OpPoliticianPeer::retrieveByPK($adoptee_id);
    } else {
      // retrieve del politico
      $adoptee_id = $this->getRequestParameter('adoptee_id');
      $this->adoptee = OpLocationPeer::retrieveByPK($adoptee_id);
    }

		$mail = new sfMail();
		$mail->setCharset('utf-8');      
		$mail->setContentType('text/html');		
		$mail->addAddress($this->adopter->getEmail());
		
		$mail->setSubject('openpolis: tua richiesta di adozione');
		$mail->setSender(sfConfig::get('app_mail_sender_address'), sfConfig::get('app_mail_sender_name'));
		$mail->setFrom(sfConfig::get('app_mail_from_address'), sfConfig::get('app_mail_from_name'));
		$mail->addReplyTo(sfConfig::get('app_mail_reply_address'), sfConfig::get('app_mail_reply_name'));
		
		$this->mail = $mail;
	}

	public function executeSendAdoptionRefuse()
	{
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    $adopter_id = $this->getRequestParameter('adopter_id');
    $this->adopter = OpUserPeer::retrieveByPK($adopter_id);
    $this->type = $this->getRequestParameter('type');
    if ($this->type == 'pol') 
    {
      // retrieve del politico
      $adoptee_id = $this->getRequestParameter('adoptee_id');
      $this->adoptee = OpPoliticianPeer::retrieveByPK($adoptee_id);
    } else {
      // retrieve del politico
      $adoptee_id = $this->getRequestParameter('adoptee_id');
      $this->adoptee = OpLocationPeer::retrieveByPK($adoptee_id);
    }
    $this->refusalReason = $this->getRequestParameter('reason');

		$mail = new sfMail();
		$mail->setCharset('utf-8');      
		$mail->setContentType('text/html');		
		$mail->addAddress($this->adopter->getEmail());
		
		$mail->setSubject('openpolis: tua richiesta di adozione');
		$mail->setSender(sfConfig::get('app_mail_sender_address'), sfConfig::get('app_mail_sender_name'));
		$mail->setFrom(sfConfig::get('app_mail_from_address'), sfConfig::get('app_mail_from_name'));
		$mail->addReplyTo(sfConfig::get('app_mail_reply_address'), sfConfig::get('app_mail_reply_name'));
		
		$this->mail = $mail;
	}


	public function executeSendDontFindNotification()
	{
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;

    $this->info = $this->getRequestParameter('info', NULL);	
    $this->user = OpUserPeer::RetrieveByPk($this->getRequestParameter('user_id', NULL));
    $this->loc = OpLocationPeer::retrieveByPK($this->getRequestParameter('location_id', NULL));
    if (!$this->loc instanceof OpLocation || !$this->user instanceof OpUser) return sfView::ERROR;
    
		// seleziona gli administrators
		$c = new Criteria();
		$c->add(OpUserPeer::IS_ADMINISTRATOR, 1, Criteria::EQUAL);
		$c->add(OpUserPeer::EMAIL, '', Criteria::NOT_EQUAL);
  	$administrators = OpUserPeer::doSelect($c);

    // seleziona gli adopters della location
    $adopters_ids = OpAdoptionPeer::getAdoptersForLocation($this->loc->getId());
    $adopters = array();
    foreach ($adopters_ids as $adopter_id)
      $adopters []= OpUserPeer::retrieveByPK($adopter_id);

    // genera la mail
		$mail = new sfMail();
		$mail->setCharset('utf-8');      
		$mail->setContentType('text/html');		
    
    // aggiunge gli administrators ai destinatari
		foreach ($administrators as $administrator)
			$mail->addBcc($administrator->getEmail());

    // aggiunge gli adopters ai destinatari
		foreach ($adopters as $adopter)
			$mail->addBcc($adopter->getEmail());
		
		$mail->setSubject('openpolis: notifica di politico non trovato');
		$mail->setSender(sfConfig::get('app_mail_sender_address'), sfConfig::get('app_mail_sender_name'));
		$mail->setFrom(sfConfig::get('app_mail_from_address'), sfConfig::get('app_mail_from_name'));
		$mail->addReplyTo(sfConfig::get('app_mail_reply_address'), sfConfig::get('app_mail_reply_name'));
		
		$this->mail = $mail;
	}


  /**
   * invia una notifica per una segnalazione di inesattezza dati di un politico
   * si può trattare di dati anagrafici, incarichi o dichiarazioni
   *
   * @return void
   * @author Guglielmo Celata
   **/
	public function executeSendReportNotification()
	{
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;

		switch ($this->getRequestParameter('report_type'))
		{
			case '2': 
				$this->report_type = 'o';
				break;
			case '3': 
				$this->report_type = 's';
				break;	
			default:
				$this->report_type = 'e';	
				break; 
		}
	
		$this->notes = $this->getRequestParameter('notes');

		$this->user_id = $this->getRequestParameter('user_id');
		$this->user = OpUserPeer::retrieveByPK($this->user_id);
		
		$this->content_id = $this->getRequestParameter('content_id');
		$this->opContent = OpContentPeer::RetrieveByPk($this->content_id);		
		
		$this->pol_id = $this->getRequestParameter('politician_id');
		$this->politician = OpPoliticianPeer::RetrieveByPk($this->pol_id);
    
    // seleziona gli adopters del politico
    $adopters_ids = OpAdoptionPeer::getAdoptersForPolitician($this->pol_id);
    $adopters = array();
    foreach ($adopters_ids as $adopter_id)
      $adopters []= OpUserPeer::retrieveByPK($adopter_id);

    // genera la mail
		$mail = new sfMail();
		$mail->setCharset('utf-8');      
		$mail->setContentType('text/html');		
    
    // aggiunge gli adopters ai destinatari
		foreach ($adopters as $adopter)
			$mail->addBcc($adopter->getEmail());
		
		$mail->setSubject('openpolis: segnalazione di un contenuto');
		$mail->setSender(sfConfig::get('app_mail_sender_address'), sfConfig::get('app_mail_sender_name'));
		$mail->setFrom(sfConfig::get('app_mail_from_address'), sfConfig::get('app_mail_from_name'));
		$mail->addReplyTo(sfConfig::get('app_mail_reply_address'), sfConfig::get('app_mail_reply_name'));
		
		$this->mail = $mail;
	}

  /**
   * invia una notifica per oscuramento
   * si può trattare di risorse, incarichi o dichiarazioni
   *
   * @return void
   * @author Guglielmo Celata
   **/
	public function executeSendObscurationNotification()
	{
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    
		$this->reason = $this->getRequestParameter('reason');

		$this->user_id = $this->getRequestParameter('user_id');
		$this->user = OpUserPeer::retrieveByPK($this->user_id);
		
		$this->content_id = $this->getRequestParameter('content_id');
		$this->opContent = OpContentPeer::RetrieveByPk($this->content_id);		
		
		$op_peer_class = $this->opContent->getOpClass() . 'Peer';
		$content = call_user_func(array($op_peer_class, 'retrieveByPK'), $this->content_id);
		$this->pol_id = $content->getPoliticianId();
		$this->politician = OpPoliticianPeer::RetrieveByPk($this->pol_id);

		// seleziona gli administrators
		$c = new Criteria();
		$c->add(OpUserPeer::IS_ADMINISTRATOR, 1, Criteria::EQUAL);
		$c->add(OpUserPeer::EMAIL, '', Criteria::NOT_EQUAL);
  	$administrators = OpUserPeer::doSelect($c);

    // seleziona gli adopters del politico
    $adopters_ids = OpAdoptionPeer::getAdoptersForPolitician($this->pol_id);
    $adopters = array();
    foreach ($adopters_ids as $adopter_id)
      $adopters []= OpUserPeer::retrieveByPK($adopter_id);

    // genera la mail
		$mail = new sfMail();
		$mail->setCharset('utf-8');      
		$mail->setContentType('text/html');
		
		// ricava la mail dell'utente che ha creato il tema
		$open_contents = $this->opContent->getOpOpenContents();
		$creator_address = $open_contents[0]->getOpUser()->getEmail();
		$mail->addAddress($creator_address);		
    
    // aggiunge gli adopters ai destinatari in bcc
		foreach ($adopters as $adopter)
			$mail->addBcc($adopter->getEmail());

    // aggiunge gli administrators ai destinatari in bcc
		foreach ($administrators as $administrator)
			$mail->addBcc($administrator->getEmail());
		
		$mail->setSubject('openpolis: oscuramento di un contenuto');
		$mail->setSender(sfConfig::get('app_mail_sender_address'), sfConfig::get('app_mail_sender_name'));
		$mail->setFrom(sfConfig::get('app_mail_from_address'), sfConfig::get('app_mail_from_name'));
		$mail->addReplyTo(sfConfig::get('app_mail_reply_address'), sfConfig::get('app_mail_reply_name'));
		
		$this->mail = $mail;
	}


  /**
   * invia una notifica per oscuramento di un tema
   *
   * @return void
   * @author Guglielmo Celata
   **/
	public function executeSendThemeObscurationNotification()
	{
    if (!$this->getUser()->isAuthenticated()) return sfView::ERROR;
    
		$this->reason = $this->getRequestParameter('reason');

		$this->user_id = $this->getRequestParameter('user_id');
		$this->user = OpUserPeer::retrieveByPK($this->user_id);
		
		$this->content_id = $this->getRequestParameter('content_id');
		$this->theme = OpThemePeer::RetrieveByPk($this->content_id);		
		
		// seleziona gli administrators
		$c = new Criteria();
		$c->add(OpUserPeer::IS_ADMINISTRATOR, 1, Criteria::EQUAL);
		$c->add(OpUserPeer::EMAIL, '', Criteria::NOT_EQUAL);
  	$administrators = OpUserPeer::doSelect($c);

    // genera la mail
		$mail = new sfMail();
		$mail->setCharset('utf-8');      
		$mail->setContentType('text/html');		 	
    		$mail->addAddress($this->theme->getOpOpinableContent()->getOpOpenContent()->getOpUser()->getEmail());
    // aggiunge gli administrators ai destinatari in bcc
		foreach ($administrators as $administrator)
			$mail->addBcc($administrator->getEmail());
		
		$mail->setSubject('openpolis: oscuramento di un tema');
		$mail->setSender(sfConfig::get('app_mail_sender_address'), sfConfig::get('app_mail_sender_name'));
		$mail->setFrom(sfConfig::get('app_mail_from_address'), sfConfig::get('app_mail_from_name'));
		$mail->addReplyTo(sfConfig::get('app_mail_reply_address'), sfConfig::get('app_mail_reply_name'));
		
		$this->mail = $mail;
	}
	
	
    
  /**
   * invia le email che notificano la creazione di un nuovo tema agli amici 
   * (ce n'è sempre uno valido quando si è a questo punto)
   */
  public function executeSendNewThemeNotification()
  {

   	$mail_amici = $this->getRequestParameter('mail_amici');
   	$theme_id = $this->getRequestParameter('theme_id');
   	$this->theme = OpThemePeer::retrieveByPK($theme_id);
  	$friends = preg_split("/[\s,]+/", $mail_amici); 

  	// passa il testo che l'utente ha inserito
   	$this->mail_testo = $this->getRequestParameter('mail_testo');

  	try
  	{
      // genera la mail per gli amici
  		$mail = new sfMail();
  		$mail->setCharset('utf-8');      
  		$mail->setContentType('text/html');		
    		
  		foreach ($friends as $friend)
  			$mail->addBcc($friend);
		if ($this->getUser()->getSubscriber()->getPublicName()==1)
  		$mail->setSubject('Messaggio da '.$this->getUser()->getSubscriber()->getFirstName().' '.$this->getUser()->getSubscriber()->getLastName().' - sostieni il mio tema su openpolis!');
  		else 
  		$mail->setSubject('Messaggio da '.$this->getUser()->getSubscriber()->getNickname().' - sostieni il mio tema su openpolis!');
  		
  		$mail->setSender(sfConfig::get('app_mail_sender_address'), sfConfig::get('app_mail_sender_name'));
  		$mail->setFrom(sfConfig::get('app_mail_from_address'), sfConfig::get('app_mail_from_name'));
  		$mail->addReplyTo($this->getUser()->getSubscriber()->getEmail());
		
  		$this->mail = $mail;

  	}
  	catch (Exception $e)
  	{
  	    $con->rollback();
  	    $this->$errorType = 'Errore del Mailer';
  	    $this->$err = $e;
  	    return sfView::ERROR;
  	}
  	
  	$this->mails = $friends;

  }  
  	

}

?>
