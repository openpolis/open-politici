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
<?php //echo form_tag('politician/regPoliticians', array('id'=>'region_form', 'name'=>'region_form')); ?>
<?php echo form_remote_tag(array(
    'update'   => 'charges',
    'url'      => 'administrator/addCharges',
	'script'   => true
)) ?>
<label for="location_id"><?php echo __('regione'); ?>:&nbsp;</label>
<select id="location_id" name="location_id" onchange="upload_prov(this[this.selectedIndex].value)">
		<option value="" selected="selected"></option>
		<?php  
		foreach($regions as $region)
		{
		?>
			<option value="<?php echo $region->GetId() ?>">
				<?php echo $region->GetName() ?>
			</option>
	    <?php
		}
		?>
</select>
<input type="hidden" id="location_type" name="location_type" value="region" />
<?php echo submit_tag(__('seleziona'), array('id' =>'reg_select', 'name'=>'reg_select')); ?>

</form>