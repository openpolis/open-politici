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

  // include base peer class
  require_once 'lib/model/om/BaseOpOpenContentPeer.php';
  
  // include object class
  include_once 'lib/model/OpOpenContent.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_open_content' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpOpenContentPeer extends BaseOpOpenContentPeer {
  
  public static function doSelectJoinOpContentOrderByCreationTimestamp(Criteria $c, $con = null)
	{
	  $c = clone $c;
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

    $c->addJoin(self::CONTENT_ID, OpContentPeer::ID);
    $c->add(OpContentPeer::OP_TABLE, 'op_institution_charge');
    
    // escludo utenze redazionali
    $c->add(self::USER_ID, array(1, 14114, 14151), Criteria::NOT_IN);
		
		$c->addDescendingOrderByColumn(OpContentPeer::CREATED_AT);
		return self::doSelectJoinOpContent($c, $con);
  }
  
  public static function doAccept($selected_items_ids, $user)
  {
    foreach ($selected_items_ids as $item_id) {
      $op_open_content = OpOpenContentPeer::retrieveByPK($item_id);
      $msg = $op_open_content->accept($user);

      // aggiorna indice testuale solo se l'incarico è ripristinato
      if ($msg['operation'] == 'ripristinato') {
        $institution_charge = OpInstitutionChargePeer::retrieveByPK($item_id);
        $institution_charge->updatePoliticianSolrIndex();      
      }
    }
  }

  public static function doReject($selected_items_ids, $user)
  {
    foreach ($selected_items_ids as $item_id) {
      $op_open_content = OpOpenContentPeer::retrieveByPK($item_id);
      $msg = $op_open_content->reject($user);

      // aggiorna indice testuale solo se l'incarico è rimosso
      if ($msg['operation'] == 'rifiutato') {
        $institution_charge = OpInstitutionChargePeer::retrieveByPK($item_id);
        $institution_charge->updatePoliticianSolrIndex();      
      }
    }
  }
  
  

} // OpOpenContentPeer
