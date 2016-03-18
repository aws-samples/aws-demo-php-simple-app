<?php
//Script to automate the process of generating server load
//for the purpose of testing.  Examples include the use of
//this call to trigger Amazon CloudWatch Alarms referenced
//within an AWS AutoScaling Group
//
//Use:
//	loadAuto.php?cost=<integer>
//
//Integer should be a numeric value representing the level 
//of load to be used.  This value is used with the password
//hasing algorithm which is the source of the load.
//
//Prior to use, enable the use of load generation from 
//within the config.php file.

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

	if(password_verify($string,$hash))
        	{
        	print "Hash Valid";
        	}
	else
	        {
        	print "Hash Invalid";
	        }

	}
print "<br><br><table border=0><tr>";
print "<td><b>Current CPU Use:<br></td>";

$cpuLoad = sys_getloadavg();
if(!isset($cpuLoad[0]))
	{
	print "Error returning CPU Load\n<br>";
	exit(1);
	}
print "<tr><td></td><td>1 Min Avg - </td><td>".$cpuLoad[0]."</td>";
print "<tr><td></td><td>5 Min Avg - </td><td>".$cpuLoad[1]."</td>";
print "<tr><td></td><td>15 Min Avg - </td><td>".$cpuLoad[2]."</td>";
print "</table>";

?>


