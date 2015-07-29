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
<?php echo use_helper('Javascript', 'Object', 'Validation') ?>
<div id="title">
<h1><span class="bacchetta">Aggiungi o modifica contatto di un politico</span></h1>
</div>
<!-- #################### FINE TITOLO ####################  -->
<hr />
<div class="genericblock">
Stai aggiungendo o modificando un contatto (sito web o e-mail) del politico <strong><?php echo ucwords(strtolower($politician->getFirstName())) ?>&nbsp;<span class="surname"><?php echo $politician->getLastName() ?></span></strong>.<br />

<div class="mask">
<?php echo form_tag('polResources/edit') ?>
<?php echo object_input_hidden_tag($resource, 'getContentId')?>
    <?php echo input_hidden_tag('politician_id', $politician_id); ?>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="<?php echo (form_has_error('resource{resources_type_id}') ? 'labelerror' : 'label')?>">Tipo di contatto:</td>
<td>
<?php if ($sf_request->hasError('resource{resources_type_id}')): ?>
            <div class="form-error-msg">
              &darr;&nbsp;<?php echo $sf_request->getError('resource{resources_type_id}') ?>&nbsp;&darr;
            </div>
          <?php endif; ?>
				
		  <?php if ($sf_user->hasCredential('administrator')): ?>		
		    <?php echo select_tag('resources_type_id', objects_for_select(
  				  OpResourcesTypePeer::doSelect(new Criteria()),
  					  'getId',
  					  'getResourceType',
  					  $resource->getResourcesTypeId(),
					  array('include_custom'=>'-- seleziona --')
				  ), array ('name' => 'resource[resources_type_id]')) ?>
          <?php else: ?>
		    <?php echo select_tag('institution_id', options_for_select(array(
                                                      ''  => '--- seleziona ---',
                                                      sfConfig::get('app_resource_type_unofficial_url') => 'Sito web', 													  
                                                      sfConfig::get('app_resource_type_unofficial_mail') => 'E-mail'
                                                    ), $resource->getResourcesTypeId() ),
                                   array ('name' => 'resource[resources_type_id]')) ?>
		  <?php endif; ?>
</td>
<tr>
        <td class="<?php echo (form_has_error('resource{valore}') ? 'labelerror' : 'label')?>">Sito web o e-mail:</td>
        <td>
          <?php if ($sf_request->hasError('resource{valore}')): ?>
            <div class="form-error-msg">
              &darr;&nbsp;<?php echo $sf_request->getError('resource{valore}') ?>&nbsp;&darr;
            </div>
          <?php endif; ?>
          <?php echo object_input_tag($resource, 'getValore', array (
			          'related_class' => 'OpResources', 'size'=>'50',
			          'control_name' => 'resource[valore]'))?><br />
				<em>(esempi: http://www.sitopolitico.it, nome@mail.it)</em>	
        </td>
</tr>

<tr>
        <td class="label">Se vuoi inserisci una descrizione</td>
        <td>
          <?php echo object_input_tag($resource, 'getDescrizione', array (
			  'related_class' => 'OpResources', 'size'=>'50', 
			  'control_name' => 'resource[descrizione]'))?><br />
	<em>(esempi: blog personale, e-mail ufficiale)</em>		          
        </td>
 </tr>
 
 <tr>
 <td colspan="2">
       <?php if ($resource->getContentId() != 0): ?>
        <?php echo submit_tag('Salva', array('class'=>'cerca'));
			  echo "&nbsp;&nbsp;";
			  echo link_to(__('indietro'), 'politician/page?content_id='.$resource->getPoliticianId()); ?>
      <?php else: ?>
        <?php echo submit_tag('Salva', array('class'=>'cerca'));
			  echo "&nbsp;&nbsp;";
			  echo link_to(__('indietro'), 'politician/page?content_id='.$politician_id); ?>
      <?php endif; ?>
   </td>
   </tr>
   </table>
   </form>   	
   
   </div>
   </div>	 
   <br />		  


