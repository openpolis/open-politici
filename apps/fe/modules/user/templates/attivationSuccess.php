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
<!-- #################### INIZO TITOLO ####################  -->
<div id="title">
<h1>Registrazione attivata!</h1>
</div>
<!-- #################### FINE TITOLO ####################  -->
<hr />
<!-- #################### INIZO REGIONI ####################  -->

<div class="genericblock">

<strong><?php echo $user ?></strong>, benvenuto nella comunit&agrave; di openpolis!.<br /><br />
 Comincia aggiungendo subito una <strong>tua presentazione</strong> e <strong>un'immagine</strong>, nella tua  <strong><?php echo link_to('pagina personale', '@user_profile?hash='.$user->getHash()) ?></strong>.<br /><br />
 Da ora puoi inoltre <strong>inserire nuovi contenuti</strong> (dichiarazioni di un politico, incarichi, ...) e segnalare le informazioni che ritieni inesatte.<br />
 La crescita e l'affidabilit&agrave; di openpolis dipendono anche da te.


<br/><br/>

</div>



