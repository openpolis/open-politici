<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');

$op_import_minint_date = '20110323';

$t = new lime_test(15, new lime_output_color());
$t->diag('starting test');

echo exec('mysql -uroot op_openpolis_test -e"delete from op_content; alter table op_content AUTO_INCREMENT=1;"');

$csv_rec = "02|VALLE D'AOSTA|ISABELLON|GIUSEPPE|M|28/05/1953|AOSTA (AO)|Consigliere";

// simulate old signin, so that sf_user can be safely passed to reject and restore methods
$sf_user = sfContext::getInstance()->getUser();
$user = OpUserPeer::retrieveByPK(1);
$sf_user->signIn($user);

// test exception for wrong context
try {
  $o = OpImportModificationsPeer::addFromCSV($op_import_minint_date, 'ric', $csv_rec);
  $t->fail("an exception is supposed to be raised if the context is wrong");
} catch (Exception $e) {
  $t->pass("exception raised correctly for wrong context");
}

// test exception for wrong data
try {
  $o = OpImportModificationsPeer::addFromCSV('20100103', 'reg', $csv_rec);
  $t->fail("an exception is supposed to be raised if the data is wrong");
} catch (Exception $e) {
  $t->pass("exception raised correctly for wrong data");
}


// test reg context
$t->diag('testing reg context for location=Valle D\'Aosta (4)');
$loc = OpLocationPeer::retrieveByPK(4);

$csv_rec_1 = "02|VALLE D'AOSTA|ISABELLON|GIUSEPPE|M|28/05/1953|AOSTA (AO)|Consigliere";
$o = OpImportModificationsPeer::addFromCSV($op_import_minint_date, 'reg', $csv_rec_1);
$p = OpPoliticianPeer::retrieveByAnagraficaWithBirthLocation('GIUSEPPE', 'ISABELLON', '1953-05-28', 'AOSTA (AO)');
$t->isa_ok($p, 'OpPolitician', 'record correctly inserted into op_politician');
$i = OpInstitutionChargePeer::retrieveCurrentByImportData($p, "Consiglio Regionale", $loc, "Consigliere");
$t->ok(count($i) == 1, 'record correctly inserted into op_institution_charge');

$csv_rec_2 = "02|VALLE D'AOSTA|ISABELLON|GIUSEPPE|M|28/05/1953|AOSTA (AO)|Assessore";
$o = OpImportModificationsPeer::addFromCSV($op_import_minint_date, 'reg', $csv_rec_2);
$i = OpInstitutionChargePeer::retrieveCurrentByImportData($p, "Giunta Regionale", $loc, "Assessore");
$t->ok(!is_null($i), 'record correctly inserted into op_institution_charge, referring to an existing politician');
$t->ok(is_null($i->getDateEnd()), "charge was inserted correctly with null end date");

$o = OpImportModificationsPeer::closeFromCSV($op_import_minint_date, 'reg', $csv_rec_2);
$is = OpInstitutionChargePeer::getByImportData($p, "Giunta Regionale", $loc, "Assessore");
$i = $is[0];
$t->ok($i->getDateEnd('Y-01-01') == date('Y-01-01'), "charge was closed correctly");

// test prov context
$t->diag('testing reg context for location=Asti (27)');
$loc = OpLocationPeer::retrieveByPK(27);
$csv_rec = "01|007|ASTI|AT|CRIVELLI|MARCO|M|25/11/1951|ASTI (AT)|Consigliere";
$o = OpImportModificationsPeer::addFromCSV($op_import_minint_date, 'prov', $csv_rec);
$p = OpPoliticianPeer::retrieveByAnagraficaWithBirthLocation('MARCO', 'CRIVELLI', '1951-11-25', 'ASTI (AT)');
$t->isa_ok($p, 'OpPolitician', 'record correctly inserted into op_politician');
$i = OpInstitutionChargePeer::retrieveCurrentByImportData($p, "Consiglio Provinciale", $loc, "Consigliere");
$t->ok(!is_null($i), 'record correctly inserted into op_institution_charge');
$t->ok(is_null($i->getDateEnd()), "charge was inserted correctly with null end date");

$o = OpImportModificationsPeer::closeFromCSV($op_import_minint_date, 'prov', $csv_rec);
$is = OpInstitutionChargePeer::getByImportData($p, "Consiglio Provinciale", $loc, "Consigliere");
$i = $is[0];
$t->ok($i->getDateEnd('Y-01-01') == date('Y-01-01'), "charge was closed correctly");


// test city context
$t->diag('testing reg context for location=Agrigento (7155)');
$loc = OpLocationPeer::retrieveByPK(7155);
$csv_rec = "19|001|0010|AGRIGENTO|AG|CORDARO|ELIO|M|13/04/1947|SERRADIFALCO (CL)|Assessore";
$o = OpImportModificationsPeer::addFromCSV($op_import_minint_date, 'com.001', $csv_rec);
$p = OpPoliticianPeer::retrieveByAnagraficaWithBirthLocation('ELIO', 'CORDARO', '1947-04-13', 'SERRADIFALCO (CL)');
$t->isa_ok($p, 'OpPolitician', 'record correctly inserted into op_politician');
$i = OpInstitutionChargePeer::retrieveCurrentByImportData($p, "Giunta Comunale", $loc, "Assessore");
$t->ok(!is_null($i), 'record correctly inserted into op_institution_charge');
$t->ok(is_null($i->getDateEnd()), "charge was inserted correctly with null end date");

$o = OpImportModificationsPeer::closeFromCSV($op_import_minint_date, 'com.001', $csv_rec);
$is = OpInstitutionChargePeer::getByImportData($p, "Giunta Comunale", $loc, "Assessore");
$i = $is[0];
$t->ok($i->getDateEnd('Y-01-01') == date('Y-01-01'), "charge was closed correctly");


$t->fail('testing removal of a record present in the DB, but not in the Minint data: TODO');


$t->diag('ending test');
