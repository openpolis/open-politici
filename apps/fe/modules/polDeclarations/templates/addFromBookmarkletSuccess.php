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
<?php echo use_helper('Javascript', 'Declaration', 'OpinableContent', 'Validation', 'Object', 'ObjectAdmin', 'InputDate' ) ?>

<div id="content-group">
<div style="width:1%;"></div>    
<div id="sx" style="width:99%;">  

<div id="title">
  <h1>
    <span class="bacchetta">
          Aggiungi nuova dichiarazione su openpolis
    </span>
  </h1>
</div>

<hr />

<div class="genericblock">
  <div class="mask">
    <?php if (!$sf_user->hasCredential('subscriber')): ?>
      <div style="font-size: 16px;">
      Per pubblicare una dichiarazione di un politico su openpolis devi effettuare il login.<br /><br />
     <?php echo link_to('<b>Vai alla pagina di login</b>','@sf_guard_signin') ?>
     </div>
    <?php else :?> 
   
    
      <span style="BACKGROUND-COLOR:yellow;">Devi inserire:</span><br />
      - Il nome del politico autore della dichiarazione<br />
      - La data della dichiarazione<br />
      - Gli argomenti associati<br />
      - Controlla se gli altri campi sono corretti, altrimenti modificali.<br /><br />
    
          <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
              <?php echo form_tag('polDeclarations/update', array('name'=>'mainForm', 'id'=>'mainForm', 'multipart'=>'true') ) ?>

                <!-- campi nascosti -->
              
                <?php if ($hasLayout == "false") echo input_hidden_tag('has_layout', $hasLayout); ?>
                <?php echo input_hidden_tag('bookmarklet', '1'); ?>

              
                <tr>
                  <td class="<?php echo (form_has_error('politician_id') ? 'labelerror' : 'label')?>" valign="top" bgcolor="yellow">Politico</td>
                  <td>
                    <?php $msg_class = (form_has_error('politician_id') ? 'error' : '')?>
                    <?php echo include_partial('autocompleter/politicianAutocompleter', 
                                               array('politician_id' => isset($politician_id)?$politician_id:'', 
                                                     'class'=> $msg_class, 'size' => 40))?><br />
                    Seleziona il politico autore della dichiarazione.
                  </td>
                </tr>
         

                <tr>
                  <td class="<?php echo (form_has_error('title') ? 'labelerror' : 'label')?>" valign="top">Titolo</td>
                  <td>
                    <?php $msg_class = (form_has_error('title') ? 'error' : '')?>
                    <?php echo object_input_tag($declaration, 'getTitle', array ('value' => $titolo, 'class'=> $msg_class, 'related_class' => 'OpDeclaration', 'size'=>'70' ))?><br />
                    Inserisci il titolo della dichiarazione, fai in modo che sia breve e significativo.
                  </td>
                </tr>
          
                <tr>
                  <?php $input_val = $declaration->getDate(); ?>
                  <td class="<?php echo (form_has_error('date') ? 'labelerror' : 'label')?>" valign="top" bgcolor="yellow">Data della dichiarazione</td>
                  <td>
                    <?php $msg_class = (form_has_error('date') ? 'error' : '')?>
                    <?php echo my_input_date_tag('date', $input_val, array('id' => 'date', 
  								                                   'rich' => 'false',
  								                                   'size' => '10',
  								                                   'class'=> $msg_class,
  								                                   'culture' => 'it_IT',
  								                                   'custom_setup' => 'ifFormat: "%d/%m/%Y", daFormat: "%d/%m/%Y", weekNumbers: false, range: [1900, ' . date('Y') . ']')) ?>
                    <br />Inserisci la data in cui la dichiarazione &egrave; stata rilasciata.<br /> 
                    Usa il calendario o il formato gg/mm/aaaa.
                  </td>
                </tr>
          
                <tr>
                  <td class="<?php echo (form_has_error('text') ? 'labelerror' : 'label')?>" valign="top">Testo</td>
                  <td>
                    <?php $msg_class = (form_has_error('text') ? 'wikitext error' : 'wikitext')?>
  				  <?php echo textarea_tag('text', $testo,
                                                   array ('related_class' => 'OpDeclaration', 
  																			                  'rich' => false, 
  																			                  'rows'=>'8', 'cols'=>'40', 'style'=>'width:80%', 'class' => $msg_class))?>
                    <div style="width:500px;">  
                    Inserisci qui il testo della dichiarazione. Se la dichiarazione &egrave; riportata in un <b>articolo</b> evita di riprodurre l'intero articolo e l&igrave;mitati a riportare solo il testo della dichiarazione del
                    politico (le parole che di solito sono tra virgolette).
                    </div>
                  </td>
                </tr>
          
                <tr>
                  <td class="<?php echo (form_has_error('source_name') ? 'labelerror' : 'label')?>" valign="top">Fonte</td>
                  <td>
                    <?php $msg_class = (form_has_error('source_name') ? 'error' : '')?>
                    <?php echo object_input_tag($declaration, 'getSourceName', array ('value' => $fonte, 'class' => $msg_class, 'related_class' => 'OpDeclaration', 'size'=>'30'))?><br />
                    <div style="width:500px;">
                    Inserisci il nome del quotidiano, della emittente e trasmissione Tv o Radio, del sito web, etc. da cui hai ricavato la dichiarazione <em>(es. Wikipedia) </em>.
                    </div> 
                  </td>
                </tr>
          
                <tr>
                  <td class="<?php echo (form_has_error('source_url') ? 'labelerror' : 'label')?>" valign="top">Link alla fonte</td>
                  <td class="<?php echo (form_has_error('source_url') ? 'error' : '')?>">
                    <?php $msg_class = (form_has_error('source_url') ? 'error' : '')?>
    
                    <?php echo object_input_tag($declaration, 'getSourceUrl', array ('value' => $link, 'class' => $msg_class, 'related_class' => 'OpDeclaration', 'size'=>'70'), 'http://' ); ?><br />
                    es. <strong>http://</strong>www.wikipedia.org/wiki/Italy/<br />
                    <div style="width:500px;">
                    Inserisci il link alla pagina in cui si trova l'articolo, l'audio o il video che contengono la dichiarazione. 
                    Inserendo un link a YouTube, Google Video, o SkyLife.it (Sky TG24), il video apparir&agrave; direttamente nella pagina della dichiarazione.
                    </div>
                  </td>
                </tr>


              
                  <!-- campo nascosto per far funzionare la validazione anche per il caso standard -->
                  <?php echo input_hidden_tag('position', 0); ?>	

          
              
    	          <tr>
                  <td class="label" valign="top" bgcolor="yellow">Argomenti</td>
                  <td>
                    <?php echo include_partial('autocompleter/tagsAutocompleter', 
                                               array('script' => 'true', 'content_id'=>$declaration->getContentId())); ?>             	
    	              <div style="width:500px;">
    	              Inserisci qui gli argomenti chiave della dichiarazione (tags) che possano aiutare anche altri a trovarla
                    tra tante altre. Separa un argomento dal successivo con la virgola "," .
                    </div>
                  </td>
                </tr>  			
  	          

              </form>	
                       
              <tr>
                <td></td>
                <td>
                  <div style="width:500px;">
                  Ti ricordiamo che devi rispettare il <?php echo link_to('Regolamento', '@regolamento') ?> e le  <?php echo link_to('Condizioni d\'uso', '@condizioni') ?> che hai accettato al momento della registrazione.
                  Tieni presente che sei responsabile in termini civili e penali dei contenuti che stai per pubblicare.
                  </div>
                </td>
              </tr>
            
              <tr>
                <td></td>
                <td>
                  <input type="button" onclick="document.forms.mainForm.submit()" value="pubblica" class="cerca">&nbsp;
                  <input type="button" value="Chiudi" onClick="javascript:window.close()" class="cerca">
                
                </td>
              </tr>
                    
            </tbody>
          </table>
    </div>
   <?php endif ?>   
</div>
</div>
</div>
<script type="text/javascript" src="/js/wikitoolbar.js"></script>

<script type="text/javascript">
//<![CDATA[
function toggleTagDiv(content_id)
{
  div = 'tags_for_'+content_id;	
  if (Element.visible(div))
  {
    new Effect.BlindUp(div, {duration:0.4});
  }
  else
  {
    new Effect.BlindDown(div, {duration:0.4});
  }

  return false;
}
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
function toggleDelTagDiv(content_id)
{
  div = 'del_tags_for_'+content_id;	
  if (Element.visible(div))
  {
    new Effect.BlindUp(div, {duration:0.4});
  }
  else
  {
    new Effect.BlindDown(div, {duration:0.4});
  }

  return false;
}
//]]>
</script>