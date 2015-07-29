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
<?php if ($sf_user->hasCredential('administrator') || $sf_user->hasCredential('aggiungitore')): ?>
  <div class="adminblock">
    <div class="header">
      <span class="rights-elements">
        <?php echo link_to(image_tag('buttons/close.png', array('id' => 'admin_container_toggle_img', 'alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14')) , '#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'onclick' => 'return toggleContainer(\'admin_container\')')) ?> 
	  </span>
      <h3>Strumenti Amministrazione</h3>
    </div>
    <div id="admin_container" class="textblock">
      <ul>
  	    
        <?php include_partial('sidebar/administration_links', array()) ?>
      </ul>
    </div>
  </div>  
<br />
<?php endif; ?>