<?php echo use_helper(
	/* canonicals links */
	'HeaderLinks');

	if ( sfRouting::getInstance()->getCurrentRouteName() == 'dichiarazioni_patrimoniali' )
		add_link(
			'@dichiarazioni_patrimoniali_new',
			'canonical');
?>

<?php $arr_dep=array() ?>
<?php $arr_sen=array() ?>
<?php foreach ($taxs as $k => $tax): ?>
  <?php
  $politician = OpPoliticianPeer::retrieveByPk($k);
  $c=new Criteria();
  $c->addJoin(OpTaxDeclarationPeer::POLITICIAN_ID,OpPoliticianPeer::CONTENT_ID);
  $c->addJoin(OpPoliticianPeer::CONTENT_ID,OpInstitutionChargePeer::POLITICIAN_ID);
  $c->addJoin(OpOpenContentPeer::CONTENT_ID,OpInstitutionChargePeer::CONTENT_ID);
  $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::ISNULL);
  $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::ISNULL);
  $c->add(OpInstitutionChargePeer::INSTITUTION_ID, array(4,5) , Criteria::IN);
  $c->add(OpInstitutionChargePeer::CHARGE_TYPE_ID, array(5,6) , Criteria::IN);
  $c->add(OpInstitutionChargePeer::POLITICIAN_ID, $politician->getContentId());
  $carica=OpInstitutionChargePeer::doSelectOne($c);
  if ($carica->getChargeTypeId()==5)
    $arr_dep[$politician->getContentId()]=$carica->getOpGroup()->getId();
  else
    $arr_sen[$politician->getContentId()]=$carica->getOpGroup()->getId();
  ?>
<?php endforeach; ?>

