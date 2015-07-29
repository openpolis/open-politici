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
<?php use_helper('User', 'Global', 'Declaration', 'Date', 'Javascript', 'Lightbox' ) ?>

  <h4>
    <?php if ($declaration->getOpPolitician()->getElectoralCoalition()): ?>
      <?php echo $declaration->getOpPolitician()->getElectoralCoalition()->getName(); ?> 
    <?php endif; ?>
      <?php echo link_to($declaration->getOpPolitician()->getFirstName() . 
                         " " . 
                         strtoupper($declaration->getOpPolitician()->getLastName()),
                         '@politico_new?slug='.$declaration->getOpPolitician()->getSlug().'&content_id=' . $declaration->getPoliticianId() ); ?>
     &raquo;
     <span class="posizione <?php echo myTag::normalize($positions[$position])?>"><?php echo $positions[$position]?></span>
                                        
  	 <br />
     <?php echo link_to($declaration->getTitle(), 
                          //'@dichiarazione?declaration_id='.$declaration->getContentId(),
						    '@dichiarazione_new?'.$declaration->getSlugUrl(),
						          array('lang'=>'it', 'xml:lang'=>'it', 'hreflang'=>'it', 'title'=>'')) ?> 
  </h4>
  
  <div class="first">
    <span class="date">(<?php echo format_date($declaration->getDate(), 'dd MMMM yyyy') ?>)</span> - fonte: 
    <span class="fonte"><?php echo $declaration->getSourceName() ?></span> - inserita il 
    <span class="date"><?php echo format_date($declaration->getOpOpenContent()->getOpContent()->getCreatedAt(), 'dd MMMM yyyy') ?></span> da 
    <?php echo link_to($declaration->getOpOpenContent()->getOpUser()->__toString(), '@user_profile?hash='.$declaration->getOpOpenContent()->getOpUser()->getHash()); ?>
  </div>
  
  <?php if ($sf_user->hasCredential('administrator')): ?>
    <div class="interaction" style="margin-top: -20px">
      <span class="abuse">
        <?php echo link_to('&raquo; rimuovi associazione', 
        	                 '@rimuovi_dichiarazione_associata?declaration_id=' . $declaration->getContentId() . 
        	                   '&theme_id=' . $theme_id, 
        	                 array('onclick' => "return confirm('Sei sicuro di voler rimuovere questa associazione?')")); 
         ?>
      </span> 
    </div>
  <?php endif; ?>
