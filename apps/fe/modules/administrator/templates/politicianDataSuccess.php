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
<?php echo use_helper('Javascript', 'Date', 'DateForm', 'Object') ?>

<div id="showedit" style="text-align:left">
<?php echo form_tag('administrator/politicianDataUpdate', 'multipart=true') ?>
<?php echo object_input_hidden_tag($politician, 'getContentId') ?>
<table class="politician_data">
<tbody>
<tr>
	  	<th><?php echo __('Nome') ?>:</th>
		<td><?php echo object_input_tag($politician, 'getFirstName', array (
			  'size' => 20,
				)) ?>
		</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>				
<tr>
		  <th><?php echo __('Cognome') ?>:</th>
		  <td><?php echo object_input_tag($politician, 'getLastName', array (
			  'size' => 20,
				)) ?>
			</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>	
<tr>
		  <th><?php echo __('Sesso') ?>:</th>
		  <td><?php echo select_tag('sex', options_for_select(array(
				  'M'  => 'Uomo',
				  'F'    => 'Donna'), $politician->getSex(), array('include_custom' => '-- Scegli --'))) ?>
			</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>	

<tr>
	  <th><?php echo __('Foto') ?>:</th>
	  <td>
			<?php if ($politician->getPicture()): ?>	  
				<img src="/<?php echo sfConfig::get('sf_environment')=='dev'?'fe_dev.php/':''; ?>politician/picture?content_id=<?php echo $politician->getContentId() ?>" alt="<?php echo $politician->toString(); ?>" style="width:60px; height:80px; border:none" />
		<label for="delete"><?php echo __('cancella') ?>
		<?php echo checkbox_tag('delete', '1', false) ?>
		<br />
			<?php endif; ?>
		<?php echo input_file_tag('picture_file') ?>
	   </td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>
<tr>
	 <th><?php echo __('Grado d\'istruzione') ?>:</th>
	  <td><?php echo select_tag('education_level', objects_for_select(
  											$education_list,
  											'getId',
  											'getDescription',
  											$education_level->getEducationLevelId(),
  											array('include_custom' => '-- Scegli --')
								)) ?>	  
			  </td>
</tr>
<tr>
	 <th valign="top"><?php echo __('Descrizione') ?>:</th>
	  <td><?php echo object_textarea_tag($education_level, 'getDescription', array('size=20x2')) ?>	
	  </td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>		
<tr>
	 <th><?php echo __('Professione') ?>:</th>
	  <td><?php echo select_tag('profession_id', objects_for_select(
  											$profession_list,
  											'getId',
  											'toString',
  											$politician->getProfessionId()
								)) ?>	  
			  </td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>				
<tr>
	  <th><?php echo __('Data di nascita') ?>:</th>
	  <td>
	    <?php echo select_day_tag('birth_date[day]', $politician->isNew()?0:$politician->getBirthDate('d'), array('include_custom' => 'Giorno')) ?>
	    <?php echo select_month_tag('birth_date[month]', $politician->isNew()?0:$politician->getBirthDate('m'), array('include_custom' => 'Mese')) ?>
	    <?php echo select_year_tag('birth_date[year]', $politician->isNew()?0:$politician->getBirthDate('Y'), array('include_custom' => 'Anno', 'year_end' => date('Y'), 'year_start' => '1900')) ?>
		</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>
<tr>
	  <th><?php echo __('Luogo di nascita') ?>:</th>
	  <td>
<?php echo input_auto_complete_tag('location',$politician->getBirthLocation(), '@location_autocomplete', array('autocomplete' => 'off', 'onfocus'=>'reset_field()'), array('use_style' => 'true', 'min_chars' => sfConfig::get('app_autocomplete_min_chars'), 'after_update_element' => 'function (inputField, selectedItem) { $(\'location_id\').value = selectedItem.id; }')) ?>
<?php echo input_hidden_tag('location_id', '') ?>
</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>

<tr>
  <th valign="top"><?php echo __('Deceduto') ?>:</th>
	<td>
		<?php echo checkbox_tag('check_for_death', 1, $politician->getDeathDate()!=NULL ? true : false, array('onclick'=>'toggleDeathDiv()')) ?>
		
		<div id="death_div" style="display:<?php echo ($politician->getDeathDate()!=NULL ? 'block' : 'none')?>">
			<br />
			<label for="death_date"><b>Data di morte:&nbsp;</b></label>
			<?php echo object_input_date_tag($politician, 'getDeathDate', array (
				  'rich' => false,
				  'withtime' => false
				  )) ?>
		</div>		  
	</td>
</tr>
	
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>
<tr>
	  	<th><?php echo __('Email ufficiale') ?>:</th>
		<td><?php echo object_input_tag($email, 'getValore', array (
		      'id' => 'email',
			  'name' => 'email', 
			  'size' => 30,
				)) ?>
			<?php echo input_hidden_tag('email_id', $email->getContentId()) ?>		
		</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>
<tr>
	  	<th><?php echo __('Url ufficiale') ?>:</th>
		<td><?php echo object_input_tag($url, 'getValore', array (
			  'id' => 'url',
			  'name' => 'url',	
			  'size' => 70,
				)) ?>
			<?php echo input_hidden_tag('url_id', $url->getContentId()) ?>	
		</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>		
<tr>
	<th><?php echo submit_tag(__('salva')); ?></th>
	<td><?php echo input_hidden_tag('location_type', $location_type) ?>	
		<?php echo input_hidden_tag('institution_location_id', $institution_location_id) ?>
		<?php echo input_hidden_tag('institution_id', $institution_id) ?>
	</td>
</tr>	
</tbody>
</table>


</form>

</div>

<script type="text/javascript">
//<![CDATA[
function toggleDeathDiv()
{
  div = 'death_div';	
  if (Element.visible(div))
  {
    new Effect.BlindUp(div, {duration:0.4});
  }
  else
  {
    new Effect.BlindDown(div, {duration:0.4});
  }

  return false;
}
//]]>
</script>