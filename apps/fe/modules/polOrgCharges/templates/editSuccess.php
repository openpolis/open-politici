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
<?php echo use_helper('Javascript', 'DateForm', 'Object', 'Validation', 'Date') ?>

<div id="title">
  <h1>
    <span class="bacchetta">
      Aggiungi o Modifica un incarico in organizzazioni (aziende, sindacati, associazioni, ecc.)<br/>
      per <?php echo $pol ?>
    </span>
  </h1>
</div>

<hr />


<div class="genericblock">
  <div class="mask">

    <table id="organization" cellspacing="0" cellpadding="0" border="0">
      <tbody>  
  	    <tr>
          <td class="label">organizzazione:</td>
          <td>
            <span id="org_name"><?php echo $org->getName() ?></span>
          </td>			
        </tr>

  	    <tr>
          <td class="label">tag associati:</td>
          <td>
            <span id="org_tags"><?php echo $org->getTagsAsString()?$org->getTagsAsString():'Nessun tag' ?></span>
            &nbsp;<?php echo image_tag('edit.png', 
                                 array('id'=>'editTagsControl', 'style'=>'cursor:pointer', 
                                       'alt'=>'edit', 'title'=>'clicca qui mer modificare i tag'))?>

           <!-- script per la gestione dell'edit-in-place dei tag associati -->
           <script type="text/javascript" language="javascript">
           //<![CDATA[
            new Ajax.InPlaceEditor('org_tags', '<?php echo url_for("polOrgCharges/editTags") ?>', {
              callback: function(form, value) { return 'org_id=<?php echo $org->getId()?>&value='+escape(value) },
              cancelText:'Annulla', 
              savingText: 'Salvataggio...',
              clickToEditText:'Clicca qui per modificare i tag',
              externalControl: 'editTagsControl', 
              formClassName: 'inlineform',
              size: 50
            });
           //]]>
           </script>
          </td>			
        </tr>

        <tr>
          <td class="label">sito web:</td>
          <td>
            <?php if (form_has_error('organization_url')): ?>
                <?php echo form_error('organization_url') ?><br />
            <?php endif; ?>

            <span id="org_url"><?php echo $org->getUrl() ?></span>
            &nbsp;<?php echo image_tag('edit.png', 
                                 array('id'=>'editUrlControl', 'style'=>'cursor:pointer',
                                       'alt'=>'edit', 'title'=>'clicca qui mer modificare la url'))?>
                                  
            <!-- script per la gestione dell'edit-in-place della URL -->
            <script type="text/javascript" language="javascript">
            //<![CDATA[
              new Ajax.InPlaceEditor('org_url', '<?php echo url_for("polOrgCharges/editUrl") ?>',{
                callback: function(form, value) { return 'org_id=<?php echo $org->getId()?>&value='+escape(value) },
                cancelText: 'Annulla',
                savingText: 'Salvataggio...',
                clickToEditText: 'Clicca qui per modificare la url',
                externalControl: 'editUrlControl', 
                formClassName: 'inlineform',
                size: 30
              });
            //]]>
            </script>

          </td>			
        </tr>
        
      </tbody>
    </table>

    <br/>

    <?php echo form_tag('polOrgCharges/edit', array('name'=>'edit')) ?>

      <?php echo input_hidden_tag('organization_id', $org->getId()); ?>
      <?php echo input_hidden_tag('politician_id', $pol->getContentId()); ?>
      <?php echo input_hidden_tag('content_id', $content_id); ?>

      <table id="charge" cellspacing="0" cellpadding="0" border="0">
      <tbody>  
  
        <tr>
          <td class="label"><strong>carica</strong>:</td>
          <td width="400">
            <div id="charge_div">
              <?php echo object_input_tag($charge, 'getChargeName', array ('related_class'=>'OpOrganizationCharge', 'size'=>'30px')) ?>
            </div>
          </td>
        </tr>
  
        <tr>
          <td class="<label"><strong>periodo</strong>:</td>
          <td>
            carica <strong>attuale</strong>:&nbsp;<?php echo radiobutton_tag('current', '1', ($current ? true : false)) ?>
            &nbsp;&nbsp;&nbsp;
            carica <strong>passata</strong>:&nbsp;<?php echo radiobutton_tag('current', '0', ($current ? false : true)) ?>
          </td>
        </tr>  


        <tr>
          <td class="<?php echo (form_has_error('date_start') ? 'labelerror' : 'label')?>"></td>
          <td class="<?php echo (form_has_error('date_start') ? 'labelerror' : '')?>">
            <?php if (form_has_error('date_start')): ?>
                <?php echo form_error('date_start') ?><br />
            <?php endif; ?>

            <div id="date_start" style="float:left; margin-right:20px"> 
              <?php echo input_hidden_tag('date_start[day]', '01') ?>
    	        <?php echo input_hidden_tag('date_start[month]', '01') ?>
    	        data inizio:	
              <?php echo select_date_tag('date_start', $date_start_year, 
                                         array('include_custom'=>'------', 'discard_day'=>true, 'discard_month'=>true, 'year_start' => format_date(time(),'yyyy'), 'year_end' => format_date(time(),'yyyy')-40, 'date_seperator'=>'')); ?>
            </div>

            <div id="date_end" style="display:<?php echo ($current ? 'none' : 'block') ?>">
              data fine:
              <?php echo input_hidden_tag('date_end[day]', '01') ?>
          	  <?php echo input_hidden_tag('date_end[month]', '01') ?>
              <?php echo select_date_tag('date_end', $date_end_year, 
                                         array('include_custom'=>'------', 'discard_day'=>true, 'discard_month'=>true, 'year_start' => format_date(time(),'yyyy'), 'year_end' => format_date(time(),'yyyy')-40, 'date_seperator'=>'')); ?>
            </div>
          </td>
        </tr>					 	

        <tr>
          <td colspan="2" align="center">   
            <?php echo submit_tag('pubblica', array('class' => 'cerca') ); ?>
            &nbsp;<?php echo link_to('indietro', 'politician/page?content_id='.$pol->getContentId());	?>
          </td>
        </tr>
      
      </tbody>
    </table>    		  
    </form>

  </div>
</div>


<script type="text/javascript" language="javascript">
//<![CDATA[

  $('current_1').observe('change', respondToChange); 
  $('current_0').observe('change', respondToChange); 

  function respondToChange(event) { 
    var element = Event.element(event);
    if (element.value == 0)
    {
      $('date_end').setStyle({ display: 'block'});
      $('date_end_year').disabled = false;
    }
    if (element.value == 1)
    {
      $('date_end').setStyle({ display: 'none'});
      $('date_end_year').selectedIndex = 0;
      $('date_end_year').disabled = true;
      
    }
  } 

//]]>
</script>



