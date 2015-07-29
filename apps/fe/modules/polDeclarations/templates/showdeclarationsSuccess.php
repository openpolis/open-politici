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
<?php echo use_helper('Javascript') ?>
<?php
    if ($hasLayout == "false"){
    	$sf_view->setDecorator(false);
    }
?>
<?php if ($sf_user->hasCredential('subscriber')): ?>
<div id="declarations">
	<?php if ($sf_user->hasCredential('subscriber')): ?>
		<div id="ajax_add_declaration">
			<?php 
				echo link_to_remote(__('inserisci dichiarazione'), array(
				'update' => 'new_membership',
				'url'    => 'polDeclarations/createdeclaration?mode=add&has_layout=false&politician_id='.$op_politician->getContentId(),
				));
			?>
		</div>
	<?php else: ?>
		<?php 
			echo link_to_function(__('inserisci dichiarazione'), visual_effect('blind_down', 'login', array('duration' => 0.5)));
		?>		
	<?php endif; ?>
	<div id="new_institution_charge"></div>
	<table>
	<?php if (count($declarations != 0))
	{
	?>
	<tr>
		<th><?php echo __('titolo') ?></th>
		<th><?php echo __('da') ?></th>
		<th><?php echo __('voto') ?></th>
		<th><?php echo __('commenti') ?></th>
		<th><?php echo __('data') ?></th>
		<th></th>
		<th></th>
		<th></th>
	</tr>	
	<?php
	}
	?>
	<?php foreach ($declarations as $declaration): ?>
		<?php include_component('polDeclarations', 'showdeclaration', array('declaration' => $declaration)) ?>
	<?php endforeach; ?>
	</table>
</div>
<?php endif; ?>