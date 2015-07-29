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
<?php use_helper('Javascript', 'Date'
/* canonicals links */
, 'HeaderLinks'); 

if ( sfRouting::getInstance()->getCurrentRouteName() == 'localita' )
	add_link('@localita_new?location_id='.$location->getId() .'&slug='. $location->getSlug(), 'canonical');
?>
<div id="title">
  <em>
   <?php if($location->getLastChargeUpdate()): ?>
      Ultimo aggiornamento:&nbsp;<?php echo format_date($location->getLastChargeUpdate(), 'dd/MM/yyyy') ?>
    <?php else: ?>
      
    <?php endif; ?>  	 	
  </em>
  <h1>Ecco chi sono i tuoi <?php echo $n_totale_rappresentanti ?> rappresentanti</h1>
</div>
<hr />

<div class="genericblock">
  
Se sei residente a <strong><?php echo $location->GetName() ?></strong>, questa &egrave; la lista dei <strong><?php echo $n_totale_rappresentanti ?></strong> politici eletti nei collegi elettorali dove voti, che <strong>ti rappresentano</strong> dal Parlamento Europeo al Consiglio Comunale.<br />

Fai click sulle singole istituzioni per visualizzare i tuoi rappresentati.<br /><br />

  <ul>
    <li class="dark">   	
      <span class="exports">
        <?php echo link_to(image_tag('buttons/open.png', 
                                     array('id' => 'european_politicians_toggle_img', 
                                           'alt'=>'Apri/Chiudi blocco', 'width'=>'15', 'height'=>'14')) , '#',
                           array('hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 
                                 'onclick' => 'toggleContainer(\'european_politicians\')')) ?>      	
      </span>
      <strong>
        <?php echo link_to('Parlamento europeo&nbsp;('.$europarlamento['n_rappresentanti'].')' , '#', 
                           array('hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 
                                 'onclick' => 'toggleContainer(\'european_politicians\')')) ?>      	
      </strong>
      <div id="european_politicians" style="display:none">
  	    <?php include_partial('politician/constituencyPoliticians', 
  	                            array('institution_charges'=> $europarlamento['rappresentanti'])) ?>
      </div> 
    </li>

    <li class="light">
      <span class="dark">
        <span class="rights-elements">
          <?php echo link_to(image_tag('buttons/open.png', 
                                       array('id' => 'camera_politicians_toggle_img',
                                             'alt'=>'Apri blocco', 'width'=>'15', 'height'=>'14')) , '#',
                             array('hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 
                                   'onclick' => 'toggleContainer(\'camera_politicians\')')) ?>
		    </span>
      </span>
      <strong>
        <?php echo link_to('Camera&nbsp;('.$camera['n_rappresentanti'].')' , '#', 
                           array('hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 
                                 'onclick' => 'toggleContainer(\'camera_politicians\')')) ?>
      </strong>
      <div id="camera_politicians" style="display:none">
  	    <?php include_partial('politician/constituencyPoliticians', 
  	                          array('institution_charges' => $camera['rappresentanti'])) ?>
      </div> 
    </li>

    <li class="dark">   	
      <span class="rights-elements">
        <?php echo link_to(image_tag('buttons/open.png', 
                                     array('id'=>'senato_politicians_toggle_img', 'alt'=>'Apri blocco', 
                                           'width'=>'15', 'height'=>'14')) , '#', 
                           array('hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 
                                 'onclick' => 'toggleContainer(\'senato_politicians\')')) ?>
      </span>
      <strong><?php echo link_to('Senato&nbsp;('.$senato['n_rappresentanti'].')' , '#', 
                                 array('hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 
                                       'onclick' => 'toggleContainer(\'senato_politicians\')')) ?>
      </strong>
      <div id="senato_politicians" style="display:none">
  	    <?php include_partial('politician/constituencyPoliticians', 
  	                          array('institution_charges' => $senato['rappresentanti'])) ?>
      </div> 
    </li>


    <li class="light">   	
      <span class="dark">
        <?php echo link_to(image_tag('buttons/open.png', 
                                     array('id'=>'regional_politicians_toggle_img', 'alt'=>'Apri blocco', 
                                           'width'=>'15', 'height'=>'14')) , '#', 
                           array('hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 
                                 'onclick' => 'toggleContainer(\'regional_politicians\')')) ?>      	
      </span>
      <strong>
        <?php echo link_to('Regione&nbsp;'.$region->getName().'&nbsp;('.$regione['n_rappresentanti'].')' , '#', 
                           array('hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 
                                 'onclick' => 'toggleContainer(\'regional_politicians\')')) ?>      	
      </strong>
      <div id="regional_politicians" style="display:none">
	      <?php include_partial('politician/localPoliticians', 
	                            array('tipo'=> 'regione', 'rappresentanza' => $regione)) ?>
      </div> 
    </li>	

    <li class="dark">   	
      <span class="exports">
        <?php echo link_to(image_tag('buttons/open.png', 
                                     array('id'=>'provincial_politicians_toggle_img', 'alt'=>'Apri blocco',
                                           'width'=>'15', 'height'=>'14')) , '#',
                           array('hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 
                                 'onclick' => 'toggleContainer(\'provincial_politicians\')')) ?>      	
      </span>
      <strong>
        <?php echo link_to('Provincia di &nbsp;'.$prov->getName().'&nbsp;('.$provincia['n_rappresentanti'].')' , '#', 
                           array('hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 
                                 'onclick' => 'toggleContainer(\'provincial_politicians\')')) ?>      	
      </strong>
      <div id="provincial_politicians" style="display:none">
	      <?php include_partial('politician/localPoliticians', 
	                            array('tipo'=> 'provincia', 'rappresentanza' => $provincia)) ?>
      </div> 
    </li>

    <li class="light">   	
      <span class="dark">
        <?php echo link_to(image_tag('buttons/open.png', 
                                     array('id'=>'municipal_politicians_toggle_img', 'alt'=>'Apri blocco',
                                           'width'=>'15', 'height'=>'14')) , '#', 
                           array('hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 
                                 'onclick' => 'toggleContainer(\'municipal_politicians\')')) ?>      	
      </span>
      <strong>
        <?php echo link_to('Comune di &nbsp;'.$location->getName().'&nbsp;('.$comune['n_rappresentanti'].')' , '#', 
                           array('hreflang'=>'it', 'lang'=>'it', 'xml:lang'=>'it', 
                                 'onclick' => 'toggleContainer(\'municipal_politicians\')')) ?>      	
      </strong>
      <div id="municipal_politicians" style="display:none">
	      <?php include_partial('politician/localPoliticians', 
	                            array('tipo'=> 'comune', 'rappresentanza' => $comune)) ?>
      </div> 
    </li>
  </ul>
</div>

