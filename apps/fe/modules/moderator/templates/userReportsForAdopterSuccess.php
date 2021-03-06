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
<div id="content-group">
  <div id="sx" style="background:none; margin:0px; width:100%">
    <div id="title">
      <h1>
        <span class="bacchetta">Segnalazioni (report) degli utenti</span>
      </h1>
    </div>
    <hr />

    <?php if (count($reports)): ?>
    <div class="genericblock">
      <div class="mask">
        <table border="0" cellspacing="0" cellpadding="0">
    		<tr>
    			<td class="label">utente</td>
    			<td class="label">politico</td>
    			<td class="label">contenuto</td>
    			<td class="label">motivo</td>
    			<td class="label">nota</td>
    			<td class="label">&nbsp;</td>
    		</tr>
			
      	<?php foreach ($reports as $report): ?>
      	
        	<?php
        		$c=new Criteria();
		
        		switch($report->getOpContent()->getOpClass())
        		{
        			case 'OpResources':
        				$c->Add(OpResourcesPeer::CONTENT_ID, $report->getContentId());
        				$charge=OpResourcesPeer::DoSelectOne($c);
        				$item=$charge->getValore();
        				break;
				
        			case 'OpInstitutionCharge':
        				$c->Add(OpInstitutionChargePeer::CONTENT_ID, $report->getContentId());
        				$charge=OpInstitutionChargePeer::DoSelectOne($c);
        				$item=$charge->getOpChargeType()->getName();
        				break;
				
        			case 'OpPoliticalCharge':
        				$c->Add(OpPoliticalChargePeer::CONTENT_ID, $report->getContentId());
        				$charge=OpPoliticalChargePeer::DoSelectOne($c);
        				$item=$charge->getChargeName();
        				break;
			
        			case 'OpOrganizationCharge':
        				$c->Add(OpOrganizationChargePeer::CONTENT_ID, $report->getContentId());
        				$charge=OpOrganizationChargePeer::DoSelectOne($c);
        				$item=$charge->getChargeName();
        				break;
			
        			case 'OpPolitician':
        				$c->Add(OpPoliticianPeer::CONTENT_ID, $report->getContentId());
        				$politician=OpPoliticianPeer::DoSelectOne($c);
        				$item='anagrafica';
        				break;			
        		}
		
        		if ($report->getOpContent()->getOpClass() != 'OpPolitician'){
        			$politician=OpPoliticianPeer::RetrieveByPk($charge->getPoliticianId());
        		}				
        	?>
      		<tr>
      			<td><?php echo link_to($report->getOpUser()->getNickname(),'user/'.$report->getOpUser()->getNickname()); ?></td>
      			<td><?php echo link_to($politician->getLastName(), '@politico_new?content_id='.$politician->getContentId().'&slug='.$politician->getSlug()); ?></td>
      			<td><?php echo $item; ?></td>
      			<td><?php 
      				switch($report->getReportType())
      				{
      					case 'e':
      						echo 'errore';
      						break;
				
      					case 'o':
      						echo 'offensivo';
      						break;	
			
      					case 's':
      						echo 'spam';
      						break;
      				}
      				?>
      			</td>
      			<td><?php echo $report->getNotes(); ?></td>
      			<td><?php echo link_to(__('rimuovi report'),
      			                       'moderator/deleteReport?user_id=' . $report->getUserId() . 
      			                        "&content_id=" . $report->getContentId() . 
      			                        "&referer=" . urlencode($referer),
      			                        array('confirm'=>'Confermi l\'eliminazione?')) ?></td>
      		</tr>
    	    <?php endforeach; ?>
	      </table>
      </div>
    </div>
    <?php else: ?>
      <div>Nessun report per contenuti adottati</div>
    <?php endif; ?>
    <div><?php echo link_to('torna alla pagina precedente', $referer); ?></div>
  </div>
</div>
<br />