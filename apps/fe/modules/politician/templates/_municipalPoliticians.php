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
      <h2>Giunta Comunale</h2>
    </div>
  <?php if ($elementi_giunta_comunale || $sindaco): ?>
    <table>
	  <tbody>		
        <?php if ($sindaco): ?>
		<tr class="dark">
          <td><?php echo link_to("<em class=\"surname\">".$sindaco->getOpPolitician()->GetLastName()."</em>&nbsp;".ucwords(strtolower($sindaco->getOpPolitician()->GetFirstName())),
					//'politician/page?content_id='.$sindaco->GetPoliticianId()
					'@politico_new?content_id='.$sindaco->GetPoliticianId().'&slug='. $sindaco->getOpPolitician()->getSlug()
					);?></td>
          <td>
            <strong>Sindaco</strong>
            <?php if ($sf_user->hasCredential('administrator')): ?>
              <br/>
              <span style="margin-bottom:1em; font-size: 11px; color: gray">
                <?php include_component('user', 'authorshipMetadata', array('item' => $sindaco)) ?>    
              </span>  
            <?php endif ?>            				    			         	
          </td>
          <td class="last">
            <?php if($sindaco->getPartyId()!='1'): ?>
              <?php echo $sindaco->getOpParty()->getName(); ?>
            <?php else: ?>
              <?php echo $sindaco->getOpGroup()->getName(); ?> 
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
		<?php foreach ($elementi_giunta_comunale as $elemento_giunta_comunale): ?>
          <tr class="<?php echo $tr_class; ?>">
            <td><?php echo link_to("<em class=\"surname\">".$elemento_giunta_comunale->getOpPolitician()->GetLastName()."</em>&nbsp;".ucwords(strtolower($elemento_giunta_comunale->getOpPolitician()->GetFirstName())),
					'@politico_new?content_id='.$elemento_giunta_comunale->GetPoliticianId().'&slug='. $elemento_giunta_comunale->getOpPolitician()->getSlug()
					//'politician/page?content_id='.$elemento_giunta_comunale->GetPoliticianId()
					);?></td>
            <td>
              <?php echo $elemento_giunta_comunale->getOpChargeType()->GetName()?>
              <?php if ($elemento_giunta_comunale->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore')): ?>
                &nbsp;<?php echo $elemento_giunta_comunale->getDescription()?>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('administrator')): ?>
                <br/>
                <span style="margin-bottom:1em; font-size: 11px; color: gray">
                  <?php include_component('user', 'authorshipMetadata', array('item' => $elemento_giunta_comunale)) ?>    
                </span>  
              <?php endif ?>
            </td>					
            <td class="last"><?php echo $elemento_giunta_comunale->getOpParty()->GetName()?></td>
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
      <h2>Consiglio comunale</h2>
    </div>
    <?php if ($elementi_consiglio_comunale || $presidente_consiglio_comunale): ?>
    <table>
      <tbody>		
        <?php if ($presidente_consiglio_comunale): ?>
		<tr class="dark">
          <td><?php echo link_to("<em class=\"surname\">".$presidente_consiglio_comunale->getOpPolitician()->GetLastName()."</em>&nbsp;".ucwords(strtolower($presidente_consiglio_comunale->getOpPolitician()->GetFirstName())),
				'@politico_new?content_id='.$presidente_consiglio_comunale->GetPoliticianId().'&slug='. $presidente_consiglio_comunale->getOpPolitician()->getSlug()
				//'politician/page?content_id='.$presidente_consiglio_comunale->GetPoliticianId()
				);?></td>
          <td>
            <strong>Presidente del Consiglio Comunale</strong>
            <?php if ($sf_user->hasCredential('administrator')): ?>
              <br/>
              <span style="margin-bottom:1em; font-size: 11px; color: gray">
                <?php include_component('user', 'authorshipMetadata', array('item' => $presidente_consiglio_comunale)) ?>    
              </span>  
            <?php endif ?>
          </td>
          <td class="last">
            <?php if($presidente_consiglio_comunale->getPartyId()!='1'): ?>
              <?php echo $presidente_consiglio_comunale->getOpParty()->getName(); ?>
            <?php else: ?>
              <?php echo $presidente_consiglio_comunale->getOpGroup()->getName(); ?> 
            <?php endif; ?>						    			         	
          </td>
        </tr>
        <?php endif; ?>
		
	    <tr class="label">
          <td>Cognome e nome</td>
          <td colspan="2" class="last">Gruppo/Lista</td>
        </tr>
        
		<?php $tr_class = 'dark' ?>		
        <?php foreach ($elementi_consiglio_comunale as $elemento_consiglio_comunale): ?>
          <tr>
            <td>
            <?php echo link_to("<em class=\"surname\">".$elemento_consiglio_comunale->getOpPolitician()->GetLastName()."</em>&nbsp;".ucwords(strtolower($elemento_consiglio_comunale->getOpPolitician()->GetFirstName())),
					//'politician/page?content_id='.$elemento_consiglio_comunale->GetPoliticianId()
					'@politico_new?content_id='.$elemento_consiglio_comunale->GetPoliticianId().'&slug='. $elemento_consiglio_comunale->getOpPolitician()->getSlug()
					);?>
            </td>
            <td colspan="2" class="last">
              <?php if($elemento_consiglio_comunale->getGroupId() != 1): ?>
                <?php echo $elemento_consiglio_comunale->getOpGroup()->GetName(); ?>
              <?php else: ?>
                <?php echo $elemento_consiglio_comunale->getOpParty()->GetName(); ?>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('administrator')): ?>
                <br/>
                <span style="margin-bottom:1em; font-size: 11px; color: gray">
                  <?php include_component('user', 'authorshipMetadata', array('item' => $elemento_consiglio_comunale)) ?>    
                </span>  
              <?php endif ?>
            </td>					
          </tr>	
        <?php endforeach; ?>
      </tbody>
	</table>
     <?php endif; ?>	
  </div>
