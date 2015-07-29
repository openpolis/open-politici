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

<div>  

  <?php if ($sf_user->hasCredential('moderator') || 
            $sf_user->hasCredential('administrator') || 
            $sf_user->isAdopter($op_politician->getContentId())) : ?>
  <div style="float: right">
  	<span class="abuse">
  	<?php echo link_to('&raquo; edit', 'politician/edit?has_layout=true&content_id='.$op_politician->getContentId(), array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
  	</span>
  </div>
  <?php else : ?>
  <div style="float: right">
  	<?php if ($sf_user->hasCredential('subscriber')): ?>
  		<span class="abuse">
   		 <?php echo link_to('&raquo; Segnala errori / mancanze', 'politician/anagraficalReport?user_id='.$sf_user->getAttribute('subscriber_id', '', 'subscriber').'&content_id='.$op_politician->getContentId().'&politician_id='.$op_politician->getContentId(),array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')); ?>
  	 <?php //echo link_to('&raquo; Segnala errori / mancanze', '#', array('onclick' => 'toggleFormReport()', 'title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
    		</span>
  	<?php else : ?>
    		<span class="abuse">
    		<?php echo link_to('&raquo; Segnala errori / mancanze', '@sf_guard_signin' , array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
    		</span>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  Nat<?php echo $op_politician->getSex()=='M' ? 'o' : 'a' ?> 
  a <?php echo $op_politician->getBirthLocation() ?> 
  il <?php echo format_date($op_politician->getBirthDate(), 'dd/MM/yyyy') ?>
  <?php if($op_politician->getDeathDate()): ?>
    Deceduto/a il <?php echo format_date($op_politician->getDeathDate(), 'dd/MM/yyyy') ?>
  <?php endif; ?>

  <?php if ($op_politician->hasEducationLevel()): ?>
    <div>Grado di istruzione: <?php echo $op_politician->getEducationLevelNormalizedDescription() ?></div>
  <?php endif; ?>

  <?php if ($op_politician->hasProfession()): ?>
    <div>Professione: <?php echo $op_politician->getProfessionNormalizedDescription() ?></div>
  <?php endif; ?>


</div>

<div class="chiudianagrafica">
  <div class="anagrafica">
  	<div class="data">
    	<?php if ($op_politician->getPicture()): ?>
        <div class="thumb">
		      <?php 
  		      $immagine = imagecreatefromstring($op_politician->getPicture());
  			    $width=imagesx($immagine);
  			  ?>
  			  <img id="foto_politico" 
  			       src="/<?php echo sfConfig::get('sf_environment')=='dev'?'fe_dev.php/':''; ?>politician/picture?content_id=<?php echo $op_politician->getContentId() ?>" 
  			       alt="<?php echo $op_politician->toString(); ?>" border="0" width="91" />
    		</div>
    		
    	<?php endif; ?>

      <div class="text">
  		  <div class="incarichi">
    			<strong>Incarichi attuali</strong><br />
  				<?php include_component('polInstitutionCharges', 'chargeTitle', array('politician' => $op_politician, 'limit' => false)) ?>
  		    <?php include_partial('polPoliticalCharges/chargeTitle', array('political_charges' => $political_charges)) ?>
  		    <?php include_partial('polOrgCharges/chargeTitle', array('organization_charges' => $organization_charges)) ?>
        </div>
      </div>
      
	</div>
<hr />