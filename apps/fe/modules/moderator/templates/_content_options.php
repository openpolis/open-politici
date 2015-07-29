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
<?php if ($sf_user->hasCredential('moderator')): ?>
  <?php if ($content->getReports()): ?>
    &nbsp;[<?php echo __('%1% reports', array('%1%' => $content->getReports())) ?>]
    &nbsp;<?php echo link_to('['.__('reset reports').']', 'moderator/resetContentReports?hash='.$content->getHash(), 'confirm='.__('Are you sure you want to reset the report spam counter for this content?')) ?>
  <?php endif; ?>
  &nbsp;<?php //echo link_to('['.__('delete content').']', 'moderator/deleteContent?hash='.$content->getHash(), 'confirm='.__('Are you sure you want to delete this content?')) ?>
<?php endif; ?>
