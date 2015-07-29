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
<?php $valore = isset($value)?$value:'Inserisci il tuo comune di residenza'; ?>
<?php echo input_auto_complete_tag('location', isset($location)?$location:$valore, '@location_autocomplete', 
                                    array('autocomplete' => 'off', 
                                          'size' => isset($size)?$size:20, 
                                          'class' => isset($class) ? $class : '') ,
                                    array('frequency' => '0.2', 
                                          'use_style' => false, 
                                          'min_chars' => sfConfig::get('app_autocomplete_min_chars'), 
                                          'after_update_element' => 'function (inputField, selectedItem) { $(\'location_id\').value = selectedItem.id; }')
  ) ?>
	
<?php echo input_hidden_tag('location_id', isset($location_id)?$location_id:'') ?>

<?php echo javascript_tag("
  Event.observe($('location'), 'focus', function(event) {
    if ($('location')._cleared) return;
    $('location').clear();
    $('location')._cleared = true;
  });
"); ?>