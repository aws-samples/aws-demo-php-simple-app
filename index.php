<?php

$dirVal = dirname($_SERVER['PHP_SELF']);

if(strlen($dirVal) > 1)
	$outBound = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF'])."/www/";
else
	$outBound = "http://".$_SERVER['SERVER_NAME']."/www/";

header("Location: $outBound");

?>
