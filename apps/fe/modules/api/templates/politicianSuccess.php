<?php echo '<?' ?>xml version="1.0" encoding="utf-8" ?>
<rsp stat="ok" version="1.0">
  <politician href="<?php echo url_for('@politico_new?slug='. $politician->getSlug() .'&content_id='.$sf_params->get('id'), true) ?>">
    <firstname><?php echo $politician->getFirstName() ?></firstname>
    <lastname><?php echo $politician->getLastName() ?></lastname>
   <!-- <image><?php //echo $politician->getPicture() ?></image> -->   
  </politician>	
</rsp>
