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

<!-- testo -->
<cite><?php echo $declaration->getText() ?></cite><br />

<!-- fonte -->
<span class="fontelink">Fonte: 
  <strong>
    <span class="fonte"><?php echo $declaration->getSourceName() ?></span> | 
    <?php echo include_partial('polDeclarations/sourceUrlManaging', array('declaration'=>$declaration)); ?>

    <?php if($declaration->getSourceMime() && !strstr($declaration->getSourceMime(),'program')): ?>
      <?php  echo " | ". link_to('scarica l\'allegato','polDeclarations/attachment?declaration_id='.$declaration->getContentId()); ?>
    <?php endif; ?>
  </strong>
</span>
 

<div class="select" style="margin-top: 10px; background-color:#fcf49f; padding:5px">
<h2>Indica la posizione del politico</h2>
<strong>In base a questa dichiarazione, la posizione del politico sul tema &egrave;:</strong><br /><br />
  <?php foreach ($positions as $i => $position): ?>
    <?php echo link_to(image_tag("buttons/pos_$i.png", 
                                 array('alt'=> $position, 'border'=>'0',
                                       'style' => 'vertical-align: middle;')), 
                       '@aggiunta_dichiarazione_associata?' . 
                       'theme_id=' . $theme->getContentId() . 
                       '&declaration_id=' . $declaration->getContentId() .
                       '&position=' . ($i-4) )?>
  <?php endforeach; ?>
</div>
<br />
