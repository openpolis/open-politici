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
<?php if ($sf_user->hasCredential('moderator')): ?>
  <div class="adminblock">
    <div class="header">
      <span class="rights-elements">
        <?php echo link_to(image_tag('buttons/close.png', array('id' => 'moderator_container_toggle_img', 'alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14')) , '#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'onclick' => 'return toggleContainer(\'moderator_container\')')) ?> 
	  </span>
      <h3>Strumenti moderatore</h3>
    </div>
    <div id="moderator_container" class="textblock">
      <ul>
	    <li><?php echo link_to(__('report'), 'moderator/userReports') ?> (<?php echo OpContentPeer::getReportCount() ?>)</li>
	    <li><?php echo link_to(__('contenuti oscurati'), 'administrator/obscuredContents') ?> (<?php echo OpObscuredContentPeer::doCount(new Criteria()) ?>)</li>
	    <li><?php echo link_to(__('commenti report'), 'moderator/userCommentReports') ?> (<?php echo OpCommentPeer::getCommentReportCount() ?>)</li>
      <!-- <li><?php echo link_to(__('unpopular tags'), 'moderator/unpopularTags') ?></li> -->
      </ul>
    </div>
  </div>  
<br />
<?php endif; ?>


