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
<?php echo use_helper('Javascript', 'Object', 'Global', 'Validation', 'Lightbox') ?>

<?php echo form_tag('administrator/locationManaging') ?>
<div style="width:200px; float:left">
	<p class="political_charge">
		<label><?php echo __('regione') ?>:&nbsp;</label>
		<?php echo radiobutton_tag('location_type', 'region', true, array('onchange' => 'loc1(\'region\')')) ?>
	</p>
	<p class="political_charge">
		<label><?php echo __('provincia') ?>:&nbsp;</label>
		<?php echo radiobutton_tag('location_type', 'provincial', false, array('onchange' => 'loc1(\'provincial\')')) ?>
	</p>
	<p class="political_charge">
		<label><?php echo __('comune') ?>:&nbsp;</label>
		<?php echo radiobutton_tag('location_type', 'municipal', false, array('onchange' => 'loc1(\'municipal\')')) ?>
	</p>		
</div>



<div id="reg" style="float:left">
	<?php include_component('location', 'regions') ?>
</div>
<div id="prov" style="display:none; float:left">
	<?php include_component('location', 'provincials') ?>
</div>
<div id="mun" style="display:none; float:left">
	<?php echo include_partial('autocompleter/locationAutocompleter', array('script' => 'true')) ?>
</div>
<div>
	&nbsp;&nbsp;&nbsp;<?php echo submit_tag('OK') ?>
</div>
</form>

<?php if($sf_params->get('location_type')): ?>
<?php echo form_tag('administrator/updateManaging') ?>
<div id="charge_list" style="clear:left; margin-top:50px">

<table class="admin_table">
<tr>
	<th colspan="6" align="center">
		<span>
			<?php echo $location->getName() ?>
		</span>&nbsp;(<?php echo $title1 ?>)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php $edit_link_options = array(
						'title' => 'assegna incarico a politico',
						'class' => 'new blocksize_600x400'
					);    
				echo light_modallink('assegna incarico a politico', 'administrator/chargeData?institution_id='.$id1.'&location_type='.$location_type.'&location_id='.$location_id, $edit_link_options); ?>
	</th>
</tr>
<?php if($politicians): ?>
<tr>
	<th>politico</th>
	<th>carica</th>
	<th>partito</th>
	<th>gruppo</th>
	<th>periodo</th>
	<th>modificato</th>
</tr>
<?php endif; ?>
<?php foreach($politicians as $politician): ?>
<tr>
	<td>
		<?php $edit_link_options = array(
						'title' => $politician->getDescription(),
						'class' => 'new blocksize_600x600'
					);    
				echo light_modallink($politician->getOpPolitician()->getLastName().' '.$politician->getOpPolitician()->getFirstName(), 'administrator/politicianData?content_id='.$politician->getOpPolitician()->getContentId().'&location_type='.$location_type.'&location_id='.$location_id, $edit_link_options); ?>
	</td>
	<td>
		<?php echo select_tag('charge_type_id_'.$politician->getContentId(), objects_for_select(
  											$charge_list1,
  											'getId',
  											'getName',
  											$politician->getChargeTypeId()
								), array('onchange' => 'func1(\''.$cont.'\')')) ?>
	</td>
	
	<td>
		<?php include_partial('polParties/partiesList', array('politician'=>$politician, 
																   'location_id'=>$location_id,
																   'primary_party_list'=>$primary_party_list,
																   'secondary_party_list'=>$secondary_party_list,
																   'death_party_list'=>$death_party_list,
																   'regional_party_list'=>$regional_party_list,
																   'cont'=>$cont
																    )) ?>
	</td>
	
	<td>
		<?php include_partial('polGroups/groupsList', array('politician'=>$politician, 
																   'location_id'=>$location_id,
																   'primary_group_list'=>$primary_group_list,
																   'regional_group_list'=>$regional_group_list,
																   'cont'=>$cont
																    )) ?>
	</td>
	<td>
		<?php echo input_date_tag('date_start_'.$politician->getContentId(), $politician->getDateStart(), array('class' => 'calendar', 'rich' => 'true', 'onchange' => 'func1(\''.$cont.'\')')) ?><br />
		<?php echo input_date_tag('date_end_'.$politician->getContentId(), $politician->getDateEnd(), array('class' => 'calendar','rich' => 'true', 'onchange' => 'func1(\''.$cont.'\')')) ?>
	</td>
	<td align="center">
		<?php echo checkbox_tag('update_'.$cont, $politician->getContentId(), false) ?>
	</td>
</tr>
<?php $cont++ ?>
<?php endforeach; ?>


<tr>
	<th colspan="6">&nbsp;</th>
</tr>

