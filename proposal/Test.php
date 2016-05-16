<?php

namespace Proposal\Test;

class Test implements TestInterface
{
	/**
	 * 
	 * @var int
	 * */

	protected $turns;

	/**
	 * 
	 * @var callable
	 * */

	protected $arguments = [];

	/**
	 * 
	 * @var callable
	 * */
	protected $callable;

	/**
	 * 
	 * @var string
	 * */

	protected $label;

    public function __construct($label, callable $callable, $turns, array $arguments = [])
    {
        $this->setLabel($label)
            ->setCallable($callable)
            ->setTurns($turns)
            ->setArguments($arguments);
    }

    /**
     * Gets the value of turns.
     *
     * @return mixed
     */
    public function getTurns()
    {
        return $this->turns;
    }

    /**
     * Sets the value of turns.
     *
     * @param mixed $turns the turns
     *
     * @return self
     */
    public function setTurns($turns)
    {
        $this->turns = $turns;

        return $this;
    }

    /**
     * Gets the value of arguments.
     *
     * @return mixed
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Sets the value of arguments.
     *
     * @param mixed $arguments the arguments
     *
     * @return self
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * Gets the value of callable.
     *
     * @return mixed
     */
    public function getCallable()
    {
        return $this->callable;
    }

    /**
     * Sets the value of callable.
     *
     * @param mixed $callable the callable
     *
     * @return self
     */
    public function setCallable(callable $callable)
    {
        $this->callable = $callable;

        return $this;
    }

    /**
     * Gets the value of label.
     *
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Sets the value of label.
     *
     * @param mixed $label the label
     *
     * @return self
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    public function getResult()
    {
    	$initTime = microtime();

    	$initMemory = memory_get_usage();

    	$turns = $this->getTurns();

    	for ($i = 0; $i < $turns; $i++)
    	{
    		call_user_func_array($this->getCallable(), $this->getArguments());
    	}

    	$time = microtime() - $initTime;

        $memory = memory_get_usage() - $initMemory;

        return new Result($time, $memory, $turns);
    }
}