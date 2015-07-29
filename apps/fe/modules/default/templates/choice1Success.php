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
<?php use_helper('Javascript') ?>
<h1>Pagina di disambiguazione per il politico "<?php echo $sf_params->get("politician") ?>"</h1>
<p style="text-align:right; float:right">
	<?php if ($sf_user->hasCredential('subscriber')): ?>
		<?php echo link_to(__('Non trovi il politico ?'), 'politician/dontFind?location_id=null') ?>
	<?php else: ?>
		<?php echo link_to_function(__('Non trovi il politico ?'), visual_effect('blind_down', 'login', array('duration' => 0.5)));	?>
	<?php endif; ?>
</p>

<?php if ($pager->getNbResults()): ?>
	<?php echo "Risultati&nbsp;<b>".$pager->getFirstIndice()."</b> - <b>".$pager->getLastIndice()."</b> su <b>".$pager->getNbResults()."</b> per <b> ".$sf_params->get("politician")."</b>"; ?> 

	<div style="margin-top:20px">
		<ul>
			<?php foreach($pager->getResults() as $politician): ?>
				<li style="list-style-type: none">
					<?php $last_name=strtoupper($sf_params->get('politician')); ?>
					<?php if(count($words)==1): ?>
						<?php $last_name=str_replace($last_name, "<b>".$last_name."</b>", $politician->getLastName()); ?> 
					<?php else: ?>
						<?php $last_name = $politician->getLastName(); ?>
						<?php foreach($words as $word): ?>
							<?php $word=strtoupper($word); ?>
							<?php $last_name=str_replace($word, "<b>".$word."</b>", $last_name); ?>
						<?php endforeach; ?>
					<?php endif; ?>
				
					<?php echo link_to($last_name."&nbsp;".$politician->getFirstName(),'@politico_new?content_id='.$politician->getContentId().'&slug='. $politician->getSlug() ).",&nbsp;"; ?>
				
				<?php include_component('polInstitutionCharges', 'chargeTitle', array('politician' => $politician, 'limit' => 'true')) ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php else: ?>
	<?php echo "La ricerca di - <b>".$sf_params->get("politician")."</b> - non ha prodotto nessun risultato"; ?>

<?php endif; ?>

<div id="pagination">
	<?php if ($pager->haveToPaginate()): ?>
	  <?php echo link_to('&laquo;', 'default/choice1?page='.$pager->getFirstPage().'&politician='.$sf_params->get('politician')) ?>
	  <?php echo link_to('&lt;', 'default/choice1?page='.$pager->getPreviousPage().'&politician='.$sf_params->get('politician')) ?>
	  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
		<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'default/choice1?page='.$page.'&politician='.$sf_params->get('politician')) ?>
		<?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif; ?>
	  <?php endforeach; ?>
	  <?php echo link_to('&gt;', 'default/choice1?page='.$pager->getNextPage().'&politician='.$sf_params->get('politician')) ?>
	  <?php echo link_to('&raquo;', 'default/choice1?page='.$pager->getLastPage().'&politician='.$sf_params->get('politician')) ?>
	<?php endif; ?>
</div>