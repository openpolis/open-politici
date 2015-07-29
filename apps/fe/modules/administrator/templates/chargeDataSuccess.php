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
<?php echo use_helper('Javascript', 'Date', 'Object') ?>

<div id="showedit" style="text-align:left">
<?php echo form_tag('administrator/addCharge') ?>
<table class="politician_data">
<tbody>
<tr>
	<td colspan="2" align="center">
		<h3>
			<?php if($location_type): ?>
				<?php echo $location->getName() ?>&nbsp;&nbsp;(<?php echo $title ?>)
			<?php else: ?>
				<?php echo $institution->getName() ?>
			<?php endif; ?>
		</h3>
	</td>
</tr>
<tr>
	<td colspan="2">&nbsp;	</td>
</tr>
<tr>
	  	<th><?php echo __('Politico') ?>:</th>
		<td>
			<?php echo input_auto_complete_tag('politician', '', '@politician_autocomplete', 
												array('autocomplete' => 'off', 'size'=>'50'), 
												array('use_style' => 'true', 
												      'min_chars' => sfConfig::get('app_autocomplete_min_chars'), 
													  'after_update_element' => 'function (inputField, selectedItem) { $(\'pol_id\').value = selectedItem.id; }')) ?>
			<?php echo input_hidden_tag('pol_id', '') ?>
			<label>selezionare un politico dalla lista</label>
		</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>			
<tr>
		  <th><?php echo __('Carica') ?>:</th>
		  <td><?php echo select_tag('charge_type_id', objects_for_select(
  										$charge_list,
  										'getId',
  										'getName'
								)) ?>
			</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>
<tr>
	 <th><?php echo __('Partito') ?>:</th>
	  <td>
		<?php include_partial('polParties/partiesList', array('politician'=>null, 
																   'location_id'=>$location_id,
																   'primary_party_list'=>$primary_party_list,
																   'secondary_party_list'=>$secondary_party_list,
																   'death_party_list'=>$death_party_list,
																   'regional_party_list'=>$regional_party_list
																    )) ?>
	</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>
<?php if($sf_params->get('institution_id')): ?>
<tr>
	 <th><?php echo __('Gruppo') ?>:</th>
	  <td><?php echo select_tag('group_id', objects_for_select(
  										$group_list,
  										'getId',
  										'getName'
								)) ?>  
			  </td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>					
<?php endif; ?>
<tr>
	  <th><?php echo __('Data inizio') ?>:</th>
	  <td><?php echo input_date_tag('date_start', null, array('class' => 'calendar', 'year_start' => '1945')) ?></td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>
<tr>
	  <th><?php echo __('Data fine') ?>:</th>
	  <td><?php //echo input_date_tag('date_end', '', array('class' => 'calendar', 'year_start' => '1945')) ?>
	  <?php echo select_day_tag('date_end[day]', '', array('include_custom'=>'----', 'id'=>'date_end_day', 'class' => 'calendar')) ?>
		<?php echo select_month_tag('date_end[month]', '', array('include_custom'=>'-------', 'id'=>'date_end_month', 'class' => 'calendar')) ?>
		<?php echo select_year_tag('date_end[year]', '', array('include_custom'=>'-------', 
															   'id'=>'date_end_year', 
															   'class' => 'calendar',
															   'year_start' => '1945')
													) ?>
			</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>
<tr>
	  <th valign="top"><?php echo __('Descrizione') ?>:</th>
	  <td><?php echo textarea_tag('description', '', 'size=35x4') ?>
			</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>
<tr>
	<th><?php echo submit_tag(__('salva')); ?></th>
	<td><?php echo input_hidden_tag('location_type', $location_type) ?>	
		<?php echo input_hidden_tag('loc_id', $location_id) ?>
		<?php echo input_hidden_tag('institution_id', $institution_id) ?>
	</td>
</tr>	
</tbody>
</table>


</form>

</div>