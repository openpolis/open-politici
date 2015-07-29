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
<?php if($organization_charge->getDateStart()): ?>
	<?php echo 'dal&nbsp;'.format_date($organization_charge->getDateStart(), 'yyyy') ?>
<?php endif; ?>

<?php if ($organization_charge->getDateEnd() != ''): ?>
	<?php echo 'al&nbsp;'.format_date($organization_charge->getDateEnd(), 'yyyy') ?>
<?php endif; ?>
&nbsp;&nbsp;-&nbsp;
<?php echo $organization_charge->getOpOrganization()->getName(); ?>
<?php if($organization_charge->getOpOrganization()->getUrl()): ?>
		&nbsp;&nbsp;(<?php echo link_to(str_replace('http://','',$organization_charge->getOpOrganization()->getUrl()),$organization_charge->getOpOrganization()->getUrl()) ?>)
<?php endif; ?>
&nbsp;&nbsp;-&nbsp;
<?php if($organization_charge->getChargeName()): ?>
	<?php echo $organization_charge->getChargeName(); ?>
<?php else: ?>
	<?php echo __('appartenente'); ?>
<?php endif; ?>