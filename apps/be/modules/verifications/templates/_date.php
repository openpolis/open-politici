<?php
  $charge = $op_open_content->getOpInstitutionCharge();
?>
dal <?php echo $charge->getDateStart('d/m/Y')?>
<?php if (!is_null($charge->getDateEnd())): ?>
  al <?php echo $charge->getDateEnd('d/m/Y')?>
<?php endif ?>
