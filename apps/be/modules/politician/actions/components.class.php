<?php

/**
 * politician components
 *
 * @package    openpolis - backend
 * @subpackage politician
 * @author     Guglielmo Celata
 * @version    SVN: $Id: components.class.php 2692$
 */
class politicianComponents extends sfComponents
{  

  /**
   * prepara la visualizzazione degli incarichi istituzionali
   * associati a un politico
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeInstitutioncharges()
  {
    $params = $this->varHolder->getAll();
    $pol = $params['op_politician'];

    $this->charges = $pol->getUndeletedInstitutionCharges();    
  }
  
}

?>
