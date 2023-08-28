## 协程 Coroutine

```php
use function Amp\async;
use function Amp\delay;

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
文档 https://amphp.org/amp
```