<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');

$t = new lime_test(47, new lime_output_color());
$t->diag('starting test');

// test exception for wrong context
try {
  $h = OpImportModificationsPeer::getInstitutionAndChargeTypeFromChargeDescr('ric', 'descr');
  $t->fail("an exception is supposed to be raised if the context is wrong");
} catch (Exception $e) {
  $t->pass("exception raised correctly for wrong context");
}

$reg_charges = array(
  'Presidente della regione' => array('Giunta Regionale', 'Presidente'),
  'Vicepresidente della regione di origine elettiva' => array('Giunta Regionale', 'Vicepresidente'),
  'Vicepresidente della regione non di origine elettiva' => array('Giunta Regionale', 'Vicepresidente'),
  'Assessore' => array('Giunta Regionale', 'Assessore'),
  'Sottosegretario' => array('Giunta Regionale', 'Sottosegretario'),
  'Assessore effettivo' => array('Giunta Regionale', 'Assessore'),
  'Assessore non di origine elettiva' => array('Giunta Regionale', 'Assessore'),
  'Presidente del consiglio' => array('Consiglio Regionale', 'Presidente'),
  'Vicepresidente del consiglio' => array('Consiglio Regionale', 'Vicepresidente'),
  'Consigliere' => array('Consiglio Regionale', 'Consigliere'),
  'Questore' => array('Consiglio Regionale', 'Consigliere'),
  'Segretario del consiglio' => array('Consiglio Regionale', 'Consigliere')
);
foreach ($reg_charges as $descr => $list) {
  try {
    $t->is_deeply(OpImportModificationsPeer::getInstitutionAndChargeTypeFromChargeDescr('reg', $descr), $list, $descr);    
  } catch (Exception $e) {
    $t->fail($e->getMessage());
  }
}


$prov_charges = array(
  'Presidente della provincia' => array('Giunta Provinciale', 'Presidente'),
  'Vicepresidente della provincia di origine elettiva ' => array('Giunta Provinciale', 'Vicepresidente'),
  'Vicepresidente della provincia non di origine elettiva' => array('Giunta Provinciale', 'Vicepresidente'),
  'Assessore' => array('Giunta Provinciale', 'Assessore'),
  'Assessore anziano' => array('Giunta Provinciale', 'Assessore'),
  'Assessore non di origine elettiva' => array('Giunta Provinciale', 'Assessore'),
  'Presidente del consiglio' => array('Consiglio Provinciale', 'Presidente'),
  'Vicepresidente del consiglio' => array('Consiglio Provinciale', 'Vicepresidente'),
  'Consigliere' => array('Consiglio Provinciale', 'Consigliere'),
  'Consigliere - Candidato Presidente' => array('Consiglio Provinciale', 'Consigliere'),
  'Commissario Prefettizio' => array('Commissariamento', 'Commissario'),
  'Commissario Straordinario' => array('Commissariamento', 'Commissario straordinario')
);
foreach ($prov_charges as $descr => $list) {
  try {
    $t->is_deeply(OpImportModificationsPeer::getInstitutionAndChargeTypeFromChargeDescr('prov', $descr), $list, $descr);    
  } catch (Exception $e) {
    $t->fail($e->getMessage());
  }
}

$com_charges = array(
  "Sindaco" => array('Giunta Comunale', 'Sindaco'),
  "Sindaco -  Candidato Sindaco" => array('Giunta Comunale', 'Sindaco'),
  "Vicesindaco" => array('Giunta Comunale', 'Vicesindaco'),
  "Vicesindaco elettivo in Valle d'Aosta" => array('Giunta Comunale', 'Vicesindaco'),
  "Vicesindaco non di origine elettiva" => array('Giunta Comunale', 'Vicesindaco'),  
  "Delega funzioni da parte del Sindaco - Vicesindaco" => array('Giunta Comunale', 'Vicesindaco'),
  "Assessore" => array('Giunta Comunale', 'Assessore'),
  "Assessore anziano" => array('Giunta Comunale', 'Assessore'),
  "Assessore effettivo" => array('Giunta Comunale', 'Assessore'),
  "Assessore non di origine elettiva" => array('Giunta Comunale', 'Assessore'),
  "Assessore supplente" => array('Giunta Comunale', 'Assessore'),
  "Delega funzioni da parte del Sindaco" => array('Giunta Comunale', 'Assessore'),
  "Presidente del consiglio" => array('Consiglio Comunale', 'Presidente'),
  "Vicepresidente del consiglio" => array('Consiglio Comunale', 'Vicepresidente'),
  "Consigliere" => array('Consiglio Comunale', 'Consigliere'),
  "Consigliere -  Candidato Sindaco" => array('Consiglio Comunale', 'Consigliere'),
  "Consigliere straniero" => array('Consiglio Comunale', 'Consigliere'),
  "Consigliere supplente" => array('Consiglio Comunale', 'Consigliere'),
  "Sub commissario Prefettizio" => array('Commissariamento', 'Commissario'),
  "Commissario Prefettizio" => array('Commissariamento', 'Commissario'),
  "Commissario Straordinario" => array('Commissariamento', 'Commissario straordinario'),
  "Commissione Straordinaria" => array('Commissariamento', 'Commissario straordinario')
);
foreach ($com_charges as $descr => $list) {
  try {
    $t->is_deeply(OpImportModificationsPeer::getInstitutionAndChargeTypeFromChargeDescr('com.001', $descr), $list, $descr);    
  } catch (Exception $e) {
    $t->fail($e->getMessage());
  }
}



$t->diag('ending test');
