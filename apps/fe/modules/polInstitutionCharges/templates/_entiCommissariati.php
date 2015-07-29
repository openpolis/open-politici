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
<h3>Enti locali attualmente commissariati: <?php echo count($enti_commissariati) ?></h3>
<br/>
<table>
     <tr class="label">
        <td>Regione</td>
        <td>Ente</td>
        <td>Motivo del commissariamento</td>
        <td>Periodo di commissariamento</td>
      </tr>
       <tbody>  
     <?php foreach ($enti_commissariati as $ente): ?>
        <tr>
         <td><?php echo $ente[0] ?></td>
         <?php if ($ente[3]=="") : ?>
          <td><?php echo 'Provincia di '.link_to($ente[1],'/provincia/'.$ente[2]) ?></td>
         <?php else : ?>
          <td><?php echo 'Comune di '.link_to($ente[1],'/comune/'.$ente[2])." (".$ente[3].")" ?></td>
         <?php endif; ?>  
         <td><?php echo $ente[4] ?></td>
         <td><?php echo intval((strtotime(date("Y-m-d"))-strtotime($ente[5]))/86400)." giorni (dal ". $ente[6].")" ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
</table>