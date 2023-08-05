# PHP 助手类/工具包

## 安装

```php
composer require forever2077/php-helper:"@dev"
```

## 单例+懒加载模式

```php
// 冒泡排序
$arr = [1, 3, 2, 5, 4];
PhpHelper::Algorithm()::BubbleSort($arr);

// 数组转对象
class Foo
{
    public $a = 1;
    public $b = 2;

    public function __construct()
    {
        $this->a = 1;
        $this->b = 2;
    }
}
$foo = new Foo();
PhpHelper::Array()::toArray($foo);

// 获取内存使用情况
PhpHelper::System()::getMemoryUsage();

// 获取当前日期时间
PhpHelper::DateTime()::carbon()::now()->toDateTimeString()
```

## 算法 Algorithm

```php
// 冒泡排序
$arr = [1, 3, 2, 5, 4];
AlgorithmHelper::BubbleSort($arr);

// 快速排序
$arr = [1, 3, 2, 5, 4];
AlgorithmHelper::QuickSort($arr);

// 二分递归查找
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$target = 5;
$low = 0;
$high = count($arr) - 1;
AlgorithmHelper::BinarySearch($arr, $low, $high, $target);
```

## 数组 Array

```php
// 把对象或者数组对象，转成数组
ArrayHelper::toArray($object, $properties = [], $recursive = true);
// 获取对象或者数组的指定的值
ArrayHelper::getValue($array, $key, $default = null);
// 根据指定的key，建立key对应索引的数组，或者分组后的索引数组
ArrayHelper::index($array, $key, $groups = []);
// 把数组转成 key-value 的形式
ArrayHelper::map($array, $from, $to, $group = null);
// 检查数组是否是列索引
ArrayHelper::isAssoc($array);
// 递归获取指定下标数组
ArrayHelper::getTree($array);
```

## 文件 File

```php
// 把文件大小格式化成友好格式
FileHelper::format($bytes, $decimals = 2);
// 创建目录
FileHelper::createDir(string $path, int $mode = 0777, bool $recursive = true);
// 删除文件 和 目录
FileHelper::delDir($path, $isDelCurrent = false);
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
```

## 网际协议 IP

```php
// 获取客户端真实IP
IPHelper::remoteIp($useProxy = false);
// 生成随机中国IP（爬虫伪造ip）
IPHelper::randIprandChineseIp();
```

## 字符串 Str

```php
// 生成唯一数字 eg: YYYYMMDDHHIISSNNNNNNNNCC 24
StrHelper::uniqueShortStr();
// 生成短的唯一码，可以根据编码的值推算出来年、月、日
// 短唯一码的起始年份，默认是2020年
//【A:对应年】+【6：月16进制】+【04:日期】+【57112：时间戳后五位】+【46633：毫秒5位】+【随机两位】
// 注意：
// 1.如果年份年份大于24年，则对第一个字符倍增操作，比如我们程序运行到2047年的时候 则以 AA 开头，
// 2.如果传入的起始年份大于当前年份，则返回的字符串前面增加“-”符号
StrHelper::uniqueDateNum();
//生成唯一的 guid
StrHelper::uniqueGuid();
//随机字长度的随机字符串
StrHelper::randStr($length = 6, $type = 'string');
```

## 验证 Validate

```php
// 验证手机号
ValidateHelper::isPhone($phone);
// 验证邮箱
ValidateHelper::isEmail($email);
// 验证是不是http开头的地址
ValidateHelper::isHttp($str);
// 验证是否是 json 字符串
ValidateHelper::isJson($str);
```

## 运行时 Runtime

```php
// 启动计时
RuntimeHelper::instance()->start();
// 结束计时并返回消耗的时间（单位 毫秒）
RuntimeHelper::instance()->stop();
// 重新开始计时
RuntimeHelper::instance()->reset();
```

## 系统 System

```php
// 获取内存使用情况
SystemHelper::getMemoryUsage();
// 获取内存使用情况
SystemHelper::logMsg($msg, $file = './log.txt');
```

## 编码加密 Encode/Crypto

```php
// 使用 AES ECB 算法模式加密数据
CryptoHelper::aesEcbEncrypt($data, $key);
// 使用 AES ECB 算法模式解密数据
CryptoHelper::aesEcbDecrypt($data, $key);

更多内容请查看 CryptoHelper
```

## 时间日期 Datetime

```php
// 创建实例
$carbon = DateTimeHelper::carbon();
// 明天时间
$tomorrow = $carbon::now()->addDay();
// 最后一周
$lastWeek = $carbon::now()->subWeek();
// Rfc2822
$officialDate = DateTimeHelper::carbon()::now()->toRfc2822String();

更多内容请查看 Carbon 文档 https://github.com/briannesbitt/Carbon
```

## 致谢 Thank

该项目来之各开源项目收录和整理，持续更新中ing...

1、https://github.com/jasonyqwang/Utils

2、https://github.com/duke-git/lancet

3、https://github.com/briannesbitt/Carbon
