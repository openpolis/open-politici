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

<p>la tua richiesta di poter adottare 
<?php if ($type=='pol'): ?>
  il politico
  <?php echo $adoptee->getFirstName() . " " . $adoptee->getLastName() . " - " . format_date($adoptee->getBirthDate()) ?>
<?php else: ?>
  la localit&agrave;
  <?php echo $adoptee->getOpLocationType()->getName(); ?> di <?php echo $adoptee->getName(); ?>
<?php endif; ?>

&egrave; stata accettata!</p>

<p>Da questo momento ti vengono affidati i privilegi e le responsabilità di un moderatore per tutte le informazioni e i dati presenti nelle pagine del politico adottato.</p>
<p>Dovrai far rispettare il regolamento del sito e verificare che i dati inseriti dagli altri utenti siano corretti.</p>
<p>Se necessario potrai intervenire - attraverso i bottoni a fianco dei dati - per modificare o oscurare le informazioni presenti.</p>
<p>Ma soprattutto dovrai avere una cura particolare e una certa continuità nella pubblicazione delle dichiarazioni del politico e nell'aggiornamento delle informazioni che lo riguardano.</p>
<p>La correttezza e l'affidabilità delle informazioni sono il presupposto su cui si basa la credibilità di openpolis, che ora dipende in maniera importante anche da te.</p>
<p>Se hai dubbi o ti serve un aiuto contatta gli amministratori a questo indirizzo info@openpolis.it.</p>
<p>Grazie per i tuoi contributi e buona adozione!</p>

<br/>
<p>il team openpolis</p>
