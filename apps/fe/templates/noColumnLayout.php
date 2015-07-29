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
    <meta name="verify-v1" content="slKT5esHiDYamAIi8xAKZ1PQAUcVAFCzsffW7oMvrgg=" />
    <?php echo include_http_metas() ?>
    <?php echo include_metas() ?>

    <?php echo include_title() ?>
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
		      <!-- Banner per campagna
      	  <p align="center">
          <a href="http://associazione.openpolis.it/contribuisci/diventa-socio"><img src="http://op_assoc/images/banner-campagna.png" border=0></a>
          </p>
          -->
	        <?php echo $sf_data->getRaw('sf_content') ?>
			  </div>  
			  <hr />

		    <?php include_partial('global/footer') ?>
	
	    </div>
    </div>
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
