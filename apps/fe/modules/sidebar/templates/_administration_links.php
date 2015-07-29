<?php if ($sf_user->hasCredential('administrator') ||
          $sf_user->hasCredential('aggiungitore')): ?>
  <li><?php echo link_to('inserimento di un politico', 'administrator/politicianData'); ?></li>
<?php endif ?>

<?php if ($sf_user->hasCredential('administrator')): ?>

  <li><?php echo link_to('gestione adozioni', '@adozioni'); ?></li>

  <?php if (!$sf_user->hasCredential('moderator')): ?>
    <li><?php echo link_to(__('contenuti oscurati'), 'administrator/obscuredContents') ?> (<?php echo OpObscuredContentPeer::doCount(new Criteria()) ?>)</li>  
  <?php endif ?>

  <li><?php echo link_to(__('candidati moderatori'), 'administrator/moderatorCandidates') ?> (<?php echo OpUserPeer::getModeratorCandidatesCount() ?>)</li>

  <li><?php echo link_to(__('lista moderatori'), 'administrator/moderators') ?></li>

  <li><?php echo link_to(__('lista amministratori'), 'administrator/administrators') ?></li>

  <li><?php echo link_to(__('utenti problematici'), 'administrator/problematicUsers') ?> (<?php echo OpUserPeer::getProblematicUsersCount() ?>)</li>

  <li>
    <?php echo link_to(__('lista candidati voisietequi non assegnati'), '@candidati_vsq?assegnati=0') ?>
    (<?php echo OpPoliticianPeer::countVsqCandidates(0) ?>)
  </li>  

  <li><?php echo link_to ('gestione partiti', 'administrator/partyManaging') ?></li>

  <li><?php echo link_to ('gestione gruppi', 'administrator/groupManaging') ?></li>

  <li><?php echo link_to ('gestione istituzioni nazionali', 'administrator/nationalManaging') ?></li>

  <li><?php echo link_to ('gestione amministrazioni locali', 'administrator/locationManaging') ?></li>	

<?php endif ?>


