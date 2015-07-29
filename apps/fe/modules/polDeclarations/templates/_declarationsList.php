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

<div class="genericblock">
  <?php if($pager->getNbResults()): ?>

    <!-- intestazione numero dichiarazioni e visualizzati (pager) -->
    <div style="float:left">
    <?php if ($pager->getNbResults() > 1): ?>
      <?php if ($pager->getNbResults() > sfConfig::get('app_pagination_declaration_limit')): ?>
        Dichiarazioni <strong><?php echo $pager->getFirstIndice() ?></strong> - 
               <strong><?php echo $pager->getLastIndice() ?></strong> di
               <strong><?php echo $pager->getNbResults() ?></strong>
      <?php else: ?>
        <strong><?php echo count($pager->getNbResults())?></strong> dichiarazioni
      <?php endif; ?>
    <?php else: ?>
      Trovata una sola dichiarazione.
    <?php endif; ?>
    </div>

    <!-- paginatore -->
    <div style="float:right">
      <?php if ($pager->haveToPaginate()): ?>
    
        <?php if ($pager->getPage() != $pager->getFirstPage()): ?>
          <?php echo link_to_remote('precedente', 
                                   array('update' => 'declarations_container', 
                                         'url' => "@declarations_list?page=" . $pager->getPreviousPage(),
                                         'loading'  => "Element.show('users_indicator')",
                                         'complete' => "Element.hide('users_indicator')"))?>
        <?php endif; ?>

        <?php $links = $pager->getLinks(); ?>
        <?php foreach ($links as $page): ?>
          <?php echo ($page == $pager->getPage()) ? 
                  "<strong>$page</strong>" : 
                  link_to_remote($page, 
                                 array('update' => 'declarations_container', 
                                       'url' => "@declarations_list?page=" . $page,
                                       'loading'  => "Element.show('users_indicator')",
                                       'complete' => "Element.hide('users_indicator')")) ?>
          <?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif ?>
        <?php endforeach ?>

        <?php if ($pager->getPage() != $pager->getLastPage()): ?>
          <?php echo link_to_remote('successiva', 
                                    array('update' => 'declarations_container', 
                                          'url' => "@declarations_list?page=" . $pager->getNextPage(),
                                          'loading'  => "Element.show('users_indicator')",
                                          'complete' => "Element.hide('users_indicator')"))?>
        <?php endif; ?>
        
      <?php endif ?>  
    </div>

    <!-- blocco elenco dichiarazioni -->
    <div style="clear:both; height: 20px"></div>

    <div class="dichiarazione">
      <ul>
        <?php foreach ($pager->getResults() as $declaration): ?>
          <?php 	echo include_partial('polDeclarations/declarationBlock', 
                                       array('declaration' => $declaration, 
                                             'tag_id' => 0)); ?>
          <br class="clearleft" />
        <?php endforeach; ?>
      </ul>
    </div>
  
  <?php else: ?>

    <div style="margin:30px;">
      Nessun utente.
    </div>

  <?php endif; ?>

</div>