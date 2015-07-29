

<div class="genericblock">
  <div id="title">
    <em></em>
    <h1>Da quanti anni sono in carica i parlamentari?</h1>
  </div>
  
  <div style="font-size:14px;">
  Non manca in Italia occasione in cui non si discuta, a torto o a ragione, della necessit&agrave; del ricambio della classe politica.<br/>
  Per quanto riguarda i deputati e senatori, non quelli "a vita", attualmente in carica abbiamo calcolato per tutti da quanto tempo ricoprono incarichi parlamentari, ovvero per quanti anni e giorni sono stati seduti sugli scranni di Montecitorio e Palazzo Madama. Il calcolo viene aggiornato quotidianamente.<br/>
  Oltre al riepilogo complessivo, pubblichiamo la lista dei parlamentari in ordine decrescente, dal "pi&ugrave; esperto" alla "matricola". Come al solito openpolis fornisce i dati, a voi analizzarli e trarne le vostre conclusioni.<br/>
  </div>  
  <br/>
  <div class="header">
     <h2>Il quadro complessivo: la ripartizione dei parlamentari per fascia di durata degli incarichi</h2>
  </div>
  <div align=center style="padding-bottom:10px;">
  <img src="https://chart.googleapis.com/chart?cht=p3&chd=s:Uf9a&chs=500x160&chdl=con oltre 20 anni di incarichi: <?php echo $stat[4].' ('.round($stat[4]*100/array_sum($stat),2)?>%)|da 15 a 20 anni di incarichi: <?php echo $stat[3].' ('.round($stat[3]*100/array_sum($stat),2)?>%)|da 10 a 15 anni di incarichi: <?php echo $stat[2].' ('.round($stat[2]*100/array_sum($stat),2)?>%)|da 5 a 10 anni di incarichi: <?php echo $stat[1].' ('.round($stat[1]*100/array_sum($stat),2)?>%)|con+meno di 5 anni di incarichi: <?php echo $stat[0].' ('.round($stat[0]*100/array_sum($stat),2)?>%)&chd=t:<?php echo "$stat[4],$stat[3],$stat[2],$stat[1],$stat[0]" ?>&chco=FF0000,FFFF10">
   </div>
   <div class="header">
     <h2>La lista dei parlamentari: dal "pi&ugrave; esperto" alla "matricola"</h2>
  </div>   
<table> 
<tbody>
 <tr class="label">
    <td>Parlamentare:</td>
    <td>E' stato deputato o senatore per:</td>
    <td>Attualmente appartiene al gruppo:</td>
  </tr>
  <?php foreach ($classifica as $k=>$c) :?>
    <tr>
      <?php //echo $c[1]?>
      <td><?php echo (OpInstitutionChargePeer::retrieveByPk($c[1])->getChargeTypeId()==5?'On. ':'Sen. '). link_to(OpPoliticianPeer::retrieveByPk($k), "/politico/".$k) ?></td>
      <td><?php echo $c[0] ?></td>
      <td><?php echo OpInstitutionChargePeer::retrieveByPk($c[1])->getOpGroup()->getName() ?></td>  
    </tr>  
  <?php endforeach ?>      
</tbody>
</table>  

</div>