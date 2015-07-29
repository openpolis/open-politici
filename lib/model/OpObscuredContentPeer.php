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
  require_once 'model/om/BaseOpObscuredContentPeer.php';
  
  // include object class
  include_once 'model/OpObscuredContent.php';


/**
 * Skeleton subclass for performing query and update operations on the 'op_obscured_content' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpObscuredContentPeer extends BaseOpObscuredContentPeer {

  /**
   * torna un solo oggetto di tipo OpObscuredContent
   * passando il content_id
   * content_id in effetti è chiave univoca, perché
   * la relazione con la op_opinable_content è 1-1
   *
   * @return OpObscuredContent
   * @author Guglielmo Celata
   **/
  static public function retrieveByContentID($content_id)
  {
    $c = new Criteria();
    $c->add(self::CONTENT_ID, $content_id);
    return self::doSelectOne($c);
  }
} // OpObscuredContentPeer
