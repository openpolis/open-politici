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
<?php echo use_helper('Javascript', 'Date', 'Object') ?>

<div id="title">
<h1>Segnalazione di errori/abusi</h1>
</div>
<!-- #################### FINE TITOLO ####################  -->
<hr />

<div class="genericblock">
Stai segnalando un errore/abuso riguardo un contenuto relativo al politico <strong><?php echo ucwords(strtolower($politician->getFirstName())) ?>&nbsp;<span class="surname"><?php echo $politician->getLastName() ?></span></strong>.<br />
Cerca di essere il pi&ugrave; chiaro possibile.<br /> 

<div class="mask">
<?php echo form_tag('politician/report', array('id'=>'report') ) ?>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="label">Segnalo che l'informazione:</td>
      <td>
      <?php
      switch($opContent->getOpClass())
      	{
      		case 'OpResources':
      			include_component('polResources', 'resourceTitle', array('resource_id' => $content_id));
      			break;
		
      		case 'OpInstitutionCharge':
      			include_component('polInstitutionCharges', 'institutionChargeTitle', array('institution_charge_id' => $content_id));
      			include_component('polInstitutionCharges', 'institutionChargeInfo', array('institution_charge_id' => $content_id));
      			break;
			
      		case 'OpPoliticalCharge':
      			include_component('polPoliticalCharges', 'politicalChargeTitle', array('political_charge_id' => $content_id));
      			include_component('polPoliticalCharges', 'politicalChargeInfo', array('political_charge_id' => $content_id));
      			break;
			
      		case 'OpOrganizationCharge':
      			include_component('polOrgCharges', 'organizationChargeTitle', array('organization_charge_id' => $content_id));
      			include_component('polOrgCharges', 'organizationChargeInfo', array('organization_charge_id' => $content_id));
      			break;
      		case 'OpDeclaration':
      			echo $content->getTitle();
      			break;				
      	}	
      ?>
      </td>
    </tr>
    <tr>
      <td class="label">pu&ograve; essere:</td>
      <td>
        <?php echo radiobutton_tag('report_type', '1', ($report_type=='e' ? true : false)) ?><label for="report_type_1">errata</label>
        <?php echo radiobutton_tag('report_type', '2', ($report_type=='o' ? true : false)) ?><label for="report_type_2">offensiva</label>
        <?php echo radiobutton_tag('report_type', '3', ($report_type=='s' ? true : false)) ?><label for="report_type_3">spam</label>
      </td>
    </tr>
    <tr>
      <td class="label">Nota<br /><em>opzionale</em></td>
      <td>
        <?php echo textarea_tag('notes',$notes , 'size=50x5') ?>
        <?php echo input_hidden_tag('content_id', $content_id) ?>
        <?php echo input_hidden_tag('politician_id', $pol_id) ?>
        <?php echo input_hidden_tag('user_id', $user_id) ?>
      </td>
    </tr>

    <tr>
      <td colspan="2">
        <?php echo submit_tag('Segnala', array('class'=>'cerca')); ?>
      </td>
    </tr>
  </table>
</form>
</div>
</div>
<br />