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
<?php use_helper('Javascript') ?>

<!--<div>
<?php echo include_partial('autocompleter/locationAutocompleter', array('script' => 'true')) ?>
</div>	 -->	
<?php 
if($location_type_id != 6)
{
?>
	<select id="location_id" name="location_id">
			<?php  
			foreach($locations as $location)
			{
			?>
				<option value="<?php echo $location->GetId() ?>">
					<?php echo $location->GetName() ?>
				</option>
			<?php
			}
			?>
	</select>
<?php
}
else
{
?>

<?php echo include_partial('autocompleter/locationAutocompleter', array('script' => 'true')) ?>

<?php //echo input_auto_complete_tag('location', '', '@location_autocomplete', array('script', 'true', 'autocomplete' => 'off', 'use_style' => 'true', 'min_chars' => sfConfig::get('app_autocomplete_min_chars'), 'after_update_element' => 'function (inputField, selectedItem) { $(\'location_id\').value = selectedItem.id; }'));
//echo input_hidden_tag('location_id', ''); 
?>

<?php 
}
?>