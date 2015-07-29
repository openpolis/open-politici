<?php echo link_to($op_similar_politician->getOpPoliticianRelatedBySimilarId(), 
                   '@politician_edit?content_id='.$op_similar_politician->getSimilarId(), array('target' => '_blank')) ?>
 (<?php echo $op_similar_politician->getOpPoliticianRelatedBySimilarId()->getBirthDate('d/m/Y') ?>)
  <?php include_partial('similar/deletebutton', array('content_id' => $op_similar_politician->getSimilarId() )) ?>


 <?php include_partial('similar/institutioncharges', 
                       array('charges' => $op_similar_politician->getOpPoliticianRelatedBySimilarId()->getOpInstitutionCharges())) ?>
