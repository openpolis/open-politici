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
Ci sono <strong><?php echo count($politician) ?></strong> politici con pi&ugrave; di un incarico.
<br />Non sono considerati doppi incarichi quelli di Giunta e di Consiglio per i comuni con meno di 15.000 abitanti.<br />
<strong>Nel cumolo delle cariche non sono considerati Ministri i Sottosegretari</strong>
<br /><br />
<?php if ($ordina==1) echo "<strong>ordina per:</strong> numero di incarichi | ".link_to("carica pi&ugrave; importante",'/multiple/3')." | ".link_to("cognome",'/multiple/2') ?>
<?php if ($ordina==2) echo "<strong>ordina per:</strong> " .link_to("numero di incarichi",'/multiple/1')." | ".link_to("carica pi&ugrave; importante",'/multiple/3')." | cognome" ?>
<?php if ($ordina==3) echo "<strong>ordina per:</strong> ".link_to("numero di incarichi",'/multiple/1')." | carica pi&ugrave; importante | ".link_to("cognome",'/multiple/2') ?>
<br /><br />
<?php foreach ($politician as $pol): ?>
  <?php echo $pol ?>
  <br />
<?php endforeach; ?>
