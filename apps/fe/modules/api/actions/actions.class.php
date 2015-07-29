<?php

/**
 * api actions.
 *
 * @package    openpolis
 * @subpackage api
 * @author     Guglielmo Celata <g.celata@depp.it>
 */
class apiActions extends sfActions
{

  var $oprcs_ns = 'http://www.openpolis.it/2010/oprcs';
  var $op_ns = 'http://www.openpolis.it/2010/op';
  var $op_location_ns = 'http://www.openpolis.it/2010/op_location';
  var $op_politician_ns = 'http://www.openpolis.it/2010/op_politician';
  var $xlink_ns = 'http://www.w3.org/1999/xlink';


  /**
   * returns the locations in op_location, so that they can be used in the
   * autocompleter at accesso.openpolis.it
   *
   * the structure of returned data contains name (prov) and the location id 
   * var availableLocations = [
   *    { value: "Roma", circ: "Lazio 1" },
   *    { value: "Romedio (Trento)", circ: "Trentino-Alto adige" },
   *    { value: "Milano", circ: "Lombardia 1" }
   * ];
   *
   * @return json stream
   * @author Guglielmo Celata
   */

 public function executeTaxDeclaration()
  {
    $c = new Criteria();
    if ($this->getRequestParameter('id'))
    {
      $c->add(OpTaxDeclarationPeer::POLITICIAN_ID,$this->getRequestParameter('id'));
    }
    $c->addAscendingOrderByColumn(OpTaxDeclarationPeer::POLITICIAN_ID);
    $c->addAscendingOrderByColumn(OpTaxDeclarationPeer::YEAR);
    $this->taxs = OpTaxDeclarationPeer::doSelect($c); 
  }

  public function executeGetLocationsForAccessoAutocompleter()
  {
    $name_starts_with = addslashes($this->getRequestParameter('name_starts_with', ''));
    $jsonCallbackParam = $this->getRequestParameter('callback', '');

    $locations = OpLocationPeer::getLocationsForAccessoAutocompleter($name_starts_with);
    $response = json_encode($locations);    

    if ( $jsonCallbackParam != '' ) 
      $response = $jsonCallbackParam . "(" . $response . ");";    
      
    $this->_send_json_output($response);
    return sfView::NONE;
  }
  
  /**
   * returns the locations in op_location, so that they can be used in the
   * autocompleter at indice.openpolis.it
   *
   * the structure of returned data contains name (prov) and the name of the constituency: 
   * var availableLocations = [
   *    { value: "Roma", circ: "Lazio 1" },
   *    { value: "Romedio (Trento)", circ: "Trentino-Alto adige" },
   *    { value: "Milano", circ: "Lombardia 1" }
   * ];
   *
   * @return json stream
   * @author Guglielmo Celata
   */
  public function executeGetLocationsForIndiceAutocompleter()
  {
    $name_starts_with = addslashes($this->getRequestParameter('name_starts_with', ''));
    $jsonCallbackParam = $this->getRequestParameter('callback', '');

    $locations = OpLocationPeer::getLocationsForIndiceAutocompleter($name_starts_with);
    $response = json_encode($locations);    

    if ( $jsonCallbackParam != '' ) 
      $response = $jsonCallbackParam . "(" . $response . ");";    
      
    $this->_send_json_output($response);
    return sfView::NONE;
  }
  
  /**
   * callback param validation
   *
   * @param string $param 
   * @return void
   * @author Guglielmo Celata
   */
  public function isValid($param)
  {
    if (strpos(strtolower($param), 'json') === false) return false;
    if ( strlen($param) > 128 ) return false;
    if ( !preg_match("/^jsonp\\d+$/", $param)) return false;
    
    return true;
  }


   public function executePoliticianNumber()
   {
     $c= new Criteria(); 
     $number=OpPoliticianPeer::doCount($c);
     $resp_node = new SimpleXMLElement('<openpolis_response></openpolis_response>');
     $number_node = $resp_node->addChild('numero_politici',$number);
     $this->xmlContent = $resp_node->asXML();

       $this->response->setContentType('text/xml; charset=utf-8');
       $this->response->setHttpHeader('Content-Length: ',  strlen($this->xmlContent));
       $this->setLayout(false);
   }
   
   public function executeUserNumber()
    {
      $c= new Criteria(); 
      $c->add(OpUserPeer::IS_ACTIVE,1);
      $number=OpUserPeer::doCount($c);
      $resp_node = new SimpleXMLElement('<openpolis_response></openpolis_response>');
      $number_node = $resp_node->addChild('numero_utenti',$number);
      $this->xmlContent = $resp_node->asXML();

        $this->response->setContentType('text/xml; charset=utf-8');
        $this->response->setHttpHeader('Content-Length: ',  strlen($this->xmlContent));
        $this->setLayout(false);
    }
    
    public function executeDeclarationNumber()
    {
      $c= new Criteria(); 
      $number=OpDeclarationPeer::doCount($c);
      $resp_node = new SimpleXMLElement('<openpolis_response></openpolis_response>');
      $number_node = $resp_node->addChild('numero_dichiarazioni',$number);
      $this->xmlContent = $resp_node->asXML();
      $this->response->setContentType('text/xml; charset=utf-8');
      $this->response->setHttpHeader('Content-Length: ',  strlen($this->xmlContent));
      $this->setLayout(false);
    }
    
    public function executeChargeNumber()
    {
      $c= new Criteria(); 
      $number=OpInstitutionChargePeer::doCount($c);
      $resp_node = new SimpleXMLElement('<openpolis_response></openpolis_response>');
      $number_node = $resp_node->addChild('numero_cariche',$number);
      $this->xmlContent = $resp_node->asXML();
      $this->response->setContentType('text/xml; charset=utf-8');
      $this->response->setHttpHeader('Content-Length: ',  strlen($this->xmlContent));
      $this->setLayout(false);
    }



