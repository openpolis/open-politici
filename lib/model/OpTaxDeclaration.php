<?php

require_once 'lib/model/om/BaseOpTaxDeclaration.php';


/**
 * Skeleton subclass for representing a row from the 'op_tax_declaration' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class OpTaxDeclaration extends BaseOpTaxDeclaration {

  /**
   * intercetta il delete di un politico e invoca la rimozione del record in op_content
   * la rimozione da op_tax_declaration avviene in cascata (foreign key)
   * viene inoltre rimosso l'indice
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function delete($con = null)
  {    
    // fetch del record in OpContent e rimozione
    $content = OpContentPeer::retrieveByPK($this->getContentId());
    $content->delete();
    unset($content);
  }


  /*
	 * Stores the object in the database.  
	 * Overrides the method in the Object Model, taking account of
	 * the op_content relation.
	 * If the object is new, then a Content object is created and saved
	 * before saving the Politician object, so that the last one can get
	 * its content_id field from the Content object.
	 * This method wraps the doSave() worker method in a transaction.
	 *
	 * @param Boolean - se si sta già indicizzando (per evitare ricorsione e loop infiniti)
	 * @param Connection
	 * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws PropelException
	 * @see doSave()
	 */
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpPoliticianPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			if ($this->isNew()){
				$c = new OpContent();
				$c->setOpTable(OpTaxDeclarationPeer::TABLE_NAME);
				$c->setOpClass("OpTaxDeclaration");
				$c->setHash(md5(rand(100000, 999999).$this->getContentId().time()));
				$c_affected_rows = $c->save($con);
				$this->setContentId($c->getId());
				$this->setOpContent($c);
			}
      
			$affectedRows = $this->doSave($con);
			$con->commit();

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
		
		
	}
	public function getTaxForPolitician($politician_id)
	{
	  $c= new Criteria();
	  $c->add(OpTaxDeclarationPeer::POLITICIAN_ID,$politician_id);
	  return OpTaxDeclarationPeer::doSelect($c);
	}

} // OpTaxDeclaration
