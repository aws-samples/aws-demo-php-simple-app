<?php
/*
# Copyright 2015 Amazon.com, Inc. or its affiliates. All Rights Reserved.
# Licensed under the Apache License, Version 2.0 (the "License"). You may not use this file except in compliance with the License. A copy of the License is located at
#
#       http://aws.amazon.com/apache2.0/
#
# or in the "license" file accompanying this file. This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and limitations under the License.
#
# This code has been modified. Portions copyright 2015 Amazon.com, Inc. or its affiliates. 
# Please see LICENSE.txt for applicable license terms and NOTICE.txt for applicable notices. 
*/

$AppName = "Demo Web App";

ob_start();

include "lib.php";

?>
<!DOCTYPE html>
<head>
	<!-- 
    	Brownie Template
    	http://www.templatemo.com/preview/templatemo_440_brownie

    	Credits:
    	http://unsplash.com
    	http://absurdwordpreferred.deviantart.com/art/FREE-Cogs-Transparent-PNG-145452644
    -->
	<title>AWS Demo Web Application</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">
	<script src="Chart.min.js"></script>
</head>
<body>
	<nav id="responsive-menu">
        <ul class="menu-holder">
            <li class="active"><a href="#home"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="#about"><i class="fa fa-briefcase"></i>CPU</a></li>
            <li><a href="#services"><i class="fa fa-cogs"></i>Memory</a></li>
            <li><a href="#products"><i class="fa fa-list"></i>Network</a></li>
            <li><a href="#contact"><i class="fa fa-envelope"></i>Disk</a></li>
        </ul>
    </nav>
    <div class="templatemo-site-header">
		<div class="container">
			<div class="row templatemo-position-relative">				
				<nav class="hidden-xs text-uppercase templatemo-nav">
					<ul class="menu-holder">
						<li class="active"><a href="#home">Home</a></li>
						<li><a href="#about">CPU</a></li>					
						<li><a href="#services">Memory</a></li>
						<li><a href="#products">Network</a></li>
						<li><a href="#contact">Disk</a></li>
					</ul>
				</nav>
				<h1 class="templatemo-site-name">
                	<span class="templatemo-brown">AWS</span> 
                	<span class="templatemo-gold"><?php print $AppName; ?></span>
                </h1>
				<div class="text-right visible-xs">
		            <a href="#" id="mobile_menu"><span class="fa fa-bars"></span></a>
		        </div>
			</div>
		</div>    	
    </div>
	<section id="home" class="templatemo-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 templatemo-position-relative">
						<canvas id="overview" width="600" height="400"></canvas>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="templatemo-content-box templatemo-second-box">
						<h2 class="templatemo-brown">System Overview</h2>
						<h3 class="templatemo-gold">Overview of major system components.</h3>
						<p class="margin-top-30">System overview information for top processes and resources used.</p>
					</div>					
				</div>
			</div>
		</div>
	</section>
	<section id="about" class="templatemo-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="templatemo-content-box text-right">
						<h2 class="templatemo-brown">
							<span class="templatemo-section-title">CPU</span>
							<span class="templatemo-section-title">Information <span class="templatemo-gold"><strong>Graph</strong></span></span>
						</h2>
						<p class="margin-top-30">CPU use information in graph presentation.</p>
					</div>										
				</div>
				<div class="col-lg-6 col-md-6">
							<canvas id="cpu" width="600" height="400"></canvas>
				</div>
			</div>
		</div>
	</section>
	<section id="services" class="templatemo-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
						<canvas id="memory" width="600" height="400"></canvas>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="templatemo-content-box templatemo-second-box">
						<h2 class="templatemo-brown">
							<span class="templatemo-section-title">RAM</span>
							<span class="templatemo-section-title">System <span class="templatemo-gold"><strong>Memory</strong></span></span>
						</h2>
						<p class="margin-top-30">System memory.</p>
					</div>					
				</div>
			</div>
		</div>
	</section>
	<section id="products" class="templatemo-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="templatemo-content-box text-right">
						<h2 class="templatemo-brown">
							<span class="templatemo-section-title">Current Network</span>
							<span class="templatemo-section-title">Use <span class="templatemo-gold"><strong>DATA</strong></span></span>
						</h2>
						<p class="margin-top-30">Current Error, Drop, Tx, and Rx data values.</p>
					</div>					
				</div>
				<div class="col-lg-6 col-md-6">
						<canvas id="network" width="600" height="400"></canvas>
				</div>
			</div>
		</div>
	</section>
	<section id="contact" class="templatemo-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<canvas id="disk" width="600" height="400"></canvas>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="templatemo-content-box templatemo-second-box">
						<h2 class="templatemo-brown">Disk Usage <span class="templatemo-gold">STORAGE</span></h2>
						<p class="margin-top-30">Current storage utilization.  Hard disk space on system.</p> 
					</div>					
				</div>
			</div>
		</div>
	</section>
	<footer class="container margin-top-30">
		<div class="row">
			<div class="col-lg-12">
				<p class="templatemo-copyright-container text-uppercase small templatemo-brown">
					<span class="templatemo-copyright-text">Copyright &copy; 2015 <a href="#" class="templatemo-gold">Amazon Web Services</a></span>
					<!-- <span class="templatemo-copyright-design">Design: <a href="http://www.templatemo.com" class="templatemo-gold">templatemo</a></span> -->
				</p>
			</div>
		</div>		
	</footer>	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/templatemo_script.js"></script>
        <script>
            // line chart data
