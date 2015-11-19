<?php

class loadGenTest extends PHPUnit_Framework_TestCase
	{
	public function testLoadGenHash12()
		{
   		$_GET['string'] = 'oMZCnxDhw3r9fb';
		$_GET['hash'] = 'JDJ5JDEyJFBYdlZpaE5sZlVtYzIzQXZpVzY5MC5peVBIYTVMb3h3LzdxOTlyNzdHM2x1UVBTWXdHQ1lp';
		$_GET['cost'] = 12;
		$GLOBALS['LOAD_OVERRIDE'] = 1;
    		ob_start();
   		include('www/loadGen.php');
		$output = ob_get_flush();
		$this->assertContains("Hash Valid", $output);
		}
	public function testLoadGenHash14()
                {
                $_GET['string'] = 'goFMEPBiI4Yd67';
                $_GET['hash'] = 'JDJ5JDE0JGZNeU41OVhvMUNyMjc3bTdab0NVZU9BOWJ6RFpUeGNrSXRvdmg3THh3ZGt3QUNDN2dJTE5p';
                $_GET['cost'] = 14;
		$GLOBALS['LOAD_OVERRIDE'] = 1;
                ob_start();
                include('www/loadGen.php');
                $output = ob_get_flush();
                $this->assertContains("Hash Valid", $output);
                }
        public function testLoadGenHash16()
                {
                $_GET['string'] = 'Zo6DWkeC8a7IFX';
                $_GET['hash'] = 'JDJ5JDE2JHdGclBQME13SU52RjMyaWJzcjhQcS5ja3AyaG5qQmxudU9CTWUvZXFjdXAvblQvRG8zbmtx';
                $_GET['cost'] = 16;
		$GLOBALS['LOAD_OVERRIDE'] = 1;
                ob_start();
                include('www/loadGen.php');
                $output = ob_get_flush();
                $this->assertContains("Hash Valid", $output);
                }
        public function testLoadGenHash17()
                {
                $_GET['string'] = 'ih5YEnHsjeOX3f';
                $_GET['hash'] = 'JDJ5JDE3JGtFTmRkUWJBYUN4VUZqV05pRjkwSC5GWnd0VnJheUdSUlM3MUl4b1hPQW1LY25GUkRtem5t';
                $_GET['cost'] = 17;
		$GLOBALS['LOAD_OVERRIDE'] = 1;
                ob_start();
                include('www/loadGen.php');
                $output = ob_get_flush();
                $this->assertContains("Hash Valid", $output);
                }
        public function testLoadGenHashCreate()
                {
                $_GET['cost'] = 14;
		$GLOBALS['LOAD_OVERRIDE'] = 1;
                ob_start();
		include('www/loadCreate.php');
		$output = ob_get_flush();
		$outputA = explode("~",$output);
		$_GET['string'] = trim($outputA[1]);
		$_GET['hash'] = trim($outputA[0]);
		ob_start();
                include('www/loadGen.php');
                $outputN = ob_get_flush();
                $this->assertContains("Hash Valid", $outputN);
                }
	}

?>
