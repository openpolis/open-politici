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
    <span class="bacchetta">Modifica le note descrittive del tuo profilo</span>
  </h1>
</div>
<hr />

<div class="genericblock">
  <div class="mask">
  Inserisci una tua presentazione

<table cellspacing="0" cellpadding="0" border="0">

  <?php echo form_tag('@user_edit_notes?hash='.$user->getHash(), array('name'=>'notesForm', 'id'=>'notesForm')) ?>
    <tr><td>
    <?php $msg_class = (form_has_error('notes') ? 'wikitext error' : 'wikitext')?>
    <?php echo object_textarea_tag($user, 'getNotes', 
                                   array ('related_class' => 'OpDeclaration', 
    										                  'rich' => false, 
    										                  'rows'=>'8', 'cols'=>'40', 'style'=>'width:80%', 'class' => $msg_class))?>

</tr></td>    
<tr><td>
      <?php echo submit_tag('Invia', array('class'=>'cerca')); ?>
      <?php echo link_to('Annulla', '@user_profile?hash=' . $user->getHash()); ?>
</tr></td>
</form>
</table>

  <script type="text/javascript" src="/js/wikitoolbar.js"></script>
</div>
</div>
<br />