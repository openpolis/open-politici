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
<!--  Main Footer -->
<footer class="container">
    <section class="row" id="global-navigation">            
        <nav class="threecol">
            <h3>L'Associazione Openpolis</h3>
            <ul>
                <li><a href="http://www.openpolis.it/chi-siamo/">Chi siamo e cosa facciamo</a></li>
		<li><a href="http://www.openpolis.it/statuto/">Statuto</a></li>
                <!-- <li><a href="http://www.openpolis.it/faq">FAQ</a></li> -->
            </ul>
            <h3>Sostienici</h3>
            <ul>
                <li><a href="http://www.openpolis.it/5xmille/">Dona il tuo 5xmille!</a></li>
                <li><a href="http://www.openpolis.it/sostienici/dona/">Fai una donazione</a></li>
                <li><a href="http://www.openpolis.it/sostienici/collabora/">Collabora con noi</a></li>
            </ul>
        </nav>
        <nav class="threecol">
            <h3>Il progetto Open politici</h3>
            <ul>
                <li><a href="http://politici.openpolis.it/contribuisci#op3">Aggiorna le informazioni</a></li>
                <li><a href="http://politici.openpolis.it/static/bookmarklet">Pubblica le dichiarazioni con un click</a></li>
                <li><a href="http://politici.openpolis.it/contribuisci#op4">Segnala errori/abusi</a></li>
                <li><a href="http://politici.openpolis.it/regolamento">Regolamento</a></li>
                <li><a href="http://politici.openpolis.it/condizioni">Condizioni d'uso</a></li>
                <li><a href="http://politici.openpolis.it/informativa">Informativa sui dati personali</a></li>
            </ul>
        </nav>
        <section class="threecol">
            <h3>Software Libero</h3>
            <ul>
                <li><a href="http://github.com/openpolis">Codice Sorgente</a></li>
                <li><a href="http://www.gnu.org/copyleft/gpl.html">Licenza GNU/GPL</a></li>
                <li><a href="http://politici.openpolis.it/software">I Software utilizzati</a></li>
            </ul>
            <div class="clearfix"></div>
        </section>
        <section class="threecol last">
            <h3>Restiamo in contatto</h3>	
            <p>Per segnalazioni, suggerimenti, lamentele ma anche incoraggiamenti:</p>
            <h4>Associazione Openpolis</h4>
            <p>via Merulana 19 - 00185 Roma<br />
                T. 06.83608392 <span class="email-nascosta">associazione[chioccia]openpolis[punto]it</span> <br /> 
                C.I. 97532050586
            </p>
            <a href="http://www.facebook.com/openpolis"><span class="icon facebook">Facebook</span></a>
            <a href="http://feeds.feedburner.com/openpolis"><span class="icon feed">Feed RSS</span></a>
            <a href="http://twitter.com/openpolis"><span class="icon twitter">Twitter</span></a>
        </section>            
    </section>
    

    <nav id="sub-footer" class="row">
        <ul class="twelvecol">
	    <li><a href="http://www.openpolis.it"><img src="/images/footers/openpolis.png" alt="Sito dell'associazione OpenPolis" title="Associazione Openpolis" /></a></li>
            <li><a href="http://parlamento.openpolis.it"><img src="/images/footers/openparlamento.png" alt="Open Parlamento" title="Open Parlamento" /></a></li>
            <li><a href="http://politici.openpolis.it"><img src="/images/footers/openpolitici.png" alt="Open Politici" title="Open politici" /></a></li>
            <li><a href="http://voisietequi.openpolis.it"><img src="/images/footers/voisietequi.png" alt="Voi Siete Qui" title="Voi Siete Qui" /></a></li>
            <li><a href="http://www.openbilanci.it/"><img src="/images/footers/openbilanci.png" alt="Open Bilanci" title="Open Bilanci" /></a></li>
        </ul>            
    </nav>
</footer>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.email-nascosta').each(function(){ jQuery(this).text(jQuery(this).text().replace('[chioccia]', '@').replace('[punto]','.')); });
    });
    
</script>
<!--  /Main Footer -->
