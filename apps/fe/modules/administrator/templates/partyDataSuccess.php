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
<?php echo form_tag('administrator/partyUpdate') ?>
<table class="politician_data">
<tbody>
<tr>
	  	<th colspan="2" align="center">
			<?php if($location_id != 0): ?>
				<h2><?php echo $location->getName() ?></h2>
			<?php endif; ?>
		</th>
		
</tr>
<tr>
	  	<th><?php echo __('Nome') ?>:</th>
		<td><?php echo object_input_tag($party, 'getName', array (
			  'size' => 30,
				)) ?>
		</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>				
<tr>
		  <th><?php echo __('Acronimo') ?>:</th>
		  <td><?php echo object_input_tag($party, 'getAcronym', array (
			  'size' => 20,
				)) ?>
			</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>	
<tr>
		  <th><?php echo __('Codice ISTAT') ?>:</th>
		  <td><?php echo object_input_tag($party, 'getIstatCode', array (
			  'size' => 20,
				)) ?>
			</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>
<tr>
		  <th valign="top"><?php echo __('Natura') ?>:</th>
		  <td><?php echo object_checkbox_tag($party, 'getParty') ?>
		  <label>0 => lista (per le cariche istituzionali<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 => partito (per le cariche politiche)</label>		 		  </td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>
<tr>
		  <th valign="top"><?php echo __('Tipo') ?>:</th>
		  <td>
		  	<?php echo select_tag('main', options_for_select(array(
				  '1' => 'Principale',
				  '2' => 'Secondario',
				  '3' => 'Locale',
				  '4' => 'Estinto' 
				), $party->getMain(), array('include_custom'=>'--- seleziona ---'))) ?>	
		  </td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>
<tr>
	<th><?php echo submit_tag(__('salva')); ?></th>
	<td><?php echo input_hidden_tag('party_id', $party->getId()) ?>
	<?php echo input_hidden_tag('location_id', $location_id) ?>
	</td>
</tr>					
</tbody>
</table>