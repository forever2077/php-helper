<?php

namespace Forever2077\PhpHelper;

class SystemHelper
{
    /**
     * 获取内存使用情况
     * @return int|string
     */
    public static function getMemoryUsage(): int|string
    {
        return \Jsyqw\Utils\SystemHelper::getMemoryUsage();
    }

    /**
     * 记录日志，一般调试时候使用
     * @param $msg
     * @param string $file
     * @return void
     */
    public static function logMsg($msg, string $file = './log.txt'): void
    {
        \Jsyqw\Utils\SystemHelper::logMsg($msg, $file);
    }
}