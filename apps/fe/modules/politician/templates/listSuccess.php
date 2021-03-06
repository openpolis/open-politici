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
<?php
// auto-generated by sfPropelCrud
// date: 2006/08/10 12:52:42
?>
<h1>List of politicians</h1>
<div><?php echo $op_politician_pager->getNbResults() ?> results found.<br/>
Displaying results <?php echo $op_politician_pager->getFirstIndice() ?> to  <?php echo $op_politician_pager->getLastIndice() ?>.</div>
<table>
<thead>
<tr>
  <th>ID</th>
  <th>First name</th>
  <th>Last name</th>
  <th>Picture</th>
  <th>Details</th>
</tr>
</thead>
<tbody>
<?php foreach ($op_politician_pager->getResults() as $op_politician): ?>
<tr>
    <td><?php echo $op_politician->getContentId() ?></td>
	<td><?php echo $op_politician->getFirstName() ?></td>
	<td><?php echo $op_politician->getLastName() ?></td>
	<td>
		<img src="/<?php echo sfConfig::get('sf_environment')=='dev'?'fe_dev.php/':''; ?>politician/picture?content_id=<?php echo $op_politician->getContentId() ?>" alt="<?php echo $op_politician->toString(); ?>" border="0" width="30" height="40" />
	</td>
	<td><?php echo link_to(__('details'), 
	//'politician/page?content_id='.$op_politician->getContentId()
	'@politico_new?content_id='.$op_politician->getContentId() .'&slug='. $op_politician->getSlug()
	); ?></td>
  </tr>
<?php endforeach; ?>

</tbody>
</table>

<div id="politician_pager">
<?php if ($op_politician_pager->haveToPaginate()): ?>
  <?php echo link_to('&laquo;', 'politician/list?page=1') ?>
  <?php echo link_to('&lt;', 'politician/list?page='.$op_politician_pager->getPreviousPage()) ?>
 
  <?php foreach ($op_politician_pager->getLinks() as $page): ?>
    <?php echo link_to_unless($page == $op_politician_pager->getPage(), $page, 'politician/list?page='.$page) ?>
    <?php echo ($page != $op_politician_pager->getCurrentMaxLink()) ? '-' : '' ?>
  <?php endforeach; ?>
 
  <?php echo link_to('&gt;', 'politician/list?page='.$op_politician_pager->getNextPage()) ?>
  <?php echo link_to('&raquo;', 'politician/list?page='.$op_politician_pager->getLastPage()) ?>
<?php endif; ?>
</div>
