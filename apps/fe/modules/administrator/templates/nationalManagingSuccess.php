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

<div style="display:none">
<?php echo input_auto_complete_tag('location','', '@location_autocomplete', array('autocomplete' => 'off', 'onfocus'=>'reset_field()'), array('use_style' => 'true', 'min_chars' => sfConfig::get('app_autocomplete_min_chars'), 'after_update_element' => 'function (inputField, selectedItem) { $(\'location_id\').value = selectedItem.id; }')) ?>
</div>

<div style="text-align:right; margin-right:50px">
	<?php echo link_to('gestione dati', 'administrator/index'); ?>
</div>
	
<?php echo form_tag('administrator/nationalManaging') ?>
<div>
	<label style="float:left"><?php echo __('seleziona istituzione') ?>:&nbsp;</label>
		<?php echo select_tag('institution_id', options_for_select(array(
  			  sfConfig::get('app_institution_id_CE') =>	'Commissione europea',
  			  sfConfig::get('app_institution_id_PE') =>	'Parlamento europeo',
			  sfConfig::get('app_institution_id_PR') =>	'Presidente della Repubblica',
  			  sfConfig::get('app_institution_id_GI') =>	'Governo nazionale',
  			  sfConfig::get('app_institution_id_CD') =>	'Camera dei Deputati',
  			  sfConfig::get('app_institution_id_SR') =>	'Senato della Repubblica'
			))) ?>
	&nbsp;&nbsp;&nbsp;<?php echo submit_tag('OK') ?>
</div>
</form>

<div style="text-align:center;">
<?php if($sf_params->get('institution_id')): ?>
<?php echo form_tag('administrator/updateManaging') ?>
<table class="admin_institution_table">
<tr>
	<th colspan="7" align="center">
		<span>
			<?php echo $institution->getName() ?>
		</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $edit_link_options = array(
						'title' => 'assegna incarico a politico',
						'class' => 'new blocksize_600x400'
					);    
				echo light_modallink('assegna incarico a politico', 'administrator/chargeData?institution_id='.$institution->getId(), $edit_link_options); ?>
		</th>
</tr>
<?php if($politicians): ?>
<tr>
	<th>politico</th>
	<th>carica</th>
	<th>partito</th>
	<th>gruppo</th>
	<th>circ. elettorale</th>
	<th>periodo</th>
	<th>modificato</th>
</tr>
<?php endif; ?>
<?php foreach($pager->getResults() as $politician): ?>
<tr>
	<td>
		<?php $edit_link_options = array(
						'title' => $politician->getDescription(),
						'class' => 'new blocksize_600x600'
					);    
				echo light_modallink($politician->getOpPolitician()->getLastName().'<br />'.$politician->getOpPolitician()->getFirstName(), 'administrator/politicianData?content_id='.$politician->getOpPolitician()->getContentId().'&institution_id='.$institution->getId(), $edit_link_options); ?>
	</td>
	<td>
		<?php echo select_tag('charge_type_id_'.$politician->getContentId(), objects_for_select(
  											$charge_list,
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
																   'regional_party_list'=>null,
																   'cont'=>$cont
																    )) ?>
	</td>
	
	<td>
		<?php include_partial('polGroups/groupsList', array('politician'=>$politician, 
																   'location_id'=>$location_id,
																   'primary_group_list'=>$primary_group_list,
																   'regional_group_list'=>null,
																   'cont'=>$cont
																    )) ?>
	</td>
	
	<td>
		<?php echo select_tag('constituency_id_'.$politician->getContentId(), objects_for_select(
  											$constituency_list,
  											'getId',
  											'getName',
  											$politician->getConstituencyId(),
											array('include_custom'=>'--- seleziona ---')
								), array('onchange' => 'func1(\''.$cont.'\')')) ?>
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
<?php if ($pager->haveToPaginate()): ?>
<tr>
	<th colspan="6">
	  <?php if ($pager->getPage() != 1): ?>	
		 <?php echo link_to('&laquo;', 'administrator/nationalManaging?institution_id='.$institution->getId().'&page='.$pager->getFirstPage()) ?>
	    <?php echo link_to('&lt;', 'administrator/nationalManaging?institution_id='.$institution->getId().'&page='.$pager->getPreviousPage()) ?>
	  <?php endif; ?>
	  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
		<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'administrator/nationalManaging?institution_id='.$institution->getId().'&page='.$page) ?>
		<?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif; ?>
	  <?php endforeach; ?>
	  <?php if ($pager->getPage() != $pager->getCurrentMaxLink()): ?>
	    <?php echo link_to('&gt;', 'administrator/nationalManaging?institution_id='.$institution->getId().'&page='.$pager->getNextPage()) ?>
	    <?php echo link_to('&raquo;', 'administrator/nationalManaging?institution_id='.$institution->getId().'&page='.$pager->getLastPage()) ?>
	  <?php endif; ?>		
	</th>
</tr>
<?php endif; ?>
<?php echo input_hidden_tag('cont', $cont) ?> 
<?php echo input_hidden_tag('institution_id', $institution->getId()) ?>
<?php echo input_hidden_tag('page', $pager->getPage()) ?>
<tr>
	<th colspan="6"></th>
	<th><?php echo submit_tag('aggiorna') ?></th>
</tr>
</table>
</form>
<?php endif; ?>
</div>

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