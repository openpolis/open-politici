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

require_once 'lib/model/om/BaseOpInstitutionCharge.php';

/**
 * Skeleton subclass for representing a row from the 'op_institution_charge' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class OpInstitutionCharge extends BaseOpInstitutionCharge {


  /**
   * close a charge, by setting its end date
   *
   * @param string $end_date the ending date, must be valid, format: YYYY-MM-DD, must be past start_date
   * @return void
   * @author Guglielmo Celata
   */
  public function close($end_date)
  {
    // validation
    list($year, $month, $day) = explode('-', $end_date);    
    if (!checkdate($month, $day, $year)) {
      throw new Exception("end_date parameter must be a valid date");
    }
    if ($end_date <= $this->getDateStart('Y-m-d')) {
      throw new Exception("end_date must be past start date");
    }

    // closing
    $this->setDateEnd($end_date);
    $this->save();
  }

  /**
   * aggiorna il campo minint_verified_at per questo incarico
   * settandolo al momento attuale
   *
   * @return void
   * @author Guglielmo Celata
   **/
  public function updateVerifiedAt($import_date = null, $con = null)
  {
    if ($import_date === null)
      $this->setMinintVerifiedAt(time());
    else
      $this->setMinintVerifiedAt($import_date);
    $this->save();
  }



  /*
	 * Stores the object in the database.  
	 * Overrides the method in the Object Model, taking account of
	 * the op_content relation.
	 * If the object is new, then an OpenContent object is created and saved
	 * before saving the InstitutionCharge object, so that the last one can get
	 * its content_id field from the OpenContent object.
	 * This method wraps the doSave() worker method in a transaction.
	 *
	 * @param Connection $con
	 * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws PropelException
	 * @see doSave()
	 */
	public function save($is_indexing = false, $con = null, $user_id = null)
	{
		$c_affected_rows = 0;
		
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(OpInstitutionChargePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			if ($this->isNew()){
				
				$c = new OpOpenContent();

				// se il campo user_id è forzato nella signature, usa quello,
				// altrimenti usa l'id dell'utente loggato
				if (!is_null($user_id))
				  $c->setUserId($user_id);
				else
				  $c->setUserId(sfContext::getInstance()->getUser()->getAttribute('subscriber_id', '', 'subscriber')?sfContext::getInstance()->getUser()->getSubscriberId():1);
				
				$c_affected_rows = $c->save($con);
				$this->setContentId($c->getContentId());
				$this->setOpOpenContent($c);

				// set op_table and hash fields in op_content table
				$cc = $c->getOpContent();
				$cc->setOpTable(OpInstitutionChargePeer::TABLE_NAME);
				$cc->setOpClass("OpInstitutionCharge");
				$cc->setHash(md5(rand(100000, 999999).$this->getContentId().time()));
				$cc->save();


			} else if ($this->isModified()){
				$this->getOpOpenContent()->setUpdaterId(sfContext::getInstance()->getUser()->getAttribute('subscriber_id', '', 'subscriber')?sfContext::getInstance()->getUser()->getSubscriberId():1);
				$this->getOpOpenContent()->save();
				$this->getOpOpenContent()->getOpContent()->setUpdatedAt(time());
				$this->getOpOpenContent()->getOpContent()->save();				
			}
			
			// aggiorna il timestamp dell'ultimo incarico per un politico e una location
			$this->getOpPolitician()->setLastChargeUpdate(time());
			$this->getOpLocation()->setLastChargeUpdate(time());
			
			// salvataggio incarico
			$affectedRows = $this->doSave($con);


      // aggiornamento campi op_user charges, resources se user_id != 1
      // solo gli incarichi inseriti sono contati
      $user_id = $this->getOpOpenContent()->getUserId();
      if ($user_id != 1)
      {
        $user = OpUserPeer::retrieveByPK($user_id);
        $user->setCharges($user->countCharges());
        $user->updateLastContribution();
        $user->save($con);
        unset($user);
			}						


      // aggiorna l'indice del politico associato (l'ultimo incarico è nei dati [unindexed-stored])
      // se l'utente loggato è l'admin (id=1) non aggiorna l'indice (siamo in importazione)
      if (sfContext::getInstance()->getUser()->getSubscriber()->getId() == 1)
        $is_indexing = true;

      if (!$is_indexing)
      {
        $iMan = new OpIndexManager();
        $iMan->updateDocument($this->getOpPolitician());
        $iMan->commit();
        unset($iMan);
      }

			$con->commit();
			return $c_affected_rows + $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}
	
	
	/** 
  * Ritorna la carica istituzionale in modo esteso (Sindaco di Roma ...) 
  * 
  * @return la stringa con la definizione (nel caso, linkata ed estesa)
  * @param  boolean extended definisce il tipo di visualizzazione estesa  
  * @param  boolean with_link - definisce se la visualizzazione è col link
  */ 
  public function chargeDefinition($extended = false, $with_link = true)
  {
    // necessario caricare l'helper
    sfLoader::loadHelpers('Tag');
    sfLoader::loadHelpers('Url');    
    
    $str = "";
    
    if($extended)
    {
      if(substr($this->getDateStart(),5,2)!= '01' && substr($this->getDateStart(),8,2) != '01')
        $str .= 'dal&nbsp;'.format_date($this->getDateStart(), 'dd/MM/yyyy');
      else
        $str .= 'dal&nbsp;'.substr($this->getDateStart(),0,4);

      if($this->getDateEnd())
	    {		
        if(substr($this->getDateEnd(),5,2)!= '01' && substr($this->getDateEnd(),8,2) != '01')
          $str .= '&nbsp;al&nbsp;'.format_date($this->getDateEnd(), 'dd/MM/yyyy');
        else
          $str .= '&nbsp;al&nbsp;'.substr($this->getDateEnd(),0,4);
      }
	    $str .= '&nbsp;:&nbsp;';
	  }

    
    switch($this->getOpInstitution()->getName())
    {
      case 'Commissione Europea':
      case 'Parlamento Europeo':
        $str .= $this->getOpChargeType()->getShortName();
  		  if(!($this->getDateEnd()))
  	    {
  		    $str .= "&nbsp;";
  		    $str .= link_to($this->getOpInstitution()->getShortName(),   
  		                  'politician/forinstitution?id='.sfConfig::get('app_institution_id_PE'));
        } else {
  		    $str .= "&nbsp;".$this->getOpInstitution()->getShortName()."&nbsp;";
  		  }
		  break;

      case 'Governo Nazionale':
        if(!($this->getDateEnd()))
	      {
		      $str .= link_to($this->getOpChargeType()->getShortName()."&nbsp;".$this->getDescription(), 
		                    'politician/forinstitution?id='.sfConfig::get('app_institution_id_GI'));
        } else {
		      $str .= "&nbsp;".$this->getOpChargeType()->getShortName()."&nbsp;"."&nbsp;".$this->getDescription();
		    }
		  break;
		
      case 'Giunta Regionale':
        $str .= $this->getOpChargeType()->getShortName();
        if($this->getChargeTypeId()==sfConfig::get('app_charge_type_id_presidente'))
		      $str .= '&nbsp;Giunta';
		    if($extended && 
		       $this->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore') && 
		       $this->getDescription())
		    {
		      $str .= '&nbsp;'.$this->getDescription();		      
		    }
    		if(!($this->getDateEnd()))
  	    {
    		  $str .= "&nbsp;";
    		  $str .= link_to($this->getOpInstitution()->getShortName()."&nbsp;".$this->getOpLocation()->getName(), 
    		                  'politician/regPoliticians?location_id='.$this->getLocationId());
        } else {
  		    $str .= "&nbsp;".$this->getOpInstitution()->getShortName()."&nbsp;".$this->getOpLocation()->getName();	
  		  }	
  		break;
		
      case 'Giunta Provinciale':
        $str .= $this->getOpChargeType()->getShortName();
        if ($this->getChargeTypeId()==sfConfig::get('app_charge_type_id_presidente'))
		      $str .= '&nbsp;Giunta';
		    if($extended &&
            $this->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore') &&
            $this->getDescription())
        {
  			  $str .= '&nbsp;'.$this->getDescription();          
        }
  		  if(!($this->getDateEnd()))
  	    {
    		  $str .= "&nbsp;";
    		  $str .= link_to($this->getOpInstitution()->getShortName()."&nbsp;".$this->getOpLocation()->getName(), 'politician/provPoliticians?location_id='.$this->getLocationId());
        } else {
		      $str .= "&nbsp;".$this->getOpInstitution()->getShortName()."&nbsp;".$this->getOpLocation()->getName();	
		    }	
		  break;		

      case sfConfig::get('app_institution_id_CR'):
        $str .= $this->getOpChargeType()->getShortName();
        if ($this->getChargeTypeId()==sfConfig::get('app_charge_type_id_presidente'))
		      $str .= '&nbsp;Consiglio';
		    if($extended &&
            $this->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore') &&
            $this->getDescription())
        {
		      $str .= '&nbsp;'.$this->getDescription();          
        }
		    if(!($this->getDateEnd()))
		    {
    		  $str .= "&nbsp;";
    		  $str .= link_to($this->getOpInstitution()->getShortName()."&nbsp;".$this->getOpLocation()->getName(), 
    		                  'politician/regPoliticians?location_id='.$this->getLocationId());
        }
    		else
    		{
    		  $str .= "&nbsp;".$this->getOpInstitution()->getShortName()."&nbsp;".$this->getOpLocation()->getName();	
    		}		
		  break;
		
      case sfConfig::get('app_institution_id_CP'):
        $str .= $this->getOpChargeType()->getShortName();
        if ($this->getChargeTypeId()==sfConfig::get('app_charge_type_id_presidente'))
		      $str .= '&nbsp;Consiglio';
		    if ($extended &&
		        $this->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore') &&
		        $this->getDescription())
			  {
			    $str .= '&nbsp;'.$this->getDescription();
			  }	
		    if(!($this->getDateEnd()))
	      {
    		  $str .= "&nbsp;";
    		  $str .= link_to($this->getOpInstitution()->getShortName()."&nbsp;".$this->getOpLocation()->getName(), 
    		               'politician/provPoliticians?location_id='.$this->getLocationId());
        } else {
    		  $str .= "&nbsp;".$this->getOpInstitution()->getShortName()."&nbsp;".$this->getOpLocation()->getName();	
    		}
		
		  break;		

      case sfConfig::get('app_institution_id_GC'):
      case sfConfig::get('app_institution_id_CC'):
        $str .= $this->getOpChargeType()->getShortName();
		    $str .= '&nbsp;Comune';
    		if($extended &&
    		   $this->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore') &&
    		   $this->getDescription())
  			{
  			  $str .= '&nbsp;'.$this->getDescription();
  			}	
  			$loc = $this->getOpLocation();
  			if ($loc instanceof OpLocation)
  			{
      		if(!($this->getDateEnd()))
    	    {
      		  $str .= "&nbsp;";
      		  $str .= link_to($loc->getName()."&nbsp;(".$loc->getProv().")", 
      		                  'politician/munPoliticians?location_id='.$this->getLocationId());
          } else {
      		  $str .= "&nbsp;".$loc->getName()."&nbsp;(".$loc->getProv().")";	
      		}   			  
  			}
  		break;

      case sfConfig::get('app_institution_id_SR'):
      case sfConfig::get('app_institution_id_CD'):
	    if(!($this->getDateEnd()))
	    {
	      if(!( $this->getChargeTypeId() == sfConfig::get('app_charge_type_id_deputato') ||
              $this->getChargeTypeId() == sfConfig::get('app_charge_type_id_senatore') ||
              $this->getChargeTypeId() == sfConfig::get('app_charge_type_id_senatore_vita') ) )
          {
            $str .= $this->getOpChargeType()->getShortName()."&nbsp;";
            $str .= link_to($this->getOpInstitution()->getShortName(), 'politician/forinstitution?id='.
                      ($this->getInstitutionId()==sfConfig::get('app_institution_id_SR')?sfConfig::get('app_institution_id_SR'):sfConfig::get('app_institution_id_CD')) );	
          } else {
		        $str .= link_to($this->getOpChargeType()->getShortName(), 'politician/forinstitution?id='.
		                  ($this->getInstitutionId()==sfConfig::get('app_institution_id_SR')?sfConfig::get('app_institution_id_SR'):sfConfig::get('app_institution_id_CD')) );	
		      }			
		    } else {
    		  if(!( $this->getChargeTypeId() == sfConfig::get('app_charge_type_id_deputato') ||
                  $this->getChargeTypeId() == sfConfig::get('app_charge_type_id_senatore') ||
                  $this->getChargeTypeId() == sfConfig::get('app_charge_type_id_senatore_vita') ) )
          {
            $str .= "&nbsp;".$this->getOpInstitution()->getShortName()."&nbsp;";
          } else {
		        $str .= $this->getOpChargeType()->getShortName();	
		      }			
		    }		
      break;
		 
      default:
        $str .= $this->getOpChargeType()->getShortName();
      break;
					
    }

    if ($extended)
    {
      //nel caso di cariche esecutive visualizzo (se presente) il partito	
      if ($this->getInstitutionId() == sfConfig::get('app_institution_id_CE') ||
          $this->getInstitutionId() == sfConfig::get('app_institution_id_GI') ||
		      $this->getInstitutionId() == sfConfig::get('app_institution_id_GR') ||
		      $this->getInstitutionId() == sfConfig::get('app_institution_id_GP') ||
		      $this->getInstitutionId() == sfConfig::get('app_institution_id_GC'))
				
        if($this->getPartyId()!=1)
  		    $str .= "&nbsp;(&nbsp;".$this->getOpParty()->getName()."&nbsp;)&nbsp;";
			
      //nel caso di cariche elettive visualizzo (se presente) il gruppo	
	    if ($this->getInstitutionId() == sfConfig::get('app_institution_id_PE') ||
		      ($this->getInstitutionId() == sfConfig::get('app_institution_id_SR')
		        && $this->getChargeTypeId() != sfConfig::get('app_charge_type_id_senatore_vita') ) ||
		      $this->getInstitutionId() == sfConfig::get('app_institution_id_CD') ||
		      $this->getInstitutionId() == sfConfig::get('app_institution_id_CR') ||
		      $this->getInstitutionId() == sfConfig::get('app_institution_id_CP') ||
		      $this->getInstitutionId() == sfConfig::get('app_institution_id_CC'))
				
		   if($this->getGroupId()!=1)
		     $str .= "&nbsp;(&nbsp;".$this->getOpGroup()->getName()."&nbsp;)&nbsp;";
		   else if($this->getPartyId()!=1)
		     $str .= "&nbsp;(&nbsp;".$this->getOpParty()->getName()."&nbsp;)&nbsp;";
				
		   if($this->getConstituencyId() && $this->getChargeTypeId()!=sfConfig::get('app_charge_type_id_senatore_vita')
		      && $this->getInstitutionId()!=sfConfig::get('app_institution_id_GI') )
		     $str .= "&nbsp;-&nbsp;Eletto nella circoscrizione&nbsp;".$this->getOpConstituency()->getName();
    }
    
    return $str;
    		
  }
  

	public function updatePoliticianSolrIndex()
	{
    $iMan = new OpIndexManager();
    $iMan->updateDocument($this->getOpPolitician());
    $iMan->commit();
	}

} // OpInstitutionCharge
?>