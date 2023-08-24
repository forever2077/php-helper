<?php

namespace Forever2077\PhpHelper;

use DateTimeZone;
use Monolog\Logger;

class LogHelper
{
    /**
     * @link https://seldaek.github.io/monolog/
     * @param string $name
     * @param array $handlers
     * @param array $processors
     * @param DateTimeZone|null $timezone
     * @return Logger
     */
    public static function instance(string $name = 'default', array $handlers = [], array $processors = [], ?DateTimeZone $timezone = null): Logger
    {
        return new Logger($name, $handlers, $processors, $timezone);
    }
}