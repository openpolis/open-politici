<?php

  $location = $op_open_content->getOpInstitutionCharge()->getOpLocation();
?>

<?php echo $location->getOpLocationType()->getName() ?>&nbsp;di&nbsp;<?php echo $location->getName() ?>
