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
      Aggiungi / Modifica altro incarico (aziende, sindacati, associazioni, ecc.) di <?php echo ucwords(strtolower($politician->getFirstName())) ?>&nbsp;<span class="surname"><?php echo $politician->getLastName() ?></span>
    </span>
  </h1>
</div>

<hr />

<?php $org_name=''; ?>

<div class="genericblock">
  <div class="mask">

  <?php if ($sf_params->get('mode') == 'add'): ?>
    
      <?php echo form_remote_tag(array('update' => 'org_charge', 'url' => 'polOrganizationCharges/organization', 'script' => 'true' )) ?>
        <table>
          <tr>
            <td class="label">organizzazione:</td>
            <td>
            <em>Indica il nome dell'azienda, sindacato, associazione ... in cui il politico ha (avuto) un incarico</em><br />
              <?php echo include_partial('autocompleter/organizationAutocompleter', array('organization_name' => $org_name) ) ?>
              <?php echo submit_tag('scegli', array('class' => 'cerca', 'onclick' => 'toggle_div(\'down\')')) ?>
              <?php echo reset_tag('annulla', array('class' => 'annulla', 'onclick' => 'toggle_div(\'up\')')) ?>
              <?php echo input_hidden_tag('current', $current); ?>	
              <?php echo input_hidden_tag('has_layout', $hasLayout); ?>
              <?php echo input_hidden_tag('politician_id', $politician_id); ?>
            </td>
          </tr>
        </table>
      </form>
    
      <div id="org_charge"><?php echo link_to('indietro', 'politician/page?content_id='.$politician_id); ?></div>

  <?php else: ?>

  <?php $org_name=$organization_charge->getOpOrganization()->getName(); ?>	
  <div id="showedit_organizationcharge_<?php echo $organization_charge->getContentId(); ?>">
    <?php echo form_tag('polOrganizationCharges/updateorganizationcharge', array('name'=>'updateorganizationcharge')) ?>
      <?php echo input_hidden_tag('organization_id', $organization_charge->getOrganizationId()); ?>
      <?php echo input_hidden_tag('content_id', $organization_charge->getContentId()); ?>
      <?php echo input_hidden_tag('politician_id', $politician_id); ?>
      <?php echo input_hidden_tag('has_layout', $hasLayout); ?>
	  <?php echo input_hidden_tag('current', $current); ?>
      <table cellspacing="0" cellpadding="0" border="0">
      <tbody>  
		<tr>
          <td class="label">organizzazione:</td>
          <td>
            <?php echo object_input_tag($organization_charge, 'getOrganizationName', array ('related_class'=>'OpOrganizationCharge', 'disabled'=>'disabled')) ?>
          </td>			
        </tr>
        <tr>
          <td class="label">sito web:</td>
          <td>
            <?php if (form_has_error('organization_url')): ?>
                <?php echo form_error('organization_url') ?><br />
            <?php endif; ?>
            <?php echo object_input_tag($organization_charge, 'getOrganizationUrl', array ('related_class'=>'OpOrganizationCharge'), '') ?><br />
          </td>			
        </tr>
        <tr>
          <td class="label">tag associati:</td>
          <td>
            <?php foreach($organization_charge->getOpOrganization()->getOpOrganizationHasOpOrganizationTags() as $organization_tag): ?>
              <?php echo $organization_tag->getOpOrganizationTag()->getName();?>&nbsp;&nbsp;&nbsp;
            <?php endforeach; ?>				
          </td>
        </tr>
        <tr>
          <td class="label">carica:</td>
          <td>
            <div id="charge_div">
              <?php echo object_input_tag($organization_charge, 'getChargeName', array ('related_class'=>'OpOrganizationCharge', 'size'=>'30px')) ?>
            </div>
          </td>
        </tr>
        
        
		<tr>
          <td class="<label">periodo:</td>
          <td>
            carica attuale:&nbsp;<?php echo radiobutton_tag('current', '1', ($current=='1' ? true : false), array('onclick' => 'toggle2()')) ?>
            &nbsp;&nbsp;&nbsp;carica passata:&nbsp;<?php echo radiobutton_tag('current', '0', ($current=='1' ? false : true), array('onclick' => 'toggle2()')) ?>
          </td>
		</tr>  
		  
		  
		  <td class="<?php echo (form_has_error('date_start') ? 'labelerror' : 'label')?>"></td>
          <td class="<?php echo (form_has_error('date_start') ? 'labelerror' : '')?>">
            <?php if (form_has_error('date_start')): ?>
                <?php echo form_error('date_start') ?><br />
            <?php endif; ?>
		 
            <div id="date_start" style="float:left; margin-right:20px"> 
              <?php echo input_hidden_tag('date_start[day]', '01') ?>
			  <?php echo input_hidden_tag('date_start[month]', '01') ?>
			  data inizio:	
              <?php if ($sf_params->get('mode') == 'add'): ?>
                <?php $date_start = array('year' => format_date(time(),'yyyy')); ?>
              <?php else: ?>	 
                <?php $date_start = array('year' => format_date($organization_charge->getDateStart(),'yyyy')); ?>
              <?php endif; ?>
              <?php echo select_date_tag('date_start', $date_start, array('include_custom'=>'------', 'discard_day'=>true, 'discard_month'=>true, 'year_start' => format_date(time(),'yyyy'), 'year_end' => format_date(time(),'yyyy')-40, 'date_seperator'=>'')); ?>
            </div>

            <div id="date_end" style="display:<?php echo ($current=='1' ? 'none' : 'block') ?>">
              data fine:
              <?php echo input_hidden_tag('date_end[day]', '01') ?>
			  <?php echo input_hidden_tag('date_end[month]', '01') ?>
			  <?php if ($sf_params->get('mode') == 'add'): ?>
                <?php $date_end = array('year' => format_date(time(),'yyyy')); ?>
              <?php else: ?>	 
                <?php $date_end = array('year' => format_date($organization_charge->getDateEnd(),'yyyy')); ?>
              <?php endif; ?>
              <?php echo select_date_tag('date_end', $date_end, array('include_custom'=>'------', 'discard_day'=>true, 'discard_month'=>true, 'year_start' => format_date(time(),'yyyy'), 'year_end' => format_date(time(),'yyyy')-40, 'date_seperator'=>'')); ?>
		    </div>
          </td>
        </tr>					 	
	    
		<tr>
	      <td class="label"></td>
		  <td>   
            <?php if ($organization_charge->getContentId() != 0): ?>
              <?php echo submit_tag('pubblica', array('class' => 'cerca') ); ?>
	          &nbsp;<?php echo link_to('indietro', 'politician/page?content_id='.$organization_charge->getPoliticianId());	?>
            <?php else: ?>
              <?php echo submit_tag('pubblica', array('class' => 'cerca') ); ?>
              &nbsp;<?php echo link_to('indietro', 'politician/page?content_id='.$politician_id); ?>
            <?php endif; ?>
          </td>
		</tr>
      </tbody>
	  </table>    		  
    </form>
  </div>
<?php endif; ?>

</div>
</div>


<?php echo javascript_tag("function toggle_div(v)
{
  if (v=='up')
  {
    	".visual_effect('BlindUp', 'org_charge', array('duration' => 0.4 ))."
  }
  else
  {
  		Element.visible('org_charge');
    	".visual_effect('BlindDown', 'org_charge', array('duration' => 0.4 ))."
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