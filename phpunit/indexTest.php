<?php

class indexTest extends PHPUnit_Framework_TestCase
	{
	public function testSiteIndex()
		{
		ob_start();
		include('www/index.php');
		$output = ob_get_flush();
		$this->assertContains("Overview of major system components", $output);
		}
	}

?>
