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
<?php if($politician): ?>
	<?php $party_id = $politician->getPartyId() ?>
	<select id="party_id_<?php echo $politician->getContentId() ?>" name="party_id_<?php echo $politician->getContentId() ?>" onchange="func1('<?php echo $cont ?>')">
<?php else: ?>
	<?php $party_id = 0 ?>
	<select id="party_id" name="party_id">
<?php endif; ?>
  	
	<option value="1">non specificato</option>
	
	<optgroup label="--- partiti principali ---">
		<?php foreach ($primary_party_list as $primary_party): ?>
			<option value="<?php echo $primary_party->getId() ?>" <?php echo($party_id==$primary_party->getId() ? "selected" : "") ?>>
				<?php echo $primary_party->getName() ?>
			</option>
		<?php endforeach; ?> 
	</optgroup>
	
	<optgroup label="--- partiti secondari ---">
		<?php foreach ($secondary_party_list as $secondary_party): ?>
			<option value="<?php echo $secondary_party->getId() ?>" <?php echo($party_id==$secondary_party->getId() ? "selected" : "") ?>>
				<?php echo $secondary_party->getName() ?>
			</option>
		<?php endforeach; ?> 
	</optgroup>
	
	<?php if($location_id!=1 && $location_id!=2): ?>
		<optgroup label="--- partiti locali ---">
			<?php foreach ($regional_party_list as $regional_party): ?>
				<option value="<?php echo $regional_party->getId() ?>" <?php echo($party_id==$regional_party->getId() ? "selected" : "") ?>>
					<?php echo $regional_party->getName() ?>
				</option>
			<?php endforeach; ?> 
		</optgroup>
	<?php endif; ?>
	
	<optgroup label="--- partiti estinti ---">
		<?php foreach ($death_party_list as $death_party): ?>
			<option value="<?php echo $death_party->getId() ?>" <?php echo($party_id==$death_party->getId() ? "selected" : "") ?>>
				<?php echo $death_party->getName() ?>
			</option>
		<?php endforeach; ?> 
	</optgroup>
</select>