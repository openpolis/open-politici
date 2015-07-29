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

<?php echo form_tag('administrator/partyManaging') ?>
<b><?php echo __('filtra i partiti in base alla localit&agrave;') ?>:</b><br />
<div style="width:200px; float:left">
	<p class="political_charge">
		<label><?php echo __('tutti') ?>:&nbsp;</label>
		<?php echo radiobutton_tag('location_type', 'all', (!$sf_params->get('location_type') || $sf_params->get('location_type') == 'all' ? true : false), array('onchange' => 'loc1(\'all\')')) ?>
	</p>
	<p class="political_charge">
		<label><?php echo __('europa') ?>:&nbsp;</label>
		<?php echo radiobutton_tag('location_type', 'europe', ($sf_params->get('location_type') == 'europe' ? true : false), array('onchange' => 'loc1(\'europe\')')) ?>
	</p>
	<p class="political_charge">
		<label><?php echo __('italia') ?>:&nbsp;</label>
		<?php echo radiobutton_tag('location_type', 'italy', ($sf_params->get('location_type') == 'italy' ? true : false), array('onchange' => 'loc1(\'italy\')')) ?>
	</p>
	<p class="political_charge">
		<label><?php echo __('regione') ?>:&nbsp;</label>
		<?php echo radiobutton_tag('location_type', 'region', ($sf_params->get('location_type') == 'region' ? true : false), array('onchange' => 'loc1(\'region\')')) ?>
	</p>
	<p class="political_charge">
		<label><?php echo __('provincia') ?>:&nbsp;</label>
		<?php echo radiobutton_tag('location_type', 'provincial', ($sf_params->get('location_type') == 'provincial' ? true : false), array('onchange' => 'loc1(\'provincial\')')) ?>
	</p>
	<p class="political_charge">
		<label><?php echo __('comune') ?>:&nbsp;</label>
		<?php echo radiobutton_tag('location_type', 'municipal', ($sf_params->get('location_type') == 'municipal' ? true : false), array('onchange' => 'loc1(\'municipal\')')) ?>
	</p>		
</div>

<div id="reg" style="display:<?php echo $sf_params->get('location_type') == 'region' ? 'block' : 'none' ?>; float:left">
	<?php include_component('location', 'regions') ?>
</div>
<div id="prov" style="display:<?php echo $sf_params->get('location_type') == 'provincial' ? 'block' : 'none' ?>; float:left">
	<?php include_component('location', 'provincials') ?>
</div>
<div id="mun" style="display:<?php echo $sf_params->get('location_type') == 'municipal' ? 'block' : 'none' ?>; float:left">
	<?php echo include_partial('autocompleter/locationAutocompleter', array('script' => 'true')) ?>
</div>
<div>
	&nbsp;&nbsp;&nbsp;<?php echo submit_tag('OK') ?>
</div>
</form>

<div id="charge_list" style="clear:left; margin-top:50px">
<table class="admin_institution_table">

<tr>
	<th colspan="5" align="center">
	<?php if($sf_params->get('location_type') && $sf_params->get('location_type')!= 'all' ): ?>
		<b>
			<?php echo $location->getName() ?>
			<?php if($sf_params->get('location_type') == 'municipal'): ?>
				&nbsp;(<?php echo $location->getProv() ?>)
			<?php elseif ($sf_params->get('location_type') == 'provincial'): ?>	
				&nbsp;(<?php echo __('provincia') ?>)
			<?php endif; ?>
		</b>
	<?php endif; ?>
	</th>
</tr>
<tr>	
	<th colspan="2">
		<?php if($location_type != 'all'): ?>
			<?php $edit_link_options = array(
						'title' => 'aggiungi partito gi&agrave; nel db',
						'class' => 'new blocksize_400x250',
					);    
				echo light_modallink('aggiungi partito gi&agrave; nel db', 'administrator/existingParty?location_id='.$location_id.'&location_type='.$location_type, $edit_link_options); ?>
		<?php endif; ?>
	</th>
	<th></th>
	<th colspan="2">
		<?php $edit_link_options = array(
						'title' => 'aggiungi nuovo partito',
						'class' => 'new blocksize_400x250'
					);    
				echo light_modallink('aggiungi nuovo partito', 'administrator/partyData?location_id='.$location_id, $edit_link_options); ?>
	</th>
</tr>
<tr>	
	<th>nome</th>
	<th>acronimo</th>
	<th>codice istat</th>
	<th>lista/partito</th>
	<th>principale</th>
</tr>
<?php foreach($pager->getResults() as $party): ?>
<tr>
	<td>
		<?php $edit_link_options = array(
						'title' => $party->getName(),
						'class' => 'new blocksize_400x250'
					);    
				echo light_modallink($party->getName(), 'administrator/partyData?id='.$party->getId().'&location_id='.$location_id, $edit_link_options); ?>
	</td>
	<td><?php echo $party->getAcronym() ?></td>
	<td><?php echo $party->getIstatCode() ?></td>
	<td><?php echo $party->getParty() ?></td>
	<td><?php echo $party->getMain() ?></td>
</tr>
<?php endforeach; ?>
<?php if ($pager->haveToPaginate()): ?>
<tr>
	<th colspan="4">
	  <?php if ($pager->getPage() != 1): ?>	
		 <?php echo link_to('&laquo;', 'administrator/partyManaging?page='.$pager->getFirstPage()) ?>
	    <?php echo link_to('&lt;', 'administrator/partyManaging?page='.$pager->getPreviousPage()) ?>
	  <?php endif; ?>
	  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
		<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'administrator/partyManaging?page='.$page) ?>
		<?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif; ?>
	  <?php endforeach; ?>
	  <?php if ($pager->getPage() != $pager->getCurrentMaxLink()): ?>
	    <?php echo link_to('&gt;', 'administrator/partyManaging?page='.$pager->getNextPage()) ?>
	    <?php echo link_to('&raquo;', 'administrator/partyManaging?page='.$pager->getLastPage()) ?>
	  <?php endif; ?>		
	</th>
</tr>
<?php endif; ?>
</table>
</div>

<?php echo javascript_tag("function loc1(loc_type)
{
	switch(loc_type)
	{
		case 'all':
		case 'europe':
		case 'italy':
			$('location_id').value='';
			if (Element.visible('reg'))
  			{
    			Element.hide('reg');
  			}
			if (Element.visible('prov'))
  			{
    			Element.hide('prov');
  			}
			if (Element.visible('mun'))
  			{
    			Element.hide('mun');
  			}
			break;
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
