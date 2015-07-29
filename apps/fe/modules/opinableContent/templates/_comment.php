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
<?php use_helper('Date', 'User', 'Javascript') ?>
<a name="commento_<?php echo $comment->getId() ?>"></a>	
<span class="first">
  <?php echo __('Inserito il <span class="date">%2%</span> da %1%', array('%1%' => link_to($comment->getOpUser()->__toString(), '@user_profile?hash='.$comment->getOpUser()->getHash()), '%2%' => format_date($comment->getCreatedAt(), 'dd MMMM yyyy'))) ?>
</span>
<br />
<cite><?php echo $comment->getBody() ?></cite><br />

<span class="interaction"> 
  <span class="abuse">
    <?php if ($sf_user->hasCredential('moderator') || $sf_user->hasCredential('administrator') ): ?>
      <?php echo link_to_remote('&raquo; elimina commento', array(
	                             'class' => 'orange', 
                               'update' => 'for_ajax',
                               'url'    => '/opinableContent/delComment?comment_id='.$comment->getId().'&sort='.$sort,
								               'confirm'  => 'Confermi la cancellazione?'
                                 )) ?>
    <?php endif; ?>
  </span>
  <div class="vote_block" id="vote_<?php echo $comment->getId() ?>">
    <strong>Vota il commento:   <?php echo include_partial('opinableContent/vote_user', array('comment' => $comment)) ?></strong>
  </div>
</span>