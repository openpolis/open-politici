<?php use_helper('I18N') ?>

<div>
  <p>
  per il record csv: <span style="font-family: courier; font-size: 11px"><strong><?php echo $csv_rec ?></strong></span><br/>
  non ho trovato una corrispondenza esatta nel DB o un riferimento minint_aka, 
  ma 
  <?php echo format_number_choice(
    "[1]c'&egrave; <strong>un</strong> politico <em>simile</em>|(1,+Inf]ci sono <strong>%1%</strong> politici <em>simili</em>", array('%1%' => count($ps)), count($ps)) ?>  a questo
  </p>
  <br/>
  <p>se il record non corrisponde a nessuno dei politici nell'elenco, <a id="0" class="resolve-sim" href="#">marcalo come <em>sconosciuto</em></a></p>
  <ol id='politician-list' style="margin-top: 1em; margin-left: 1em; ">
    <?php foreach ($ps as $p): ?>
      <li style="margin-top: 0.5em; padding: 0 0.4em">
        <?php echo $p ?>,
        <?php echo $p->getBirthDate('d/m/Y') ?>
        <?php if (!is_null($p->getBirthLocation()) && $p->getBirthLocation() != ''): ?>
          <?php echo $p->getBirthLocation() ?>          
        <?php endif ?>
        <?php if (!is_null($p->getMinintAka()) && $p->getMinintAka() != ''): ?>
          <span style="font-family: courier; font-size: 11px; font-weight: bold">[aka: <?php echo $p->getMinintAka() ?>]</span>
        <?php endif ?>
        <a style="display:none; float:right" id="<?php echo $p->getContentId() ?>" class="resolve-sim" href="#" title="sovrascrivi minint_aka">
          <?php if ($p->getSex() == 'M'): ?>
            &egrave; lui
          <?php else: ?>
            &egrave; lei
          <?php endif ?>
        </a>
        <br/>
        <?php foreach ($p->getPublicInstitutionCharges('current') as $c): ?>
          <?php echo Text::chargeDefinition($c, true, false, true); ?>
          <?php echo $c->getOpLocation()->getOpLocationType()->getName() ?>
          <?php echo $c->getOpLocation()->getName() ?>
          <?php if ($c->getOpLocation()->getLocationTypeId() == 6): ?>
            (<?php echo $c->getOpLocation()->getProv(); ?>)
          <?php endif ?>
          <br/>
        <?php endforeach ?>

        <?php foreach ($p->getPublicInstitutionCharges('past') as $c): ?>
          <?php echo Text::chargeDefinition($c, true, false, true); ?>
          <?php echo $c->getOpLocation()->getOpLocationType()->getName() ?>
          <?php echo $c->getOpLocation()->getName() ?>
          <?php if ($c->getOpLocation()->getLocationTypeId() == 6): ?>
            (<?php echo $c->getOpLocation()->getProv(); ?>)
          <?php endif ?>
          <br/>
        <?php endforeach ?>
      </li>
    <?php endforeach ?>
  </ol>
</div>

<script type="text/javascript">
//<![CDATA[

jQuery.noConflict();
(function($) {
  $().ready(function(){
    var bgcol;
    $("#politician-list li").hover(
      function () {
        bgcol = $(this).css('background-color');
        $(this).css('background-color', '#dedede');
        $(this).find('a').css('display', 'inline');
      }, 
      function () {
        $(this).css('background-color', bgcol);
        $(this).find('a').css('display', 'none');
      }
    );    
    
    $('.resolve-sim').click(
    	function(){
    	  var id = $(this).attr('id');
    	  // indicatore di attesa al posto del link
    	  $(this).replaceWith('<span style="float:right"><img src="/images/indicator.gif"/> Attendere ...</span>');
    	  
    	  // invio richiesta modifica status tramite ajax
    	  $.ajax({
          url: "resolveSimilarity",
          data: "modification_id=<?php echo $import_modifications_id ?>&similar_id="+id,
          success: function(code){
            // gestione risposta ajax (complete)
            
            // chiude finestra gestione similarità
            if (code == 'IA' || code == 'PI' || code == 'IB')
        	    $('a.ui-dialog-titlebar-close').click();
        	  else
        	    $('#windowContainer').replaceWith(code);
        	    
        	  
        	  // modifica codice SXX in  codice ricevuto (PI o IA) e mette pulsante di inserimento in ultima col. (per agg. al DB)
        	  if (code == 'IA' || code == 'PI')
        	  {
            	$('#<?php echo $import_modifications_id ?>').parents('td').prev().text(code);
          	  $('#<?php echo $import_modifications_id ?>').parents('ul').html('<li><a href="concretise?id=<?php echo $import_modifications_id ?>"><img alt="Aggiungi al DB" title="Aggiungi al DB" src="/images/admin_icons/run.png"></a></li>');        	            	    
        	  }
        	  
        	  // per IA bloccati (IB)
        	  // modifica codice SXX in IA, elimina pulsanti gestione, sgrigia il rec_csv
        	  if (code == 'IB')
        	  {
            	$('#<?php echo $import_modifications_id ?>').parents('td').prev().text('IA');
            	$('#<?php echo $import_modifications_id ?>').parents('td').prev().prev().prev().css('color', '#ababab');
          	  $('#<?php echo $import_modifications_id ?>').parents('ul').html('');        	            	            	    
        	  }
          }
        });
    	}
    );



  })
})(jQuery);

//]]>
</script>


