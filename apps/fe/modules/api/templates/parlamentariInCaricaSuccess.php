<?php echo '<?' ?>xml version="1.0" encoding="utf-8" ?>
<rsp stat="ok" version="1.0">
  <charges>
	  <?php foreach ($institution_charges as $institution_charge): ?>
	    <charge>
	      <oppoliticianid><?php echo $institution_charge->getPoliticianId() ?></oppoliticianid>
	      <lastname><?php echo $institution_charge->getOpPolitician()->getLastName() ?></lastname>
	      <firstname><?php echo $institution_charge->getOpPolitician()->getFirstName() ?></firstname>
	      <opinstitutionchargeid><?php echo $institution_charge->getContentId() ?></opinstitutionchargeid>
              <?php $c= new Criteria;
               $c->addJoin(OpPoliticianPeer::CONTENT_ID, OpResourcesPeer::POLITICIAN_ID);
               $c->addJoin(OpOpenContentPeer::CONTENT_ID, OpResourcesPeer::CONTENT_ID);
               $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::ISNULL);
               $c->add(OpResourcesPeer::POLITICIAN_ID, $institution_charge->getPoliticianId());
               $c->add(OpResourcesPeer::RESOURCES_TYPE_ID, 5);
               $tw=OpResourcesPeer::doSelectOne($c); 
               ?>
                <?php if ($tw): ?>
                    <twitter><?php echo $tw->getValore() ?></twitter>
                <?php else: ?>
                  <twitter/>
                <?php endif; ?>
             
	      <chargetype><?php echo $institution_charge->getOpChargeType()->getName() ?></chargetype>
		    <datestart><?php echo strftime('%Y-%m-%d', $institution_charge->getDateStart('U')) ?></datestart>
		    <dateend><?php if($institution_charge->getDateEnd()):?><?php echo strftime('%Y-%m-%d', $institution_charge->getDateEnd('U')) ?><?php endif; ?></dateend>
		    <group><?php echo $institution_charge->getOpGroup()->getName() ?></group>
		    <constituency><?php if($institution_charge->getOpConstituency()): ?><?php echo $institution_charge->getOpConstituency()->getName() ?><?php endif; ?></constituency>  	
	    </charge>
	  <?php endforeach ?> 
  </charges>
</rsp>
