<?php use_helper('Javascript') ?>

<td>
<ul class="sf_admin_td_actions">
  <?php if (!$op_similar_politician->getIsResolved()): ?>
    <li class="keep original"><?php echo link_to(image_tag('/images/admin_icons/arrowLeft.gif', 
                                     array('alt' => 'Freccia a sinistra', 
                                           'title' => 'Trasferisci incarichi da simile a originale. Rimuovi simile.')), 
                           'similar/keepOriginal?id='.$op_similar_politician->getId()) ?></li>      

    <li class="keep similar"><?php echo link_to(image_tag('/images/admin_icons/arrowRight.gif', 
                                     array('alt' => 'Freccia a destra', 
                                           'title' => 'Trasferisci incarichi da originale a simile. Rimuovi originale.')), 
                           'similar/keepSimilar?id='.$op_similar_politician->getId()) ?></li>      
  <?php endif; ?>
  
  <?php if ($op_similar_politician->getIsResolved()): ?>
    <li class="mark solved"><?php echo link_to(image_tag('/images/admin_icons/button_ok.png', 
                           array('alt' => 'Ok', 
                                 'title' => 'Marca come irrisolto')), 
                           'similar/switchCheck?id='.$op_similar_politician->getId()) ?></li>      
  <?php else: ?>
    <li class="mark unsolved"><?php echo link_to(image_tag('/images/admin_icons/mini_rect.png', 
                           array('alt' => 'Checkbox vuoto', 
                                 'title' => 'Marca come risolto')), 
                           'similar/switchCheck?id='.$op_similar_politician->getId()) ?></li>      
  <?php endif; ?>
</ul>
</td>
