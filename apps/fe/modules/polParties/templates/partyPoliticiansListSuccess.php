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
<div>
  <?php echo $msg ?>
</div>

<div style="margin-bottom: 20px; float:right">
  <?php echo link_to("Torna all'elenco dei partiti", "polParties/partiesList" . $filterParameters) ?> 
</div>

<table style="clear:both; width: 100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th>&nbsp;</th>
    <th>Nome</th>
    <th>Istituzione</th>
    <th>Tipo</th>
    <th>Denominazione</th>
  </tr>
  <?php $cnt = 1; ?>
  <?php foreach ($charges as $charge): ?>
  <tr>
    <td><?php echo $cnt++ ?></td>
    <td><?php echo link_to($charge->getOpPolitician()->toString(), "@politico_new?content_id=" . $charge->getOpPolitician()->getContentId() .'&slug='. $charge->getOpPolitician()->getSlug()) ?></td>
    <td><?php echo $charge->getOpInstitution()->getName() ?></td>
    <td><?php echo $charge->getOpChargeType()->getName() ?></td>
    <td><?php echo $charge->getDescription()?></td>
  </tr> 
  <?php endforeach; ?>
   
  </table> 


