<div>
Pagina in progress, ci stiamo lavorando. Potrai scoprire tutti i politici italiani con incarichi istituzionali multipli.
<br /><br />
<?php if ($sf_user->hasCredential('administrator') || $sf_user->getAttribute('subscriber_id', '', 'subscriber')==53): ?>
  <?php if ($ordina==1) include_component('polInstitutionCharges', 'multipleChargeTitle',array('ordina'=>1)) ?>
  <?php if ($ordina==2) include_component('polInstitutionCharges', 'multipleChargeTitle',array('ordina'=>2)) ?>
  <?php if ($ordina==3) include_component('polInstitutionCharges', 'multipleChargeTitle',array('ordina'=>3)) ?>
<?php endif ?>  

</div> 
  

