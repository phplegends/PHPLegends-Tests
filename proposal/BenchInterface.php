<?php

namespace Proposal\Test;

interface BenchInterface
{

	/**
	 * @return array
	 * */
	public function getResults();

	/**
	 * 
	 * @param TestInterface $test
	 * @return self
	 * */
	public function addTest(TestInterface $test);

	/**
	 * 
	 * @param TestInterface $test
	 * */
	public function detachTest(TestInterface $test);

	/**
	 * Remove test and returns it
	 * 
	 * @param string $name
	 * @return TestInterface
	 * */

	public function removeTest($name);
}