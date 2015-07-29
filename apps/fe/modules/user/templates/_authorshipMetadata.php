<?php use_helper('Date') ?>

Creazione: 
<?php if ($author->getId() != 1): ?>  
  <?php echo link_to($author, '@user_profile?hash='.$author->getHash()) ?>
<?php else: ?>
  admin
<?php endif ?>
il <?php echo format_date($created_at, "dd/MM/yyyy");?>
<?php if ($updater && $created_at != $updated_at): ?>
  <br/>Ultima modifica: 
  <?php if ($updater->getId() != 1): ?>  
    <?php echo link_to($updater, '@user_profile?hash='.$updater->getHash()) ?>
  <?php else: ?>
    admin
  <?php endif ?>
  il
  <?php echo format_date($updated_at, "dd/MM/yyyy");?>
<?php endif ?>
