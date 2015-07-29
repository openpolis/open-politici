<?php echo link_to($op_similar_politician->getOpPoliticianRelatedByOriginalId(), 
                   '@politician_edit?content_id='.$op_similar_politician->getOriginalId(), array('target' => '_blank')) ?>
 (<?php echo $op_similar_politician->getOpPoliticianRelatedByOriginalId()->getBirthDate('d/m/Y') ?>)

 <?php include_partial('similar/deletebutton', array('content_id' => $op_similar_politician->getOriginalId() )) ?>
 
<?php include_partial('similar/institutioncharges', 
                      array('charges' => $op_similar_politician->getOpPoliticianRelatedByOriginalId()->getOpInstitutionCharges())) ?>

