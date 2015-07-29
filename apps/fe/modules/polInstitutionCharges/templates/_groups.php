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
    <td class="label">gruppo: </td>
    <td>
      <select id="group_id" name="group_id">
        <option value="1">non specificato</option>
          <optgroup label="--- gruppi principali ---">
          <?php foreach ($primary_group_list as $primary_group): ?>
	        <option value="<?php echo $primary_group->getId() ?>" <?php echo($group_id==$primary_group->getId() ? "selected" : "") ?>>
		      <?php echo $primary_group->getName() ?>
	        </option>
          <?php endforeach; ?> 
        </optgroup>
	   
	   <?php if (!($location_id=='1' || $location_id=='2')): ?>
         <?php if($local_group_list): ?>
		   <optgroup label="--- gruppi locali ---">
             <?php foreach ($local_group_list as $local_group): ?>
               <option value="<?php echo $local_group->getId() ?>" <?php echo($group_id==$local_group->getId() ? "selected" : "") ?>>
                 <?php echo $local_group->getName() ?>
               </option>
             <?php endforeach; ?> 
           </optgroup>
         <?php endif; ?>
	   <?php endif; ?>
	   <option value="42">altro</option>
	  </select>		 			
    </td>
  </tr>
</table>