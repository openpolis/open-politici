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
<?php echo include_partial('global/breadcrumbs') ?>

<?php 
if ($pager->getNbResults()!=0)
{
	echo "Risultati&nbsp;<b>".$pager->getFirstIndice()."</b> - <b>".$pager->getLastIndice()."</b> su <b>".$pager->getNbResults()."</b> per <b>".$sf_params->get("localita")."</b>";
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
			echo link_to($name."&nbsp;(".$location->getProv().")",'politician/munPoliticians?location_id='.$location->getId(). '&slug='. $location->getSlug()); ?>
		</li>
		<?php 
		}
?>
</ul>
<?php 	
}
else
{
	echo "La ricerca di - <b>".$sf_params->get("location")."</b> - non ha prodotto nessun risultato";
}
?>
</div>	

<div id="pagination">
	<?php if ($pager->haveToPaginate()): ?>
	  <?php echo link_to('&laquo;', 'default/choice3?page='.$pager->getFirstPage().'&location2='.$sf_params->get('location2')) ?>
	  <?php echo link_to('&lt;', 'default/choice3?page='.$pager->getPreviousPage().'&location2='.$sf_params->get('location2')) ?>
	  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
		<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'default/choice3?page='.$page.'&location2='.$sf_params->get('location2')) ?>
		<?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif; ?>
	  <?php endforeach; ?>
	  <?php echo link_to('&gt;', 'default/choice3?page='.$pager->getNextPage().'&location2='.$sf_params->get('location2')) ?>
	  <?php echo link_to('&raquo;', 'default/choice3?page='.$pager->getLastPage().'&location2='.$sf_params->get('location2')) ?>
	<?php endif; ?>
</div>
