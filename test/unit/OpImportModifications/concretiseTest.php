<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');

$op_import_minint_date = '20110323';

$t = new lime_test(5, new lime_output_color());
 
$t->diag('starting test');

// simulate old signin, so that sf_user can be safely passed to reject and restore methods
$sf_user = sfContext::getInstance()->getUser();
$user = OpUserPeer::retrieveByPK(1);
$sf_user->signIn($user);

// rimozione tutti i record dalla tabella OpImportModifications
OpImportModificationsPeer::doDeleteAll();

// aggiunta di un record con la data dell'import in op_import_minint
$imp = OpImportMinintPeer::retrieveFromAggDate($op_import_minint_date);
if (!$imp)
  $imp = new OpImportMinint();
$imp->setAggDate($op_import_minint_date);
$imp->save();

// rimozione di tutti i record dalle tabelle op_politician e op_institution_charge
echo exec('mysql -uroot op_openpolis_test -e"delete from op_content; alter table op_content AUTO_INCREMENT=1;"');

// read test record and insert it into op_import_modifications table (setup)
$recs = sfYaml::load(SF_ROOT_DIR.'/data/test/yml/op_import_modifications.yml');
$rec = $recs['OpImportModifications']['reg_new_1'];
$m = new OpImportModifications();
$m->fromArray($rec, BasePeer::TYPE_FIELDNAME);
$m->save();
$v = OpImportModificationsPeer::getHashFromReducedCSV('reg', $m->getCsvRec());

// check concretised_at field before concretisation
$t->ok(is_null($m->getConcretisedAt()), "record is not marked as concretised");

// a record is concretised
$t->diag("a record is concretised");
$m->concretise();

// test that record is correctly marked as concretised
$t->is(date('Ymd'), $m->getConcretisedAt('Ymd'), "record was concretised right now");

// test existence of a record in op_politician
$p = OpPoliticianPeer::retrieveByAnagraficaWithBirthLocation($v['first_name'], $v['last_name'], $v['birth_date'], $v['birth_place']);
$t->isa_ok($p, 'OpPolitician', 'record correctly inserted into op_politician');

// test existence of a record in op_institution_charge
list($institution_name, $charge_type) = OpImportModificationsPeer::getInstitutionAndChargeTypeFromChargeDescr('reg', $v['charge_desc']);
$location = OpLocationPeer::retrieveByMinIntCodes('regione', $v['minint_regional_code'], $v['minint_provincial_code'], $v['minint_city_code']);
$i = OpInstitutionChargePeer::retrieveCurrentByImportData($p, $institution_name, $location, $charge_type);
$t->ok(count($i) == 1, 'record correctly inserted into op_institution_charge');

// concretise an already concretised record
$t->diag("a concretised record is concretised");
$res = $m->concretise();
$t->ok($res['type'] == 'warning', "the operation throws a warning");

$t->diag('ending test');


