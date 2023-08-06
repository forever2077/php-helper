<?php

namespace Forever2077\PhpHelper;

use Exception;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

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
        $exp = 0;
        $value = 0;
        $symbol = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $bytes = (float)$bytes;
        if ($bytes > 0) {
            //换底公式 log(a)(x)=log(b)(x)/log(b)(a)
            $exp = floor(log($bytes) / log(1024));
            $value = $bytes / pow(1024, $exp);
        }
        if ($symbol[$exp] === 'B') {
            $decimals = 0;
        }
        return number_format($value, $decimals, '.', '') . '' . $symbol[$exp];
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
        try {
            $path = trim($path, DIRECTORY_SEPARATOR);
            $path .= DIRECTORY_SEPARATOR;
            //如果是目录则继续
            if (is_dir($path)) {
                //扫描一个文件夹内的所有文件夹和文件并返回数组
                $p = scandir($path);
                foreach ($p as $val) {
                    //排除目录中的.和..
                    if ($val != "." && $val != "..") {
                        //如果是目录则递归子目录，继续操作
                        if (is_dir($path . $val)) {
                            //子目录中操作删除文件夹和文件
                            self::deleteDir($path . $val . DIRECTORY_SEPARATOR);
                            //目录清空后删除空文件夹
                            rmdir($path . $val . DIRECTORY_SEPARATOR);
                        } else {
                            //如果是文件直接删除
                            unlink($path . $val);
                        }
                    }
                }
                if ($isDelCurrent) {
                    rmdir($path);
                }
            }
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * 获取文件后缀,统一返回小写的后缀
     * @param string $str 文件名
     * @return string|array
     */
    public static function getExt(string $str): string|array
    {
        $ext = pathinfo($str, PATHINFO_EXTENSION);
        if (!$ext) {
            return $ext;
        }
        return strtolower(trim($ext));
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
        $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $it = new RecursiveIteratorIterator($di);

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