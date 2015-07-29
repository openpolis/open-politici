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
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
  <head>
    <meta name="verify-v1" content="NkhveoVfinSZhsdVK8a+kN89DuYfXmo4BDwljNkry2M=" />
    <?php echo include_http_metas() ?>
    <?php echo include_metas() ?>
    <?php echo include_title() ?>

	<?php if (has_slot('header_links')) : ?>
	  <?php include_slot('header_links') ?>
	<?php endif; ?>
	
    <script type="text/javascript" src="/js/PopBox.js"></script>
    <?php if ($this->getContext()->getModuleName() == 'polDeclarations' &&
              $this->getContext()->getActionName() == 'index'): ?>
          <link rel="image_src" href="<?php echo $image_src ?>" / > 
    <?php else : ?>
      <link rel="image_src" href="http://www.openpolis.it/images/openpolis-logo-small-white.png" / >        
    <?php endif ?>          
    <link rel="shortcut icon" href="/favicon.ico" type="image/png"/>
    <?php echo auto_discovery_link_tag('rss', 'feed/lastDeclarations') ?>
  </head>

  <body>
    <?php //include_partial('global/banner') ?>

    <div id="container" class="clearfix">
      <div id="wrapper">
      	<div id="header">
      	  <?php include_partial('global/header') ?>
		</div>
		<hr />
	  	<div id="path">
	  	  <?php include_partial('global/breadcrumbs') ?>
		</div>
		<hr />
		<div id="content">
        
      <?php if ($sf_flash->has('error')): ?>
        <div class="flash-messages error">
          <?php echo $sf_flash->get('error') ?>
        </div>
      <?php endif; ?>
      <?php if ($sf_flash->has('warning')): ?>
        <div class="flash-messages warning">
          <?php echo $sf_flash->get('warning') ?>
        </div>
      <?php endif; ?>
      <?php if ($sf_flash->has('notice')): ?>
        <div class="flash-messages notice">
          <?php echo $sf_flash->get('notice') ?>
        </div>
      <?php endif; ?>
      
  	  <div id="content-group" class="clearfix">

    		<div id="dx">
          <?php if (has_slot('subnav')): ?>
             <?php include_slot('subnav') ?>
       		<?php endif ?>
     		
  	  	  <?php include_component_slot('sidebar') ?>
          <?php //include_partial('global/donation') ?> 
          <?php include_component_slot('feed') ?>	   
          <?php include_component_slot('cloud') ?> 
          <?php include_component_slot('users') ?>
          <?php include_component_slot('adoptions') ?>          
          <?php include_component_slot('wiki') ?>
          <?php include_component_slot('statistics') ?>
    		</div>        

  	    <div id="sx">
    	      <?php echo $sf_data->getRaw('sf_content') ?>
    		</div>

    		<hr />

		  </div>	
		</div>

		<hr />
		<?php include_partial('global/footer') ?>			
	  </div>
    </div>


    <!-- 5xmille  -->
    <script src="https://s3.eu-central-1.amazonaws.com/op-5xmille/5xmille-nojquery.js"></script>
    <!-- end5xmille  -->

   
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	var pageTracker = _gat._getTracker("UA-980632-6");
	pageTracker._initData();
	pageTracker._trackPageview();
	</script>

  </body>
</html>
