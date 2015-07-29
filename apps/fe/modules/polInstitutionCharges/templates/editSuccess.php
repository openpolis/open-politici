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
<?php echo use_helper('Javascript', 'DateForm', 'Object', 'Validation') ?>

<div id="title">
  <h1>
    <span class="bacchetta">
      Aggiungi / Modifica incarico istituzionale di <?php echo ucwords(strtolower($politician->getFirstName())) ?>&nbsp;<span class="surname"><?php echo $politician->getLastName() ?></span>
    </span>
  </h1>
</div>

<hr />

<div class="genericblock">
  <div class="mask">
  <?php echo form_tag('polInstitutionCharges/edit', array('name'=>'edit') ) ?>
    <?php if ($institution_charge->getContentId() != 0): ?>
      <?php echo object_input_hidden_tag($institution_charge, 'getContentId'); ?>
    <?php endif; ?>
    <?php if (isset($politician_id)): ?>
      <?php echo input_hidden_tag('politician_id', $politician_id); ?>
    <?php endif; ?>		
    
    <?php
    $tendina_admin=array(''  => '--- seleziona istituzione ---',
                                                  sfConfig::get('app_institution_id_PR') => 'Presidenza della Repubblica', 													  
                                                  sfConfig::get('app_institution_id_GI') => 'Governo nazionale',
					          sfConfig::get('app_institution_id_CE') => 'Commissione europea',
                                                  sfConfig::get('app_institution_id_PE') => 'Parlamento europeo',
                                                  sfConfig::get('app_institution_id_SR') => 'Senato della Repubblica',
				                  sfConfig::get('app_institution_id_CD') => 'Camera dei Deputati',
                                                  sfConfig::get('app_institution_id_GR') => 'Giunta regionale',
                                                  sfConfig::get('app_institution_id_CR') => 'Consiglio regionale',
                                                  sfConfig::get('app_institution_id_GP') => 'Giunta provinciale',
                                                  sfConfig::get('app_institution_id_CP') => 'Consiglio provinciale',
                                                  sfConfig::get('app_institution_id_AS') => 'Assemblea dei Sindaci - Provincia',
                                                  sfConfig::get('app_institution_id_GC') => 'Giunta comunale',
                                                  sfConfig::get('app_institution_id_CC') => 'Consiglio comunale'
                                                );
    $tendina_all=array(''  => '--- seleziona istituzione ---',
                                                              sfConfig::get('app_institution_id_GR') => 'Giunta regionale',
                                                              sfConfig::get('app_institution_id_CR') => 'Consiglio regionale',
                                                              sfConfig::get('app_institution_id_GP') => 'Giunta provinciale',
                                                              sfConfig::get('app_institution_id_CP') => 'Consiglio provinciale',
                                                              sfConfig::get('app_institution_id_AS') => 'Assemblea dei Sindaci - Provincia',
                                                              sfConfig::get('app_institution_id_GC') => 'Giunta comunale',
                                                              sfConfig::get('app_institution_id_CC') => 'Consiglio comunale'
                                                              );      
    if ($sf_user->hasCredential('administrator'))
       $tendina=$tendina_admin;
    else
       $tendina=$tendina_all;
                                                                                                 
    
    ?>
	
    <table cellspacing="0" cellpadding="0" border="0">
      <tbody>
      <tr>
        <td class="label">istituzione: </td>
        <td><?php echo select_tag('institution_id', options_for_select($tendina, $institution_charge->getInstitutionId() ),
                                   array('onchange' => 'location_select(this[this.selectedIndex].value, '. ($institution_charge->getContentId() ? $institution_charge->getContentId() : 0).')')
            ) ?>
        </td>
      </tr>
      </tbody>		
    </table>

    <!-- gestione location -->
    <div id="reg" style="display:<?php echo ($loc_type==sfConfig::get('app_location_type_id_region') ? 'block' : 'none') ?>">
      <table cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
          <td class="label">regione: </td>
          <td><?php $c = new Criteria();
                    $c->addAscendingOrderByColumn(OpLocationPeer::NAME);
                    $c->Add(OpLocationPeer::LOCATION_TYPE_ID, sfConfig::get('app_location_type_id_region'), Criteria::EQUAL) ?>
               <?php echo select_tag('region_id', objects_for_select(
                                                    OpLocationPeer::doSelect($c),
                                                    'getId',
                                                    'getName',
                                                    $institution_charge->getLocationId(),
                                                    array('include_custom'=>'--- seleziona ---') ),
                                     array('onchange' => 'charge_select(this[this.selectedIndex].value, $F(\'institution_id\'),'.($institution_charge->getContentId() ? $institution_charge->getContentId() : 0).')')
               ) ?>
          </td>
        </tr>
      </tbody>  
      </table>			
    </div>

    <div id="prov" style="display:<?php echo ($loc_type==sfConfig::get('app_location_type_id_provincial') ? 'block' : 'none') ?>" >
      <table cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
          <td class="label">provincia: </td>
          <td><?php $c = new Criteria();
                    $c->addAscendingOrderByColumn(OpLocationPeer::NAME);
                    $c->Add(OpLocationPeer::LOCATION_TYPE_ID, sfConfig::get('app_location_type_id_provincial'), Criteria::EQUAL) ?>
              <?php echo select_tag('provincial_id', objects_for_select(
  												       OpLocationPeer::doSelect($c),
                                                       'getId',
                                                       'getName',
                                                       $institution_charge->getLocationId(),
                                                       array('include_custom'=>'--- seleziona ---') ),
                                    array('onchange' => 'charge_select(this[this.selectedIndex].value, $F(\'institution_id\'),'. ($institution_charge->getContentId() ? $institution_charge->getContentId() : 0).')')
              ) ?>
          </td>
        </tr>
      </tbody>  
      </table>		
    </div>

    <div id="mun" style="display:<?php echo ($loc_type==sfConfig::get('app_location_type_id_municipal') ? 'block' : 'none') ?>"> 
      <table cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr>
          <td class="label">comune: </td>
          <td>
            <?php echo input_auto_complete_tag('location', 
                                                ($institution_charge->getLocationId() ? $institution_charge->getOpLocation()->getName() : __('Inserisci il nome del comune')), 
                                                '@location_autocomplete', 
                                                array('autocomplete' => 'off', 'size'=>'50', 'onfocus'=>'reset_location_field()'), 
                                                array('use_style' => true, 
                                                      'min_chars' => sfConfig::get('app_autocomplete_min_chars'), 
                                                      'after_update_element' => 'function (inputField, selectedItem) { $(\'loc_id\').value = selectedItem.id; charge_select($(\'loc_id\').value, $F(\'institution_id\'),'.($institution_charge->getContentId() ? $institution_charge->getContentId() : 0).'); }')) ?>
	  	      <?php echo input_hidden_tag('loc_id', $institution_charge->getLocationId()) ?>
          </td>
        </tr>
      </tbody>  
      </table>		
    </div>
    <!-- fine gestione location -->

    <!-- gestione cariche -->
    <div id="charge_div">
      <?php if($institution_charge->getChargeTypeId()): ?>
        <table cellspacing="0" cellpadding="0" border="0">
          <tbody>
          <tr>
            <td class="label">carica: </td>
            <td><?php echo select_tag('charge_type_id', objects_for_select(
                                                          $charge_list,
	                                                      'getId',
                                                          'getName',
                                                          $institution_charge->getChargeTypeId() ),
                                      array('onchange' => 'otherInfo($F(\'institution_id\'), this[this.selectedIndex].value,'.$institution_charge->getLocationId().','.$institution_charge->GetContentId().')')
                ) ?>
            </td>
          </tr>
        </tbody>  
        </table>
      <?php endif; ?>
    </div>
    <!-- fine gestione cariche -->

    <div id="general_info" style="display:<?php echo (($institution_charge->getContentId()!=0 || $from_error) ? 'block' : 'none' )?>">
      <!-- descrizione -->      
	  <div id="charge_description" style="display:<?php echo (($institution_charge->getContentId()!=0 || $from_error) ? 'block' : 'none' )?>">
        <table cellspacing="0" cellpadding="0" border="0">
          <tbody>
          <tr>
            <td class="label">descrizione delle deleghe: </td>
            <td>Per esempio se hai scelto Assessore specifica l'assessorato<em> (p.e. Lavori pubblici)</em> senza ripetere la carica. </br><?php echo object_textarea_tag($institution_charge, 'getDescription', 
		    				                     array ('control_name' => 'institution_charge[description]')) ?>
            </td>
          </tr>
        </tbody>  
        </table>		  
      </div>
      <!-- fine descrizione -->  

      <!-- gestione gruppi -->
      <div id="group_div">
      	<?php include_component('polInstitutionCharges', 'groups', array('location_id' => $institution_charge->getLocationId(), 'institution_id'=> $institution_charge->getInstitutionId(), 'institution_charge_id'=> $institution_charge->getContentId())) ?>
	  </div>
      <!-- fine gestione gruppi -->

      <!-- gestione partiti -->
      <div id="party_div">
      	<?php include_component('polInstitutionCharges', 'parties', array('location_id' => $institution_charge->getLocationId(), 'institution_charge_id'=> $institution_charge->getContentId())) ?>
	  </div>
      <!-- fine gestione partiti -->

      <!-- gestione data inizio -->
      <div id="charge_date">
	    <table cellspacing="0" cellpadding="0" border="0">
	      <tbody>
          <tr>
            <td class="<?php echo (form_has_error('date_start[year]') ? 'labelerror' : 'label')?>">data inizio:</td>
            <td class="<?php echo (form_has_error('date_start[year]') ? 'labelerror' : '')?>">
            	<?php if(form_has_error('date_start[year]')): ?>
				        <?php echo form_error('date_start[year]') ?>
				      <?php endif; ?>
				      <?php echo select_year_tag('date_start[year]', $institution_charge->getDateStart()=='' ? '' : $institution_charge->getDateStart('%Y'), 
                                           array('include_custom' => '--- anno ---',
										                             'id' => 'date_start_year',
                                                 'year_start' => $this_year,
                                                 'year_end' => '1945')
                ) ?>
			
			    <?php $selected_start_month = $institution_charge->getDateStart()=='' || $institution_charge->getDateStart('%m')=='01' ? '' : $institution_charge->getDateStart('%m')  ?>
                <?php echo select_month_tag('date_start[month]', $selected_start_month,
			                                array('include_custom'=>'--- mese ---', 'id'=>'date_start_month')
                ) ?>
	           
			   <?php $selected_start_day = $institution_charge->getDateStart()=='' || $institution_charge->getDateStart('%d')=='01' ? '' : $institution_charge->getDateStart('%d')  ?> 		
               <?php echo select_day_tag('date_start[day]', $selected_start_day, 
                                         array('include_custom'=>'--- giorno ---', 'id'=>'date_start_day')
               ) ?>&nbsp;(<strong><?php echo __('solo anno obbligatorio') ?></strong>)
            </td>
          </tr>
          
	      <tr>
            <td class="label">data fine:</td>
            <td><?php echo select_year_tag('date_end[year]', 
                                           $institution_charge->getDateEnd()==''?'': $institution_charge->getDateEnd('%Y'),
                                           array('include_custom'=>'--- anno ---',
                                                 'id'=>'date_end_year',
                                                 'year_start' => $this_year,
                                                 'year_end' => '1945')
                ) ?>
			    
			    <?php $selected_end_month = ($institution_charge->getDateEnd()=='' ||
			                                 $institution_charge->getDateEnd('%m')=='01' &&
			                                 $institution_charge->getDateEnd('%d')=='01' ) ? '' : $institution_charge->getDateEnd('%m')  ?>
                <?php echo select_month_tag('date_end[month]', $selected_end_month,
                                            array('include_custom'=>'--- mese ---', 'id'=>'date_end_month')
                ) ?>
			
			   <?php $selected_end_day = ($institution_charge->getDateEnd()=='' || 
			                              $institution_charge->getDateEnd('%d')=='01' &&
			                              $institution_charge->getDateEnd('%m')=='01' ) ? '' : $institution_charge->getDateEnd('%d')  ?>
               <?php echo select_day_tag('date_end[day]', $selected_end_day,
                                         array('include_custom'=>'--- giorno ---', 'id'=>'date_end_day')
               ) ?>&nbsp;<strong>(<?php echo __('se non specificato, si considera in corso') ?>)</strong>
            </td>
          </tr>	
          </tbody>		
        </table>
      </div>		
      <!-- fine gestione data fine -->	
    	
      <table>
        <tbody>
          <tr>
            <td class="label"></td>
            <td>
              <?php echo submit_tag('pubblica', array('class'=>'cerca') ); ?>
              <?php if ($institution_charge->getContentId() != 0): ?>
	              &nbsp;<?php echo link_to('annulla', 'politician/page?content_id='.$institution_charge->getPoliticianId());	?>
              <?php else: ?>
                &nbsp;<?php echo link_to('annulla', 'politician/page?content_id='.$politician_id); ?>
              <?php endif; ?>
            </td>
          </tr>
        </tbody>
      </table>
          
    </div>
  </form>
  </div>  
