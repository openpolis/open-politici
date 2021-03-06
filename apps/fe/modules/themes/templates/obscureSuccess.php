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


<h2>Oscura un contenuto</h2>

<br />
<strong>Un contenuto per essere oscurato deve NON rispettare almeno un punto del <?php echo link_to('regolamento','static/regolamento') ?>.</strong>

<br /><br /><br /><br />
<?php echo form_tag('@delete_theme') ?>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="label">Motivazione dell'oscuramento:</td>
    </tr>
    <tr>
      <td>
        <?php echo textarea_tag('reason','' , 'size=40x5') ?>	
        <?php echo input_hidden_tag ('user_id', $sf_user->getAttribute('subscriber_id', '', 'subscriber')) ?>
        <?php echo input_hidden_tag ('content_id', $theme_id) ?><br />
      </td>
    </tr>
    <tr>
      <td><?php echo submit_tag('oscura') ?></td>
    </tr>
  </table>  
</form>
</div></div>
 