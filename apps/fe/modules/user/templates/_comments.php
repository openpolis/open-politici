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
<?php use_helper('Date', 'Javascript', 'Text') ?>

<?php include_partial('user/header', array('current' => 'commenti', 'hash' => $hash, 'subscriber' => $subscriber)) ?>

<?php if ($comments): ?>
  <table class="utente">
    <?php foreach($comments as $comment): ?>
      <?php
    		$c = new Criteria();
    		$c->Add(OpDeclarationPeer::CONTENT_ID, $comment->getContentId());
    		$declaration=OpDeclarationPeer::doSelectOne($c);
    	?>
      <tr>
        <td class="last">
          <?php echo format_date($comment->getOpOpinableContent()->getOpOpenContent()->getOpContent()->getCreatedAt(), "dd/MM/yyyy (HH:mm)");?>
          -
          <?php if ($comment->getOpOpinableContent()->getOpOpenContent()->getOpContent()->getOpClass() == 'OpDeclaration'): ?>
         	  <?php echo link_to(truncate_text($comment->getBody(),50, '...'),
         	                     //'polDeclarations/index?declaration_id=' . $comment->getContentId() .
         	                    '@dichiarazione_new?'.$declaration->getSlugUrl(). 
								'#commento_' . $comment->getId()) ?>
         	<?php elseif ($comment->getOpOpinableContent()->getOpOpenContent()->getOpContent()->getOpClass() == 'OpTheme'): ?>
         	  <?php echo link_to(truncate_text($comment->getBody(),50, '...'),
         	                     '@tema?theme_id=' . $comment->getContentId() .
         	                     '#commento_' . $comment->getId()) ?>
         	<?php endif; ?>
       	  <span>gradimento:&nbsp;<?php echo $comment->getRelevancyUpPercent() ?>%&nbsp;(su&nbsp;<?php echo count($comment->countOpCommentReports()) ?>)</span>
       </td>
      </tr>
	  <?php endforeach; ?>
	</table>
<?php else: ?>
  <div>Nessun commento inserito fino a questo punto</div>
<?php endif; ?>
