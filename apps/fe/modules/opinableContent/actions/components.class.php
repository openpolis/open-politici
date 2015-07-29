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
 * opinableContent components.
 *
 * @package    openpolis
 * @subpackage opinableContent
 * @author     Guglielmo Celata
 * @version    SVN: $Id: components.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class opinableContentComponents extends sfComponents
{
  
  public function executeBlockForComments()
  {
    $c = new Criteria();
    $c->Add(OpCommentPeer::CONTENT_ID, $this->content_id, Criteria::EQUAL);

    //sorting
    if ($this->sort=='date')
      $c->addDescendingOrderByColumn(OpCommentPeer::CREATED_AT);
    else
    {
      //sorted by relevancy
      $c->addAsColumn( 'relevancy', 
                        OpCommentPeer::RELEVANCY_SCORE_UP . 
                        ' / (' . OpCommentPeer::RELEVANCY_SCORE_UP . ' + ' . 
                        OpCommentPeer::RELEVANCY_SCORE_DOWN.')' );
      $c->addDescendingOrderByColumn('relevancy');
      $c->addDescendingOrderByColumn(OpCommentPeer::RELEVANCY_SCORE_UP);	
    }
    
	  $this->comments = OpCommentPeer::doSelect($c);
  
  }
  	
}

?>
