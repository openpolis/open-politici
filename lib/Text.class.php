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
 * Classe Text per l'elaborazione dei testi
 *
 *
 * @author Gianluca Canale
 * @version $Id$
 * @package lib
 */


class Text
{
  
  
  public static function getCaricaPresidente($organ, $tipo)
  {
    switch($tipo)
    {
      case 'regione':
        $carica = ($organ=='giunta'?'Presidente della Regione':'Presidente del Consiglio Regionale');
        break;
        
      case 'provincia':
        $carica = ($organ=='giunta'?'Presidente della Provincia':'Presidente del Consiglio Provinciale');
        break;
        
      case 'comune':
        $carica = ($organ=='giunta'?'Sindaco':'Presidente del Consiglio Comunale');
        break;      
        
      default:
        $carica = 'Presidente';
        break;
    }
    
    return $carica;
  }
  
  public static function getIstituzioneLocale($organ, $tipo)
  {
    switch (strtolower($tipo)) {
      case 'regione':
        $agg = 'regionale';
        break;
      case 'provincia':
        $agg = 'provinciale';
        break;
      case 'comune':
        $agg = 'comunale';
        break;
    }
    return ucfirst($organ) . " " . $agg;
  }

	/** 
	* Metodo statico per prendere solo una parte di un testo 
	* 
	* @param  string testo 
	* @param  integer numero di caratteri da prendere  
	*/ 

  	public static function shorten( &$str_to_shorten, $chars_to_keep, $cut_words=false, $str_to_append='...' )
	{
		if ( strlen( $str_to_shorten ) > $chars_to_keep )
		{
			$chop = $chars_to_keep - strlen( $str_to_append );
			if ( !$cut_words )
				while( substr( $str_to_shorten, $chop, 1 ) != ' ' && $chop < strlen( $str_to_shorten ) ){
					$chop--;
				}
			$str_to_shorten = substr( $str_to_shorten, 0, $chop );
			$str_to_shorten = trim( $str_to_shorten );
			$str_to_shorten = $str_to_shorten . $str_to_append;
		}
		
		return $str_to_shorten;
	}
	
	public static function stripText($text)
  	{
		$text = strtolower($text);
	 
		// strip all non word chars
		$text = preg_replace('/\W/', ' ', $text);
	 
		// replace all white space sections with a dash
		$text = preg_replace('/\ +/', '-', $text);
	 
		// trim dashes
		$text = preg_replace('/\-$/', '', $text);
		$text = preg_replace('/^\-/', '', $text);
	 
		return $text;
  	}
	
	public static function getPartBetween($str, $a, $b){
		$start = strpos($str,$a) + strlen($a);
		if(strpos($str,$a) === false) return false;
		$length = strpos($str,$b,$start) - $start;
		if(strpos($str,$b,$start) === false) return false;
		return substr($str,$start,$length);
	}
	
	public static function debug_preg($matches){
		echo "\n\n<h3 style='color=red'>PREG</h3><pre>\n\n";
		var_dump($matches);
		echo "\n\n<hr style='color=red' />n\n";
		return $matches[0];
	}
	
	
	
	public function helper_interwikilinks($matches){
			$target = $matches[1];
			$text = empty($matches[2])?$matches[1]:$matches[2];
			$class=" class=\"dunno\" ";
			/*static $links_checked_interwiki = 0;
			if(!$_GET["nocache"] && ++$links_checked_interwiki<10){
				$data = cachedFunc("getPos",$target);
				if($data["pos"]) $class = " class=\"exists\" "; $class = " class=\"notexists\" ";
			}*/
			return '<a '.$class.' href="?page='.$target.'">'.$text.'</a>';
		}
	
