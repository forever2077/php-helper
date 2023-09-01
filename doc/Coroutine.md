## 协程 Coroutine

```php
use function Amp\async;
use function Amp\delay;

// 案例一
$future1 = async(function () {
    for ($i = 0; $i < 5; $i++) {
        echo 'A' . $i, PHP_EOL;
        delay(0.01);
    }
});
$future2 = async(function () {
    for ($i = 0; $i < 5; $i++) {
        echo 'B' . $i, PHP_EOL;
        delay(0.01);
    }
});
$future1->await();
$future2->await();

// 案例二
$future = [];
for ($i = 0; $i < 5; $i++) {
    $future[] = async(function () use ($i) {
        for ($j = 0; $j < 5; $j++) {
            echo "Coroutine {$i} {$j}\n";
            delay(0.01);
        }
    });
    delay(0.01);
}
/** @var Amp\Future $item */
foreach ($future as $item) {
    $item->await();
}
$done = [];
foreach ($future as $item) {
    $done[] = $item->isComplete();
}
$this->assertEquals(5, array_sum($done));

文档 https://amphp.org/amp
```
