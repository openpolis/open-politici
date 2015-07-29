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
<?php use_helper('Object', 'Javascript'	
	/* canonicals links */
	, 'HeaderLinks');

	if ( sfRouting::getInstance()->getCurrentRouteName() == 'comunita' )
		add_link(
			'@comunita_new', 'canonical'); ?>
<div id="title">
  <h1>Comunit&agrave;</h1>
</div>
<hr />

<div class="genericblock">
In questa pagina trovi i dati relativi alla comunit&agrave; degli utenti di openpolis. Cliccando sul nome di un utente si accede alla sua pagina personale. <br />
Sono in costruzione strumenti che permetteranno la comunicazione tra gli utenti stessi: messaggistica, creazione di gruppi, segnalazioni di amici , prossimit&agrave; territoriale ... <br /><br />
</div>

<div class="header">
  <h2>Utenti</h2>
</div>
<div class="genericblock">
  <div class="filtri">
    <form id="filtrapolitico" name="filtrapolitico" method="post" action="">
      <label for="filtra"><strong>Filtra per regione:</strong></label>
      <br />
      <?php echo select_tag('filtra', 
                            objects_for_select($regions, 'getRegionalId', '__toString', '',
                                               array('include_custom' => '--- seleziona una regione ---'))); ?>
    </form>

    <br/>

    <form id="filtrapolitico_loc" name="filtrapolitico_loc" method="post" action="" onsubmit="return false;">
      <label for="location"><strong>Filtra per comune:</strong></label>
      <br/>
      <?php echo include_partial('autocompleter/locationAutocompleter', 
                                 array('location'=>$sf_params->get('location'), 
                                       'location_id'=>$sf_params->get('location_id'), 
                                       'size'=>'30', 'value'=>'Inserisci il nome del comune')) ?>
      <input type="button" class="cerca" id="location_search" name="location_search" value="Cerca"/>
    </form>

    <br/>

    <div style="font-weight: bold">
      <a href="#" id="location_filter_reset" name="location_filter_reset">azzera il filtro</a>
    </div>

  </div>

  <div id="indicator-container" style="margin-top: -10px">
    <div style="display: none;" class="indicator" id="users_indicator"></div>
  </div>
  <div id="users_container">
    <?php include_component('user', 'usersList', array('region_id' => '-1' ,'location_id' => -1, 
                                                       'sort_field' => 'none', 'sort_order' => 'DESC')) ?>   
  </div>
</div>



<?php echo javascript_tag("
  updateList = function() {
    location_id = $('location_id').value;
    if($('location').value =='')
    {
      location_id = '-1';
      $('location').value = 'Inserisci il nome del comune';
    }
    location_name = $('location').value;
    if (location_id=='') location_id=-1;
    $('location')._cleared = false;
    $('location_search').activate();
    new Ajax.Updater('users_container', 
                     'user/usersList/location_id/'+location_id+'/location/'+location_name, 
                     {asynchronous:true, evalScripts:false});	
    return false;
  }
  
  Event.observe($('filtra'), 'change', function(event) { 
    region_id = $('filtra')[$('filtra').selectedIndex].value;
    if(region_id=='')
      region_id = '-1';
    $('location_id').value = -1;
    $('location').value = 'Inserisci il nome del comune';
    new Ajax.Updater('users_container', 'user/usersList/region_id/'+region_id, {asynchronous:true, evalScripts:false});	
  })

  Event.observe($('location_search'), 'click', function(event) { 
    $('filtra').selectedIndex = 0;
    updateList();
  });
   
  Event.observe($('location_filter_reset'), 'click', function(event) { 
    $('location').value = '';
    $('filtra').selectedIndex = 0;
    updateList();
  });
  
  Event.observe($('location'), 'keyup', function(event) { 
    var keycode = 0;
    if (event.keyCode) keycode = event.keyCode;
    else keycode = event.which;
    if (keycode==13)
      updateList();
  }); 

  
  
  
") ?>