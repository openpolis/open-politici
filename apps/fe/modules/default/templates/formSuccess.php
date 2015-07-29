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
<?php echo use_helper('Javascript') ?>
<div style="display:none">
<?php echo input_auto_complete_tag('location', '', '@location_autocomplete', array('autocomplete' => 'off'), array('use_style' => 'true', 'min_chars' => sfConfig::get('app_autocomplete_min_chars'), 'after_update_element' => 'function (inputField, selectedItem) { $(\'location_id\').value = selectedItem.id; }')) ?>
</div>			

<div style="text-align:right">
	<?php echo link_to('close', '#', array('class'=>'lbAction', 'rel'=>'deactivate')) ?>
</div>

<?php echo form_tag('default/choice1') ?>
	
	<div style="padding-left:20px">	
		<p>
			<label for="first_name"><?php echo __('Nome: '); ?></label><br />
			<?php echo input_tag('first_name', '') ?>
		</p>

		<p>
			<label for="last_name"><?php echo __('Cognome: '); ?></label><br />
			<?php echo input_tag('last_name', '') ?>
		</p>
		
		<!--<p>
			<label for="date"><?php echo __('Date: '); ?></label><br />
			<?php echo input_date_tag('date', '', 'rich=true') ?>
		</p> -->
		
		<p>
			<label for="location"><?php echo __('localit&agrave;: '); ?></label><br />
			<?php echo input_auto_complete_tag('location', '', '@location_autocomplete', array('autocomplete' => 'off'), array('use_style' => 'true', 'min_chars' => sfConfig::get('app_autocomplete_min_chars'), 'after_update_element' => 'function (inputField, selectedItem) { $(\'location_id\').value = selectedItem.id; }')) ?>
			<?php echo input_hidden_tag('location_id', '') ?>
		</p>
		
		<p>
			<?php echo submit_tag('invia', array('class'=>'lbAction', 'rel'=>'insert')) ?>
		</p>
	</div>	
	
</form>
<?php echo $sf_params->get('id') ?>