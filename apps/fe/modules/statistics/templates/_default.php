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
<?php use_helper('Number') ?>

<div class="genericblock">
  <div class="header">
    <span class="rights-elements">
      <?php echo link_to(image_tag('buttons/close.png', array('id' => 'default_statistics_container_toggle_img', 'alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14')) , '#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'onclick' => 'return toggleContainer(\'default_statistics_container\')')) ?> 
    </span>
    <h3>Numeri</h3>
  </div>
  <div id="default_statistics_container" class="textblock">
    <ul>
      <li>Utenti registrati: <strong><?php echo $registered_users; ?></strong></li>
      <li>Politici con incarichi: <strong><?php echo format_number($politici_con_incarichi) ?></strong></li>
      <li>Dichiarazioni inserite: <strong><?php echo format_number($numero_dichiarazioni) ?></strong></li>
	  <li>Argomenti inseriti: <strong><?php echo format_number($numero_argomenti) ?></strong></li>
	  <li>Politici revisionati: <strong><?php echo format_number($politici_revisionati_perc) ?>&nbsp;%</strong></li>
	  <li>Comuni revisionati: <strong><?php echo format_number($comuni_revisionati_perc) ?>&nbsp;%</strong></li>
	  <li>Province revisionate: <strong><?php echo format_number($provincie_revisionate_perc) ?>&nbsp;%</strong></li>
	  <li>Regioni revisionate: <strong><?php echo format_number($regioni_revisionate_perc) ?>&nbsp;%</strong></li>
    </ul>
  </div>
</div>