    /**
     * API (protected by an API key)
     * torna flusso csv equivalente a minint (processed)
     * package: nuovo meccanismo di import
     *
     * i parametri da passare via query string sono:
     *  - key, la chiave per accedere all'API
     *  - location_type, il tipo di contesto (regione, provincia, comune)
     *  - prov_code, il codice minint della provincia (001, 002, 003, ..., 110)
     *
     * Return error string if something's wrong
     * @author Guglielmo Celata
     **/
    public function executeMinintContextCSV()
    {
      $key = $this->getRequestParameter('key');
      $location_type = $this->getRequestParameter('location_type');
      $prov_code = $this->getRequestParameter('prov_code', null);

      $is_valid_key = deppApiKeysPeer::isValidKey($key);

      if ($is_valid_key)
      {
        try {
          $minint_provincial_code = !is_null($prov_code)?(int)$prov_code:null;
          $locations = OpLocationPeer::fetchByMinintContext($location_type, $minint_provincial_code);
        } catch (sfDatabaseException $dbe) {
          $locations = array();
        }


        # costruzione header csv
        # solo i dati strettamente necessari
        $csv_header = "";
        switch ($location_type) {
          case 'regione':
            $csv_header = "codice_regione|denominazione_regione|";
            break;
          case 'provincia':
            $csv_header = "codice_regione|codice_provincia|denominazione_provincia|sigla_provincia|";
            break;
          case 'comune':
            $csv_header = "codice_regione|codice_provincia|codice_comune|denominazione_comune|sigla_provincia|";
            break;
          
          default:
            break;
        }
        $csv_header .= "cognome|nome|sesso|data_nascita|luogo_nascita|" .  
                       "descrizione_carica|data_nomina";


        $csv_rows = array();
        foreach ($locations as $location) {

          # dati della location (variano a seconda del tipo di location)
          switch ($location_type) {
            case 'regione':
              $csv_loc = sprintf("%02d|%s|", 
                                 $location->getMinintRegionalCode(),
                                 $location->getMinintName());
              break;
            case 'provincia':
              $csv_loc = sprintf("%02d|%03d|%s|%s|", 
                                 $location->getMinintRegionalCode(), 
                                 $location->getMinintProvincialCode(),
                                 $location->getMinintName(),
                                 $location->getProv());
              break;
            case 'comune':
              $csv_loc = sprintf("%02d|%03d|%04d|%s|%s|", 
                                 $location->getMinintRegionalCode(), 
                                 $location->getMinintProvincialCode(),
                                 $location->getMinintCityCode(),
                                 $location->getMinintName(),
                                 $location->getProv());
              break;

            default:
              break;
          }

          $location_type_initial = substr(strtoupper($location_type), 0, 1);
          $institutions_codes = array('giunta' => sfConfig::get('app_institution_id_G' . $location_type_initial), 
                                      'consiglio' => sfConfig::get('app_institution_id_C' . $location_type_initial));

          foreach ($institutions_codes as $inst_name => $inst_code) {

            $organ_members = OpInstitutionChargePeer::fetchOrganMembers($inst_code, $location->getId());

            foreach ($organ_members as $member) {
              $csv_row = "";
              $member_type = $member->getOpChargeType()->getName();
              $politician = $member->getOpPolitician();
              
              # $member_node->addChild('nome', html_entity_decode($member->getOpPolitician()->getFirstName(), ENT_COMPAT, 'UTF-8'));

              $csv_row = $csv_loc .sprintf("%s|%s|%s|%s|%s|%s",
                                           strtoupper($politician->getLastName()),
                                           strtoupper($politician->getFirstName()),
                                           $politician->getSex(),
                                           $politician->getBirthDate('d/m/Y'),
                                           strtoupper($politician->getBirthLocation()),
                                           $member_type . (preg_match('/presidente/i', $member_type)? " ".$inst_name: "")
                                          );
              $csv_rows []= $csv_row;

            }

          }

        }

        $this->csv_header = $csv_header;
        $this->csv_rows = $csv_rows;

        $this->setLayout(false);   
        $this->getResponse()->setContentType('text/plain');

      } 
      else 
      {

        $this->setLayout(false);   
        $this->getResponse()->setContentType('text/plain');
        return 'ApiKeyError';

      }

    }





   
  /**
   * API (protected by an API key)
   * torna flusso xml di tutti gli id dei politici 'toccati' dopo una certa data
   * toccati: incarichi rimossi, inseriti o modificati 
   *
   * progetto op_rcs
   *
   *  <oprcs xmlns="http://www.openpolis.it/2010/oprcs"
   *         xmlns:op="http://www.openpolis.it/2010/op"
   *         xmlns:op_location="http://www.openpolis.it/2010/op_location"
   *         xmlns:op_politician="http://www.openpolis.it/2010/op_politician"
   *         xmlns:xlink="http://www.w3.org/1999/xlink">
   *    <op:content> 
   *      <touched_politicians n_politicians="5">
   *        <politician_id>12345</politician_id>
   *        ...
   *      </touched_politician>
   *    </op:content>
   *  </oprcs>
   *
   * Return error in case something's wrong
   * <oprcs xlmns="http://www.openpolis.it/2010/oprcs"
   *        xmlns:op="http://www.openpolis.it/2010/op"
   *        xlmns:op_location="http://www.openpolis.it/2010/op_location"
   *        xmlns:op_politician="http://www.openpolis.it/2010/op_politician">
   *   <op:error>Messaggio di errore</op:error>
   * </oprcs>
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeFetchTouchedPoliticians()
  {
    $key = $this->getRequestParameter('key');
    $last_updated_at = $this->getRequestParameter('last_updated_at');

    $is_valid_key = deppApiKeysPeer::isValidKey($key);

    $resp_node = new SimpleXMLElement(
      '<oprcs xmlns="'.$this->oprcs_ns.'" '.
            ' xmlns:op="'.$this->op_ns.'" '.
            ' xmlns:op_location="'.$this->op_location_ns.'" '.
            ' xmlns:op_politician="'.$this->op_politician_ns.'" '.
            ' xmlns:xlink="'.$this->xlink_ns.'" >'.
      '</oprcs>');
      
    if ($date = strtotime($last_updated_at) !== false)
    {
      if ($is_valid_key)
      {
        $n_touched_charges = OpInstitutionChargePeer::countTouchedCharges($last_updated_at) +
                             OpResourcesPeer::countTouchedResources($last_updated_at);

        if ($n_touched_charges > 0) {
          $content_node = $resp_node->addChild('op:content', null, $this->op_ns);
          $touched_charges_politicians_ids = OpInstitutionChargePeer::getPoliticiansIdsWithTouchedCharges($last_updated_at);
          $touched_resources_politicians_ids = OpResourcesPeer::getPoliticiansIdsWithTouchedResources($last_updated_at);
          $touched_politicians_ids = array_merge($touched_charges_politicians_ids, $touched_resources_politicians_ids);
          
          $politicians_node = $content_node->addChild('touched_politicians', null, $this->oprcs_ns);
          $politicians_node->addAttribute('n_politicians', count($touched_politicians_ids));
          foreach ($touched_politicians_ids as $politician_id) {
            $politicians_node->addChild('politician_id', $politician_id);
          }
        }
        else 
        {
          $content_node = $resp_node->addChild('op:content', 'Nessun cambiamento dal ' . date('d/m/Y h:i:s', strtotime($last_updated_at)), $this->op_ns); 
        }

      } 
      else 
      {
        $resp_node->addChild('op:error', 'Chiave di accesso non valida', $this->op_ns);
      }
    } else {
      $resp_node->addChild('op:error', "Data non valida: $last_updated_at", $this->op_ns);      
    }

    $xmlContent = $resp_node->asXML();
    $this->_send_output($xmlContent);
    return sfView::NONE;
  }



  /**
   * API (protected by an API key)
   * torna flusso xml di tutti gli id (istat) delle città 'toccate' dopo una certa data
   * toccate: incarichi rimossi, inseriti o modificati 
   * in comune, o provincia, regione, circoscrizioni di appartenenza del comune
   *
   * progetto op_rcs
   *
   *  <oprcs xmlns="http://www.openpolis.it/2010/oprcs"
   *         xmlns:op="http://www.openpolis.it/2010/op"
   *         xmlns:op_location="http://www.openpolis.it/2010/op_location"
   *         xmlns:op_politician="http://www.openpolis.it/2010/op_politician"
   *         xmlns:xlink="http://www.w3.org/1999/xlink">
   *    <op:content> 
   *      <touched_cities n_cities="3">
   *          <city_id>12345</city_id>
   *        ...
   *      </touched_cities>
   *    </op:content>
   *  </oprcs>
   *
   * Return error in case something's wrong
   * <oprcs xlmns="http://www.openpolis.it/2010/oprcs"
   *        xmlns:op="http://www.openpolis.it/2010/op"
   *        xlmns:op_location="http://www.openpolis.it/2010/op_location"
   *        xmlns:op_politician="http://www.openpolis.it/2010/op_politician">
   *   <op:error>Messaggio di errore</op:error>
   * </oprcs>
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeFetchTouchedCities()
  {
    $key = $this->getRequestParameter('key');
    $last_updated_at = $this->getRequestParameter('last_updated_at');

    $is_valid_key = deppApiKeysPeer::isValidKey($key);

    $resp_node = new SimpleXMLElement(
      '<oprcs xmlns="'.$this->oprcs_ns.'" '.
            ' xmlns:op="'.$this->op_ns.'" '.
            ' xmlns:op_location="'.$this->op_location_ns.'" '.
            ' xmlns:op_politician="'.$this->op_politician_ns.'" '.
            ' xmlns:xlink="'.$this->xlink_ns.'" >'.
      '</oprcs>');
      
    if ($date = strtotime($last_updated_at) !== false)
    {
      if ($is_valid_key)
      {
        $n_touched_charges = OpInstitutionChargePeer::countTouchedCharges($last_updated_at);

        if ($n_touched_charges > 0) {
          $content_node = $resp_node->addChild('op:content', null, $this->op_ns);
          $touched_loc_const = OpInstitutionChargePeer::getLocationsIdsAndConstituenciesWithTouchedCharges($last_updated_at);

          $touched_cities = array();
          foreach ($touched_loc_const as $loc_id => $const_ids) {   
            $touched_cities = array_merge($touched_cities, OpLocationPeer::getContainedCitiesIds($loc_id, $const_ids));
          }
          $touched_cities = array_unique($touched_cities);
          
          $cities_node = $content_node->addChild('touched_cities', null, $this->oprcs_ns);
          $cities_node->addAttribute('n_cities', count($touched_cities));
          foreach ($touched_cities as $city_id) {
            $cities_node->addChild('city_id', $city_id);
          }
          
          
        }
        else 
        {
          $content_node = $resp_node->addChild('op:content', 'Nessun cambiamento dal ' . date('d/m/Y h:i:s', strtotime($last_updated_at)), $this->op_ns); 
        }

      } 
      else 
      {
        $resp_node->addChild('op:error', 'Chiave di accesso non valida', $this->op_ns);
      }
    } else {
      $resp_node->addChild('op:error', "Data non valida: $last_updated_at", $this->op_ns);      
    }

    $xmlContent = $resp_node->asXML();
    $this->_send_output($xmlContent);
    return sfView::NONE;
  }

  /**
   * API (protected by an API key)
   * torna flusso xml di tutti gli id (istat) delle città in op_location
   *
   * progetto op_rcs
   *
   *  <oprcs xmlns="http://www.openpolis.it/2010/oprcs"
   *         xmlns:op="http://www.openpolis.it/2010/op"
   *         xmlns:op_location="http://www.openpolis.it/2010/op_location"
   *         xmlns:op_politician="http://www.openpolis.it/2010/op_politician"
   *         xmlns:xlink="http://www.w3.org/1999/xlink">
   *    <op:content> 
   *      <cities n_cities="3">
   *          <city_id>12345</city_id>
   *        ...
   *      </cities>
   *    </op:content>
   *  </oprcs>
   *
   * Return error in case something's wrong
   * <oprcs xlmns="http://www.openpolis.it/2010/oprcs"
   *        xmlns:op="http://www.openpolis.it/2010/op"
   *        xlmns:op_location="http://www.openpolis.it/2010/op_location"
   *        xmlns:op_politician="http://www.openpolis.it/2010/op_politician">
   *   <op:error>Messaggio di errore</op:error>
   * </oprcs>
   * @return void
   * @author Guglielmo Celata
   **/
  public function executeGetCitiesIstatIds()
  {
    $key = $this->getRequestParameter('key');
    $last_updated_at = $this->getRequestParameter('last_updated_at');
    $limit = $this->getRequestParameter('limit');
    $offset = $this->getRequestParameter('offset');

    $is_valid_key = deppApiKeysPeer::isValidKey($key);

    $resp_node = new SimpleXMLElement(
      '<oprcs xmlns="'.$this->oprcs_ns.'" '.
            ' xmlns:op="'.$this->op_ns.'" '.
            ' xmlns:op_location="'.$this->op_location_ns.'" '.
            ' xmlns:op_politician="'.$this->op_politician_ns.'" '.
            ' xmlns:xlink="'.$this->xlink_ns.'" >'.
      '</oprcs>');
      
    if ($is_valid_key)
    {
      if ($limit == 0 && $offset == 0 ) {
        $n_cities = OpLocationPeer::countCities();
      } elseif ($limit == 0) {
        $n_cities = OpLocationPeer::countCities() - $offset;
      } else {
        $n_cities = $limit;
      }

      if ($n_cities > 0) {
        $content_node = $resp_node->addChild('op:content', null, $this->op_ns);

        $cities = OpLocationPeer::getCitiesIstatIds();
        $cities_node = $content_node->addChild('cities', null, $this->oprcs_ns);
        $cities_node->addAttribute('n_cities', $n_cities);
        foreach ($cities as $cnt => $city_id) {
          if ($cnt >= $offset && ($limit == 0 || $limit > 0 && $cnt < $offset + $limit)) {
            $cities_node->addChild('city_id', $city_id);            
          }
        }
        
      }
      else 
      {
        $content_node = $resp_node->addChild('op:content', 'Nessun cambiamento dal ' . date('d/m/Y h:i:s', strtotime($last_updated_at)), $this->op_ns); 
      }

    } 
    else 
    {
      $resp_node->addChild('op:error', 'Chiave di accesso non valida', $this->op_ns);
    }

    $xmlContent = $resp_node->asXML();
    $this->_send_output($xmlContent);
    return sfView::NONE;
  }


