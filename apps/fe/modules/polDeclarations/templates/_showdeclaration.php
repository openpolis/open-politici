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
<?php echo use_helper('Javascript', 'Content', 'User', 'Date', 'Declaration') ?>

<div id="new_declaration"></div>
<div id="showedit_declaration_<?php echo $declaration->getContentId(); ?>">

<tr>
	<?php include_partial('polDeclarations/declaration_td', array('declaration' => $declaration)) ?>
	<?php  //permetto l'edit al moderatore o al creatore dell'item
		if ($sf_user->hasCredential('moderator') || ($sf_user->getAttribute('subscriber_id', '', 'subscriber')==$declaration->getOpOpinableContent()->getOpOpenContent()->getUserId())):?>
	<td>
		<?php  
		echo link_to('edit', 'polDeclarations/editdeclaration?has_layout=true&content_id='.$declaration->getContentId()."&politician_id=".$declaration->getPoliticianId());
		?>
	</td>
	<td>	
		<?php
		if ($sf_user->hasCredential('moderator')):
		 	echo link_to_remote('delete', array(
		    	'update'  => 'declarations',
		    	'url'     => 'polDeclarations/deletedeclaration?has_layout=false&content_id='.$declaration->getContentId(),
		    	'confirm' => __('Confermi?'),
		)) ?>
		<?php endif; ?>
	</td>
	<?php endif; ?>
	
	<td>
	<div class="options" id="report_content_<?php echo $declaration->getContentId(); ?>">
		<?php if ($sf_user->hasCredential('subscriber') && !($sf_user->hasCredential('moderator'))): ?>
			<?php echo link_to('['.__('report to moderator').']', 'politician/reportForm?content_id='.$declaration->getContentId().'&user_id='.$sf_user->getAttribute('subscriber_id', '', 'subscriber').'&politician_id='.$declaration->getPoliticianId()) ?>
		<?php endif; ?>	
		<?php //echo link_to_report_content($institution_charge->getOpOpenContent()->getOpContent(), $sf_user); ?>
		<?php include_partial('moderator/content_options', array('content' => $declaration->getOpOpinableContent()->getOpOpenContent()->getOpContent())); ?>
	</div>
	</td>
</tr>
<tr>
	<td colspan="5">
		<!--<label><b>tags:&nbsp;</b></label>
		<?php foreach($declaration->getOpOpinableContent()->getOpTagHasOpOpinableContents() as $tag_for_opinable_content)
				{	
					echo link_to($tag_for_opinable_content->getOpTag()->getTag(), '#')."&nbsp;&nbsp;&nbsp;" ;
				}
		?>	 -->
		<?php if ($declaration->getTags()): ?>
      <?php echo __('tags:') ?> <?php echo tags_for_declaration($declaration, '0') ?>
    <?php endif ?>	
	</td>
	<td>
		<?php if ($sf_user->hasCredential('subscriber'))
			{		
				echo link_to('add tags', 'polDeclarations/addTags?content_id='.$declaration->getContentId()."&politician_id=".$declaration->getPoliticianId());
			}
		?>
	</td>
</tr>

</div>