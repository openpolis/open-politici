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
<?php

function adoption_tools($adoption)
{
  
  if ($adoption instanceof OpPolAdoption)
    $link = '?adopter_id=' . $adoption->getUserId() . '&type=pol&adoptee_id=' . $adoption->getPoliticianId();
  else
    $link = '?adopter_id=' . $adoption->getUserId() . '&type=loc&adoptee_id=' . $adoption->getLocationId();
  
  switch ($adoption->getStatus())
  {
    case 'req':
      $tool = link_to('accetta', '@accetta_adozione' . $link) . " " . link_to('rifiuta', '@ragione_rifiuto_adozione' . $link);
      break;
    case 'gra':
      $tool = link_to('blocca', '@blocca_adozione' . $link);
      break;
    case 'ref':
      $tool = '';
      break;
    case 'rev':
      $tool = link_to('sblocca', '@sblocca_adozione' . $link);
      break;
  }
  
  return $tool;
  
}


?>