<tr>
	<th colspan="6" align="center">
		<span>
			<?php echo $location->getName() ?></span>
			&nbsp;(<?php echo $title2 ?>)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php $edit_link_options = array(
						'title' => 'assegna incarico a politico',
						'class' => 'new blocksize_600x400'
					);    
				echo light_modallink('assegna incarico a politico', 'administrator/chargeData?institution_id='.$id2.'&location_type='.$location_type.'&location_id='.$location_id, $edit_link_options); ?>
	</th>
</tr>
<?php if($politicians2): ?>
<tr>
	<th>politico</th>
	<th>carica</th>
	<th>partito</th>
	<th>gruppo</th>
	<th>periodo</th>
	<th>modificato</th>
</tr>
<?php endif; ?>	
<?php foreach($politicians2 as $politician): ?>
<tr>
	<td>
		<?php $edit_link_options = array(
						'title' => $politician->getDescription(),
						'class' => 'new blocksize_600x600'
					);    
				echo light_modallink($politician->getOpPolitician()->getLastName().'<br />'.$politician->getOpPolitician()->getFirstName(), 'administrator/politicianData?content_id='.$politician->getOpPolitician()->getContentId().'&location_type='.$location_type.'&location_id='.$location_id, $edit_link_options); ?>
	</td>
	
	<td>
		<?php echo select_tag('charge_type_id_'.$politician->getContentId(), objects_for_select(
  											$charge_list2,
  											'getId',
  											'getName',
  											$politician->getChargeTypeId()
								), array('onchange' => 'func1(\''.$cont.'\')')) ?>
	</td>
	
	<td>
		<?php include_partial('polParties/partiesList', array('politician'=>$politician, 
																   'location_id'=>$location_id,
																   'primary_party_list'=>$primary_party_list,
																   'secondary_party_list'=>$secondary_party_list,
																   'death_party_list'=>$death_party_list,
																   'regional_party_list'=>$regional_party_list,
																   'cont'=>$cont
																    )) ?>
	</td>
	
	<td>
		<?php include_partial('polGroups/groupsList', array('politician'=>$politician, 
																   'location_id'=>$location_id,
																   'primary_group_list'=>$primary_group_list,
																   'regional_group_list'=>$regional_group_list,
																   'cont'=>$cont
																    )) ?>
	</td>
	<td>
		<?php echo input_date_tag('date_start_'.$politician->getContentId(), $politician->getDateStart(), array('class' => 'calendar','rich' => 'true', 'onchange' => 'func1(\''.$cont.'\')')) ?><br />
    	<?php echo input_date_tag('date_end_'.$politician->getContentId(), $politician->getDateEnd(), array('class' => 'calendar','rich' => 'true', 'onchange' => 'func1(\''.$cont.'\')')) ?>
	</td>
	<td align="center">
		<?php echo checkbox_tag('update_'.$cont, $politician->getContentId(), false) ?>
	</td>
</tr>
<?php $cont++ ?>
<?php endforeach; ?>

<?php echo input_hidden_tag('cont', $cont) ?> 
<tr>
	<th colspan="5"></th>
	<th><?php echo submit_tag('aggiorna') ?></th>
</tr>
</table>
</div>
<?php echo input_hidden_tag('location_type', $location_type) ?>
<?php echo input_hidden_tag('location_id', $location_id) ?>
</form>
<?php endif; ?>


<?php echo javascript_tag("function func1(content_id)
{
	checkbox = $('update_'+content_id);
	checkbox.checked = true;

}") ?>

<?php echo javascript_tag("function reset_field()
{
  	$('location').value='';	
   	
	return false;
}") 
?>

<?php echo javascript_tag("function loc1(loc_type)
{
	switch(loc_type)
	{
		case 'region':
			$('location_id').value='';
			if (Element.visible('prov'))
  			{
    			Element.hide('prov');
  			}
			if (Element.visible('mun'))
  			{
    			Element.hide('mun');
  			}
			".visual_effect('BlindDown', 'reg', array('duration' => 0.4 ))."
			break;
		case 'provincial':
			$('location_id').value='';
			if (Element.visible('reg'))
  			{
    			Element.hide('reg');
  			}
			if (Element.visible('mun'))
  			{
    			Element.hide('mun');
  			}
			".visual_effect('BlindDown', 'prov', array('duration' => 0.4 ))."
			break;
		case 'municipal':
			$('location_id').value='';
			if (Element.visible('reg'))
  			{
    			Element.hide('reg');
  			}
			if (Element.visible('prov'))
  			{
    			Element.hide('prov');
  			}
			".visual_effect('BlindDown', 'mun', array('duration' => 0.4 ))."
			break;
		default:
			Element.hide('reg');
			Element.hide('prov');
			Element.hide('mun');		
			
	}
	
  	return false;
}") ?>