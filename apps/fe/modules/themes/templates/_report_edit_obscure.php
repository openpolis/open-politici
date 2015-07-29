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
<?php echo use_helper('Javascript', 'Themes', 'Lightbox') ?>
<?php if ($user->hasCredential('subscriber') && 
          !($user->hasCredential('moderator')) && 
          !($user->hasCredential('administrator')) &&
          $user->getSubscriberId() != $theme->getOpOpinableContent()->getOpOpenContent()->getUserId() ): ?>
          <?php echo link_to_report_theme($theme, $user) ?>
<?php else : ?>
  <?php if ($user->hasCredential('moderator') || 
            $user->hasCredential('administrator') ||
            $user->getSubscriberId() == $theme->getOpOpinableContent()->getOpOpenContent()->getUserId() ): ?>
    <?php if ($user->hasCredential('administrator') || 
              $theme->getRelevancyScore() < sfConfig::get('app_opinable_content_editable_treshold')) : ?>
      <?php echo link_to('&raquo; edit' , 'themes/edit?content_id='.$theme->getContentId(), 
                         array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
      | 
      <?php $edit_link_options = array('title' => 'oscura',
              					               'class' => 'new blocksize_600x500 orange',
              					               'onclick' => false);    
           echo light_modallink('&raquo; oscura', 
                                '@obscure_theme?theme_id=' . 
                                $theme->getContentId(), $edit_link_options); ?>
    <?php else: ?>
      per modifiche scrivi a <a href="mailto:info@openpolis.it">info[at]openpolis.it</a>
    <?php endif; ?>
  <?php else: ?>
    <?php echo link_to('&raquo; Segnala errori / abusi', '@sf_guard_signin', 
                       array('title'=>'', 'class'=>'orange' ,'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
  <?php endif; ?>
<?php endif; ?>
