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
<?php echo use_helper('Javascript', 'Themes', 'Validation', 'Object', 'ObjectAdmin', 'InputDate', 'OpinableContent' ) ?>

<div id="title">
  <h1>
    <span class="bacchetta">
      <?php if ($mode == 'add'): ?>  
        Aggiungi un nuovo tema
      <?php else: ?>  
        Modifica di un tema tema
      <?php endif; ?>
    </span>
  </h1>
</div>

<hr />

<div class="genericblock">

  <div class="mask">
    <p class="istruzioni">
      Linee guida per la pubblicazione di un nuovo tema:<br /><br />
      &raquo;&nbsp;Il titolo del tema deve essere formulato in modo che sia possibile indicare una posizione: <i>"favorevole o contrario?"</i>
    </p>
    <p style="margin-top: 0;">
      Non usare quindi <i>"Falso in bilancio"</i>, ma <i>"Aumentare le pene per il reato di falso in bilancio"</i> o anche  
      <i>"Diminuire le pene per il reato di falso in bilancio"</i>
    </p>

    <p class="istruzioni">    
      &raquo;&nbsp;Controlla con cura che il tema non sia gi&agrave; stato inserito anche se con formulazioni differenti<br /><br />
      &raquo;&nbsp;Il tema deve essere di interesse nazionale<br /><br />
      &raquo;&nbsp;Il tema deve essere specifico per consentire il posizionamento di partiti e utenti.
    </p>
    <p style="margin-top: 0;">
      <i>"Riforma della giustizia"</i> &egrave; troppo generico se non si indica chiaramente "quale" tipo di riforma, in modo che ci si possa dire favorevoli o contrari<br />
    </p>
    <p class="istruzioni">    
      &raquo;&nbsp;Il buon tema &egrave; quello che divide.
    </p>
    <p style="margin-top: 0;">
      Temi sui quali sono tutti d'accordo (tipo ridurre il debito pubblico) o tutti contrari sono perfettamente inutili ai fini del test perch&egrave; non contribuiscono per niente a differenziare le posizioni
    </p>
    <p class="istruzioni">  
      &raquo;&nbsp;Il tema deve preferibilmente essere documentabile e documentato.<br />
    </p>
    <p style="margin-top: 0;">
      Ossia il tema deve essere presente nel dibattito pubblico e quindi trattato
      nelle dichiarazioni dei politici e nei programmi dei partiti.<br />
      Perch&egrave; nel caso uno o pi&ugrave; partiti non dovessero rispondere al nostro questionario dovremmo ricavare le loro posizioni da dichiarazioni e programmi.
      Pertanto se del tema scelto non ci fosse traccia nell'agenda dei partiti, dovremmo scartarlo.<br />
    </p>


    <table cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <?php echo form_tag('themes/update', array('name'=>'mainForm', 'id'=>'mainForm') ) ?>
          <?php if ($theme->getContentId() != 0) echo object_input_hidden_tag($theme, 'getContentId'); ?>
          <tr>
            <td class="<?php echo (form_has_error('title') ? 'labelerror' : 'label')?>" valign="top">Titolo (*)</td>
            <td>
              <?php $msg_class = (form_has_error('title') ? 'error' : '')?>
              <?php echo object_input_tag($theme, 'getTitle', 
                                          array ('class'=> $msg_class, 
                                                 'related_class' => 'OpTheme', 'size'=>'70' ))?><br />
              Fai in modo che il titolo favorisca 
              l'indicazione di una <strong>posizione</strong> in questi termini: <br/>
              molto favorevole, favorevole, tendenzialmente favorevole <br/>
              tendenzialmente contrario, contrario, molto contrario
            </td>
          </tr>
      
          <tr>
            <td class="<?php echo (form_has_error('description') ? 'labelerror' : 'label')?>" valign="top">Descrizione (*)</td>
            <td>
              <?php $msg_class = (form_has_error('description') ? 'wikitext error' : 'wikitext')?>
		          <?php echo object_textarea_tag($theme, 'getDescription', 
                                             array ('related_class' => 'OpTheme', 
																	                  'rich' => false, 
																	                  'rows'=>'8', 'cols'=>'40', 
																	                  'style'=>'width:80%', 'class' => $msg_class))?>
        
              <br />
              Inserisci una descrizione magari indicanto le ragioni dei favorevoli e dei contrari.
            </td>
          </tr>
      
      
          <tr>
            <td class="label" valign="top">Area tematica (*)</td>
            <td>
              <?php echo include_partial('themes/areaSelector', 
                                         array('selectables' => $selectable_areas,
                                               'default_value' => isset($area_tematica)?$area_tematica:'',
                                               'class' => form_has_error('tags') ? 'error' : '')); ?>             	
              <br />Seleziona un'area tematica di cui pensi che il tuo tema faccia parte.
            </td>
          </tr>  			

        </form>
      
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
            <?php echo link_to('annulla', 'themes'); ?>
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