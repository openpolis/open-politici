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
<?php use_helper('Date', 'Text', 'Object', 'Javascript', 'Validation') ?>

<!-- #################### INIZO TITOLO ####################  -->
<div id="title">
  <h1>
    <?php echo $subscriber ?>
    
    <?php if ($subscriber->getId() == $sf_user->getSubscriberId()): ?>
      <span style="font-size:14px; font-weight: bold">
        [<?php echo link_to('modifica il tuo profilo', 
                            "http://".sfConfig::get('sf_remote_guard_host',
                                                    'local.accesso.openpolis.it').
                            (!stristr(SF_ENVIRONMENT,'prod')?'/be_'.SF_ENVIRONMENT.'.php':'').
                            "/aggiorna_profilo")?>]
      </span>
    <?php endif; ?>
  </h1>
</div>
<!-- #################### FINE TITOLO ####################  -->
<hr />

<div class="genericblock">

  <div class="thumb-utente">
    <div class="data">
      <div class="thumb">
        <?php if ($subscriber->getpicture()!== null && $subscriber->getPicture() != '') : ?>
          <img src="<?php echo url_for("@user_picture?hash=". $subscriber->getHash() . "&class=medium")?>" 
               alt="<?php echo $subscriber->__toString(); ?>" border="0" />
        <?php else : ?>
          <img src="/images/symbols/foto-example.png" alt="il tuo dummy" width="91" height="91" border="0" />
        <?php endif; ?>
      </div>
    </div>
  </div>

  <table class="utente">

  <?php if ($subscriber->getId() == $sf_user->getSubscriberId() || $sf_user->hasCredential('administrator') || $subscriber->getPublicName()): ?>
  <tr class="label">
    <td class="label">Nome e cognome</td>
    <td class="last"><?php echo $subscriber->getFirstname()."&nbsp;".$subscriber->getLastname() ?></td>
  </tr>
  <?php endif; ?>

  <tr>
    <td class="label">
      Presentazione
    </td>
    <td class="last">
      <p><?php echo $subscriber->getNotes() ?></p>
    </td>
  </tr>

  <?php if ($subscriber->getId() == $sf_user->getSubscriberId() || $sf_user->hasCredential('administrator')): ?>
    <tr class="label">
      <td class="label">E-mail </td>
      <td class="last"><?php echo $subscriber->getEmail() ?></td>
    </tr>
  <?php endif; ?>

    <tr class="label">
     <td class="label">
      Comune di residenza
    </td>
      <td class="last">
        <?php if ($subscriber->getOpLocation()): ?>
          <?php echo $subscriber->getOpLocation()->getName() . 
                              '&nbsp;('.$subscriber->getOpLocation()->getProv().')' ?>
        <?php else: ?>    
          Non ancora specificato.
        <?php endif ?>
      </td>
    </tr>

  <tr class="label">
    <td class="label">Data di registrazione</td>
    <td class="last"><?php echo format_date($subscriber->getCreatedat(), 'dd MMMM yyyy') ?></td>
  </tr>

  <tr class="label">
    <td class="label">
      Sito web
    </td>
    <td class="last">
      <?php if ($subscriber->getUrlPersonalWebsite() != ""): ?>
        <?php echo link_to(str_replace(array("http://", "https://", "ftp://"), "", $subscriber->getUrlPersonalWebsite()), 
                           $subscriber->getUrlPersonalWebsite()) ?>
      <?php endif; ?>
    </td>
  </tr>


  <tr class="label">
   <td class="label">Tipo utente</td>
   <?php if ($subscriber->getIsAdministrator()): ?>
     <td class="last">Amministratore</td>
   <?php else : ?>
    <?php if ($subscriber->getIsModerator()): ?>
      <td class="last">Moderatore</td>
    <?php else : ?>
      <td class="last">Registrato</td>
    <?php endif; ?>
   <?php endif; ?>
  </tr>

  </table>
  <br />
  
  
  
  <!-- dichiarazioni, temi e commenti -->

  <div id="indicator-container">
    <div id="decl_comm_indicator" class="indicator" style="display: none;"></div>
  </div>

  <div id="decl_comm">
    <?php include_component('user', 'attivita', array('hash'=>$hash ))?>
  </div>
  <br/>

  <!-- fine dichiarazioni e commenti -->

</div>