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
$test_locations = sfYaml::load(dirname(__FILE__).'/cercaTuoiRappresentantiLocations.yml');
$n_locations = count($test_locations);

$b->test()->diag("Test di ricerca rappresentanti per $n_locations località");

foreach ($test_locations as $location_name)
{
  $location = OpLocationPeer::retrieveByCityName($location_name, $con);
  $b->test()->diag("");
  $b->test()->diag("$location_name");
  
  $b->
    # parti dalla home page
    get("/")->
    isStatusCode(200)->
    isRequestParameter('module', 'default')->
    isRequestParameter('action', 'index')->
    
    # scrive la stringa nel campo di testo e invia
    click(' ', array('location' => $location_name))->
    isRequestParameter('module', 'default')->
    isRequestParameter('action', 'choice2')->
    
    # l'elaborazione deve finire con un redirect alla politician/forlocation
    isRedirected()->
    followRedirect()->
    
    # controlla che l'id
    isRequestParameter('module', 'politician')->
    isRequestParameter('action', 'forlocation')->
    isRequestParameter('location_id', $location->getId())->
    checkResponseElement('div[id="container"]', true)
  ;
  
}