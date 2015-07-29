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
<!-- #################### INIZO TITOLO ####################  -->
<div id="title">
<em></em>
<h1>Personalizza e pubblica sul tuo blog</h1>
</div>
<!-- #################### FINE TITOLO ####################  -->
<hr />
<!-- #################### INIZO REGIONI ####################  -->
<div class="genericblock">La pubblicazione delle informazioni di openpolis su altri siti e' libera per attivita' senza fini di lucro. Per altri usi, consulta la pagina <?php echo link_to('condizioni d\'uso','static/condizioni') ?>.<br />
<br />
<h3 class="widget">Hai scelto di pubblicare le presenze in parlamento di <?php echo ucwords(strtolower($politician->getFirstName())) ?>&nbsp;<span class="surname"><?php echo $politician->getLastName() ?>.</h3>
Con 3 semplici passi puoi personalizzare dimensioni e aspetto. <br />
<br />
<h3 class="widget">1. Personalizza </h3>
Scegli dimensione e aspetto.
<form id="form1" name="form1" method="post" action="">
<table border="0" cellspacing="0" cellpadding="0" summary="" class="tablewidget">
<tr class="dark">
<td>Imposta la larghezza:
<label for="width"><input name="width" type="text" id="width" maxlength="3" value="220" />
</label>
<label for="widthtype">
<select name="widthtype" id="widthtype">
<option value="px">px</option>
<option value="%">%</option>
</select>
</label></td>
</tr>
<tr class="light">
<td><label for="Submit">Scegli tra i seguenti template quello che meglio si adatta all'aspetto grafico del tuo sito:<br />
</label>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><img src="/images/widget/presenze1.jpg" alt=" " width="130" height="170" /></td>
<td><img src="/images/widget/presenze2.jpg" alt=" " width="130" height="170" /></td>
<td><img src="/images/widget/presenze3.jpg" alt=" " width="130" height="170" /></td>
</tr>
<tr>
<td><label for="tpl1"><input name="tpl" type="radio" value="1" id="tpl1" checked /></label></td>
<td><label for="tpl2"><input name="tpl" type="radio" value="2" id="tpl2" /></label></td>
<td><label for="tpl3"><input name="tpl" type="radio" value="3" id="tpl3" /></label></td>
</tr>
<tr>
<td><img src="/images/widget/presenze4.jpg" alt=" " width="130" height="170" /></td>
<td><img src="/images/widget/presenze5.jpg" alt=" " width="130" height="170" /></td>
<td><img src="/images/widget/presenze6.jpg" alt=" " width="130" height="170" /></td>
</tr>
<tr>
<td><label for="tpl5"><input name="tpl" type="radio" value="4" id="tpl5" /></label></td>
<td><label for="tpl6"><input name="tpl" type="radio" value="5" id="tpl6" /></label></td>
<td><label for="tpl7"><input name="tpl" type="radio" value="6" id="tpl7" /></label></td>
</tr>
</table></td>
</tr>
<tr class="light">
<td><label for="Submit"><input name="Submit" type="button" class="genera" id="Submit" value="Genera codice" onclick="impostaCodice('codice',<?php echo $id_politico;?>,'Presenze')"/></label></td>
</tr>
</table>
</form>
<br />
<h3 class="widget">2. Copia il codice </h3>
Quello di seguito è il codice generato che puoi copiare.<br />
<label for="codice"><textarea name="codice" id="codice"> </textarea></label>
<span class="last"> <br />
<link href="/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="/css/themes/mac_os_x.css" rel="stylesheet" type="text/css"/>
<script src="/js/window.js" type="text/javascript"></script>
<script src="/js/window_effects.js" type="text/javascript"></script>
<input name="Submit" type="button" class="preview" id="Preview" value="Preview" onclick="showPreviews('<?php echo ucwords(strtolower($politician->getFirstName())) ?>&nbsp;<?php echo $politician->getLastName() ?>','codice','<?php echo $id_politico;?>','Presenze')" />
<input name="Submit" type="button" class="preview" id="Copia" value="Copia codice" onclick="copia('codice');"/>
</span><br />
<br />
<h3 class="widget">3. Incolla nel tuo sito </h3>
Se sei soddisfatto incolla sul tuo sito il codice generato.<br />
In qualsiasi momento potrai cambiare le configurazioni.
<br />
<br />
<br />
</div>
