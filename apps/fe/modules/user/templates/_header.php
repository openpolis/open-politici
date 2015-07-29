<div class="header">
  <ul>
    <?php if ($current == 'attivita'): ?>
      <li><?php echo __('Attivit&agrave;') ?></li>
    <?php else: ?>
      <li><?php echo link_to_remote(__('Attivit&agrave;'), 
                                    array( 'update' => 'decl_comm', 
                                           'url' => "/user/attivita?hash=$hash",
                                           'loading'  => "Element.show('decl_comm_indicator')",
                                           'complete' => "Element.hide('decl_comm_indicator')"
                                           )); ?></li>
    <?php endif ?>
    |
    <?php if ($current == 'adozioni'): ?>
      <li><?php echo __('Adozioni') ?></li>
    <?php else: ?>
      <li><?php echo link_to_remote(__('Adozioni'), 
                                    array( 'update' => 'decl_comm', 
                                           'url' => "/user/adoptions?hash=$hash",
                                           'loading'  => "Element.show('decl_comm_indicator')",
                                           'complete' => "Element.hide('decl_comm_indicator')"
                                           )); ?></li>
    <?php endif ?>
    |
    <?php if ($current == 'dichiarazioni'): ?>
      <li><?php echo __('Dichiarazioni') ?></li>
    <?php else: ?>
      <li><?php echo link_to_remote(__('Dichiarazioni'), 
                                    array( 'update' => 'decl_comm', 
                                           'url' => "/user/declarations?hash=$hash",
                                           'loading'  => "Element.show('decl_comm_indicator')",
                                           'complete' => "Element.hide('decl_comm_indicator')"
                                           )); ?></li>
    <?php endif ?>
    |
    <?php if ($current == 'commenti'): ?>
      <li><?php echo __('Commenti') ?></li>
      
    <?php else: ?>
      <li><?php echo link_to_remote(__('Commenti'), 
                                    array( 'update' => 'decl_comm', 
                                           'url' => "/user/comments?hash=$hash",
                                           'loading'  => "Element.show('decl_comm_indicator')",
                                           'complete' => "Element.hide('decl_comm_indicator')"
                                           )); ?></li>
    <?php endif ?>
    
    <?php if ($subscriber->getId() == $sf_user->getSubscriberId() || $sf_user->hasCredential('administrator')): ?>
      |
      <?php if ($current == 'incarichi'): ?>
        <li><?php echo __('Incarichi') ?></li>

      <?php else: ?>
        <li><?php echo link_to_remote(__('Incarichi'), 
                                      array( 'update' => 'decl_comm', 
                                             'url' => "/user/charges?hash=$hash",
                                             'loading'  => "Element.show('decl_comm_indicator')",
                                             'complete' => "Element.hide('decl_comm_indicator')"
                                             )); ?></li>
      <?php endif ?>      
      |
      <?php if ($current == 'risorse'): ?>
        <li><?php echo __('Risorse') ?></li>

      <?php else: ?>
        <li><?php echo link_to_remote(__('Risorse'), 
                                      array( 'update' => 'decl_comm', 
                                             'url' => "/user/resources?hash=$hash",
                                             'loading'  => "Element.show('decl_comm_indicator')",
                                             'complete' => "Element.hide('decl_comm_indicator')"
                                             )); ?></li>
      <?php endif ?>      
    <?php endif ?>
    
    <?php if ($subscriber->getIsModerator() &&
              ($subscriber->getId() == $sf_user->getSubscriberId() || $sf_user->hasCredential('administrator'))): ?>
      |
      <?php if ($current == 'oscuramenti'): ?>
        <li><?php echo __('Oscuramenti') ?></li>

      <?php else: ?>
        <li><?php echo link_to_remote(__('Oscuramenti'), 
                                      array( 'update' => 'decl_comm', 
                                             'url' => "/user/removals?hash=$hash",
                                             'loading'  => "Element.show('decl_comm_indicator')",
                                             'complete' => "Element.hide('decl_comm_indicator')"
                                             )); ?></li>
      <?php endif ?>      
    <?php endif ?>

    <?php if ($subscriber->getIsAggiungitor() &&
              ($subscriber->getId() == $sf_user->getSubscriberId() || $sf_user->hasCredential('administrator'))): ?>
      |
      <?php if ($current == 'politici'): ?>
        <li><?php echo __('Nuovi politici') ?></li>

      <?php else: ?>
        <li><?php echo link_to_remote(__('Nuovi politici'), 
                                      array( 'update' => 'decl_comm', 
                                             'url' => "/user/polinsertions?hash=$hash",
                                             'loading'  => "Element.show('decl_comm_indicator')",
                                             'complete' => "Element.hide('decl_comm_indicator')"
                                             )); ?></li>
      <?php endif ?>      
    <?php endif ?>
  </ul>
</div>

  