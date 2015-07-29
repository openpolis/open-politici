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

// lettura configurazione per il test 
$test_user = sfYaml::load(dirname(__FILE__).'/registratiUser.yml');

// indirizzo per l'attivazione
$attivation_address = "/user/attivation/hash/";

// controlla l'utente (DB è quello di test, vedi sec. test in databases.yml)
$user = OpUserPeer::getUserFromEmail($test_user['email']);
if ($user instanceof OpUser)
  $user->delete();
unset($user);

$b->test()->diag("Test per la registrazione di un nuovo utente");
$b->test()->diag("");

$b->test()->diag("riempi il form e invia (POST)");
$b->
  # test del routing
  get("/add_user")->
  isStatusCode(200)->
  isRequestParameter('module', 'user')->
  isRequestParameter('action', 'add')->
  
  post('/add_user', array('firstname'     => $test_user['firstname'],
                             'lastname'      => $test_user['lastname'],
                             'pubblico'      => $test_user['pubblico'],
                             'location'      => $test_user['location'],
                             'location_id'   => $test_user['location_id'],
                             'nickname'      => $test_user['nickname'],
                             'email'         => $test_user['email'],
                             'email_bis'     => $test_user['email'],
                             'password'      => $test_user['password'],
                             'password_bis'  => $test_user['password'],
                             'accetto'       => $test_user['accetto'],
                             'aggiornami'    => $test_user['aggiornami'],
                             'commit'        => 'Invia') )->
  isRedirected()->
  followRedirect()->
  isStatusCode(200)->
  isRequestParameter('module', 'user')->
  isRequestParameter('action', 'added')
;

# retrieve dell'utente appena inserito (dalla mail)
$user = OpUserPeer::getUserFromEmail($test_user['email']);
$b->test()->isa_ok($user, 'OpUser', 'Utente inserito nel DB');
$b->test()->is($user->getIsActive(), 0, 'Utente non ancora attivato');  

# click sul link di attivazione nella mail
$b->test()->diag("Attivazione utente");
$b->get($attivation_address . $user->getSha1Password())->
  isStatusCode(200);
unset($user);

# controllo se utente attivato
$user = OpUserPeer::getUserFromEmail($test_user['email']);
$b->test()->is($user->getIsActive(), 1, 'Utente attivato');
  
?>