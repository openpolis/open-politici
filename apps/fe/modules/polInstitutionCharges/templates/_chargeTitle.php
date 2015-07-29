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
<?php if($institution_charges): ?>
  <?php if ($limit): ?>
    <?php $institution_charge=$institution_charges[0]; //prendo la prima carica ?>
    <?php Text::chargeDefinition($institution_charge) ?>
  <?php else: ?>
    <?php foreach($institution_charges as $institution_charge): ?>
      &raquo;&nbsp;<?php Text::chargeDefinition($institution_charge) ?><br />
    <?php endforeach; ?>
  <?php endif; ?>
<?php else: ?>
  <?php echo "non in carica"; ?><br />
<?php endif; ?>