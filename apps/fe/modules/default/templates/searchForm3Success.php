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

<p>
  <?php echo link_to_remote('i tuoi rappresentanti', array('update' => 'search', 'url' => 'default/searchForm2', 'script'=>'true')) ?>
  <?php echo link_to_remote('tutti i politici', array('update' => 'search', 'url' => 'default/searchForm1', 'script'=>'true')) ?>
  <b>gli argomenti</b>
</p>

<p class="form_container">
  <?php echo form_tag('default/choice3', array('id'=>'argument_search_form', 'name'=>'argument_search_form')) ?>
    <!--<label for="location" style="padding-right:50px"><?php echo __('Find YOUR argument'); ?></label> -->
    <?php echo form_error('argument') ?><br />
    <?php echo include_partial('autocompleter/argumentAutocompleter') ?>
    <?php //echo submit_tag(__('Search')) ?>
  </form>		
</p>