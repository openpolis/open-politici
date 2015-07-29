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
<?php use_helper('User', 'Text', 'Global', 'Declaration', 'Date', 'Javascript', 'Lightbox' ) ?>

<li class="clearfix">

  <!-- meccanismo per il voto -->
  <div class="vote-container" id="vote_<?php echo $declaration->getContentId()?>">
    <?php echo include_partial('opinableContent/voteContent', 
                               array('content' => $declaration,
                                     'label' => sfConfig::get('app_voting_label_declaration'))) ?>
  </div>
  
  <div class="content">
    <h4>
       <?php echo link_to(ucwords(strtolower($declaration->getOpPolitician()->getFirstName())) . 
                          " " . 
                          strtoupper($declaration->getOpPolitician()->getLastName()),
                          '@politico_new?slug='.$declaration->getOpPolitician()->getSlug().'&content_id=' . $declaration->getPoliticianId() ); ?>
        &raquo;
       <?php echo link_to($declaration->getTitle(), 
							'@dichiarazione_new?'.$declaration->getSlugUrl(),
                            //'@dichiarazione?declaration_id='.$declaration->getContentId(),
  						              array('lang'=>'it', 'xml:lang'=>'it', 'hreflang'=>'it', 'title'=>'')) ?> 
    </h4>

    <span class="first">
      <span class="date">(<?php echo format_date($declaration->getDate(), 'dd MMMM yyyy') ?>)</span> - fonte: 
      <span class="fonte"><?php echo $declaration->getSourceName() ?></span> - inserita il 
      <span class="date"><?php echo format_date($declaration->getOpOpenContent()->getOpContent()->getCreatedAt(), 'dd MMMM yyyy') ?></span> da 
      <?php echo link_to($declaration->getOpOpenContent()->getOpUser()->__toString(), '@user_profile?hash='.$declaration->getOpOpenContent()->getOpUser()->getHash()); ?>
    </span><br />

    <cite><?php echo truncate_text(strip_tags($declaration->getText()), 200 , '...') ?></cite> 
    <?php echo link_to('[leggi tutto]', 
			'@dichiarazione_new?'.$declaration->getSlugUrl(),
			//'@dichiarazione?declaration_id='.$declaration->getContentId(), 
			array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it') ) ?>

    <span class="arguments">Argomenti: 
      <?php echo tags_for_declaration($declaration) ?>
    </span>

    <span class="interaction">
      <span class="abuse">
        <?php echo include_partial('polDeclarations/report_edit_obscure', 
                                   array('user' => $sf_user, 'content' => $declaration)); ?>
      </span> 
      <?php $c = new Criteria();
            $c->add(OpCommentPeer::CONTENT_ID, $declaration->getContentId());
            $comments_number=OpCommentPeer::doCount($c->add(OpCommentPeer::CONTENT_ID, $declaration->getContentId()));
      ?>
      <span>
        <?php echo format_number_choice('[0] nessun commento|[1] 1 commento|(1,+Inf] %1% commenti', 
                                        array('%1%' => $comments_number), $comments_number) ?>
      </span>
    </span>

  </div>
</li>
