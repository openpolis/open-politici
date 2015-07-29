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
<?php echo use_helper('Javascript', 'Validation') ?>

<div id="title">
  <h1>
    <span class="bacchetta">
      Aggiungi o Modifica un incarico in organizzazioni (aziende, sindacati, associazioni, ecc.)<br/>
      per <?php echo $pol ?>
    </span>
  </h1>
</div>

<hr />

<?php $org_name=''; ?>

<div class="genericblock">
  <div class="mask">

      <?php echo form_tag('polOrgCharges/organizationEdit', array('name'=>'organizationEdit')) ?>

        <?php echo input_hidden_tag('organization_id', 0)?>
        <?php echo input_hidden_tag('politician_id', $pol->getContentId())?>
      
        <table>
          <tr>
            <td class="label">organizzazione:</td>
            <td>
              <em>Indica il nome dell'azienda, sindacato, associazione ... in cui il politico ha (avuto) un incarico</em><br />
              <input id="organization" type="text" size="30" autocomplete="off" value="" name="organization"/>
              <div id="organization_auto_complete" class="auto_complete" style="display: none;"></div>
              <script type="text/javascript" language="javascript">
              //<![CDATA[
              new Ajax.Autocompleter('organization', 'organization_auto_complete', 
                                     '/index_fe_dev.php/autocompleter/organization_autocomplete', 
                                     { minChars:1, tokens:',', 
                                       afterUpdateElement:function(in_el, li_el){updateOrganizationTagsUrl(in_el, li_el)}});
              //]]>
              </script>
            </td>
          </tr>

          <tr>
            <td class="label" align="center">inserisci tag associati:</td>
            <td>Per esempio nel caso di azienda RAI inserisci <em>televisone, azienda pubblica, comunicazione</em><br />
              <?php echo include_partial('autocompleter/organizationTagsAutocompleter', array('org_id'=>0)); ?>
              &nbsp;(usa la virgola come separatore)
            </td>
          </tr>

          <tr>
            <td class="label">sito web:</td>

            <td>Inserisci il sito web dell'organizzazione <em>(p.e. http://www.rai.it)</em><br />
              <?php if (form_has_error('organization_url')): ?>
                  <?php echo form_error('organization_url') ?>
              <?php endif; ?>
              
              <?php echo input_tag( 'organization_url', '', array( 'size'=>'50px' ) ) ?>
            </td>
          </tr>

        <tr>
          <td colspan="2">
            <?php echo submit_tag('scegli', array('class' => 'cerca')) ?>
            &nbsp;
            <?php echo link_to('indietro', 'politician/page?content_id='.$pol->getContentId());	?>
          </td>
        </tr>

      </table>
        
      </form>
    

  </div>
</div>


<script type="text/javascript" language="javascript">
//<![CDATA[
function updateOrganizationTagsUrl(in_el, li_el) {
  var lookupUrl = '<?php echo url_for("polOrgCharges/organizationLookup")?>';
  var url = lookupUrl + '/organization_id/' + li_el.id;
  $('organization_tags').value = '';
  $('organization_url').value = '';
  $('organization_id').value = '';
  new Ajax.Request(url, { method: 'get' });  
  $('organization_tags').focus();
}

//]]>
</script>

  