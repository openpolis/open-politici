<?php
  $charge = $op_open_content->getOpInstitutionCharge();
  $politician = $charge->getOpPolitician();
?>
<?php if (!is_null($politician)): ?>
  <?php echo link_to("<em class=\"surname\">".$politician->getLastName()."</em>&nbsp;".ucwords(strtolower($politician->getFirstName())),'politician/edit?content_id='.$politician->getContentId());?>  
<?php endif ?>
