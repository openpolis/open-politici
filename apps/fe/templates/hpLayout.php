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
    <meta name="verify-v1" content="slKT5esHiDYamAIi8xAKZ1PQAUcVAFCzsffW7oMvrgg=" />
    <?php echo include_http_metas() ?>
    <?php echo include_metas() ?>

    <?php echo include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" type="image/png"/>
    <?php echo auto_discovery_link_tag('rss', 'feed/lastDeclarations') ?>
    <script type="text/javascript" src="/js/niftycube.js"></script>
    <script type="text/javascript">
      window.onload=function(){
      Nifty("div.azzurrino","big");
      }
    </script>
  </head>

  <body>

  <?php //include_partial('global/banner') ?>


  <div id="container">
     <div id="wrapper">
      	<div id="header">
      	  <?php include_partial('global/headerHp') ?>
	    </div>


         <div id="content-home">

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

            <?php echo $sf_data->getRaw('sf_content') ?>
    	 </div>

	     <hr />

	     <?php include_partial('global/footer') ?>
			
     </div>
  </div>

  <!-- 5xmille
  <script src="https://s3.eu-central-1.amazonaws.com/op-5xmille/5xmille-nojquery.js"></script>
  end5xmille  -->

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
