<?php echo use_helper('Date') ?>

<ul class="dx-dichiara">
  <?php foreach($declarations as $declaration): ?>
    <li>
      <?php echo link_to('&raquo;&nbsp;'.$declaration->getTitle(), '@dichiarazione_new?'.$declaration->getSlugUrl() ) ?><br />
      <?php echo ucwords(strtolower($declaration->getOpPolitician()->getFirstName())).'&nbsp;<span class=\"surname\">'.$declaration->getOpPolitician()->getLastName().'</span>' ?>
      (<?php echo format_date($declaration->getDate(), 'dd MMMM yyyy') ?>)<br />
    </li>
  <?php endforeach; ?>
</ul>