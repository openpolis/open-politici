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

<div id="title">
  <h1>
    <span class="bacchetta">
      <?php if ($mode == 'add'): ?>
        <?php if (isset($politician) && $politician instanceof OpPolitician): ?>
          Aggiungi nuova dichiarazione di 
          <?php echo ucwords(strtolower($politician->getFirstName())) ?>&nbsp;
          <span class="surname"><?php echo $politician->getLastName() ?></span>
        <?php elseif (isset($theme) && $theme instanceof OpTheme): ?>
          Determina la posizione di un politico rispetto a un tema
        <?php endif; ?>
      <?php else: ?>  
        Modifica la dichiarazione di <?php echo ucwords(strtolower($politician->getFirstName())) ?>&nbsp;<span class="surname"><?php echo $politician->getLastName() ?></span>
      <?php endif; ?>
    </span>
  </h1>
</div>

<div style="background-color:#F18715; color:#FFFFFF; padding:5px;">Non hai ancora provato il nuovo strumento per pubblicare VELOCEMENTE le dichiarazioni direttamente da qualsiasi sito? <strong><?php echo link_to('Clicca qui!','/static/bookmarklet') ?></a></strong></div>

<hr />
<?php if (isset($theme) && $theme instanceof OpTheme): ?>
<h2>Pubblica una dichiarazione di un politico da cui si possa dedurre la sua posizione rispetto al tema:  "<?php echo $theme->getTitle(); ?>"</h2>
<?php endif; ?>

