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
<?php use_helper('Javascript', 'Object') ?>

<table cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td class="label">carica: </td>
		<td><?php echo select_tag('charge_type_id', objects_for_select(
  						$charge_list,
  								'getId',
  								'getName',
  							    $charge_type_id,
								array('include_custom'=>'--- seleziona ---')
						), array('onchange' => 'otherInfo($F(\'institution_id\'), this[this.selectedIndex].value,'.$location_id.','.$institution_charge_id.')')) ?>
		</td>
	</tr>
</table>