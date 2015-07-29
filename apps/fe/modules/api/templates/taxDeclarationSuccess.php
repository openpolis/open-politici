<?php echo '<?' ?>xml version="1.0" encoding="utf-8" ?>

<?php $politician_id=0; ?>

<rsp stat="ok" version="1.0">
  <taxs>
	  <?php foreach ($taxs as $k=>$tax): ?>
	    
		  <?php if ($politician_id!=$tax->getPoliticianId()) : ?>
			  <?php if ($politician_id!=0) : ?>
			    </tax>
			  <?php endif ?>	
			  <tax>	
		      <oppoliticianid><?php echo $tax->getPoliticianId() ?></oppoliticianid>
		      <lastname><?php echo $tax->getOpPolitician()->getLastName() ?></lastname>
		      <firstname><?php echo $tax->getOpPolitician()->getFirstName() ?></firstname>
			  <?php $politician_id=$tax->getPoliticianId() ?>
		  <?php endif ?>	
		  <declaration>
		  	<year><?php echo $tax->getYear() ?></year>
		  	<url><?php echo $tax->getUrl() ?></url>
		  </declaration>
		   <?php if ($k==count($taxs)-1) : ?>
 			    </tax>
 		   <?php endif ?>	
	  <?php endforeach ?> 
  </taxs>
</rsp>
