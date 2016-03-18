<?php

$configLoad = 0;

if(file_exists('../config.php'))
	{
	include '../config.php';
	$configLoad = 1;
	}
if(file_exists('config.php'))
	{
	include 'config.php';
	$configLoad = 1;
	}
if($configLoad != 1)
	{
	print "Could not load config...\n";
	exit(1);
	}

if($loadGenUse != 1)
	{
        if(!isset($GLOBALS['LOAD_OVERRIDE']))
                {
                print "Load Generator not configured for use.\n";
                exit(1);
                }
	if($GLOBALS['LOAD_OVERRIDE'] != 1)
		{
		print "Load Generator not configured for use.\n";
		exit(1);
		}
	}

if(isset($_GET['cost']) && isset($_GET['hash']))
	{
	$cost = trim($_GET['cost']);
	$hash = base64_decode($_GET['hash']);
	$string = trim($_GET['string']);
	}
else
	{
	print "Cost,Hash, or String not set.\n";
	exit(1);
	}

if(($cost < 1) || ($cost > 50))
	{
	print "Valid values for cost are: 1 - 50.\n";
	exit(1);
	}

$options = array('cost' => $cost);

if(password_verify($string,$hash))
	{
	print "Hash Valid";
	}
else
	{
	print "Hash Invalid";
	}
?>
