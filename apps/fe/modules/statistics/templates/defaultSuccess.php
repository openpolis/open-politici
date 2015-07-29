<?php
/*****************************************************************************
 *    Questo file e' parte del progetto openpolis.
 * 
 *    openpolis - la politica trasparente
 *    copyright (C) 2008
 *    Ass. Democrazia Elettronica e Partecipazione Pubblica, 
 *    Via Luigi Montuori 5, 00154 - Roma, Italia
 *
 *    openpolis e' free software; e' possibile redistribuirlo o modificarlo
 *    nei termini della General Public License GNU, versione 2 o successive;
 *    secondo quanto pubblicato dalla Free Software Foundation.
 *
 *    openpolis e' distribuito nella speranza che risulti utile, 
 *    ma SENZA ALCUNA GARANZIA.
 *    
 *    Potete trovare la licenza GPL e altre informazioni su licenze e 
 *    copyright, nella cartella "licenze" del package.
 *
 *    $HeadURL$
 *    $LastChangedDate$
 *    $LastChangedBy$
 *    $LastChangedRevision$
 *
 ****************************************************************************/
?>

<?php set_time_limit(0) ?>
<div id="title">
<em></em>
<h1>Tutti i numeri</h1>
</div>

<!-- #################### FINE TITOLO ####################  -->

