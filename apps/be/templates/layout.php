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

    <link rel="shortcut icon" href="/favicon.ico" />
    <style type="text/css" media="screen">
        tr pre { white-space: normal; }
    </style>
  </head>
  <body>
  
    <!-- navigazione principale e login -->
    <?php include_partial('global/mainNavigation', 
      array('module_name' => $sf_context->getModuleName(),
            'sf_user' => $sf_user)) ?>  

    <!-- contenuto -->
    <div id="main_content">
      <?php echo $sf_data->getRaw('sf_content') ?>
    </div>
  
  </body>
</html>