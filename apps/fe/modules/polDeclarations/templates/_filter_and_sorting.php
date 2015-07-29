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
<?php echo use_helper('Javascript') ?>

<div class="filter_sort">

  <!-- filtro -->
  <div class="search" style="border-right:0">
    <?php echo form_remote_tag(array('update' => $container,
                                     'url' => $action,
                                     'loading'  => "Element.show('$indicator')",
                                     'complete' => "Element.hide('$indicator'); $other_function")) ?>
      <?php echo input_hidden_tag('sort', $sort); ?>
      <?php echo image_tag('search.png', 
                                   array('style' => "margin-bottom:-4px", 
                                         'border' => '0', 'alt' => 'filtro')); ?>      
      <?php echo input_tag('selectable_query', $selectable_query=='x'?'Inserisci un filtro':$selectable_query, 
                           array('accesskey' => 's', 'size' => '60', 
                                 'style' => 'font-size: 11px',
                                 'onfocus' => "if (this._cleared || this.value != 'Inserisci un filtro') return;this.clear();this._cleared = true;")); ?>
      <?php echo link_to_remote(image_tag('close.gif', 
                                          array( 
                                                'border' => '0', 
                                                'title' => 'annulla il filtro')),
                                array('update' => $container,
                                      'url' => "$action?sort=$sort",
                                      'loading'  => "Element.show('$indicator')",
                                      'complete' => "Element.hide('$indicator'); $other_function")); ?>      
    </form>
  </div>


  
</div>