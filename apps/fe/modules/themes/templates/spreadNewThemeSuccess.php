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
<?php use_helper('Validation') ?>

<div id="title">
  <h1>
    <span class="bacchetta">
        Segnala questo tema ai tuoi amici
    </span>
  </h1>
</div>

<hr />


<div class="genericblock">
<h2>Per aumentare la priorit&agrave; del tema, segnalalo ai tuoi amici.<br />
Altrimenti <strong><?php echo link_to("torna all'elenco dei temi", "@themes_list"); ?></strong>
</h2>
  <div class="mask">


    <?php echo form_tag('@send_new_theme', array('name'=>'mainForm', 'id'=>'mainForm')) ?>
    
    <table id="send_new_theme" cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr>
          <td class="<?php echo (form_has_error('mail_amici') ? 'labelerror' : 'label')?>" valign="top">
            gli indirizzi email dei tuoi amici <br />
            al max. 5, uno per riga.<br/>
            <span style="font-weight: normal">(gli indirizzi non saranno memorizzati nel nostro sistema)</span>
            
            <?php echo (form_has_error('mail_amici'))?form_error('mail_amici'):'' ?>
          </td>
          <td>
            <?php $msg_class = (form_has_error('mail_amici') ? 'error' : '')?>
  				  <?php echo textarea_tag('mail_amici', '', array('size'=>'30x4', 'class'=>$msg_class)) ?>
          </td>
        </tr>

        <tr>
          <td class="label" valign="top">
            questo il testo automatico, ci pensiamo noi
          </td>
          <td colspan="2">
          <p>Ciao, vota il mio tema:</p>
          
            <p><a href="http://<?php echo $sf_request->getHost() . url_for("@tema?theme_id=" . $theme->getContentId())?>"><?php echo $theme->getTitle()?></a></p>

            e aiutami a farlo salire nella graduatoria dei temi che saranno scelti per il test di voisietequi - elezioni politiche 2008.<br />
Per votare &egrave; necessario essere registrarti al sito.</p>
          </td>
        </tr>


        <tr>
          <td class="<?php echo (form_has_error('mail_testo') ? 'labelerror' : 'label')?>" valign="top">
            qui, se desideri, inserisci un testo aggiuntivo (max. 500 caratteri)
          </td>
          <td>
            <?php $msg_class = (form_has_error('mail_testo') ? 'error' : '')?>
  				  <?php echo textarea_tag('mail_testo', '', array('size'=>'30x4', 'class'=>'msg_class')); ?>
          </td>
        </tr>
       <tr>
          <td></td>
          <td><?php echo input_hidden_tag('theme_id', $theme_id) ?>
          <?php echo submit_tag('invia', array( 'value'=>'invia', 'class'=>'cerca')); ?>
			&nbsp;&nbsp;
			oppure <strong><?php echo link_to("torna all'elenco dei temi", "@themes_list?sort=insert"); ?></strong>
	   </td>		
           

      </tbody>
    </table> 
		    
	
    </form>			

	</div>

</div>