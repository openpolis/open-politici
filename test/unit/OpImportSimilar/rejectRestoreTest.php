<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');


$t = new lime_test(6, new lime_output_color());
 
$t->diag('starting test');

// simulate old signin, so that sf_user can be safely passed to reject and restore methods
$sf_user = sfContext::getInstance()->getUser();
$user = OpUserPeer::retrieveByPK(1);
$sf_user->signIn($user);

// rimozione tutti i record dalla tabella 
OpImportSimilarPeer::doDeleteAll();

// read test op_import_similar record and add to DB (setup)
$recs = sfYaml::load(SF_ROOT_DIR.'/data/test/yml/op_import_similar.yml');
$rec = $recs['OpImportSimilar']['reg_3_1'];
$s = new OpImportSimilar();
$s->fromArray($rec, BasePeer::TYPE_FIELDNAME);
$s->save();

// check deleted_at before rejection
$t->ok(is_null($s->getDeletedAt()), "record is not marked as deleted");

// user rejects record
$t->diag("user 1 deletes the test record");
$s->reject($sf_user);

// test record rejection
$t->is(date('U'), $s->getDeletedAt('U'), "record was deleted right now");
$t->ok(!is_null($s->getDeletedAt()), "record is marked as deleted");
$t->is($s->getDeletingUserId(), $user->getId(), "the test user deleted the record");

// user restore the record
$t->diag("user 1 restores the test record");
$s->restore($sf_user);

// test record restore
$t->ok(is_null($s->getDeletedAt()), "record is not marked as deleted");
$t->ok(is_null($s->getDeletingUserId()), "the deleting_user_id field is null");

$t->diag('ending test');


