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

/**
 * institution_charge actions.
 *
 * @package    openpolis
 * @subpackage institution_charge
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class institution_chargeActions extends autoinstitution_chargeActions
{
  
  public function executeBack()
  {
    $this->redirect('import_log/list');
  }
  
  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['politician_id_is_empty']))
    {
      $criterion = $c->getNewCriterion(OpInstitutionChargePeer::POLITICIAN_ID, '');
      $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::POLITICIAN_ID, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['politician_id']) && $this->filters['politician_id'] !== '')
    {
      $c->add(OpInstitutionChargePeer::POLITICIAN_ID, strtr($this->filters['politician_id'], '*', '%'), Criteria::LIKE);
    }
  }
  
}
