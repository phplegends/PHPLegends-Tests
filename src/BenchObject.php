<?php
namespace PHPLegends\Tests;

class BenchObject
{
    private $call;
    private $args = array();
    private $cicles = 1000;
    private $result;

    public function __construct(&$result)
    {
        $this->result = &$result;
    }

    public function __destruct()
    {
        $this->remove();
    }

    public function call(\Closure $call)
    {
        $this->call = $call;
        return $this;
    }

    public function remove()
    {
        $this->args = $this->result = $this->call = null;
        return $this;
    }

    public function cicles($cicles)
    {
        $this->cicles = $cicles;
        return $this;
    }

    public function args($arg)
    {
        $allArgs = func_get_args();

        if (empty($allArgs)) {
            throw new \InvalidArgumentException('args requires an or more arguments');
        }

        if (count($allArgs) === 1 && is_array($arg)) {
            $allArgs = $arg;
        }

        $this->args = $allArgs;

        $allArgs = null;
        return $this;
    }

    public function exec()
    {
        if ($this->call !== null) {
            call_user_func_array($this->call, $this->args);
        }
    }

    public function getCicles()
    {
        return $this->cicles;
    }

    public function available()
    {
        return $this->call !== null;
    }

    public function memory()
    {
        if (isset($this->result['memory'])) {
            return $this->result['memory'];
        }

        throw new Exception('Bench::run was not executed');
    }

    public function time()
    {
        if (isset($this->result['time'])) {
            return $this->result['time'];
        }

        throw new Exception('Bench::run was not executed');
    }
}
