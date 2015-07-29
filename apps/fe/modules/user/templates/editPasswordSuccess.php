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
<?php use_helper('Object', 'Validation', 'Javascript') ?>

<div id="title">
  <h1>
    <span class="bacchetta">Modifica la tua password di accesso</span>
  </h1>
</div>
<hr />

<div class="genericblock">
  <div class="mask">
<table cellspacing="0" cellpadding="0" border="0">
  <?php echo form_tag('@user_edit_password', array('name'=>'passwordForm', 'id'=>'passwordForm')) ?>
    <tr>
    <td class="label">Scegli una nuova password</td>
    <td>
      <?php $msg_class = (form_has_error('password') ? 'wikitext error' : 'wikitext')?>
        <?php echo form_error('password') ?>
       <?php echo input_password_tag('password') ?><br />
        <em>lunghezza min 6 - max 12 caratteri o numeri</em>
	<tr>
        <td class="label">Riscrivi la password scelta</td>
        <td><?php echo input_password_tag('password_bis') ?></td>
        </tr>
    <tr><td></td>
    <td>
      <?php echo submit_tag('Invia', array('class'=>'cerca')); ?>
      <?php echo link_to('Annulla', '@user_profile?hash=' . $sf_user->getHash()); ?>
    </td>
    </tr>
  </form>
  </table>
  </div>
  </div>
  <br />
