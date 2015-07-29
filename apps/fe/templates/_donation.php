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
<div class="donablock">
  <div class="header">
    <span class="rights-elements">
      <?php echo link_to(image_tag('buttons/close.png', array('id' => 'donation_container_toggle_img', 'alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14')) , '#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'onclick' => 'return toggleContainer(\'donation_container\')')) ?> 
    </span>
    <h3>Contribuisci ad openpolis</h3>
  </div>
  <div id="donation_container" class="textblock">
    <ul>
      <li>
        Il contributo di molti &egrave; la garanzia per <strong>l'indipendenza</strong> e la <strong>sostenibilt&agrave;</strong> di openpolis.<br/>
        <center><?php echo link_to(image_tag('buttons/dona.png', array('alt'=>'Dona', 'width'=>'130', 'height'=>'26')),'@contribuisci#op1', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it') ) ?></center>
      </li>
    </ul>
  </div>
</div>
<br />