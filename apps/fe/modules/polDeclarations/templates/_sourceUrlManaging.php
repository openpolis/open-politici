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
<!-- embed YOUTUBE -->
<?php if (stristr($declaration->getSourceUrl(), 'youtube.com')): ?>
	<?php $start_pos = stripos($declaration->getSourceUrl(), '='); ?> 
	<?php $code = substr($declaration->getSourceUrl(), $start_pos+1) ?>
	<object width="425" height="350">
		<param name="movie" value="http://www.youtube.com/v/<?php echo $code ?>"></param>
		<param name="wmode" value="transparent"></param>
		<embed src="http://www.youtube.com/v/<?php echo $code ?>" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed>
	</object>
<!-- embed GOOGLE VIDEO	-->
<?php elseif (stristr($declaration->getSourceUrl(), 'video.google.com')): ?>
	<?php $start_pos = stripos($declaration->getSourceUrl(), '='); ?> 
	<?php $code = substr($declaration->getSourceUrl(), $start_pos+1) ?>
	<embed style="width:400px; height:326px;" id="VideoPlayback" type="application/x-shockwave-flash"
	src="http://video.google.com/googleplayer.swf?docId=<?php echo $code ?>"></embed>
<!-- embed SKY.IT	-->
<?php elseif (stristr($declaration->getSourceUrl(), 'skylife.it')): ?>
	<?php $start_pos = stripos($declaration->getSourceUrl(), '='); ?> 
	<?php $code = substr($declaration->getSourceUrl(), $start_pos+1) ?>
  <object width="440" height="370">
   <param name="movie" value="http://www.skylife.it/videoEmbed/<?php echo $code; ?>"></param><param name="wmode" value="transparent"></param><embed src="http://www.skylife.it/videoEmbed/<?php echo $code; ?>" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed>
   </object> 
<?php else: ?>
	<?php echo link_to('vai alla pagina',$declaration->getSourceUrl(), array('target'=>'_blank')) ?>
<?php endif; ?>