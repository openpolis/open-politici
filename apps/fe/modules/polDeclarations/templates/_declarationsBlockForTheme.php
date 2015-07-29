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
Di seguito le posizioni dei politici su questo tema.

     <?php if ($sf_user->hasCredential('subscriber')): ?>
           <?php echo link_to(image_tag('buttons/add_posizione.png', 
           			array('width'=>'208', 'height'=>'18','alt'=>'aggiungi posizione', 'border'=>'0','style' => 'vertical-align: middle;')),
           			 "@aggiungi_dichiarazione_associata?theme_id=$theme_id",
                         	array('class' => 'orange', 'title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
      <?php else: ?>
           <?php echo link_to(image_tag('buttons/add_posizione.png', 
           			array('width'=>'208', 'height'=>'18','alt'=>'aggiungi posizione', 'border'=>'0','style' => 'vertical-align: middle;')), 
           			"@sf_guard_signin",
                                array('class' => 'orange', 'title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?> 
      <?php endif; ?>                                
<br /><br />
<div class="header">
  <span class="rights-elements">
    <?php echo link_to(image_tag('buttons/close.png', 
                                 array('alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14', 'border'=>'0')), 
                                 '#', 
                                 array('id' => 'dichiarazioni_toggle_img', 
                                       'onClick' => 'return toggleDeclarations();', 
                                       'title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
  </span>
  <h2>Posizioni dei politici sul tema (<?php echo format_number_choice('[0] 0|[1] 1 |(1,+Inf] %1%', 
                                                array('%1%' => count($declarations)), count($declarations)) ?>)</h2>
</div>

<div id="dichiarazioni">
  <div class="sottomenu">
    <span class="add">
      <?php if ($sf_user->hasCredential('subscriber')): ?>
           <?php echo link_to('&raquo; Aggiungi posizione di un politico', "@aggiungi_dichiarazione_associata?theme_id=$theme_id",
                              array('class' => 'orange', 'title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
      <?php else: ?>
           <?php echo link_to('&raquo; Aggiungi posizione di un politico', "@sf_guard_signin",
                         array('class' => 'orange', 'title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?> 
      <?php endif; ?>    
    </span>
    Ordina per:
    <?php if ($sort=='last'): ?>
    
      <div> Ultime aggiunte</div>
  	  <!-- <div>
  	    <?php echo link_to_remote('Coalizione', 
  	                               array('update' => 'declarations_for_ajax',
                                         'url' => 'polDeclarations/blockForThemePage?theme_id='.$theme_id.'&sort=coalition')) ?>		
  	  </div> -->
  	  <div>
  	    <?php echo link_to_remote('Posizione', 
  	                               array('update' => 'declarations_for_ajax',
                                         'url' => 'polDeclarations/blockForThemePage?theme_id='.$theme_id.'&sort=position')) ?>		
  	  </div>
    <?php elseif ($sort=='insert'): ?>
  	  <div>
  	    <?php echo link_to_remote('Ultime aggiunte', 
                                  array('update' => 'declarations_for_ajax',
                                        'url' => 'polDeclarations/blockForThemePage?theme_id='.$theme_id.'&sort=last')) ?>		
  	  </div>
      <!-- <div>Coalizione</div> -->
  	  <div>
  	    <?php echo link_to_remote('Posizione', 
  	                               array('update' => 'declarations_for_ajax',
                                         'url' => 'polDeclarations/blockForThemePage?theme_id='.$theme_id.'&sort=position')) ?>		
  	  </div>
    <?php else: ?>	  
  	  <div>
  	    <?php echo link_to_remote('Ultime aggiunte', 
                                  array('update' => 'declarations_for_ajax',
                                        'url' => 'polDeclarations/blockForThemePage?theme_id='.$theme_id.'&sort=last')) ?>		
  	  </div>
  	<!--  <div>
  	    <?php echo link_to_remote('Coalizione', 
  	                               array('update' => 'declarations_for_ajax',
                                         'url' => 'polDeclarations/blockForThemePage?theme_id='.$theme_id.'&sort=coalition')) ?>		
  	  </div> -->
      <div>Posizione</div>
    <?php endif; ?>	
  </div>

  <div class="dichiarazione">
    <ul>
      <?php foreach ($declarations as $declaration): ?>
        <li class="clearfix">
          <?php include_partial('polDeclarations/declarationBlockForTheme', 
                                array('declaration' => $declaration, 
                                      'theme_id' => $theme_id,
                                      'positions' => sfConfig::get('app_position_on_theme'),
                                      'position' => $declaration->getAssociatedTheme($theme_id)->getPosition() + 4)) ?>
        </li>
      <?php endforeach ?>
    </ul>
  </div>

</div>

<?php echo javascript_tag("
  function toggleDeclarations()
  {
    div = 'dichiarazioni';	
    var image = $(div+'_toggle_img');
    if (Element.visible(div))
    {
      new Effect.BlindUp(div, {duration:0.5});
      image.src = '/images/buttons/open.png';
    }
    else
    {
      new Effect.BlindDown(div, {duration:0.4});
      image.src = '/images/buttons/close.png';
    }

    return false;
  }")
?>