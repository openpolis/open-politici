<?php foreach (array('giunta', 'consiglio') as $organ): ?>
  <div class="genericblock">
    <div class="header">
      <h2><?php echo Text::getIstituzioneLocale($organ, $tipo) ?></h2>
   </div>
   <?php
     $presidente = null;
     $commissario = null;
     $elementi = $rappresentanza[$organ];
     if ($rappresentanza['presidente_'.$organ])
       $presidente = $rappresentanza['presidente_'.$organ][0];
     if ($rappresentanza['commissario'])
       $commissario = $rappresentanza['commissario'][0];
   ?>
   <?php if ($elementi || $presidente || $commissario): ?> 
    <table>
      <tbody>		
        <?php if ($commissario && $organ == 'giunta'): ?>
    	    <tr class="dark">
            <td><?php echo link_to("<em class=\"surname\">".$commissario->getOpPolitician()->getLastName()."</em>&nbsp;"  . 
                                   ucwords(strtolower($commissario->getOpPolitician()->getFirstName())),
                                   //'politician/page?content_id=' . $commissario->getPoliticianId()
									'@politico_new?content_id='.$commissario->GetPoliticianId().'&slug='. $commissario->getOpPolitician()->getSlug()
									);?></td>
            <td colspan="2" class="last">
              <strong>Commissario</strong>                
            </td>
          </tr>          
        <?php elseif ($presidente): ?>
    	    <tr class="dark">
            <td><?php echo link_to("<em class=\"surname\">".$presidente->getOpPolitician()->getLastName()."</em>&nbsp;" . 
                                   ucwords(strtolower($presidente->getOpPolitician()->getFirstName())),
                                  // 'politician/page?content_id=' . $presidente->getPoliticianId()
									'@politico_new?content_id='.$presidente->GetPoliticianId().'&slug='. $presidente->getOpPolitician()->getSlug()
								);?></td>
            <td>
              <strong><?php echo Text::getCaricaPresidente($organ, $tipo) ?></strong>                
            </td>
            <td class="last">
              <?php if($presidente->getPartyId()!='1'): ?>
                <?php echo $presidente->getOpParty()->getName(); ?>
              <?php else: ?>
                <?php echo $presidente->getOpGroup()->getName(); ?> 
              <?php endif; ?>						    			         	
            </td>
          </tr>
        <?php endif; ?>

        <tr class="label">
          <td>Cognome e nome</td>
          <?php if ($commissario): ?>
            <td colspan="2" class="last">Carica</td>
          <?php else: ?>
            <td>Carica</td>
            <td class="last">Partito/Lista</td>
          <?php endif ?>
        </tr>
        
        <?php $tr_class = 'dark' ?>
  	    <?php foreach ($elementi as $elemento): ?>
          <tr class="<?php echo $tr_class; ?>">
            <td><?php echo link_to("<em class=\"surname\">".$elemento->getOpPolitician()->getLastName()."</em>&nbsp;".ucwords(strtolower($elemento->getOpPolitician()->getFirstName())),
					//'politician/page?content_id='.$elemento->getPoliticianId()
					'@politico_new?content_id='.$elemento->GetPoliticianId().'&slug='. $elemento->getOpPolitician()->getSlug()
					);?></td>
            <td>
              <?php echo $elemento->getOpChargeType()->getName()?>
              <?php if ($elemento->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore')): ?>
                &nbsp;<?php echo $elemento->getDescription()?>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('administrator')): ?>
                <br/>
                <span style="margin-bottom:1em; font-size: 11px; color: gray">
                  <?php include_component('user', 'authorshipMetadata', array('item' => $elemento)) ?>    
                </span>  
              <?php endif ?>
              
            </td>					
            <td class="last"><?php echo $elemento->getOpParty()->getName()?></td>
          </tr>	
          <?php $tr_class = ($tr_class == 'dark' ? 'light' : 'dark' )  ?>
  	<?php endforeach; ?>
    </tbody>
  <?php endif; ?>  	
    </table>
  </div>  
  
  <?php if ($organ == 'giunta'): ?>
    <hr/>
    <div class="orisep">&nbsp;</div>
  <?php endif ?>
<?php endforeach ?>
