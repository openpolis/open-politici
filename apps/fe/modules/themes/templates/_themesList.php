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
<?php echo use_helper('Javascript', 'Date', 'Text', 'Global', 'Themes', 'OpinableContent', 'Lightbox') ?>

<div class="header">
  <h2>
  <?php if ($sort != 'random' && $sort != 'vsq08'): ?>
    Lista dei temi (<?php echo $pager->getNbResults()?>)
  <?php elseif ($sort == 'vsq08'): ?>
    Lista dei 25 temi selezionati per voisietequi
  <?php else: ?>
    Lista casuale di 
    <?php echo sfConfig::get('app_pagination_themes_limit'); ?>
    temi su
    <?php echo $pager->getNbResults()?>
    totali
  <?php endif; ?>
  </h2>
</div>

<!-- intestazione e switching menu -->
<div class="sottomenu">
  <?php /* aggiunta nuovi temi sospesa
  
  <span class="add">
  	<?php if ($sf_user->hasCredential('subscriber')): ?>
	  <?php echo link_to('&raquo; Aggiungi tema', 'themes/create?mode=add&has_layout=true', 
	                     array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 'class'=>'orange')); ?>
	<?php else: ?>
		<?php echo link_to('&raquo; Aggiungi tema', '@sf_guard_signin', 
		                   array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 'class'=>'orange'));	?>		
	<?php endif; ?>
  </span>
  
  */ ?>

  <?php if ($sort != 'vsq08'): ?>
    &nbsp;ordinamento:
    <?php if ($sort == 'insert'): ?>
      <div>
        <?php echo link_to_remote('casuale', 
                                  array(
                                    'update' => 'items_container',
                                    'url'    => "@themes?area=x&sort=random",
                                    'loading'  => "Element.show('indicator')",
                                    'complete' => "Element.hide('indicator')" )) ?>  
      </div>
      <div>data</div>
      <div>
        <?php echo link_to_remote('priorit&agrave;', 
                                  array(
                                    'update' => 'items_container',
                                    'url'    => "@themes?area=$area&sort=popular&page=1",
                                    'loading'  => "Element.show('indicator')",
                                    'complete' => "Element.hide('indicator')" )) ?>  
      </div>  
    <?php elseif ($sort == 'popular'): ?>
      <div>
        <?php echo link_to_remote('casuale', 
                                  array(
                                    'update' => 'items_container',
                                    'url'    => "@themes?area=x&sort=random",
                                    'loading'  => "Element.show('indicator')",
                                    'complete' => "Element.hide('indicator')" )) ?>  
      </div>
      <div>
        <?php echo link_to_remote('data', 
                                  array(
                                    'update' => 'items_container',
                                    'url'    => "@themes?area=$area&sort=insert&page=1",
                                    'loading'  => "Element.show('indicator')",
                                    'complete' => "Element.hide('indicator')" )) ?>  
      </div>
  	<div>priorit&agrave;</div>
    <?php else: ?>
      <div>casuale</div>
      <div>
        <?php echo link_to_remote('data', 
                                  array(
                                    'update' => 'items_container',
                                    'url'    => "@themes?area=$area&sort=insert&page=1",
                                    'loading'  => "Element.show('indicator')",
                                    'complete' => "Element.hide('indicator')" )) ?>  
      </div>
      <div>
        <?php echo link_to_remote('priorit&agrave;', 
                                  array(
                                    'update' => 'items_container',
                                    'url'    => "@themes?area=$area&sort=popular&page=1",
                                    'loading'  => "Element.show('indicator')",
                                    'complete' => "Element.hide('indicator')" )) ?>  
      </div>  
    <?php endif; ?>
  
  <?php endif ?>  
  
  <!-- selettore area -->
  <div style="margin-left: 20px; border:0">
    Area: <?php echo include_partial('themes/areaSelector', 
                             array('selectables' => $selectable_areas,
                                   'default_value' => isset($area)?$area:'', 
                                   'remote' => true,
                                   'url' => url_for("@themes?area=$area&sort=$sort&page=$page"),
                                   'select_msg' => '= Tutte le aree =', 
                                   'style' => 'font-size: 10px')); ?>             	
  </div>
  
</div>


<!-- separatore --> 
<div style="clear:both; height: 10px"></div>

<!-- blocco navigatore di sopra (numero risultati e paginazione) -->
<?php if ($sort != 'vsq08'): ?>
  <div style="float:right">
    <strong>
      <?php echo link_to_remote('i temi selezionati per voisietequi', 
                                array(
                                  'update' => 'items_container',
                                  'url'    => "@themes?area=x&sort=vsq08&page=1",
                                  'loading'  => "Element.show('indicator')",
                                  'complete' => "Element.hide('indicator')" )) ?>  
    </strong>  
  </div>
<?php endif ?>
<?php if ($sort != 'random' && $sort != 'vsq08'): ?>
  <?php echo include_partial('default/page_navigator', 
                             array( 'pager' => $pager,
                                    'other_params' => "area=$area&sort=$sort",
                                    'limit' => sfConfig::get('app_pagination_themes_limit'),
                                    'container' => 'items_container',
                                    'indicator' => 'indicator',
                                    'other_function' => '',
                                    'items_name' => 'Temi',
                                    'single_item_found' => 'Trovato un solo tema',
                                    'action' => '@themes')) ?>
