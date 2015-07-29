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
$b->initialize();

$con = Propel::getConnection();

// lettura configurazione per il test 
$test_politicians = sfYaml::load(dirname(__FILE__).'/cercaPoliticoDiretto.yml');
$n_politicians = count($test_politicians);

$b->test()->diag("Test di ricerca per $n_politicians politici (senza disambiguazione)");

foreach ($test_politicians as $politician)
{
  $b->test()->diag("");
  $b->test()->diag($politician["name"]);
 
  $b->
    # parti dalla home page dei politici
    get("/politici")->
    isStatusCode(200)->
    isRequestParameter('module', 'default')->
    isRequestParameter('action', 'politiciansHome')->
    
    # scrive la stringa nel campo di testo e invia
    post('/default/choice1', array('politician'    => $politician["name"],
                                   'politician_id' => $politician["id"],
                                   'Submit'        => 'Cerca'))->
    isRequestParameter('module', 'default')->
    isRequestParameter('action', 'choice1')->
    
    # l'elaborazione deve finire con un redirect alla politician/page
    isRedirected()->
    # qui da errore, la redirezione è corretta, ma quando si carica la politician/page,
    # si viene redirezionati alla home (routing?)
    followRedirect()->
    isStatusCode(200)->
    # controlla che l'id della location richiesta sia quella giusta
    isRequestParameter('module', 'politician')->
    isRequestParameter('action', 'page')->
    isRequestParameter('content_id', $politician["id"])
  ;
}