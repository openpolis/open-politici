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
<?php echo use_helper('Global') ?>

<div id="title"> 
<em></em>
<h1>RSS/XML</h1>
</div>
<!-- #################### FINE TITOLO ####################  -->

<hr />
<!-- #################### INIZO REGIONI ####################  -->
<div class="genericblock">Sono stati sviluppati degli strumenti per facilitare l'esportazione delle informazioni da openpolis, altri sono in fase di realizzazione.<br />
Hai a disposizione numerosi flussi <strong>rss <a href="http://it.wikipedia.org/wiki/Really_simple_syndication">[?]</a></strong> e <strong>xml <a href="http://it.wikipedia.org/wiki/Xml">[?]</a></strong>, oltre a dei widget pensati per la <?php echo link_to('pubblicazione diretta e aggiornata nei blog', 'static/blog') ?>.<br /><br />

Cerca nel sito le icone <?php echo image_tag('symbols/rss.png', array('alt'=>'Esporta RSS', 'width'=>'23', 'height'=>'12', 'border'=>'0')) ?> e <?php echo image_tag('symbols/xml.png', array('alt'=>'Esporta RSS', 'width'=>'23', 'height'=>'12', 'border'=>'0')) ?> Le trovi quasi in ogni pagina per vari tipi di contenuto.<br /><br />

<strong>Gli rss generali sono</strong>:<br />
<ul>
<li><strong><?php echo link_to('&raquo;&nbsp;ultime dichiarazioni dei politici', 'feed/lastDeclarations' ) ?></strong></li>
<li><strong><?php echo link_to('&raquo;&nbsp;ultimi commenti degli utenti', 'feed/lastComments' ) ?></strong></li>
<li><strong><?php echo link_to('&raquo;&nbsp;ultimi argomenti discussi', 'feed/lastTags' ) ?></strong></li>
<!-- ######## RSS per moderatori e amministratori ########## -->
<?php if ($sf_user->hasCredential('administrator') || $sf_user->hasCredential('moderator')): ?>
<li><strong><?php echo link_to('&raquo;&nbsp;ultimi contenuti segnalati come errati', 'feed/lastReports' ) ?></strong></li>
<li><strong><?php echo link_to('&raquo;&nbsp;ultimi politici inseriti', 'feed/lastPoliticians' ) ?></strong></li>
<li><strong><?php echo link_to('&raquo;&nbsp;ultimi contatti e link', 'feed/lastResources' ) ?></strong></li>
<li><strong><?php echo link_to('&raquo;&nbsp;ultime cariche istituzionali', 'feed/lastInstitutionCharges' ) ?></strong></li>
<li><strong><?php echo link_to('&raquo;&nbsp;ultime cariche politiche', 'feed/lastPoliticalCharges' ) ?></strong></li>
<li><strong><?php echo link_to('&raquo;&nbsp;ultime cariche organizzative', 'feed/lastOrganizationCharges' ) ?></strong></li>
<li><strong><?php echo link_to('&raquo;&nbsp;ultimi utenti registrati', 'feed/lastUsers' ) ?></strong></li>
<?php endif; ?>
</ul>
<br />

<strong>Inoltre trovi altri rss</strong>:<br />
<ul>

<li>&raquo;&nbsp;le ultime dichiarazioni dei componenti della Giunta e del Consiglio di una Regione, Provincia o Comune [es. <?php echo link_to('Comune di Roma','@feed_institution_declarations?institution_id=5132') ?>], nelle pagine delle <?php echo link_to('singole amministrazioni locali', '@politici_new') ?></li>
<li>&raquo;&nbsp;le ultime dichiarazioni di un politico [es. <?php echo link_to('On. Luciano Violante','@feed_politician_last_declarations?politician_id=781') ?>], nelle pagine dei politici</li>
<li>&raquo;&nbsp;le ultime dichiarazioni di tutti i politici su uno specifico argomento [es. <?php echo link_to('Immigrazione', '@feed_tag_declarations?tag_id=52') ?>], nelle pagine dei singoli <?php echo link_to('argomenti', '@argomenti_new') ?>.</li>
</ul>
<br /> 
L'utilizzo degli rss &egrave; libero se senza scopo di lucro. Per altri usi, consulta la pagina <?php echo link_to('condizioni d\'uso', '@condizioni', array('lang'=>'it', 'hreflang'=>'it', 'title'=>'condizioni d\'uso')) ?>.<br /><br />

<strong>I flussi xml generali sono </strong>:
<ul>
<li><strong><?php echo link_to('&raquo;&nbsp;presenze in aula dei deputati', '/RssTotalePresenzeCamera' ) ?></strong></li>
<li><strong><?php echo link_to('&raquo;&nbsp;presenze in aula dei senatori', '/RssTotalePresenzeSenato' ) ?></strong></li>
<li><strong><?php echo link_to('&raquo;&nbsp;indice di attivit&agrave; dei deputati', '/RssTotaleIndiceCamera' ) ?></strong></li>
<li><strong><?php echo link_to('&raquo;&nbsp;indice di attivit&agrave; dei senatori', '/RssTotaleIndiceSenato' ) ?></strong></li>
</ul>
<br />
<strong>Nella pagina di ogni <?php echo link_to('deputato','@politico_new?slug=silvio-berlusconi&content_id=204') ?> e <?php echo link_to('senatore','@politico_new?slug=lamberto-dini&content_id=1552') ?> trovi xml per</strong>:
<ul>
<li>&raquo;&nbsp;i voti chiave del politico</li>
<li>&raquo;&nbsp;le presenze in aula alle votazioni elettroniche</li>
<li>&raquo;&nbsp;l'indice di attivit&agrave; del parlamentare</li>
</ul>

<br />
L'utilizzo degli xml &egrave; libero se senza scopo di lucro. Per altri usi, consulta la pagina <?php echo link_to('condizioni d\'uso', '@condizioni', array('lang'=>'it', 'hreflang'=>'it', 'title'=>'condizioni d\'uso')) ?>.<br />
<br />
</div>
<br />