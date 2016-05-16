#PHPLegends\Test\Bench

Usage:

```php
<?php
use PHPLegends\Tests\Bench;
use PHPLegends\Tests\BenchObject;

require 'vendor/autoload.php'; //Composer autoload

//Function for test
function foo($a, $b) {
    $a + $b;
}
function bar() {
    foo(10, 10);
}

$foo = new Bench;

//Added callback function with string
$test1 = $foo->addTest(function ($a, $b) {
    $baz = 'foo';
    $baz($a, $b);
});

//Setup cicles (loops) and arguments for callback
$test1->cicles(15000)->args(1, 2);

//Added test callback function with call_user_func_array
$test2 = $foo->addTest(function($a, $b) {
    $baz = 'foo';
    call_user_func_array($baz, array($a, $b));
});
$test2->cicles(15000)->args(3, 2);

//Call "direct" function foo
$test3 = $foo->addTest('bar');

$foo->run();

echo 'Test #1 (memory):', $test1->memory(), '<br>';
echo 'Test #1 (time):',   $test1->time(), '<hr>';

echo 'Test #2 (memory):', $test2->memory(), '<br>';
echo 'Test #2 (time):',   $test2->time(), '<hr>';

echo 'Test #3 (memory):', $test3->memory(), '<br>';
echo 'Test #3 (time):',   $test3->time();

```