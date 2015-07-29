<?php

/**
 * declarationReports actions.
 *
 * @package    op_openpolis
 * @subpackage declarationReports
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class declarationReportsActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeEnergy()
  {
    $c = $this->_buildEnergyCriterion();
    $this->grouped_dichiarazioni = OpDeclarationPeer::getInsertedByRedazioneGroupedByDate($c);    
  }
  
  public function executeEnergyTrend()
  {
    $c = $this->_buildEnergyCriterion();
    $this->num_dichiarazioni = OpDeclarationPeer::getNumInsertedByRedazioneByDate($c);    
  }

  /**
   * costruisce il criterio usato per la selezione delle dichiarazioni (o del loro trend)
   * legate all'energia
   *
   * @return void
   * @author Guglielmo Celata
   */
  protected function _buildEnergyCriterion()
  {
    $c = new Criteria();
    
    // considero solo dati inseriti dopo il 27/04/2010 (per energyReport)
    $c->add(OpContentPeer::CREATED_AT, '2010-04-27', Criteria::GREATER_EQUAL);
    
    if ($this->hasRequestParameter('tag_ids')) {
      $tag_ids = explode(",", $this->getRequestParameter('tag_ids'));
      if (count($tag_ids) == 1) {
        
        $tag = OpTagPeer::retrieveByPK($tag_ids[0]);
        $this->forward404unless($tag instanceof OpTag);
        
        $this->tema = "sull'Argomento " . $tag->getTag();
        $c->add(OpTagHasOpOpinableContentPeer::TAG_ID, $tag->getId());
      } else {

        $tags = OpTagPeer::retrieveByPKs($tag_ids);
        $this->forward404unless(is_array($tags));

        $this->tema = "sugli argomenti: ";
        $decl_ids = array();
        foreach ($tags as $cnt => $tag) {

          $c_inner = clone $c;
          $c_inner->add(OpTagHasOpOpinableContentPeer::TAG_ID, $tag->getId());
          $ids = OpDeclarationPeer::getIDSInsertedByRedazione($c_inner);
          if ($cnt == 0) {
            $decl_ids = $ids;
          } else {
            $decl_ids = array_intersect($decl_ids, $ids); // array intersection
          }

          $this->tema .= $tag->getTag() . ($cnt==count($tags)-1?'':', ');
        }

        sfContext::getInstance()->getLogger()->info('{energyReport} '. implode(",", $decl_ids));
        $c->add(OpDeclarationPeer::CONTENT_ID, $decl_ids, Criteria::IN);
      }
      $this->tag_ids = $this->getRequestParameter('tag_ids');
    } else {
      // estrae solo dichiarazioni taggate con tag relativi a energia
      $this->tema = "sul tema Energia";
      $this->tag_ids = '';
      $c->add(OpTagHasOpOpinableContentPeer::TAG_ID, explode(",", sfConfig::get('app_argomenti_energia', '129,3297,3298,4253,5455,1199,4517,5458,5468')), Criteria::IN);
    }
    
    return $c;
  }
  
}
