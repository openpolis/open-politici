<?php echo use_helper('Date') ?>

<?php
  $c = new Criteria();
  $c->add(OpInstitutionChargePeer::POLITICIAN_ID, 204);
  $charges = OpInstitutionChargePeer::doSelect($c);
?>
<?php foreach ($charges as $charge): ?>
  <?php $date_start = $charge->getDateStart(null); ?>
  data: <?php echo date('d/m/Y', $date_start); ?><br />
  <?php $date_end = $charge->getDateEnd(null); ?>
  data: <?php echo date('d/m/Y', $date_end); ?><br />
<?php endforeach; ?>