<hr />
<!-- #################### INIZO REGIONI ####################  -->
<div class="genericblock">
  
 
  <div class="header"><h2>Suddivisione politici locali in carica (regione, prov. e comune) per grado di istruzione</h2></div>
  <table>
    <tr>
      <th></th>
      <th>elementare</th>
      <th>media inferiore</th>
      <th>media superiore</th>
      <th>laurea breve</th>
      <th>laurea</th>

    </tr>
    <tr>
      <tbody>
        <td>Nord</td>
        <td><?php include_component('statistics', 'edu', array( 'edu' => '3',
                                                               'zona' => '1')) ?></td>                                                
        <td><?php include_component('statistics', 'edu', array( 'edu' => '4', 
                                                               'zona' => '1')) ?></td>
        <td><?php include_component('statistics', 'edu', array( 'edu' => '5', 
                                                               'zona' => '1')) ?></td>                                                
        <td><?php include_component('statistics', 'edu', array( 'edu' => '6', 
                                                               'zona' => '1')) ?></td>
        <td><?php include_component('statistics', 'edu', array( 'edu' => '7', 
                                                               'zona' => '1')) ?></td>                                                                                                                                                                                                         
      </tbody>
    </tr>
    <tr>
      <tbody>
        <td>Centro</td>
        <td><?php include_component('statistics', 'edu', array( 'edu' => '3',
                                                               'zona' => '2')) ?></td>                                                
        <td><?php include_component('statistics', 'edu', array( 'edu' => '4', 
                                                               'zona' => '2')) ?></td>
        <td><?php include_component('statistics', 'edu', array( 'edu' => '5', 
                                                               'zona' => '2')) ?></td>                                                
        <td><?php include_component('statistics', 'edu', array( 'edu' => '6', 
                                                               'zona' => '2')) ?></td>
        <td><?php include_component('statistics', 'edu', array( 'edu' => '7', 
                                                               'zona' => '2')) ?></td>                                                                                                                                                                                                         
      </tbody>
    </tr>
    <tr>
      <tbody>
        <td>Sud</td>
        <td><?php include_component('statistics', 'edu', array( 'edu' => '3',
                                                               'zona' => '3')) ?></td>                                                
        <td><?php include_component('statistics', 'edu', array( 'edu' => '4', 
                                                               'zona' => '3')) ?></td>
        <td><?php include_component('statistics', 'edu', array( 'edu' => '5', 
                                                               'zona' => '3')) ?></td>                                                
        <td><?php include_component('statistics', 'edu', array( 'edu' => '6', 
                                                               'zona' => '3')) ?></td>
        <td><?php include_component('statistics', 'edu', array( 'edu' => '7', 
                                                                'zona' => '3')) ?></td>                                                                                                                                                                                                         
      </tbody>
    </tr>

    <tr>
      <tbody>
        <td>Totale</td>
        <td><?php include_component('statistics', 'edu', array( 'edu' => '3',
                                                               'zona' => '4')) ?></td>                                                
        <td><?php include_component('statistics', 'edu', array( 'edu' => '4', 
                                                               'zona' => '4')) ?></td>
        <td><?php include_component('statistics', 'edu', array( 'edu' => '5', 
                                                               'zona' => '4')) ?></td>                                                
        <td><?php include_component('statistics', 'edu', array( 'edu' => '6', 
                                                               'zona' => '4')) ?></td>
        <td><?php include_component('statistics', 'edu', array( 'edu' => '7', 
                                                               'zona' => '4')) ?></td>                                                                                                                                                                                                         
      </tbody>                                                                                       
      </tbody>
    </tr>
  </table>
  <br />
  
  <div class="header"><h2>Suddivisione politici locali in carica (regione, prov. e comune) per professione</h2></div>
  <table>
    <tr>
      <th></th>
      <th>nord</th>
      <th>centro</th>
      <th>sud</th>
      <th>totale</th>

    </tr>

    <?php foreach ($profs as $prof) : ?>
    <tr>
      <tbody>
        <td><?php echo $prof->getOdescription() ?></td>
        <td><?php include_component('statistics', 'work', array( 'work' => $prof->getId(),
                                                               'zona' => '1')) ?></td>                                                
        <td><?php include_component('statistics', 'work', array( 'work' => $prof->getId(),
                                                               'zona' => '2')) ?></td>
        <td><?php include_component('statistics', 'work', array( 'work' => $prof->getId(),
                                                               'zona' => '3')) ?></td>                                                
        <td><?php include_component('statistics', 'work', array( 'work' => $prof->getId(),
                                                               'zona' => '4')) ?></td>
                                                                                                                                                                                                       
      </tbody>
    </tr>
    <?php endforeach; ?>
  </table>
  <br />
  
  
   <div class="header"><h2>Suddivisione politici locali in carica (regione, prov. e comune) per sesso a area geografica</h2></div>
   <table>
     <tr>
       <th></th>
       <th>Uomini</th>
       <th>Donne</th>
       
     </tr>
     <tr>
       <tbody>
         <td>Nord</td>
         <td><?php include_component('statistics', 'sex', array( 'sex' => 'M',
                                                  'zona' => '1')) ?></td>
         <td><?php include_component('statistics', 'sex', array( 'sex' => 'F',
                                                               'zona' => '1')) ?></td>                                                                                       
       </tbody>
     </tr>
     <tr>
       <tbody>
         <td>Centro</td>
         <td><?php include_component('statistics', 'sex', array( 'sex' => 'M',
                                                'zona' => '2')) ?></td>
         <td><?php include_component('statistics', 'sex', array( 'sex' => 'F',
                                               'zona' => '2')) ?></td>                                                                                            
       </tbody>
     </tr>
     <tr>
       <tbody>
         <td>Sud</td>
         <td><?php include_component('statistics', 'sex', array( 'sex' => 'M',
                                                'zona' => '3')) ?></td>
         <td><?php include_component('statistics', 'sex', array( 'sex' => 'F',
                                                   'zona' => '3')) ?></td>                                                                                            
       </tbody>
     </tr>
     <tr>
       <tbody>
         <td>Totale</td>
         <td><?php include_component('statistics', 'sex', array( 'sex' => 'M',
                                                 'zona' => '4')) ?></td>
         <td><?php include_component('statistics', 'sex', array( 'sex' => 'F',
                                                   'zona' => '4')) ?></td>                                                                                            
       </tbody>
     </tr>
   </table>  
   <br />
   <div class="header"><h2>Suddivisione politici locali in carica (regione, prov. e comune) per et&agrave; a area geografica</h2></div>
   <table>
     <tr>
       <th></th>
       <th>meno di 30 anni</th>
       <th>da 30 a 40 anni</th>
       <th>da 41 a 50 anni</th>
       <th>da 51 a 65 anni</th>
       <th>oltre 65 anni</th>
       
     </tr>
     <tr>
       <tbody>
         <td>Nord</td>
         <td><?php include_component('statistics', 'age', array( 'age1' => '29', 'age2' => '0',
                                                   'zona' => '1')) ?></td>                                                
         <td><?php include_component('statistics', 'age', array( 'age1' => '40', 'age2' => '30',
                                                       'zona' => '1')) ?></td>
         <td><?php include_component('statistics', 'age', array( 'age1' => '50', 'age2' => '41',
                                                         'zona' => '1')) ?></td>                                                
         <td><?php include_component('statistics', 'age', array( 'age1' => '65', 'age2' => '51',
                                                              'zona' => '1')) ?></td>
         <td><?php include_component('statistics', 'age', array( 'age1' => '100', 'age2' => '66',
                                                               'zona' => '1')) ?></td>                                                                                                                                                                                                         
       </tbody>
     </tr>
     <tr>
       <tbody>
         <td>Centro</td>
         <td><?php include_component('statistics', 'age', array( 'age1' => '29', 'age2' => '0',
                                                                'zona' => '2')) ?></td>                                                
         <td><?php include_component('statistics', 'age', array( 'age1' => '40', 'age2' => '30',
                                                                'zona' => '2')) ?></td>
         <td><?php include_component('statistics', 'age', array( 'age1' => '50', 'age2' => '41',
                                                                'zona' => '2')) ?></td>                                                
         <td><?php include_component('statistics', 'age', array( 'age1' => '65', 'age2' => '51',
                                                                'zona' => '2')) ?></td>
         <td><?php include_component('statistics', 'age', array( 'age1' => '100', 'age2' => '66',
                                                                'zona' => '2')) ?></td>                                                                                                                                                                                                         
       </tbody>
     </tr>
     <tr>
       <tbody>
         <td>Sud</td>
         <td><?php include_component('statistics', 'age', array( 'age1' => '29', 'age2' => '0',
                                                                'zona' => '3')) ?></td>                                                
         <td><?php include_component('statistics', 'age', array( 'age1' => '40', 'age2' => '30',
                                                                'zona' => '3')) ?></td>
         <td><?php include_component('statistics', 'age', array( 'age1' => '50', 'age2' => '41',
                                                                'zona' => '3')) ?></td>                                                
         <td><?php include_component('statistics', 'age', array( 'age1' => '65', 'age2' => '51',
                                                                'zona' => '3')) ?></td>
         <td><?php include_component('statistics', 'age', array( 'age1' => '100', 'age2' => '66',
                                                                'zona' => '3')) ?></td>                                                                                                                                                                                                         
       </tbody>
     </tr>
     
     <tr>
       <tbody>
         <td>Totale</td>
         <td><?php include_component('statistics', 'age', array( 'age1' => '29', 'age2' => '0',
                                                                'zona' => '4')) ?></td>                                                
         <td><?php include_component('statistics', 'age', array( 'age1' => '40', 'age2' => '30',
                                                                'zona' => '4')) ?></td>
         <td><?php include_component('statistics', 'age', array( 'age1' => '50', 'age2' => '41',
                                                                'zona' => '4')) ?></td>                                                
         <td><?php include_component('statistics', 'age', array( 'age1' => '65', 'age2' => '51',
                                                                'zona' => '4')) ?></td>
         <td><?php include_component('statistics', 'age', array( 'age1' => '100', 'age2' => '66',
                                                                'zona' => '4')) ?></td>                                                                                                                                                                                                         
       </tbody>                                                                                       
       </tbody>
     </tr>
   </table>
   <br />
   
   
   <?php //include_component('statistics', 'ageSinglePolitician', array( 'institution_id' => '10', 
                                                                           //'charge_type_id' => '14',
                                                                           //'order' => '0',
                                                                           //'limit' => '5')) ?>
    <br />
   <?php //include_component('statistics', 'ageSinglePolitician', array( 'institution_id' => '10', 
                                                                       //'charge_type_id' => '14',
                                                                       //'order' => '1',
                                                                       //'limit' => '5')) ?>
  -->
                                                                        
                           

</div>
<br /> 