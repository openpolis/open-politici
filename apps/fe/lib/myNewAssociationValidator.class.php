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
 * controlla che una dichiarazione non sia già associata a un tema
 *
 * @package    openpolis.fe
 * @author     Guglielmo
 */
class myNewAssociationValidator extends sfValidator
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
    $new_declaration_id = $value;
    $old_declaration_id = $this->getContext()->getRequest()->getParameter('declaration_id', 0);
    $theme_id = $this->getContext()->getRequest()->getParameter('theme_id');
    sfContext::getInstance()->getLogger()->info($new_declaration_id);
    if ($new_declaration_id != $old_declaration_id)
    {      
      // association exists?
      $association = OpThemeHasDeclarationPeer::retrieveByPk($new_declaration_id, $theme_id);
      if ($association instanceof OpThemeHasDeclaration)
      {
        $error = $this->getParameterHolder()->get('newassociation_error');
        return false;
      }

    }


    return true;
  }

  public function initialize ($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);

    // set defaults
    $this->getParameterHolder()->set('newassociation_error', "Errore di inserimento");

    $this->getParameterHolder()->add($parameters);

    return true;
  }
}

?>