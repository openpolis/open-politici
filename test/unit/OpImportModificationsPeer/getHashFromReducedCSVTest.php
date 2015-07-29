<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');

$t = new lime_test(7, new lime_output_color());
$t->diag('starting test');

// test exception for wrong context
try {
  $h = OpImportModificationsPeer::getHashFromReducedCSV('ric', 'aaa');
  $t->fail("an exception is supposed to be raised if the context is wrong");
} catch (Exception $e) {
  $t->pass("exception raised correctly for wrong context");
}

// test exception for wrong csv
foreach (array('reg', 'prov', 'com.001') as $context) {
  try {
    $h = OpImportModificationsPeer::getHashFromReducedCSV($context, 'aaa;bbb;ccc');
    $t->fail("an exception is supposed to be raised if the csv is wrong");
  } catch (Exception $e) {
    $t->pass("exception raised correctly for wrong csv in $context context");
  }
}

// test csv for reg context
$csv_reg = "01|PIEMONTE|ANGELERI|ANTONELLO|M|25/02/1961|TORINO (TO)|Consigliere";
$expected_hash = array(
  'minint_regional_code' => '01',
  'minint_provincial_code' => null,
  'minint_city_code' => null,
  'location_name' => 'PIEMONTE',
  'location_prov' => null,
  'last_name'   => 'ANGELERI',
  'first_name'  => 'ANTONELLO',
  'sex'         => 'M',
  'birth_date'  => '1961-02-25',
  'birth_place' => 'TORINO (TO)',
  'charge_desc' => 'Consigliere'
);

$hash = OpImportModificationsPeer::getHashFromReducedCSV('reg', $csv_reg);
$t->is_deeply($hash, $expected_hash, "hash was retrieved correctly from CSV in reg context");

// test csv for prov context
$csv_prov = "01|002|ALESSANDRIA|AL|ANGELINI|DINO|M|10/07/1950|MORNESE (AL)|Consigliere";
$expected_hash = array(
  'minint_regional_code' => '01',
  'minint_provincial_code' => '002',
  'minint_city_code' => null,
  'location_name' => 'ALESSANDRIA',
  'location_prov' => 'AL',
  'last_name'   => 'ANGELINI',
  'first_name'  => 'DINO',
  'sex'         => 'M',
  'birth_date'  => '1950-07-10',
  'birth_place' => 'MORNESE (AL)',
  'charge_desc' => 'Consigliere'
);

$hash = OpImportModificationsPeer::getHashFromReducedCSV('prov', $csv_prov);
$t->is_deeply($hash, $expected_hash, "hash was retrieved correctly from CSV in prov context");

// test csv for com.01 context
$csv_com = "19|001|0010|AGRIGENTO|AG|ALFANO|FRANCESCO|M|06/02/1950|SANT'ANGELO MUXARO (AG)|Consigliere";
$expected_hash = array(
  'minint_regional_code' => '19',
  'minint_provincial_code' => '001',
  'minint_city_code' => '0010',
  'location_name' => 'AGRIGENTO',
  'location_prov' => 'AG',
  'last_name'   => 'ALFANO',
  'first_name'  => 'FRANCESCO',
  'sex'         => 'M',
  'birth_date'  => '1950-02-06',
  'birth_place' => 'SANT\'ANGELO MUXARO (AG)',
  'charge_desc' => 'Consigliere'
);

$hash = OpImportModificationsPeer::getHashFromReducedCSV('com.001', $csv_com);
$t->is_deeply($hash, $expected_hash, "hash was retrieved correctly from CSV in com.001 context");

$t->diag('ending test');


