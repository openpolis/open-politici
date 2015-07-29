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
    <span class="bacchetta">Modifica il tuo comune di residenza</span>
  </h1>
</div>
<hr />

<div class="genericblock">
  <div class="mask">
  Digita le prime lettere del tuo comune e selezionalo dal menu che ti verr&agrave; proposto.

<table cellspacing="0" cellpadding="0" border="0">
  <?php echo form_tag('@user_edit_location', array('name'=>'locationForm', 'id'=>'locationForm')) ?>
    <tr><td>
      <?php echo form_error('location_id') ?>
      <strong>Il tuo comune di residenza:</strong>
      <br />
      <?php echo include_partial('autocompleter/locationAutocompleter', 
                                   array('location'=>$user->getOpLocation()->getName() . "(" .$user->getOpLocation()->getProv(). ")" , 
                                         'location_id'=>$user->getLocationId(), 
                                         'size'=>'50')) ?><br />
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