</div>

<?php echo javascript_tag("function otherInfo(institution_id, charge_type_id, location_id, institution_charge_id)
{
  switch(institution_id)
  {
  	case '".sfConfig::get('app_institution_id_CE')."':
	  Element.hide('group_div');
	  if(charge_type_id=='".sfConfig::get('app_charge_type_id_vicepresidente')."' || charge_type_id=='".sfConfig::get('app_charge_type_id_commissario')."')
	  {
	    Element.show('charge_description');	
	  }
	  else
	  {
	  	Element.hide('charge_description');
	  }
	  break;
	case '".sfConfig::get('app_institution_id_PE')."':
	  Element.show('group_div');
	  if(charge_type_id=='".sfConfig::get('app_charge_type_id_pres_comm')."')
	  {
	    Element.show('charge_description');	
	  }
	  else
	  {
	  	Element.hide('charge_description');
	  }
	  break;
	case '".sfConfig::get('app_institution_id_GI')."':
	  Element.hide('group_div');
	  if(charge_type_id=='".sfConfig::get('app_charge_type_id_pres_consiglio')."')
	  {
	    Element.hide('charge_description');	
	  }
	  else
	  {
	  	Element.show('charge_description');
	  }
	  break;
	case '".sfConfig::get('app_institution_id_PR')."':
	  Element.hide('charge_description');
	  Element.hide('group_div');
	  Element.hide('party_div');  
	  break;
	case '".sfConfig::get('app_institution_id_CD')."':
	case '".sfConfig::get('app_institution_id_SR')."':
	  Element.show('group_div');
	  if(charge_type_id=='".sfConfig::get('app_charge_type_id_pres_comm')."')
	  {
	    Element.show('charge_description');	
	  }
	  else
	  {
	  	Element.hide('charge_description');
	  }
	  if(charge_type_id=='".sfConfig::get('app_charge_type_id_senatore_vita')."')
	  {
	  	Element.hide('party_div');
	  }
	  else
	  {
	  	Element.show('party_div');
	  }
	  break;
    case '".sfConfig::get('app_institution_id_GR')."':
	  if(charge_type_id=='".sfConfig::get('app_charge_type_id_presidente')."' || charge_type_id=='".sfConfig::get('app_charge_type_id_sindaco')."' )
	  {
	    Element.hide('charge_description');	
		Element.show('party_div');
		Element.hide('group_div'); 
	  }
	  else
	  {
	  	Element.show('charge_description');
	  }	
	  break;
	case '".sfConfig::get('app_institution_id_GP')."':
	case '".sfConfig::get('app_institution_id_GC')."':
        case '".sfConfig::get('app_institution_id_AS')."':
      if(charge_type_id=='".sfConfig::get('app_charge_type_id_presidente')."' || charge_type_id=='".sfConfig::get('app_charge_type_id_sindaco')."' )
	  {
	    Element.hide('charge_description');	
	  }
	  else
	  {
	  	Element.show('charge_description');
	  }
	  Element.hide('group_div'); 
	  Element.show('party_div');	
	  break;
	case '".sfConfig::get('app_institution_id_CR')."':
	  Element.hide('charge_description');
	  Element.show('group_div');
	  break;
	case '".sfConfig::get('app_institution_id_CP')."':
	case '".sfConfig::get('app_institution_id_CC')."':
	  Element.hide('charge_description');
	  Element.show('group_div'); 
	  break; 	  	
  }
    
  new Effect.BlindDown('general_info', {duration:0.4});
  if(location_id != '')
  {
    new Ajax.Updater('group_div', '/polInstitutionCharges/groups?location_id='+location_id+'&institution_id='+institution_id+'&institution_charge_id='+institution_charge_id, {asynchronous:true, evalScripts:false});
	new Ajax.Updater('party_div', '/polInstitutionCharges/parties?location_id='+location_id+'&institution_charge_id='+institution_charge_id, {asynchronous:true, evalScripts:false}); 
  }
  return false;
 
}") 
?> 

<script language="JavaScript">
	
function charge_select(location_id, institution_id, institution_charge_id)
{
  Element.hide('charge_div');
  Element.hide('general_info');
  
  if(location_id != '')
  {	
    new Ajax.Updater('charge_div', '/polInstitutionCharges/charges?location_id='+location_id+'&institution_id='+institution_id+'&institution_charge_id='+institution_charge_id, {asynchronous:true, evalScripts:false, onComplete:function(request, json){new Effect.BlindDown('charge_div', {duration:0.3});}});
  }	
  return false;
} 
</script>

<?php echo javascript_tag("function reset_location_field()
{
  if ($('location').value == '".__('Inserisci il nome del comune')."')
  {
    $('location').value='';	
  }

  return false;
}") 
?>

<?php echo javascript_tag("function location_select(institution_id, institution_charge_id)
{
  Element.hide('charge_div');
  Element.hide('general_info');
 
  switch(institution_id)
  {
    case '".sfConfig::get('app_institution_id_CE')."':
    case '".sfConfig::get('app_institution_id_PE')."':
      if (Element.visible('reg'))
      {
        Element.hide('reg');
      }
      if (Element.visible('prov'))
      {
        Element.hide('prov');
      }
      if (Element.visible('mun'))
      {
        Element.hide('mun');
      }
      
      /*$('location_id').value = '".sfConfig::get('app_location_id_europe')."';*/
      charge_select('".sfConfig::get('app_location_id_europe')."', institution_id, institution_charge_id);
      break;
    case '".sfConfig::get('app_institution_id_GI')."':
    case '".sfConfig::get('app_institution_id_CD')."':
    case '".sfConfig::get('app_institution_id_SR')."':
    case '".sfConfig::get('app_institution_id_PR')."':	
      if (Element.visible('reg'))
      {
        Element.hide('reg');
      }
      if (Element.visible('prov'))
      {
        Element.hide('prov');
      }
      if (Element.visible('mun'))
      {
        Element.hide('mun');
      }
	  if (Element.visible('general_info'))
      {
        Element.hide('general_info');
      }
      /*$('location_id').value = '".sfConfig::get('app_location_id_italy')."';*/
      charge_select('".sfConfig::get('app_location_id_italy')."', institution_id, institution_charge_id);
      break;
    case '".sfConfig::get('app_institution_id_GR')."':
    case '".sfConfig::get('app_institution_id_CR')."':
      if (Element.visible('prov'))
      {
        Element.hide('prov');
      }
      if (Element.visible('mun'))
      {
        Element.hide('mun');
      }
      ".visual_effect('BlindDown', 'reg', array('duration' => 0.4 ))."
      break;
    case '".sfConfig::get('app_institution_id_GP')."':
    case '".sfConfig::get('app_institution_id_CP')."':
    case '".sfConfig::get('app_institution_id_AS')."':
      if (Element.visible('reg'))
      {
        Element.hide('reg');
      }
      if (Element.visible('mun'))
      {
        Element.hide('mun');
      }
      ".visual_effect('BlindDown', 'prov', array('duration' => 0.4 ))."
      break;
    case '".sfConfig::get('app_institution_id_GC')."':
    case '".sfConfig::get('app_institution_id_CC')."':
      if (Element.visible('reg'))
      {
        Element.hide('reg');
      }
      if (Element.visible('prov'))
      {
        Element.hide('prov');
      }
      ".visual_effect('BlindDown', 'mun', array('duration' => 0.4 ))."
      break;
    default:
      Element.hide('reg');
      Element.hide('prov');
      Element.hide('mun');
		
  }
  return false;

}") ?>
