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
 * static actions.
 *
 * @package    openpolis
 * @subpackage static
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class staticActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  
  
  public function executeBookmarklet()
  {
    $this->response->setTitle('pubblica con un click | openpolis');  
  } 
   
  public function executeChiSiamo()
  {
    $this->response->setTitle('chi siamo | openpolis');  
  }

  public function executeRegolamento()
  {
    $this->response->setTitle('regolamento | openpolis');   
  }
  public function executeInformativa()
  {
    $this->response->setTitle('informativa sui dati personali | openpolis');     
  }  
  
  public function executeProssimi()
  {
    $this->response->setTitle('prossimi passi | openpolis');   
  }  
  
    
  public function executeCondizioni()
  {
    $this->response->setTitle("condizioni d'uso | openpolis");   
  }  
  
  public function executeBlog()
  {
    $this->response->setTitle('strumenti per il tuo blog | openpolis');     
  }  
  
  public function executeContatti()
  {
    $this->response->setTitle('contatti | openpolis');   
  }
    
  public function executeBudget()
  {
    
  }  
  
  public function executeSoftware()
  {
    $this->response->setTitle('software utilizzati | openpolis');   
  }  
  
  public function executeContribuisci()
  {
    $this->setLayout('noColumnLayout');
    $this->response->setTitle('contribuisci | openpolis');   

    $this->donors = 0;
    $this->needed = 0;
    $this->raised = 0;
    $this->spent = 0;

    // fetch informazioni sulla raccolta fondi
    $funds_info = OpRequiredFundsPeer::fetch_last_record();
    if ($funds_info instanceof OpRequiredFunds)
    {
      $this->donors = $funds_info->getDonors();
      $this->needed = $funds_info->getNeeded();
      $this->raised = $funds_info->getRaised();
      $this->spent = $funds_info->getSpent();
    }
    
  } 
  
  public function execute404()
  {
    $this->getResponse()->setTitle('pagina non trovata | '.sfConfig::get('app_main_title')); 
  }

  public function executeUnavailable()
  {
    $this->getResponse()->setTitle('applicazione sospesa | '.sfConfig::get('app_main_title')); 
  }
  
  
}

?>
