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
<?php echo use_helper('Javascript', 'Date', 'Text', 'Global', 'Declaration', 'Lightbox') ?>

<div class="sottomenu">
  <span class="add">
    <?php echo link_to('&raquo; Aggiungi dichiarazione', 'polDeclarations/create?mode=add&has_layout=true&politician_id='.$politician_id, array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 'class'=>'orange')); ?>
  </span>
  Ordina per:&nbsp;
  <?php if ($sort == 'last'): ?>  
    <div>Data della dichiarazione</div>
    <div>
      <?php echo link_to_remote('Data di inserimento', array(
        'update' => 'declaration_container',
        'url'    => 'polDeclarations/blockForPoliticianPage?politician_id='.$politician_id.'&sort=insert&limit='.$limit.'&total='.$total,
      )) ?>  
    </div>
    <div>
      <?php echo link_to_remote('Numero voti', array(
        'update' => 'declaration_container',
        'url'    => 'polDeclarations/blockForPoliticianPage?politician_id='.$politician_id.'&sort=popular&limit='.$limit.'&total='.$total,
      )) ?>  
    </div>
  <?php elseif ($sort == 'insert'): ?>
    <div>
      <?php echo link_to_remote('Data della dichiarazione', array(
        'update' => 'declaration_container',
        'url'    => 'polDeclarations/blockForPoliticianPage?politician_id='.$politician_id.'&sort=last&limit='.$limit.'&total='.$total,
      )) ?>  
    </div>
    <div>Data di inserimento</div>
    <div>
      <?php echo link_to_remote('Numero voti', array(
        'update' => 'declaration_container',
        'url'    => 'polDeclarations/blockForPoliticianPage?politician_id='.$politician_id.'&sort=popular&limit='.$limit.'&total='.$total,
      )) ?>  
    </div>  
  <?php else: ?>
    <div>
      <?php echo link_to_remote('Data della dichiarazione', array(
        'update' => 'declaration_container',
        'url'    => 'polDeclarations/blockForPoliticianPage?politician_id='.$politician_id.'&sort=last&limit='.$limit.'&total='.$total,
      )) ?>  	
    </div>
    <div>
      <?php echo link_to_remote('Data di inserimento', array(
        'update' => 'declaration_container',
        'url'    => 'polDeclarations/blockForPoliticianPage?politician_id='.$politician_id.'&sort=insert&limit='.$limit.'&total='.$total,
      )) ?>  
    </div>
	<div>Numero voti</div>
  <?php endif; ?>
</div>
<!-- #################### INIZIO LISTA DICHIARAZIONI ####################  -->
<div class="dichiarazione">
  <ul>
    <?php foreach($declarations as $declaration): ?>
      <!-- #################### INIZIO SINGOLA DICHIARAZIONE ####################  -->
	    
	    <li class="clearfix">
	      
	      <!-- meccanismo per il voto -->
        <div class="vote-container" id="vote_<?php echo $declaration->getContentId()?>">
          <?php echo include_partial('opinableContent/voteContent', 
                                     array('content' => $declaration,
                                           'label' => sfConfig::get('app_voting_label_declaration'))) ?>
        </div>
       
        <div class="content">
          <h4>
             <?php echo link_to('&raquo;&nbsp;'.$declaration->getTitle(), 
  			                           '@dichiarazione_new?'.$declaration->getSlugUrl(),
//'@dichiarazione?declaration_id='.$declaration->getContentId(),
  									   array('lang'=>'it', 'xml:lang'=>'it', 'hreflang'=>'it', 'title'=>'')) ?> 
          </h4>

          <span class="first">
            <span class="date">(<?php echo format_date($declaration->getDate(), 'dd MMMM yyyy') ?>)</span> - fonte: 
      		  <span class="fonte"><?php echo $declaration->getSourceName() ?></span> - inserita il 
      		  <span class="date"><?php echo format_date($declaration->getOpOpenContent()->getOpContent()->getCreatedAt(), 
      		                                            'dd MMMM yyyy') ?></span> da 
      		  <?php echo link_to($declaration->getOpOpenContent()->getOpUser()->__toString(),
      		                     '@user_profile?hash='.$declaration->getOpOpenContent()->getOpUser()->getHash()); ?>
      		</span>
      		<?php if (($updater = $declaration->getOpOpenContent()->getOpUpdater()) && $sf_user->hasCredential('administrator')): ?>
            <span style="color: gray; font-weight: normal; font-size: 11px">- ultima modifica di
            <?php if ($updater->getId() != 1): ?>  
              <?php echo link_to($updater, '@user_profile?hash='.$updater->getHash()) ?>
            <?php else: ?>
              admin
            <?php endif ?>
            il
            <?php echo format_date($declaration->getOpOpenContent()->getOpContent()->getUpdatedAt(), "dd/MM/yyyy");?></span>
          <?php endif ?>          
      		<br />

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
      		  <?php echo format_number_choice('[0] nessun commento|[1] 1 commento|(1,+Inf] %1% commenti', array('%1%' => $comments_number), $comments_number) ?>
          </span>

        </div>
      </li>

	  <!-- #################### FINE SINGOLA DICHIARAZIONE ####################  -->
    <?php endforeach; ?>
  </ul>
  <?php if ($total>10) : ?>
  <div class="do">
        
  	<?php echo link_to_remote('&raquo; Leggi tutte le dichiarazioni ('.$total.')', array(
        'update' => 'declaration_container',
        'url'    => 'polDeclarations/blockForPoliticianPage?politician_id='.$politician_id.'&sort=last&limit=no_limit&total='.$total,
      )) ?>
  </div>
  <?php endif; ?> 
</div>
<!-- #################### FINE LISTA DICHIARAZIONI ####################  -->