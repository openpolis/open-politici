<td>
<?php if (is_null($op_import_modifications->getConcretisedAt())): ?>
<ul class="sf_admin_td_actions">
  <?php if (substr($op_import_modifications->getActionType(), 0, 1) != 'S'): ?>

    <?php if ($op_import_modifications->getBlockedAt()): ?>
      <li><?php echo image_tag('/images/admin_icons/disable_disabled.png', array('alt' => __('Respingi'), 'title' => __('Respingi'))) ?></li>
      <li><?php echo link_to(image_tag('/images/admin_icons/button_ok.png', array('alt' => __('Ripristina'), 'title' => __('Ripristina'))),
                             'import_modifications_new/restore?id='.$op_import_modifications->getId()) ?></li>
    <?php else: ?>    
      <li><?php echo link_to(image_tag('/images/admin_icons/disable.png', array('alt' => __('Respingi'), 'title' => __('Respingi'))),
                             'import_modifications_new/reject?id='.$op_import_modifications->getId()) ?></li>
      <li><?php echo image_tag('/images/admin_icons/button_ok_disabled.png', array('alt' => __('Ripristina'), 'title' => __('Ripristina'))) ?></li>
      <li><?php echo link_to(image_tag('/images/admin_icons/run.png', array('alt' => __('Aggiungi al DB'), 'title' => __('Aggiungi al DB'))),
                             'import_modifications_new/concretise?id='.$op_import_modifications->getId()) ?></li>    
    <?php endif ?>

  <?php else: ?>

    <li class="similarity"><?php echo link_to(image_tag('/images/admin_icons/magnify.png', array('alt' => __('Risolvi similarit&agrave;'), 'title' => __('Risolvi similarit&agrave;'))),
                           '#', array('id' => $op_import_modifications->getId())) ?></li>
  <?php endif ?>

</ul>
<?php endif ?>
</td>
