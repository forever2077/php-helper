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
// 创建或者写入文件
FileHelper::createFile(array|string $args, string $content = null);
// 删除指定文件，支持安全删除和备份
FileHelper::removeFile(array|string $args);
// 获取文件真实类型（支持远程文件）
FileHelper::getRealFileType($path);
```
