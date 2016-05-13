#PHPLegends\Test

Usage:

```php
<?php
use PHPLegends\Test;

class Foo
{
    static function bar() {}
}

$bench = new Bench;
$bench->addTest(function () { 1 + 1; });
$bench->addTest('\PHPLegends\Tests\Foo::bar');
$bench->addTest(function ($a, $b) { $a + $b; }, 1000, array(1, 2));

$bench->run();

var_dump($bench->results());
```