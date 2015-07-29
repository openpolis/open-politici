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
<div class="statisticblock">
  <div class="header">
    <h3>Statistiche utenti</h3>
  </div>
  <div class="textblock">
    <ul>
    <li><?php echo __('Registrati') ?>:&nbsp;<strong><?php echo $registered_users ?></strong> </li>
    <li><?php echo __('Moderatori') ?>:&nbsp;<strong><?php echo $moderators ?></strong> </li>
    <li><?php echo __("Attivi nell'ultimo mese") ?>:&nbsp;<strong><?php echo ($activeUsersInLastMonth) ?></strong></li>
    <li><?php echo __('Regioni con pi&ugrave; utenti') ?>:&nbsp;<br/><strong><?php echo ($regioniMaxUsers) ?></strong> </li>
    <li><?php echo __('Province con pi&ugrave; utenti') ?>:&nbsp;<br/><strong><?php echo ($provinceMaxUsers) ?></strong> </li>
    <li><?php echo __('Comuni con pi&ugrave; utenti') ?>:&nbsp;<br/><strong><?php echo ($comuniMaxUsers) ?></strong> </li>
    </ul>
  </div>
</div> 
<br />