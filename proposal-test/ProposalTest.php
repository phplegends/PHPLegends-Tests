<?php

use Proposal\Test\Bench;

class ProposalTest extends PHPUNIT_Framework_TestCase
{
	public function test()
	{
		$bench = new Bench;

		// $bench->add('time.object', function () {
		// 	$time = (new DateTime('+30 seconds'))->format('d/m/Y');
		// }, 10000);

		$test = new \Proposal\Test\Test('time.object', function ()
		{
			$time = (new DateTime('+30 seconds'))->format('d/m/Y');

		}, 10000);

		$bench->addTest($test);

		$bench->add('time.function', function () {
			$time = date('d/m/Y', strtotime('+30 seconds'));
		}, 10000);

		$bench->getTest('time.function')->setTurns(50000);

		$this->assertEquals(10000, $test->getTurns());

		$test->setTurns(50000);

		$this->assertEquals(50000, $test->getTurns());

		var_dump($bench->getResults());
	}
}