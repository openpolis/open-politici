<h2>Le dichiarazioni inserite dalla redazione, <?php echo $tema ?>, raggruppate per data</h2>

<?php foreach ($grouped_dichiarazioni as $data => $dichiarazioni): ?>
  <div style="font-weight: bold; margin-top: 1em">
    <?php echo date('d/m/Y', strtotime('U', $data)) ?>
  </div>
  
  <ul style="list-style-type: none">
  <?php foreach ($dichiarazioni as $dichiarazione): ?>
    <li>
      <?php echo $dichiarazione->getOpPolitician() ?>: 
      <?php echo link_to($dichiarazione->getTitle(), '@dichiarazione_new?'.$dichiarazione->getSlugUrl()) ?>
      [<?php echo implode(",", $dichiarazione->getTagsAsArrayOfStrings()) ?>]
    </li>
  <?php endforeach ?>
  </ul>
<?php endforeach ?>    

<?php slot('subnav') ?>
  <?php include_component('declarationReports', 'subnav', array('current_page' => 'dichiarazioni', 'current_tag_ids' => $tag_ids)) ?>
<?php end_slot() ?>
