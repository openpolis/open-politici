<?php $sf_context->getResponse()->setContentType('text/javascript') ?>

$('organization_tags').value = '<?php echo $tags ?>';
$('organization_url').value = '<?php echo $url ?>';
$('organization_id').value = <?php echo $id ?>;