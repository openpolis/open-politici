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
<?php echo use_helper('Javascript') ?>

<div class="genericblock">
  <div class="mask obscured">


  <div><h1>Politici con dichiarazioni associate a temi</h1></div>
  
  <?php if ($assegnati == 1): ?>
    <h2>Elenco completo</h2>
    <div style="float:right">
      <?php echo link_to('non assegnati', '@candidati_vsq?assegnati=0'); ?>
      | 
      <?php echo link_to('ricarica', '@candidati_vsq?assegnati=1'); ?>
    </div>
  <?php else: ?>
    <h2>Elenco dei politici ancora non assegnati a partiti o coalizioni elettorali</h2>
    <div style="float:right">
      <?php echo link_to('ricarica', '@candidati_vsq?assegnati=0'); ?>
      | 
      <?php echo link_to('tutti', '@candidati_vsq?assegnati=1'); ?>
    </div>
  <?php endif; ?>


  <div style="clear:both"></div>
  
  <?php if(count($politicians)): ?>

    <table cellspacing="0" cellpadding="0" border="0">
      <tr>
        <td class="label" style="text-align:center">politico</td>
        <td class="label" style="text-align:center">dichiarazioni associate</td>
        <td class="label" style="text-align:center">partito</td>
        <td class="label" style="text-align:center">logo</td>
      </tr>	

      <!-- loop sui politici -->
      <?php foreach($politicians as $politician): ?>
				<tr>
					<td>
            <?php echo link_to($politician->getFirstName() . 
                               " " . 
                               strtoupper($politician->getLastName()),
                               '@politico_new?slug='.$politician->getSlug().'&content_id=' . $politician->getContentId() ); ?>
					</td>
					<td style="text-align:center"><?php echo $politician->getNbDeclarationsAssociatedToThemes(); ?></td>
					<td style="text-align:center">
            <!-- selettore partito -->
            <div style="display:inline">
              <?php echo include_partial('administrator/partySelector', 
                                         array('selectables' => $selectable_parties,
                                               'politician_id' => $politician->getContentId(),
                                               'default_value' => ($politician->getElectoralCoalition() === null?'':$politician->getElectoralCoalition()->getId()), 
                                               'remote' => true,
                                               'url' => url_for("@assegna_candidato" . 
                                                                 "?politician_id=" . $politician->getContentId() . 
                                                                 "&party_id=x"),
                                               'select_msg' => '= Seleziona un partito =', 
                                               'style' => 'font-size: 10px')); ?>             	
            </div>
            <div style="float:right; margin-top:-20px; margin-right:20px; display: none;" class="indicator" id="indicator_<?php echo $politician->getContentId()?>"></div>
					</td>
					<td style="text-align:center">
            <div id="party_info_<?php echo $politician->getContentId(); ?>">
              <?php echo include_partial('polPoliticalCharges/partyLogo',
                                         array('party' => $politician->getElectoralCoalition() )) ?>
            </div>					
					</td>
				</tr>
			<?php endforeach; ?>

    </table>

  <?php else: ?>
    <div style="">Non ci sono politici con dichiarazioni associate</div>
  <?php endif; ?>

  </div>
</div>