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
<?php echo use_helper('Text') ?>

<?php
$act = $this->getContext()->getActionName(); 
$mod = $this->getContext()->getModuleName();
// edits
$attributes = array('lang'=>'it', 'xml:lang'=>'it', 'hreflang'=>'it', 'title'=>'');
$homelink = link_to('Home', '@homepage', $attributes);
?>
<div class="path-group">
  Ti trovi in
<?php switch($mod): ?>
<?php case 'default': ?>
    <?php if($act=='politiciansHome'): ?>
      <?php echo $homelink; ?>
      &nbsp;&raquo;&nbsp;<strong>Politici</strong>
    <?php else: ?>
      &raquo;&nbsp;<strong>Home</strong>
    <?php endif; ?>
    <?php break; ?>
    
  <?php case 'polInstitutionCharges': ?>
    <?php echo $homelink; ?>
    &nbsp;&raquo;
    <?php if($act=='entiCommissariati'): ?>
      <strong><?php echo "Enti commissariati" ?></span></strong> 
    <?php elseif ($act=='multipleChargeTitle'): ?> 
      <?php echo link_to('Politici', '@politici_new', $attributes) ?>
      &nbsp;&raquo;
       <strong><?php echo "Politici con incarichi multipli" ?></span></strong> 
    <?php endif; ?>
    <?php break; ?>
    
  <?php case 'politician': ?>
    <?php echo $homelink; ?>
    &nbsp;&raquo;
    <?php echo link_to('Politici', '@politici_new', $attributes) ?>
    &nbsp;&raquo;
    <?php if($act=='reportForm' || $act=='report' ): ?>
      <?php $politician = OpPoliticianPeer::RetrieveByPk($sf_params->get('politician_id')) ?>
      <?php echo link_to(ucwords(strtolower($politician->getFirstName())).'&nbsp;<span class=\'surname\'>'.$politician->getLastName().'</span>', 
					//'politician/page?content_id='.$politician->getContentId()
					'@politico_new?content_id='. $politician->getContentId() .'&slug='. $politician->getSlug()
				); ?>
      &nbsp;&raquo;&nbsp;<strong>Segnalazione di errori/abusi</strong>
    <?php elseif($act=='forinstitution'): ?>
      <?php $institution = OpInstitutionPeer::RetrieveByPk($sf_params->get('id')) ?>
      <strong><?php echo $institution->getName() ?></strong>
    <?php elseif ($act=='regPoliticians'): ?>
      <?php $location = OpLocationPeer::RetrieveByPk($sf_params->get('location_id')) ?>
      <strong>Regione&nbsp;<?php echo $location->getName() ?></strong>
    <?php elseif ($act=='provPoliticians'): ?>
      <?php $location = OpLocationPeer::RetrieveByPk($sf_params->get('location_id')) ?>
      <strong>Provincia&nbsp;<?php echo $location->getName() ?></strong>
    <?php elseif ($act=='munPoliticians'): ?>
      <?php $location = OpLocationPeer::RetrieveByPk($sf_params->get('location_id')) ?>
      <strong>Comune&nbsp;<?php echo $location->getName() ?></strong>
    <?php elseif ($act=='forlocation'): ?>
      <?php $location = OpLocationPeer::RetrieveByPk($sf_params->get('location_id')) ?>
      <strong><?php echo $location->getName() ?>&nbsp;(<?php echo $location->getProv() ?>)</strong>
    <?php elseif ($act=='page'): ?>
      <?php $politician = OpPoliticianPeer::RetrieveByPk($sf_params->get('content_id')) ?>
      <strong><?php echo ucwords(strtolower($politician->getFirstName())) ?>&nbsp;<span class="surname"><?php echo $politician->getLastName() ?></span></strong>
      <?php elseif ($act=='listTaxDeclaration'): ?>
      <strong><?php echo "Dichiarazioni patrimoniali" ?></span></strong>  
    <?php endif; ?>
    <?php break; ?>

  <?php case 'polDeclarations': ?>
    <?php echo $homelink; ?>
    &nbsp;&raquo;
    <?php echo link_to('Politici', '@politici_new', $attributes) ?>
    &nbsp;&raquo;
    <?php if($act=='index'): ?>
      <?php $declaration = OpDeclarationPeer::RetrieveByPk($sf_params->get('declaration_id')) ?>
      <?php echo link_to(ucwords(strtolower($declaration->getOpPolitician()->getFirstName())).'&nbsp;<span class=\'surname\'>'.$declaration->getOpPolitician()->getLastName().'</span>', 
				//'politician/page?content_id='.$declaration->getPoliticianId()
				'@politico_new?content_id='. $declaration->getPoliticianId() .'&slug='. $declaration->getOpPolitician()->getSlug()
				) ?>
      &nbsp;&raquo;&nbsp;<strong><?php echo truncate_text($declaration->getTitle(), 150 , '...') ?></strong>
    <?php elseif ($act=='create' || $act=='update'): ?>
      <?php if ($sf_params->has('politician_id') && $sf_params->get('politician_id') != ''): ?>
        <?php $politician = OpPoliticianPeer::RetrieveByPk($sf_params->get('politician_id')) ?>
        <?php echo link_to(ucwords(strtolower($politician->getFirstName())).'&nbsp;<span class=\'surname\'>'.$politician->getLastName().'</span>', 
				//'politician/page?content_id='.$politician->getContentId()
				'@politico_new?content_id='. $politician->getContentId() .'&slug='. $politician->getSlug()
				) ?>
        &nbsp;&raquo;&nbsp;<strong><?php echo ($act=='create' ? 'Aggiungi una nuova ' : 'Modifica la ')?>dichiarazione</strong>
      <?php endif; ?>
      <?php if ($sf_params->has('theme_id')): ?>
        <?php $theme = OpThemePeer::retrieveByPK($sf_params->get('theme_id')) ?>
        <?php echo link_to($theme->getTitle(), '@tema?theme_id='.$theme->getContentId()) ?>
        &nbsp;&raquo;&nbsp;<strong>Aggiungi una nuova dichiarazione</strong>
        
      <?php endif; ?>      
    <?php elseif ($act=='edit'): ?>
      <?php $politician = OpPoliticianPeer::RetrieveByPk($sf_params->get('politician_id')) ?>
      <?php echo link_to(ucwords(strtolower($politician->getFirstName())).'&nbsp;<span class=\'surname\'>'.$politician->getLastName().'</span>', 
			//'politician/page?content_id='.$politician->getContentId()
			'@politico_new?content_id='. $politician->getContentId() .'&slug='. $politician->getSlug()
			) ?>
      &nbsp;&raquo;&nbsp;<strong>Modifica la dichiarazione</strong>
	<?php elseif ($act=='lastDeclarations'): ?>
      &nbsp;<strong>Le ultime 50 dichiarazioni pubblicate</strong>  
    <?php endif; ?>
    <?php break; ?>

  <?php case 'argument': ?>
    <?php if($act=='index'): ?>
      <?php echo $homelink; ?>
      &nbsp;&raquo;&nbsp;<strong>Dichiarazioni</strong>
    <?php elseif ($act=='list'): ?>
      <?php $tag = OpTagPeer::RetrieveByPk($sf_params->get('tag')) ?>
      <?php echo $homelink; ?>
      &nbsp;&raquo;
      <?php echo link_to('Dichiarazioni', 'argument/index', $attributes) ?>
      &nbsp;&raquo;&nbsp;<strong><?php echo $tag->getTag() ?></strong>
    <?php endif; ?>
    <?php break; ?>
    
      <?php case 'themes': ?>
    <?php if ($act=='list'): ?>
      <?php echo $homelink; ?>
      &nbsp;&raquo;&nbsp;<strong>Posizioni</strong>
    <?php elseif ($act=='show'): ?>
      <?php $theme = OpThemePeer::RetrieveByPk($sf_params->get('theme_id')) ?>
      <?php echo $homelink; ?>
      &nbsp;&raquo;
      <?php echo link_to('Posizioni', 'themes/list', $attributes) ?>
      &nbsp;&raquo;&nbsp;<strong><?php echo $theme->getTitle() ?></strong>
     <?php elseif ($act=='addDeclarationForTheme'): ?>
      <?php $theme = OpThemePeer::RetrieveByPk($sf_params->get('theme_id')) ?>
      <?php echo $homelink; ?>
      &nbsp;&raquo;
      <?php echo link_to('Posizioni', 'themes/list', $attributes) ?>
      &nbsp;&raquo;
      <?php echo link_to($theme->getTitle(), "tema/".$theme->getContentId(), $attributes) ?>
      &nbsp;&raquo;&nbsp;<strong>Aggiungi posizione di un politico</strong>

    <?php endif; ?>
    <?php break; ?>

  <?php case 'community': ?>
    <?php echo $homelink; ?>
    &nbsp;&raquo;&nbsp;<strong>Comunit&agrave;</strong>
    <?php break; ?>

  <?php case 'solr': ?>
    <?php echo $homelink; ?>
    &nbsp;&raquo;&nbsp;<strong>Risultati ricerca</strong>
    <?php break; ?>

  <?php case 'user': ?>
    <?php if($act=='show'): ?>
      <?php echo $homelink; ?>
      &nbsp;&raquo;
      <?php echo link_to('Comunit&agrave;', '@comunita_new', $attributes) ?>
      <?php $user = OpUserPeer::getUserFromHash($sf_params->get('hash')) ?>
      &nbsp;&raquo;&nbsp;<strong><?php echo $user->__toString(); ?></strong>
    <?php endif; ?>
    <?php if($act=='addRequiring' || $act=='addedRequiring' ): ?>
      <?php echo $homelink; ?>
      &nbsp;&raquo;
      <?php echo link_to('Comunit&agrave;', '@comunita_new', $attributes) ?>
      <?php $user = OpUserPeer::RetrieveByPk($sf_params->get('user_id')) ?>
      &nbsp;&raquo;&nbsp;<strong><?php echo "Prenotazione" ?></strong>
    <?php endif; ?>
    <?php if($act=='login'): ?>
      <?php echo $homelink; ?>
      &nbsp;&raquo;
      <?php echo link_to('Comunit&agrave;', '@comunita_new', $attributes) ?>
      <?php $user = OpUserPeer::RetrieveByPk($sf_params->get('user_id')) ?>
      &nbsp;&raquo;&nbsp;<strong><?php echo "Entra" ?></strong>
    <?php endif; ?>
    <?php if($act=='passwordRequest'): ?>
      <?php echo $homelink; ?>
      &nbsp;&raquo;
      <?php echo link_to('Comunit&agrave;', '@comunita_new', $attributes) ?>
      <?php $user = OpUserPeer::RetrieveByPk($sf_params->get('user_id')) ?>
      &nbsp;&raquo;&nbsp;<strong><?php echo "Richiedi nuova password" ?></strong>
    <?php endif; ?>
    <?php break; ?>

  <?php case 'static': ?>
    <?php echo $homelink; ?>&nbsp;&raquo;&nbsp;
    <?php if($act=='chiSiamo'): ?><strong><?php echo "Chi siamo" ?></strong><?php endif; ?>
    <?php if($act=='contribuisci'): ?><strong><?php echo "Contribuisci a openpolis" ?></strong><?php endif; ?>
    <?php if($act=='regolamento'): ?><strong><?php echo "Regolamento" ?></strong><?php endif; ?>
    <?php if($act=='condizioni'): ?><strong><?php echo "Condizioni d'uso" ?></strong><?php endif; ?>
    <?php if($act=='informativa'): ?><strong><?php echo "Informativa sui dati personali" ?></strong><?php endif; ?>
    <?php if($act=='blog'): ?><strong><?php echo "Strumenti per il tuo blog" ?></strong><?php endif; ?>
    <?php if($act=='prossimi'): ?><strong><?php echo "Prossimi passi" ?></strong><?php endif; ?>
    <?php if($act=='contatti'): ?><strong><?php echo "Contatti" ?></strong><?php endif; ?>
    <?php if($act=='budget'): ?><strong><?php echo "Budget 2008" ?></strong><?php endif; ?>
    <?php if($act=='software'): ?><strong><?php echo "Software utilizzati" ?></strong><?php endif; ?>
    <?php break; ?>
    
  <?php case 'feed': ?>
    <?php echo $homelink; ?>
    &nbsp;&raquo;&nbsp;<strong><?php echo "Rss/xml" ?></strong>
    <?php break; ?>

  <?php case 'faq': ?>
    <?php echo $homelink; ?>
    &nbsp;&raquo;&nbsp;<strong><?php echo "Faq" ?></strong>
    <?php break; ?>

  <?php case 'administrator': ?>
    <?php echo $homelink; ?>
    &nbsp;&raquo;&nbsp;
    <?php if($act=='index'): ?>
      <strong><?php echo "Gestione dati" ?></strong>
    <?php elseif($act=='nationalManaging'): ?>
      <?php echo link_to('Gestione dati', 'administrator/index', $attributes) ?>
      &nbsp;&raquo;&nbsp;
      <strong><?php echo "Gestione cariche europee e nazionali" ?></strong>
    <?php elseif($act=='partyManaging'): ?>
      <?php echo link_to('Gestione dati', 'administrator/index', $attributes) ?>
      &nbsp;&raquo;&nbsp;
      <strong><?php echo "Gestione partiti" ?></strong>
    <?php elseif($act=='groupManaging'): ?>
      <?php echo link_to('Gestione dati', 'administrator/index', $attributes) ?>
      &nbsp;&raquo;&nbsp;
      <strong><?php echo "Gestione gruppi" ?></strong>
    <?php elseif($act=='locationManaging'): ?>
      <?php echo link_to('Gestione dati', 'administrator/index', $attributes) ?>
      &nbsp;&raquo;&nbsp;
      <strong><?php echo "Gestione cariche enti locali" ?></strong>
    <?php elseif($act=='obscuredContents'): ?>
      <strong><?php echo "Contenuti oscurati" ?></strong>
    <?php endif; ?>
    <?php break; ?>

  <?php case 'integrazione_cam_sen': ?>
    <?php echo $homelink; ?>
    &nbsp;&raquo;&nbsp;
    <?php echo link_to('Politici', '@politici_new', $attributes) ?>
    &nbsp;&raquo;&nbsp;
    <?php if($act=='ListaTotalePresenzeCamera'): ?>
      <?php echo link_to('Camera dei Deputati', '@istituzione_new?slug=deputati&id=4', $attributes) ?>
      &nbsp;&raquo;&nbsp;
      <strong><?php echo "Presenze dei deputati" ?></strong>
    <?php elseif($act=='ListaTotaleIndiceCamera'): ?>
      <?php echo link_to('Camera dei Deputati', '@istituzione_new?slug=deputati&id=4', $attributes) ?>
      &nbsp;&raquo;&nbsp;
      <strong><?php echo "Indice di attivit&agrave; dei Deputati" ?></strong>
    <?php elseif($act=='ListaTotalePresenzeSenato'): ?>
      <?php echo link_to('Senato della Repubblica', '@istituzione_new?slug=senatori&id=5', $attributes) ?>
      &nbsp;&raquo;&nbsp;
      <strong><?php echo "Presenze dei Senatori" ?></strong>
    <?php elseif($act=='ListaTotaleIndiceSenato'): ?>
      <?php echo link_to('Senato della Repubblica', '@istituzione_new?slug=senatori&id=5', $attributes) ?>
      &nbsp;&raquo;&nbsp;
      <strong><?php echo "Indice di attivit&agrave; dei Senatori" ?></strong>
    <?php endif; ?>
    <?php break; ?>

  <?php case 'widgets': ?>
    <?php echo $homelink; ?>
    &nbsp;&raquo;
    <?php echo link_to('Politici', '@politici_new', $attributes) ?>
    &nbsp;&raquo;
    &nbsp;&raquo;&nbsp;<strong><?php echo "Personalizza e pubblica sul tuo blog" ?></strong>
    <?php break; ?>

<?php endswitch; ?>
</div>