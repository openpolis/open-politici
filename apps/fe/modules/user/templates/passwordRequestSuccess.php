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
<?php use_helper('Validation') ?>

<div id="title">
  <h1>Richiedi una nuova password</h1>
</div>

<hr />


<div class="genericblock">

<div class="prenotapw">
<h2>Hai dimenticato la tua password?</h2>
<br />
<?php echo form_tag('@user_require_password', 'class=form') ?>
<?php echo form_error('email') ?>

Inserisci il tuo indirizzo <strong>e-mail</strong>, ti verr&agrave; inviata una <strong>nuova password</strong>.<br />
<br />
<label for="email"><strong>La tua e-mail:</strong><br />

<?php echo input_tag('email', '', array('size'=>'50')) ?> 
</label>

<br /><br />
<?php echo submit_tag('invia', array('class'=>'entra')) ?>
</form>
</div>

</div>




<!--
<h1><?php echo __('receive your login details by email') ?></h1>

<div class="in_form">
  <p><?php echo __('Did you forget your password?') ?>
  <br /><?php echo __('Enter your email to receive your login details:') ?></p>
</div>

<?php echo form_tag('@user_require_password', 'class=form') ?>
  <?php echo form_error('email') ?>
  <label for="email"><?php echo __('email:') ?></label>
  <?php echo input_tag('email', '') ?>
  <br class="clearleft" />

  <div class="right">
    <?php echo submit_tag(__('send it')) ?>
  </div>
</form>
-->
