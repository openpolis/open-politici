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
  require_once 'lib/model/om/BaseOpPoliticalChargePeer.php';
  
  // include object class
  include_once 'lib/model/OpPoliticalCharge.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_political_charge' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpPoliticalChargePeer extends BaseOpPoliticalChargePeer {

  /**
   * compara due incarichi e torna true se hanno uguali:
   * - politician_id (solo se richiesto)
   * - charge_type_id
   * - party_id
   * - date_start
   * - date_end
   *
   * Nel caso in cui si comparino incarichi di due politici doppioni,
   * il confronto tra politician_id non è necessario
   *
   * @param OpPoliticalCharge $ic1 
   * @param OpPoliticalCharge $ic2 
   * @param boolean $compare_politician_id
   * @return void
   * @author Guglielmo Celata
   */
  public static function compare($ic1, $ic2, $compare_politician_id = false)
  {
    if (!$ic1 instanceof OpPoliticalCharge ||
        !$ic2 instanceof OpPoliticalCharge )
      throw new Exception("Wrong parameters: both must be OpPoliticalCharge classes");
    
    $res = false;
    /*
    printf("\ncomparing %6d and %6d\n %6d     %6d\n %6d     %6d\n %6d     %6d\n %6d     %6d\n %s    %s\n %s    %s\n",
           $ic1->getContentId(), $ic2->getContentId(),
           $ic1->getPoliticianId(), $ic2->getPoliticianId(),
           $ic1->getChargeTypeId(), $ic2->getChargeTypeId(),
           $ic1->getPartyId(), $ic2->getPartyId(),
           $ic1->getDateStart('U'), $ic2->getDateStart('U'),
           $ic1->getDateEnd('U'), $ic2->getDateEnd('U'));
    */         
    if ($ic1->getPartyId() == $ic2->getPartyId() &&
        $ic1->getChargeTypeId() == $ic2->getChargeTypeId() &&
        abs($ic1->getDateStart('U') - $ic2->getDateStart('U')) <= 30*86400 &&
        (abs($ic1->getDateEnd('U') - $ic2->getDateEnd('U')) <= 30*86400 || 
         is_null($ic1->getDateEnd()) && is_null($ic2->getDateEnd())))
    {
      $res = true;      
    }
    
    if ($compare_politician_id)
    {
      $res = $res && ($ic1->getPoliticianId() == $ic2->getPoliticianId());
    }
    
    // printf("res: %s\n", $res?'uguali':'diversi');
    return $res;
  }

  /**
   * torna la candidatura (incarico) di un politco per le politiche del 2008
   * la candidatura è unica
   *
   * @return OpPoliticalCharge
   * @author Guglielmo Celata
   **/
  public function retrieveVsqCandidation($politician_id)
  {
    $charge_type = OpChargeTypePeer::retrieveByShortName('CandidatoPolitiche2008');

    $c = new Criteria();
    $c->addJoin(self::CHARGE_TYPE_ID, OpChargeTypePeer::ID);
    $c->add(self::POLITICIAN_ID, $politician_id);
    $c->add(OpChargeTypePeer::ID, $charge_type->getId());
    return self::doSelectOne($c);
  }
} // OpPoliticalChargePeer
