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
<?php use_helper('Date', 'Javascript', 'AdoptionTools') ?>

<!-- intestazione -->
<div class="header">
  <h2>
  <?php if ($type == 'all'): ?>
    Lista di tutte le adozioni (<?php echo $nAdoptions?>)
  <?php else: ?>
    Lista delle richieste di adozione (<?php echo $nAdoptions?>) 
  <?php endif; ?>
  </h2>
</div>


<!-- switching menu -->
<div class="sottomenu">

  <?php if ($type == 'all'): ?>
    <div>
      <?php echo link_to_remote('solo richiedenti', 
                                array(
                                  'update' => 'items_container',
                                  'url'    => "@elenco_adozioni?type=request&page=1",
                                  'loading'  => "Element.show('indicator')",
                                  'complete' => "Element.hide('indicator')" )) ?>  
    </div>
    <div>tutti</div>
  <?php else: ?>
    <div>solo richiedenti</div>
    <div>
      <?php echo link_to_remote('tutti', 
                                array(
                                  'update' => 'items_container',
                                  'url'    => "@elenco_adozioni?type=all&page=1",
                                  'loading'  => "Element.show('indicator')",
                                  'complete' => "Element.hide('indicator')" )) ?>  
    </div>  
  <?php endif; ?>
  
</div>

<!-- separatore --> 
<div style="clear:both; height: 10px"></div>

<!-- paginatore (sopra) -->
<?php echo include_partial('default/page_navigator', 
                           array( 'pager' => $pager,
                                  'other_params' => "type=$type",
                                  'limit' => sfConfig::get('app_pagination_admin_limit'),
                                  'container' => 'items_container',
                                  'indicator' => 'indicator',
                                  'other_function' => '',
                                  'items_name' => 'Adozioni',
                                  'single_item_found' => 'Trovata una sola adozione',
                                  'action' => '@elenco_adozioni')) ?>


<!-- separatore --> 
<div style="clear:both; height: 0px"></div>


<!-- elenco adozioni -->
<?php if($nAdoptions): ?>
  <table style="border-right: 0; border-bottom: 0; border-top: 1px solid #C9C9CA" cellspacing="0" cellpadding="0" border="0">
    <tr>
      <td class="label">utente</td>
      <td class="label">data richiesta</td>
      <td class="label">data risposta</td>
      <td class="label">oggetto adozione</td>
      <td class="label">status</td>
      <td class="label">strumenti</td>
    </tr>	


    <?php $cnt = 0; ?>
    <?php foreach ($pager->getResults() as $item): ?>
      <tr class="<?php echo $cnt % 2 ? 'dark' : 'light'; ?>">
        <td>
          <?php echo link_to($item->getOpUser()->__toString(),
                                 "@user_profile?hash=" . $item->getOpUser()->getHash()) ?></td>
        <td><?php echo format_date($item->getRequestedAt()); ?></td>
        <td>
          <?php if ($item->getStatus() == 'rev'): ?>
            <?php echo format_date($item->getRevokedAt()); ?>
          <?php endif; ?>
          <?php if ($item->getStatus() == 'gra'): ?>
            <?php echo format_date($item->getGrantedAt()); ?>
          <?php endif; ?>
          <?php if ($item->getStatus() == 'ref'): ?>
            <?php echo format_date($item->getRefusedAt()); ?>
          <?php endif; ?>
        </td>
        <td>
          <?php if ($item instanceof OpPolAdoption): ?>
            <?php echo link_to($item->getOpPolitician()->__toString(), 
                               'politician/page?content_id='.$item->getOpPolitician()->getContentId()) ?>
          <?php else: ?>
            <?php echo link_to($item->getOpLocation()->getName(),
                                   "@localita?location_id=" . $item->getOpLocation()->getId()) ?>  
          <?php endif ?>
        <td><?php echo $item->getStatus(); ?></td>
        <td><?php echo adoption_tools($item);  ?></td>
      </tr>
      <?php $cnt++; ?>
    <?php endforeach; ?>
  </table>
<?php else: ?>
  <div>Non ci sono richieste di adozione</div>
<?php endif; ?>