  /**
   * API (protected by an API key)
   * torna flusso xml di tutti i rappresentanti per un cittadino con residenza in un dato comune
   * progetto op_rcs
   *
   *  <oprcs xmlns="http://www.openpolis.it/2010/oprcs"
   *         xmlns:op="http://www.openpolis.it/2010/op"
   *         xmlns:op_location="http://www.openpolis.it/2010/op_location"
   *         xmlns:op_politician="http://www.openpolis.it/2010/op_politician"
   *         xmlns:xlink="http://www.w3.org/1999/xlink">
   *    <op:content> 
   *      <europarlamento>
   *        <membro op_politician:content_id="12345" xlink:href="politici/12345.xml">
   *          <nome>NOME</nome>
   *          <cognome>COGNOME</cognome>
   *          <carica>Parlamentare europeo</carica>
   *          <partito>NOME GRUPPO</partito>
   *        </membro>
   *        <membro> ... </membro>
   *      </europarlamento>
   *      <camera>
   *        <membro> ... </membro>
   *      </camera>
   *      <senato>
   *        <membro> ... </membro>
   *      </senato>
   *      <regione>
   *        <organo tipo="giunta">
   *          <membro> ... </membro>
   *        </organo>
   *        <organo tipo="consiglio">
   *          <membro> ... </membro>
   *        </organo>
   *      </regione>
   *      <provincia>
   *        <organo tipo="giunta">
   *          <membro> ... </membro>
   *        </organo>
   *        <organo tipo="consiglio">
   *          <membro> ... </membro>
   *        </organo>
   *      </provincia>
   *      <comune>
   *        <organo tipo="giunta">
   *          <membro> ... </membro>
   *        </organo>
   *        <organo tipo="consiglio">
   *          <membro> ... </membro>
   *        </organo>
   *      </comune>
   *    </op:content>
   *  </oprcs>
   *
   * Return error in case something's wrong
   * <oprcs xlmns="http://www.openpolis.it/2010/oprcs"
   *        xmlns:op="http://www.openpolis.it/2010/op"
   *        xlmns:op_location="http://www.openpolis.it/2010/op_location"
   *        xmlns:op_politician="http://www.openpolis.it/2010/op_politician">
   *   <op:error>Messaggio di errore</op:error>
   * </oprcs>
   * @return String
   * @author Guglielmo Celata
   **/
  public function executeRepresentativesFindByCity()
  {
    $key = $this->getRequestParameter('key');
    $istat_code = $this->getRequestParameter('istat_code');

    $is_valid_key = deppApiKeysPeer::isValidKey($key);

    $resp_node = new SimpleXMLExtended(
      '<oprcs xmlns="'.$this->oprcs_ns.'" '.
            ' xmlns:op="'.$this->op_ns.'" '.
            ' xmlns:op_location="'.$this->op_location_ns.'" '.
            ' xmlns:op_politician="'.$this->op_politician_ns.'" '.
            ' xmlns:xlink="'.$this->xlink_ns.'" >'.
      '</oprcs>');

    if ($is_valid_key)
    {
      try {
        $location = OpLocationPeer::retrieveByTypeAndIstatCode("comune", $istat_code);        
      } catch (sfDatabaseException $dbe) {
        $location = null;
      }
      
      if ($location instanceof OpLocation)
      {
        // getch provincia and regione as OpLocation objects
    		$prov = $location->getProvincia();
    		$region = $location->getRegione();

    		// fetch data regarding representatives, gathered in hash arrays
    		$europarlamento = $location->getRappresentanzaEuroparlamento($prov->getId());
    		$camera = $location->getRappresentanzaCamera($prov->getId());
    		$senato = $location->getRappresentanzaSenato($prov->getId());
    		$regione = $location->getRappresentanzaRegione($region->getId());
    		$provincia = $location->getRappresentanzaProvincia($prov->getId());
    		$comune = $location->getRappresentanzaComune();

        // total number of representatives
     		$n_totale_rappresentanti = 
     		   $europarlamento['n_rappresentanti'] + $camera['n_rappresentanti'] + $senato['n_rappresentanti'] +
     		   $regione['n_rappresentanti'] + $provincia['n_rappresentanti'] + $comune['n_rappresentanti'];
    		
    		// start producing xml
        $content_node = $resp_node->addChild('op:content', null, $this->op_ns); 
        $location_node = $this->addLocationAsChild('localita', $location, $content_node);
        $location_node->addAttribute('n_totale_rappresentanti', $n_totale_rappresentanti);

        $euro_node = $location_node->addChild('europarlamento');
        $euro_node->addAttribute('n_rappresentanti', $europarlamento['n_rappresentanti']);
        $euro_node->addChild('circoscrizione', $europarlamento['circoscrizione']->getOpConstituency()->getName());
        $this->addCharges($europarlamento['rappresentanti'], $euro_node);

        $camera_node = $location_node->addChild('camera');
        $camera_node->addAttribute('n_rappresentanti', $camera['n_rappresentanti']);
        $camera_node->addChild('circoscrizione', $camera['circoscrizione']->getOpConstituency()->getName());
        $this->addCharges($camera['rappresentanti'], $camera_node);
        
        $senato_node = $location_node->addChild('senato');
        $senato_node->addAttribute('n_rappresentanti', $senato['n_rappresentanti']);
        $senato_node->addChild('circoscrizione', $senato['circoscrizione']->getOpConstituency()->getName());
        $this->addCharges($senato['rappresentanti'], $senato_node);
        

        $regione_node = $location_node->addChild('regione');
        $regione_node->addAttribute('n_rappresentanti', $regione['n_rappresentanti']);
        $organ_node = $regione_node->addChild('organo');
        $organ_node->addAttribute('tipo', 'giunta');
        $this->addCharges($regione['commissario'], $organ_node);
        $this->addCharges($regione['presidente_giunta'], $organ_node, 'giunta', 'regione');
        $this->addCharges($regione['giunta'], $organ_node, 'giunta', 'regione');
        $organ_node = $regione_node->addChild('organo');
        $organ_node->addAttribute('tipo', 'consiglio');
        $this->addCharges($regione['presidente_consiglio'], $organ_node, 'consiglio', 'regione');
        $this->addCharges($regione['consiglio'], $organ_node, 'consiglio', 'regione');


        $provincia_node = $location_node->addChild('provincia');
        $provincia_node->addAttribute('n_rappresentanti', $provincia['n_rappresentanti']);
        $organ_node = $provincia_node->addChild('organo');
        $organ_node->addAttribute('tipo', 'giunta');
        $this->addCharges($provincia['commissario'], $organ_node);
        $this->addCharges($provincia['presidente_giunta'], $organ_node, 'giunta', 'provincia');
        $this->addCharges($provincia['giunta'], $organ_node, 'giunta', 'provincia');
        $organ_node = $provincia_node->addChild('organo');
        $organ_node->addAttribute('tipo', 'consiglio');
        $this->addCharges($provincia['presidente_consiglio'], $organ_node, 'consiglio', 'provincia');
        $this->addCharges($provincia['consiglio'], $organ_node, 'consiglio', 'provincia');


        $comune_node = $location_node->addChild('comune');
        $comune_node->addAttribute('n_rappresentanti', $comune['n_rappresentanti']);


        $fc = new sfMemcacheFunctionCache();

        $statistiche_node = $comune_node->addChild('statistiche');
        $sex_node = $statistiche_node->addChild('sesso');
        $sex_statistics = OpInstitutionChargePeer::getLocationSexStatistics($location->getId());
        $total_sex_statistics = $fc->call('OpInstitutionChargePeer::getLocationSexStatistics');

        $male_node = $sex_node->addChild('uomini');
        $female_node = $sex_node->addChild('donne');
        $n_males = 0;
        $n_females = 0;
        if (array_key_exists('m', $sex_statistics))
          $n_males = $sex_statistics['m'];
        if (array_key_exists('f', $sex_statistics))
          $n_females = $sex_statistics['f'];
        $n_all = $comune['n_rappresentanti'];
        $perc_males = number_format(100.0 * $n_males / $n_all, 2);
        $perc_females = number_format(100.0 * $n_females / $n_all, 2);

        $n_tot_males = $total_sex_statistics['m'];
        $n_tot_females = $total_sex_statistics['f'];
        $n_tot_all = $n_tot_males + $n_tot_females;
        $perc_tot_males = number_format(100.0 * $n_tot_males / $n_tot_all, 2);
        $perc_tot_females = number_format(100.0 * $n_tot_females / $n_tot_all, 2);

        $male_node->addAttribute('n', $n_males);
        $male_node->addAttribute('perc', $perc_males);
        $female_node->addAttribute('n', $n_females);
        $female_node->addAttribute('perc', $perc_females);

        $male_node->addAttribute('n_tot', $n_tot_males);
        $male_node->addAttribute('perc_tot', $perc_tot_males);
        $female_node->addAttribute('n_tot', $n_tot_females);
        $female_node->addAttribute('perc_tot', $perc_tot_females);

        $age_node = $statistiche_node->addChild('eta');
        $age_statistics = $fc->call('OpInstitutionChargePeer::getLocationAgeStatistics', $location->getId());
        $total_age_statistics = $fc->call('OpInstitutionChargePeer::getLocationAgeStatistics');

        $age_node->addAttribute('media', number_format($age_statistics['age_avg'], 2));
        $age_node->addAttribute('media_totale', number_format($total_age_statistics['age_avg'], 2));

        $edu_node = $statistiche_node->addChild('livello_studio');
        $edu_statistics = $fc->call('OpInstitutionChargePeer::getLocationEduStatistics', $location->getId());
        $total_edu_statistics = $fc->call('OpInstitutionChargePeer::getLocationEduStatistics');

        $non_laureati_node = $edu_node->addChild('non_laureati');
        $laureati_node = $edu_node->addChild('laureati');
        $n_non_laureati = $edu_statistics['non_laureati'];
        $n_laureati = $edu_statistics['laureati'];
        $n_all = $comune['n_rappresentanti'];
        $perc_non_laureati = number_format(100.0 * $n_non_laureati / $n_all, 2);
        $perc_laureati = number_format(100.0 * $n_laureati / $n_all, 2);

        $n_tot_non_laureati = $total_edu_statistics['non_laureati'];
        $n_tot_laureati = $total_edu_statistics['laureati'];
        $n_tot_all = $n_tot_non_laureati + $n_tot_laureati;
        $perc_tot_non_laureati = number_format(100.0 * $n_tot_non_laureati / $n_tot_all, 2);
        $perc_tot_laureati = number_format(100.0 * $n_tot_laureati / $n_tot_all, 2);

        $non_laureati_node->addAttribute('n', $n_non_laureati);
        $non_laureati_node->addAttribute('perc', $perc_non_laureati);
        $laureati_node->addAttribute('n', $n_laureati);
        $laureati_node->addAttribute('perc', $perc_laureati);

        $non_laureati_node->addAttribute('n_tot', $n_tot_non_laureati);
        $non_laureati_node->addAttribute('perc_tot', $perc_tot_non_laureati);
        $laureati_node->addAttribute('n_tot', $n_tot_laureati);
        $laureati_node->addAttribute('perc_tot', $perc_tot_laureati);

        
        $organ_node = $comune_node->addChild('organo');
        $organ_node->addAttribute('tipo', 'giunta');
        $this->addCharges($comune['commissario'], $organ_node);
        $this->addCharges($comune['presidente_giunta'], $organ_node, 'giunta', 'comune');
        $this->addCharges($comune['giunta'], $organ_node, 'giunta', 'comune');
        $organ_node = $comune_node->addChild('organo');
        $organ_node->addAttribute('tipo', 'consiglio');
        $this->addCharges($comune['presidente_consiglio'], $organ_node, 'consiglio', 'comune');
        $this->addCharges($comune['consiglio'], $organ_node, 'consiglio', 'comune');

      }
      else 
      {
        $resp_node->addChild('op:error', 'Località inesistente', $this->op_ns);        
      }
      
    } 
    else 
    {
      $resp_node->addChild('op:error', 'Chiave di accesso non valida', $this->op_ns);
    }

    $xmlContent = $resp_node->asXML();
    $this->_send_output($xmlContent);
    return sfView::NONE;
  }




