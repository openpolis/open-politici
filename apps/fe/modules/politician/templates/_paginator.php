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
$istitutionSlug = $sf_params->get('slug');
if ( $istitutionSlug )
{
	$istitutionSlug = '&slug='.$istitutionSlug;
}
?>
<?php if ($pager->haveToPaginate()): ?>
	  <?php echo link_to('&laquo;', 'politician/forinstitution?id='.$sf_params->get('id').$istitutionSlug.'&page='.$pager->getFirstPage()) ?>
	  <?php echo link_to('&lt;', 'politician/forinstitution?id='.$sf_params->get('id').$istitutionSlug.'&page='.$pager->getPreviousPage()) ?>
	  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
		<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'politician/forinstitution?id='.$sf_params->get('id').$istitutionSlug.'&page='.$page) ?>
		<?php if ($page != $pager->getCurrentMaxLink()): ?> - <?php endif; ?>
	  <?php endforeach; ?>
	  <?php echo link_to('&gt;', 'politician/forinstitution?id='.$sf_params->get('id').$istitutionSlug.'&page='.$pager->getNextPage()) ?>
	  <?php echo link_to('&raquo;', 'politician/forinstitution?id='.$sf_params->get('id').$istitutionSlug.'&page='.$pager->getLastPage()) ?>
	<?php endif; ?>