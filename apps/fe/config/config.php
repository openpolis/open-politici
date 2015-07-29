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

// include project configuration
include(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// symfony bootstraping
require_once($sf_symfony_lib_dir.'/util/sfCore.class.php');
sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);

# inclusione di nuovi files di configurazione!
include(sfConfigCache::getInstance()->checkConfig(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'search.yml'));


// blocco temporaneo degli accessi
// per attivarlo/disattivarlo, basta modificare apps/fe/setings.yml
// e aggiungere il modulo deppTemporaryBlock all'elenco di quelli enabled
if (in_array('deppTemporaryBlock', sfConfig::get('sf_enabled_modules', array())))
{
  $r = sfRouting::getInstance();

  // preprend our routes
  $r->prependRoute('block_login', '/login', array('module' => 'deppTemporaryBlock', 'action' => 'block'));
  $r->prependRoute('block_request_password', '/request_password', array('module' => 'deppTemporaryBlock', 'action' => 'block'));
}
