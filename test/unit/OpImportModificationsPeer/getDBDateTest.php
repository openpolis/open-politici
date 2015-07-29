<?php
 
include_once(dirname(__FILE__).'/../../bootstrap/unit_propel.php');

$t = new lime_test(4, new lime_output_color());
$t->diag('starting test');

// test my date from italian format
$t->is(OpImportModificationsPeer::getDBDate('25/05/1968'), '1968-05-25', "italian dates are translated correctly");

// test my date from concise format
$t->is(OpImportModificationsPeer::getDBDate('19680525'), '1968-05-25', "concise dates are translated correctly");

// test a wrong dates
$t->is(OpImportModificationsPeer::getDBDate('34/02/2011'), false, "an evidently wrong date returns a false");

// test a string instead of a date
$t->is(OpImportModificationsPeer::getDBDate('pippituz'), false, "a non-date returns a false");

$t->diag('ending test');


