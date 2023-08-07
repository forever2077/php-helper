<?php

namespace Forever2077\PhpHelper;

use ZanySoft\Zip\Zip;
use ZanySoft\Zip\ZipManager;

class ZipHelper
{
    /**
     * 默认实例
     * @param string|bool|null $zip_file
     * @return Zip|ZipManager
     */
    public static function instance(string|bool $zip_file = null): Zip|ZipManager
    {
        return self::laravelZip($zip_file);
    }

    /**
     * Zip实例
     * @link https://github.com/ZanySoft/Laravel-Zip
     * @param string|bool|null $zip_file
     * @return Zip|ZipManager
     */
    public static function laravelZip(string|bool $zip_file = null): Zip|ZipManager
    {
        if ($zip_file === true) {
            return new ZipManager();
        }
        return new Zip($zip_file);
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