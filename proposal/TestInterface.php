<?php

namespace Proposal\Test;

interface TestInterface
{
	/**
	 * @param int $turns
	 * */
	public function setTurns($turns);

	/**
	 * @return int
	 * */
	public function getTurns();

	/**
	 * @param callable $callback
	 * @return self
	 * */
	public function setCallable(callable $callable);

	/**
	 * 
	 * @return callable
	 * */
	public function getCallable();

	/**
	 * 
	 * @param array $argments
	 * @return self
	 * */
	public function setArguments(array $arguments);

	/**
	 * 
	 * @return array
	 * */
	public function getArguments();

	/**
	 * 
	 * @param string $name
	 * @return self
	 * */
	public function setLabel($name);

	/**
	 * 
	 * @return string | null
	 * */
	public function getLabel();

	/**
	 * 
	 * @return Result
	 * */
	public function getResult();

}