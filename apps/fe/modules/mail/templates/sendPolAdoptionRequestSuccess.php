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

<p>Salve,</p>
<br />
<p>l'utente <?php echo (string)$user; ?> chiede di poter adottare il politico
<?php echo $pol->getFirstName() . " " . $pol->getLastName() . " - " . format_date($pol->getBirthDate()) ?></p>

<p>Valuta la richiesta e vai alla sezione <a href="<?php echo $sf_request->getHost() . url_for('@lista_adozioni') ?>">gestione adozioni</a> per accettarla o rifiutarla.</p>

<p>sistema notifiche di openpolis</p>