  /**
   * API (protected by an API key)
   * torna flusso xml di tutti i politici con incarichi attuali nella location
   * progetto op_rcs_reg10
   *
   *  <oprcs xmlns="http://www.openpolis.it/2010/oprcs"
   *         xmlns:op="http://www.openpolis.it/2010/op"
   *         xmlns:op_location="http://www.openpolis.it/2010/op_location"
   *         xmlns:op_politician="http://www.openpolis.it/2010/op_politician"
   *         xmlns:xlink="http://www.w3.org/1999/xlink">
   *    <op:content> 
   *      <localita tipo="Regione" op_location:istat="12">
   *        <nome>Lazio</nome>
   *        <organo tipo="giunta">
   *          <membro op_politician:content_id="1650" tipo="vicepresidente" xlink:href="politici/1650.xml">
   *            <nome>Esterino</nome>
   *            <cognome>Montino</cognome>
   *            <carica>Vice presidente</carica>
   *            <partito acronimo="PD">Partito Democratico</partito>
   *          </membro>
   *        </organo>
   *        <organo tipo="consiglio">
   *        </organo>
   *      </localita>
   *    </op:content>
   *  </oprcs>
   *
   * Return error in case something's wrong
   * <oprcs xlmns="http://www.openpolis.it/2010/oprcs"
   *        xmlns:op="http://www.openpolis.it/2010/op"
   *        xlmns:op_location="http://www.openpolis.it/2010/op_location"
   *        xmlns:op_politician="http://www.openpolis.it/2010/op_politician">
   *   <op:error>Messaggio di errore</op:error>
   * </oprcs>
   * @return String
   * @author Guglielmo Celata
   **/
  public function executePoliticiansFindByLocation()
  {
    $key = $this->getRequestParameter('key');
    $location_type = $this->getRequestParameter('location_type');
    $istat_code = $this->getRequestParameter('istat_code');

    $is_valid_key = deppApiKeysPeer::isValidKey($key);

    $resp_node = new SimpleXMLExtended(
      '<oprcs xmlns="'.$this->oprcs_ns.'" '.
            ' xmlns:op="'.$this->op_ns.'" '.
            ' xmlns:op_location="'.$this->op_location_ns.'" '.
            ' xmlns:op_politician="'.$this->op_politician_ns.'" '.
            ' xmlns:xlink="'.$this->xlink_ns.'" >'.
      '</oprcs>');

    if ($is_valid_key)
    {
      try {
        $location = OpLocationPeer::retrieveByTypeAndIstatCode($location_type, $istat_code);        
      } catch (sfDatabaseException $dbe) {
        $location = null;
      }
      
      if ($location instanceof OpLocation)
      {
        $content_node = $resp_node->addChild('op:content', null, $this->op_ns);
        $location_node = $this->addLocationAsChild('localita', $location, $content_node);
        $location_type_initial = substr(strtoupper($location_type), 0, 1);
        $institutions_codes = array('giunta' => sfConfig::get('app_institution_id_G' . $location_type_initial), 
                                    'consiglio' => sfConfig::get('app_institution_id_C' . $location_type_initial));

        foreach ($institutions_codes as $inst_name => $inst_code) {
          $organ_node = $location_node->addChild('organo');
          $organ_node->addAttribute('tipo', $inst_name);
          $organ_members = OpInstitutionChargePeer::fetchOrganMembers($inst_code, $location->getId());
          $organ_node->addAttribute('n_members', count($organ_members));

          $this->addCharges($organ_members, $organ_node, $inst_name, $location_type);
        }

      }
      else 
      {
        $resp_node->addChild('op:error', 'Località inesistente', $this->op_ns);        
      }
      
    } 
    else 
    {
      $resp_node->addChild('op:error', 'Chiave di accesso non valida', $this->op_ns);
    }

    $xmlContent = $resp_node->asXML();
    $this->_send_output($xmlContent);
    return sfView::NONE;
  }



