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
<?php
/* canonicals links */
use_helper('HeaderLinks');

if ( sfRouting::getInstance()->getCurrentRouteName() == 'last_declarations' )
	add_link(
		'@last_declarations_new?amount='. $amount ,
		'canonical');

?>
<div id="title">
  <h1>Lista delle ultime <?php echo $amount ?> dichiarazioni pubblicate</h1>
</div>
<br />
<div id="declarations_container">
  <div id="indicator-container" style="margin-top: -40px">
    <div style="display: none;" class="indicator" id="users_indicator"></div>
  </div>

  <?php include_component('polDeclarations', 'lastDeclarations', array('amount' => $amount)); ?>
  <br />
</div>
