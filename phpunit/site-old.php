<?php

require 'testcase.php';

$suite  = new PHPUnit_Framework_TestSuite("siteTest");
$result = siteTest::siteTest($suite);

echo $result -> toString();
?>