  /**
   * API (protected by an API key)
   * torna flusso xml della scheda di un politico: link immagine + anagrafica + carriera
   * progetto op_rcs_reg10
   *
   *  <oprcs xmlns="http://www.openpolis.it/2010/oprcs"
   *         xmlns:op="http://www.openpolis.it/2010/op"
   *         xmlns:op_location="http://www.openpolis.it/2010/op_location"
   *         xmlns:op_politician="http://www.openpolis.it/2010/op_politician"
   *         xmlns:xlink="http://www.w3.org/1999/xlink">
   *    <op:content> 
   *      <politico op_politician:content_id="1650">
   *        <immagine
   *          xmlns:xlink="http://www.w3.org/1999/xlink"
   *          xlink:href="immagini/1572.jpg"
   *          width="180"
   *          height="240"/>
   *        <anagrafica>
   *          <nome>Roberto</nome>
   *          <cognome>Formigoni</cognome>
   *          <data_nascita>30/03/1947</data_nascita>
   *          <sesso>M</sesso>
   *          <luogo_nascita prov="LC">Lecco</luogo_nascita>
   *          <grado_istruzione>Laurea (Filosofia)</grado_istruzione>
   *          <professione>Giornalista</professione>
   *        </anagrafica>
   *        <risorse>
   *          <email>r.formigoni@splinder.it</email>
   *          <url href="http://www.robertoformigoni.it">Blog Personale</url>
   *        </risorse>
   *        <carriera>
   *          <istituzioni>
   *            <carica data_inizio="05/04/2005" data_fine="" istituzione="Giunta">
   *              <partito>CEN-DES(LS.CIVICHE)</partito>
   *              <localita tipo="Regione" op_location:istat_code="3">Lombardia</localita>
   *              <descrizione>Pres. Giunta</descrizione>
   *            </carica>
   *          </istituzioni>
   *          <partiti>
   *            <carica data_inizio="05/04/2005" data_fine="" istituzione="Giunta">
   *              <partito>CEN-DES(LS.CIVICHE)</partito>
   *              <localita tipo="Regione" op_location:istat_code="3">Lombardia</localita>
   *              <descrizione>Pres. Giunta</descrizione>
   *            </carica>
   *          </partiti>
   *          <organizzazioni>
   *            <carica data_inizio="05/04/2005" data_fine="" istituzione="Giunta">
   *              <partito>CEN-DES(LS.CIVICHE)</partito>
   *              <localita tipo="Regione" op_location:istat_code="3">Lombardia</localita>
   *              <descrizione>Pres. Giunta</descrizione>
   *            </carica>
   *          </organizzazioni>
   *        </carriera>
   *      </politico>
   *    </op:content>
   *  </oprcs>
   *
   * Return error in case something's wrong
   * <oprcs xlmns="http://www.openpolis.it/2010/oprcs"
   *        xmlns:op="http://www.openpolis.it/2010/op"
   *        xlmns:op_location="http://www.openpolis.it/2010/op_location"
   *        xmlns:op_politician="http://www.openpolis.it/2010/op_politician">
   *   <op:error>Messaggio di errore</op:error>
   * </oprcs>
   * @return String
   * @author Guglielmo Celata
   **/
  public function executePoliticianCareer()
  {
    $key = $this->getRequestParameter('key');
    $politician_id = $this->getRequestParameter('politician_id');

    $is_valid_key = deppApiKeysPeer::isValidKey($key);

    $resp_node = new SimpleXMLExtended(
      '<oprcs xmlns="'.$this->oprcs_ns.'" '.
            ' xmlns:op="'.$this->op_ns.'" '.
            ' xmlns:op_location="'.$this->op_location_ns.'" '.
            ' xmlns:op_politician="'.$this->op_politician_ns.'" '.
            ' xmlns:xlink="'.$this->xlink_ns.'" >'.
      '</oprcs>');

    if ($is_valid_key)
    {
      $politician = OpPoliticianPeer::retrieveByPK($politician_id);
      
      if ($politician instanceof OpPolitician)
      {
        $content_node = $resp_node->addChild('op:content', null, $this->op_ns);
        $politician_node = $content_node->addChild('politico', null, $this->oprcs_ns);
        $politician_node->addAttribute('op_politician:content_id', $politician->getContentId(), $this->op_politician_ns);

        if ($politician->getPicture()) {
          $image = imagecreatefromstring($politician->getPicture());
    	    $width = imagesx($image);
    	    $height = imagesy($image);
          $images_path = "politici/immagini";

          $image_node = $politician_node->addChild('immagine');
          $image_node->addAttribute('xlink:href', "$images_path/$politician_id.jpg", $this->xlink_ns);
          $image_node->addAttribute('width', $width);
          $image_node->addAttribute('height', $height);
        }

        $anagraphic_node = $politician_node->addChild('anagrafica');
        $nome_node = $anagraphic_node->addChild('nome', null);
        $nome_node->addCData($politician->getFirstName());
        $cognome_node = $anagraphic_node->addChild('cognome', null);
        $cognome_node->addCData($politician->getLastName());
        $anagraphic_node->addChild('sesso', $politician->getSex());
        $anagraphic_node->addChild('data_nascita', $politician->getBirthDate('d/m/Y'));

        $luogo_nascita = $politician->getBirthLocation();
        $luogo_nascita = preg_replace('/(.*)\((.*)\)/', '${1},${2}', $luogo_nascita);
        list($comune, $prov) = split(",", $luogo_nascita);
        $birthplace_node = $anagraphic_node->addChild('luogo_nascita', trim($comune));
        if (isset($prov))
          $birthplace_node->addAttribute('prov', $prov);

        if ($politician->getProfessionId() != NULL)
          $profession = (string)$politician->getOpProfession();
        else
          $profession = 'non inserita';
        $anagraphic_node->addChild('professione', $profession);

        $education = $politician->getEducationLevel();
        if ($education)
        {
          $education_level = $education->getOpEducationLevel()->getDescription();
          if ($education->getDescription() != '')
          {
            $description = $education->getDescription();	
            if (!in_array($description, 
                          array('LAUREA', 
                                'LICENZA DI SCUOLA MEDIA SUPERIORE O TITOLI EQUIPOLLENTI',
                                'LICENZA DI SCUOLA MEDIA INFERIORE O TITOLI EQUIPOLLENTI',
                                'LICENZA ELEMENTARE',
                                'TITOLI O DIPLOMI PROFESSIONALI POST LICENZA ELEMENTARE',
                                'TITOLI O DIPLOMI PROFESSIONALI POST MEDIA INFERIORE'))) 
            {
              $education_level .= " ($description)";
            }          
          }
        }	else
          $education_level = 'non inserito';
        $education_node = $politician_node->addChild('grado_istruzione', $education_level);


        $resources_node = $politician_node->addChild('risorse');
        $resources = $politician->getResourcesInsertedByStaff();
        if (count($resources))
        {
          foreach ($resources as $resource) {
            $resource_type = $resource->getOpResourcesType()->getResourceType();

            $res_type_short = 'url';
            if (strpos($resource_type, 'Email'))
              $res_type_short = 'email';
            
            $res_node = $resources_node->addChild($res_type_short, $resource->getDescrizione());
            $res_node->addAttribute('type', $resource_type);
            $res_node->addAttribute('href', $resource->getValore());        
          }
        }


        $cariche_attuali = $politician->getPublicInstitutionCharges('current');
        $cariche_passate = $politician->getPublicInstitutionCharges('past');

        $cariche_politiche_attuali = $politician->getPublicPoliticalCharges('current');
        $cariche_politiche_passate = $politician->getPublicPoliticalCharges('past');

        $cariche_organizzative_attuali = $politician->getPublicOrganizationCharges('current');
        $cariche_organizzative_passate = $politician->getPublicOrganizationCharges('past');
        
        if (count($cariche_attuali) + count($cariche_passate) +
            count($cariche_politiche_attuali) + count($cariche_politiche_passate) +
            count($cariche_organizzative_attuali) + count($cariche_organizzative_passate) > 0) {
          $career_node = $politician_node->addChild('carriera');

          if (count($cariche_attuali) + count($cariche_passate) > 0) {
            $institution_node = $career_node->addChild('istituzioni');
          }
          if (count($cariche_attuali))
            $this->addCaricheIstituzionaliAsChild('cariche_attuali', $cariche_attuali, $institution_node);
          if (count($cariche_passate))
            $this->addCaricheIstituzionaliAsChild('cariche_passate', $cariche_passate, $institution_node); 


          if (count($cariche_politiche_attuali) + count($cariche_politiche_passate) > 0) {
            $political_node = $career_node->addChild('partiti');
          }
          if (count($cariche_politiche_attuali))
            $this->addCarichePoliticheAsChild('cariche_attuali', $cariche_politiche_attuali, $political_node);

          if (count($cariche_politiche_passate))
            $this->addCarichePoliticheAsChild('cariche_passate', $cariche_politiche_passate, $political_node); 


          if (count($cariche_organizzative_attuali) + count($cariche_organizzative_passate) > 0) {
            $organization_node = $career_node->addChild('organizzazioni');
          }
          if (count($cariche_organizzative_attuali))
            $this->addCaricheOrganizzativeAsChild('cariche_attuali', $cariche_organizzative_attuali, $organization_node);

          if (count($cariche_organizzative_passate))
            $this->addCaricheOrganizzativeAsChild('cariche_passate', $cariche_organizzative_passate, $organization_node); 
          
        }
        
      }
      else
      {
        $resp_node->addChild('op:error', 'Politico inesistente', $this->op_ns);        
      }    
      
    } 
    else 
    {
      $resp_node->addChild('op:error', 'Chiave di accesso non valida', $this->op_ns);
    }

    $xmlContent = $resp_node->asXML();
    $this->_send_output($xmlContent);   
    return sfView::NONE;
  }


