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
<?php $valore = isset($value)?$value:'Inserisci il nome del politico'; ?>
<?php echo input_auto_complete_tag('politician', isset($politician)?$politician:$valore,
                                   '@politician_autocomplete', 
                                   array('autocomplete' => 'off', 'class' => isset($class)?$class:'', 'size' => isset($size)?$size:20),
                                   array('frequency' => '0.2', 'use_style' => false, 
                                         'min_chars' => sfConfig::get('app_autocomplete_min_chars'),
                                   'after_update_element' => 'function (inputField, selectedItem) { $(\'politician_id\').value = selectedItem.id; }')
) ?>

<?php echo input_hidden_tag('politician_id', isset($politician_id)?$politician_id:'') ?>

<?php echo javascript_tag("
  Event.observe($('politician'), 'focus', function(event) {
    if ($('politician')._cleared) return;
    $('politician').clear();
    $('politician')._cleared = true;
  });
"); ?>