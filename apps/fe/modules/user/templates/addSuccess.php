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
<?php use_helper('Validation', 'Javascript') ?>
<!-- #################### INIZO TITOLO ####################  -->
<div id="title">
<h1>Registrati</h1>
</div>
<!-- #################### FINE TITOLO ####################  -->
<hr />

<div class="genericblock">

  <?php if ($sf_request->hasErrors()): ?>
    <div class="error-message">
      Verifica gli errori segnalati e riprova.
    </div>  
  <?php else: ?>
    <div style="font-size: 14px; margin-bottom: 10px">
      Per registrarti a openpolis, compila il modulo in tutte le sue parti.
    </div>
  <?php endif; ?>

  <?php echo form_tag('@add_user', 'id=login_form class=form') ?>

    <fieldset>
  
      <div class="registrati">
        <table border="0" cellspacing="0" cellpadding="0">

          <!-- NOME E COGNOME -->
          <tr>
            <td>
              <strong>Nome</strong>
              <br />
              <?php echo form_error('firstname') ?>
              <?php echo input_tag('firstname',  $sf_params->get('firstname'), array('size'=>'50', 'type'=>'text', 'id'=>'textfiled', 'class' => $sf_request->hasError('firstname') ? 'error' : '' )) ?>
              <br /><br />
              
              <strong>Cognome</strong>
              <br />
              <?php echo form_error('lastname') ?>
              <?php echo input_tag('lastname',  $sf_params->get('lastname'), array('size'=>'50', 'type'=>'text', 'id'=>'textfiled', 'class' => $sf_request->hasError('lastname') ? 'error' : '')) ?>
              <br /><br />
              
              <?php echo checkbox_tag('pubblico', 1, $sf_params->get('pubblico')?true:false); ?>
              <label for="pubblico"><em>Rendi pubblico il mio nome e cognome (scelta consigliata) </em> </label>
            </td>
          </tr>

          <!-- NICKNAME -->
          <tr>
            <td>
              <strong>Nome utente (nickname)</strong>
              <br />
              min. 6 - max 12 caratteri o numeri
              <br />
              <?php echo form_error('nickname') ?>
              <?php echo input_tag('nickname', $sf_params->get('nickname'), array('size'=>'50', 'type'=>'text', 'id'=>'textfiled', 'class' => $sf_request->hasError('nickname') ? 'error' : '')) ?>
            </td>
          </tr>

          <!-- LOCATION -->
          <tr>
            <td>
              <strong>Il tuo comune di residenza</strong><br />
              <em>Digita le prime lettere del tuo comune e selezionalo dal menu che ti verr&agrave; proposto</em>
              <br />
              <?php echo form_error('location') ?>
              <?php echo include_partial('autocompleter/locationAutocompleter', 
                                           array('location'=>$sf_params->get('location'), 
                                                 'location_id'=>$sf_params->get('location_id'), 
                                                 'size'=>'30',
                                                 'class' => $sf_request->hasError('location') ? 'error' : '')) ?>
              <br /><br />
            </td>
          </tr>


          <!-- EMAIL -->
          <tr>
            <td>
              <strong>E-mail</strong>
              <br />
              <?php echo form_error('email') ?>
              <?php echo input_tag('email',  $sf_params->get('email'), 
                                   array('size'=>'50', 'type'=>'text', 'id'=>'textfiled', 
                                   'class' => $sf_request->hasError('email') ? 'error' : '')) ?>
              <br /><br />
              <strong>Conferma l'e-mail</strong>
              <br />
              per prevenire errori, riscrivi la tua e-mail<br />
              <?php echo input_tag('email_bis',  $sf_params->get('email_bis'), 
                                   array('size'=>'50', 'type'=>'text', 'id'=>'textfiled')) ?>
              <br />
              <label><em>La tua e-mail non sar&agrave; visibile a nessuno</em></label>
            </td>
          </tr>


          <!-- PASSWORD -->
          <tr>
            <td>
              <strong>Scegli una password</strong>
              <br />
              min. 6 - max 12 caratteri o numeri
              <br />
              <?php echo form_error('password') ?>
              <?php echo input_password_tag('password', null, array('class' => $sf_request->hasError('password') ? 'error' : '')) ?>
              <br /><br />
              <strong>Conferma la password</strong>
              <br />
              riscrivi la password scelta<strong>
              <br />
              <?php echo input_password_tag('password_bis') ?>
            </td>
          </tr>


          <!-- REGOLAMENTO E NEWSLETTER -->
          <tr>
            <td>Per procedere devi accettare le regole e le condizioni d'uso di openpolis:<br />
              <ul>
                <li><?php echo link_to('&raquo;&nbsp;Il regolamento del sito', '@regolamento') ?></li>
                <li><?php echo link_to('&raquo;&nbsp;Le condizioni d\'uso del sito', '@condizioni') ?></li>
                <li><?php echo link_to('&raquo;&nbsp;L\'informativa sui dati personali', '@informativa') ?></li>
              </ul>
              <br />
        
              <?php echo form_error('accetto') ?>
              <?php echo checkbox_tag('accetto', 1, $sf_params->get('accetto')?true:false, 
                                      array('class' => $sf_request->hasError('accetto') ? 'error' : '')); ?>
              <label for="accetto">
                <strong>Accetto il regolamento e le condizioni d'uso di openpolis</strong>
              </label>
              <br />
        
              <?php echo checkbox_tag('aggiornami', 1, $sf_params->get('aggiornami')?true:false); ?>
              <label for="aggiornami">
                Sono interessato a ricevere aggiornamenti su openpolis <em>(max due mail al mese)</em>
              </label>
              <br />
            </td>
          </tr>
    
          <!-- SUBMIT AREA -->
          <tr>
            <td>
              <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
              <?php echo submit_tag('Invia', array('class'=>'cerca')) ?>
              </td>
          </tr>
        </table>
      </div>

    </fieldset>
  </form>
</div>

