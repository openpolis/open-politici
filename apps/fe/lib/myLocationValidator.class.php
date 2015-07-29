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
 * controlla che il comune esista
 *
 * @package    openpolis.fe
 * @author     Guglielmo
 */
class myLocationValidator extends sfValidator
{
  /**
   * Execute this validator.
   *
   * @param mixed A file or parameter value/array.
   * @param error An error message reference.
   *
   * @return bool true, if this validator executes successfully, otherwise
   *              false.
   */
  public function execute (&$value, &$error)
  {
    $location_name = $value;
    $check_id = $this->getParameterHolder()->get('check_id');
    $location_id = $this->getContext()->getRequest()->getParameter($check_id);

    // se c'è stata una selezione, validazione OK
    if ($location_id)
      return true;

    // fa un tentativo vedendo se l'id è univoco
    $c = new Criteria();
    $c->add(OpLocationPeer::NAME, $location_name);
    $c->add(OpLocationTypePeer::NAME, 'comune');
    $c->addJoin(OpLocationPeer::LOCATION_TYPE_ID, OpLocationTypePeer::ID);
    $locations = OpLocationPeer::doSelect($c);

    // quante location?
    if (count($locations) == 0)
    {
      $error = $this->getParameterHolder()->get('no_location_error');
      return false;
    } else if (count($locations) > 1) {
      $error = $this->getParameterHolder()->get('too_many_location_error');
      return false;
    } else 
      return true;

  }

  public function initialize ($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);

    // set defaults
    $this->getParameterHolder()->set('no_location_error', "Errore: nessuna location");
    $this->getParameterHolder()->set('too_many_location_error', "Errore: troppe location");

    $this->getParameterHolder()->add($parameters);

    return true;
  }
}

?>