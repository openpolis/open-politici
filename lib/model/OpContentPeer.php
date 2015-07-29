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
  require_once 'lib/model/om/BaseOpContentPeer.php';
  
  // include object class
  include_once 'lib/model/OpContent.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_content' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpContentPeer extends BaseOpContentPeer {

  public static function getContentFromHash($hash)
  {
    $c = new Criteria();
    $c->add(self::HASH, $hash);

    $content = self::doSelectOne($c);

    return $content ? $content : null;
  }

  public static function getReportedSpamPager($page)
  {
    $pager = new sfPropelPager('OpContent', sfConfig::get('app_pager_homepage_max'));
    $c = new Criteria();
    $c->add(self::REPORTS, 0, Criteria::GREATER_THAN);
    $c->setLimit(20);
    $c->addDescendingOrderByColumn(self::REPORTS);
    $c->addAscendingOrderByColumn(self::CREATED_AT);
    $c = self::addPermanentTagToCriteria($c);
    $pager->setCriteria($c);
    $pager->setPage($page);
    $pager->setPeerMethod('doSelectJoinUser');
    $pager->init();

    return $pager;
  }
  
  public static function getReportCount()
  {
    $c = new Criteria();
    $c->add(self::REPORTS, 0, Criteria::GREATER_THAN);
    $c->addJoin(self::ID, OpReportPeer::CONTENT_ID);

    return self::doCount($c);
  }

  /**
   * torna un content di tipo Declaration, Theme o Procedimento
   * a partire da un content_id
   *
   * @return OpDeclaration / OpTheme / OpProcedimento
   * @author Guglielmo Celata
   **/
  public function getRealContent($content_id)
  {
    $content = OpContentPeer::retrieveByPK($this->content_id);
    switch ($content->getOpTable())
    {
      case 'op_declaration':
        return OpDeclarationPeer::retrieveByPK($this->content_id);
        break;
      
      case 'op_theme':
        return OpThemePeer::retrieveByPK($this->content_id);
        break;

      case 'op_procedimento':
        return OpProcedimentoPeer::retrieveByPK($this->content_id);
        break;

    }
    
  }
  
  

} // OpContentPeer
