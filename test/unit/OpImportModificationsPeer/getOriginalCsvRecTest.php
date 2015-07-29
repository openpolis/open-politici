<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');

$t = new lime_test(6, new lime_output_color());
$t->diag('starting test');

$csv_rec = "02|VALLE D'AOSTA|ISABELLON|GIUSEPPE|M|28/05/1953|AOSTA (AO)|Consigliere";
$op_minint_date = '20110323';

// test exception for wrong context
try {
  $o = OpImportModificationsPeer::getOriginalCsvRec($op_minint_date, 'ric', $csv_rec);
  $t->fail("an exception is supposed to be raised if the context is wrong");
} catch (Exception $e) {
  $t->pass("exception raised correctly for wrong context");
}

// test exception for wrong data
try {
  $o = OpImportModificationsPeer::getOriginalCsvRec('20100301', 'reg', $csv_rec);
  $t->fail("an exception is supposed to be raised if the date is wrong");
} catch (Exception $e) {
  $t->pass("exception raised correctly for wrong date");
}

// test reg context
$csv_rec = "01|PIEMONTE|COTA|ROBERTO|M|13/07/1968|NOVARA (NO)|Presidente giunta";
$expected_csv_rec = "01|PIEMONTE||COTA|ROBERTO|M|13/07/1968|NOVARA (NO)|Presidente della regione|28/03/2010|09/04/2010|ROBERTO COTA PRESIDENTE|LAUREA|AVVOCATI E PROCURATORI LEGALI";
$o = OpImportModificationsPeer::getOriginalCsvRec($op_minint_date, 'reg', $csv_rec);
$t->is($o, $expected_csv_rec, "original record correctly retrieved for reg context");

// still a reg test, to test cache usage
$csv_rec = "01|PIEMONTE|ANGELERI|ANTONELLO|M|25/02/1961|TORINO (TO)|Consigliere";
$expected_csv_rec = "01|PIEMONTE||ANGELERI|ANTONELLO|M|25/02/1961|TORINO (TO)|Consigliere|28/03/2010|03/05/2010|LEGA NORD|LICENZA DI SCUOLA MEDIA SUP. O TITOLI EQUIPOLLENTI|IMPIEGATI  AMMINISTRATIVI CON MANSIONI DIRETTIVE E DI CONCETTO";
$o = OpImportModificationsPeer::getOriginalCsvRec($op_minint_date, 'reg', $csv_rec);
$t->is($o, $expected_csv_rec, "original record correctly retrieved for reg context (no cache)");

// test prov context
$csv_rec = "01|007|ASTI|AT|CRIVELLI|MARCO|M|25/11/1951|ASTI (AT)|Consigliere";
$expected_csv_rec = "01|007|ASTI|AT||CRIVELLI|MARCO|M|25/11/1951|ASTI (AT)|Consigliere|13/04/2008|10/12/2010|LEGA NORD|TITOLI O DIPLOMI PROFESSIONALI POST MEDIA INFER.|CONDUTTORI DI AZIENDE AD ORDINAMENTO PRODUTTIVO MISTO E ASSIMILATI";
$o = OpImportModificationsPeer::getOriginalCsvRec($op_minint_date, 'prov', $csv_rec);
$t->is($o, $expected_csv_rec, "original record correctly retrieved for prov context");

// test com.001 context
$csv_rec = "19|001|0010|AGRIGENTO|AG|CORDARO|ELIO|M|13/04/1947|SERRADIFALCO (CL)|Assessore";
$expected_csv_rec = "19|001|0010|AGRIGENTO|AG|54619|DOTT|CORDARO|ELIO|M|13/04/1947|SERRADIFALCO (CL)|Assessore|13/05/2007|28/04/2010||LAUREA|Pensionati e persone ritirate dal lavoro";
$o = OpImportModificationsPeer::getOriginalCsvRec($op_minint_date, 'com.001', $csv_rec);
$t->is($o, $expected_csv_rec, "original record correctly retrieved for com.001 context");

$t->diag('ending test');
