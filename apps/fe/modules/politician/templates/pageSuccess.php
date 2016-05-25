<?php
/*****************************************************************************
 *    Questo file e' parte del progetto openpolis.
 *
 *    openpolis - la politica trasparente
 *    copyright (C) 2008
 *    Ass. Democrazia Elettronica e Partecipazione Pubblica,
 *    Via Luigi Montuori 5, 00154 - Roma, Italia
 *
 *    openpolis e' free software; e' possibile redistribuirlo o modificarlo
 *    nei termini della General Public License GNU, versione 2 o successive;
 *    secondo quanto pubblicato dalla Free Software Foundation.
 *
 *    openpolis e' distribuito nella speranza che risulti utile,
 *    ma SENZA ALCUNA GARANZIA.
 *
 *    Potete trovare la licenza GPL e altre informazioni su licenze e
 *    copyright, nella cartella "licenze" del package.
 *
 *    $HeadURL$
 *    $LastChangedDate$
 *    $LastChangedBy$
 *    $LastChangedRevision$
 *
 ****************************************************************************/
?>
<?php echo use_helper('Javascript', 'Date', 'Lightbox', 'Global'
/* canonicals links */
, 'HeaderLinks');

if ( sfRouting::getInstance()->getCurrentRouteName() == 'politico' )
	add_link(
		'@politico_new?slug='. $op_politician->getSlug() .'&content_id='. $op_politician->getContentId(),
		'canonical');

?>

<?php if ($sf_flash->has('notice')): ?>
  <div class="flash-messages" style="background-color: #afa">
    <?php echo $sf_flash->get('notice') ?>
  </div>
<?php endif; ?>

<?php if ($sf_flash->has('warning')): ?>
  <div class="flash-messages" style="background-color: #ffa">
    <?php echo $sf_flash->get('warning') ?>
  </div>
<?php endif; ?>

<div id="title">
  <em>
    <?php if($op_politician->getLastChargeUpdate()): ?>
      ultimo aggiornamento:&nbsp;<?php echo format_date($op_politician->getLastChargeUpdate(), 'dd/MM/yyyy') ?>
    <?php else: ?>
      ultimo aggiornamento: 30/10/2007
    <?php endif; ?>
  </em>
  
  <?php if($sf_user->hasCredential('subscriber') && !$sf_user->isAdopter($op_politician->getContentId())): ?>
    <?php echo link_to('adotta questo politico', 
                       '@adozione?type=pol&adoptee_id=' . $op_politician->getContentId(), 
                        array('style' => 'float:right; margin-right: 60px')) ?>
    <?php else: ?> 
        <?php if(!$sf_user->hasCredential('subscriber')): ?> 
           <?php echo link_to('adotta questo politico', 
                       '@sf_guard_signin', 
                       array('style' => 'float:right; margin-right: 60px')) ?>
         <?php endif; ?>                                  
    <?php endif; ?>
  <h1><?php echo ucwords(strtolower($op_politician->getFirstName())) ?>&nbsp;<span class="surname"><?php echo $op_politician->getLastName() ?></span></h1>
</div>
<hr />

<?php

// #################### Controllo se e' ATTUALMENTE deputato/senatore #################### -->

$vedi=false;
$controllo=false;
$check_carica=$op_politician->fetch_current_institution_charges();
foreach ($check_carica as $actual_political_charge):
if (($actual_political_charge->getOpChargeType()->getName()=='Deputato')||($actual_political_charge->getOpChargeType()->getName()=='Senatore')||($actual_political_charge->getOpChargeType()->getName()=='Senatore a vita')):
 $vedi=true;
 break;
 else:
 $vedi=false;
 endif;
endforeach;

//echo $actual_political_charge->getOpChargeType()->getName();
foreach($institution_charges as $institution_charge):
    if ($institution_charge->getOpLocation()->getName()=='Europa'):
     $vedi=false;
     break;
 	endif;
endforeach;
?>


