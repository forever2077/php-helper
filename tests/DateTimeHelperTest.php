<?php

use PHPUnit\Framework\TestCase;
use Forever2077\PhpHelper\Helper;
use Forever2077\PhpHelper\DateTimeHelper;
use Carbon\Carbon;

class DateTimeHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals('Carbon\Carbon', Helper::dateTime()::class);
    }

    public function testCarbon()
    {
        $carbon = DateTimeHelper::Carbon();
        $this->assertInstanceOf(Carbon::class, $carbon);

        $tomorrow = $carbon::now()->addDay();
        $this->assertIsString($tomorrow->toString());

        date_default_timezone_set('PRC');
        $this->assertEquals(date("Y-m-d H:i:s"), DateTimeHelper::Carbon()::now()->toDateTimeString());
    }
}