<?php elseif ($sort == 'vsq08'): ?>
  <div style="float:right">
    <strong>
      <?php echo link_to_remote('tutti i temi inseriti', 
                                array(
                                  'update' => 'items_container',
                                  'url'    => "@themes?area=x&sort=insert&page=1",
                                  'loading'  => "Element.show('indicator')",
                                  'complete' => "Element.hide('indicator')" )) ?>  
    </strong>
  </div>
<?php else: ?>
  <div style="float:right">
      <?php echo link_to_remote('tutti i temi', 
                                array(
                                  'update' => 'items_container',
                                  'url'    => "@themes?area=x&sort=insert&page=1",
                                  'loading'  => "Element.show('indicator')",
                                  'complete' => "Element.hide('indicator')" )) ?>  
    |
    <?php echo link_to_remote('altri ' . sfConfig::get('app_pagination_themes_limit') . ' a caso', 
                              array(
                                'update' => 'items_container',
                                'url'    => "@themes?area=x&sort=random",
                                'loading'  => "Element.show('indicator')",
                                'complete' => "Element.hide('indicator')" )) ?>  
    |&nbsp;
  </div>
<?php endif; ?>

<?php if($pager->getNbResults()): ?>

  <!-- lista temi  -->
  <div class="listatemi">
    <ul>
      <?php foreach($pager->getResults() as $theme): ?>
        <!-- singolo tema  -->
  	    <li class="clearfix" style="clear:both">
	      
  	      <!-- meccanismo per il voto -->
          <div class="vote-container" id="vote_<?php echo $theme->getContentId()?>">
            <?php echo include_partial('opinableContent/voteContent', 
                                       array('content' => $theme, 
                                             'label' => 'priorit&agrave;',
                                             'mode' => 'show')) ?>
          </div>

          <div class="content">
            <!-- titolo -->
            <h4>
               <?php echo link_to($theme->getTitle(), 
    			                        '@tema?theme_id='.$theme->getContentId(),
    									            array('lang'=>'it', 'xml:lang'=>'it', 'hreflang'=>'it', 'title'=>'')) ?> 
            </h4>
        
            <!-- area tematica -->
            <?php if ($theme->getTags()): ?>
              <div id="tags_container_<?php echo $theme->getContentId() ?>">
                area: <span class="area"><?php echo $theme->getAreaTematica() ?></span>
              </div>
            <?php endif; ?>
        
            <!-- meta -->
            <div>
              inserito il 
      		    <span class="date"><?php echo format_date($theme->getOpOpenContent()->getOpContent()->getCreatedAt(), 'dd MMMM yyyy') ?></span> da 
      		    <?php echo link_to($theme->getOpOpenContent()->getOpUser()->__toString(), '@user_profile?hash='.$theme->getOpOpenContent()->getOpUser()->getHash()); ?>
    		    </div>
		    
		        <div>
            	  <?php echo format_number_choice('[0] nessuna posizione|[1] 1 posizione|(1,+Inf] %1% posizioni', 
            	                                  array('%1%' => $theme->getPositionsNumber()), $theme->getPositionsNumber()) ?>,     
            	  <?php echo format_number_choice('[0] nessun commento|[1] 1 commento|(1,+Inf] %1% commenti', 
            	                                  array('%1%' => $theme->getOpOpinableContent()->getCommentsNumber()),
            	                                        $theme->getOpOpinableContent()->getCommentsNumber()) ?>    
		        </div>
            <div class="interaction">
              <span class="abuse">
                <?php echo include_partial('themes/report_edit_obscure', 
                                           array('user' => $sf_user, 'theme' => $theme)); ?>
              </span> 
            </div>

          </div>

        </li>

  	  <!-- fine singolo tema  -->
      <?php endforeach; ?>
    </ul>

  </div>

<?php else: ?>

  <div style="margin-left: 30px">
    Non &egrave; stato trovato nessun tema per l'area selezionata.
  </div>

<?php endif; ?>

<!-- blocco navigatore (numero risultati e paginazione) -->
  <?php if ($sort != 'random'): ?>
    <?php echo include_partial('default/page_navigator', 
                               array( 'pager' => $pager,
                                      'other_params' => "area=$area&sort=$sort",
                                      'limit' => sfConfig::get('app_pagination_themes_limit'),
                                      'container' => 'items_container',
                                      'indicator' => 'indicator',
                                      'other_function' => '',
                                      'items_name' => 'Temi',
                                      'single_item_found' => 'Trovato un solo tema',
                                      'action' => '@themes')) ?>
  <?php else: ?>
    <div style="float:right">
      <?php echo link_to_remote('altri ' . sfConfig::get('app_pagination_themes_limit') . ' temi a caso', 
                                array(
                                  'update' => 'items_container',
                                  'url'    => "@themes?area=x&sort=random",
                                  'loading'  => "Element.show('indicator')",
                                  'complete' => "Element.hide('indicator')" )) ?>  

    </div>
  <?php endif; ?>


<!-- separatore --> 
<div style="clear:both; height: 10px"></div>

