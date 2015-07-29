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

<!-- intestazione numero dichiarazioni e visualizzati (pager) -->

<div class="page_navigator">
  <div style="float:left">
  <?php if ($pager->getNbResults() > 1): ?>
    <?php if ($pager->getNbResults() > $limit): ?>
      Dichiarazioni <strong><?php echo $pager->getFirstIndice() ?></strong> - 
             <strong><?php echo $pager->getLastIndice() ?></strong> di
             <strong><?php echo $pager->getNbResults() ?></strong>
    <?php else: ?>
      <strong><?php echo $pager->getNbResults()?></strong> dichiarazioni
    <?php endif; ?>
  <?php else: ?>
    <?php if ($pager->getNbResults() == 1): ?>
      Trovata una sola dichiarazione.
    <?php endif; ?>
  <?php endif; ?>
  </div>

  <!-- paginatore -->
  <div style="float:right">
    <?php if ($pager->haveToPaginate()): ?>

      <?php if ($pager->getPage() != $pager->getFirstPage()): ?>
        <?php echo link_to_remote('precedente', 
                                 array('update' => $container, 
                                       'url' => "$action?page=" . $pager->getPreviousPage() . "&$other_params",
                                       'loading'  => "Element.show('$indicator')",
                                       'complete' => "Element.hide('$indicator'); $other_function"))?>
      <?php endif; ?>

      <?php $links = $pager->getLinks(); ?>
      <?php foreach ($links as $page): ?>
        <?php echo ($page == $pager->getPage()) ? 
                "<strong>$page</strong>" : 
                link_to_remote($page, 
                               array('update' => $container, 
                                     'url' => "$action?page=" . $page . "&$other_params",
                                     'loading'  => "Element.show('$indicator')",
                                     'complete' => "Element.hide('$indicator'); $other_function")) ?>
        <?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif ?>
      <?php endforeach ?>

      <?php if ($pager->getPage() != $pager->getLastPage()): ?>
        <?php echo link_to_remote('successiva', 
                                  array('update' => $container, 
                                        'url' => "$action?page=" . $pager->getNextPage() . "&$other_params",
                                        'loading'  => "Element.show('$indicator')",
                                        'complete' => "Element.hide('$indicator'); $other_function"))?>
      <?php endif; ?>
  
    <?php endif ?>  
  </div>
</div>