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
<div class="sfTMessageContainer sfTLock"> 
  <?php echo image_tag('/sf/sf_default/images/icons/lock48.png', array('alt' => 'login required', 'class' => 'sfTMessageIcon', 'size' 
=> '48x48')) ?>
  <div class="sfTMessageWrap">
    <h1>Accesso ristretto</h1>
    <h4>Questa non &egrave; una pagina pubblica.</h4>
  </div>
</div>
<dl class="sfTMessageInfo">
  <dt>Come accedere a questa pagina</dt>
  <dd>Occorre avere la username e la password di amministrazione.</dd>

  <dt>Cosa fare</dt>
  <dd>
    <ul class="sfTIconList">
      <li class="sfTLinkMessage"><?php echo link_to('Vai al login', '/default/logout') ?></li>
      <li class="sfTLinkMessage"><?php echo link_to('Vai alla gestione etichette', '/bdLabel') ?></li>
      <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">Torna alla pagina precedente</a></li>
    </ul>
  </dd>
</dl>
 
