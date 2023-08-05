<?php

namespace Forever2077\PhpHelper;

use Carbon\Carbon;
use DateTimeInterface;
use DateTimeZone;

class DateTimeHelper
{
    /**
     * 默认实例
     * @param DateTimeInterface|string|null $time
     * @param DateTimeZone|string|null $tz
     * @return Carbon|null
     */
    public static function instance(DateTimeInterface|string $time = null, DateTimeZone|string $tz = null): ?Carbon
    {
        return self::carbon($time, $tz);
    }

    /**
     * Carbon 时间日期处理库
     * @link https://carbon.nesbot.com/docs/
     * @param DateTimeInterface|string|null $time
     * @param DateTimeZone|string|null $tz
     * @return Carbon|null
     */
    public static function carbon(DateTimeInterface|string $time = null, DateTimeZone|string $tz = null): ?Carbon
    {
        return new Carbon($time, $tz);
    }
}