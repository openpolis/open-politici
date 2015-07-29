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
<?php use_helper('Date', 'Javascript') ?>

<?php if($users_pager->getNbResults()): ?>


  <!-- intestazione numero utenti e visualizzati (pager) -->
  <div style="float:left">
  <?php if ($users_pager->getNbResults() > 1): ?>
    <?php if ($users_pager->getNbResults() > sfConfig::get('app_pagination_users')): ?>
      Utenti <strong><?php echo $users_pager->getFirstIndice() ?></strong> - 
             <strong><?php echo $users_pager->getLastIndice() ?></strong> di
             <strong><?php echo $users_pager->getNbResults() ?></strong>
    <?php else: ?>
      <strong><?php echo $users_pager->getNbResults() ?></strong> utenti
    <?php endif; ?>
  <?php else: ?>
    Trovato un solo utente.
  <?php endif; ?>
  </div>
  <div style="float:right">
    <?php if ($users_pager->haveToPaginate()): ?>
    
      <?php if ($users_pager->getPage() != $users_pager->getFirstPage()): ?>
        <?php echo link_to_remote('precedenti', 
                                 array('update' => 'users_container', 
                                       'url' => "@utenti?location_id=$location_id&region_id=$region_id" .   
                                                "&sort_field=$sort_field&sort_order=$sort_order" . 
                                                "&page=" . $users_pager->getPreviousPage(),
                                       'loading'  => "Element.show('users_indicator')",
                                       'complete' => "Element.hide('users_indicator')"))?>
      <?php endif; ?>

      <?php $links = $users_pager->getLinks(); ?>
      <?php foreach ($links as $page): ?>
        <?php echo ($page == $users_pager->getPage()) ? 
                "<strong>$page</strong>" : 
                link_to_remote($page, 
                               array('update' => 'users_container', 
                                     'url' => "@utenti?location_id=$location_id&region_id=$region_id" . 
                                              "&sort_field=$sort_field&sort_order=$sort_order" . 
                                               "&page=" . $page,
                                     'loading'  => "Element.show('users_indicator')",
                                     'complete' => "Element.hide('users_indicator')")) ?>
        <?php if ($page != $users_pager->getCurrentMaxLink()): ?> - <?php endif ?>
      <?php endforeach ?>

      <?php if ($users_pager->getPage() != $users_pager->getLastPage()): ?>
        <?php echo link_to_remote('successive', 
                                  array('update' => 'users_container', 
                                        'url' => "@utenti?location_id=$location_id&region_id=$region_id" .    
                                                 "&sort_field=$sort_field&sort_order=$sort_order" . 
                                                 "&page=" . $users_pager->getNextPage(),
                                        'loading'  => "Element.show('users_indicator')",
                                        'complete' => "Element.hide('users_indicator')"))?>
      <?php endif; ?>
        
    <?php endif ?>  
  </div>

  <!-- tabella utenti -->
  <table style="clear:both" class="utente">
  
    <!-- intestazione -->
    <tr class="label">
      <td width="4%">&nbsp;</td>
      <td class="label">Nome</td>
      <td class="label">Comune</td>

      <td width="5%" align="center">
        <?php if ($sort_field == 'incarichi' && $sort_order == 'DESC'): ?>
          <?php echo image_tag('buttons/order-down.gif', 
                               array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
        <?php endif; ?>
                               
        <?php if ($sort_field == 'incarichi' && $sort_order == 'ASC'): ?>
       		<?php echo image_tag('buttons/order-up.gif', 
       		                     array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
     		<?php endif; ?>
    		<?php echo link_to_remote('Incarichi', 
    		                          array('update' => 'users_container',
    		                                'url' => "@utenti?location_id=$location_id&region_id=$region_id" . 
    		                                         "&sort_field=incarichi" .
    		                                         "&sort_order=". ($sort_field=='incarichi' && $sort_order=='DESC'?'ASC':'DESC').
    		                                         "&page=1",
                                        'loading'  => "Element.show('users_indicator')",
                                        'complete' => "Element.hide('users_indicator')")) ?>
      </td>

      <td width="5%" align="center">
        <?php if ($sort_field == 'risorse' && $sort_order == 'DESC'): ?>
          <?php echo image_tag('buttons/order-down.gif', 
                               array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
        <?php endif; ?>
                               
        <?php if ($sort_field == 'risorse' && $sort_order == 'ASC'): ?>
       		<?php echo image_tag('buttons/order-up.gif', 
       		                     array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
     		<?php endif; ?>
    		<?php echo link_to_remote('Risorse', 
    		                          array('update' => 'users_container',
    		                                'url' => "@utenti?location_id=$location_id&region_id=$region_id" . 
    		                                         "&sort_field=risorse" .
    		                                         "&sort_order=". ($sort_field=='risorse' && $sort_order=='DESC'?'ASC':'DESC').
    		                                         "&page=1",
                                        'loading'  => "Element.show('users_indicator')",
                                        'complete' => "Element.hide('users_indicator')")) ?>
      </td>


      <td width="5%" align="center">
        <?php if ($sort_field == 'dichiarazioni' && $sort_order == 'DESC'): ?>
          <?php echo image_tag('buttons/order-down.gif', 
                               array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
        <?php endif; ?>
                               
        <?php if ($sort_field == 'dichiarazioni' && $sort_order == 'ASC'): ?>
       		<?php echo image_tag('buttons/order-up.gif', 
       		                     array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
     		<?php endif; ?>
    		<?php echo link_to_remote('Dichiarazioni', 
    		                          array('update' => 'users_container',
    		                                'url' => "@utenti?location_id=$location_id&region_id=$region_id" . 
    		                                         "&sort_field=dichiarazioni" .
    		                                         "&sort_order=". ($sort_field=='dichiarazioni' && $sort_order=='DESC'?'ASC':'DESC').
    		                                         "&page=1",
                                        'loading'  => "Element.show('users_indicator')",
                                        'complete' => "Element.hide('users_indicator')")) ?>
      </td>

      <td width="5%" align="center">
        <?php if ($sort_field == 'temi' && $sort_order == 'DESC'): ?>
          <?php echo image_tag('buttons/order-down.gif', 
                               array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
        <?php endif; ?>
                               
        <?php if ($sort_field == 'temi' && $sort_order == 'ASC'): ?>
       		<?php echo image_tag('buttons/order-up.gif', 
       		                     array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
     		<?php endif; ?>
    		<?php echo link_to_remote('Temi', 
    		                          array('update' => 'users_container',
    		                                'url' => "@utenti?location_id=$location_id&region_id=$region_id" . 
    		                                         "&sort_field=temi" .
    		                                         "&sort_order=". ($sort_field=='temi' && $sort_order=='DESC'?'ASC':'DESC').
    		                                         "&page=1",
                                        'loading'  => "Element.show('users_indicator')",
                                        'complete' => "Element.hide('users_indicator')")) ?>
      </td>

      
      <td width="5%" align="center">
        <?php if ($sort_field == 'commenti' && $sort_order == 'DESC'): ?>
          <?php echo image_tag('buttons/order-down.gif', 
                               array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
        <?php endif; ?>
                             
        <?php if ($sort_field == 'commenti' && $sort_order == 'ASC'): ?>
       		<?php echo image_tag('buttons/order-up.gif', 
       		                     array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
     		<?php endif; ?>
    		<?php echo link_to_remote('Commenti', 
    		                          array('update' => 'users_container',
    		                                'url' => "@utenti?location_id=$location_id&region_id=$region_id" . 
    		                                         "&sort_field=commenti" . 
    		                                         "&sort_order=". ($sort_field=='commenti' && $sort_order=='DESC'?'ASC':'DESC').
    		                                         "&page=1",
                                        'loading'  => "Element.show('users_indicator')",
                                        'complete' => "Element.hide('users_indicator')")) ?>
      </td>
	  <td width="10%" align="center">
      <?php if ($sort_field == 'registrazione' && $sort_order == 'DESC'): ?>
        <?php echo image_tag('buttons/order-down.gif', 
                             array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
      <?php endif; ?>
                           
      <?php if ($sort_field == 'registrazione' && $sort_order == 'ASC'): ?>
     		<?php echo image_tag('buttons/order-up.gif', 
     		                     array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
   		<?php endif; ?>
  		<?php echo link_to_remote('Registrazione', 
  		                          array('update' => 'users_container',
  		                                'url' => "@utenti?location_id=$location_id&region_id=$region_id" . 
  		                                         "&sort_field=registrazione" .
  		                                         "&sort_order=". ($sort_field=='registrazione' && $sort_order=='DESC'?'ASC':'DESC').
  		                                         "&page=1",
                                      'loading'  => "Element.show('users_indicator')",
                                      'complete' => "Element.hide('users_indicator')")) ?>
      </td>
      <td width="11%" align="center" <?php echo !$sf_user->hasCredential('administrator') ? "class=\"last\"" : "" ?>>
        <?php if ($sort_field == 'ultimo_contributo' && $sort_order == 'DESC'): ?>
          <?php echo image_tag('buttons/order-down.gif', 
                               array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
        <?php endif; ?>
                             
        <?php if ($sort_field == 'ultimo_contributo' && $sort_order == 'ASC'): ?>
       		<?php echo image_tag('buttons/order-up.gif', 
       		                     array('alt'=>'', 'width'=>'9', 'height'=>'8')) ?>
     		<?php endif; ?>
    		<?php echo link_to_remote('Ultimo contributo', 
    		                          array('update' => 'users_container',
    		                                'url' => "@utenti?location_id=$location_id&region_id=$region_id" . 
    		                                         "&sort_field=ultimo_contributo" . 
    		                                         "&sort_order=". ($sort_field=='ultimo_contributo' && $sort_order=='DESC'?'ASC':'DESC').
    		                                         "&page=1",
                                        'loading'  => "Element.show('users_indicator')",
                                        'complete' => "Element.hide('users_indicator')")) ?>
      </td>
      <?php if ($sf_user->hasCredential('administrator')) : ?>
        <td class="last" align="center">Ruolo</td>
	    <?php endif; ?>	
   </tr>
   
   
   <!-- loop record utenti -->
   <?php $tr_class = 'dark' ?>
   <?php foreach ($users_pager->getResults() as $user): ?>
     <tr class="<?php echo $tr_class ?>">
       <td class="foto">
         <?php if ($user->getpicture()!== null) : ?>
           <?php $img = "<img src=\"".
                           url_for('@user_picture?hash='. $user->getHash() . "&class=microthumb") .
                           "\" alt=\"" . $user->__toString() . " border=\"0\"/>"; ?>
 	        <?php echo link_to($img, '@user_profile?hash='.$user->getHash()); ?> 	
         <?php else : ?>
 	        <?php echo link_to(image_tag('symbols/foto-example.png', 
 	                                     array('alt'=>'', 'width'=>'25  ', 'height'=>'25', 'border'=>'0')),
 	                           '@user_profile?hash='.$user->getHash()); ?> 	
         <?php endif; ?>
       </td>
       <td class="dark">
        <?php echo link_to($user->__toString(), '@user_profile?hash='.$user->getHash() ) ?>     	
       </td>
       <td class="dark"><?php if($user->getLocationId()) echo $user->getOpLocation()->getName().'&nbsp;('.$user->getOpLocation()->getProv().')' ?></td>
       <td class="center"><?php echo $user->getCharges() ?></td>
       <td class="center"><?php echo $user->getResources() ?></td>
       <td class="center"><?php echo $user->getDeclarations() ?></td>
       <td class="center"><?php echo $user->getThemes() ?></td>
       <td class="center"><?php echo $user->getComments() ?></td>
       <td class="center"><?php echo format_date($user->getCreatedAt(), 'dd.MM.yyyy') ?></td>
       <?php if ($sf_user->hasCredential('administrator')) : ?>
         <td align="center">
          <?php echo $user->getLastContribution() == null?'mai':format_date($user->getLastContribution(), 'dd.MM.yyyy') ?>
         </td>
         <td class="lastcenter"><?php echo $user->getRole() ?></td>       	
       <?php else: ?>
         <td class="lastcenter">
          <?php echo $user->getLastContribution() == null?'mai':format_date($user->getLastContribution(), 'dd.MM.yyyy') ?>
         </td>
       <?php endif; ?>
	 </tr>
	 <?php $tr_class = ($tr_class=='dark' ? 'light' : 'dark') ?>
   <?php endforeach; ?>
  </table>
<?php else: ?>
  <div style="margin:30px;">
    Nessun utente per la zona selezionata.
  </div>
<?php endif; ?>  