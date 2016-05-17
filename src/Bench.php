<?php
namespace PHPLegends\Tests;

class Bench
{
    private $list          = array();
    private $results       = array();
    private $executed      = false;
    private $defaultCicles = 1000;
    private $emptyTest;

    public function __construct()
    {
        $this->emptyTest = $this->addTest(function() {})->cicles(1);
    }

    public function __destruct()
    {
        $this->emptyTest = $this->list = $this->results = null;
    }

    public function defaultCicles($cicles = null)
    {
        if (is_int($cicles)) {
            $this->defaultCicles = $cicles;
        }
    }

    public function addTest(\Closure $func)
    {
        if ($this->executed) {
            throw new \RuntimeException('addTest called after run start');
        }

        $result = &$this->results[count($this->results)];

        $current = new BenchObject($result);
        $current->call($func);
        $current->cicles($this->defaultCicles);

        $this->list[] = &$current;

        return $current;
    }

    public function run()
    {
        if ($this->executed) {
            throw new \RuntimeException('run can only be called once');
        }

        if (empty($this->list)) {
            throw new \RuntimeException('run can\'t start, no tests addeds');
        }

        $this->executed = true;

        $this->list = array_filter($this->list, function($obj) {
            return $obj->available();
        });

        $j = count($this->list);

        foreach ($this->list as $key => $obj) {
            if ($obj->available()) {
                $this->perfom($key);
            }
        }
    }

    private function perfom($index)
    {
        $obj = $this->list[$index];

        $cicles = $obj->getCicles();

        $inTime   = microtime(true);
        $inMemory = memory_get_usage();

        for ($i = 0; $i < $cicles; ++$i) {
            $obj->exec();
        }

        $time   = microtime(true) - $inTime;
        $memory = memory_get_usage() - $inMemory;

        $obj = null;

        $this->results[$index]['memory'] = $memory;
        $this->results[$index]['time']   = $time;
    }
}
