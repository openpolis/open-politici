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

<div id="showedit">
	<?php echo form_tag('administrator/updateExistingGroup') ?>
		<table class="politician_data">
			<tbody>
				<tr>
					<th colspan="2" align="center">
						<h2><?php echo $location->getName() ?></h2>
					</th>
					
				</tr>
				<tr>
					<th valign="top"><?php echo __('gruppi gi&agrave; presenti') ?>:</th>
					<td><?php foreach($groups as $group): ?>
						<b><?php echo $group->getName() ?></b><br />
					<?php endforeach; ?>
					</td>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<td></td>
				</tr>
				<tr>
					<th><?php echo('seleziona un gruppo') ?>:</th>
					<td><?php echo include_partial('autocompleter/groupAutocompleter', array('script' => 'true')) ?></td>
				</tr>
				<tr>
					<th><?php echo submit_tag(__('aggiungi')); ?></th>
					<td>
						<?php echo input_hidden_tag('location_id', $location_id) ?>
						<?php echo input_hidden_tag('location_type', $location_type) ?>
					</td>
				</tr>		
			</tbody>
		</table>
	</form>
</div>