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
<?php echo include_partial('global/breadcrumbs') ?>

<!-- serve solo per essere certi che la prototype venga caricata -->
<?php echo link_to_remote('',''); ?>

<?php 
if ($pager->getNbResults()!=0)
{
	echo "Risultati&nbsp;<b>".$pager->getFirstIndice()."</b> - <b>".$pager->getLastIndice()."</b> su <b>".$pager->getNbResults()."</b> per <b>".$sf_params->get("location")."</b>"; 
?>
<div style="margin-top:20px">
	<ul>
	<?php
		
		foreach ($pager->getResults() as $location)
		{
					
		?>
		<li>
			<?php 
			$upper_location=strtoupper($sf_params->get('location'));
			$name=str_replace($upper_location, "<b>".$upper_location."</b>", $location->GetName()); 
			echo link_to($name."&nbsp;(".$location->getProv().")",'politician/forlocation?location_id='.$location->getId()); ?>
		</li>
		<?php 
		}
	?>
	</ul>
</div>	
<?php
}
else
{
	echo "La ricerca di - <b>".$sf_params->get("location")."</b> - non ha prodotto nessun risultato";
}
?>

<div id="pagination">
	<?php if ($pager->haveToPaginate()): ?>
	  <?php echo link_to('&laquo;', 'default/choice2?page='.$pager->getFirstPage().'&location='.$sf_params->get('location')) ?>
	  <?php echo link_to('&lt;', 'default/choice2?page='.$pager->getPreviousPage().'&location='.$sf_params->get('location')) ?>
	  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
		<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'default/choice2?page='.$page.'&location='.$sf_params->get('location')) ?>
		<?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif; ?>
	  <?php endforeach; ?>
	  <?php echo link_to('&gt;', 'default/choice2?page='.$pager->getNextPage().'&location='.$sf_params->get('location')) ?>
	  <?php echo link_to('&raquo;', 'default/choice2?page='.$pager->getLastPage().'&location='.$sf_params->get('location')) ?>
	<?php endif; ?>
</div>