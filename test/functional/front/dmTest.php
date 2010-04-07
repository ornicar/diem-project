<?php

require_once realpath(dirname(__FILE__).'/../../../config/ProjectConfiguration.class.php');
require_once dm::getDir().'/dmCorePlugin/lib/test/dmFrontFunctionalCoverageTest.php';

$config = array(
  'env'       => 'prod',    // sf_environment
  'debug'     => true,      // use debug mode ( slower, more memory )
  'login'     => false,     // whether to log a user or not
  'username'  => 'Thibault D',   // username to log in
  'validate'  => false      // html validation
);
$test = new dmFrontFunctionalCoverageTest($config);

$test->run();