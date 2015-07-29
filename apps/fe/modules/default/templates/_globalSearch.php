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
<div id="search_box">
  <div class="tab">
    <a class="current">Trova i tuoi rappresentanti</a>
  </div>
  <div class="tab">
    <?php echo link_to_remote('Trova il politico', array('update' => 'search_box', 
                                                         'url' => 'default/searchForm1', 
                                                         'script' => true)) ?>
  </div>
  <br /><br />
  <div class="white" style="height:80px">
  	Scopri chi sono i rappresentanti del tuo territorio dal Comune al Parlamento europeo <br />
    <?php echo form_tag('default/choice2', array('id'=>'location_search_form', 'name'=>'location_search_form')) ?>
      <?php echo include_partial('autocompleter/locationAutocompleter') ?>
      <input id="Submit" class="cerca" type="submit" value="Cerca" name="Submit" />
    </form>
  </div>
</div>