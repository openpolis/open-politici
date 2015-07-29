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
<?php use_helper('Date') ?>

<p>Ciao, vota il mio tema:</p>

<a href="http://<?php echo $sf_request->getHost() . url_for("@tema?theme_id=" . $theme->getContentId())?>"><?php echo $theme->getTitle()?></a>


<br />e aiutami a farlo salire nella graduatoria dei temi che saranno scelti per il test di voisietequi - elezioni politiche 2008.
<br />Per votare &egrave; necessario essere registrarti al sito.</p>

<p>
	<?php echo $mail_testo; ?> 
</p>


<p class="footer">
--------
  <hr/>
  <a href="http://www.openpolis.it">openpolis</a> e <a href="http://www.voisietequi.it">voisietequi</a> sono progetti gratuiti, indipendenti e senza scopo di lucro
che possono esistere solo grazie ai contributi degli utenti.<br /> <a href="http://www.openpolis.it/contribuisci#op1">fai subito la tua donazione!</a>

  <br /><br />
  grazie, e a presto!
</p> 