  public function addCharges($charges, $node, $organ = null, $location_type = null)
  {

    foreach ($charges as $member) {
      $member_node = $node->addChild('membro');
      $member_node->addAttribute('op_politico:content_id', $member->getPoliticianId(), $this->op_politician_ns);
      $member_node->addAttribute('xlink:href', 'politici/'.$member->getPoliticianId().'.xml', $this->xlink_ns);
      $member_type = $member->getOpChargeType()->getName();
      if ( $member_type == 'Commissario' || $member_type == 'Presidente' || $member_type == 'Vicepresidente' ) {
        $member_node->addAttribute('tipo', $member_type);
      }

      $member_node->addChild('nome', html_entity_decode($member->getOpPolitician()->getFirstName(), ENT_COMPAT, 'UTF-8'));
      $member_node->addChild('cognome', html_entity_decode($member->getOpPolitician()->getLastName(), ENT_COMPAT, 'UTF-8'));

      $charge_descr = $member_type;
      if ($member->getChargeTypeId() == sfConfig::get('app_charge_type_id_assessore'))
      {
        $charge_descr .= " " . $member->getDescription();
      }
      
      if ($charge_descr == 'Presidente') {
        $charge_descr = Text::getCaricaPresidente($organ, $location_type);
      }
      
      if ($charge_descr == 'Vicepresidente') 
      {
        if ($organ == 'giunta')
          $charge_descr .= ' della Giunta ';          
        else
          $charge_descr .= ' del Consiglio ';

        switch ($location_type)
        {
          case 'regione':
            $charge_descr .= 'Regionale';
            break;
          case 'provincia':
            $charge_descr .= 'Provinciale';
            break;
          case 'comune':
            $charge_descr .= 'Comunale';
            break;
        }
        
        
      }

      if ($charge_descr != 'Consigliere')
      {
        $charge_node = $member_node->addChild('carica');
        $charge_node->addCData($charge_descr);        
      }

      $member_node->addChild('data', $member->getDateStart('d/m/Y'));

      if ($member->getPartyId() != '1') {
        $party_node = $member_node->addChild('partito', $member->getOpParty()->getName());
        $acronimo = $member->getOpParty()->getAcronym();
        if ($acronimo != "") {
          $party_node->addAttribute('acronimo', $acronimo);
        }
      } 

      if ($member->getGroupId() != '1') {
        $group_node = $member_node->addChild('gruppo', $member->getOpGroup()->getName());
        $acronimo = $member->getOpGroup()->getAcronym();
        if ($acronimo != "") {
          $group_node->addAttribute('acronimo', $acronimo);
        }
      } 

    }
    
  }


  /**
   * API (protected by an API key)
   * ritorna SI o NO, se per il ppolitico è presente un'immagine nel DB
   * progetto op_rcs_reg10
   *
   *  <oprcs xmlns="http://www.openpolis.it/2010/oprcs"
   *         xmlns:op="http://www.openpolis.it/2010/op"
   *         xmlns:op_location="http://www.openpolis.it/2010/op_location"
   *         xmlns:op_politician="http://www.openpolis.it/2010/op_politician"
   *         xmlns:xlink="http://www.w3.org/1999/xlink">
   *    <op:content>SI | NO</op:content>
   *  </oprcs>
   *
   * Return error in case something's wrong
   * <oprcs xlmns="http://www.openpolis.it/2010/oprcs"
   *        xmlns:op="http://www.openpolis.it/2010/op"
   *        xlmns:op_location="http://www.openpolis.it/2010/op_location"
   *        xmlns:op_politician="http://www.openpolis.it/2010/op_politician">
   *   <op:error>Messaggio di errore</op:error>
   * </oprcs>
   * @return String
   * @author Guglielmo Celata
   **/
  public function executeHasPolImage()
  {

    $key = $this->getRequestParameter('key');
    $politician_id = $this->getRequestParameter('politician_id');

    $is_valid_key = deppApiKeysPeer::isValidKey($key);

    $resp_node = new SimpleXMLElement(
      '<oprcs xmlns="'.$this->oprcs_ns.'" '.
            ' xmlns:op="'.$this->op_ns.'" '.
            ' xmlns:op_location="'.$this->op_location_ns.'" '.
            ' xmlns:op_politician="'.$this->op_politician_ns.'" '.
            ' xmlns:xlink="'.$this->xlink_ns.'" >'.
      '</oprcs>');

    if ($is_valid_key)
    {
      $politician = OpPoliticianPeer::retrieveByPK($politician_id);
      if (!$politician)
        $resp_node->addChild('op:error', 'Politico inesistente', $this->op_ns);
        
      else
      {
        if ($politician->getPicture())
          $content_node = $resp_node->addChild('op:content', 'SI', $this->op_ns);
        else
          $content_node = $resp_node->addChild('op:content', 'NO', $this->op_ns);        
      }
    } else {
      $resp_node->addChild('op:error', 'Chiave di accesso non valida', $this->op_ns);
    }


    $xmlContent = $resp_node->asXML();
    $this->_send_output($xmlContent);   
    return sfView::NONE;

  }


  /**
   * API (protected by an API key)
   * get location partial name and optional location type and return
   * an XML stream containing all locations satysfing the query
   *
   * <openpolis_response>
   *   <locations number="2">
   *     <location id="5132" type="comune" prov="RM">Roma</location>
   *     <location id="3144" type="comune" prov="VT">Oriolo Romano</location>
   *   </locations>
   * </openpolis_response>
   *
   * Return error in case something's wrong
   * @return String
   * @author Guglielmo Celata
   **/
  public function executeLocationFindByName()
  {
    $key = $this->getRequestParameter('key');
    $loc_query = $this->getRequestParameter('loc_query');
    $loc_type = $this->getRequestParameter('loc_type');

    $this->forward404Unless($key);
    $this->forward404Unless($loc_query);
    $this->forward404Unless($loc_type);

    $is_valid_key = deppApiKeysPeer::isValidKey($key);

    $resp_node = new SimpleXMLElement('<openpolis_response></openpolis_response>');

    if ($is_valid_key)
    {
      $query = strip_tags(strtolower(trim($loc_query)));
      $unspaced_query = str_replace(array(" ", "-", "'"), "", $query);
      $c_query  = "+(location_name_sort:" .$unspaced_query ."*^5.0";
      $c_query .= "  location_name:" . $query . "^3.0";
      $c_query .= "  location_name:" . $query . "*" . ")";
      if (trim($loc_type) != '')
        $c_query .= " +location_type_s: $loc_type";  
      $this->c_query = $c_query;    
      
      try {
        $locations = $this->_doSearch($c_query, 0, 10);        
        $locations_node = $resp_node->addChild('locations');
        $locations_node->addAttribute('number', count($locations));
        foreach ($locations as $location)
        {
          $loc_node = $locations_node->addChild('location', $location->location_name);
          $loc_node->addAttribute('id', $location->loc_id);
          $loc_node->addAttribute('type', $location->location_type_s);
          if ($location->location_type_s == 'Comune')
            $loc_node->addAttribute('prov', $location->prov_us);
        }

      } catch (Exception $e) {
        $resp_node->addChild('error', $e->getMessage());
      }

    } else {
      $resp_node->addChild('error', 'Chiave di accesso non valida');
    }


    $this->xmlContent = $resp_node->asXML();

    $this->response->setContentType('text/xml; charset=utf-8');
    $this->response->setHttpHeader('Content-Length: ',  strlen($this->xmlContent));
    $this->setLayout(false);
        
  }
  
  /**
   * 
   * effettua una ricerca di una query, con offset e limit specificati
   * setta le meta-variabili per la vista (status, QTime, numFound)
   * 
   * @return array con i risultati
   * @author Guglielmo
   **/
  private function _doSearch($query, $offset, $limit)
  {
    try
    {
      require_once('Apache/Solr/Service.php');
      $solr = new Apache_Solr_Service('localhost', 8080, '/solr_op');
      
      // effettua la ricerca
      $this->docs = array();
      $response = $solr->search($query, $offset, $limit, array("fl"=>"*,score"));
      $this->status = $response->responseHeader->status;
      $this->QTime = $response->responseHeader->QTime;
      $numFound = $response->response->numFound;
      if ($numFound > 0)
      {
        $this->doc_number = $response->response->start;
        $this->docs = $response->response->docs;
      }
      
      return $this->docs;      

    } catch (Exception $e) { 
      throw new Exception($e->getMessage()); 
    }    
    
  }
  

  /**
   * API (protected by an API key)
   * get a list of politicians with given first and last name
   * as an XML stream
   *
   * <openpolis_response itemCount="2">
   *   <people>
   *     <person id="325132">
   *       <name>Mario</name>
   *       <surname>Rossi</surname>
   *       <birthdate format='gg/mm/aa'>25/05/1968</birthdate>
   *     </person>
   *     <person id="314432">
   *       <name>Mario</name>
   *       <surname>Rossi</surname>
   *       <birthdate format='gg/mm/aa'>20/12/2008</birthdate>
   *     </person>
   *   </people>
   * </openpolis_response>
   *
   * Return error in case something's wrong
   * @return String
   * @author Guglielmo Celata
   **/
   
  public function executePoliticianFindByName()
  {
    $key = $this->getRequestParameter('key');
    $nome = $this->getRequestParameter('nome');
    $cognome = $this->getRequestParameter('cognome');

    $this->forward404Unless($key);
    $this->forward404Unless($nome);
    $this->forward404Unless($cognome);
    
    $is_valid_key = deppApiKeysPeer::isValidKey($key);

    $resp_node = new SimpleXMLElement('<openpolis_response></openpolis_response>');


    if ($is_valid_key)
    {

      $c = new Criteria();
      $c->add(OpPoliticianPeer::FIRST_NAME, $nome);
      $c->add(OpPoliticianPeer::LAST_NAME, $cognome);
      $politici = OpPoliticianPeer::doSelect($c);
      $n_politici = count($politici);

      $resp_node->addAttribute('itemCount', $n_politici);
      $people_node = $resp_node->addChild('people');

      foreach ($politici as $politico)
      {
        $person_node = $people_node->addChild('person');
        $person_node->addAttribute('id', $politico->getContentId());

        $person_node->addChild('name', ucfirst(strtolower($politico->getFirstName())));
        $person_node->addChild('surname', ucfirst(strtolower($politico->getLastName())));
        $person_node->addChild('birthdate', $politico->getBirthDate('d/m/Y'));   
        $person_node->birthdate->addAttribute('format', 'gg/mm/aaaa');   
      }

      
    } else {
      
      $resp_node->addChild('error', 'Chiave di accesso non valida');

    }


    $this->xmlContent = $resp_node->asXML();

    $this->response->setContentType('text/xml; charset=utf-8');
    $this->response->setHttpHeader('Content-Length: ',  strlen($this->xmlContent));
    $this->setLayout(false);
    

  }
  
