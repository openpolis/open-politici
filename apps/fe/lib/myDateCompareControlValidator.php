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

class myDateCompareControlValidator extends sfValidator
{
  /**
  * Executes this validator.
  *
  * @param mixed A file or parameter value/array
  * @param error An error message reference
  *
  * @return bool true, if this validator executes successfully, otherwise false
  */ 
  public function execute(&$value, &$error)
  {
    $date_start_year = $value{'year'};
	   
	
	if ($this->context->getRequest()->getParameter('date_end[year]'))
	{
	  $date_end_year = $this->context->getRequest()->getParameter('date_end[year]');
	  
	  if(($date_end_year - $date_start_year) < 0)
	  {
	    $error = $this->getParameterHolder()->get('date_error');
	    return false;
	  }	
	}
	
	return true;
  
  }
  
  public function initialize ($context, $parameters = null)
  {
    // Initialize parent
    parent::initialize($context);
 

    // Set default parameters value
    $this->getParameterHolder()->set('date_error', 'Date compare error');

    // Set parameters
    $this->getParameterHolder()->add($parameters);
	    
 
    return true;
  }


}

?>