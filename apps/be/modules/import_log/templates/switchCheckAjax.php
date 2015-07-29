<?php use_helper('Javascript') ?>


<?php if ($user_check instanceof OpImportUserCheck): ?>
  <?php echo link_to_remote(image_tag('/images/admin_icons/button_ok.png', array ('alt' => 'Ok', 'title' => 'Controllato' . ($user_check->getOpUser()->getId() != $sf_user->getSubscriberId() ? ' da ' . $user_check->getOpUser() : '') . ' il ' . $user_check->getCreatedAt('d/m/Y H:i'). '. Rimuovi marcatura')), 
                            array('update' => "check_$log_counter", 'url' => "import_log/switchCheck?id=$log_id"))?>
<?php else: ?>
  <?php echo link_to_remote(image_tag('/images/admin_icons/mini_rect.png', array ('alt' => 'Rettangolo', 'title' => 'Marca come controllato')), 
                            array('update' =>"check_$log_counter", 'url' => "import_log/switchCheck?id=$log_id"))?>
<?php endif; ?>