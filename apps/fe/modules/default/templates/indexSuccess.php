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
<?php use_helper('Global', 'Validation', 'Javascript') ?>

<section id="payoff" class="container">
   <div class="row">
       <div class="twocol">
           <img src="/images//payoff/conosci.png">
           <h1 id="informati">Conosci i tuoi rappresentanti</h1>
           <p>Tutti i 130mila politici eletti: dal parlamento europeo fino al più piccolo comune d'Italia.</p>
       </div>
       <div class="twocol">
           <img src="/images/payoff/adotta.png">
           <h1 id="monitora">Adotta un politico</h1>
           <p>Monitora gli incarichi, le carriere nei partiti e nelle aziende, i voti espressi e le presenze nelle istituzioni.</p>
       </div>
       <div class="twocol">
           <img src="/images/payoff/pubblica.png">
           <h1 id="intervieni">Pubblica cosa dicono</h1>
           <p>Raccogli le dichiarazioni e gli impegni assunti dai politici per ricordare e confrontare.</p>
       </div>
       <div class="sixcol last">
           <h1><img src="/images/payoff/slogan_openpolis.png" alt="Chi sono i tuoi rappresentanti?"></h1>

            <?php echo form_tag('default/choice2', array('id'=>'chisono', 'name'=>'location_search_form')) ?>
              <input type="text" id="location" name="location" value="inserisci il nome del tuo comune" />
              <?php echo input_hidden_tag('location_id', '') ?>
             <input id="Submit" class="cercabott" type="submit" value="Cerca" name="Submit" />
           </form>
       </div>
   </div>
</section>

<section id="homepage-main" class="container">     
    <div class="row">
        <div class="prefixsix threecol">
            <h1>Dalla comunità di Openpolis</h1>
            <ul class="dotted-list">
                <li><?php echo link_to('le ultime 50 dichiarazioni','@last_declarations_new?amount=50') ?></li>
                <li><?php echo link_to('la nostra community','@comunita_new') ?></li>
                <li><?php echo link_to('registrati alla community', 
                                      "http://".sfConfig::get('sf_remote_guard_host',
                                                              'op_accesso.openpolis.it').
                                      (!stristr(SF_ENVIRONMENT,'prod')?'/be_'.SF_ENVIRONMENT.'.php':'').
                                      "/aggiungi_utente")?></li>
            </ul>
        </div> 
        <div class="threecol last">
            <h1>In evidenza</h1>
            <p>
                <span class="inlinedot"></span><strong>Quanto giorni mancano alla pensione?</strong> - 
                <?php echo link_to('la lista dei parlamentari che ancora non maturano la pensione','@pensioni_politici') ?>
                .
            </p>
        </div>
    </div>
</section>
      
    
<br />

<!-- script per le validazioni lato client e autocompleter-->
<script type="text/javascript">
//<![CDATA[
  $(document).ready(function() { 

    $('#location').focus(function(){
      if ($(this)._cleared) return;
      $(this).val('');
      $(this)._cleared = true;
    });  


    $( "#location" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "http://openpolis.it/json_getLocationsForAccessoAutocompleter",
                    data: { 'name_starts_with': request.term },
                    crossDomain: true,
                    dataType: "jsonp",
                    success: function( data ) {
                        response( $.map( data.locations, function( item ) {
                            return {
                                label: item.name + " (" + item.prov + ")",
                                id: item.id
                            }
                        }));
                    }                  
                });
            },
      minLength: 2,
      select: function( event, ui ) {
                $('#location_id').val(ui.item.id); 
            }
    });

  });

//]]>
</script>      