  public function executeChargeFindByPolitician()
  {
    sfLoader::loadHelpers(array('Url','Tag'));
    $key = $this->getRequestParameter('key');
    $id = $this->getRequestParameter('id');
   

    $this->forward404Unless($key);
    $this->forward404Unless($id);
    
    
    $is_valid_key = deppApiKeysPeer::isValidKey($key);

    $resp_node = new SimpleXMLElement('<openpolis_response></openpolis_response>');

    
    if ($is_valid_key)
    {

      $c = new Criteria();
      $c->add(OpInstitutionChargePeer::POLITICIAN_ID,$id);
      $c->add(OpInstitutionChargePeer::DATE_END, NULL, Criteria::EQUAL);
      $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
      $c->addJoin(OpInstitutionChargePeer::INSTITUTION_ID, OpInstitutionPeer::ID, Criteria::LEFT_JOIN);
      $c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
      $c->addAscendingOrderByColumn(OpInstitutionPeer::PRIORITY);
      $cariche = OpInstitutionChargePeer::doSelect($c);

      foreach ($cariche as $carica) 
      {
      	if ($carica->getChargeTypeId()!==5 && $carica->getChargeTypeId()!=6 && $carica->getChargeTypeId()!=20 && $carica->getChargeTypeId()!=21)
      	
      	{
      	  $descrizione= $carica->getOpChargeType()->getName();
      	  if ($carica->getDescription()!=NULL) $descrizione .= " ".$carica->getDescription();
      	  if ($carica->getOpInstitution()->getShortName()!=NULL)
      	  {
      	      $descrizione .= " ".$carica->getOpInstitution()->getShortName();
      	      if ($carica->getOpLocation()->getName()!='Italia') $descrizione .=" ".$carica->getOpLocation()->getName();    
      	      if ($carica->getOpLocation()->getProv()!=NULL) $descrizione .=" (".$carica->getOpLocation()->getProv().")";
      	  }    
          $carica_node = $resp_node->addChild('description',$descrizione);
        }  
      }

      
    } else {
      
      $resp_node->addChild('error', 'Chiave di accesso non valida');
      
    }


    $this->xmlContent = $resp_node->asXML();

    $this->response->setContentType('text/xml; charset=utf-8');
    $this->response->setHttpHeader('Content-Length: ',  strlen($this->xmlContent));
    $this->setLayout(false);
    
  }
  
  
  public function executeGetPolImage()
  {
    $this->politician = OpPoliticianPeer::RetrieveByPk($this->getRequestParameter('id'));
    
    if (!$this->politician)
      $image = '';
    else
      $image = $this->politician->getPicture();

    $this->setLayout(false);    
    $this->response->setContentType('image/jpeg');
    $this->response->setContent($image);
    return sfView::NONE;
  }
  
  public function executePolitician()
  {
    $this->politician = OpPoliticianPeer::RetrieveByPk($this->getRequestParameter('id'));
    $this->img_url = sfConfig::get('app_feed_link').'politician/picture?content_id='.$this->getRequestParameter('id');
    if (!$this->politician)
    {
      $this->error_code    = 1;
      $this->error_message = 'nessun politico selezionato';
      $this->forward('api', 'error');
    }
  }
    
  public function executeParliamentary()
  {
    $this->politician = OpPoliticianPeer::RetrieveByPk($this->getRequestParameter('id'));
    $this->img_url = sfConfig::get('app_feed_link').'politician/picture?content_id='.$this->getRequestParameter('id');
	  if ($this->politician != null)
	  {
      $c = new Criteria();
      $c->Add(OpInstitutionChargePeer::POLITICIAN_ID, $this->getRequestParameter('id'), Criteria::EQUAL);
      
      $criterion = $c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CD'), Criteria::EQUAL);
      $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_SR'), Criteria::EQUAL));
      $c->add($criterion);
      
      $criterion = $c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_deputato'), Criteria::EQUAL);
      $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore'), Criteria::EQUAL));
      $c->add($criterion);

      $c->addAscendingOrderByColumn(OpInstitutionChargePeer::DATE_END);
      $this->institution_charges = OpInstitutionChargePeer::doSelect($c); 
    }
    else
    {
      $this->error_code    = 1;
      $this->error_message = 'nessun politico selezionato';
      $this->forward('api', 'error');
    }
  }

  public function executeSenatori()
  {
    $c = new Criteria();
    $c->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_deputato'), Criteria::EQUAL);
    $c->Add(OpInstitutionChargePeer::DATE_START, '2008-04-28' , Criteria::GREATER_EQUAL);
    $c->Add(OpInstitutionChargePeer::DATE_END, NULL , Criteria::EQUAL);
    $this->institution_charges = OpInstitutionChargePeer::doSelect($c); 
  }
  
  public function executeParlamentariInCarica()
  {
    $c = new Criteria();
     $criterion = $c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CD'), Criteria::EQUAL);
     $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_SR'), Criteria::EQUAL));
     $c->add($criterion);
    if ($this->getRequestParameter('ramo')=='C')
    {
      $c->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_deputato'), Criteria::EQUAL);
    }  
    elseif($this->getRequestParameter('ramo')=='S')
      $c->Add(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore'), Criteria::EQUAL);
    else
    {
      $criterion = $c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_deputato'), Criteria::EQUAL);
      $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore'), Criteria::EQUAL));
      $c->add($criterion);
    }
      
    $c->Add(OpInstitutionChargePeer::DATE_END, NULL , Criteria::ISNULL);
    $c->AddJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID);
    $c->Add(OpOpenContentPeer::DELETED_AT, NULL,  Criteria::ISNULL);
    $this->institution_charges = OpInstitutionChargePeer::doSelect($c); 
  }
  
  public function executeGruppi()
  {
    $c = new Criteria();
    $c->clearSelectColumns();
    $c->addSelectColumn(OpGroupPeer::ID);
    $c->addSelectColumn(OpGroupPeer::NAME);
    $c->addSelectColumn(OpGroupPeer::ACRONYM);
    $c->addJoin(OpGroupPeer::ID, OpInstitutionChargePeer::GROUP_ID, Criteria::LEFT_JOIN);
    $c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);
    
    $criterion = $c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CD'), Criteria::EQUAL);
    $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_SR'), Criteria::EQUAL));
    $c->add($criterion);
    
    $criterion = $c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_deputato'), Criteria::EQUAL);
    $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore'), Criteria::EQUAL));
    $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore_vita'), Criteria::EQUAL));
    $c->add($criterion);
    
    $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
    $c->add(OpInstitutionChargePeer::DATE_START, '2006-04-15' , Criteria::GREATER_EQUAL);
    $c->addGroupByColumn(OpGroupPeer::ID);
        
