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
<?php echo form_tag('solr/searchPolitician') ?>
  <?php echo input_tag('politician', '') ?>
  <?php echo submit_tag('Cerca') ?>
</form>

<ul>
  <?php if ($sf_flash->has('err_msg')): ?>
    <!--
    <li style="color: red">
      <?php echo $sf_flash->get('err_msg'); ?>
    </li>
    -->
  <?php else: ?>
    <li><?php echo $c_query ?></li>
    <?php if (isset($totale) && $totale>0): ?>
      <?php foreach ($hits as $hit): ?>
        <li id="<?php echo $hit->pol_id;?>"
        ><?php echo ucwords(strtolower($hit->politician_first_name_us)) . " " . 
                  $hit->politician_last_name . 
                  " (". ($hit->politician_sex_us == 'F'?"nata":"nato") .
                    " il " . format_date($hit->pol_birth_date_dt) . ") - " .          
                  $hit->politician_last_institutional_charge_us ?></li>
      <?php endforeach; ?>
    <?php endif; ?>
  <?php endif; ?>
</ul>
