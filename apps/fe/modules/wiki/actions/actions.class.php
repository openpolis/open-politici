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
 * wiki actions.
 *
 * @package    openpolis
 * @subpackage wiki
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1814 2006-08-24 12:20:11Z fabien $
 */
 
class wikiActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	public function executeIndex()
	{
	}
	  
	/**
	* Executes institution action
	*
	*/
	public function executeInstitution()
	{
	
		switch($this->getRequestParameter('id'))
		{
			case sfConfig::get('app_institution_id_CE'):
			case sfConfig::get('app_institution_id_PE'):
				$this->name1 = 'Commissione_Europea';
				$this->name2 = 'Parlamento_Europeo';
				break;
			case sfConfig::get('app_institution_id_GI'):
				$this->name1 = 'Presidente_della_Repubblica';
				$this->name2 = 'Governo';
				break;
			case sfConfig::get('app_institution_id_SR'):
				$this->name1 = 'Senato_della_Repubblica';
				$this->name2 = '';
				break;	
			case sfConfig::get('app_institution_id_CD'):
				$this->name1 = 'Camera_dei_Deputati';
				$this->name2 = '';
				break;		
		}
		
		$this->text1 = Text::wikiParser($this->name1);
		$this->text2 = Text::wikiParser($this->name2);
	}
	
	/**
	* Executes regional action
	*
	*/
	public function executeRegional()
	{
	
		$subject1 = "Giunta_Regionale";
		$this->text1 = Text::wikiParser($subject1);
		
		$subject2 = "Consiglio_regionale";
		$this->text2 = Text::wikiParser($subject2);
	}
	
	/**
	* Executes provincial action
	*
	*/
	public function executeProvincial()
	{
	
		$subject1 = "Giunta_provinciale";
		$this->text1 = Text::wikiParser($subject1);
		
		$subject2 = "Consiglio_provinciale";
		$this->text2 = Text::wikiParser($subject2);
	}
	
	/**
	* Executes municipal action
	*
	*/
	public function executeMunicipal()
	{
	
		$subject1 = "Giunta_comunale";
		$this->text1 = Text::wikiParser($subject1);
		
		$subject2 = "Consiglio_comunale";
		$this->text2 = Text::wikiParser($subject2);
	}
	
	/**
	* Executes politician action
	*
	*/
	public function executePolitician()
	{
		$this->politician = OpPoliticianPeer::RetrieveByPk($this->getRequestParameter('id','0'));
		$this->first_name2 = strtolower($this->politician->getFirstName());
		$this->first_name1 = ucwords($this->first_name2);
		$this->first_name = str_replace(' ','_',$this->first_name1); 
		
		$this->last_name3 = strtolower($this->politician->getLastName());
		$this->last_name2 = str_replace('\'', '\' ', $this->last_name3);
		$this->last_name1 = ucwords($this->last_name2);
		$last_name_count=strpos($this->last_name1,"-");
		if ($last_name_count == true) $this->last_name1=substr($this->last_name1,- strlen($this->last_name1), $last_name_count+1). ucwords(substr($this->last_name1,$last_name_count+1));
			
			
		$this->last_name = str_replace('\' ','\'',$this->last_name1); 
		
		$this->name = $this->first_name."_".$this->last_name;
	        
	        if (!($this->politician->getFirstName()=='Alberto' and $this->politician->getLastName()=='Corradi'))
		    $this->text1 = Text::wikiParser($this->name);
		else
		    $this->text1 = Text::wikiParser('');   
		
	}
	
	/**
	* Executes tag action
	*
	*/
	public function executeTag()
	{
		$tag = OpTagPeer::RetrieveByPk($this->getRequestParameter('tag','0'));
		$this->name = $tag->getTag();
		$this->name_for_wiki=str_replace(" ","_",$this->name);
		
		$this->text = Text::wikiParser($this->name_for_wiki);
		
	}
  
}

?>