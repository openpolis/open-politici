
<?php foreach (array('notice', 'warning', 'error') as $type): ?>
  <?php if ($sf_flash->has($type)): ?>
    <div class="flash-messages <?php echo $type?>">
      <?php echo $sf_flash->get($type) ?>
    </div>
  <?php endif ?>
<?php endforeach ?>

<?php if ($sf_request->getError('delete')): ?>
<div class="form-errors">
  <h2><?php echo __('Could not delete the selected %name%', array('%name%' => 'Op open content')) ?></h2>
  <ul>
    <li><?php echo $sf_request->getError('delete') ?></li>
  </ul>
</div>
<?php endif; ?>
