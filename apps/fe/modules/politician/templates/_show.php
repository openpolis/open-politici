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

<?php echo use_helper('Javascript', 'Date') ?>
<br />
<div>
	<p>
		<?php echo __('Nato/a a') ?>:&nbsp;
		<?php echo $politician->getBirthLocation() ?>
		<?php echo __('il') ?>:&nbsp;
		<?php echo format_date($politician->getBirthDate(), 'dd/MM/yyyy') ?>
	</p>
	
	<?php if($politician->getDeathDate()): ?>
		<p>
			<?php echo __('Deceduto il') ?>:&nbsp;
			<?php echo format_date($politician->getDeathDate(), 'dd/MM/yyyy') ?>
		</p>
	<?php endif; ?>		
	
	<p>
		<?php echo __('Titolo di studio') ?>: <?php echo $education_level ?><br />
		<?php echo $description ?>
	</p>
	
	<p>
		<?php echo __('Professione') ?>:&nbsp;
		<?php echo $profession ?>
	</p>
</div>

<?php if ($sf_user->hasCredential('administrator')): ?>
<div>
	<p>
	<?php echo link_to(__('modifica dati'), 'politician/edit?has_layout=true&content_id='.$politician->getContentId()); ?>
	</p>
</div>	
<?php endif; ?>

<?php if ($sf_user->hasCredential('subscriber')): ?>
<div style="text-align:right">
	<p>	
	<?php echo link_to(__('['.__('report to moderator').']') , '#', array('onclick' => 'toggleFormReport()')) ?>
	</p>
</div>	
<?php endif; ?>