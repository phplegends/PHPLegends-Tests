<?php
namespace PHPLegends\Tests;

class Bench implements \IteratorAggregate
{
    private $list          = array();
    private $results       = array();
    private $executed      = false;
    private $defaultCicles = 1000;

    public function __construct()
    {
        $this->addTest(function() {})->cicles(1);
    }

    public function __destruct()
    {
        $this->list = $this->results = null;
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

        $this->list[] = $current;

        return $current->call($func)->cicles($this->defaultCicles);
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

    /**
     * Checks if bench is already executed
     * 
     * @return boolean
     * */
    public function isExecuted()
    {
        return $this->executed;
    }

    /**
     * Implementation for \ArrayIterator
     * 
     * @todo Bench::$results MUST be BenchObject array
     * @return \ArrayIterator
     * */

    public function getIterator()
    {
        if (! $this->isExecuted()) {
            
            $this->run();
        }

        return new \ArrayIterator($this->results);
    }
}
