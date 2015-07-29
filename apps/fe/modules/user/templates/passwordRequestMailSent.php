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
<div id="title">
  <h1>Richiedi una nuova password</h1>
</div>

<hr />

<div class="genericblock">
  <div class="prenotapw">
  <h2>Ti &egrave; stata inviata una nuova password</h2>

  <p>La password &egrave; stata inviata all'indirizzo <?php echo $email ?></p>
  <p>Usala per accedere alla tua <?php echo link_to('pagina personale','@sf_guard_signin') ?></p>
  </div>
</div>    