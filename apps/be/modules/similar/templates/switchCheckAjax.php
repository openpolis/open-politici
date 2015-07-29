<?php use_helper('Javascript') ?>


<?php if ($op_similar_politician->getIsResolved()): ?>
  <?php echo link_to_remote(image_tag('/images/admin_icons/button_ok.png', array ('alt' => 'Ok', 'title' => 'Marca come irrisolto')), 
                            array('update' => "check_$id", 'url' => "similar/switchCheck?id=$id"))?>
<?php else: ?>
  <?php echo link_to_remote(image_tag('/images/admin_icons/mini_rect.png', array ('alt' => 'Rettangolo', 'title' => 'Marca come risolto')), 
                            array('update' =>"check_$id", 'url' => "similar/switchCheck?id=$id"))?>
<?php endif; ?>