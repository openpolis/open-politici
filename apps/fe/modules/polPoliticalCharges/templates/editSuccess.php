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
<?php echo use_helper('Javascript', 'Date', 'DateForm', 'Object', 'Validation') ?>

<div id="title">
  <h1>
    <span class="bacchetta">
      Aggiungi / Modifica incarico politico di <?php echo ucwords(strtolower($politician->getFirstName())) ?>&nbsp;<span class="surname"><?php echo $politician->getLastName() ?></span>
    </span>
  </h1>
</div>

<hr />

<div class="genericblock">
  <div class="mask">
    <?php echo form_tag('polPoliticalCharges/edit', array('name'=>'edit') ) ?>
      <?php if ($political_charge->getContentId() != 0): ?>
         <?php echo object_input_hidden_tag($political_charge, 'getContentId'); ?>
      <?php endif; ?>
      <?php if (isset($politician_id)): ?>
        <?php echo input_hidden_tag('politician_id', $politician_id); ?>
      <?php endif; ?>
	
      <table cellspacing="0" cellpadding="0" border="0">
        <tbody>
	        <tr>
            <td class="<?php echo (form_has_error('party_id') ? 'labelerror' : 'label')?>">partito:</td>
            <td>
              <?php if (form_has_error('party_id')): ?>
                <?php echo form_error('party_id') ?><br />
              <?php endif; ?>	
		      <?php include_component('polPoliticalCharges', 'parties', array('political_charge_id'=> $political_charge->getContentId())) ?>
            </td>
          </tr>
       </tbody>
     </table>  

     <table cellspacing="0" cellpadding="0" border="0">
       <tbody>
         <tr>
           <td class="label" valign="top">carica:</td>
           <td>semplice iscritto:&nbsp;<?php echo radiobutton_tag('status', '1', ($charge=='iscritto' ? true : false), array('onclick' => 'toggle1()')) ?>
             &nbsp;&nbsp;&nbsp;ha una carica:&nbsp;</span><?php echo radiobutton_tag('status', '2', ($charge=='iscritto' ? false : true), array('onclick' => 'toggle1()')) ?>
           
          <div id="charge_name" style="display:<?php echo ($charge=='iscritto' ? 'none' : 'block')?>">
            <div style="width:150px; float:left">
              <br />
              <label><b>livello carica:&nbsp;</b></label><br />
              <p class="political_charge">
                <label>carica nazionale:&nbsp;</label><?php echo radiobutton_tag('location_type', '1', ($loc_type=='1' ? true : false), array('onclick' => 'loc1(\'1\')')) ?>
              </p>
              <p class="political_charge">
                <label>carica regionale:&nbsp;</label><?php echo radiobutton_tag('location_type', '2', ($loc_type=='2' ? true : false), array('onclick' => 'loc1(\'2\')')) ?>
              </p>
              <p class="political_charge">
                <label>carica provinciale:&nbsp;</label><?php echo radiobutton_tag('location_type', '3', ($loc_type=='3' ? true : false), array('onclick' => 'loc1(\'3\')')) ?>
              </p>
              <p class="political_charge">
                <label>carica comunale:&nbsp;</label><?php echo radiobutton_tag('location_type', '4', ($loc_type=='4' ? true : false), array('onclick' => 'loc1(\'4\')')) ?>
              </p>		
            </div>

            <div id="reg" style="display:<?php echo ($loc_type=='2' ? 'block' : 'none')?>">
			        <label><b><?php echo __('regione') ?>:</b></label><br />
              <?php include_component('location', 'regions') ?>
            </div>

            <div id="prov" style="display:<?php echo ($loc_type=='3' ? 'block' : 'none')?>">
              <label><b><?php echo __('provincia') ?>:</b></label><br />
			        <?php include_component('location', 'provincials') ?>
            </div>
		  
            <div id="mun" style="display:<?php echo ($loc_type=='4' ? 'block' : 'none')?>">
              <label><b><?php echo __('comune') ?>:</b></label><br />
              <?php echo input_auto_complete_tag('location', ($political_charge->getLocationId() ? $political_charge->getOpLocation()->getName() : __('Inserisci il nome del comune')), '@location_autocomplete', array('autocomplete' => 'off', 'size'=>'40', 'onfocus'=>'reset_location_field()'), array('use_style' => 'true', 'min_chars' => sfConfig::get('app_autocomplete_min_chars'), 'after_update_element' => 'function (inputField, selectedItem) { $(\'loc_id\').value = selectedItem.id; charge_select($(\'loc_id\').value, $F(\'institution_id\'),'.($political_charge->getContentId() ? $political_charge->getContentId() : 0).'); }')) ?>
              <?php echo input_hidden_tag('loc_id', $political_charge->getLocationId()) ?>
            </div>

            <div style="clear:left">
              <label><b>incarico:</b>&nbsp;</label>
              <?php if ($charge=='iscritto'): ?>
                <?php echo input_tag('description', '', array('size'=>'40')); ?>
              <?php else: ?> 
                <?php echo object_input_tag($political_charge, 'getDescription', array('related_class'=>'OpPoliticalCharge', 'size'=>'40')); ?>
              <?php endif; ?>
            </div>
          </div>
        </td>
      </tr>
      </tbody>
      </table>

     <table cellspacing="0" cellpadding="0" border="0">
       <tbody>
       <tr>
        <td class="<?php echo (form_has_error('date_start') ? 'labelerror' : 'label')?>">periodo:<br/><em>non obbligatorio<em></td>
        <td class="<?php echo (form_has_error('date_start') ? 'labelerror' : '')?>">
          carica attuale:&nbsp;<?php echo radiobutton_tag('current', '1', ($current=='1' ? true : false), array('onclick' => 'toggle2()')) ?>
          &nbsp;&nbsp;&nbsp;carica passata:&nbsp;</span><?php echo radiobutton_tag('current', '0', ($current=='1' ? false : true), array('onclick' => 'toggle2()')) ?>
                    
		      <?php if (form_has_error('date_start')): ?>
            <?php echo form_error('date_start') ?><br />
          <?php endif; ?>
		  
		      <div id="date_start" style="float:left; margin-right:20px">
            <span class="label"><?php echo __('anno di inizio') ?>:</span>	
            <?php echo input_hidden_tag('date_start[day]', '01') ?>
			       <?php echo input_hidden_tag('date_start[month]', '01') ?>
			       <?php if ($sf_params->get('mode') == 'add'): ?>
              <?php $date_start = array('year' => format_date(time(),'yyyy')); ?>
            <?php else: ?>	 
              <?php $date_start = array('year' => format_date($political_charge->getDateStart(),'yyyy')); ?>
            <?php endif; ?>
            <?php echo select_date_tag('date_start', $date_start, array('include_custom'=>'--- scegli anno ---', 'discard_day'=>true, 'discard_month'=>true, 'year_start' => format_date(time(),'yyyy'), 'year_end' => format_date(time(),'yyyy')-40, 'date_seperator'=>'')); ?>
          </div>

          <div id="date_end" style="display:<?php echo ($current=='1' ? 'none' : 'block') ?>">
            <span class="label"><?php echo __('anno di fine') ?>:</span>
            <?php echo input_hidden_tag('date_end[day]', '01') ?>
			       <?php echo input_hidden_tag('date_end[month]', '01') ?>
			       <?php if ($sf_params->get('mode') == 'add'): ?>
              <?php $date_end = array('year' => format_date(time(),'yyyy')); ?>
            <?php else: ?>	 
              <?php $date_end = array('year' => format_date($political_charge->getDateEnd(),'yyyy')); ?>
            <?php endif; ?>
            <?php echo select_date_tag('date_end', $date_end, array('include_custom'=>'--- scegli anno ---', 'discard_day'=>true, 'discard_month'=>true, 'year_start' => format_date(time(),'yyyy'), 'year_end' => format_date(time(),'yyyy')-40, 'date_seperator'=>'')); ?>
		  </div>
        </td>
      </tr>			
      </tbody>
      </table>
      
      <table cellspacing="0" cellpadding="0" border="0">
		   <tbody>
      <tr>
      <td class="label"></td>
      <td>
        <?php if ($political_charge->getContentId() != 0): ?>
        <?php echo submit_tag('pubblica', array('class'=>'cerca') ); ?>
	       &nbsp;<?php echo link_to('indietro', 'politician/page?content_id='.$political_charge->getPoliticianId());	?>
        <?php else: ?>
        <?php echo submit_tag('pubblica', array('class'=>'cerca') ); ?>
          &nbsp;<?php echo link_to('indietro', 'politician/page?content_id='.$politician_id); ?>
        <?php endif; ?>
      </td>
      </tr>
      </tbody>
      </table>
    </form>
  </div>
</div>

<?php echo javascript_tag("function toggle1()
{
  if (Element.visible('charge_name'))
  {
    ".visual_effect('BlindUp', 'charge_name', array('duration' => 0.4 ))."
  }
  else
  {
    ".visual_effect('BlindDown', 'charge_name', array('duration' => 0.4 ))."
  }

  return false;
}") ?>

<?php echo javascript_tag("function toggle2()
{
  if (Element.visible('date_end'))
  {
    ".visual_effect('BlindUp', 'date_end', array('duration' => 0.4 ))."
  }
  else
  {
    ".visual_effect('BlindDown', 'date_end', array('duration' => 0.4 ))."
  }

  return false;
}") ?>

<?php echo javascript_tag("function loc1(loc_type)
{
  switch(loc_type)
  {
    case '2':
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
    case '3':
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
    case '4':
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

<?php echo javascript_tag("function reset_location_field()
{
  if ($('location').value == '".__('Inserisci il nome del comune')."')
  {
    $('location').value='';	
  }

  return false;
}") 
?>
