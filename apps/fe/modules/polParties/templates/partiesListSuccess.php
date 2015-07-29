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
<?php use_helper('Object'); ?>

<!-- intestazione -->
<h3>
  <?php echo $msg ?>
</h3>

<!-- filtri -->
<?php echo form_tag('polParties/partiesList') ?>

  <!-- filtro su tipologia partiti -->
  <div style="padding: 10px; margin: 1px; background-color: #CCCCFF;" >
    <?php echo radiobutton_tag('party_type[]', '0', $party_type=='0'?true:false) ?> <label for="party_type_0">liste elettorali</label>
    <?php echo radiobutton_tag('party_type[]', '1', $party_type=='1'?true:false) ?> <label for="party_type_1">partiti politici</label>
  </div>

  <!-- filtro su tipologia localita' -->
  <?php if ($party_type=='0'): ?>
    <div style="padding: 10px; margin: 1px; background-color: #FFCCCC;" >
      <?php echo radiobutton_tag('loc_type[]', 'Tutte', $loc_type=='Tutte'?true:false) ?> <label for="loc_type_Tutte">Tutte</label>
      <?php foreach ($loc_types as $lt): ?>
        <?php $ltn = $lt->getName() ?>
        <?php if ($ltn != 'NON SPECIFICATO'): ?>
          <?php echo radiobutton_tag('loc_type[]', $ltn, $loc_type==$ltn?true:false) ?> <label for="loc_type_<?php echo $ltn?>"><?php echo $ltn?></label>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <!-- filtro per regioni -->
  <?php if ($party_type=='0' && $loc_type=='Regione'): ?>
    <div style="padding: 10px; margin: 1px; background-color: #CCFFCC;">
      Regione: <?php echo select_tag('regione', options_for_select($reg_locations, isset($region_id)?$region_id:0)); ?>
    </div>
  <?php endif; ?>

  <!-- filtro per provincie -->
  <?php if ($party_type=='0' && $loc_type=='Provincia'): ?>
    <div style="padding: 10px; margin: 1px; background-color: #CCFFCC;">
      Provincia: <?php echo select_tag('provincia', options_for_select($prov_locations, isset($prov_id)?$prov_id:0)); ?>
    </div>
  <?php endif; ?>

  <!-- pulsante di submit comune -->
  <div style="padding: 10px; margin: 1px; background-color: #CCCCCC; text-align: center;">
    <?php echo submit_tag('Filtra') ?>
  </div>

</form>

<!-- elenco dei partiti -->
<div>
  <div style="float: right">
    Sono stati trovati <?php echo count($parties)?> partiti.
  </div>
  <div style="clear: both; heigth: 10px;"></div>
  <table style="width: 100%" border="0" cellspacing="1" cellpadding="2">
    <tr>
      <th></th>
      <th>Nome</th>
    </tr>
    <?php $cnt = 1; ?>
    <?php foreach ($parties as $party): ?>
      <tr>
        <td><?php echo $cnt++; ?></td> 
        <td>
          <?php echo link_to($party->getName(), "polParties/partyPoliticiansList?party_id=" . $party->getId() . $filterParameters) ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>	


