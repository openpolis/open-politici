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
<?php echo use_helper('Javascript', 'Content', 'User', 'Date', 'Text') ?>

<!-- tema -->
<?php echo include_partial('themes/theme_block', 
                           array('theme'=>$theme, 'tag_id'=>0, 'all_information'=>true)) ?>

<div class="orisep">&nbsp;</div>


<!-- dichiarazioni -->
<div class="genericblock">
  <div id="declarations_for_ajax">
    <?php include_component('polDeclarations', 'declarationsBlockForTheme', 
                            array('theme_id' => $theme->getContentId(),
                                  'sort' => 'last')) ?>
  </div>
</div>

<div class="orisep">&nbsp;</div>

<!-- commenti  -->
<div class="genericblock">
  <div id="for_ajax">
    <?php include_component('opinableContent', 'blockForComments', 
                            array('content_id' => $theme->getContentId(),
                                  'sort' => 'date')) ?>
  </div>
</div>
