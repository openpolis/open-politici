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
<?php use_helper('Javascript', 'Date') ?>
  
  
<?php if (isset($err_msg)): ?>
  <div style="font-size:16px">
    <?php echo $err_msg; ?>
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

  	  <?php if (sfConfig::get('search_query_debug')): ?>
    	  (<?php echo $QTime ?>ms)
    	  <br/><br/>debug della query<br/>
    	  <?php print $myquery ?>
      <?php endif; ?>
      
    </div>

    <table>

    <?php $cnt=0; ?>
    <?php foreach ($pager->getResults() as $hit): ?>
      <?php $cnt++; ?>
      <tr class="<?php echo $cnt%2==0?"dark":"light"?>">
        <td width="5%" style="background-color: white">
          <img src="/images/<?php echo $hit->type_us; ?>.jpeg" width="24" hright="24" 
               alt="<?php echo $hit_types[$hit->type_us] ?>" title="<?php echo $hit_types[$hit->type_us] ?>"/>
        </td>
        <td>
          <?php
          switch ($hit->type_us) {
            case 'op_politician':
              $pol_name = ucwords(strtolower($hit->politician_first_name_us) . " " . $hit->politician_last_name);
              echo link_to($pol_name." (". ($hit->politician_sex_us == 'F'?"nata":"nato") .
                           " il ".format_date($hit->pol_birth_date_dt).")",
                           "@politico?content_id=".$hit->pol_id);
              if (in_array('politician_last_institutional_charge_us', $hit->getFieldNames()))
                echo " " . $hit->politician_last_institutional_charge_us;
              break;
            case 'op_location':
              if ($hit->location_type_s == 'Comune'):
                echo link_to("Comune di ".$hit->location_name." (".$hit->prov_us.")", 
                              "/politician/munPoliticians?location_id=".$hit->loc_id);
              elseif ($hit->location_type_s == 'Provincia'):
                echo link_to("Provincia di ".$hit->location_name, 
                              "/politician/provPoliticians?location_id=".$hit->loc_id);
              elseif ($hit->location_type_s == 'Regione'):
                echo link_to("Regione ".$hit->location_name, 
                              "/politician/regPoliticians?location_id=".$hit->loc_id );
              endif;
            break;
            case 'op_tag':
              echo link_to($hit->tag, "@tag?tag=".$hit->tag_id);
            break;
            case 'op_declaration':
              echo link_to($hit->declaration_title, "@dichiarazione?declaration_id=".$hit->declaration_id);
            break;
            case 'op_comment':
              echo link_to($hit->comment_body, "@dichiarazione?declaration_id=".$hit->declaration_id."#commento");
            break;

          }
          ?>
        </td>
        <td width="10%">
          <?php echo $hit->score; ?>
        </td>
      </tr>

    <?php endforeach; ?>

    </table>
    
    <br/>
    
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

