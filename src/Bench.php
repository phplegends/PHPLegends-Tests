<?php
namespace PHPLegends\Tests;

class Bench
{
    private $tests = array();
    private $executed  = false;

    public function addTest(callable $func, $loops = 1000, array $args = array())
    {
        if ($this->executed) {
            throw new \RuntimeException('addTest called after run start');
        }

        $this->tests[] = array(
            'arguments' => $args,
            'function'  => $func,
            'loops'     => $loops,
            'result'    => false
        );

        return count($this->tests) - 1;
    }

    public function removeTest($index)
    {
        if ($this->executed) {
            throw new \RuntimeException('removeTest called after run start');
        }

        if (is_int($index) === false) {
            throw new \InvalidArgumentException('removeTest only accepts integers');
        }

        if (isset($this->tests[$index])) {
            $this->tests[$index] = null;

            return true;
        }

        return false;
    }

    public function results($index = -1)
    {
        if (is_int($index) === false || $index < -1) {
            throw new \InvalidArgumentException('removeTest only accepts integers or empty');
        }

        if ($index === -1) {
            foreach ($this->tests as $key => $value) {
                $results[$key] = $value['result'];
            }

            return $results;
        }

        return empty($this->tests[$i]['result']) ? false : $this->tests[$i]['result'];
    }

    public function run()
    {
        if ($this->executed) {
            throw new \RuntimeException('run can only be called once');
        }

        if (empty($this->tests)) {
            throw new \RuntimeException('run can\'t start, no tests addeds');
        }

        $this->executed = true;

        $this->tests = array_filter($this->tests);

        $j = count($this->tests);

        for ($i = 0; $i < $j; ++$i) {
            $this->tests[$i]['result'] = $this->perfom($i);
        }
    }

    protected function perfom($index)
    {
        $call  = $this->tests[$index]['function'];
        $loops = $this->tests[$index]['loops'];
        $args  = $this->tests[$index]['arguments'];

        $initiate = microtime();

        for ($i = 0; $i < $loops; ++$i) call_user_func_array($call, $args);

        $resp = microtime() - $initiate;

        $call = $args = $call = null;

        return $resp;
    }
}
