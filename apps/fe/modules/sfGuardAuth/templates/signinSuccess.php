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
<?php use_helper('Global', 'Validation', 'Javascript') ?>

<!-- #################### INIZO TITOLO ####################  -->
<div id="title">
<h1>Accedi a openpolis </h1>
</div>
<!-- #################### FINE TITOLO ####################  -->
<hr />

<!-- link dummy per caricare la script.a.culo -->
<div style="display:none">
<?php echo link_to_remote('dummy', array()); ?>
</div>

<div class="genericblock">
<h2>Per pubblicare su openpolis &egrave; necessario accedere al sistema</h2><br />

  <div class="login">
    <h2>Hai già una password? Entra!</h2><br/>

    <?php echo form_tag('@sf_guard_signin', 'id=login_form class=form') ?>
      Inserisci il tuo <strong>indirizzo email</strong> e la tua <strong>password di openpolis</strong>.<br/>
      <br/>
      <?php echo form_error('username') ?>
      <label for="username"><strong>E-mail</strong><br/>
      <?php echo input_tag('username', $sf_params->get('username'), array('size'=>'25')) ?>
      <br/>
      <br/>
      <?php echo form_error('password') ?>
      <label for="password"><strong>Password</strong><br/>
      <?php echo input_password_tag('password', '', array('size'=>'25')) ?>
      <br/>
      <br/>
      <?php 
        echo link_to('» Hai dimenticato la password?', 
                     'http://' . sfConfig::get('sf_remote_guard_host', 'op_accesso.openpolis.it') . 
                     (SF_ENVIRONMENT!='prod'?'/be_'.SF_ENVIRONMENT.'.php':'').
                     '/userProfile/passwordRequest', 
                     array('id' => 'sf_guard_auth_forgot_password')) 
      ?>
      <br/><br/>
      <?php echo submit_tag('entra', array('class'=>'entra', 'name'=>'commit')) ?>

      <label for="remember"><?php echo checkbox_tag('remember', 1) ?>ricordati di me su questo sito</label>
    </form>
  </div>

  <div class="prenota">
    <h2>Non hai una password? Registrati!</h2>
    <br>
    <strong>Tutti possono registrarsi</strong>, serve meno di un minuto.<br />
    
  
    <br>
    <div class="bottone"><?php echo link_to('registrati!', 
                                            "http://".sfConfig::get('sf_remote_guard_host',
                                                                    'local.accesso.openpolis.it').
                                            (!stristr(SF_ENVIRONMENT,'prod')?'/be_'.SF_ENVIRONMENT.'.php':'').
                                            "/aggiungi_utente"); ?>
    </div>

    <br/>
    
    <?php if (sfConfig::get('app_sf_guard_plugin_is_social', false)): ?>    
      <h2 style="margin-top: 2em;">Hai un account Facebook?</h2>
      <br>
      <div class="connect_widget">
        <?php if (is_null($fb_user)): ?>
          <a class="fb_button" href="<?php echo $facebook->getLoginUrl(array('scope' => 'email')) ?>">
            <span class="fb_button_text">Connettiti col tuo account Facebook</span>
          </a>        
        <?php endif ?>
      </div>
    <?php endif; ?>
  </div>

</div>



