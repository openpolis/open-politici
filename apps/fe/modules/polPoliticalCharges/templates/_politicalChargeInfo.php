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
<?php if($political_charge->getDateStart()): ?>
	<?php echo 'dal&nbsp;'.format_date($political_charge->getDateStart(), 'yyyy') ?>
<?php endif; ?>

<?php if ($political_charge->getDateEnd() != ''): ?>
	<?php echo 'al&nbsp;'.format_date($political_charge->getDateEnd(), 'yyyy') ?>
<?php endif; ?>
&nbsp;&nbsp;-&nbsp;
<?php if ($political_charge->getChargeTypeId() == sfConfig::get('app_charge_type_id_iscritto')): ?>
	<?php echo __('iscritto') ?>
<?php else: ?>
	<?php echo $political_charge->getDescription() ?>	
<?php endif; ?>	
<?php switch($political_charge->getOpLocation()->getLocationTypeId()): ?>
<?php case sfConfig::get('app_location_type_id_region'): ?>
<?php echo $political_charge->getOpLocation()->getName();?>
<?	break; ?>
<?php case sfConfig::get('app_location_type_id_provincial'): ?>
<?php echo $political_charge->getOpLocation()->getName();?></b>
<?	break; ?>
<?php case sfConfig::get('app_location_type_id_municipal'): ?>
<?php echo $political_charge->getOpLocation()->getName()."(".$political_charge->getOpLocation()->getProv().")"; ?>
<?php endswitch ?>
&nbsp;-&nbsp;
<?php echo $political_charge->getOpParty()->getName(); ?>