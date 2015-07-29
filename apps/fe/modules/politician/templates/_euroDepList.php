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

$istitutionSlug = $sf_params->get('slug');
if ( !$istitutionSlug) 
	$istitutionSlug = 'parlamentari-europei';
	
if ( $sf_params->get('sort') )
{	/* canonicals links */
    use_helper('HeaderLinks');

	add_link(
		'@istituzione_new?slug='. $istitutionSlug .'&id='. $sf_params->get('id'),
		'canonical');
}

?>
<div id="title">
  <em>fonte: <?php echo link_to('Parlamento Europeo', 'http://www.europarl.europa.eu/news/public/default_it.htm')?></em>
  <h1><?php echo $title; ?></h1>
</div>
<hr/>

<div class="genericblock">
<div class="header"></div>
  <table>
    
    <tbody>
      <!--
      <?php //if($commissari_europei): ?>
        <?php //foreach ($commissari_europei as $commissario_europeo): ?>
          <tr class="dark"> 
            <td>
              <?php //echo link_to("<em class=\"surname\">".$commissario_europeo->getOpPolitician()->getLastName()."</em>&nbsp;".ucwords(strtolower($commissario_europeo->getOpPolitician()->getFirstName())), 'politician/page?content_id='.$commissario_europeo->GetPoliticianId()); ?>
		    </td>
            <td><b><?php //echo $commissario_europeo->getOpChargeType()->getName() ?></b></td>
            <td class="last"><?php //echo $commissario_europeo->getOpParty()->getName() ?></td>
	      </tr>
	    <?php //endforeach; ?>
      <?php //endif; ?>
      -->
    <!-- sorting -->
    <tr class="label">
      <td>
        <?php if ($sf_user->getAttribute('sort', NULL, 'fe/forinstitution/sort') == 'last_name'): ?>
          <?php echo (($sf_user->getAttribute('type', 'asc', 'fe/forinstitution/sort') == 'asc') ? image_tag('buttons/order-up.gif') : image_tag('buttons/order-down.gif') ) ?>
		  <?php echo link_to(__('Cognome e nome'), 'politician/forinstitution?id='.$sf_params->get('id').'&slug='.$istitutionSlug.'&sort=last_name&type='.($sf_user->getAttribute('type', 'asc', 'fe/forinstitution/sort') == 'asc' ? 'desc' : 'asc')) ?>
        <?php else: ?>
          <?php echo link_to(__('Cognome e nome'), 'politician/forinstitution?id='.$sf_params->get('id').'&slug='.$istitutionSlug.'&sort=last_name&type=asc') ?>
        <?php endif; ?>
      </td>

      <td>
        <?php if ($sf_user->getAttribute('sort', NULL, 'fe/forinstitution/sort') == 'acronym'): ?>
          <?php echo (($sf_user->getAttribute('type', 'asc', 'fe/forinstitution/sort') == 'asc') ? image_tag('buttons/order-up.gif') : image_tag('buttons/order-down.gif') ) ?>
		  <?php echo link_to(__('Gruppo'), 'politician/forinstitution?id='.$sf_params->get('id').'&slug='.$istitutionSlug.'&sort=acronym&type='.($sf_user->getAttribute('type', 'asc', 'fe/forinstitution/sort') == 'asc' ? 'desc' : 'asc')) ?>
        <?php else: ?>
          <?php echo link_to(__('Gruppo'), 'politician/forinstitution?id='.$sf_params->get('id').'&slug='.$istitutionSlug.'&sort=acronym&type=asc') ?>
        <?php endif; ?>
      </td>

      <td class="last">
        <?php if ($sf_user->getAttribute('sort', NULL, 'fe/forinstitution/sort') == 'name'): ?>
          <?php echo (($sf_user->getAttribute('type', 'asc', 'fe/forinstitution/sort') == 'asc') ? image_tag('buttons/order-up.gif') : image_tag('buttons/order-down.gif') ) ?>
          <?php echo link_to(__('Circoscrizione'), 'politician/forinstitution?id='.$sf_params->get('id').'&slug='.$istitutionSlug.'&sort=name&type='.($sf_user->getAttribute('type', 'asc', 'fe/forinstitution/sort') == 'asc' ? 'desc' : 'asc')) ?>
        <?php else: ?> 
          <?php echo link_to(__('Circoscrizione'), 'politician/forinstitution?id='.$sf_params->get('id').'&slug='.$istitutionSlug.'&sort=name&type=asc') ?>
        <?php endif; ?>
      </td>
    </tr>	
    <!-- end sorting-->

    <?php $tr_class = 'dark' ?>		
    <?php foreach ($pager->getResults() as $institution_charge): ?>
      <tr class="<?php echo $tr_class; ?>">
        <td>
          <?php echo link_to("<em class=\"surname\">".$institution_charge->getOpPolitician()->getLastName()."</em>&nbsp;".ucwords(strtolower($institution_charge->getOpPolitician()->getFirstName())), 
					//'politician/page?content_id='.$institution_charge->GetPoliticianId()
					'@politico_new?content_id='.$institution_charge->GetPoliticianId().'&slug='. $institution_charge->getOpPolitician()->getSlug()
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