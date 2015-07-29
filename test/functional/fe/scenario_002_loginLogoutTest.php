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

include(dirname(__FILE__).'/../../bootstrap/functional.php');
sfContext::getInstance();

// crea un browser
$b = new sfTestBrowser();
$b->initialize('openpolis');


$b->test()->diag("Login utente");
$b->test()->diag("");

// lettura utente configurazione per il test 
$test_user = sfYaml::load(dirname(__FILE__).'/registratiUser.yml');
$user_first_name = $test_user['firstname'];

// controlla se l'utente esiste, se no, fine del test
// questo test va lanciato dopo lo scenario registrati
$user = OpUserPeer::getUserFromEmail($test_user['email']);
$b->test()->isa_ok($user, 'OpUser', 'Utente presente nel DB');

$b->
  get("/login")->
  isStatusCode(200)->
  isRequestParameter('module', 'user')->
  isRequestParameter('action', 'login')->
  post('/login', array('email'     => $test_user['email'],
                       'password'      => $test_user['password'],
                       'commit'        => 'entra') )->
                       
  // test redirect alla home page (impossibile verificare con un referrer)
  isRedirected()->
  followRedirect()->
  isStatusCode(200)->
  isRequestParameter('module', 'default')->
  isRequestParameter('action', 'index')->
  
  // test presenza del nome utente nel menu di servizio (utente è loggato)
  checkResponseElement('div[class="service-menu"]', "/$user_first_name/")
;


$b->test()->diag("Logout utente");
$b->test()->diag("");

$b->
  get("/logout")->
  // test redirect alla home page
  isRedirected()->
  followRedirect()->
  isStatusCode(200)->
  isRequestParameter('module', 'default')->
  isRequestParameter('action', 'index')->
  checkResponseElement('div[class="service-menu"]', "/entra/")
;

  
?>