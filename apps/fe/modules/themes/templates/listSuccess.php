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
<?php echo use_helper('Javascript', 'Global', 'Date') ?>

<div id="title"><h1>Le posizioni dei partiti sui temi scelti dagli utenti</h1></div>
<hr/>

<div class="genericblock">
Nelle settimane precedenti gli utenti di openpolis hanno proposto, votato e discusso 221 temi da sottoporre ai partiti.<br />
Di questi ne sono stati selezionati 25 e sono stati spediti ai partiti (<a href="http://wiki.openpolis.it/wiki/index.php/Adesioni_dei_partiti_VsQ_2008">vedi la lista</a>) chiedendo le loro posizioni.<br /><br />
<h2>Ad oggi, <?php echo format_date(mktime()) ?>, hanno ufficialmente risposto i seguenti partiti:</h2><br />
<strong>&raquo; Per il bene comune [<a href="http://elezioni2008.voisietequi.it/risposte_partito/14.html">guarda le risposte</a>]</strong> - ricevute il 18/03/2008 ore 12:44<br />
<strong>&raquo; Popolo della Libert&agrave [<a href="http://elezioni2008.voisietequi.it/risposte_partito/3.html">guarda le risposte</a>]</strong> - ricevute il 18/03/2008 ore 16:25<br />
<strong>&raquo; Italia dei Valori [<a href="http://elezioni2008.voisietequi.it/risposte_partito/8.html">guarda le risposte</a>]</strong> - ricevute il 19/03/2008 ore 16:44<br />
<strong>&raquo; Partito Socialista [<a href="http://elezioni2008.voisietequi.it/risposte_partito/7.html">guarda le risposte</a>]</strong> - ricevute il 19/03/2008 ore 17:43<br />
<strong>&raquo; Lega Nord [<a href="http://elezioni2008.voisietequi.it/risposte_partito/2.html">guarda le risposte</a>]</strong> - ricevute il 20/03/2008 ore 13:08<br />
<strong>&raquo; La Sinistra, l'Arcobaleno [<a href="http://elezioni2008.voisietequi.it/risposte_partito/4.html">guarda le risposte</a>]</strong> - ricevute il 20/03/2008 ore 19:28<br />
<strong>&raquo; Partito Comunista dei Lavoratori [<a href="http://elezioni2008.voisietequi.it/risposte_partito/9.html">guarda le risposte</a>]</strong> - ricevute il 20/03/2008 ore 21:12<br />
<strong>&raquo; Sinistra Critica [<a href="http://elezioni2008.voisietequi.it/risposte_partito/11.html">guarda le risposte</a>]</strong> - ricevute il 22/03/2008 ore 19:54<br /><br />

<strong>I temi che sono stati selezionati formeranno dal 25 marzo le domande del test di <a href="http://www.voisietequi.it">voisietequi</a>.<br /><br /></strong>
<h2>TU dove sei? Fai il test su <a href="http://www.voisietequi.it">voisietequi</a></h2>


Di seguito la lista dei temi selezionati. Clicca sul tema e aggiungi la posizione di un politico!
</div>

<br/>

<div class="genericblock">

  <div id="indicator-container" style="margin-top: 4px;">
    <div style="display: none;" class="indicator" id="indicator"></div>
  </div>

  <div id="items_container">
      <?php include_component('themes', 'themesList', 
                              array('sort'=>$sort, 'area'=>$area, 'page'=>$page, 
                                    'limit'=>sfConfig::get('app_pagination_themes_limit'))) ?>
  </div>
</div>
