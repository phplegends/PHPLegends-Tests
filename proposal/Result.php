<?php

namespace Proposal\Test;

class Result
{
	/**
	 * 
	 * @var float
	 * */
	protected $time;

	/**
	 * 
	 * @var float
	 * */
	protected $memory;

    /**
     * @var int
     * */

    protected $turns;

	/**
	 * 
	 * @param TestInterface $test
	 * @param float $time
	 * @param float $memory
	 * */
	public function __construct($time, $memory, $turns)
	{
		$this->setMemory($memory)->setTime($time);

        $this->turns = $turns;
	}
    
    /**
     * Gets the value of time.
     *
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Gets the value of memory.
     *
     * @return mixed
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * Sets the value of time.
     *
     * @param mixed $time the time
     *
     * @return self
     */
    protected function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Sets the value of memory.
     *
     * @param mixed $memory the memory
     *
     * @return self
     */
    protected function setMemory($memory)
    {
        $this->memory = $memory;

        return $this;
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
}