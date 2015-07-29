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
<?php echo input_auto_complete_tag('location2', __('Inserisci il nome del Comune'), '@location2_autocomplete',
  array('autocomplete' => 'off', 'size'=>'50', 'onfocus'=>'reset_location2_field()'),
  array('use_style' => true, 'min_chars' => sfConfig::get('app_autocomplete_min_chars'),
  'after_update_element' => 'function (inputField, selectedItem) { $(\'location_id2\').value = selectedItem.id; }')
) ?>

<?php echo input_hidden_tag('location_id2', '') ?>

<?php echo javascript_tag("function reset_location2_field()
{
  if ($('location2').value == '".__('Inserisci il nome del Comune')."')
  {
    $('location2').value='';	
  }
  return false;
}") 
?>