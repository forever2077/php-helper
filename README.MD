# PHP 助手类/工具包

## 安装

```php
composer require forever2077/php-helper:"@dev"
```

## 单例+懒加载模式 or 代理函数

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
PhpHelper::DateTime()::carbon()::now()->toDateTimeString();

// 代理函数
_algorithm()::BubbleSort($arr);
_array()::toArray($foo);
_dateTime()::carbon()::now()->toDateTimeString();
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

## 图片处理 Image

```php
// 创建实例
$intervention = ImageHelper::intervention(['driver' => 'gd']);
$image = $intervention->canvas(400, 300, '#000000');
$image->text('Hello, world!', 200, 150, function ($font) {
	$font->size(60);
	$font->color('#FFFFFF');
	$font->align('center');
	$font->valign('middle');
});
$path = __DIR__ . '/output.jpg';
$image->save($path);

使用前需先安装 composer require intervention/image
更多内容请查看 Intervention 文档 https://image.intervention.io/v2/
```

## 文档处理 CSV

```php
// 将数组写入CSV文件
$data = [
    ['foo', 'bar'],
    ['baz', 'qux'],
];
$headers = ['header1', 'header2'];
$filePath = __DIR__ . '/output.csv';
try {
    CsvHelper::writeCsvFromArray($data, $filePath, $headers);
} catch (Exception $e) {
    echo $e->getMessage();
}

// 从CSV文件读取数据并返回数组
try {
    $result = CsvHelper::readCsvToArray($filePath);
} catch (Exception $e) {
    echo $e->getMessage();
}

// CSV写入器
CsvHelper::writer();

// CSV读取器
CsvHelper::reader();

使用前需先安装 composer require league/csv:^9.0
更多内容请查看 league/csv 文档 https://csv.thephpleague.com/9.0/
```

## 网络请求 Http

```php
// 请求baidu链接并检查200状态
try {
    $client = HttpHelper::instance();
    $response = $client->request('GET', 'https://www.baidu.com', [
        'verify' => __DIR__ . '/cacert.pem',
    ]);
    $this->assertEquals(200, $response->getStatusCode());
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

// 获取guzzle实例
HttpHelper::guzzle();

// Get请求
$response = HttpHelper::get([
    'url' => 'https://www.baidu.com',
    'options' => [
        'verify' => __DIR__ . '/cacert.pem',
    ],
]);

// Post请求
$response = HttpHelper::post([
    'url' => 'https://www.baidu.com',
    'options' => [
        'verify' => __DIR__ . '/cacert.pem',
    ],
]);

使用前需先安装 composer require guzzlehttp/guzzle:^7.7
更多内容请查看 guzzlehttp 文档 https://docs.guzzlephp.org/en/stable/
```

## 邮件 Email

```php
// SMTP邮件发送
$mail = EmailHelper::phpMailer();
try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;            // Enable verbose debug output
    $mail->isSMTP();                                  // Send using SMTP
    $mail->Host = 'smtp.example.com';                 // Set the SMTP server to send through
    $mail->SMTPAuth = true;                           // Enable SMTP authentication
    $mail->Username = 'user@example.com';             // SMTP username
    $mail->Password = 'secret';                       // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // Enable implicit TLS encryption
    $mail->Port = 465;                                // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User'); // Add a recipient
    $mail->addAddress('ellen@example.com');           // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    // Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');       // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');  // Optional name

    // Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

使用前需先安装 composer require phpmailer/phpmailer
更多内容请查看 phpmailer 文档 https://github.com/PHPMailer/PHPMailer
```

## 文档处理 Office

```php
// 生成36列100行模拟数据并保存到excel
$titles = range('A', 'Z');
for ($i = 0; $i < 10; $i++) {
    $titles[] = 'A' . chr(ord('A') + $i);
}

$data = [];
for ($i = 0; $i < 100; $i++) {
    $row = [];
    for ($j = 0; $j < count($titles); $j++) {
        $row[] = $titles[$j] . ($i + 1);
    }
    $data[] = $row;
}

$options = [
    'data' => $data,
    'titles' => $titles,
    'filePath' => __DIR__ . '/test.xlsx',
    'dataFilter' => function ($value) {
        return $value . 'x';
    },
    'dataCallback' => function ($spreadsheet) {
        // 回调方法
    },
];

try {
    OfficeHelper::saveToExcel($options);
} catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {}

// 读取excel
$options = [
    'filePath' => __DIR__ . '/test.xlsx',
    'dataCallback' => function ($spreadsheet) {
        // 回调方法
    },
];
try {
    $data = OfficeHelper::readFromExcel($options);
} catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {}

// excel文档处理实例
OfficeHelper::excel();
使用前需先安装 composer require phpoffice/phpspreadsheet
更多内容请查看 phpspreadsheet 文档 https://phpspreadsheet.readthedocs.io

// word文档处理实例
OfficeHelper::world();
使用前需先安装 composer require phpoffice/phpword 
更多内容请查看 phpspreadsheet 文档 https://phpword.readthedocs.io
```

## 配置 Config

```php
// 从字符串中加载
$settingsJson = <<<FOOBAR
{
  "application": {
    "name": "configuration",
    "secret": "s3cr3t"
  },
  "host": "localhost",
  "port": 80,
  "servers": [
    "host1",
    "host2",
    "host3"
  ]
}
FOOBAR;

$jsonConfig = ConfigHelper::instance($this->settingsJson);
$jsonConfig['application.name'];

// 从文件中加载(默认Json解释器)
ConfigHelper::instance('config.json');
// 加载yaml文件并转成ini（支持：yaml、ini、xml、php、serialize、properties）
ConfigHelper::instance('config.yaml', 'ini');
// 从多个文件加载值
ConfigHelper::instance(['config.json', 'config.xml']);
// 加载目录中所有支持的文件
ConfigHelper::instance(__DIR__ . '/config');
// 从可选文件加载值
ConfigHelper::instance(['config.dist.json', '?config.json']);

更多内容请查看 config 文档 https://github.com/hassankhan/config
```

## 环境变量 Env

```php
// 将数组保存为.env文件
$env = EnvHelper::instance(__DIR__);
$env->save(['foo' => 'bar']);
// 获取foo变量
$env->get('foo');
// 获取失败后默认值
$env->get('foo', 'bar');
// 获取foo变量并校验规则
$env->get('foo', function (Dotenv\Dotenv $dotenv) {
    $dotenv->required('bar')->allowedValues(['bar']);
})；
// 检查foo变量是否存在
$env->has('foo');
// 设置bar值为foo
$env->set('bar', 'foo');

更多内容请查看 env 文档 https://github.com/vlucas/phpdotenv
```

## 致谢 Thank

该项目来之各开源项目收录和整理，持续更新中ing...
