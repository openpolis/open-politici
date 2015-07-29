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
  <h1>Adozione di <?php echo $pol->getFirstName() . " " .  $pol->getLastName() ?></h1>
</div>

<hr />

<div class="genericblock">
  <h2>Richiesta di adozione inoltrata!</h2>
  <p>La tua richiesta di adozione per il politico 
     <?php echo $pol->getFirstName() . " " .  $pol->getLastName() ?> 
     &egrave; stata inoltrata correttamente.<br/>
     Gli amministratori la valuteranno e ti risponderanno al pi&ugrave; presto.</p>
     <p>Grazie per il contributo a openpolis.</p>
     <p>Torna alla pagina di <?php echo link_to($pol->getFirstName() . ' ' .  $pol->getLastName(), $referer); ?></p>
</div> 

<br /><br/>   