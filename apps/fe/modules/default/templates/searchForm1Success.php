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
<?php use_helper('Javascript') ?>

<div class="tab">
  <?php echo link_to_remote('Trova i tuoi rappresentanti', 
                            array('update' => 'search_box', 'url' => 'default/searchForm2', 'script'=>true)) ?>
</div>

<div class="tab">
  <a class="current">Trova il politico</a>
</div>
<br /><br />
<div class="white"  style="height:80px">
  Cerca un politico tra i pi&ugrave; di 100 mila in archivio
  <?php echo form_tag('default/choice1', array('id'=>'politician_search_form', 'name'=>'politician_search_form')) ?>
  	<?php echo include_partial('autocompleter/politicianAutocompleter') ?>
  	<input type="submit" name="Submit" value="Cerca" id="Submit" class="cerca" />
  </form>
</div>