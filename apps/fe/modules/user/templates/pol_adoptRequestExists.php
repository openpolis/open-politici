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
<?php use_helper('Date') ?>

<div id="title">
  <h1>Adozione politico</h1>
</div>

<hr />

<div class="genericblock">
  <h2>Richiesta di adozione fallita</h2>
  <p>Hai gi&agrave; inoltrato una richiesta di adozione per il politico 
     <?php echo $pol->getFirstName() . " " .  $pol->getLastName() ?>. </p>
  <p>Torna alla pagina di <?php echo link_to($pol->getFirstName() . ' ' .  $pol->getLastName(), $referer); ?></p>
</div>    