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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php echo include_http_metas() ?>
<?php echo include_metas() ?>

<?php echo include_title() ?>
<link rel="shortcut icon" href="/favicon.ico" type="image/png"/>
<?php echo auto_discovery_link_tag('rss', 'feed/lastDeclarations') ?>


</head>
<body>
<div id="indicator" style="display:none"></div>
<?php use_helper('Javascript'); ?>
<div id="header">
	<!--<ul>
		<?php if ($sf_user->isAuthenticated()): ?>
			<li><?php echo link_to('logout', '@logout') ?></li>
			<li><?php echo link_to($sf_user->getNickname(). '\'s profile', 'user/show') ?></li>
		<?php else: ?>
			<li><?php echo link_to('login', '@login') ?></li>
		<?php endif; ?>
		<li><?php echo link_to('about', '@homepage') ?></li>
  	</ul>
  	<br /> -->
  
  	<h1><?php echo link_to(image_tag('op_logo.png', array('alt'=>'consensus')), '@homepage') ?></h1>
   <?php if($this->getContext()->getModuleName() == 'administrator' && $this->getContext()->getActionName() == 'index')
   echo include_partial('default/globalSearch') ?>
</div>  
	

<div id="login" style="display: none">
      <h2>effettua prima il login</h2>
	  <?php echo form_tag('@login', 'id=loginform') ?>
        <label for="nickname">nickname:</label><?php echo input_tag('nickname') ?>
        <label for="password">password:</label><?php echo input_password_tag('password') ?>
        <?php echo input_hidden_tag('referer', $sf_params->get('referer') ? $sf_params->get('referer') : $sf_request->getUri()) ?>
        <?php echo submit_tag('login') ?>
        &nbsp;&nbsp;&nbsp;&nbsp;<?php echo checkbox_tag('remember_me', 1) ?>
        <label for="new" style="display: inline; float: none">ricorda</label>
        &nbsp;&nbsp;&nbsp;<?php echo link_to_function('cancella', visual_effect('blind_up', 'login', array('duration' => 0.5))) ?>
     </form>
    </div>

<div id="main_menu">
	<?php include_component_slot('main_menu') ?>
</div>

<div id="content">
	<div id="content_main" style="width:100%">
  		<?php echo $sf_data->getRaw('sf_content') ?>
    	<div id="verticalalign"></div>
  	</div>
</div>


<?php include_partial('global/footer') ?>

</body>
</html>