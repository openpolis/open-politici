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
<?php echo use_helper('Javascript', 'Content', 'User', 'Date', 'Lightbox') ?>
<?php //if ($resource->getResourcesTypeId()!=5 || $resource->getResourcesTypeId()!=6) : ?> <!-- Non visualizza Twitter -->
 <div id="showedit_resource_<?php echo $resource->getContentId(); ?>">
	<?php include_component('polResources', 'resourceTitle', array('resource_id' => $resource->getContentId())) ?>	
	
	 <div class="options" id="report_content_<?php echo $resource->getContentId(); ?>">
		<?php //permetto edit e oscuramento ai moderatori o agli amministratori o creatore dell'item	
		if ( $sf_user->hasCredential('moderator') || 
		     $sf_user->hasCredential('administrator') ||
		     $sf_user->isAdopter($resource->getPoliticianId()) ||
		     ($sf_user->getAttribute('subscriber_id', '', 'subscriber')==$resource->getOpOpenContent()->getUserId()) ): ?>
			<span class="abuse">
			<?php echo link_to('&raquo; edit', 'polResources/edit?content_id='.$resource->getContentId(), array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ; ?>
			|
			<?php $edit_link_options = array(
						'title' => 'oscura risorsa',
						'class' => 'new blocksize_600x500 orange',
						'onclick' => false
					);    
				echo light_modallink('&raquo; oscura', 
				     'polResources/obscuration?resource_id='.$resource->getContentId(), $edit_link_options); ?>
			</span>
			<br/>	
			<?php if ($sf_user->hasCredential('administrator')): ?>
        <span style="color: gray; font-weight: normal; font-size: 11px">
          <?php include_component('user', 'authorshipMetadata', array('item' => $resource)) ?>    
        </span>  
      <?php endif ?>
      
		<?php else : ?>
				
			<?php //un utente loggato(non moderatore o amministratore  o creatore item) può reportare il contenuto 
			if ($sf_user->hasCredential('subscriber') ): ?>	
				<span class="abuse">		
				<?php echo link_to('&raquo; Segnala errori / abusi', 'politician/reportForm?content_id='.$resource->getContentId().'&user_id='.$sf_user->getAttribute('subscriber_id', '', 'subscriber').'&politician_id='.$resource->getPoliticianId(), array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')); ?>
				</span>
			<?php else : ?>
				<span class="abuse">
				 <?php echo link_to('&raquo; Segnala errori / abusi', '@sf_guard_signin', array( 'class'=>'orange', 'title'=>'' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')); ?>
				</span>
			<?php endif; ?>		
	
		<?php endif; ?>	
		
		<?php include_partial('moderator/content_options', array('content' => $resource->getOpOpenContent()->getOpContent())); ?>
	 </div>
</div>
<?php //endif; ?>	