<?php
/*****************************************************************************
 *    Questo file e' parte del progetto openpolis.
 * 
 *    openpolis - la politica trasparente
 *    copyright (C) 2008-2011
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
<?php use_helper('Date', 'Javascript') ?>

<?php include_partial('user/header', array('current' => 'oscuramenti', 'hash' => $hash, 'subscriber' => $subscriber)) ?>

<?php if ($ocs):?>
  <table class="utente">
  <?php foreach($ocs as $oc): ?>
    <?php 
      $content =  $oc->getOpOpenContent()->getOpContent()->getInstancedObject(); 
      $class = $content->getOpOpenContent()->getOpContent()->getOpClass(); ?>
    <tr>
      <td class="last">
        <?php echo format_date($oc->getCreatedAt(), "dd/MM/yyyy (HH:mm)");?>
        -
        <?php echo Text::translateClass($class) ?> di
        <?php echo link_to($content->getOpPolitician(),'@politico_new?content_id='.$content->getOpPolitician()->getContentId().'&slug='.$content->getOpPolitician()->getSlug());?>:
<?php switch ($class): ?>
<?php case 'OpInstitutionCharge': ?>
<?php include_component('polInstitutionCharges', 'institutionChargeTitle', array('institution_charge_id' => $content->getContentId())) ?>
<?php break; ?>	
<?php case 'OpPoliticalCharge': ?>
<?php include_component('polPoliticalCharges', 'politicalChargeTitle', array('political_charge_id' => $content->getContentId())) ?>
<?php break; ?>	
<?php case 'OpResources': ?>
<?php include_component('polResources', 'resourceTitle', array('resource_id' => $content->getContentId())) ?>
<?php break; ?>
<?php case 'OpOrganizationCharge': ?>
<?php include_component('polOrgCharges', 'organizationChargeTitle', array('organization_charge_id' => $content->getContentId())) ?>
<?php break; ?>
<?php case 'OpDeclaration': ?>
<?php echo link_to($content->getTitle(), 
                       "@dichiarazione_new?" . $content->getSlugUrl()) ?>
<?php break; ?>	
<?php endswitch; ?>
      <br/>
      <em><?php echo $oc->getReason() ?></em>
      </td>
    </tr>
  <?php endforeach; ?>
	</table>
<?php else: ?>
  <div>Nessun incarico inserita fino a questo punto</div>
<?php endif; ?>
