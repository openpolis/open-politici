<h2>Andamento del numero di dichiarazioni inserite dalla redazione <?php echo $tema ?></h2>

<table style="margin-top: 1em">
<?php foreach ($num_dichiarazioni as $data => $numero): ?>
  <tr>
    <th scope="col"><?php echo date('d/m/Y', strtotime($data)) ?></th>
    <td width="300">
      <?php // echo str_repeat(':', $numero) ?>
      <div style="width:<?php echo 2*$numero?>%; background-color: #43ca34">&nbsp;</div>
    </td>
    <td><?php echo $numero?></td>
  </tr>
<?php endforeach ?>
</table>

<?php slot('subnav') ?>
  <?php include_component('declarationReports', 'subnav', array('current_page' => 'trend', 'current_tag_ids' => $tag_ids)) ?>
<?php end_slot() ?>
