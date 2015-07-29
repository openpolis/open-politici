<?php echo '<?' ?>xml version="1.0" encoding="utf-8" ?>
<rsp stat="ok" version="1.0">
  <politician href="<?php echo url_for('@politico_new?slug='. $politician->getSlug() .'&content_id='.$sf_params->get('id'), true) ?>">
  	<firstname><?php echo $politician->getFirstName() ?></firstname>
	<lastname><?php echo $politician->getLastName() ?></lastname>
	<image><?php echo $img_url ?></image>
	<charges>
	  <?php foreach ($institution_charges as $institution_charge): ?>
	    <charge>
	      <chargetype><?php echo $institution_charge->getOpChargeType()->getName() ?></chargetype>
		  <datestart><?php echo strftime('%d-%m-%Y', $institution_charge->getDateStart('U')) ?></datestart>
		  <dateend><?php if($institution_charge->getDateEnd()):?><?php echo strftime('%d-%m-%Y', $institution_charge->getDateEnd('U')) ?><?php endif; ?></dateend>
		  <group><?php echo $institution_charge->getOpGroup()->getName() ?></group>
		  <constituency><?php echo $institution_charge->getOpConstituency()->getName() ?></constituency>  	
	    </charge>
	  <?php endforeach ?> 
    </charges>
  </politician>	
</rsp>