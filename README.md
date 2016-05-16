#PHPLegends\Test\Bench

Usage:

```php
<?php
use PHPLegends\Tests\Bench;

$test = new Bench;

$test->addTest('Test call using string', function() {
    $foo = '\\Controller\\foo';
    $foo(1, 2);
}, 15000);

$test->addTest('Test call using call_user_func', function() {
    call_user_func('\\Controller\\foo', 1, 2);
}, 15000);

$test->run();

print_r($test->results(), true);
```