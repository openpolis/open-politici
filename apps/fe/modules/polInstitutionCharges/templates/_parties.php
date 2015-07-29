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
<table cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td class="label">lista di elezione o partito: </td>
    <td>
      <select id="party_id" name="party_id">
        <option value="1">non specificato</option>
          <optgroup label="--- partiti principali ---">
          <?php foreach ($primary_party_list as $primary_party): ?>
	        <option value="<?php echo $primary_party->getId() ?>" <?php echo($party_id==$primary_party->getId() ? "selected" : "") ?>>
		      <?php echo $primary_party->getName() ?>
	        </option>
          <?php endforeach; ?> 
        </optgroup>
		<optgroup label="--- altri partiti ---">
          <?php foreach ($secondary_party_list as $secondary_party): ?>
	        <option value="<?php echo $secondary_party->getId() ?>" <?php echo($party_id==$secondary_party->getId() ? "selected" : "") ?>>
		      <?php echo $secondary_party->getName() ?>
	        </option>
          <?php endforeach; ?> 
        </optgroup>
		<?php if($location_id!=sfConfig::get('app_location_id_europe') && $location_id!=sfConfig::get('app_location_id_italy')): ?>
		  <optgroup label="--- partiti locali ---">
            <?php foreach ($local_party_list as $local_party): ?>
	          <option value="<?php echo $local_party->getId() ?>" <?php echo($party_id==$local_party->getId() ? "selected" : "") ?>>
		        <?php echo $local_party->getName() ?>
	          </option>
            <?php endforeach; ?> 
          </optgroup>
		<?php endif; ?>
		<optgroup label="--- partiti sciolti ---">
          <?php foreach ($death_party_list as $death_party): ?>
	        <option value="<?php echo $death_party->getId() ?>" <?php echo($party_id==$death_party->getId() ? "selected" : "") ?>>
		      <?php echo $death_party->getName() ?>
	        </option>
          <?php endforeach; ?> 
        </optgroup>
      </select>		 			
    </td>
  </tr>
</table>