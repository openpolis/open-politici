<?php if(count($charges) > 0): ?>
  <table cellspacing="0" class="sf_admin_list">
    <tr>
      <th>ID</th>
      <th>Istituzione</th>
      <th>Tipo di incarico</th>
      <th>Descrizione</th>
      <th>Localit&agrave;</th>
      <th>Inizio</th>
      <th>Fine</th>
      <th>Verifica MinInt</th>
    </tr>
    <?php foreach ($charges as $charge): ?>
      <tr>
        <td><?php include_partial('institution_charge/id', array('type' => 'list', 'op_institution_charge' => $charge)) ?></td>
        <td><?php include_partial('institution_charge/institution', array('type' => 'list', 'op_institution_charge' => $charge)) ?></td>
        <td><?php include_partial('institution_charge/charge_type', array('type' => 'list', 'op_institution_charge' => $charge)) ?></td>
        <td><?php echo $charge->getDescription() ?></td>
        <td><?php include_partial('institution_charge/location', array('type' => 'list', 'op_institution_charge' => $charge)) ?></td>
        <td><?php echo ($charge->getDateStart() !== null && $charge->getDateStart() !== '') ? format_date($charge->getDateStart(), "dd/MM/yyyy") : '' ?></td>
        <td><?php echo ($charge->getDateEnd() !== null && $charge->getDateEnd() !== '') ? format_date($charge->getDateEnd(), "dd/MM/yyyy") : '' ?></td>
        <td><?php echo ($charge->getMinintVerifiedAt() !== null && $charge->getMinintVerifiedAt() !== '') ? format_date($charge->getMinintVerifiedAt(), "f") : '' ?></td>
      </tr>    
    <?php endforeach; ?>
  </table>
<?php else: ?>
  Nessun incarico
<?php endif; ?>
