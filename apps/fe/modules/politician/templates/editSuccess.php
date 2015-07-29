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
<?php echo use_helper('Javascript', 'Date', 'Validation', 'Object', 'InputDate') ?>

<?php
    if ($hasLayout == "false"){
    	$sf_view->setDecorator(false);
    }
?>
<div id="title">
<h1>Modifica dati anagrafici</h1>
</div>
<!-- #################### FINE TITOLO ####################  -->
<hr />
<div class="genericblock">
<div class="mask">

		
	<?php echo form_tag('politician/update', array('name'=>'mainForm', 'id'=>'mainForm', 'multipart'=>'true')) ?>
	
		<?php echo object_input_hidden_tag($politician, 'getContentId') ?>
		
		<?php 
			if($hasLayout == "false")
		    	echo input_hidden_tag('has_layout', $hasLayout) 
		?>
		
		<table border="0" cellspacing="0" cellpadding="0">
		
			<tr>
			  <td class="label"><?php echo __('Nome') ?>:</td>
			  <td><?php echo object_input_tag($politician, 'getFirstName', array (
			  'size' => 20,
			)) ?></td>
			</tr>
			
			<tr>
			  <td class="label"><?php echo __('Cognome') ?>:</td>
			  <td><?php echo object_input_tag($politician, 'getLastName', array (
			  'size' => 20,
			)) ?></td>
			</tr>
			
			<tr>
			  <td class="label"><?php echo __('Immagine') ?>:</td>
			  <td>
				<img src="/<?php echo sfConfig::get('sf_environment')=='dev'?'fe_dev.php/':''; ?>politician/picture?content_id=<?php echo $politician->getContentId() ?>" alt="<?php echo $politician->toString(); ?>" border="0" width="80" />
				<label for="delete"><?php echo __('cancella') ?>
				<?php echo checkbox_tag('delete', '1', false) ?>
				<br />
				<?php echo input_file_tag('picture_file') ?>
			  </td>
			</tr>
			
			<tr>
			  <td class="label"><?php echo __('Titolo di studio') ?>:</td>
			  <td><?php echo select_tag('education_level', objects_for_select(
  											$education_list,
  											'getId',
  											'getDescription',
  											$education_level->getEducationLevelId(),
  											array('include_custom'=>'--- seleziona ---')
								)) ?></td>
			</tr>
			
			<tr>
	 			<td class="label"><?php echo __('Descrizione titolo di studio') ?>:</td>
	  			<td><?php echo object_textarea_tag($education_level, 'getDescription', array('rows'=>'2', 'cols'=>'40')) ?></td>
			</tr>
			
			<tr>
			  <td class="label"><?php echo __('Professione') ?>:</td>
			  <td><?php echo select_tag('profession_id', objects_for_select(
  											$profession_list,
  											'getId',
  											'__toString',
  											$politician->getProfessionId(),
  											array('include_custom'=>'--- seleziona ---')
								)) ?></td>
			</tr>
			
			<tr>
			  <td class="label"><?php echo __('Data di nascita') ?>:</td>
			  <td>
			  	<?php if (form_has_error('birth_date')): ?>
					<?php echo form_error('birth_date') ?><br />
				<?php endif; ?>
			  	
				<?php $input_val = $politician->getBirthDate(); ?>
				<?php echo my_input_date_tag('birth_date', $input_val, 
				                              array('id' => 'birth_date', 
								                    'rich' => 'false', 
								                    'size' => '10',
								                    'culture' => 'it',
								                    'custom_setup' => 'ifFormat: "%d/%m/%Y", daFormat: "%d/%m/%Y", weekNumbers: false, range: [1900, '. date('Y') .']')) ?>	
				<span>&nbsp;(Usa il calendario o, manualmente, il formato gg/mm/aaaa)</span>
				</td>
			</tr>

			<tr>
			  <td class="label"><?php echo __('Luogo di nascita') ?>:</td>
			  <td><?php //echo object_input_tag($politician, 'getBirthLocation', array ('size' => 20,)) ?>
				<?php echo input_auto_complete_tag('location', $politician->getBirthLocation(), '@location_autocomplete', array('autocomplete' => 'off'), array('use_style' => 'true', 'min_chars' => sfConfig::get('app_autocomplete_min_chars'), 'after_update_element' => 'function (inputField, selectedItem) { $(\'location_id\').value = selectedItem.id; }')) ?>
<?php echo input_hidden_tag('location_id', '') ?>
			</td>
			</tr>
			
			<tr>
			  <td class="label"><?php echo __('Deceduto') ?>:</td>
			  <td>
			  	<?php echo checkbox_tag('check_for_death', 1, $politician->getDeathDate()!=NULL ? true : false, array('onclick'=>'toggleDeathDiv()')) ?>
				
				<div id="death_div" style="display:<?php echo ($politician->getDeathDate()!=NULL ? 'block' : 'none')?>">
					<?php if (form_has_error('death_date')): ?>
						<?php echo form_error('death_date') ?><br />
					<?php endif; ?>
				  	<label for="death_date"><b>Data di morte:&nbsp;</b></label>
					<?php $input_val = $politician->getDeathDate(); ?>
					<?php echo my_input_date_tag('death_date', $input_val, 
					                              array('id' => 'death_date', 
									                    'rich' => 'false', 
									                    'size' => '10',
									                    'culture' => 'it',
									                    'custom_setup' => 'ifFormat: "%d/%m/%Y", daFormat: "%d/%m/%Y", weekNumbers: false, range: [1900, '. date('Y') .']')) ?>	
					<span>&nbsp;(Usa il calendario o, manualmente, il formato gg/mm/aaaa)</span>
			
			  </td>
			</tr>
			<tr><td colspan="2">
			<?php 
		if ($hasLayout == 'false'){
			echo submit_to_remote('save', 'Save', array(
		    	'update'   => 'showedit',
		      	'url'      => 'politician/update',
			));
		} else {
			echo submit_tag('Salva', array('class'=>'cerca'));
		}
		?>		
		<?php if ($politician->getContentId()): ?>
			&nbsp;
			<?php
			if ($hasLayout == 'false'){
				echo link_to_remote('Annulla', array(
				'update' => 'showedit',
				'url'    => 'politician/show?has_layout=false&content_id='.$politician->getContentId(),
				));
			} else {
				echo link_to('Annulla', 
				'@politico_new?content_id='. $politician->getContentId() .'&slug='.$politician->getSlug()
				//'politician/page?content_id='.$politician->getContentId()
				);
			}
			?>
		<?php else: ?>
		  &nbsp;<?php echo link_to('cancel', 'politician/list') ?>
		<?php endif; ?>
		</tr></td>
		
		</table>
		
		

	</form>
	
	

</div>
</div>
<br />

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
