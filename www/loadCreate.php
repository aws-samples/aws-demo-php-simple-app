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

include 'loadFunctions.php';

if(!isset($_GET['cost']))
	{
	print "Missing Cost Variable\n";
	exit(1);
	}

$strLen = 14;
$cost = $_GET['cost'];
$count = 1;

$options = array('cost' => $cost);

for($i = 0; $i < $count; $i++)
	{
	$string = generateRandomString($strLen);
	$hash = password_hash($string,PASSWORD_DEFAULT,$options);
	if($configLoad == 1)
		{
		print base64_encode($hash)."~".$string."~".$cost."\n";
		}
	}
?>
