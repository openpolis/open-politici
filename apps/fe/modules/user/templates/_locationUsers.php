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
<div class="genericblock">
  <div class="header">
    <span class="rights-elements">
      <?php echo link_to(image_tag('buttons/close.png', array('id' => 'location_users_container_toggle_img', 'alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14')) , '#', array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'onclick' => 'return toggleContainer(\'location_users_container\')')) ?> 
    </span>
    <h3>Utenti pi&ugrave; attivi</h3>
  </div>
  <div id="location_users" class="nickblock">
    <ul>
      <?php foreach ($users as $user_id => $cont): ?>
        <?php $user = OpUserPeer::retrieveByPK($user_id); ?>
      <li>
        <?php if ($user->getpicture()!== null) : ?>
          <?php $img = "<img src=\"".
                          url_for('@user_picture?hash='. $user->getHash() . "&class=thumb") .
                          "\" alt=\"" . $user->__toString() . " border=\"0\"/>"; ?>
	        <?php echo link_to($img . '<br />' . $user->__toString() . "($cont)",
	                           '@user_profile?hash='.$user->getHash()); ?> 	
        <?php else : ?>
	        <?php echo link_to(image_tag('symbols/foto-example.png', 
	                                     array('alt'=>'', 'width'=>'40', 'height'=>'40', 'border'=>'0')).'<br />'.$user->__toString().'('.$cont.')', '@user_profile?hash='.$user->getHash()); ?> 	
        <?php endif; ?>
      </li>
	  <?php endforeach; ?>  
    </ul>
  </div>
</div>
<hr />
<br />