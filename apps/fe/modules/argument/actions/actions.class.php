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
 * argument actions.
 *
 * @package    openpolis
 * @subpackage argument
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1814 2006-08-24 12:20:11Z fabien $
 */
class argumentActions extends sfActions
{
  /**
  * Executes index action
  *
  */
  public function executeIndex()
  {
    $this->response->setTitle('Le dichiarazioni dei politici italiani suddivise per argomento | openpolis');
    $this->response->addMeta('description','La lista delle dichiarazioni dei parlamentari e amministratori locali suddivise per argomento',true);
    $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
	  $this->tags = OpTagPeer::getPopularTags(0, $date);
	}

  public function executeTagsVisualization()
  {
    $this->response->setTitle('Le dichiarazioni dei politici italiani suddivise per argomento | openpolis');
    $this->response->addMeta('description','La lista delle dichiarazioni dei parlamentari e amministratori locali suddivise per argomento',true);
    $this->period = $this->getRequestParameter('period');

    switch ($this->period)
    {
      case 'week':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m"),date("d")-7, date("Y")));
		    break;
      case 'month':
        $date = date("Y-m-d H:i:s", mktime(0,0,0,date("m")-1,date("d"), date("Y")));
        break;
      default:
        $date = '-1';
    }
    
    if ($date == '-1')
      $this->tags = OpTagPeer::getPopularTags(0);
    else
      $this->tags = OpTagPeer::getPopularTags(0, $date);
  }	

  /**
  * Executes list action
  *
  */
  public function executeList()
  {
    $this->tag_id = $this->getRequestParameter('tag');
	  $this->tag = OpTagPeer::RetrieveByPk($this->tag_id);
    $this->forward404Unless($this->tag);
	
  	$this->politician_id = $this->getRequestParameter('politician_id', 0);
  	$this->response->setTitle('Le dichiarazioni dei politici italiani sull\'argomento '.$this->tag->getTag().' | openpolis');
	
	$this->politicians = OpPoliticianPeer::doSelectForTag($this->tag_id);

    $declarations = OpDeclarationPeer::getPopularByTag($this->tag_id, 0, 'last', false);
    
	$last_declaration = array_shift(array_values($declarations));
	
    $this->response->addMeta('description','La lista delle dichiarazioni dei parlamentari e amministratori locali che riguardano l\'argomento '.$this->tag->getTag().'. Ultima dichiarazione di '.$last_declaration->getOpPolitician().' : '.$last_declaration->getTitle(),true);

	$this->total = count($declarations);
	
    $this->correlated_tags = OpTagPeer::getCorrelatedTags($this->tag_id); 
    
  }
}

?>