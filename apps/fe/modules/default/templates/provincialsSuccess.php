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
<?php echo form_tag('politician/provPoliticians', array('id'=>'prov_form', 'name'=>'prov_form')); ?>
	<label for="location_id"><?php echo __('provincia'); ?>:&nbsp;</label>
	<select id="location_id" name="location_id" onchange="upload_com(this[this.selectedIndex].value)">
		<option value=""></option>
		<?php  
			foreach($provincials as $provincial)
			{
			?>
				<option value="<?php echo $provincial->GetId() ?>">
					<?php echo $provincial->GetName() ?>
				</option>
			<?php
			}
			?>
	</select>
	
	<?php echo submit_tag(__('Select'), array('id' =>'prov_select', 'name'=>'prov_select')); ?>
</form>
	