<div class="genericblock">
  <div id="title">
    <em></em>
    <h1>Le dichiarazioni patrimoniali dei Parlamentari</h1>
  </div>
  <p style="font-size:14px;">
    <strong>Hanno finora dato il consenso alla pubblicazione della dichiarazione patrimoniale <a href="#deputati"><?php echo count($arr_dep) ?> deputati</a> (<?php echo number_format((count($arr_dep)*100/630),2)."%" ?>) e <a href="#senatori"><?php echo count($arr_sen) ?> senatori</a> (<?php echo number_format((count($arr_sen)*100/315),2)."%" ?>) .</strong>
  </p>
  <div>
    Elenco aggiornato dei parlamentari che hanno dato il consenso alla pubblicazione online della dichiarazione patrimoniale personale (beni mobili e immobili, redditi e spese elettorali).<br/>
    Tutti i senatori e deputati sono tenuti a depositare la dichiarazione patrimoniale e aggiornarla ogni anno, ma la stessa legge che prevede questo obbligo (<a href="http://www.normattiva.it/uri-res/N2Ls?urn:nir:stato:legge:1982;441">la n.441 del 1982</a>) stabilisce anche che queste informazioni siano raccolte in un apposito Bollettino che è consultabile solo presso la Camera o il Senato.<br/>
    Dunque i dati sono "pubblici" ma non pubblicabili online, se non con l'assenso del singolo parlamentare.<br/>
    Grazie all'iniziativa dell'On. Rita Bernardini ora per i parlamentari che lo desiderano è sufficiente compilare un modulo perché gli uffici inseriscano la dichiarazione nella pagina web del parlamentare. Quando questo avviene il nostro elenco si aggiorna automaticamente.<br/>
    Sarebbe utlile se le Regioni e gli enti locali adottassero la stessa procedura ...<br/> 
  </div>
   <a name="deputati"></a>
  <div class="header" style="margin-top:15px;">
    <h2>Camera dei Deputati, <?php echo count($arr_dep) ?> su 630 (<?php echo number_format((count($arr_dep)*100/630),2)."%" ?>)</h2>
  </div>
  <br/>
  <div style="float:left; width:42%">
    <?php $arr_g_dep=array_count_values($arr_dep) ?>
    <table>
      <tbody>
        <tr class="label">
          <td>Gruppo</td>
          <td>Dichiarazioni patrimoniali</td>
        </tr>
        <?php
        $label="0:|";
        $valori="";
        $all="";
        $k=0;
        foreach ($arr_g_dep as $key=>$val)
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
      $url_gchart="http://chart.apis.google.com/chart?cht=bvs&chs=410x200&chd=t:".trim($valori,',')."|".trim($all,',')."&chco=4d89f9,c6d9fd&chbh=20&chxt=x&chxl=".trim($label,'|')."&chm=N,000000,0,-1,11&chbh=40,10,10&chds=0,350,0,350";
    ?>
    <img src="<?php echo $url_gchart ?>">
  </div>

  <table style="padding-top: 15px;">
    <tr class="label">
        <td>Deputato</td>
        <td>Gruppo parlamentare</td>
        <td>Scarica le dichiarazioni patrimoniali</td>
    </tr>
    <tbody>  
      <?php foreach ($arr_dep as $k => $a): ?>
        <tr>
         <td><?php 
				$politician = OpPoliticianPeer::retrieveByPk($k);
				echo link_to("<em class=\"surname\">".$politician->getLastName()."</em>&nbsp;".ucwords(strtolower($politician->getFirstName())),
				'@politico_new?content_id='.$politician->getContentId() .'&slug='. $politician->getSlug()
				);?>
				</td>
        <td>
           <?php echo OpGroupPeer::retrieveByPk($a)->getName()?>
        </td>
        <td>
          <?php $p=0; ?> 
          <?php for ($x=1; $x<count($taxs[$k]); $x++) : ?>
           <?php if ($p%2==0) : ?>
            <?php echo link_to($taxs[$k][$p],'http://politici.openpolis.it/tax/pdf/'.$k.'_'.$taxs[$k][$p].'.pdf') ?>
            <?php echo (count($taxs[$k])!=$p+2 ?' | ':'') ?>
           <?php endif; ?> 
           <?php $p=$p+1 ?>
          <?php endfor; ?> 
         </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <a name="senatori"></a>
  <div class="header" style="margin-top:15px;">
    <h2>Senato della Repubblica, <?php echo count($arr_sen) ?> su 315 (<?php echo number_format((count($arr_sen)*100/315),2)."%" ?>)</h2>
  </div>
  <br/>

  <div style="float:left; width:42%">
    <?php $arr_g_sen=array_count_values($arr_sen) ?>
    <table>
      <tbody>
        <tr class="label">
          <td>Gruppo</td>
          <td>Dichiarazioni patrimoniali</td>
        </tr>
        <?php
       $label="0:|";
       $valori="";
       $all="";
       $k=0;
      foreach ($arr_g_sen as $key=>$val)
      {
        $all_gruppo=count(OpInstitutionChargePeer::fetchOrganMembersByGroup(5,array(6),2,$key));
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
    $url_gchart="http://chart.apis.google.com/chart?cht=bvs&chs=410x200&chd=t:".trim($valori,',')."|".trim($all,',')."&chco=4d89f9,c6d9fd&chbh=20&chxt=x&chxl=".trim($label,'|')."&chm=N,000000,0,-1,11&chbh=40,10,10&chds=0,350,0,350";
     ?>
     <img src="<?php echo $url_gchart ?>">
  </div>

  <table style="padding-top: 15px;">
     <tr class="label">
        <td>Senatore</td>
        <td>Gruppo parlamentare</td>
        <td>Scarica le dichiarazioni patrimoniali</td>
      </tr>
       <tbody>  
     <?php foreach ($arr_sen as $k => $a): ?>
        <tr>
         <td><?php 
				$politician = OpPoliticianPeer::retrieveByPk($k);
				echo link_to("<em class=\"surname\">".$politician->getLastName()."</em>&nbsp;".ucwords(strtolower($politician->getFirstName())),
				'@politico_new?content_id='.$politician->getContentId() .'&slug='. $politician->getSlug()
				);?></td>
         <td>
           <?php echo OpGroupPeer::retrieveByPk($a)->getName()?>
         </td>
         <td>
          <?php $p=0; ?> 
         <?php for ($x=1; $x<count($taxs[$k]); $x++) : ?>
           <?php if ($p%2==0) : ?>
             <?php echo link_to($taxs[$k][$p],'http://politici.openpolis.it/tax/pdf/'.$k.'_'.$taxs[$k][$p].'.pdf') ?>
            <?php echo (count($taxs[$k])!=$p+2 ?' | ':'') ?>
           <?php endif; ?> 
           <?php $p=$p+1 ?>
          <?php endfor; ?> 
         </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>

 <br/> <br/> <br/>
