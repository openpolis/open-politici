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
<div class="text">contenuti liberi e aperti, codice <em>open source</em>, un progetto no-profit no-partisan.<br />
il contributo di molti per l'indipendenza e la sostenibilt&agrave; di openpolis.</div>
<div class="textleft">
  <h2> Cosa puoi fare?</h2>
   <ul>
      <li>
        <?php echo link_to(image_tag('home/dona_denaro.png', array('alt'=>'dona', 'width'=>'50', 'height'=>'93', 'border'=>'0')), 
                           '@contribuisci#op1'); ?>
        <?php echo link_to('donare<br />del denaro', '@contribuisci#op1'); ?>
      </li>
      <li>
        <?php echo link_to(image_tag('home/pubblica_contenuti.png', array('alt'=>'pubblica', 'width'=>'50', 'height'=>'93', 'border'=>'0')), 
                           '@contribuisci#op2'); ?>
        <?php echo link_to('pubblicare<br />nuovi contenuti', '@contribuisci#op2'); ?>
      </li>
      <li>
        <?php echo link_to(image_tag('home/segnala_errori.png', array('alt'=>'segnala errori', 'width'=>'50', 'height'=>'93', 'border'=>'0')), 
                           '@contribuisci#op3'); ?>
        <?php echo link_to('segnalare errori<br />e inesattezze', '@contribuisci#op3'); ?>
      </li>
      <li>
        <?php echo link_to(image_tag('home/sviluppa_codice.png', array('alt'=>'sviluppa', 'width'=>'50', 'height'=>'93', 'border'=>'0')), 
                           '@contribuisci#op4'); ?>        
        <?php echo link_to('sviluppare<br />il codice', '@contribuisci#op4'); ?>
      </li>
      <li>
        <?php echo link_to(image_tag('home/proponi_idee.png', array('alt'=>'nuove idee', 'width'=>'50', 'height'=>'93', 'border'=>'0')), 
                           '@contribuisci#op5'); ?>
        <?php echo link_to('proporre<br />nuove idee', '@contribuisci#op5'); ?>
      </li>
      <li>
        <?php echo link_to(image_tag('home/diffondi_voce.png', array('alt'=>'per i blog', 'width'=>'50', 'height'=>'93', 'border'=>'0')), 
                           '@contribuisci#op6'); ?>
        <?php echo link_to('pubblicare<br />sul tuo blog', '@contribuisci#op6'); ?>
      </li>
    </ul>
</div>


