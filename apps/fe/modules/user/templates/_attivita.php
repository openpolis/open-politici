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
<?php use_helper('Date', 'Javascript') ?>

<?php include_partial('user/header', array('current' => 'attivita', 'hash' => $hash, 'subscriber' => $subscriber)) ?>

<table class="utente">
 <tr>
  <td class="label">Numero di contributi pubblicati</td>
  <td class="last"><span style="font-size:12px;font-weight:bold"><?php echo $activities['n_contributions'] ?></span></td>
 </tr>
 <tr>
   <td class="label">Dichiarazioni</td>
   <td class="last"><?php echo $subscriber->getDeclarations(); ?></td>
 </tr>
 <tr>
   <td class="label">Commenti</td>
   <td class="last"><?php echo $subscriber->getComments(); ?></td>
 </tr>
 <tr>
   <td class="label">Risorse politici</td>
   <td class="last"><?php echo $subscriber->getResources(); ?></td>
 </tr>
 <tr>
   <td class="label">Incarichi istituzionali</td>
   <td class="last"><?php echo $activities['n_institution_charges']; ?></td>
 </tr>
 <tr>
   <td class="label">Incarichi politici</td>
   <td class="last"><?php echo $activities['n_political_charges']; ?></td>
 </tr>
 <tr>
   <td class="label">Incarichi organizzativi</td>
   <td class="last"><?php echo $activities['n_organization_charges']; ?></td>
 </tr>

 <tr>
  <td class="label">Ultimo contributo</td>
  <td class="last"><?php echo format_date($subscriber->getLastContribution(), 'dd/MM/yyyy (HH:mm)') ?></td>
 </tr>
 <!--
 <?php if ($subscriber->getIsAdministrator() || $subscriber->getIsModerator() ): ?>
 <tr>
   <td class="label">Contenuti oscurati</td>
   <td class="last">50</td>
 </tr>
 <tr>
   <td class="label">Utenti bloccati</td>
   <td class="last">152</td>
 </tr>
 <?php endif; ?>
 -->
</table>

