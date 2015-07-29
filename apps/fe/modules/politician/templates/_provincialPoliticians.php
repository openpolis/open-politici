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
  <div class="genericblock">
    <div class="header">
      <h2>Giunta Provinciale</h2>
    </div>
   <?php if ($elementi_giunta_provinciale || $presidente_giunta_provinciale): ?> 
    <table>
	  <tbody>		
        <?php if ($presidente_giunta_provinciale): ?>
		<tr class="dark">
          <td><?php echo link_to("<em class=\"surname\">".$presidente_giunta_provinciale->getOpPolitician()->GetLastName()."</em>&nbsp;".ucwords(strtolower($presidente_giunta_provinciale->getOpPolitician()->GetFirstName())),
					//'politician/page?content_id='.$presidente_giunta_provinciale->GetPoliticianId()
					'@politico_new?content_id='.$presidente_giunta_provinciale->GetPoliticianId().'&slug='. $presidente_giunta_provinciale->getOpPolitician()->getSlug()
					);?></td>
          <td>
            <strong>Presidente della Provincia</strong>
            <?php if ($sf_user->hasCredential('administrator')): ?>
              <br/>
              <span style="margin-bottom:1em; font-size: 11px; color: gray">
                <?php include_component('user', 'authorshipMetadata', array('item' => $presidente_giunta_provinciale)) ?>    
              </span>  
            <?php endif ?>
            
          </td>
          <td class="last">
            <?php if($presidente_giunta_provinciale->getPartyId()!='1'): ?>
              <?php echo $presidente_giunta_provinciale->getOpParty()->getName(); ?>
            <?php else: ?>
              <?php echo $presidente_giunta_provinciale->getOpGroup()->getName(); ?> 
            <?php endif; ?>						    			         	
          </td>
        </tr>
        <?php endif; ?>

        <tr class="label">
          <td>Cognome e nome</td>
          <td>Carica</td>
          <td class="last">Partito/Lista</td>
        </tr>
        <?php $tr_class = 'dark' ?>
		<?php foreach ($elementi_giunta_provinciale as $elemento_giunta_provinciale): ?>
          <tr class="<?php echo $tr_class; ?>">
            <td><?php echo link_to("<em class=\"surname\">".$elemento_giunta_provinciale->getOpPolitician()->GetLastName()."</em>&nbsp;".ucwords(strtolower($elemento_giunta_provinciale->getOpPolitician()->GetFirstName())),
							//'politician/page?content_id='.$elemento_giunta_provinciale->GetPoliticianId()
							'@politico_new?content_id='.$elemento_giunta_provinciale->GetPoliticianId().'&slug='. $elemento_giunta_provinciale->getOpPolitician()->getSlug()
							);?></td>
            <td>
              <?php echo $elemento_giunta_provinciale->getOpChargeType()->GetName()?>
              <?php if ($elemento_giunta_provinciale->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore')): ?>
                &nbsp;<?php echo $elemento_giunta_provinciale->getDescription()?>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('administrator')): ?>
                <br/>
                <span style="margin-bottom:1em; font-size: 11px; color: gray">
                  <?php include_component('user', 'authorshipMetadata', array('item' => $elemento_giunta_provinciale)) ?>    
                </span>  
              <?php endif ?>
              
            </td>					
            <td class="last"><?php echo $elemento_giunta_provinciale->getOpParty()->GetName()?></td>
          </tr>	
          <?php $tr_class = ($tr_class == 'dark' ? 'light' : 'dark' )  ?>
		<?php endforeach; ?>
	  </tbody>	
    </table>
   <?php endif; ?> 
  </div>

<hr/>
<div class="orisep">&nbsp;</div>

  <div class="genericblock">
    <div class="header">
      <h2>Consiglio provinciale</h2>
    </div>
   <?php if ($elementi_consiglio_provinciale || $presidente_consiglio_provinciale): ?>
    <table>
      <tbody>		
        <?php if ($presidente_consiglio_provinciale): ?>
		<tr class="dark">
          <td><?php echo link_to("<em class=\"surname\">".$presidente_consiglio_provinciale->getOpPolitician()->GetLastName()."</em>&nbsp;".ucwords(strtolower($presidente_consiglio_provinciale->getOpPolitician()->GetFirstName())),
					//'politician/page?content_id='.$presidente_consiglio_provinciale->GetPoliticianId()
					'@politico_new?content_id='.$presidente_consiglio_provinciale->GetPoliticianId().'&slug='. $presidente_consiglio_provinciale->getOpPolitician()->getSlug()
					);?></td>
          <td>
            <strong>Presidente del Consiglio Provinciale</strong>
            <?php if ($sf_user->hasCredential('administrator')): ?>
              <br/>
              <span style="margin-bottom:1em; font-size: 11px; color: gray">
                <?php include_component('user', 'authorshipMetadata', array('item' => $presidente_consiglio_provinciale)) ?>    
              </span>  
            <?php endif ?>
            
          </td>
          <td class="last">
            <?php if($presidente_consiglio_provinciale->getPartyId()!='1'): ?>
              <?php echo $presidente_consiglio_provinciale->getOpParty()->getName(); ?>
            <?php else: ?>
              <?php echo $presidente_consiglio_provinciale->getOpGroup()->getName(); ?> 
            <?php endif; ?>						    			         	
          </td>
        </tr>
        <?php endif; ?>
		
	    <tr class="label">
          <td>Cognome e nome</td>
          <td colspan="2" class="last">Gruppo/Lista</td>
        </tr>
        
		<?php $tr_class = 'dark' ?>		
        <?php foreach ($elementi_consiglio_provinciale as $elemento_consiglio_provinciale): ?>
          <tr>
            <td><?php echo link_to("<em class=\"surname\">".$elemento_consiglio_provinciale->getOpPolitician()->GetLastName()."</em>&nbsp;".ucwords(strtolower($elemento_consiglio_provinciale->getOpPolitician()->GetFirstName())),
						//'politician/page?content_id='.$elemento_consiglio_provinciale->GetPoliticianId()
						'@politico_new?content_id='.$elemento_consiglio_provinciale->GetPoliticianId().'&slug='. $elemento_consiglio_provinciale->getOpPolitician()->getSlug()
						
						);?></td>
            <td colspan="2" class="last">
              <?php if($elemento_consiglio_provinciale->getGroupId() != 1): ?>
                <?php echo $elemento_consiglio_provinciale->getOpGroup()->GetName(); ?>
              <?php else: ?>
                <?php echo $elemento_consiglio_provinciale->getOpParty()->GetName(); ?>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('administrator')): ?>
                <br/>
                <span style="margin-bottom:1em; font-size: 11px; color: gray">
                  <?php include_component('user', 'authorshipMetadata', array('item' => $elemento_consiglio_provinciale)) ?>    
                </span>  
              <?php endif ?>
              
            </td>					
          </tr>	
        <?php endforeach; ?>
      </tbody>
	</table>
      <?php endif; ?>	
  </div>