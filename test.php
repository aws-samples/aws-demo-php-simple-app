<?php
//Test file for CircleCI

chdir("www/");

ob_start();

include "./index.php";

$buff = ob_get_clean();

if(strlen($buff) < 9000)
        {
        print "Error in system information gathering<br>\n";
        exit(1);
        }
else
	{
	print "Buffer Size: ".strlen($buff)."\n<br>";
	}

?>
