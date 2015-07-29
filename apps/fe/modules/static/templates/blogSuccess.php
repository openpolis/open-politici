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
<em></em>
<h1>Strumenti per il tuo blog</h1>
</div>
<!-- #################### FINE TITOLO ####################  -->

<hr />
<!-- #################### INIZO REGIONI ####################  -->
<div class="genericblock">
E' disponibile un primo strumento (widget) pensato per chi vuole pubblicare i contenuti di openpolis sempre aggiornati sul proprio sito.<br /><br />

<strong>Cerca nelle pagine l'icona <?php echo image_tag('symbols/blog.png', array('alt'=>'per il tuo blog', 'border'=>'0')) ?> indica i contenuti che puoi facilmente pubblicare nel tuo sito.</strong><br /><br />
Sono disponibili:
<strong>
<ul>
<li>&raquo;&nbsp;i voti chiave di un singolo parlamentare [es. <?php echo link_to('voti chiave del Sen. Franco Turigliatto', 'widgets/WdgVoti?politician_id=1750') ?>].</li>
<li>&raquo;&nbsp;le presenze in parlamento di un singolo politico [es. <?php echo link_to('presenze del Sen. Rocco Buttiglione', 'widgets/WdgPresenze?politician_id=1503') ?>].</li>
<li>&raquo;&nbsp;l'indice di attivit&agrave; parlamentare di un singolo politico [es. <?php echo link_to('indice attivit&agrave; dell\'On. Maurizio Turco', 'widgets/WdgIndice?politician_id=761') ?>].</li>
<li>&raquo;&nbsp;le ultime dichiarazioni dei componenti della Giunta e del Consiglio di una Regione, Provincia o Comune [es. <?php echo link_to('Comune di Roma', '#') ?>] </li>
<li>&raquo;&nbsp;le ultime dichiarazioni di un politico [es. <?php echo link_to('On. Silvio Berlusconi', '#') ?>]</li>
<li>&raquo;&nbsp;le ultime dichiarazioni di tutti i politici su uno specifico argomento [es. <?php echo link_to('censura', '#') ?>]</li>

</ul>
</strong>
<br />
I passi per pubblicare sul tuo sito sono semplici:<br />
<ul>
<li><strong>1. </strong>Scegli nelle pagine di openpolis quali contenuti vuoi pubblicare</li>
<li><strong>2. </strong>Ti verra' proposta una pagina dove potrai configurare le dimensioni e i colori che vuoi usare</li>
<li><strong>3. </strong>Copia e incolla nel tuo sito, il gioco &egrave; fatto!</li>
</ul>
<br />
L'utilizzo dei widget &egrave; libero se senza scopo di lucro. Per altri usi, consulta la pagina <?php echo link_to('condizioni d\'uso', '@condizioni', array('lang'=>'it', 'hreflang'=>'it', 'title'=>'condizioni d\'uso')) ?>.<br /><br />
Se desideri altri strumenti per il tuo blog, scrivilo nel <?php echo link_to('pozzo delle idee', '#') ?>! Se cerchi flussi rss/xml <?php echo link_to('clicca qui', 'feed/index') ?>.
<br />
</div>
<br />