<!-- #################### INIZIO ANAGRAFICA ####################  -->
<div class="genericblock">
    <?php include_component('politician', 'anagraphical', array('op_politician'=>$op_politician,
                                                            'political_charges' => $political_charges,
															'organization_charges' => $organization_charges)) ?>

	<!-- #################### INIZIO CONTATTI ####################  -->
	<div class="contacts">
      <ul>
           <?php if ($vedi==true) : ?>
              <li><?php echo link_to("visualizza l'attivit&agrave; parlamentare<br/>di questo politico su:<br/>".image_tag('/images/banner_205x70_proOP.png', array('alt'=>'vai su openparlamento', 'width'=>'205', 'height'=>'70')),"http://parlamento17.openpolis.it/parlamentare/".$op_politician->getContentId()) ?></li><li style="clear: right;">&nbsp;</li>
           <?php endif;?>  
        <?php foreach ($resources as $resource): ?>
	      <li><?php include_component('polResources', 'show', array('resource' => $resource)) ?></li>
        <?php endforeach; ?>
      </ul>

      <div class="do">
      <!--  <a href="#" title="" hreflang="it" lang="it">&raquo; Scrivi al politico</a>   | -->
          <?php if ($sf_user->hasCredential('subscriber')): ?>
            <?php echo link_to('&raquo; Aggiungi contatto', 'polResources/create?politician_id='.$op_politician->getContentId(), array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it')); ?>
          <?php else: ?>
            <?php echo link_to('&raquo; Aggiungi contatto', '@sf_guard_signin', array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it'));?>
          <?php endif; ?>
	  </div>
    </div>
	<!-- #################### FINE CONTATTI ####################  -->
  </div>
</div>
</div>
<!-- #################### FINE ANAGRAFICA ####################  -->
<hr/>
<div class="orisep">&nbsp;</div>
<a name="carriera"></a>
<!-- #################### INIZIO CARRIERA ####################  -->
<div class="genericblock">
  <div class="header">
    <span class="rights-elements">
      <?php echo link_to(image_tag('buttons/close.png', array('id' => 'charges_container_toggle_img', 'alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14')) , '#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'onclick' => 'return toggleContainer(\'charges_container\')')) ?>
	</span>
    <h2>Carriera in Istituzioni, Partiti, Aziende pubbliche e private ... (<?php echo ($ist_count+$pol_count+$org_count) ?>)</h2>
  </div>
  <div id="charges_container">
    <?php include_component('polInstitutionCharges', 'tab', 
                            array('politician_id' => $op_politician->getContentId(),
	                                'ist_count' => $ist_count, 'pol_count' => $pol_count, 'org_count' => $org_count,
																  'institution_charges' => $institution_charges,
																  'past_institution_charges' => $past_institution_charges,
																  'script' => true)) ?>
  </div>

</div>
<!-- #################### FINE CARRIERA ####################  -->
<hr />
<div class="orisep">&nbsp;</div>

<?php if (count(OpTaxDeclaration::getTaxForPolitician($op_politician->getContentId()))>0) :?>
  <!-- #################### INIZIO BLOCCO DICHIARAZIONI PATRIMONIALI ####################  -->
  <div class="genericblock">
    <div class="header">
      <h2>Dichiarazioni patrimoniali dell'eletto: beni immobili, mobili, spese elettorali (<?php echo count(OpTaxDeclaration::getTaxForPolitician($op_politician->getContentId())) ?>)</h2>
    </div>
    <div id="declarations_container" style="padding-top:3px;">
      Scarica le dichiarazioni patrimoniali: 
      <?php foreach (OpTaxDeclaration::getTaxForPolitician($op_politician->getContentId()) as $k=>$tax) :?>
        <strong><?php echo link_to('anno '.$tax->getYear(),'https://s3.amazonaws.com/op_patrimoni/dichiarazioni/pdf/'.$op_politician->getContentId().'_'.$tax->getYear().'.pdf') ?></strong>
        <?php if ($k+1<count(OpTaxDeclaration::getTaxForPolitician($op_politician->getContentId()))) :?>
          <?php echo ' | '?>
        <?php endif; ?>    
      <?php endforeach; ?>  
	  <?php
	  $json=json_decode("http://patrimoni.openpolis.it/api/politici/".$op_politician->getContentId());
	  $patrimoni= count($json);
	  if ($patrimoni>0)
	  {
	  	echo "<p><strong><a href='http://patrimoni.openpolis.it/#/scheda/".$op_politician->getLastName().'-'.$op_politician->getFirstName().'/'.$op_politician->getContentId()."'>Vai sulla sua pagina di Patrimoni Trasparenti</a></strong></p>";
	  }
	  ?>
    </div>  
    <hr />
    <div class="orisep">&nbsp;</div>
<?php endif; ?>

<!-- #################### INIZIO BLOCCO DICHIARAZIONI ####################  -->
<div class="genericblock">
  <div class="header">
    <span class="rights-elements">
	  Esporta
	  <?php echo link_to_rss('declarations', '@feed_politician_last_declarations?politician_id='.$op_politician->getContentId())?>
	  <?php echo link_to(image_tag('symbols/blog.png', array('alt'=>'Esporta per Blog', 'width'=>'76', 'height'=>'12', 'border'=>'0')),'#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it')) ?>
	  <?php echo link_to(image_tag('buttons/close.png', array('id' => 'declarations_container_toggle_img', 'alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14', 'border'=>'0')),'#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'onclick' => 'return toggleContainer(\'declarations_container\')')) ?>
	</span>
	<h2>Dichiarazioni (<?php echo count($declarations)?>)</h2>
  </div>
  <div id="declarations_container">
    <?php echo include_component('politician', 'tagsCloud', array('politician_id' => $op_politician->getContentId()) ) ?>
    <div id="declaration_container">
      <?php include_component('polDeclarations', 'blockForPoliticianPage', array('politician_id' => $op_politician->getContentId(),
                                                                               'sort'=>'last', 'limit'=>sfConfig::get('app_declarations_limit'), 'total'=> count($declarations))) ?>

    </div>
  </div>
</div>
<!-- #################### FINE BLOCCO DICHIARAZIONI ####################  -->

<?php echo javascript_tag("function toggleFormReport()
{
  if (Element.visible('anagrafical_report'))
  {
    ".visual_effect('BlindUp', 'anagrafical_report', array('duration' => 0.4 ))."
  }
  else
  {
    ".visual_effect('BlindDown', 'anagrafical_report', array('duration' => 0.4 ))."
  }

  return false;
}") ?>

<script type="text/javascript">
//<![CDATA[
function toggleTagDiv(content_id)
{
  div = 'tags_for_'+content_id;
  if (Element.visible(div))
  {
    new Effect.BlindUp(div, {duration:0.4});
  }
  else
  {
    new Effect.BlindDown(div, {duration:0.4});
  }

  return false;
}
//]]>
</script>
