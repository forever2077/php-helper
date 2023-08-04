<?php

namespace Forever2077\PhpHelper;

class FileHelper
{
    /**
     * 将驼峰大小写转换为人类可读格式
     * @param $bytes
     * @param int $decimals
     * @return string
     */
    public static function format($bytes, int $decimals = 2): string
    {
        return \Jsyqw\Utils\FileHelper::format($bytes, $decimals);
    }

    /**
     * 删除目录和文件
     * @param $path
     * @param bool $isDelCurrent
     * @return bool
     */
    public static function delDir($path, bool $isDelCurrent = false): bool
    {
        return \Jsyqw\Utils\FileHelper::delDir($path, $isDelCurrent);
    }

    /**
     * 获取文件后缀,统一返回小写的后缀
     * @param $str
     * @return mixed|string
     */
    public static function getExt($str): mixed
    {
        return \Jsyqw\Utils\FileHelper::getExt($str);
    }
}