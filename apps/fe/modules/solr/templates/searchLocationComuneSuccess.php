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
<?php echo form_tag('solr/searchLocationComune') ?>
  <?php echo input_tag('location', '') ?>
  <?php echo submit_tag('Cerca') ?>
</form>

<?php if ($sf_flash->has('err_msg')): ?>
    <div><?php echo $sf_flash->get('err_msg'); ?></div>
<?php else: ?>
  <?php if ($totale>0): ?>
    <div><?php echo $c_query ?></div>
    <?php foreach ($hits as $hit): ?>
      <div><?php echo trim($hit->location_name) ?> (<?php echo $hit->prov_us; ?>)</div>
    <?php endforeach; ?>
  <?php else: ?>
    <div>Nessun risultato <!--<?php echo $c_query ?>--></div>
  <?php endif; ?>
<?php endif; ?>
