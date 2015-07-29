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
<?php use_helper('Date', 'Javascript') ?>

<?php include_partial('user/header', array('current' => 'adozioni', 'hash' => $hash, 'subscriber' => $subscriber)) ?>

<?php if (count($adoptees)): ?>
  <table class="utente">
  <?php foreach ($adoptees as $adoptee): ?>
    <tr>
      <td class="last">
        <?php echo format_date($adoptee->getGrantedAt(), "dd/MM/yyyy (HH:mm)");?>
        -
        <?php if ($adoptee instanceOf OpLocAdoption): ?>
          <?php echo $adoptee->getOpLocation()->getOpLocationType()->getName(); ?>
      <?php endif; ?>
        <?php echo $adoptee->toLink(); ?> 
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php else: ?>
  <div>Nessuna adozione inserita fino a questo punto</div>
<?php endif; ?>
