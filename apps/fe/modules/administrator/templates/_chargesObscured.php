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
<?php echo use_helper('Javascript', 'Date', 'Object') ?>

<div><h1>incarichi e risorse</h1></div>

<?php if(count($obscured_contents)): ?>

  <table cellspacing="0" cellpadding="0" border="0">
    <tr>
      <td class="label">politico</td>
      <td class="label">contenuto</td>
      <td class="label">tipo</td>
      <td class="label">moderatore</td>
      <td class="label">data oscuramento</td>
      <td class="label">motivazione</td>
      <?php if ($sf_user->hasCredential('administrator')): ?>
        <td class="label" colspan="2">&nbsp;</td>
      <?php endif; ?>
    </tr>	

    <?php foreach ($obscured_contents as $obscured_content): ?>
      <?php $class = $obscured_content->getOpOpenContent()->getOpContent()->getOpClass();
       $query = '$content = '.$class.'Peer::RetrieveByPk($obscured_content->getContentId());';
       eval("$query"); 
       if (!$content instanceof OpInstitutionCharge) continue;
       ?>

      <tr>
        <td><?php echo link_to($content->getOpPolitician(),'@politico_new?slug='.$content->getOpPolitician()->getSlug().'&content_id='.$content->getOpPolitician()->getContentId());?></td> 
      
        <td>  
<?php switch ($class): ?>
<?php case 'OpInstitutionCharge': ?>
    <?php include_component('polInstitutionCharges', 'institutionChargeTitle', array('institution_charge_id' => $obscured_content->getContentId())) ?>
    <?php break; ?>	
    <?php case 'OpPoliticalCharge': ?>
    <?php include_component('polPoliticalCharges', 'politicalChargeTitle', array('political_charge_id' => $obscured_content->getContentId())) ?>
    <?php break; ?>	
    <?php case 'OpResources': ?>
    <?php include_component('polResources', 'resourceTitle', array('resource_id' => $obscured_content->getContentId())) ?>
    <?php break; ?>
    <?php case 'OpOrganizationCharge': ?>
    <?php include_component('polOrgCharges', 'organizationChargeTitle', array('organization_charge_id' => $obscured_content->getContentId())) ?>
    <?php break; ?>	
  <?php endswitch; ?>
        </td>

        <td><?php echo Text::translateClass($obscured_content->getOpOpenContent()->getOpContent()->getOpClass()) ?></td>

        <td>
          <?php if($obscured_content->getOpUser()->getNickname() == 'admin'): ?>
            admin
          <?php else: ?>
            <?php echo link_to($obscured_content->getOpUser()->__toString(),
                                   "@user_profile?hash=" . $obscured_content->getOpUser()->getHash()) ?>
          <?php endif; ?>
        </td>

        <td><?php echo format_date($obscured_content->getCreatedAt(), 'dd/MM/yyyy') ?></td>
        <td><?php echo $obscured_content->getReason() ?></td>
        <?php if ($sf_user->hasCredential('administrator')): ?>
          <td>
            <?php echo link_to_remote('ripristina', 
                                      array('update'   => 'obscured_contents',
                                            'url'      => 'administrator/restoredCharge?content_id=' .
                                                           $obscured_content->getContentId(),
                                            'loading'  => "Element.show('indicator')",
                                            'complete' => "Element.hide('indicator')"
                                      )) ?>
            <?php echo link_to_remote('rimuovi', 
                                      array('update'   => 'obscured_contents',
                                            'url'      => 'administrator/removedContent?content_hash=' .
                                                           $obscured_content->getContentHash(),
                                            'confirm'  => "L'eliminazione di un contenuto è definitiva. Procedi?",
                                            'loading'  => "Element.show('indicator')",
                                            'complete' => "Element.hide('indicator')"
              )) ?>

          </td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
  </table>

<?php else: ?>
  <div style="">Non ci sono temi oscurati</div>
<?php endif; ?>