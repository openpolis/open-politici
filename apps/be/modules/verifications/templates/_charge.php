<?php
  $charge = $op_open_content->getOpInstitutionCharge();
  $location = $charge->getOpLocation();
?>
<?php echo $charge->getOpChargeType()->getName()?>
<?php if ($charge->getChargeTypeId() == 12): ?>
  &nbsp;<?php echo $charge->getDescription()?>
<?php endif; ?>
<?php if (in_array($charge->getChargeTypeId(), array(1, 2))): ?>
  &nbsp;<?php echo $charge->getOpInstitution()->getName() ?>  
<?php endif ?>

<?php if ($charge->getChargeTypeId() == 5):?>
  <?php if ($location->getLocationTypeId() == 2): ?>
    Europeo
  <?php endif ?>
<?php elseif (!in_array($charge->getChargeTypeId(), array(6, 7, 9, 10, 19, 20))): ?>
  <?php echo $location->getOpLocationType()->getName() ?>&nbsp;di&nbsp;<?php echo $location->getName() ?> 
<?php endif ?>

dal <?php echo $charge->getDateStart('d/m/Y')?>
<?php if (!is_null($charge->getDateEnd())): ?>
  al <?php echo $charge->getDateEnd('d/m/Y')?>
<?php endif ?>
