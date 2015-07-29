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
 * administrator components.
 *
 * @package    openpolis
 * @subpackage administrator
 * @author     Guglielmo Celata 
 * @version    SVN: $Id: components.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class administratorComponents extends sfComponents
{

  /**
   * elenco paginato delle adozioni
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeAdoptionsList()
  {
    if ($this->type == 'all')
      $adoptions = OpAdoptionPeer::getAll();
    else
      $adoptions = OpAdoptionPeer::getRequests();
    
    $this->nAdoptions = count($adoptions);
    $this->pager = new ArrayPager(null, sfConfig::get('app_pagination_admin_limit'));
    $this->pager->setResultsArray($adoptions);
    $this->pager->setPage($this->page);
    $this->pager->init();
  }


  public function executeUsersList()
  {
    switch ($this->urlalias)
    {
      case 'problematic_users':
        $users = OpUserPeer::getProblematicUsers();
        break;
      case 'moderators':
        $users = OpUserPeer::getModerators();
        break;
      case 'administrators':
        $users = OpUserPeer::getAdministrators();
        break;
      case 'moderator_candidates':
        $users = OpUserPeer::getModeratorCandidates();
        break;
    }

    $this->pager = new ArrayPager(null, sfConfig::get('app_pagination_admin_limit'));
    $this->pager->setResultsArray($users);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();


  }	
  
}

?>  	