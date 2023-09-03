<?php

namespace Forever2077\PhpHelper;

use finfo;
use Exception;
use FilesystemIterator;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class FileHelper
{
    public static function instance(): FileHelper
    {
        return new self();
    }

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
        return number_format($value, $decimals, '.', '') . $symbol[$exp];
    }

    /**
     * 创建或者写入文件
     * 当文件不存在，创建新文件并写入内容；当文件存在，根据 append 参数决定是覆盖还是追加内容。
     * 兼容大文件读写，通过设定缓冲区大小来进行分块读写，防止一次性读取大文件导致的内存溢出问题。
     * @param array|string $args 如果为字符串，那么就作为 filename 参数。如果为数组，那么参考下方说明：
     *     - 'filename': (必须) 文件名
     *     - 'content': (必须) 写入的内容
     *     - 'append': (可选) 是否追加内容，默认为 false
     *     - 'bufferSize': (可选) 缓冲区大小，默认为 8192 (8KB)
     * @param string|null $content 如果 $args 为字符串，那么 $content 就作为 content 参数
     * @return bool 写入成功返回 true，失败返回 false
     * @throws Exception 当文件名为空或文件无法打开或写入失败时抛出异常
     */
    public static function createFile(array|string $args, string $content = null): bool
    {
        // 如果 $args 是字符串，那么就把它当作是 filename 参数
        if (is_string($args)) {
            $args = [
                'filename' => $args,
                'content' => $content,
            ];
        }

        // 设置默认值
        $defaults = [
            'filename' => null,
            'content' => null,
            'append' => false,
            'bufferSize' => 8192 // 设置缓冲区大小，默认为8KB
        ];

        // 使用用户提供的参数覆盖默认值
        $args = array_merge($defaults, $args);

        // 将参数值分配给变量
        $filename = $args['filename'];
        $content = $args['content'];
        $append = $args['append'];
        $bufferSize = $args['bufferSize'];

        // 检查文件名是否为空
        if (!$filename) {
            throw new Exception("Filename cannot be empty");
        }

        // 打开文件流
        if ($append) {
            $handle = fopen($filename, 'a');
        } else {
            $handle = fopen($filename, 'w');
        }

        // 检查文件是否成功打开
        if (!$handle) {
            throw new Exception("Failed to open file: " . $filename);
        }

        // 写入文件
        while (strlen($content) > 0) {
            $bytesWritten = fwrite($handle, substr($content, 0, $bufferSize));

            // 检查是否写入成功
            if ($bytesWritten === false) {
                fclose($handle);
                throw new Exception("Failed to write to file: " . $filename);
            }

            // 删除已写入的内容
            $content = substr($content, $bytesWritten);
        }

        // 关闭文件流
        fclose($handle);

        return true;
    }

    /**
     * 删除指定文件，支持安全删除和备份
     * @param array|string $args 如果为字符串，那么就作为 filename 参数。如果为数组，那么参考下方说明：
     *     - 'filename': (必须) 文件名
     *     - 'secure': (可选) 是否安全删除，会先覆盖文件内容，默认为 false
     *     - 'backupDir': (可选) 备份目录，如果设置，会在删除前将文件复制到此目录
     * @return bool 删除成功返回 true，失败返回 false
     * @throws Exception 当文件名为空或文件不存在时抛出异常
     */
    public static function removeFile(array|string $args): bool
    {
        // 如果 $args 是字符串，那么就把它当作是 filename 参数
        if (is_string($args)) {
            $args = ['filename' => $args];
        }

        // 设置默认值
        $defaults = [
            'filename' => null,
            'secure' => false,
            'backupDir' => null,
        ];

        // 使用用户提供的参数覆盖默认值
        $args = array_merge($defaults, $args);

        // 将参数值分配给变量
        $filename = $args['filename'];
        $secure = $args['secure'];
        $backupDir = $args['backupDir'];

        // 检查文件名是否为空
        if (!$filename) {
            throw new Exception("Filename cannot be empty");
        }

        // 检查文件是否存在
        if (!file_exists($filename)) {
            throw new Exception("File does not exist");
        }

        // 备份
        if ($backupDir) {
            if (!is_dir($backupDir)) {
                mkdir($backupDir, 0777, true);
            }

            $backupFile = $backupDir . '/' . basename($filename);
            if (!copy($filename, $backupFile)) {
                throw new Exception("Failed to backup file to: " . $backupFile);
            }
        }

        // 安全删除
        if ($secure) {
            $filesize = filesize($filename);
            $handle = fopen($filename, 'r+');

            if ($handle === false) {
                throw new Exception("Failed to open file: " . $filename);
            }

            $randomData = openssl_random_pseudo_bytes($filesize);
            fwrite($handle, $randomData);
            fclose($handle);
        }

        // 删除文件
        return unlink($filename);
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
    public static function removeDir(string $path, bool $isDelCurrent = false): bool
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
                            self::removeDir($path . $val . DIRECTORY_SEPARATOR);
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
     * 获取文件的真实MIME类型
     * @param string $filePath 文件的路径或URL
     * @return string|bool 返回文件的MIME类型，如果文件不存在或发生错误返回 false
     * @throws Exception 如果创建 finfo 对象失败或其他未预期的错误
     */
    public static function getRealFileType(string $filePath): string|bool
    {
        // 参数验证
        if (empty($filePath)) {
            throw new Exception("Invalid file path.");
        }

        // 判断是否为远程文件
        $isRemote = filter_var($filePath, FILTER_VALIDATE_URL);

        // 如果是远程文件，下载到临时文件
        if ($isRemote) {
            $tempFile = tempnam(sys_get_temp_dir(), 'remote_file_');
            $fileContents = file_get_contents($filePath);

            if ($fileContents === false) {
                return false;
            }

            file_put_contents($tempFile, $fileContents);
            $filePath = $tempFile;
        }

        // 检查文件是否存在
        if (!file_exists($filePath)) {
            return false;
        }

        // 创建一个新的finfo对象
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        // 获取文件的MIME类型
        try {
            $fileType = $finfo->file($filePath);
        } catch (Exception $e) {
            throw new Exception("An error occurred while fetching the file type: " . $e->getMessage());
        }

        // 如果使用了临时文件，删除它
        if ($isRemote) {
            unlink($tempFile);
        }

        return $fileType;
    }
}