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
<div class="statisticblock">
  <div class="header"> <span class="rights-elements"><a lang="it" xml:lang="it" hreflang="it" title="" href="#"><img width="15" height="14" alt="Chiudi blocco" src="/images/buttons/close.png"/></a></span>
    <h3>Numeri</h3>
  </div>
  <div class="textblock">
    <ul>
      <li><?php echo __('Uomini') ?>:&nbsp;<strong><?php echo $maschi_perc ?>%</strong><?php echo($maschi_perc > $totale_maschi_perc ? image_tag('/images/buttons/up.gif', array('style'=>'float:none') ) : image_tag('/images/buttons/down.gif', array('style'=>'float:none') )  ) ?>&nbsp;&nbsp;(media <?php echo $totale_maschi_perc ?>%)</li>
      <li><?php echo __('Donne') ?>:&nbsp;<strong><?php echo $femmine_perc ?>%</strong><?php echo($femmine_perc > (100 - $totale_maschi_perc) ? image_tag('/images/buttons/up.gif', array('style'=>'float:none') ) : image_tag('/images/buttons/down.gif', array('style'=>'float:none') )  ) ?>&nbsp;&nbsp;(media <?php echo number_format( (100 - $totale_maschi_perc) ,2 )?>%)</li>
      <li><?php echo __('Et&agrave; media') ?>:&nbsp;<strong>(<?php echo $eta_media?>&nbsp;anni)</strong><?php echo($eta_media > $eta_media_totale ? image_tag('/images/buttons/up.gif', array('style'=>'float:none') ) : image_tag('/images/buttons/down.gif', array('style'=>'float:none') )  ) ?>&nbsp;&nbsp;(media <?php echo $eta_media_totale?> anni)</li>
      <li><?php echo __('Laureati') ?>:&nbsp;<strong><?php echo ($laureati_perc) ?>%</strong><?php echo($laureati_perc > $numero_medio_laureati ? image_tag('/images/buttons/up.gif', array('style'=>'float:none') ) : image_tag('/images/buttons/down.gif', array('style'=>'float:none') )  ) ?>&nbsp;&nbsp;(media <?php echo $numero_medio_laureati ?>%)</li>
    </ul>
  </div>
</div> 
<br />