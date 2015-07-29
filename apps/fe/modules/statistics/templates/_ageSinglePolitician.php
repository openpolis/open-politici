<div class="header"><h2>I Sindaci pi&ugrave; <?php echo ($order==0 ?'anziani':'giovani') ?></h2></div>  
<table>
  <tr>
    <th>Nome e Cognome</th>
    <th>Comune</th>
    <th>Et&agrave;</th>
    
  </tr>
   <?php foreach ($incarichi as $incarico ): ?>
  <tr>
    <tbody>
     
      <td><?php echo link_to($incarico->getOpPolitician()->getFirstName()." ".$incarico->getOpPolitician()->getLastName(),'/politico/'.$incarico->getOpPolitician()->getContentId()) ?></td>
      <td><?php echo link_to($incarico->getOpLocation()->getName()." (".$incarico->getOpLocation()->getProv().")",'/comune/'.$incarico->getOpLocation()->getId()) ?></td>
      <td><?php echo $incarico->getOpPolitician()->getBirthDate() ?></td>  
                                                                                                                                                                                                                                                      
    </tbody>
  </tr>
   <?php endforeach ?>     
</table>