	public static function wikiParser($subject)
	{
		require_once("class_HTTPRetriever.php");
		
		$http = new HTTPRetriever();
		
		$query = "action=submit&pages=".$subject."&curonly=true";
		
		if (!$http->post("http://it.wikipedia.org/wiki/Special:Export",$query)) {
		echo "HTTP request error: #{$http->result_code}: {$http->result_text}";
		return false;
		}
				
		$inizio_testo = strpos($http->response,'<text xml:space="preserve"');
		$fine_testo = strpos($http->response,'</text>');
		$html = substr($http->response,$inizio_testo,$fine_testo);
		
		if (strpos($html,'REDIRECT')==1 || strpos($html,'redirect'))
		{
			$fine_str=strpos($html,']]');
			$name=substr($html,0,$fine_str+2);
			$name=str_replace(" ","_",$name);
			$name=eregi_replace("(#REDIRECT)+(\[\[)([0-9a-z :, -#_ //]+)(\]\])","\\3",$name);
			$name=eregi_replace("(#REDIRECT_)+(\[\[)([0-9a-z :, -#_ //]+)(\]\])","\\3",$name);
			$name=eregi_replace("(#redirect)+(\[\[)([0-9a-z :, -#_ //]+)(\]\])","\\3",$name);
			$name=eregi_replace("(#redirect_)+(\[\[)([0-9a-z :, -#_ //]+)(\]\])","\\3",$name);
				
			
			$http1 = new HTTPRetriever();
			
			$query1 = "action=submit&pages=".$name."&curonly=true";
		
			if (!$http1->post("http://it.wikipedia.org/wiki/Special:Export",$query1)) {
				echo "HTTP request error: #{$http->result_code}: {$http->result_text}";
				return false;
			}
			
			$inizio_testo = strpos($http1->response,'<text xml:space="preserve"');
			$fine_testo = strpos($http1->response,'</text>');
			$html = substr($http1->response,$inizio_testo,$fine_testo);
		}
		
		$html = eregi_replace("[{{]+[^}]+[^{]+[}}]+","",$html);
		
		
		
		// bold
		$html = preg_replace("/\'\'\'([^\n\']+)\'\'\'/",'<strong>${1}</strong>',$html);
		
		// emphasized
		$html = preg_replace('/\'\'([^\'\n]+)\'\'?/','<em>${1}</em>',$html);
		
		//interwiki links
		$html = preg_replace('/\[\[([^\|\n\]:]+)[\|]([^\]]+)\]\]/','${2}',$html);
		$html = eregi_replace("(\[\[s:)+([^\[]+)[\|]+([^\[]+)(\]\])+","\\3",$html);
		
				
		// without text
		$html = preg_replace('/\[\[([^\|\n\]:]+)\]\]/','${1}',$html);
		
		//remove images
		$html = eregi_replace("(\[\[Immagine:)+([^\[]+)(\]\])+","",$html);
		
		//wikisource
		$html = eregi_replace("(\[\[Wikisource:)+([^\[]+)[\|]+([^\[]+)(\]\])+","\\3",$html);
		
		// remove paragraph header
		$html = preg_replace('/\=\=([^\|\n\]:]+)\=\=/','',$html);
				
		//denied tags
		$html = eregi_replace('(\&lt\;span\&gt\;)+([^\[]+)(\&lt\;/span\&gt\;)+','',$html);
		
		//denied html comment
		$html = eregi_replace('(\&lt\;\!\-\-)+([^\[]+)(\-\-\&gt\;)+','',$html);
				
		return $html;
	}
	
	public static function translateClass($class)
	{
		switch($class)
		{
			case 'OpInstitutionCharge':
				$title = 'carica istituzionale';
				break;
			case 'OpPoliticalCharge':
				$title = 'carica politica';
				break;
			case 'OpOrganizationCharge':
				$title = 'carica organizzativa';
				break;
			case 'OpResources':
				$title = 'risorsa';
				break;
			case 'OpDeclaration':
				$title = 'dichiarazione';
				break;
			default:
				$title = 'non inserito';					
		}
			return $title;
	}
	
