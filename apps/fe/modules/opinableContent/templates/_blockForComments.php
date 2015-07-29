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

<div class="header">
  <span class="rights-elements">
    Esporta
    <?php echo link_to(image_tag('symbols/rss.png', 
                  array('alt'=>'Esporta RSS', 'width'=>'23', 'height'=>'12', 'border'=>'0')),
                  'feed/lastCommentsForOpinableContent?content_id='.$content_id, 
                  array('title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
    <?php echo link_to(image_tag('buttons/close.png', 
                                 array('id' => 'commenti_toggle_img', 
                                       'alt'=>'Chiudi blocco', 'width'=>'15', 'height'=>'14', 'border'=>'0')), 
                                 '#', 
                                 array('onClick' => 'return toggleComments();', 
                                       'title'=>'', 'hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it')) ?>
  </span>
  <h2>Commenti (<?php echo format_number_choice('[0] 0|[1] 1 |(1,+Inf] %1%', 
                                                array('%1%' => count($comments)), count($comments)) ?>)</h2>
</div>

<div id="commenti">
  <div class="sottomenu">
    <span class="add"><a class="orange" lang="it" xml:lang="it" hreflang="it" title="" href="#commento">&raquo; Aggiungi commento</a></span>
    <?php if ($sort=='date'): ?>
      <div>Ordina per data</div>
  	  <div>
  	    <?php echo link_to_remote('Ordina per rilevanza', 
  	                               array('update' => 'for_ajax',
                                         'url' => 'opinableContent/blockForComments?content_id='.$content_id.'&sort=relevancy')) ?>		
  	  </div>
    <?php else: ?>	  
      <div>
        <?php echo link_to_remote('Ordina per data', 
  	                                 array('update' => 'for_ajax',
                                           'url' => 'opinableContent/blockForComments?content_id='.$content_id.'&sort=date')) ?>   	
      </div>
      <div>Ordina per rilevanza</div>
    <?php endif; ?>	
  </div>

  <div class="dichiarazione">
    <ul>
      <?php foreach ($comments as $comment): ?>
        <li>
          <?php include_partial('opinableContent/comment', 
                                array('comment' => $comment, 'sort' => $sort)) ?>
        </li>
      <?php endforeach ?>
    </ul>
    <br />
    <a name="commento"></a>
    <?php if ($sf_user->hasCredential('subscriber')): ?>
      <?php echo form_remote_tag(array('update'   => 'for_ajax',
                                       'url'      => '/opinableContent/addComment'
                                   )) ?>
      
        <strong>Scrivi il tuo commento</strong>
        <br />
        <?php echo textarea_tag('body','','rows=5') ?>
        <br />
  	  <?php echo input_hidden_tag('sort', $sort) ?>
        <?php echo input_hidden_tag('content_id', $content_id) ?>   							
        <?php echo submit_tag('Invia', array('id'=>'Submit', 'class'=>'commenta')) ?>
      </form>
    <?php else: ?>
      <strong>Per scrivere il tuo commento devi essere <?php echo link_to('loggato', '@sf_guard_signin'); ?></strong>		
    <?php endif; ?>		
    <br />
  </div>
</div>

<script type="text/javascript">
//<![CDATA[
function toggleComments()
{
  div = 'commenti';	
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
}
//]]>
</script>