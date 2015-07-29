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
<?php echo use_helper('Javascript'	
	/* canonicals links */
	, 'HeaderLinks');

	if ( sfRouting::getInstance()->getCurrentRouteName() == 'istituzione' )
		add_link(
			'@istituzione_new?slug='. $inst->getSlug() .'&id='. $inst->getId(),
			'canonical');
?>
<!--
  <p style="text-align:right; float:right">
    <?php if ($sf_user->hasCredential('subscriber')): ?>
      <?php echo link_to(__('Segnala inesattezze'), 'politician/dontFind?location_id=null') ?>
    <?php else: ?>
      <?php echo link_to_function(__('Segnala inesattezze'), visual_effect('blind_down', 'login', array('duration' => 0.5)));	?>
    <?php endif; ?>
  </p>
-->
<?php switch ($sf_params->get('id')): ?>
<?php case sfConfig::get('app_institution_id_CE'): ?>
<?php case sfConfig::get('app_institution_id_PE'): ?>
<?php echo include_partial('politician/euroDepList', array('pager' => $pager, 'commissari_europei' => $commissari_europei, 'title' => $title)) ?>
<?php break; ?>
<?php case sfConfig::get('app_institution_id_SR'): ?>
<?php case sfConfig::get('app_institution_id_CD'): ?>
<?php echo include_component('politician', 'camereList', array('pager' => $pager, 'title' => $title)) ?>
<?php break; ?>	
<?php case sfConfig::get('app_institution_id_GI'): ?>
<?php echo include_component('politician', 'governoList', array('pager' => $pager, 'title' => $title)) ?>
<?php break; ?>	
<?php endswitch ?>      