 <?php if(count($charges) > 0): ?>
   <table cellspacing="0" class="sf_admin_list" style="margin-top: 3px">
     <?php foreach ($charges as $charge): ?>
       <tr>
         <td style="min-width: 54px"><?php include_partial('institution_charge/id', array('type' => 'list', 'op_institution_charge' => $charge)) ?></td>
         <td><?php include_partial('institution_charge/institution', array('type' => 'list', 'op_institution_charge' => $charge)) ?></td>
         <td><?php include_partial('institution_charge/charge_type', array('type' => 'list', 'op_institution_charge' => $charge)) ?></td>
         <td><?php include_partial('institution_charge/location', array('type' => 'list', 'op_institution_charge' => $charge)) ?></td>
         <td style="min-width: 54px"><?php echo ($charge->getDateStart() !== null && $charge->getDateStart() !== '') ? format_date($charge->getDateStart(), "dd/MM/yyyy") : '' ?></td>
         <td style="min-width: 54px"><?php echo ($charge->getDateEnd() !== null && $charge->getDateEnd() !== '') ? format_date($charge->getDateEnd(), "dd/MM/yyyy") : '' ?></td>
       </tr>    
     <?php endforeach; ?>
   </table>
 <?php else: ?>
   Nessun incarico
 <?php endif; ?>

