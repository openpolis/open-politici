<?php
// auto-generated by sfPropelAdmin
// date: 2008/09/11 18:19:02
?>
<td>
<ul class="sf_admin_td_actions">
  <?php $c = new Criteria; $c->add(OpImportLogPeer::IMPORT_ID, $op_import->getId()); $nrecs = OpImportLogPeer::doCount($c); ?>
  <?php if ($nrecs): ?>
    <li><?php echo link_to(image_tag('/images/admin_icons/go_there.png', array('alt' => __('Vai al log'), 'title' => __('Vai al log relativo'))), 'import_log/list?filters[import_id]='.$op_import->getId()."&filter=filter") ?></li>
    <?php if ($op_import->getFinishedAt()): ?>
      <li><?php echo link_to(image_tag('/images/admin_icons/dry_run.png', array('alt' => __('Dry run'), 'title' => __('Esegui import in modo dry'))), 'import/dryRun?id='.$op_import->getId()) ?></li>
      <li><?php echo link_to(image_tag('/images/admin_icons/wet_run.png', array('alt' => __('Wet run'), 'title' => __('Esegui import'))), 'import/wetRun?id='.$op_import->getId()) ?></li>
    <?php endif; ?>
  <?php else: ?>
    <li><?php echo link_to(image_tag('/images/admin_icons/remove.png', array('alt' => __('Rimuovi'), 'title' => __('Rimuovi'))), 'import/delete?id='.$op_import->getId()) ?></li>
  <?php endif; ?>
</ul>
</td>