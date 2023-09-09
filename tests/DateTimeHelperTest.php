<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\DateTimeHelper;
use Carbon\Carbon;

class DateTimeHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(DateTimeHelper::class, Helper::dateTime(new DateTime('2023-01-01 00:00:00'))::class);
    }

    public function testCarbon()
    {
        $carbon = DateTimeHelper::instance(new DateTime('2023-01-01 00:00:00'));
        $this->assertInstanceOf(Carbon::class, $carbon);

        $tomorrow = $carbon::now()->addDay();
        $this->assertIsString($tomorrow->toString());

        date_default_timezone_set('PRC');
        $this->assertEquals(date("Y-m-d H:i:s"), DateTimeHelper::now()->toDateTimeString());
    }
}