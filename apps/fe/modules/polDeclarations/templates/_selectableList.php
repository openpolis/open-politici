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
<div class="genericblock">

  <!-- blocco filter and sorting -->
  <?php echo include_partial('polDeclarations/filter_and_sorting',
                             array ('sort' => $sort, 'selectable_query' => $selectable_query,
                                    'other_function' => "var accordion_accordion_container = new accordion ('accordion_container', {resizeSpeed:10});",
                                    'container' => 'declarations_container',
                                    'indicator' => 'indicator',
                                    'action' => '@selectable_list')); ?>

  <!-- separatore --> 
  <div style="clear:both; height: 5px"></div>

  <!-- blocco navigatore -->
  <?php echo include_partial('polDeclarations/page_navigator', 
                             array( 'pager' => $pager,
                                    'other_params' => "sort=$sort&selectable_query=$selectable_query",
                                    'other_function' => "var accordion_accordion_container = new accordion ('accordion_container', {resizeSpeed:10});",
                                    'limit' => sfConfig::get('app_pagination_selectable_declaration_limit'),
                                    'container' => 'declarations_container',
                                    'indicator' => 'indicator',
                                    'action' => '@selectable_list')) ?>

  <!-- separatore --> 
  <div style="clear:both; height: 10px"></div>

  <?php if($pager->getNbResults()): ?>


    <!-- blocco elenco dichiarazioni -->
    <div id="accordion_container" class="dichiarazioni" style="clear:both">
      <?php foreach ($pager->getResults() as $declaration): ?>
        <div class="accordion_toggle">
          <?php echo include_partial('polDeclarations/declarationHeaderBlock', 
                                     array('declaration' => $declaration)); ?>
        </div>
        <div class="accordion_content">
          <?php echo include_partial('polDeclarations/declarationContentBlock', 
                                     array('declaration' => $declaration,
                                           'theme' => $theme,
                                           'positions' => sfConfig::get('app_position_on_theme'))); ?>
        </div>
      <?php endforeach; ?>
    </div>
  
  <?php else: ?>

    <div style="margin-left: 30px">
      Non &egrave; stata trovata nessuna dichiarazione. <br />
     <strong> <?php echo link_to_remote("Clicca qu&igrave;",
                                array('update'   => 'declarations_container',
                                      'url'      => '@selectable_list?sort=$sort',
                                      'loading'  => "Element.show('indicator')",
                                      'complete' => "Element.hide('indicator'); var accordion_accordion_container = new accordion ('accordion_container', {resizeSpeed:10});")); ?></strong>
      per visualizzare tutte le dichiarazioni.<br/>
      Puoi usare motore di ricerca per trovare le dichiarazioni di un determinato politico o argomento.
    </div>

  <?php endif; ?>

  <!-- separatore --> 
  <div style="clear:both; height: 10px"></div>

</div>
