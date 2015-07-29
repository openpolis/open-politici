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
<?php echo form_tag('politician/munPoliticians'); ?>
<label for="location_id"><?php echo __('comune'); ?>:&nbsp;</label>
<select id="location_id" name="location_id">
	<?php  
		foreach($comuns as $comun)
		{
		?>
			<option value="<?php echo $comun->GetId() ?>">
				<?php echo $comun->GetName() ?>
			</option>
	    <?php
		}
		?>
</select>

<?php echo submit_tag(__('Select'), array('id' =>'com_select', 'name'=>'com_select')); ?>
</form>
