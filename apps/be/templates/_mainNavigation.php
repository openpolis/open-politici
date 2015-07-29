<?php
  $menu_items = array(
    'politician' => 'Politici e incarichi',
    'location' => 'Tabelle di supporto',
    'party'=>'Partiti e gruppi',
    'faq' => 'Faq',
//    'required_funds' => 'Fondi',
    'user' => 'Utenti',
    'import_modifications_new' => 'Import'
  );
  $politician = array(
    'politician' => 'Elenco dei politici',
    'representatives' => 'Rappresentanti locali',
    'verifications' => 'Verifica incarichi',
    'similar' => 'Gestione politici simili'
  );
  $location = array(
    'location' => 'Localit&agrave;', 
    'profession' => 'Professioni', 
    'education_level' => 'Titoli di studio', 
    'charge_type' => 'Tipi di incarico', 
    'institution' => 'Istituzioni',
    'themes'=>'Temi',
  );
  $party = array(
    'party' => 'Partiti',
    'group' => 'Gruppi'
  );
  $faq = array(
    'faq' => 'Elenco',
    'faq_group' => 'Raggruppamenti'
  );  
  $user = array(
    'user' => 'Utenti',
    'requiring_user' => 'Richiedenti'
  );
  $import_modifications_new = array(
    'import_modifications_new' => 'Aggiunte', 
    'import_modifications_old' => 'Rimozioni', 
    'import_similar' => 'Similarit&agrave;',
    'import_minint' => 'Sincronizzazione Min. Int.',    
  );
  $submenus = array($politician, $location, $party, $faq, $user, $import_modifications_new);
  $menu_sep = '|';
?>

<!-- menu principale -->
<?php if ($sf_user->isAuthenticated() && $sf_user->hasCredential('administrator')): ?>
<ul id="main_menu">
  <?php $cnt = 0; foreach($menu_items as $k=>$v): ?>
    <?php $submenu = eval("return $$k;"); ?>
    <li <?php echo (array_key_exists($module_name, $submenu))?'class="selected"':'';?>><?php echo link_to($v, "/$k"); ?></li>
    <?php if ($cnt++ < count($menu_items)-1) echo $menu_sep; ?>
  <?php endforeach; ?>
</ul>

<div id="logout">
  Ciao, <span class="nick"><?php echo $sf_user->getName()?></span>
  (<?php echo link_to('esci', '@sf_guard_signout') ?>)
</div>
<?php endif; ?>


<?php foreach ($submenus as $submenu): ?>
  <?php if ( array_key_exists($module_name, $submenu)): ?>
    <div style="clear:both;">
      <ul id="sub_menu">
        <?php $cnt = 0; foreach ($submenu as $name => $label): ?>
          <li <?php echo ($module_name == $name)?'class="selected"':'';?>>
            <?php echo link_to($label, "/$name"); ?></li>
          <?php if ($cnt++ < count($submenu)-1) echo $menu_sep; ?>
        <?php endforeach ?>
      </ul>
    </div>
  <?php endif; ?>  
<?php endforeach ?>
