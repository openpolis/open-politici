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
 * declarationReports components.
 *
 * @package    openpolis
 * @subpackage declarationReports
 * @author     Guglielmo Celata
 * @version    SVN: $Id: components.class.php 1415 2006-06-11 08:33:51Z fabien $
 */ 
class declarationReportsComponents extends sfComponents
{
  public function executeSubnav()
  {
    $this->tags = array(
      '3297' => 'Energia elettrica',
      '129'  => 'Energia nucleare',
      '4253' => 'Energia solare',
      '3298' => 'Energia eolica',
      '5455' => 'Energia idroelettrica',
      '4517' => 'Carbone',
      '1199' => 'Fonti rinnovabili',
      '5468' => 'Trasporti elettrici',
      '5458' => 'Anidride carbonica',
      '129,1569' => 'Energia Nucleare, Lombardia',
      '4517,1312' => 'Carbone, Calabria'
    );
    
    $this->page_base_routes = array('dichiarazioni' => '@energy_report', 'trend' => '@energy_report_trend');
  }
}
 
?>
