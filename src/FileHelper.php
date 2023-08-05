<?php

namespace Forever2077\PhpHelper;

use Exception;
use FilesystemIterator;

class FileHelper
{
    /**
     * 将驼峰大小写转换为人类可读格式
     * @param int $bytes 字节数
     * @param int $decimals 保留小数位数
     * @return string
     */
    public static function format(int $bytes, int $decimals = 2): string
    {
        return \Jsyqw\Utils\FileHelper::format($bytes, $decimals);
    }

    /**
     * 创建目录
     * @param string $path 目录
     * @param int $mode 权限
     * @param bool $recursive 是否递归创建
     * @return bool
     */
    public static function createDir(string $path, int $mode = 0777, bool $recursive = true): bool
    {
        if (file_exists($path)) {
            return true;
        }

        try {
            if (!mkdir($path, $mode, $recursive)) {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * 删除目录和文件
     * @param string $path 目录
     * @param bool $isDelCurrent 是否删除当前目录
     * @return bool
     */
    public static function deleteDir(string $path, bool $isDelCurrent = false): bool
    {
        return \Jsyqw\Utils\FileHelper::delDir($path, $isDelCurrent);
    }

    /**
     * 获取文件后缀,统一返回小写的后缀
     * @param string $str 文件名
     * @return mixed|string
     */
    public static function getExt(string $str): mixed
    {
        return \Jsyqw\Utils\FileHelper::getExt($str);
    }

    /**
     * 扫描目标目录下的文件
     * @param array|string $args 如果为字符串，那么就作为dir参数。如果为数组，那么参考下方说明：
     *     - 'dir': (必须) 目录
     *     - 'ext': (可选) 扩展名
     *     - 'depth': (可选) 深度
     *     - 'callback': (可选) 回调函数
     *     - 'filter': (可选) 过滤器回调函数
     * @return array
     */
    public static function scanDirectory(array|string $args): array
    {
        // 如果$args是字符串，那么就把它当作是dir参数
        if (is_string($args)) {
            $args = ['dir' => $args];
        }

        // 设置默认值
        $defaults = [
            'ext' => null,
            'depth' => null,
            'filter' => null,
            'callback' => null,
        ];

        // 使用用户提供的参数覆盖默认值
        $args = array_merge($defaults, $args);

        // 将参数值分配给变量
        $dir = $args['dir'];
        $extensions = $args['ext'];
        $depth = $args['depth'];
        $callback = $args['callback'];
        $filter = $args['filter'];

        $files = [];
        $di = new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS);
        $it = new \RecursiveIteratorIterator($di);

        if ($depth !== null) {
            $it->setMaxDepth($depth);
        }

        if ($extensions !== null) {
            if (is_string($extensions)) {
                $extensions = [$extensions];
            }

            $extensions = array_map('strtolower', $extensions);
        }

        foreach ($it as $file) {
            if ($extensions === null || in_array(strtolower($file->getExtension()), $extensions)) {
                $filepath = $file->getPathname();

                if ($filter && !$filter($filepath)) {
                    continue;
                }

                if ($callback) {
                    $files[] = $callback($filepath);
                } else {
                    $files[] = $filepath;
                }
            }
        }

        return $files;
    }
}