  /** 
  * Metodo statico per la visualizzzazione delle cariche istituzionali 
  * 
  * @param  object institution_charge  
  * @param  boolean extended definisce il tipo di visualizzazione estesa  
  */ 
  public static function chargeDefinition($institution_charge, $extended = false, $with_link = true, $for_api = false)
  {
    
    if (get_class($institution_charge) == 'OpPoliticalCharge') {
      self::politicalChargeDefinition($institution_charge, $extended, $for_api);
      return;
    }

    if (get_class($institution_charge) == 'OpOrganizationCharge') {
      self::organizationChargeDefinition($institution_charge, $extended, $with_link, $for_api);
      return;
    }
    
    $date_start = $institution_charge->getDateStart(null);
    $date_end = $institution_charge->getDateEnd(null);
    
    $str = "";
    
    if($extended)
    {
      if(date('d', $date_start) == '01' && 
         date('m', $date_start) == '01')
        $str .= 'dal&nbsp;'.date('Y', $date_start);
      else
        $str .= 'dal&nbsp;'. date('d/m/Y', $date_start);

      if($date_end)
	    {		
        if(date('d', $date_end) == '01' && 
           date('m', $date_end) == '01')
           $str .= '&nbsp;al&nbsp;'.date('Y', $date_end);
        else
          $str .= '&nbsp;al&nbsp;'.date('d/m/Y', $date_end);
      }
	    $str .= '&nbsp;:&nbsp;';
	  }

    switch($institution_charge->getInstitutionId())
    {
      case sfConfig::get('app_institution_id_CE'):
      case sfConfig::get('app_institution_id_PE'):
        $str .= $institution_charge->getOpChargeType()->getShortName();
        if(!($institution_charge->getDateEnd()) && $with_link)
	      {
          $str .= "&nbsp;";
          $str .= link_to($institution_charge->getOpInstitution()->getShortName(), 'politician/forinstitution?id='.sfConfig::get('app_institution_id_PE').'&slug=parlamentari-europei');
        }
        else
          $str .= "&nbsp;".$institution_charge->getOpInstitution()->getShortName()."&nbsp;";
        break;

      case sfConfig::get('app_institution_id_GI'):
        if(!($institution_charge->getDateEnd()) && $with_link)
          $str .= link_to($institution_charge->getOpChargeType()->getShortName()."&nbsp;".$institution_charge->getDescription(), 'politician/forinstitution?id='.sfConfig::get('app_institution_id_GI').'&slug=governo-ministri-e-sottosegretari');
        else
          $str .= "&nbsp;".$institution_charge->getOpChargeType()->getShortName()."&nbsp;"."&nbsp;".$institution_charge->getDescription();
        break;

      case sfConfig::get('app_institution_id_GR'):
        $str .= $institution_charge->getOpChargeType()->getShortName();
        if($institution_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_presidente'))
          $str .= '&nbsp;Giunta';
        if($extended)
        {
          if($institution_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore') ||
             $institution_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_sottosegretario'))
		      {
		        if($institution_charge->getDescription())
			        $str .= '&nbsp;'.$institution_charge->getDescription();
			    }	 	
		    }	
        if(!($institution_charge->getDateEnd()) && $with_link)
	      {
		      $str .= "&nbsp;";
		      $str .= link_to($institution_charge->getOpInstitution()->getShortName()."&nbsp;".$institution_charge->getOpLocation()->getName(), 'politician/regPoliticians?location_id='.$institution_charge->getLocationId().'&slug='.$institution_charge->getOpLocation()->getSlug());
        }
		    else
		      $str .= "&nbsp;".$institution_charge->getOpInstitution()->getShortName()."&nbsp;".$institution_charge->getOpLocation()->getName();	
        break;

      case sfConfig::get('app_institution_id_GP'):
        $str .= $institution_charge->getOpChargeType()->getShortName();
        if($institution_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_presidente'))
          $str .= '&nbsp;Giunta';
		    if($extended)
        {
          if($institution_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore'))
		      {
		        if($institution_charge->getDescription())
			        $str .= '&nbsp;'.$institution_charge->getDescription();
			    }	 	
		    }	
		    if(!($institution_charge->getDateEnd()) && $with_link)
	      {
		      $str .= "&nbsp;";
		      $str .= link_to($institution_charge->getOpInstitution()->getShortName()."&nbsp;".$institution_charge->getOpLocation()->getName(), 'politician/provPoliticians?location_id='.$institution_charge->getLocationId().'&slug='.$institution_charge->getOpLocation()->getSlug());
        }
		    else
		      $str .= "&nbsp;".$institution_charge->getOpInstitution()->getShortName()."&nbsp;".$institution_charge->getOpLocation()->getName();	
		    	
		    break;		

      case sfConfig::get('app_institution_id_CR'):
        $str .= $institution_charge->getOpChargeType()->getShortName();
        if($institution_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_presidente') || $institution_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_vicepresidente') )
          $str .= '&nbsp;Consiglio';
        if($extended)
        {
          if($institution_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore'))
          {
            if($institution_charge->getDescription())
              $str .= '&nbsp;'.$institution_charge->getDescription();
          }	 	
        }
        if(!($institution_charge->getDateEnd()) && $with_link)
        {
          $str .= "&nbsp;";
          $str .= link_to($institution_charge->getOpInstitution()->getShortName()."&nbsp;".$institution_charge->getOpLocation()->getName(), 'politician/regPoliticians?location_id='.$institution_charge->getLocationId().'&slug='.$institution_charge->getOpLocation()->getSlug());
        }
        else
          $str .= "&nbsp;".$institution_charge->getOpInstitution()->getShortName()."&nbsp;".$institution_charge->getOpLocation()->getName();	
        break;

      case sfConfig::get('app_institution_id_CP'):
        $str .= $institution_charge->getOpChargeType()->getShortName();
        if($institution_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_presidente'))
		      $str .= '&nbsp;Consiglio';
		    if($extended)
        {
          if($institution_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore'))
          {
            if($institution_charge->getDescription())
              $str .= '&nbsp;'.$institution_charge->getDescription();
          }	 	
        }
        if(!($institution_charge->getDateEnd()) && $with_link)
        {
          $str .= "&nbsp;";
          $str .= link_to($institution_charge->getOpInstitution()->getShortName()."&nbsp;".$institution_charge->getOpLocation()->getName(), 'politician/provPoliticians?location_id='.$institution_charge->getLocationId().'&slug='.$institution_charge->getOpLocation()->getSlug());
        }
        else
          $str .= "&nbsp;".$institution_charge->getOpInstitution()->getShortName()."&nbsp;".$institution_charge->getOpLocation()->getName();	
        break;		

      case sfConfig::get('app_institution_id_GC'):
        $str .= $institution_charge->getOpChargeType()->getShortName();
		    $str .= '&nbsp;';
        if($extended)
        {
          if($institution_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore'))
          {
            if($institution_charge->getDescription())
              $str .= $institution_charge->getDescription();
          }	 	
        }  
        if(!($institution_charge->getDateEnd()) && $with_link)
          $str .= link_to('&nbsp;Comune&nbsp;'.$institution_charge->getOpLocation()->getName()."&nbsp;(".$institution_charge->getOpLocation()->getProv().")", 'politician/munPoliticians?location_id='.$institution_charge->getLocationId().'&slug='.$institution_charge->getOpLocation()->getSlug());
        else
          $str .= "&nbsp;Comune&nbsp;".$institution_charge->getOpLocation()->getName()."&nbsp;(".$institution_charge->getOpLocation()->getProv().")";	
        break;

      case sfConfig::get('app_institution_id_CC'):
        $str .= $institution_charge->getOpChargeType()->getShortName();
		    $str .= '&nbsp;';
        if($extended)
        {
          if($institution_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_assessore'))
          {
            if($institution_charge->getDescription())
              $str .= $institution_charge->getDescription();
          }	 	
        }  
        if(!($institution_charge->getDateEnd()) && $with_link)
          $str .= link_to('&nbsp;Consiglio Comunale&nbsp;'.$institution_charge->getOpLocation()->getName()."&nbsp;(".$institution_charge->getOpLocation()->getProv().")", 'politician/munPoliticians?location_id='.$institution_charge->getLocationId().'&slug='.$institution_charge->getOpLocation()->getSlug());
        else
          $str .= "&nbsp;Consiglio Comunale&nbsp;".$institution_charge->getOpLocation()->getName()."&nbsp;(".$institution_charge->getOpLocation()->getProv().")";	
        break;

      case sfConfig::get('app_institution_id_SR'):
      case sfConfig::get('app_institution_id_CD'):
        if(!($institution_charge->getDateEnd()) && $with_link)
        {
	        if(!( $institution_charge->getChargeTypeId() == sfConfig::get('app_charge_type_id_deputato') ||
                $institution_charge->getChargeTypeId() == sfConfig::get('app_charge_type_id_senatore') ||
                $institution_charge->getChargeTypeId() == sfConfig::get('app_charge_type_id_senatore_vita') ) )
          {
            $str .= $institution_charge->getOpChargeType()->getShortName()."&nbsp;";
            $str .= $institution_charge->getDescription()."&nbsp;";
            $str .= link_to($institution_charge->getOpInstitution()->getShortName(), 'politician/forinstitution?id='.($institution_charge->getInstitutionId()==sfConfig::get('app_institution_id_SR')?sfConfig::get('app_institution_id_SR').'&slug=senatori':sfConfig::get('app_institution_id_CD')) .'&slug=deputati');	
          }
		      else
            $str .= link_to($institution_charge->getOpChargeType()->getShortName(), 'politician/forinstitution?id='.($institution_charge->getInstitutionId()==sfConfig::get('app_institution_id_SR')?sfConfig::get('app_institution_id_SR').'&slug=senatori':sfConfig::get('app_institution_id_CD')) .'&slug=deputati');	
        }
        else
        {
          if(!( $institution_charge->getChargeTypeId() == sfConfig::get('app_charge_type_id_deputato') ||
                $institution_charge->getChargeTypeId() == sfConfig::get('app_charge_type_id_senatore') ||
                $institution_charge->getChargeTypeId() == sfConfig::get('app_charge_type_id_senatore_vita') ) )
          {
            $str .= $institution_charge->getOpChargeType()->getShortName();
            $str .= "&nbsp;".$institution_charge->getOpInstitution()->getShortName()."&nbsp;";
			      $str .= $institution_charge->getDescription()."&nbsp;";
          }
          else
            $str .= $institution_charge->getOpChargeType()->getShortName();	
        }		
		    break;

      default:
        $str .= $institution_charge->getOpChargeType()->getShortName();
    }

    //nel caso di cariche esecutive visualizzo (se presente) il partito	
    if ($institution_charge->getInstitutionId() == sfConfig::get('app_institution_id_CE') ||
        $institution_charge->getInstitutionId() == sfConfig::get('app_institution_id_GI') ||
		    $institution_charge->getInstitutionId() == sfConfig::get('app_institution_id_GR') ||
		    $institution_charge->getInstitutionId() == sfConfig::get('app_institution_id_GP') ||
		    $institution_charge->getInstitutionId() == sfConfig::get('app_institution_id_GC') )

      if($institution_charge->getPartyId()!=1)
      {
        if ($institution_charge->getOpParty()->getName() == 'Tecnici')
          $str .= "&nbsp; (Tecnici)&nbsp;";
        else {
          if ($institution_charge->getOpParty()->getAcronym())
            $str .= "&nbsp;(Partito: ".$institution_charge->getOpParty()->getAcronym().")&nbsp;";
          else
            $str .= "&nbsp;(Partito: ".$institution_charge->getOpParty()->getName().")&nbsp;";
        }
      }

    //nel caso di cariche elettive visualizzo (se presente) il gruppo	
    if ($institution_charge->getInstitutionId() == sfConfig::get('app_institution_id_PE') ||
       ($institution_charge->getInstitutionId() == sfConfig::get('app_institution_id_SR')
        && $institution_charge->getChargeTypeId() != sfConfig::get('app_charge_type_id_senatore_vita') ) ||
        $institution_charge->getInstitutionId() == sfConfig::get('app_institution_id_CD') ||
        $institution_charge->getInstitutionId() == sfConfig::get('app_institution_id_CR') ||
        $institution_charge->getInstitutionId() == sfConfig::get('app_institution_id_CP') ||
        $institution_charge->getInstitutionId() == sfConfig::get('app_institution_id_CC') )
    {
      if($institution_charge->getGroupId()!=1)
      {
        if ($institution_charge->getOpGroup()->getAcronym())
          $str .= "&nbsp;(Gruppo: ".$institution_charge->getOpGroup()->getAcronym().")&nbsp;";
        else
          $str .= "&nbsp;(Gruppo: ".$institution_charge->getOpGroup()->getName().")&nbsp;";
      }
      else if($institution_charge->getPartyId()!=1)
      {
        if ($institution_charge->getOpParty()->getAcronym())
	        $str .= "&nbsp;(Lista di elezione: ".$institution_charge->getOpParty()->getAcronym().")&nbsp;";
	      else
	        $str .= "&nbsp;(Lista di elezione: ".$institution_charge->getOpParty()->getName().")&nbsp;";
	    }        
    }

    if($extended)
    {	
      if($institution_charge->getConstituencyId() && $institution_charge->getChargeTypeId()!=sfConfig::get('app_charge_type_id_senatore_vita')
        && $institution_charge->getInstitutionId()!=sfConfig::get('app_institution_id_GI') )
      {
        $str .= "&nbsp;-&nbsp;Eletto nella circoscrizione&nbsp;".$institution_charge->getOpConstituency()->getName();
      }
    }
    
    if ($for_api)
      return $str;		
    else
      echo $str;

  }
  
  /** 
  * Metodo statico per la visualizzzazione delle cariche politiche 
  * 
  * @param  object political_charge  
  */ 
  public static function politicalChargeDefinition($political_charge, $extended = false, $for_api = false)
  {
    $str = "";
    
    if($extended)
    {	
      if($political_charge->getDateStart() || $political_charge->getDateEnd())
	    {  
		    if($political_charge->getDateStart())
	      {		
          $str .= '&nbsp;dal&nbsp;'. $political_charge->getDateStart('%Y');
          $str .= '&nbsp;';
	      }
	  
  	    if($political_charge->getDateEnd())
  	    {		
           $str .= 'al&nbsp;'.$political_charge->getDateEnd('%Y');
           $str .= '&nbsp;';  
        }
	    }
  	  else
  	  {
  	    if($political_charge->getCurrent())
    		{
    		  $str .= "&egrave;&nbsp;";
    		}
    		else
    		{
    		  $str .= "&egrave;&nbsp;stato&nbsp;";
    		}		
  	  }
  	  $str .= ":&nbsp;";		
	  }
		
  	if($political_charge->getChargeTypeId()==sfConfig::get('app_charge_type_id_iscritto'))
    {
  	  $str .= "iscritto";   
  	}
  	else
  	{
        $str .=  $political_charge->getDescription();
    }
  	$str .=  "&nbsp;-&nbsp;".$political_charge->getOpParty()->getName();
	
	  switch($political_charge->getOpLocation()->getLocationTypeId())
    {
      case sfConfig::get('app_location_type_id_region'):
	      $str .=  "&nbsp;(";
		    $str .=  "regione&nbsp;".$political_charge->getOpLocation()->getName();
	      $str .=  ")&nbsp;";
	      break;
	  
  	  case sfConfig::get('app_location_type_id_provincial'):
  	    $str .=  "&nbsp;(";
  		  $str .=  "provincia&nbsp;".$political_charge->getOpLocation()->getName();
  	    $str .=  ")&nbsp;";
  	    break;
	  
	    case sfConfig::get('app_location_type_id_municipal'):
	      $str .=  "&nbsp;(";
		    $str .=  $political_charge->getOpLocation()->getName()."&nbsp;(".$political_charge->getOpLocation()->getProv().")&nbsp;";
	      $str .=  ")&nbsp;";
	      break;
      default:	    
	  }
	
  	if(!$political_charge->getCurrent() && !$political_charge->getDateEnd())
  	{
  	  $str .=  "&nbsp;- attualmente non in carica";
  	}		
  	
    if ($for_api)
      return $str;		
    else
      echo $str;
  
  }
  
  /** 
  * Metodo statico per la visualizzzazione delle cariche organizzative
  * 
  * @param  object organization_charge  
  */ 
  public static function organizationChargeDefinition($organization_charge, $extended = false, $with_link = true, $for_api = false)
  {
    $str = "";
    if($extended)
	  {	
      if($organization_charge->getDateStart() || $organization_charge->getDateEnd())
	    {  
		    if($organization_charge->getDateStart())
  	    {		
          $str .=  '&nbsp;dal&nbsp;'.$organization_charge->getDateStart('%Y');
          $str .=  '&nbsp;';
  	    }
	  
  	    if($organization_charge->getDateEnd())
  	    {		
          $str .=  'al&nbsp;'.$organization_charge->getDateEnd('%Y');
          $str .=  '&nbsp;';  
        }
	    }
	    else
  	  {
  	    if($organization_charge->getCurrent())
    		{
    		  $str .=  "&egrave;&nbsp;";
    		}
  		  else
    		{
    		  $str .=  "&egrave;&nbsp;stato&nbsp;";
    		}		
  	  }		
	  }
	
	  if($organization_charge->getChargeName())
    {
	    $str .=   $organization_charge->getChargeName();   
	  }
	  else
	  {
      $str .=  "appartenente";  
    }

	  //$str .=  "&nbsp;".$organization_charge->getOpOrganization()->getName()."&nbsp;";
  	if ($organization_charge->getOpOrganization()->getUrl()!='' && $with_link)
  	{
  	  $str .=  "&nbsp;".link_to($organization_charge->getOpOrganization()->getName(), $organization_charge->getOpOrganization()->getUrl())."&nbsp;"; 
  	}  
  	else
  	{
  	  $str .=  "&nbsp;<span style=\"color:#2A76D4; font-size: 12px;\">".$organization_charge->getOpOrganization()->getName()."</span>&nbsp;"; 
  	} 
	  
  	if($extended)
  	{
  	  $organization = $organization_charge->getOpOrganization();	
  	  if ($organization->getOpOrganizationHasOpOrganizationTags())
  	  {
  	    $str .=  "(";
  		  foreach($organization->getOpOrganizationHasOpOrganizationTags() as $organization_tag)
  	      $str .=  $organization_tag->getOpOrganizationTag()->getName().",&nbsp;" ;
  	    $str .=  ")";
  	  }
  	}
	
  	if(!$organization_charge->getCurrent() && !$organization_charge->getDateEnd())
  	{
  	  $str .=  "&nbsp;- attualmente non in carica";
  	}  
  	
  	if ($for_api)
      return $str;		
    else
      echo $str;
    
  }
  
  public static function getCodeForTag($updated_at)
  {
    $week_tmsp = mktime(0,0,0,date("m"),date("d")-7, date("Y"));           //ultima settimana
	$mounth_tmsp = mktime(0,0,0,date("m")-1,date("d"), date("Y"));         //ultimo mese
	$six_mounth_tmsp = mktime(0,0,0,date("m")-6,date("d"), date("Y"));     //ultimi 6 mesi
  
    $my_tmsp = mktime(0,0,0,substr($updated_at,5,2), substr($updated_at,8,2), substr($updated_at,0,4));
	
	if($my_tmsp > $week_tmsp)
	  return sfConfig::get('app_color_tonality_level_1');  // oggi < updated_at < sette giorni fa
	elseif ($my_tmsp > $mounth_tmsp)
	  return sfConfig::get('app_color_tonality_level_2');  // sette giorni fa < updated_at < un mese fa 
	else
	  return sfConfig::get('app_color_tonality_level_3');  // updated_at < sei mesi fa        
  }
  
  public static function getLocationDefinition($location)
  {
    switch($location->getLocationTypeId())
	{
	  case '4':
	    return 'Regione '.$location->getName();
	  case '5':
	    return 'Provincia '.$location->getName();
	  default:
	    return 'Comune '.$location->getName();
	}
  
  }			
	
}
