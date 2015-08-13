<?php
/*
# Copyright 2015 Amazon.com, Inc. or its affiliates. All Rights Reserved.
# Licensed under the Apache License, Version 2.0 (the "License"). You may not use this file except in compliance with the License. A copy of the License is located at
#
#       http://aws.amazon.com/apache2.0/
#
# or in the "license" file accompanying this file. This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and limitations under the License.
*/

//Test file non-zero exit is failure

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
