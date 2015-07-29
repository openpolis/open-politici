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
<?php use_helper('User') ?>

<?php
  $class = 'few_interests';
  if ($content->getRelevancyScore() > 1000)
  {
    	$class = 'many_interests';
  }
  else if ($content->getRelevancyScore() > 100)
  {
    	$class = 'some_interests';
  }
?>

<div class="interested_mark <?php echo $class ?>" id="interested_content_<?php echo $content->getContentId() ?>">
  <span class="vote vote_show"><?php echo '&nbsp;&nbsp;'.$content->getRelevancyScore().'&nbsp;&nbsp;'?></span> 
  <?php echo $label ?> |
  <?php if (!isset($mode) || $mode != 'show_votes'): ?>
    <strong><?php echo link_to_user_interested($sf_user, $content) ?></strong> |    
  <?php endif ?>  
  
  <?php  $c = new Criteria();
	    $c->add(OpCommentPeer::CONTENT_ID, $content->getContentId());
	    $comments_number=OpCommentPeer::doCount($c);
	  ?>
	  <?php echo format_number_choice('[0] Nessun commento|[1] 1 commento|(1,+Inf] %1% commenti', array('%1%' => $comments_number), $comments_number) ?>    
	    | 
      <strong>
        <?php if ($sf_user->hasCredential('subscriber')): ?>							
	      <a href="#commento" title="" hreflang="it" lang="it" xml:lang="it" class="orange">Scrivi il tuo commento</a>
	    <?php else: ?>
	      <?php echo link_to('Commenta', '@sf_guard_signin', array('title'=>'', 'class'=>'orange', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')); ?>		
	    <?php endif; ?>	
      </strong>
</div>

