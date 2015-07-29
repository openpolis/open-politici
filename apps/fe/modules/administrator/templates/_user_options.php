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
<?php if ($sf_user->hasCredential('administrator')): ?>
<div class="options">
  <?php if ($subscriber->getDeletions()): ?>
    [<?php echo __('%1% contributions removed', array('%1%' => $subscriber->getDeletions())) ?>]
  <?php endif;?>

  &nbsp;
  <?php if ($subscriber->getIsModerator()): ?>
    <?php echo link_to('['.__('moderator').' -]', 'administrator/removeModerator?nickname='.$subscriber->getNickname()) ?>
  <?php else: ?>
    <?php echo link_to('['.__('moderator').' +]', 'administrator/promoteModerator?nickname='.$subscriber->getNickname()) ?>
  <?php endif;?>

  &nbsp;
  <?php if ($subscriber->getIsAdministrator()): ?>
    <?php echo link_to('['.__('administrator').' -]', 'administrator/removeAdministrator?nickname='.$subscriber->getNickname()) ?>
  <?php else: ?>
    <?php echo link_to('['.__('administrator').' +]', 'administrator/promoteAdministrator?nickname='.$subscriber->getNickname()) ?>
  <?php endif;?>

  &nbsp;<?php echo link_to('['.__('delete user').']', 'administrator/deleteUser?nickname='.$subscriber->getNickname(), 'confirm='.__('Are you sure you want to delete this user and all his contributions?')) ?>
</div>

<br />

<?php endif;?>