    $this->gruppi = OpInstitutionChargePeer::doSelectRS($c); 
  }
  
  public function executeParlamentareHowDays()
  {
     function count_days( $a, $b )
      {
          // First we need to break these dates into their constituent parts:
          $gd_a = getdate( $a );
          $gd_b = getdate( $b );

          // Now recreate these timestamps, based upon noon on each day
          // The specific time doesn't matter but it must be the same each day
          $a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
          $b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );

          // Subtract these two numbers and divide by the number of seconds in a
          //  day. Round the result since crossing over a daylight savings time
          //  barrier will cause this time to be off by an hour or two.
          return round( abs( $a_new - $b_new ) / 86400 );
      }
      
     $classifica=array();
     if ($this->getRequestParameter('id') == 0)
      {
        if ($this->getRequestParameter('ramo') =='C')
          $parlamentari=OpInstitutionChargePeer::getParlamentariInCarica('C',NULL);
        elseif($this->getRequestParameter('ramo') =='S')  
          $parlamentari=OpInstitutionChargePeer::getParlamentariInCarica('S',NULL);
        else
          $parlamentari=OpInstitutionChargePeer::getParlamentariInCarica();
      }
     else
        $parlamentari=OpInstitutionChargePeer::getParlamentariInCarica(NULL , $this->getRequestParameter('id'));
     foreach($parlamentari as $p)
     {
       $in_carica[]=array($p->getPoliticianId(),$p->getContentId());
      }
    
    foreach($in_carica as $politician_id)
    {
      $c = new Criteria();
       $c->clearSelectColumns();
       $c->addSelectColumn(OpInstitutionChargePeer::DATE_START);
       $c->addSelectColumn(OpInstitutionChargePeer::DATE_END);
       $c->addSelectColumn(OpInstitutionChargePeer::POLITICIAN_ID);
       $c->addJoin(OpInstitutionChargePeer::CONTENT_ID, OpOpenContentPeer::CONTENT_ID, Criteria::LEFT_JOIN);

       $criterion = $c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_CD'), Criteria::EQUAL);
       $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::INSTITUTION_ID, sfConfig::get('app_institution_id_SR'), Criteria::EQUAL));
       $c->add($criterion);

       $criterion = $c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_deputato'), Criteria::EQUAL);
       $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore'), Criteria::EQUAL));
       $criterion->addOr($c->getNewCriterion(OpInstitutionChargePeer::CHARGE_TYPE_ID, sfConfig::get('app_charge_type_id_senatore_vita'), Criteria::EQUAL));
       $c->add($criterion);

       $c->add(OpOpenContentPeer::DELETED_AT, NULL, Criteria::EQUAL);
       $c->add(OpInstitutionChargePeer::POLITICIAN_ID,$politician_id[0]);
       $rs=OpInstitutionChargePeer::doSelectRS($c);
       while($rs->next())
       {
         if ($rs->getString(2)==NULL)
           $date_end=date('Y-m-d');
         else
           $date_end=$rs->getString(2);
         if (array_key_exists($rs->getInt(3),$classifica))   
           $classifica[$rs->getInt(3)][0]=$classifica[$rs->getInt(3)][0] + count_days(strtotime($date_end),strtotime($rs->getString(1)));
         else
          $classifica[$rs->getInt(3)]=array(count_days(strtotime($date_end),strtotime($rs->getString(1))),$politician_id[1]);
       }
    }
     arsort($classifica);
     $this->classifica=$classifica;
  }
   
   
  /**
   * add a location as child to a given node, witha given name
   *
   * @param string $tag_name 
   * @param string $location 
   * @param xml_node $node 
   * @return xml_node
   * @author Guglielmo Celata
   */
  protected function addLocationAsChild($tag_name, $location, $node)
  {
    $location_type = $location->getOpLocationType()->getName();
    $location_type_initial = strtoupper(substr($location_type, 0, 1));
    switch ($location_type_initial)
    {
      case 'R':
        $istat_code = $location->getRegionalId();
        break;
      case 'P':
        $istat_code = $location->getProvincialId();
        break;
      case 'C':
        $istat_code = $location->getCityId();
        break;
      default:
        $istat_code = 0;
        break;
      
    }
    
    $location_node = $node->addChild($tag_name, null, $this->oprcs_ns);
    $location_node->addAttribute('tipo', $location_type);
    if ($istat_code)
    {
      $location_node->addAttribute('op_location:istat_code', $istat_code, $this->op_location_ns);
      $nome_node = $location_node->addChild('nome', null);      
      $nome_node->addCData($location->getName());
    }
    return $location_node;
    
  } 


  /**
   * add some institutional charges to a given node, with a given tag name
   *
   * @param string $tag_name 
   * @param string $cariche 
   * @param xml_node $node 
   * @return xml_node
   * @author Guglielmo Celata
   */
  protected function addCaricheIstituzionaliAsChild($tag_name, $cariche, $node)
  {
    $cariche_node = $node->addChild($tag_name);
    
    foreach ($cariche as $carica) {
      $carica_node = $cariche_node->addChild('carica');
      $carica_node->addAttribute('data_inizio', $carica->getDateStart('d/m/Y'));
      if ($carica->getDateEnd())
        $carica_node->addAttribute('data_fine', $carica->getDateEnd('d/m/Y'));
      else
        $carica_node->addAttribute('data_fine', '');
        
      list($inst_name, $dummy) = split(" ", strtolower($carica->getOpInstitution()->getName()));
      $carica_node->addChild('istituzione', $inst_name);

      $location = $carica->getOpLocation();
      $location_type = $location->getOpLocationType()->getName();
      $location_type_initial = substr(strtoupper($location_type), 0, 1);
      
      $charge_type = $carica->getOpChargeType()->getName();

      $charge_descr = $charge_type;
      if ($carica->getChargeTypeId() == sfConfig::get('app_charge_type_id_assessore'))
        $charge_descr .= " " . $carica->getDescription();

      if ($charge_descr == 'Presidente' || $charge_descr == 'Vicepresidente') {
        if ($inst_name == 'giunta')
          $charge_descr .= ' Giunta ' . $location_type;
        else
          $charge_descr .= ' Consiglio ' . $location_type;        
      }
      $carica_node->addChild('descrizione', $charge_descr);
      
      $this->addLocationAsChild('localita', $location, $carica_node);
      
      if ($carica->getPartyId() != '1') {
        $party_node = $carica_node->addChild('partito', $carica->getOpParty()->getName());
        $acronimo = $carica->getOpParty()->getAcronym();
        if ($acronimo != "") {
          $party_node->addAttribute('acronimo', $acronimo);
        }
      } 

      if ($carica->getGroupId() != '1') {
        $group_node = $carica_node->addChild('gruppo', $carica->getOpGroup()->getName());
        $acronimo = $carica->getOpGroup()->getAcronym();
        if ($acronimo != "") {
          $group_node->addAttribute('acronimo', $acronimo);
        }
      } 
      
      $charge_extended_descr = Text::chargeDefinition($carica, true, false, true);
      $charge_extended_descr = str_replace('&nbsp;', ' ', $charge_extended_descr);
      $extended_descr_node = $carica_node->addChild('descrizione_estesa', null);
      $extended_descr_node->addCData($charge_extended_descr);
      
      $last_updated_at = $carica->getOpOpenContent()->getOpContent()->getUpdatedAt('d/m/Y');
      $carica_node->addChild('data_ultimo_aggiornamento', $last_updated_at);
      
    }
    
    return $cariche_node;
    
  }

  /**
   * add some political charges to a given node, with a given tag name
   *
   * @param string $tag_name 
   * @param string $cariche 
   * @param xml_node $node 
   * @return xml_node
   * @author Guglielmo Celata
   */
  protected function addCarichePoliticheAsChild($tag_name, $cariche, $node)
  {
    $cariche_node = $node->addChild($tag_name);
    
    foreach ($cariche as $carica) {
      $carica_node = $cariche_node->addChild('carica');
      $carica_node->addAttribute('data_inizio', $carica->getDateStart('d/m/Y'));
      if ($carica->getDateEnd())
        $carica_node->addAttribute('data_fine', $carica->getDateEnd('d/m/Y'));
      else
        $carica_node->addAttribute('data_fine', '');
        
      $location = $carica->getOpLocation();
      $location_type = $location->getOpLocationType()->getName();
      $location_type_initial = substr(strtoupper($location_type), 0, 1);
      
      $charge_type = $carica->getOpChargeType()->getName();
      $charge_desc = $carica->getDescription();
      if ($charge_type == 'carica')
        $charge_desc = 'Iscritto';
      $descr_node = $carica_node->addChild('descrizione', null);
      $descr_node->addCData($charge_desc);
      
      $this->addLocationAsChild('localita', $location, $carica_node);
      
      if ($carica->getPartyId() != '1') {
        $party_node = $carica_node->addChild('partito', $carica->getOpParty()->getName());
        $acronimo = $carica->getOpParty()->getAcronym();
        if ($acronimo != "") {
          $party_node->addAttribute('acronimo', $acronimo);
        }
      } 
      
      $charge_extended_descr = Text::politicalChargeDefinition($carica, true, true);
      $charge_extended_descr = str_replace('&nbsp;', ' ', $charge_extended_descr);
      $extended_descr_node = $carica_node->addChild('descrizione_estesa', null);
      $extended_descr_node->addCData($charge_extended_descr);
      
      
      $last_updated_at = $carica->getOpOpenContent()->getOpContent()->getUpdatedAt('d/m/Y');
      $carica_node->addChild('data_ultimo_aggiornamento', $last_updated_at);
            
    }
    
    return $cariche_node;
    
  }
  
  /**
   * add some organizational charges to a given node, with a given tag name
   *
   * @param string $tag_name 
   * @param string $cariche 
   * @param xml_node $node 
   * @return xml_node
   * @author Guglielmo Celata
   */
  protected function addCaricheOrganizzativeAsChild($tag_name, $cariche, $node)
  {
    $cariche_node = $node->addChild($tag_name);
    
    foreach ($cariche as $carica) {
      $carica_node = $cariche_node->addChild('carica');
      $carica_node->addAttribute('data_inizio', $carica->getDateStart('d/m/Y'));
      if ($carica->getDateEnd())
        $carica_node->addAttribute('data_fine', $carica->getDateEnd('d/m/Y'));
      else
        $carica_node->addAttribute('data_fine', '');
        
      $organization = $carica->getOpOrganization()->getName();
      $carica_node->addChild('organizzazione', $organization);

      $descr_node = $carica_node->addChild('descrizione', null);
      $descr_node->addCData($carica->getChargeName());
      
      $charge_extended_descr = Text::organizationChargeDefinition($carica, true, false, true);
      $charge_extended_descr = str_replace('&nbsp;', ' ', $charge_extended_descr);
      $extended_descr_node = $carica_node->addChild('descrizione_estesa', null);
      $extended_descr_node->addCData($charge_extended_descr);
      
      
      $last_updated_at = $carica->getOpOpenContent()->getOpContent()->getUpdatedAt('d/m/Y');
      $carica_node->addChild('data_ultimo_aggiornamento', $last_updated_at);

    }
    
    return $cariche_node;
    
  }
  
  protected function _send_output($content)
  {
    $this->setLayout(false);    
    $this->response->setContentType('text/xml');
    $this->response->setContent($content);
  }
  
  /**
   * send json output to http response
   *
   * @param string $content 
   * @return void
   * @author Guglielmo Celata
   */
  protected function _send_json_output($content, $mime = 'application/json;charset=UTF-8')
  {
    $this->setLayout(false);    
    $this->response->setContentType($mime);
    $this->response->setContent($content);
  }
  
  
  
}
