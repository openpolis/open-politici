<?php echo use_helper(
	/* canonicals links */
	'HeaderLinks');

	if ( sfRouting::getInstance()->getCurrentRouteName() !== 'pensioni_politici' )
		add_link(
			'@pensioni_politici',
			'canonical');
?>
<div class="genericblock">
  <div id="title">
    <em></em>
    <h1>Quanti giorni mancano ai parlamentari per maturare la pensione?</h1>
  </div>
  
  <div style="font-size:16px;">
    Attualmente ci sono <strong><a href="#deputati"><?php echo count($pensioni_c)?> deputati</a></strong> e <strong><a href="#senatori"><?php echo count($pensioni_s)?> senatori</a></strong> in carica che ancora non hanno maturato i giorni necessari per avere diritto alla pensione da parlamentare.
  </div>
  <br/>
  <div style="font-size:12px;">
  I deputati e i senatori, dopo 5 anni mandato parlamentare, ricevono la pensione a partire dal 65mo anno di età. Per ogni anno di mandato oltre il quinto, il requisito anagrafico è diminuito di un anno sino al minimo inderogabile di 60 anni. <a href="https://drive.google.com/file/d/0B4qZk63Fhz9bZlhpaFFqSEdGTUU/view?usp=sharing">È importante specificare</a> che la frazione di anno si computa come anno intero purché corrisponda ad almeno sei mesi ed un giorno. Basterà quindi raggiungere 4 anni, 6 mesi e 1 giorno di mandato per maturare la pensione da parlamentare. Dal 1° gennaio 2012 è stato introdotto il nuovo trattamento previdenziale dei parlamentari, basato sul sistema di calcolo contributivo già adottato per il personale dipendente della pubblica amministrazione. Per approfondimenti: <a href="http://www.camera.it/leg17/383?conoscerelacamera=4">trattamento economico dei deputati</a>, <a href="http://www.senato.it/Leg17/1075?voce_sommario=61">trattamenti economico dei senatori</a>. 
  </div>  
  <br/>
  <div class="header">
    <h2>Deputati prossimi alla pensione</h2>
 </div>
 <br/>
 
 <div>
 <a name="deputati"></a>
 <table>
   <tbody>
     <tr class="label">
        <td>Gruppo</td>
        <td>Ancora non maturano la pensione</td>
      </tr>
      <?php
       $label="0:|";
       $valori="";
       $all="";
       $k=0;
	   arsort($gruppi_c);
      while (list($key, $val) = each($gruppi_c))
      {
        $all_gruppo=count(OpInstitutionChargePeer::fetchOrganMembersByGroup(4,array(5),2,$key));
        echo "<tr>";
        echo "<td>".OpGroupPeer::retrieveByPk($key)->getName()."</td>";
        echo "<td><strong>".$val."</strong> su ".$all_gruppo." (".intval($val*100/$all_gruppo)."%)</td>";
        echo "</tr>";
        $label=$label.OpGroupPeer::retrieveByPk($key)->getAcronym()."|";
        $valori=$valori.$val.",";
        $all=$all.($all_gruppo-$val).",";
        $k++;
      }
      ?> 
      </tbody>
      </table>
  </div>
  <div>
     <?php
    $url_gchart="http://chart.apis.google.com/chart?cht=bvs&chs=780x200&chd=t:".trim($valori,',')."|".trim($all,',')."&chco=4d89f9,c6d9fd&chbh=20&chxt=x&chxl=".trim($label,'|')."&chm=N,000000,0,-1,11&chbh=60,10,10&chds=0,350,0,350";
     ?>
     <img src="<?php echo $url_gchart ?>">


   </div>

     
 <br/>
 <table>
 <tbody>
	 
     <tr class="label">
       <td>Cognome e nome</td>
       <td>Giorni rimanenti per maturare la pensione</td>
       <td>Data maturazione della pensione</td>
       <td>Gruppo</td>
     </tr>
  <?php
  
  asort($pensioni_c);
  
  while (list($key, $val) = each($pensioni_c)) 
  {
  echo "<tr>";
  echo "<td>". link_to(OpInstitutionChargePeer::retrieveByPk($key)->getOpPolitician()->getLastName() ." ".
                       OpInstitutionChargePeer::retrieveByPk($key)->getOpPolitician()->getFirstName(),
                       "/politico/".OpInstitutionChargePeer::retrieveByPk($key)->getOpPolitician()->getContentId(), 
                       array('absolute' => $nolayout)) .
       "</td>";
  echo "<td>".$val."</td>";
  echo "<td>".(date("d-m-Y",$val*86400+strtotime(date("Y-m-d"))))."</td>";
  echo "<td>".OpInstitutionChargePeer::retrieveByPk($key)->getOpGroup()->getName()."</td>";
  echo "<tr/>";
  }
  ?>
  </tbody>
  </table>
  
  <br/><br/><br/>
  <div class="header">
    <h2>Senatori prossimi alla pensione</h2>
 </div>
 <br/>

  <div>
  <a name="senatori"></a>
  <table>
    <tbody>
      <tr class="label">
         <td>Gruppo</td>
         <td>Ancora non maturano la pensione</td>
       </tr>
       <?php
        $label="0:|";
         $valori="";
         $all="";
         $k=0;
		  arsort($gruppi_s);
       while (list($key, $val) = each($gruppi_s))
       {
         $all_gruppo=count(OpInstitutionChargePeer::fetchOrganMembersByGroup(5,array(6,20),2,$key));
         echo "<tr>";
         echo "<td>".OpGroupPeer::retrieveByPk($key)->getName()."</td>";
         echo "<td><strong>".$val."</strong> su ".$all_gruppo." (".intval($val*100/$all_gruppo)."%)</td>";
         echo "</tr>";
         $label=$label.OpGroupPeer::retrieveByPk($key)->getAcronym()."|";
         $valori=$valori.$val.",";
         $all=$all.($all_gruppo-$val).",";
         $k++;
       }
       ?> 
       </tbody>
       </table>
   </div>
   <div>
       <?php
      $url_gchart="http://chart.apis.google.com/chart?cht=bvs&chs=780x200&chd=t:".trim($valori,',')."|".trim($all,',')."&chco=4d89f9,c6d9fd&chbh=20&chxt=x&chxl=".trim($label,'|')."&chm=N,000000,0,-1,11&chbh=70,10,10&chds=0,350,0,350";
       ?>
      <img src="<?php echo $url_gchart ?>">


    </div>

<br/>

   <table>
  <tbody>

       <tr class="label">
         <td>Cognome e nome</td>
         <td>Giorni rimanenti per maturare la pensione</td>
         <td>Data maturazione della pensione</td>
         <td>Gruppo</td>
       </tr>
  <?php

  asort($pensioni_s); 
  while (list($key, $val) = each($pensioni_s)) 
  {
  echo "<tr>";
  echo "<td>".link_to(OpInstitutionChargePeer::retrieveByPk($key)->getOpPolitician()->getLastName()." ".OpInstitutionChargePeer::retrieveByPk($key)->getOpPolitician()->getFirstName(),"/politico/".OpInstitutionChargePeer::retrieveByPk($key)->getOpPolitician()->getContentId())."</td>";
  echo "<td>".$val."</td>";
  echo "<td>".(date("d-m-Y",$val*86400+strtotime(date("Y-m-d"))))."</td>";
  echo "<td>".OpInstitutionChargePeer::retrieveByPk($key)->getOpGroup()->getName()."</td>";
  echo "<tr/>";
  }
  
  ?>
  </tbody>
  </table>

</div>