<?php

$cpuTon = get_cpu();
$cpuOne = $cpuTon[0];
$cpuTwo = $cpuTon[1];
$cpuThr = $cpuTon[2];
?>
            var cpuData = {
                labels : ["One Min","Five Min","Fifteen Min"],
                datasets : [
                {
                    fillColor : "rgba(172,194,132,0.4)",
                    strokeColor : "#ACC26D",
                    pointColor : "#fff",
                    pointStrokeColor : "#9DB86D",
                    data : [<?php print $cpuOne; ?>,<?php print $cpuTwo; ?>,<?php print $cpuThr; ?>]
                }
            ]
            }
		var cpu = document.getElementById('cpu').getContext('2d');
		new Chart(cpu).Line(cpuData);
</script>
<script>
<?php

$info_out = get_perc();

$diskPerc = floor((($info_out['disk_info']['used']/1000)/($info_out['disk_info']['total']/1000))*100);
$memPerc = floor(($info_out['mem_info']['free']/$info_out['mem_info']['total'])*100);
$cacPerc = floor(($info_out['mem_info']['cach']/$info_out['mem_info']['total'])*100);
$cpuPerc = ($info_out['cpu_info'][2] * 100);
$netPerc = floor(($info_out['net_info']['rx'] / $info_out['net_info']['tx'])*100);
?>
var oData = {
    labels: ["CPU", "Disk", "RAM", "Network", "Cache"],
    datasets: [
        {
            label: "first dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [<?php print $cpuPerc; ?>, <?php print $diskPerc; ?>, <?php print $memPerc; ?>, <?php print $netPerc; ?>, <?php print $cacPerc; ?>]
        }
    ]
};

            // get line chart canvas
            var overview = document.getElementById('overview').getContext('2d');
		new Chart(overview).Radar(oData);
</script>
<?php
$memArr = get_mem();
$memUse = $memArr['total'] - $memArr['free'];
$memFre = $memArr['free'];
?>
<script>
            var dohData = [
                {
                    value: <?php print $memFre; ?>,
                    color:"#878BB6",
		    label: "Free RAM"
                },
                {
                    value : <?php print $memUse; ?>,
                    color : "#4ACAB4",
		    label: "Used RAM"
                }
            ];
            // pie chart options
            var dohOptions = {
                 segmentShowStroke : false,
                 animateScale : true
            }
            // get pie chart canvas
            var memory= document.getElementById("memory").getContext("2d");
            // draw pie chart
            new Chart(memory).Pie(dohData, dohOptions);
</script>
<script>
<?php
$net_info = get_network();

$netTX = $net_info['tx'];
$netRX = $net_info['rx'];
$netEr = $net_info['ex'];
$netDr = $net_info['dx'];

?>
var netOptions = {
	animateRotate : true,
	scaleShowLabelBackdrop : true
	}
var netData = [
    {
        value: <?php print $netRX; ?>,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "RxBytes"
    },
    {
        value: <?php print $netTX; ?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "TxBytes"
    },
    {
        value: <?php print $netEr; ?>,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Errors"
    },
    {
        value: <?php print $netDr; ?>,
        color: "#949FB1",
        highlight: "#A8B3C5",
        label: "Drops"
    }
];

            // get pie chart canvas
            var network= document.getElementById("network").getContext("2d");
            // draw pie chart
            new Chart(network).PolarArea(netData, netOptions);
</script>
<script>
<?php

$disk_info = get_disk();

$diskUse = $disk_info['used'];
$diskFre = $disk_info['free'];

?>
var diskData = {
    labels: ["Disk Free", "Disk Used" ],
    datasets: [
        {
            label: "Root Disk",
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [<?php print $diskFre; ?>, <?php print $diskUse; ?> ]
        }
    ]
};
var diskOptions = {
	scaleBeginAtZero : true
        }
var disk= document.getElementById("disk").getContext("2d");
new Chart(disk).Bar(diskData, diskOptions);

</script>
</body>
</html>
