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

<?php include_partial('user/header', array('current' => 'risorse', 'hash' => $hash, 'subscriber' => $subscriber)) ?>
<?php include_partial('user/filtro_attivita', array('current_filter' => $upsert, 'url' => '/user/resources', 'hash' => $hash, 'genre' => 'f')) ?>

<?php if ($ocs):?>
  <table class="utente">
  <?php foreach($ocs as $oc): ?>
    <?php $resource =  $oc->getOpContent()->getInstancedObject(); ?>
    <?php if (!$resource) continue; ?>
    <tr>
      <td class="label" style="text-align: center; width:20px">
        <?php if ($oc->getUpdaterId() == $subscriber->getId()): ?>
          [M]
        <?php else: ?>
          [I]
        <?php endif ?>
      </td>
      <td class="last">
        <?php if ($oc->getUpdaterId() == $subscriber->getId()): ?>
          <?php echo format_date($oc->getOpContent()->getUpdatedAt(), "dd/MM/yyyy (HH:mm)");?>          
        <?php else: ?>
          <?php echo format_date($oc->getOpContent()->getCreatedAt(), "dd/MM/yyyy (HH:mm)");?>
        <?php endif ?>
        -
        <?php echo link_to($resource->getOpPolitician(), '@politico_new?content_id='.$resource->getPoliticianId().'&slug='.$resource->getOpPolitician()->getSlug(), array()) ?>: <?php echo $resource->getOpResourcesType() ?> - <?php echo $resource->getValore() ?>
      </td>
    </tr>
  <?php endforeach; ?>
	</table>
<?php else: ?>
  <div>Nessun incarico inserita fino a questo punto</div>
<?php endif; ?>
