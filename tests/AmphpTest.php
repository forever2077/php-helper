<?php

use PHPUnit\Framework\TestCase;

use function Amp\async;
use function Amp\delay;

class AmphpTest extends TestCase
{
    public function testAmp()
    {
        $future1 = async(function () {
            for ($i = 0; $i < 5; $i++) {
                //echo 'A' . $i, PHP_EOL;
                delay(0.01);
            }
        });

        $future2 = async(function () {
            for ($i = 0; $i < 5; $i++) {
                //echo 'B' . $i, PHP_EOL;
                delay(0.01);
            }
        });

        $future1->await();
        $future2->await();

        $this->assertTrue($future1->isComplete() && $future2->isComplete());
    }
}