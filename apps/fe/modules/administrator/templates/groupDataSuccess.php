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
<?php echo form_tag('administrator/groupUpdate') ?>
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
		<td><?php echo object_input_tag($group, 'getName', array (
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
		  <td><?php echo object_input_tag($group, 'getAcronym', array (
			  'size' => 20,
				)) ?>
			</td>
</tr>
<tr>
	<td colspan="2">&nbsp;
		
	</td>
</tr>	
<tr>
	<th><?php echo submit_tag(__('salva')); ?></th>
	<td><?php echo input_hidden_tag('group_id', $group->getId()) ?>
	<?php echo input_hidden_tag('location_id', $location_id) ?>
	</td>
</tr>					
</tbody>
</table>