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
<?php echo use_helper('Javascript', 'Object', 'Global') ?>

<table>
<tr>
	<th colspan="6" align="center"><?php echo $title1 ?></th>
</tr>
<?php foreach($politicians as $politician): ?>
<tr>
	<td>
		<?php echo $politician->getOpPolitician()->getLastName() ?>
	</td>
	<td>
		<?php echo $politician->getOpPolitician()->getFirstName() ?>
	</td>
	<!--<td>
		<?php //echo input_date_tag('dateofbirth1_'.$politician->getOpPolitician()->GetContentId(), $politician->getOpPolitician()->getBirthDate(), 'rich=true') ?>
		<?php //echo link_to('dettaglio', 'administrator/politicianData', array('class' => 'lbOn')) ?>
	</td> -->
	<td>
		<?php echo politician_charge_type($politician, $location_type) ?>
		<?php //echo $politician->getOpChargeType()->GetName()?>
	</td>
	<td>
		<?php echo $politician->getOpParty()->GetName()?>
	</td>
	<td>
		<?php echo input_date_tag('datestart1_'.$politician->getOpPolitician()->GetContentId(), $politician->getDateStart(), 'rich=true') ?></td>
	<td>
		<?php echo input_date_tag('dateend1_'.$politician->getOpPolitician()->GetContentId(), $politician->getDateEnd(), 'rich=true') ?></td>	
</tr>
<?php endforeach; ?>
<tr>
	<th colspan="6" align="center"><?php echo $title2 ?></th>
</tr>	
<?php foreach($politicians2 as $politician): ?>
<tr>
	<td>
		<?php echo $politician->getOpPolitician()->getLastName() ?>
	</td>
	<td>
		<?php echo $politician->getOpPolitician()->getFirstName() ?>
	</td>
	<!--<td>
		<?php //echo input_date_tag('dateofbirth2_'.$politician->getOpPolitician()->GetContentId(), $politician->getOpPolitician()->getBirthDate(), 'rich=true') ?>
		<?php //echo link_to('dettaglio', '#', array('class' => 'lbOn')) ?>
	</td> -->
	<td>
		<?php //echo object_select_tag($elemento->getOpChargeType(), 'getName') ?>
		<?php echo $politician->getOpChargeType()->GetName()?>
	</td>
	<td>
		<?php echo $politician->getOpParty()->GetName()?>
	</td>
	
	<td>
		<?php echo input_date_tag('datestart2_'.$politician->getOpPolitician()->GetContentId(), $politician->getDateStart(), 'rich=true') ?></td>
	<td>
		<?php echo input_date_tag('dateend2_'.$politician->getOpPolitician()->GetContentId(), $politician->getDateEnd(), 'rich=true') ?></td>	
</tr>
<?php endforeach; ?>
</table>