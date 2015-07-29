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
  
<?php if($pager->getResults()): ?>

  <!-- intestazione numero utenti e visualizzati (pager) -->
  <div style="float:left">
  <?php if ($pager->getResults()> 1): ?>
    <?php if ($pager->getResults()> sfConfig::get('app_pagination_admin_limit')): ?>
      Utenti <strong><?php echo $pager->getFirstIndice() ?></strong> - 
             <strong><?php echo $pager->getLastIndice() ?></strong> di
             <strong><?php echo count($pager->getResults())?></strong>
    <?php else: ?>
      <strong><?php echo count($pager->getResults())?></strong> utenti
    <?php endif; ?>
  <?php else: ?>
    Trovato un solo utente.
  <?php endif; ?>
  </div>

  <!-- paginatore -->
  <div style="float:right">
    <?php if ($pager->haveToPaginate()): ?>
    
      <?php if ($pager->getPage() != $pager->getFirstPage()): ?>
        <?php echo link_to_remote('precedente', 
                                 array('update' => 'users_container', 
                                       'url' => "@$urlalias?page=" . $pager->getPreviousPage(),
                                       'loading'  => "Element.show('users_indicator')",
                                       'complete' => "Element.hide('users_indicator')"))?>
      <?php endif; ?>

      <?php $links = $pager->getLinks(); ?>
      <?php foreach ($links as $page): ?>
        <?php echo ($page == $pager->getPage()) ? 
                "<strong>$page</strong>" : 
                link_to_remote($page, 
                               array('update' => 'users_container', 
                                     'url' => "@$urlalias?page=" . $page,
                                     'loading'  => "Element.show('users_indicator')",
                                     'complete' => "Element.hide('users_indicator')")) ?>
        <?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif ?>
      <?php endforeach ?>

      <?php if ($pager->getPage() != $pager->getLastPage()): ?>
        <?php echo link_to_remote('successiva', 
                                  array('update' => 'users_container', 
                                        'url' => "@$urlalias?page=" . $pager->getNextPage(),
                                        'loading'  => "Element.show('users_indicator')",
                                        'complete' => "Element.hide('users_indicator')"))?>
      <?php endif; ?>
        
    <?php endif ?>  
  </div>

  <!-- blocco elenco utenti con tool di amministrazione -->
  <div style="clear:both; height: 20px"></div>
  <?php foreach ($pager->getResults() as $user): ?>
    <h2><?php echo link_to($user->__toString(), '@user_profile?hash='.$user->getHash()) ?></h2>
    <?php echo include_partial('administrator/user_options', array('subscriber' => $user)) ?>
    <br class="clearleft" />
  <?php endforeach; ?>

<?php else: ?>

  <div style="margin:30px;">
    Nessun utente.
  </div>

<?php endif; ?>
