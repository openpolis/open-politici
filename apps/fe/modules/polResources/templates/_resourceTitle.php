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
<!-- <?php echo $resource->getOpResourcesType()->getResourceType() ?> -->

<?php if ($resource->getResourcesTypeId() == sfConfig::get('app_resource_type_official_mail') || 
		  $resource->getResourcesTypeId() == sfConfig::get('app_resource_type_unofficial_mail')): ?>
		  		
		  		<?php if ($resource->getDescrizione()== null): ?>
		  			<?php echo mail_to($resource->getValore(), 'e-mail', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it')) ?><br />
		  		<?php else: ?>	
					<?php echo mail_to($resource->getValore(), $resource->getDescrizione(), array('title'=>'', 'hreflang'=>'it', 'lang'=>'it')) ?><br />
				<?php endif; ?>	
<?php elseif ($resource->getResourcesTypeId()==3 || $resource->getResourcesTypeId()==4 || $resource->getResourcesTypeId()==6): ?>	
				<?php if ($resource->getDescrizione()== null && $resource->getResourcesTypeId()!=6): ?>
		  			<?php echo link_to('sito web', $resource->getValore(), array('title'=>'', 'hreflang'=>'it', 'lang'=>'it')); ?><br />
		  		<?php elseif ($resource->getResourcesTypeId()==6): ?>	
					<?php echo link_to('Facebook', $resource->getValore(), array('title'=>'', 'hreflang'=>'it', 'lang'=>'it')) ?><br />
					<?php else: ?>
					  <?php echo link_to($resource->getDescrizione(), $resource->getValore(), array('title'=>'', 'hreflang'=>'it', 'lang'=>'it')) ?><br />
				<?php endif; ?>
<?php elseif ($resource->getResourcesTypeId()==5): ?>
  <?php if ($resource->getDescrizione()== null): ?>
			<?php echo link_to('Twitter', 'https://twitter.com/#!/'.$resource->getValore(), array('title'=>'', 'hreflang'=>'it', 'lang'=>'it')); ?><br />
		<?php else: ?>	
		<?php echo link_to($resource->getDescrizione(), 'https://twitter.com/#!/'.$resource->getValore(), array('title'=>'', 'hreflang'=>'it', 'lang'=>'it')) ?><br />
	<?php endif; ?>			
				
<?php endif; ?>