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

<!-- #################### INIZO TITOLO ####################  -->
<div id="title">
<h1>Prenota la tua registrazione </h1>
</div>
<!-- #################### FINE TITOLO ####################  -->

<hr />

<div class="genericblock">

  <div class="prenotapw">
    <h2>openpolis &egrave; in fase di test</h2>
    <br />

    <?php echo form_tag('@add_requiring_user', 'id=prenota_form class=form') ?>
      Per il momento la registrazione &egrave; riservata a un numero di utenti limitato. <br />
      <strong>Lascia il tuo indirizzo e-mail, sarai avvisato non appena la registrazione al sito sar&agrave; aperta.</strong><br />
      <br />

      <label for="prenota_email"><strong>la tua e-mail</strong></label>
      <br />
      <?php echo form_error('prenota_email') ?>

      <?php echo input_tag('prenota_email', $sf_params->get('prenota_email'), array('name'=>'prenota_email', 'id'=>'prenota_email', 'type'=>'text', 'size'=>'35')) ?> 
      <br /><br />
  
      <?php echo checkbox_tag('beta', 1, false) ?> 
      <label for="beta">voglio essere un <em>beta-tester</em></label>
      <br /><br />

      <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>

      <?php echo submit_tag('invia', array('class'=>'entra')) ?>
      <br /><br />
    
      <em>La tua e-mail verr&agrave; utilizzata esclusivamente per spedirti il messaggio di avviso.</em>
    </form>
  </div>

</div>


