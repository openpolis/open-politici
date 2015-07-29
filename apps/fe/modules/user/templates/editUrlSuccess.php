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
<?php use_helper('Object', 'Validation') ?>
<div id="title">
  <h1>
    <span class="bacchetta">Modifica l'indirizzo del tuo sito</span>
  </h1>
</div>
<hr />

<div class="genericblock">
  <div class="mask">
<table cellspacing="0" cellpadding="0" border="0">
  <?php echo form_tag('@user_edit_url', array('name'=>'urlForm', 'id'=>'urlForm')) ?>
    <tr><td>
      <?php $msg_class = (form_has_error('url') ? 'wikitext error' : 'wikitext')?>
        <strong>Inserisci l'indirizzo del tuo sito:</strong>
        <?php echo form_error('url_personal_website') ?>
        <br />
        <?php echo object_input_tag($user, 'getUrlPersonalWebsite', array("style" => "width: 50%"), 'http://') ?>
  </td></tr>
    <tr><td>
      <?php echo submit_tag('Invia', array('class'=>'cerca')); ?>
      <?php echo link_to('Annulla', '@user_profile?hash=' . $user->getHash()); ?>
    </td></tr>
  </form>
  </table>
  </div>
  </div>
  <br />
