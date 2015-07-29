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
<?php use_helper('Date', 'AdoptionTools') ?>

<h1>Lista delle richieste di adozione</h1>

<?php echo link_to('mostra tutte', '@lista_adozioni')?>

<?php if (count($pager->getResults()) > 0): ?>
  <table id="adoptionsList" cellspacing="0" cellpadding="3">
    <tr>
      <th width="30%">Utente</th>
      <th width="15%">Data richiesta</th>
      <th width="30%">Oggetto adozione</th>
      <th width="10%">Status</th>
      <th width="15%">Strumenti</th>
    </tr>
    <?php $cnt = 0; ?>    
    <?php foreach ($pager->getResults() as $item): ?>
      <tr class="<?php echo $cnt % 2 ? 'dark' : 'light'; ?>">
        <td><?php echo $item->getOpUser()->__toString(); ?></td>
        <td><?php echo format_date($item->getRequestedAt()); ?></td>
        <td><?php echo $item instanceof OpPolAdoption ? $item->getOpPolitician()->__toString() : $item->getOpLocation()->getName();?></td>
        <td><?php echo $item->getStatus(); ?></td>
        <td><?php echo adoption_tools($item);  ?></td>
      </tr>
      <?php $cnt++; ?>
    <?php endforeach; ?>
  </table>
<?php else: ?>
  <p>Non ci sono richieste di adozione in coda</p>
<?php endif; ?>
