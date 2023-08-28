## 文件 File

```php
// 把文件大小格式化成友好格式
FileHelper::format($bytes, $decimals = 2);
// 创建目录
FileHelper::createDir(string $path, int $mode = 0777, bool $recursive = true);
// 删除文件 和 目录
FileHelper::removeDir($path, $isDelCurrent = false);
// 获取文件扩展
FileHelper::getExt($str);
// 目录扫描
FileHelper::scanDirectory([
    'dir' => __DIR__, 'ext' => ['php'], 'depth' => 1, 'filter' => function ($file) {
        if (str_contains($file, '*****')) {
            return true;
        }
        return false;
    }, 'callback' => function ($file) {
        return pathinfo($file, PATHINFO_FILENAME);
    }
]);
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
public static function createFile(array|string $args, string $content = null){...}

/**
 * 删除指定文件，支持安全删除和备份
 * @param array|string $args 如果为字符串，那么就作为 filename 参数。如果为数组，那么参考下方说明：
 *     - 'filename': (必须) 文件名
 *     - 'secure': (可选) 是否安全删除，会先覆盖文件内容，默认为 false
 *     - 'backupDir': (可选) 备份目录，如果设置，会在删除前将文件复制到此目录
 * @return bool 删除成功返回 true，失败返回 false
 * @throws Exception 当文件名为空或文件不存在时抛出异常
 */
public static function removeFile(array|string $args){...}
```