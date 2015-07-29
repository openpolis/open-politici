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

require_once 'lib/model/om/BaseOpRelevancyComment.php';


/**
 * Skeleton subclass for representing a row from the 'op_relevancy_comment' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpRelevancyComment extends BaseOpRelevancyComment {

	public function save($con = null)
	{
		$con = Propel::getConnection();
		try
		{
		$con->begin();
		
		$ret = parent::save();
		
		// update relevancy score in comment table
		// ogni volta la ricalcola da zero (questo aggiusta possibili interventi nel db)
		$comment = $this->getOpComment();
		$c = new Criteria();
		$c->add(OpRelevancyCommentPeer::COMMENT_ID, $this->getCommentId());
		$user_votes = OpRelevancyCommentPeer::doSelect($c);
		$up = 0; $dn = 0;
		foreach ($user_votes as $vote)
		{
		  if ($vote->getScore() == 1) $up++;
		  if ($vote->getScore() == -1) $dn ++;
		}
		$comment->setRelevancyScoreUp($up);
		$comment->setRelevancyScoreDown($dn);
		$comment->save();
		
		$con->commit();
		
		return $ret;
		}
		catch (Exception $e)
		{
		$con->rollback();
		throw $e;
		}
	}

} // OpRelevancyComment
?>