<div class="genericblock">
  <div class="mask">
    Una dichiarazione &egrave; una qualunque presa di posizione pubblica di un politico su una
    questione di interesse generale (interviste, discorsi ufficiali, voti su provvedimenti, etc.).
    <br /><br />
    Insieme alla dichiarazione devi fornire anche gli elementi che permettono di verificare le
    informazioni che stai per pubblicare (data, la fonte o link).<br />
    Per favore controlla attentamente che tutte le informazioni siano corrette.<br />
    La credibilit&agrave; di openpolis dipende dalla affidabilit&agrave; di ogni singolo contributo.<br /><br />
    I campi accompagnati dall'asterisco (*) sono obbligatori.<br /><br />
    
        <table cellspacing="0" cellpadding="0" border="0">
          <tbody>
            <?php echo form_tag('polDeclarations/update', array('name'=>'mainForm', 'id'=>'mainForm', 'multipart'=>'true') ) ?>

              <!-- campi nascosti -->
              <?php if ($declaration->getContentId() != 0) echo object_input_hidden_tag($declaration, 'getContentId'); ?>
              <?php if (!isset($theme_id) && !isset($bookmarklet)): ?>
                <?php echo input_hidden_tag('politician_id', $politician_id); ?>
              <?php else: ?>
                  <?php if (!isset($bookmarklet)): ?>
                    <?php echo input_hidden_tag('theme_id', $theme_id); ?>
                  <?php endif; ?>  
              <?php endif; ?>
             
              <?php if (isset($bookmarklet) && $bookmarklet==1): ?>
                <input_hidden_tag('bookmarklet', 1); ?>
              <?php endif; ?>  
              
              <?php if ($hasLayout == "false") echo input_hidden_tag('has_layout', $hasLayout); ?>
              

              <?php if (isset($theme_id) || 'getBookmarklet'==1): ?>
              <tr>
                <td class="<?php echo (form_has_error('politician_id') ? 'labelerror' : 'label')?>" valign="top">Politico (*)</td>
                <td>
                  <?php $msg_class = (form_has_error('politician_id') ? 'error' : '')?>
                  <?php echo include_partial('autocompleter/politicianAutocompleter', 
                                             array('politician_id' => isset($politician_id)?$politician_id:'', 
                                                   'class'=> $msg_class, 'size' => 40))?><br />
                  Seleziona il politico autore della dichiarazione.
                </td>
              </tr>
            <?php endif; ?>

              <tr>
                <td class="<?php echo (form_has_error('title') ? 'labelerror' : 'label')?>" valign="top">Titolo (*)</td>
                <td>
                  <?php $msg_class = (form_has_error('title') ? 'error' : '')?>
                  <?php echo object_input_tag($declaration, 'getTitle', array ('class'=> $msg_class, 'related_class' => 'OpDeclaration', 'size'=>'90' ))?><br />
                  Inserisci il titolo della dichiarazione, fai in modo che sia breve e significativo.
                </td>
              </tr>
          
              <tr>
                <?php $input_val = $declaration->getDate(); ?>
                <td class="<?php echo (form_has_error('date') ? 'labelerror' : 'label')?>" valign="top">Data della dichiarazione (*)</td>
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
                <td class="<?php echo (form_has_error('text') ? 'labelerror' : 'label')?>" valign="top">Testo (*)</td>
                <td>
                  <?php $msg_class = (form_has_error('text') ? 'wikitext error' : 'wikitext')?>
				  <?php echo object_textarea_tag($declaration, 'getText', 
                                                 array ('related_class' => 'OpDeclaration', 
																			                  'rich' => false, 
																			                  'rows'=>'8', 'cols'=>'40', 'style'=>'width:80%', 'class' => $msg_class))?>
            
                  <br />Inserisci qui il testo della dichiarazione. Se la dichiarazione &egrave; riportata in un <b>articolo</b> evita di riprodurre l'intero articolo
                  perch&egrave; potrebbe violare i diritti di propriet&agrave; della fonte e invece l&igrave;mitati a riportare solo il testo della dichiarazione deli
                  politico (le parole che di solito sono tra virgolette). Se si tratta di una registrazione <b>audio</b> o <b>video</b> riporta in questo spazio la
                  trascrizione del testo della dichiarazione (per le registrazioni audio o video che durano molto, se puoi indica anche a che punto
                  del documento si trova la dichiarazione - tipo al 4&deg; minuto).
                </td>
              </tr>
          
              <tr>
                <td class="<?php echo (form_has_error('source_name') ? 'labelerror' : 'label')?>" valign="top">Fonte (*)</td>
                <td>
                  <?php $msg_class = (form_has_error('source_name') ? 'error' : '')?>
                  <?php echo object_input_tag($declaration, 'getSourceName', array ('class' => $msg_class, 'related_class' => 'OpDeclaration', 'size'=>'30'))?><br />
                  Inserisci il nome del quotidiano, della emittente e trasmissione Tv o Radio, del sito web, etc. da cui hai ricavato la dichiarazione <em>(es. Wikipedia) </em>.<br /> 
                </td>
              </tr>
          
              <tr>
                <td class="<?php echo (form_has_error('source_url') ? 'labelerror' : 'label')?>" valign="top">Link alla fonte (*)</td>
                <td class="<?php echo (form_has_error('source_url') ? 'error' : '')?>">
                  <?php $msg_class = (form_has_error('source_url') ? 'error' : '')?>
    
                  <?php echo object_input_tag($declaration, 'getSourceUrl', array ('class' => $msg_class, 'related_class' => 'OpDeclaration', 'size'=>'90'), 'http://' ); ?><br />
                  es. <strong>http://</strong>www.wikipedia.org/wiki/Italy/<br />
                  Inserisci il link alla pagina in cui si trova l'articolo, l'audio o il video che contengono la dichiarazione. 
                  Inserendo un link a YouTube, Google Video, o SkyLife.it (Sky TG24), il video apparir&agrave; direttamente nella pagina della dichiarazione.
                </td>
              </tr>


              <?php if (isset($theme_id)): ?>	
                <tr>
                  <td class="<?php echo (form_has_error('position') ? 'labelerror' : 'label')?>" valign="top">Posizione rispetto al tema (*)</td>
                  <td>
                    <!-- position selector -->  
                    <?php $msg_class = (form_has_error('position') ? 'error' : '')?>
                    <div style="margin-bottom: 10px;">
                    <strong>In base a questa dichiarazione, la posizione del politico sul tema</strong> <i>"<?php echo $theme->getTitle(); ?>"</i> <strong>&egrave;:</strong><br /><br />
                      <?php echo include_partial('themes/positionSelector', 
                                                 array('default_value' => isset($position)?$position:'',
                                                       'class'=> $msg_class,
                                                       'positions' => $selectable_positions)) ?>
                    </div>  
                  </td>
                </tr>
              <?php else: ?>
                <!-- campo nascosto per far funzionare la validazione anche per il caso standard -->
                <?php echo input_hidden_tag('position', 0); ?>
              <?php endif; ?>		

          
              <?php if ($mode=='add'): ?>
  	          <tr>
                <td class="label" valign="top">Argomenti</td>
                <td>
                  <?php echo include_partial('autocompleter/tagsAutocompleter', 
                                             array('script' => 'true', 'content_id'=>$declaration->getContentId())); ?>             	
  	              <br />Inserisci qui gli argomenti chiave della dichiarazione (tags) che possano aiutare anche altri a trovarla
                  tra tante altre. Separa un argomento dal successivo con la virgola "," .
                </td>
              </tr>  			
  	          <?php endif; ?>

            </form>
          
            <?php if ($mode!='add'): ?>	
              <tr>
                <td class="label">Argomenti</td>
                <td>
                  <div id="tags_container_<?php echo $declaration->getContentId() ?>">
                    <?php echo include_partial('opinableContent/tags_managing', 
                                               array('content' => $declaration, 'mode' => $mode)) ?>
                  </div>
                  <br />Inserisci qui gli argomenti chiave della dichiarazione (tags) che possano aiutare anche altri a trovarla
                  tra tante altre. Separa un argomento dal successivo con la virgola "," .
                </td>
              </tr>
            <?php endif; ?>		
                       
            <tr>
              <td></td>
              <td>
                Ti ricordiamo che devi rispettare il <?php echo link_to('Regolamento', '@regolamento') ?> e le  <?php echo link_to('Condizioni d\'uso', '@condizioni') ?> che hai accettato al momento della registrazione.
                Tieni presente che sei responsabile in termini civili e penali dei contenuti che stai per pubblicare.
              </td>
            </tr>
            
            <tr>
              <td></td>
              <td>
                <input type="button" onclick="document.forms.mainForm.submit()" value="pubblica" class="cerca">&nbsp;
                <?php if (isset($politician_id)): ?>
                  <?php echo link_to('annulla', '@politico_new?slug='.$politician->getSlug().'&content_id='.$politician_id); ?>
                <?php elseif (isset($theme_id)): ?>
                  <?php echo link_to('annulla', '@associa_dichiarazione?theme_id='.$theme_id); ?>                
                <?php endif; ?>
              </td>
            </tr>
                    
          </tbody>
        </table>
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