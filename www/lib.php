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

function get_perc()
	{
	$info = array();
	$info['net_info'] = get_network();
	$info['cpu_info'] = get_cpu();
	$info['disk_info'] = get_disk();
	$info['mem_info'] = get_mem();	

	return $info;

	}

function get_network()
	{
	$fhr = fopen('/sys/class/net/eth0/statistics/rx_bytes','r') or die("Could not read RX interface information<br>");
	$fht = fopen('/sys/class/net/eth0/statistics/tx_bytes','r') or die("Could not read DX interface information<br>");
	$fhe = fopen('/sys/class/net/eth0/statistics/rx_errors','r') or die("Could not read DX interface information<br>");
	$fhd = fopen('/sys/class/net/eth0/statistics/rx_dropped','r') or die("Could not read DX interface information<br>");

	$net_info = array();

	$net_info['rx'] = trim(fgets($fhr));
	$net_info['tx'] = trim(fgets($fht));
	$net_info['ex'] = trim(fgets($fhe));
	$net_info['dx'] = trim(fgets($fhd));

	fclose($fhr);
	fclose($fht);
	fclose($fhe);
	fclose($fhd);

	return $net_info;
	}

function get_cpu()
	{
	$cpu_info = sys_getloadavg();

	return $cpu_info;
	}

function get_disk()
	{
	$disk_info = array();

	$disk_info['total'] = disk_total_space("/");
	$disk_info['free'] = disk_free_space("/");
	$disk_info['used'] = $disk_info['total'] - $disk_info['free'];

	return $disk_info;
	}

function get_mem()
	{
	$fh = fopen('/proc/meminfo','r') or die("Could not read memory information<br>");

	$mem_info = array();

	while ($line = fgets($fh))
		{
		if(preg_match('/^MemTotal:/', $line))
			{
			$stor = str_replace("kB","",str_replace("MemTotal:", "", str_replace(' ','',trim($line))));
			$mem_info['total'] = $stor;
			}
		if(preg_match('/^MemFree:/', $line))
     	        	{
			$stor = str_replace("kB","",str_replace("MemFree:", "", str_replace(' ','',trim($line))));
	                $mem_info['free'] = $stor;
	                }
		if(preg_match('/^MemAvailable:/', $line))
                	{
			$stor = str_replace("kB","",str_replace("MemAvailable:", "", str_replace(' ','',trim($line))));
	                $mem_info['avail'] = $stor;
	                }
		if(preg_match('/^Cached:/', $line))
                        {
                        $stor = str_replace("kB","",str_replace("Cached:", "", str_replace(' ','',trim($line))));
			$mem_info['cach'] = $stor;
                        }
		}

	fclose($fh);
	
	return $mem_info;
	}


