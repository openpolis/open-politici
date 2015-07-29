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
<?php echo use_helper('Javascript') ?>
<?php
$act = $this->getContext()->getActionName(); 
$mod = $this->getContext()->getModuleName();
?>
<div id="header-sx">
  	<?php echo link_to(image_tag('openpolis-logo-new.png', array('width'=>'327', 'height'=>'100', 'alt'=>'Openpolis', 'border'=>'0')),'@homepage') ?>
	  <a href="http://www.openpolis.it"><?php echo image_tag('openpolis-tool.png', array('width'=>'86', 'height'=>'26', 'alt'=>'openparlamento', 'border'=>'0', 'style' => 'margin-bottom: 20px')) ?></a>
	  <a href="http://parlamento.openpolis.it" id="link-hover"></a>
	  <?php include_component_slot('main_menu') ?>
</div>
<hr />
<div id="header-dx">
  <div class="service-menu">
    <?php if ($sf_user->isAuthenticated()): ?>
      ciao&nbsp;<?php echo link_to($sf_user->getFirstName(),
                                   '@user_profile?hash='.$sf_user->getHash()) ?>&nbsp;&nbsp;|&nbsp;
	  <?php echo link_to('esci', '@sf_guard_signout') ?>
    <?php else: ?>
      <?php echo link_to('entra','@sf_guard_signin', array('lang'=>'it', 'hreflang'=>'it', 'title'=>'')) ?>&nbsp;&nbsp;|&nbsp;
      <?php echo link_to('registrati', 
                          "http://".sfConfig::get('sf_remote_guard_host',
                                                  'op_accesso.openpolis.it').
                          (!stristr(SF_ENVIRONMENT,'prod')?'/be_'.SF_ENVIRONMENT.'.php':'').
                          "/aggiungi_utente" , 
                         array('class' => 'orange')) ?>
    <?php endif; ?>  

  </div>
  <hr />
  
  <?php echo form_tag('solr/search', array("method"=>"get")) ?>
    <?php echo input_tag('query', strip_tags($sf_request->getParameter('query',"Cerca all'interno del sito"), "tabindex=1 accesskey=k")) ?>
    <?php echo submit_tag('Cerca', "class=cerca") ?>
  </form>	  	
  
</div>

<?php echo javascript_tag("
    jQuery(document).ready(function() {
        jQuery('#query').focus(function() {
            var input = jQuery(this);
            if ( input._cleared ) return;
            input.val('');
            input._cleared = true;
        });
    });

"); ?>
<hr /> 
