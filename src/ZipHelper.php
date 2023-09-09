<?php

namespace Helpful;

use ZanySoft\Zip\Zip;
use ZanySoft\Zip\ZipManager;

class ZipHelper
{
    /**
     * 默认实例
     * @param bool $manager
     * @return Zip|ZipManager
     */
    public static function instance(bool $manager = false): Zip|ZipManager
    {
        return self::laravelZip($manager);
    }

    /**
     * Zip实例
     * @link https://github.com/ZanySoft/Laravel-Zip
     * @param bool $manager
     * @return Zip|ZipManager
     */
    public static function laravelZip(bool $manager = false): Zip|ZipManager
    {
        if ($manager === true) {
            return new ZipManager();
        }
        return new Zip();
    }

    /**
     * PhpZip实例
     * @link https://github.com/Ne-Lexa/php-zip#zipfilesetpassword
     * @return void
     */
    private static function phpZip()
    {
        // 安装 composer require nelexa/zip
    }
}