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
<?php use_helper('OpinableContent') ?>

<span class="arguments">


  <?php if($mode == 'read'): ?>
    <?php if ($content->getTags()): ?>
      Argomenti: <?php echo tags_for_content($content, 0) ?>
    <?php endif; ?>
  <?php else: ?>

  <?php if ($mode != 'add'): ?>
    <?php if ($content->getTags()): ?>
      Argomenti: <?php echo tags_for_content($content, 0) ?> | 
    <?php endif; ?>
    <?php echo link_to('aggiungi argomento', '#', 
                       array('class'=>'orange', 'onclick' => 'return toggleTagDiv(\''.$content->getContentId().'\')')); ?>
    <?php if($content->getTags()): ?>
      | <?php echo link_to('rimuovi argomento', '#', 
                           array('class'=>'orange', 'onclick' => 'return toggleDelTagDiv(\''.$content->getContentId().'\')')); ?>
    <?php endif; ?>
  <?php endif; ?>	

  <div id="tags_for_<?php echo $content->getContentId()?>" style="display:<?php echo $mode=='add'?'block':'none' ?>">
    <?php echo form_remote_tag(array('update' => 'tags_container_'.$content->getContentId(),
  		                               'url' => 'opinableContent/addTag',
  		                               'script' => true)) ?>
      <?php echo include_partial('autocompleter/tagsAutocompleter', 
                                 array('script' => 'true', 
                                       'content_id'=>$content->getContentId())); ?> 
      <?php echo input_hidden_tag('content_id', $content->getContentId()); ?>
      <?php if ($mode != 'add'): ?>
        <?php echo submit_tag('ok'); ?>
      <?php endif ?>	
    </form>				
  </div>

  <?php if ($mode != 'add'): ?>
    <div id="del_tags_for_<?php echo $content->getContentId()?>" style="display:none">
      <?php echo form_remote_tag(array('update' => 'tags_container_'.$content->getContentId(),
        			                         'url' => 'opinableContent/delTags',
        			                         'script' => true)) ?>
        seleziona gli argomenti da rimuovere:
        <?php if($content->getTags()): ?>
          <?php echo delete_tags_for_content($content, 0) ?>
        <?php endif; ?>
        <?php echo input_hidden_tag('content_id', $content->getContentId()); ?>
        <?php echo submit_tag('rimuovi'); ?>
  	</form>					
    </div>
  <?php endif; ?>

<?php endif; ?>

</span>