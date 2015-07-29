<td>
<?php if (is_null($op_import_modifications->getConcretisedAt())): ?>
<ul class="sf_admin_td_actions">
  <?php if ($op_import_modifications->getBlockedAt()): ?>
    <li><?php echo image_tag('/images/admin_icons/disable_disabled.png', array('alt' => __('Respingi'), 'title' => __('Respingi'))) ?></li>
    <li><?php echo link_to(image_tag('/images/admin_icons/button_ok.png', array('alt' => __('Ripristina'), 'title' => __('Ripristina'))), 'import_modifications_old/restore?id='.$op_import_modifications->getId()) ?></li>
  <?php else: ?>    
    <li><?php echo link_to(image_tag('/images/admin_icons/disable.png', array('alt' => __('Respingi'), 'title' => __('Respingi'))), 'import_modifications_old/reject?id='.$op_import_modifications->getId()) ?></li>
    <li><?php echo image_tag('/images/admin_icons/button_ok_disabled.png', array('alt' => __('Ripristina'), 'title' => __('Ripristina'))) ?></li>
    <li><?php echo link_to(image_tag('/images/admin_icons/remove.png', array('alt' => __('Chiudi incarico nel DB'), 'title' => __('Chiudi incarico nel DB'))), 'import_modifications_old/concretise?id='.$op_import_modifications->getId()) ?></li>    
  <?php endif ?>
</ul>
<?php endif ?>
</td>
