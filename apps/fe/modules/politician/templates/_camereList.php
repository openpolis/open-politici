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
$cameraType = $sf_params->get('slug');
if ( !$cameraType) 
	$cameraType = ($title=='Camera dei Deputati' ? 'deputati' : 'senatori');
	
if ( $sf_params->get('sort') )
{	/* canonicals links */
    use_helper('HeaderLinks');

	add_link(
		'@istituzione_new?slug='. $sf_params->get('slug') .'&id='. $sf_params->get('id'),
		'canonical');
		
}
?>
<div id="title">
  <em>
     <?php if ($title=='Camera dei Deputati'): ?> 
         fonte: <?php echo link_to($title, 'http://www.camera.it')?>
     <?php else: ?>
         fonte: <?php echo link_to($title, 'http://www.senato.it')?>
     <?php endif; ?></em>
     
  <h1><?php echo $title; ?></h1>
</div>
<hr/>

<div class="genericblock">
<!--
  <div class="sottomenu">
    <?php if ($title=='Camera dei Deputati'): ?> 
        <span class="evident"><?php echo link_to('Le presenze dei parlamentari', '@presenze_camera') ?></span>
        <span class="evident"><?php echo link_to('L\'indice di attivita\' dei parlamentari', '@indice_camera') ?></span>
    <?php else: ?>
        <span class="evident"><?php echo link_to('Le presenze dei parlamentari', '@presenze_senato') ?></span>
        <span class="evident"><?php echo link_to('L\'indice di attivita\' dei parlamentari', '@indice_senato') ?></span>
     <?php endif; ?>
   
    <br /><br />
  </div>
 --> 
  
  <table>
    <tbody>
	  <?php if ($presidente): ?>
	    <tr class="dark">
          <td>
            <?php echo link_to("<em class=\"surname\">".$presidente->getOpPolitician()->getLastName()."</em>&nbsp;".ucwords(strtolower($presidente->getOpPolitician()->getFirstName())), 
				//'politician/page?content_id='.$presidente->GetPoliticianId()
				'@politico_new?content_id='.$presidente->GetPoliticianId().'&slug='.$presidente->getOpPolitician()->getSlug()
				); ?>
          </td>
          <td class="last" colspan="2"><strong>Presidente <?php echo $title; ?> </strong></td>
        </tr>
	  <?php endif; ?>
	  
	  <tr class="label">
        <td>
          <?php if ($sf_user->getAttribute('sort', null, 'fe/forinstitution/sort') == 'last_name'): ?>
            <?php echo (($sf_user->getAttribute('type', 'asc', 'fe/forinstitution/sort') == 'asc') ? image_tag('buttons/order-up.gif') : image_tag('buttons/order-down.gif') ) ?>
		    <?php echo link_to(__('Cognome Nome'), 'politician/forinstitution?id='.$sf_params->get('id').'&slug='.$cameraType.'&sort=last_name&type='.($sf_user->getAttribute('type', 'asc', 'fe/forinstitution/sort') == 'asc' ? 'desc' : 'asc')) ?>
          <?php else: ?>
            <?php echo link_to(__('Cognome Nome'), 'politician/forinstitution?id='.$sf_params->get('id').'&slug='.$cameraType.'&sort=last_name&type=asc') ?>
          <?php endif; ?>
        </td>

        <td>
          <?php if ($sf_user->getAttribute('sort', null, 'fe/forinstitution/sort') == 'acronym'): ?>
            <?php echo (($sf_user->getAttribute('type', 'asc', 'fe/forinstitution/sort') == 'asc') ? image_tag('buttons/order-up.gif') : image_tag('buttons/order-down.gif') ) ?>
		    <?php echo link_to(__('Gruppo'), 'politician/forinstitution?id='.$sf_params->get('id').'&slug='.$cameraType.'&sort=acronym&type='.($sf_user->getAttribute('type', 'asc', 'fe/forinstitution/sort') == 'asc' ? 'desc' : 'asc')) ?>
          <?php else: ?>
            <?php echo link_to(__('Gruppo'), 'politician/forinstitution?id='.$sf_params->get('id').'&slug='.$cameraType.'&sort=acronym&type=asc') ?>
          <?php endif; ?>
        </td>

        <td class="last">	
          <?php if ($sf_user->getAttribute('sort', null, 'fe/forinstitution/sort') == 'name'): ?>
            <?php echo (($sf_user->getAttribute('type', 'asc', 'fe/forinstitution/sort') == 'asc') ? image_tag('buttons/order-up.gif') : image_tag('buttons/order-down.gif') ) ?>
		    <?php echo link_to(__('Circoscrizione'), 'politician/forinstitution?id='.$sf_params->get('id').'&slug='.$cameraType.'&sort=name&type='.($sf_user->getAttribute('type', 'asc', 'fe/forinstitution/sort') == 'asc' ? 'desc' : 'asc')) ?>
          <?php else: ?> 
            <?php echo link_to(__('Circoscrizione'), 'politician/forinstitution?id='.$sf_params->get('id').'&slug='.$cameraType.'&sort=name&type=asc') ?>
          <?php endif; ?>
        </td>
      </tr>	
	 

      <?php $tr_class = 'dark' ?>		
	  <?php foreach ($pager->getResults() as $institution_charge): ?>
        <tr class="<?php echo $tr_class; ?>">
          <td>
            <?php echo link_to("<em class=\"surname\">".$institution_charge->getOpPolitician()->getLastName()."</em>&nbsp;".ucwords(strtolower($institution_charge->getOpPolitician()->getFirstName())), 
					//'politician/page?content_id='.$institution_charge->GetPoliticianId()
					'@politico_new?content_id='.$institution_charge->GetPoliticianId().'&slug='.$institution_charge->getOpPolitician()->getSlug()
					); ?>
          </td>

          <td><?php echo $institution_charge->getOpGroup()->getName() ?></td>

          <td class="last">
            <?php if($institution_charge->getConstituencyId()): ?>
              <?php echo $institution_charge->getOpConstituency()->getName() ?>
            <?php endif; ?>
          </td>
        </tr>
	    <?php $tr_class = ($tr_class == 'dark' ? 'light' : 'dark' )  ?>
	  <?php endforeach; ?>	
    </tbody>
  </table>
  
</div>	

<!--
<div id="pagination">
  <?php //echo include_partial('politician/paginator', array('pager' => $pager)) ?>
</div>
-->