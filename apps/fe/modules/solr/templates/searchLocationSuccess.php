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
<?php echo form_tag('solr/searchLocation', array("method"=>"GET")) ?>
  <?php echo input_tag('query', '') ?>
  <?php echo submit_tag('Cerca') ?>
</form>

<?php if ($sf_flash->has('err_msg')): ?>
  <div style="color: red">
    <?php echo $sf_flash->get('err_msg'); ?>
  </div>
<?php else: ?>

  <div id="title">
    <em>tempo richiesto per la ricerca: <?php echo "$QTime ms" ?></em>
    <h1>
      Risultati della ricerca per <i><?php echo $query ?></i>
    </h1>
  </div>

  <hr />

  <div class="genericblock">
    <div class="header">
      <div class="rights-elements">
        <?php if ($pager->haveToPaginate()): ?>
          <?php echo link_to('&laquo;', "solr/search?query=$query&page=1") ?>
          <?php echo link_to('&lt;', "solr/search?query=$query&page=".$pager->getPreviousPage()) ?>

          <?php foreach ($pager->getLinks() as $page): ?>
            <?php 
            if ($page == $pager->getPage()){
              echo $page;
            } else {
              echo link_to($page, "solr/search?query=$query&page=$page");
            }
            ?>            
            <?php echo ($page != $pager->getCurrentMaxLink()) ? '-' : '' ?>
          <?php endforeach; ?>

          <?php echo link_to('&gt;', "solr/search?query=$query&page=".$pager->getNextPage()) ?>
          <?php echo link_to('&raquo;', "solr/search?query=$query&page=".$pager->getLastPage()) ?>
        <?php endif; ?>
      </div>

      <h2>
        <?php if ($totale > 1): ?>
          <?php if ($totale > $rows): ?>
                <?php echo __("Risultati"); ?> <?php print ($pager->getPage()-1)*$rows+1 ?> - <?php print $pager->getPage()*$rows ?> <?php echo __("di"); ?> <?php print $totale;?>
                <?php else: ?>
                  <?php print $totale ?> <?php echo __("risultati"); ?> 
          <?php endif; ?>
              <?php elseif ($totale == 1): ?>
                      <?php echo __("&Egrave; stato trovato un unico risultato"); ?>
              <?php else: ?>
                    <?php echo __("Non &egrave; stato trovato alcun risultato"); ?>
        <?php endif; ?>
      </h2>
    </div>

    <table>

    <?php $cnt=0; ?>
    <?php foreach ($pager->getResults() as $hit): ?>
      <?php $cnt++; ?>
      <tr class="<?php echo $cnt%2==0?"dark":"light"?>">
        <td width="5%"><?php echo $cnt; ?></td>
        <td width="70%"><?php echo $hit->location_name; ?></td>
        <td width="6%"><?php echo $hit->location_type_s; ?></td>
        <td><?php echo $hit->inhabitants_ui; ?></td>
        <td width="10%"><?php echo $hit->score; ?></td>
      </tr>

    <?php endforeach; ?>

    </table>

   <?php if ($pager->haveToPaginate()): ?>
    <div class="header">
      <div class="rights-elements">
        <?php echo link_to('&laquo;', "solr/search?query=$query&page=1") ?>
        <?php echo link_to('&lt;', "solr/search?query=$query&page=".$pager->getPreviousPage()) ?>

        <?php foreach ($pager->getLinks() as $page): ?>
          <?php 
          if ($page == $pager->getPage()){
            echo $page;
          } else {
            echo link_to($page, "solr/search?query=$query&page=$page");
          }
          ?>            
          <?php echo ($page != $pager->getCurrentMaxLink()) ? '-' : '' ?>
        <?php endforeach; ?>

        <?php echo link_to('&gt;', "solr/search?query=$query&page=".$pager->getNextPage()) ?>
        <?php echo link_to('&raquo;', "solr/search?query=$query&page=".$pager->getLastPage()) ?>
      </div>

      <h2>
        <?php if ($totale > 1): ?>
          <?php if ($totale > $rows): ?>
                <?php echo __("Risultati"); ?> <?php print ($pager->getPage()-1)*$rows+1 ?> - <?php print $pager->getPage()*$rows ?> <?php echo __("di"); ?> <?php print $totale;?>
                <?php else: ?>
                  <?php print $totale ?> <?php echo __("risultati"); ?> 
          <?php endif; ?>
              <?php elseif ($totale == 1): ?>
                      <?php echo __("&Egrave; stato trovato un unico risultato"); ?>
              <?php else: ?>
                    <?php echo __("Non &egrave; stato trovato alcun risultato"); ?>
        <?php endif; ?>
      </h2>
    </div>
  <?php endif; ?>

  </div>

<?php endif; ?>
