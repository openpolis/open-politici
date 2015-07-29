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


<div id="title">
  <h1>Conferma la tua domanda di adozione!</h1>
</div>

<?php if ($type == 'pol'): ?>
  <p>L'adozione &egrave; una scelta lodevole, un atto d'amore che comporta anche certe responsabilit&agrave;.<br/>
 Quando la tua richiesta sar&agrave; accettata dagli amministratori di openpolis, avrai:</p>
  
  <p>&raquo;&nbsp; una cura particolare e una certa continuit&agrave; nella <strong>pubblicazione delle dichiarazioni</strong> del politico e nell'aggiornamento delle informazioni che lo riguardano</p>
  <p>&raquo;&nbsp; un'attenzione alla <strong>verifica dei dati</strong> inseriti dagli altri utenti.</p>
  <p>
  Verrai per questo abilitata/o alla <strong>moderazione delle informazioni</strong>, con la possibilita di modificare e oscurare i contenuti inesatti/offensivi.<br/>
  La correttezza e l'affidabilit&agrave; delle informazioni sono il presupposto su cui si basa la credibilit&agrave; di openpolis, che dipende in maniera importante anche da te.
  </p>
<?php else: ?>
<h2>Stai facendo richiesta di adozione per TUTTI i politici della localit&agrave; scelta.</h2> 
<p>L'adozione &egrave; una scelta lodevole, un atto d'amore che comporta anche certe responsabilit&agrave;.<br/>
 Quando tua richiesta sar&agrave; accettata dagli amministratori di openpolis, avrai:</p>
  
  <p>&raquo;&nbsp; una cura particolare e una certa continuit&agrave; nella <strong>pubblicazione delle dichiarazioni</strong> dei politici e nell'aggiornamento delle informazioni che li riguardano</p>
  <p>&raquo;&nbsp; un'attenzione alla <strong>verifica dei dati</strong> inseriti dagli altri utenti.</p>
  <p>
  Verrai per questo abilitata/o alla <strong>moderazione delle informazioni</strong>, con la possibilita di modificare e oscurare i contenuti inesatti/offensivi.<br/>
  La correttezza e l'affidabilit&agrave; delle informazioni sono il presupposto su cui si basa la credibilit&agrave; di openpolis, che dipende in maniera importante anche da te.
  </p>
<?php endif; ?>


<?php echo form_tag($form_action); ?>
  <?php echo input_hidden_tag('referer', $referer) ?>
  <?php if ($type == 'pol'): ?>
    <?php echo input_hidden_tag('content_id', $adoptee_id) ?>
  <?php else: ?>
    <?php echo input_hidden_tag('location_id', $adoptee_id) ?>
  <?php endif; ?>
  
  <?php echo submit_tag('Adotta!', array('class'=>'cerca')) ?>&nbsp;&nbsp;
  <?php echo link_to('Annulla', $referer); ?>
 
</form>
<hr />
 <br/> <br/>


