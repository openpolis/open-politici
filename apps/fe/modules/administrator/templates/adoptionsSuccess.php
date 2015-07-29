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

<div id="title"><h1>Gestione delle adozioni</h1></div>
<hr/>

<div class="genericblock">
Di seguito, l'elenco delle adozioni richieste dagli utenti.
Clicca su <em>lista completa</em> per visualizzare l'elenco completo (adozioni già garantite o bloccate).
</div>

<br/>

<div class="genericblock">

  <div id="indicator-container" style="margin-top: 4px;">
    <div style="display: none;" class="indicator" id="indicator"></div>
  </div>

  <div id="items_container">
      <?php include_component('administrator', 'adoptionsList', 
                              array('type' => $type, 'page'=>$page)) ?>
  </div>
</div>
