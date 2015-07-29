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
  I deputati e i senatori, dopo 5 anni di effettivo mandato parlamentare, ricevono la pensione (assegno vitalizio) a partire dal 65mo anno di età.<br/>
  La normativa è stata modificata nel 2007 attraverso una deliberazione congiunta del Consiglio di Presidenza del Senato della Repubblica e dell'Ufficio di Presidenza della Camera dei Deputati.
  Prima, erano necessari solo 2 anni e mezzo di mandato. Per approfondimenti: <a href="http://www.camera.it/383?deputatotesto=4&conoscerelacamera=4">trattamento economico dei deputati</a>, <a href="http://www.senato.it/composizione/21593/132051/genpagina.htm">trattamenti economico dei senatori</a>. 
  </div>  
  <br/>
  <div class="header">
    <h2>Deputati prossimi alla pensione</h2>
 </div>
 <br/>
 
 <div style="float:left; width:42%">
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
  <div style="float:right; width:55%">
     <?php
    $url_gchart="http://chart.apis.google.com/chart?cht=bvs&chs=380x200&chd=t:".trim($valori,',')."|".trim($all,',')."&chco=4d89f9,c6d9fd&chbh=20&chxt=x&chxl=".trim($label,'|')."&chm=N,000000,0,-1,11&chbh=40,10,10&chds=0,350,0,350";
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

  <div style="float:left; width:42%">
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
   <div style="float:right; width:55%">
       <?php
      $url_gchart="http://chart.apis.google.com/chart?cht=bvs&chs=380x200&chd=t:".trim($valori,',')."|".trim($all,',')."&chco=4d89f9,c6d9fd&chbh=20&chxt=x&chxl=".trim($label,'|')."&chm=N,000000,0,-1,11&chbh=40,10,10&chds=0,200,0,200";
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