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
<?php echo use_helper('Date') ?>

<div id="title"><h1>Aggiungi la posizione di un politico sul tema: <br /><br /><i>"<?php echo $theme->getTitle() ?>"</i></h1></div>
<hr/>
  
<!-- blocco per la selezione della dichiarazione -->
<h2>La posizione di un politico rispetto al tema viene determinata in base alle sue dichiarazioni.<br />
Qundi per aggiungere una nuova posizione &egrave; necessario: <br />
1. Scegliere una dichiarazione di un politico<br />
2. Indicare la posizione del politico rispetto al tema in base alla dichiarazione scelta
</h2>
<br />


<div class="header">
    <h2>Scegli una dichiarazione di un politico</h2>
</div>
<br />Di seguito trovi una lista di dichiarazioni inserite dagli utenti che <i>potrebbero</i> riguardare il tema.<br />
Cliccando sul titolo potrai leggere il testo della dichiarazione e indicare la posizione del politico rispetto al tema.<br />
Per trovare altre dichiarazioni, per esempio di un determinato politico o argomento, utilizza il motore di ricerca qui in basso.<br /> 
Se non trovi dichiarazioni utili, puoi <strong><?php echo link_to('aggiungere una nuova dichiarazione', "polDeclarations/create?mode=add&theme_id=$theme_id") ?>.</strong>

<div id="declarations_container" style="border: 0px solid grey; padding: 2px">
  <?php include_component('polDeclarations', 'selectableList'); ?>
</div>

<div>
  <?php echo link_to('Torna alla pagina delle posizioni sul tema', '@tema?theme_id='.$theme_id); ?>
</div>