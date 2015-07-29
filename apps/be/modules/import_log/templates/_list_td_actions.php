<?php use_helper('Javascript') ?>

<td>
<ul class="sf_admin_td_actions">
  <?php $op_import_user_check = OpImportUserCheckPeer::retrieveByPk(
           $op_import_log->getOpImport()->getImportFile(), 
           $op_import_log->getCounter())?>

  <?php if ($op_import_user_check instanceof OpImportUserCheck): ?>

    <?php if_javascript(); ?>
      <li id="check_<?php echo $op_import_log->getCounter()?>">
        <?php echo link_to_remote(image_tag('/images/admin_icons/button_ok.png', 
                                            array('alt' => __('Ok'), 
                                                  'title' => __('Controllato '.
                                                                ($op_import_user_check->getOpUser()->getId() != $sf_user->getSubscriberId() ? 'da ' . $op_import_user_check->getOpUser() : '') . 
                                                                ' il ' . $op_import_user_check->getCreatedAt('d/M/Y H:i'). '. Rimuovi marcatura'))), 
                                  array( 'update' => 'check_' . $op_import_log->getCounter(),
                                         'url'    => 'import_log/switchCheck?id='.$op_import_log->getId())) ?></li>      
    <?php end_if_javascript(); ?>

    <noscript>
      <li><?php echo link_to(image_tag('/images/admin_icons/button_ok.png', 
                             array('alt' => __('Ok'), 
                                   'title' => __('Controllato '.
                                                 ($op_import_user_check->getOpUser()->getId() != $sf_user->getSubscriberId() ? 'da ' . $op_import_user_check->getOpUser() : '') . 
                                                 ' il ' . $op_import_user_check->getCreatedAt('d/M/Y H:i'). '. Rimuovi marcatura'))), 
                             'import_log/switchCheck?id='.$op_import_log->getId()) ?></li>      
    </noscript>

  <?php else: ?>
    <?php if_javascript(); ?>
      <li id="check_<?php echo $op_import_log->getCounter()?>">
        <?php echo link_to_remote(image_tag('/images/admin_icons/mini_rect.png', 
                                            array('alt' => __('Rettangolo'), 
                                             'title' => __('Marca come controllato'))), 
                                  array( 'update' => 'check_' . $op_import_log->getCounter(),
                                         'url'    => 'import_log/switchCheck?id='.$op_import_log->getId())) ?></li>
    <?php end_if_javascript(); ?>

    <noscript>
      <li><?php echo link_to(image_tag('/images/admin_icons/mini_rect.png', 
                             array('alt' => __('Rettangolo'), 
                                   'title' => __('Marca come controllato'))), 
                             'import_log/switchCheck?id='.$op_import_log->getId()) ?></li>
    </noscript>

  <?php endif; ?>
</ul>
</td>
