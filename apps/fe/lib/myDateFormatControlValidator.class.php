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

class myDateFormatControlValidator extends sfValidator
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
    //verifico se la data di inizio è minore di quella di fine incarico
	$d_s_d =  $this->context->getRequest()->getParameter('date_start[day]');
	$date_start_day = ($d_s_d ? $d_s_d : '01');
	$d_s_m =  $this->context->getRequest()->getParameter('date_start[month]');
	$date_start_month = ($d_s_m ? $d_s_m : '01');
	$date_start_year = $value;
	
	$date_start_timestamp = mktime(0, 0, 0, $date_start_month, $date_start_day, $date_start_year); //date start timestamp 
	
	$d_e_d =  $this->context->getRequest()->getParameter('date_end[day]');
	$date_end_day = ($d_e_d ? $d_e_d : date("d"));
	$d_e_m =  $this->context->getRequest()->getParameter('date_end[month]');
	$date_end_month = ($d_e_m ? $d_e_m : date("m"));
	$d_e_y =  $this->context->getRequest()->getParameter('date_end[year]');
	$date_end_year = ($d_e_y ? $d_e_y : date("Y"));
	
	$date_end_timestamp = mktime(0, 0, 0, $date_end_month, $date_end_day, $date_end_year); //date end timestamp
	
	if(($date_end_timestamp - $date_start_timestamp)<0)
	{
	  $error = $this->getParameter('date_error');
	  return false;
    }
	return true;
  
  }
  
  public function initialize ($context, $parameters = null)
  {
    // Initialize parent
    parent::initialize($context);
 
    // Set default parameters value
    $this->setParameter('date_error', 'data iniziale maggiore di data finale');
	    
    // Set parameters
    $this->getParameterHolder()->add($parameters);
 
    return true;
  }


}

?>    