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
<?php echo use_helper('Javascript', 'DateForm', 'Date', 'Object', 'Validation') ?>

<?php echo form_tag('polOrganizationCharges/updateorganizationcharge') ?>
  <?php echo input_hidden_tag('politician_id', $politician_id); ?>
  <?php echo input_hidden_tag('organization_id', $organization_id); ?>			
  <?php echo input_hidden_tag('has_layout', $hasLayout); ?>
  <table cellspacing="0" cellpadding="0" border="0">
    <tbody>
      <tr>
        <td class="label">tag associati:</td>
        <td>
		  <?php foreach($organization->getOpOrganizationHasOpOrganizationTags() as $organization_tag): ?>
            <?php echo $organization_tag->getOpOrganizationTag()->getName()."&nbsp;&nbsp;&nbsp;" ;?>
          <?php endforeach; ?>
		</td>
      </tr>

      <tr>
        <td class="label">inserisci tag:</td>
        
        <td>Per esempio nel caso di azienda RAI inserisci <em>televisone, azienda pubblica, comunicazione</em><br />
        <?php echo include_partial('autocompleter/organizationTagsAutocompleter' , array('org_id'=>$organization->getId(),'script' => 'true')); ?>&nbsp;(usa la virgola come separatore)</td>
      </tr>

      <tr>
        <td class="label">sito web:</td>
        
        <td>Inserisci il sito web dell'organizzazione <em>(p.e. http://www.rai.it)</em><br />
        <?php echo object_input_tag($organization, 'getUrl', array ('id'=>'organization_url', 'name' => 'organization_url', 'related_class'=>'OpOrganization', 'size'=>'50px'), '') ?></td>
      </tr>

      <tr>
        <td class="label">carica:</td>
        <td>
        Inserisci la carica ricoperta nell'organizzazione <em>(p.e. direttore generale)</em><br />
          <div id="charge_div">
            <?php echo object_input_tag($organization_charge, 'getChargeName', array ('related_class'=>'OpOrganizationCharge', 'size'=>'50px')) ?>
          </div>
		</td>
      </tr>

      <tr>
        <td class="label">periodo:<br /><em>non obbligatorio</em></td>
        <td>
          carica attuale:&nbsp;<?php echo radiobutton_tag('current', '1', ($current=='1' ? true : false), array('onclick' => 'toggle2()')) ?>
          &nbsp;&nbsp;&nbsp;carica passata:&nbsp;<?php echo radiobutton_tag('current', '0', ($current=='1' ? false : true), array('onclick' => 'toggle2()')) ?>
        </td>
      </tr>  
		  
	  <tr>	  
		  <td class="<?php echo (form_has_error('date_start') ? 'labelerror' : 'label')?>"></td>
          <td class="<?php echo (form_has_error('date_start') ? 'labelerror' : '')?>">
            <?php if (form_has_error('date_start')): ?>
              <?php echo form_error('date_start') ?><br />
            <?php endif; ?>
		        <div id="date_start" style="float:left; margin-right:20px"> 
              data inizio:
              <?php echo input_hidden_tag('date_start[day]', '01') ?>
			<?php echo input_hidden_tag('date_start[month]', '01') ?>
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