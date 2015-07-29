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

<p>Caro <?php echo (string)$adopter; ?>,</p>

<p>ci dispiace, ma la tua richiesta di poter adottare 
<?php if ($type=='pol'): ?>
  il politico
  <?php echo $adoptee->getFirstName() . " " . $adoptee->getLastName() . " - " . format_date($adoptee->getBirthDate()) ?>
<?php else: ?>
  la localit&agrave;
  <?php echo $adoptee->getOpLocationType()->getName(); ?> di <?php echo $adoptee->getName(); ?>
<?php endif; ?>

non &egrave; stata accolta.</p>

<p>Qui di seguito la motivazione del rifiuto:</p>

<p><?php echo $refusalReason ?></p>

<br/>
<p>il team openpolis</p>
