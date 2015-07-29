<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');

$t = new lime_test(7, new lime_output_color());
$t->diag('starting test');

// test exception for wrong context
try {
  $h = OpImportModificationsPeer::getHashFromCSV('ric', 'aaa');
  $t->fail("an exception is supposed to be raised if the context is wrong");
} catch (Exception $e) {
  $t->pass("exception raised correctly for wrong context");
}

// test exception for wrong csv
foreach (array('reg', 'prov', 'com.001') as $context) {
  try {
    $h = OpImportModificationsPeer::getHashFromCSV($context, 'aaa;bbb;ccc');
    $t->fail("an exception is supposed to be raised if the csv is wrong");
  } catch (Exception $e) {
    $t->pass("exception raised correctly for wrong csv in $context context");
  }
}

// test csv for reg context
$csv_reg = "01|PIEMONTE||COTA|ROBERTO|M|13/07/1968|NOVARA (NO)|Presidente della regione|28/03/2010|09/04/2010|ROBERTO COTA PRESIDENTE|LAUREA|AVVOCATI E PROCURATORI LEGALI";
$hash = array(
  'minint_regional_code' => '01',
  'minint_provincial_code' => null,
  'minint_city_code' => null,
  'last_name'   => 'COTA',
  'first_name'  => 'ROBERTO',
  'sex'         => 'M',
  'birth_date'  => '1968-07-13',
  'birth_place' => 'NOVARA (NO)',
  'education'   => 'LAUREA',
  'profession'  => 'AVVOCATI E PROCURATORI LEGALI',
  'charge_desc' => 'Presidente della regione',
  'charge_start_date' => '2010-04-09',
  'charge_list' => 'ROBERTO COTA PRESIDENTE'
);

$h = OpImportModificationsPeer::getHashFromCSV('reg', $csv_reg);
$t->is_deeply($h, $hash, "hash was retrieved correctly from CSV in reg context");

// test csv for prov context
$csv_prov = "01|002|ALESSANDRIA|AL||FILIPPI|PAOLO|M|15/09/1962|CASALE MONFERRATO (AL)|Presidente della provincia|07/06/2009|23/06/2009|CEN-SIN(LS.CIVICHE)|LAUREA|IMPIEGATI  AMMINISTRATIVI CON MANSIONI DIRETTIVE E DI CONCETTO";
$hash = array(
  'minint_regional_code' => '01',
  'minint_provincial_code' => '002',
  'minint_city_code' => null,
  'last_name'   => 'FILIPPI',
  'first_name'  => 'PAOLO',
  'sex'         => 'M',
  'birth_date'  => '1962-09-15',
  'birth_place' => 'CASALE MONFERRATO (AL)',
  'education'   => 'LAUREA',
  'profession'  => 'IMPIEGATI  AMMINISTRATIVI CON MANSIONI DIRETTIVE E DI CONCETTO',
  'charge_desc' => 'Presidente della provincia',
  'charge_start_date' => '2009-06-23',
  'charge_list' => 'CEN-SIN(LS.CIVICHE)'
);

$h = OpImportModificationsPeer::getHashFromCSV('prov', $csv_prov);
$t->is_deeply($h, $hash, "hash was retrieved correctly from CSV in prov context");

// test csv for com.01 context
$csv_com = "19|001|0010|AGRIGENTO|AG|54619||ZAMBUTO|MARCO|M|10/04/1973|AGRIGENTO (AG)|Sindaco|13/05/2007|29/05/2007|CENTRO|LAUREA|AVVOCATI E PROCURATORI LEGALI";
$hash = array(
  'minint_regional_code' => '19',
  'minint_provincial_code' => '001',
  'minint_city_code' => '0010',
  'last_name'   => 'ZAMBUTO',
  'first_name'  => 'MARCO',
  'sex'         => 'M',
  'birth_date'  => '1973-04-10',
  'birth_place' => 'AGRIGENTO (AG)',
  'education'   => 'LAUREA',
  'profession'  => 'AVVOCATI E PROCURATORI LEGALI',
  'charge_desc' => 'Sindaco',
  'charge_start_date' => '2007-05-29',
  'charge_list' => 'CENTRO'
);

$h = OpImportModificationsPeer::getHashFromCSV('com.001', $csv_com);
$t->is_deeply($h, $hash, "hash was retrieved correctly from CSV in com.001 context");

$t->diag('ending test');


