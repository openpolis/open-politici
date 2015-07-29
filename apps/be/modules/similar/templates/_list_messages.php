<?php if ($sf_flash->has('notice')): ?>
  <div class="flash-messages notice">
    <?php echo $sf_flash->get('notice') ?>
  </div>
<?php endif; ?>
<?php if ($sf_flash->has('warning')): ?>
  <div class="flash-messages warning">
    <?php echo $sf_flash->get('warning') ?>
  </div>
<?php endif; ?>
<?php if ($sf_flash->has('error')): ?>
  <div class="flash-messages error">
    <?php echo $sf_flash->get('error') ?>
  </div>
<?php endif; ?>

<?php if ($sf_request->getError('delete')): ?>
<div class="form-errors">
  <h2><?php echo __('Could not delete the selected %name%', array('%name%' => 'Op similar politician')) ?></h2>
  <ul>
    <li><?php echo $sf_request->getError('delete') ?></li>
  </ul>
</div>
<?php endif; ?>
