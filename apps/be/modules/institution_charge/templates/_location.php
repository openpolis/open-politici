<?php echo $op_institution_charge->getOpLocation() ?>
<?php if ($op_institution_charge->getOpLocation()->getProv()) echo  " (" . $op_institution_charge->getOpLocation()->getProv() . ")" ?>