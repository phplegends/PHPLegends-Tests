<?php

namespace Proposal\Test;

class Bench implements BenchInterface, \IteratorAggregate
{
	protected $tests = [];

    public function __construct(array $tests = [])
    {
        $tests && array_map([$this, 'addTest'], $tests);
    }

    public function add($label, callable $callable, $turns, array $arguments = [])
    {
        $test = new Test($label, $callable, $turns, $arguments);

        return $this->addTest($test);
    }

	public function addTest(TestInterface $test)
	{
		if ($label = $test->getLabel())
		{
			$this->tests[$label] = $test;

			return $this;
		}

		$this->tests[] = $test;

		return $this;
	}

	public function detachTest(TestInterface $test)
	{
		$key = array_search($test, $this->tests);

		if ($key === false) return;

		$this->getTest($test);

		return $this;

	}

    /**
     * Gets the value of tests.
     *
     * @return mixed
     */
    public function getTest($indexOrLabel)
    {
        return $this->tests[$indexOrLabel];
    }


    public function removeTest($name)
    {
    	if (! isset($this->tests[$name])) return;

    	$value = $this->getTest($name);

    	unset($this->tests[$name]);

    	return $value;
    }

    /**
     * 
     * @return TestInterface[]
     * */

    public function getResults()
    {
        return array_map(function ($test)
        {
        	return $test->getResult();

        }, $this->tests);
    }

    /**
     * 
     * */
    public function getIterator()
    {
    	return new \ArrayIterator($this->getResults());
    }
}