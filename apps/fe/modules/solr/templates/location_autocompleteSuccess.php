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
<ul>
  <?php if ($sf_flash->has('err_msg')): ?>
    <!--
    <li style="color: red">
      <?php echo $sf_flash->get('err_msg'); ?>
    </li>
    -->
  <?php else: ?>
    <?php if ($totale>0): ?>
      <?php foreach ($hits as $hit): ?>
        <li id="<?php echo $hit->loc_id;?>"><?php echo trim($hit->location_name) ?> (<?php echo $hit->prov_us; ?>)</li>
      <?php endforeach; ?>
    <?php endif; ?>
  <?php endif; ?>
</ul>