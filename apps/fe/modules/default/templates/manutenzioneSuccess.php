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
<div style="margin-top: 80px; text-align: center; font-size: 36px; color:#FF6600; font-weight:bold;">
  Il sito &egrave; in manutenzione
</div>
<div style="margin-top: 20px; text-align: center; font-size: 28px; color: #ff6600; ">
  tra qualche ora saremo di nuovo online
</div>

<div style="margin-top: 50px; margin-bottom: 50px; text-align: center; font-size: 14px">
  <p style="font-size: 30px; margin-bottom: 0"><span class="highlight">sostieni openpolis!</span></p>
  <p style="font-size: 24px"><span class="highlight">un progetto indipendente finanziato dalla comunit&agrave;</span></p>
  <p style="margin-top: 20px;">dona con carta di credito o paypal.</p>
  <form method="post" action="https://www.paypal.com/cgi-bin/webscr">
    <input type="hidden" value="_xclick" name="cmd"/>
    <input type="hidden" value="info@openpolis.it" name="business"/>
    <input type="hidden" value="Donazione occasionale per openpolis" name="item_name"/>
    <label for="importo"><strong>donazione di </strong> 
      <input class="donazioni" 
             value="10" name="amount"/> &euro;</label> 
    <input type="hidden" value="PayPal" name="page_style"/>
    <input type="hidden" value="1" name="no_shipping"/>
    <input type="hidden" value="http://www.openpolis.it" name="return"/>
    <input type="hidden" value="1" name="no_note"/>
    <input type="hidden" value="EUR" name="currency_code"/>
    <input type="hidden" value="0" name="tax"/>
    <input type="hidden" value="IT" name="lc"/>
    <input type="hidden" value="PP-DonationsBF" name="bn"/>
    <input type="submit" class="dona" value="dona" name="submit" style="margin-left: 75px;"/>
  </form>
</div>
