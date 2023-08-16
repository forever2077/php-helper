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

更多内容请查看文档 https://github.com/briannesbitt/Carbon
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

更多内容请查看文档 https://image.intervention.io/v2/
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
    CsvHelper::writeFromArray($data, $filePath, $headers);
} catch (Exception $e) {
    echo $e->getMessage();
}

// 从CSV文件读取数据并返回数组
try {
    $result = CsvHelper::readToArray($filePath);
} catch (Exception $e) {
    echo $e->getMessage();
}

// CSV写入器
CsvHelper::writer();

// CSV读取器
CsvHelper::reader();

更多内容请查看文档 https://csv.thephpleague.com/9.0/
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

更多内容请查看文档 https://docs.guzzlephp.org/en/stable/
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

更多内容请查看文档 https://github.com/PHPMailer/PHPMailer
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
更多内容请查看文档 https://phpspreadsheet.readthedocs.io

// word文档处理实例
OfficeHelper::world();
使用前需先安装 composer require phpoffice/phpword 
更多内容请查看文档 https://phpword.readthedocs.io
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

更多内容请查看文档 https://github.com/hassankhan/config
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

更多内容请查看文档 https://github.com/vlucas/phpdotenv
```

## 唯一标识符 UUID

```php
// UUID1
$uuid = UuidHelper::uuid1();
// UUID2
$localId = new Integer(1001);
$nodeProvider = new StaticNodeProvider(new Hexadecimal('121212121212'));
$clockSequence = 63;
$uuid = UuidHelper::uuid2(
	Uuid::DCE_DOMAIN_ORG,
	$localId,
	$nodeProvider->getNode(),
	$clockSequence
);
// UUID3
$uuid = UuidHelper::uuid3(Uuid::NAMESPACE_URL, 'https://www.php.net');
// UUID4
$uuid = UuidHelper::uuid4();
// UUID5
$uuid = UuidHelper::uuid5(Uuid::NAMESPACE_URL, 'https://www.php.net');
// UUID6
$uuid = UuidHelper::uuid6();
// UUID8
$uuid = UuidHelper::uuid8("\x00\x11\x22\x33\x44\x55\x66\x77\x88\x99\xaa\xbb\xcc\xdd\xee\xff");
// GUID
$guid = UuidHelper::guid($withBrackets = true);

更多内容请查看文档 https://uuid.ramsey.dev/en/stable/
```

## 编码 Json

```php
// Json 查询
JsonHelper::search('foo.bar', ['foo' => ['bar' => 1]]);
JsonHelper::search('foo[*].bar', ['foo' => [['bar' => 1], ['bar' => 2]]]);
JsonHelper::search('foo[*].bar', '{"foo":[{"bar":1},{"bar":2}]}');
// 结果AST缓存到内存
JsonHelper::search('foo.bar', ['foo' => ['bar' => 1]], ['mode' => 'ast']);
// 结果编译成JMESPath语法后缓存（性能最佳），需指定缓存目录
JsonHelper::search('foo.bar', ['foo' => ['bar' => 1]], ['mode' => 'compiler', 'path' => $path]);
更多内容请查看文档 https://github.com/jmespath/jmespath.php

// JSON 语法检查
JsonHelper::lint('{"foo":1}', JsonParser::DETECT_KEY_CONFLICTS);
JsonHelper::lint(['foo' => 1, 'bar'], JsonParser::DETECT_KEY_CONFLICTS);
更多内容请查看文档 https://github.com/Seldaek/jsonlint

// JSON 映射器
$json = '{"name":"Sheldon Cooper","address":{"street":"2311 N. Los Robles Avenue","city":"Pasadena"}}';
JsonHelper::mapper($json, new Contact);

class Contact
{
    public string $name;
    public Address $address;
}
class Address
{
    public $street;
    public $city;
    public function getGeoCoords(){}
}
$json = [
	'name' => 'Sheldon Cooper',
	'address' => [
		'street' => '2311 N. Los Robles Avenue',
		'city' => 'Pasadena'
	]
];
JsonHelper::mapper($json, new Contact);
更多内容请查看文档 https://github.com/cweiske/jsonmapper

// Json 流式解析器，支持传入：File、Stream、Iterable
$users = JsonHelper::parseStream('500MB-users.json');
foreach ($users as $id => $user) {
    var_dump($user->name);
}

更多内容请查看文档 https://github.com/halaxa/json-machine
```

## 压缩 Zip

```php
// 创建压缩包
$zip = ZipHelper::instance();
$zip->create('test.zip');
$zip->add('test1.txt');
$zip->add('test2.txt');
$zip->close();
// 解压文件
$zip->extract('./');
// 设置解压密码（对加密文件无效）
$zip->setPassword('s123123');
// 管理模式
$manager = ZipHelper::instance(true);
// 设置文件加密（每个文件单独设置）
$zip = ZipHelper::instance();
$zip->create($this->path . '/test.pw.zip');
$zip->setPath($this->path);
$zip->add('test.txt');
$zip->getArchive()->setEncryptionName('test.txt', ZipArchive::EM_AES_256, 's123123');
$zip->close();

更多内容请查看文档 https://github.com/ZanySoft/Laravel-Zip
```

## 文档处理 XML

```php
// 写入XML文档
$xmlService = XmlHelper::instance();
$xmlService->namespaceMap = ['http://example.org' => 'b'];
$xmlStr = $xmlService->write('{http://example.org}book', [
    '{http://example.org}title' => 'Cryptonomicon',
    '{http://example.org}author' => 'Neil Stephenson',
]);

// 读取XML文档
$input = <<<XML
<article xmlns="http://example.org/">
<title>Hello world</title>
<content>Fuzzy Pickles</content>
</article>
XML;

$xmlService = XmlHelper::instance();
$xmlService->elementMap = [
    '{http://example.org/}article' => 'Sabre\Xml\Element\KeyValue',
];
$output = $xmlService->parse($input);

更多内容请查看文档 https://github.com/sabre-io/xml
```

## 资源标识符 URI

```php
$uri = UriHelper::instance('https://www.baidu.com/s?wd=php%20uri%20helper#hash');
$this->assertEquals('https', $uri->getScheme());
$this->assertEquals('www.baidu.com', $uri->getHost());
$this->assertEquals('/s', $uri->getPath());
$this->assertEquals('wd=php%20uri%20helper', $uri->getQuery());
$this->assertEquals('hash', $uri->getFragment());

更多内容请查看文档 https://github.com/guzzle/psr7
```

## 阿里云 Aliyun

```php
// 阿里云开放API
AliyunHelper::ecs()::v20140526();
使用前需先安装 composer require alibabacloud/sdk
更多内容请查看文档
https://next.api.aliyun.com/
https://github.com/aliyun/openapi-sdk-php-client/blob/master/docs/zh-CN/3-Request.md

// 阿里云对象存储服务
AliyunHelper::oss(OSS_ACCESSKEYID,OSS_ACCESSKEYSECRET,OSS_ENDPOINT);
使用前需先安装 composer require aliyuncs/oss-sdk-php
更多内容请查看文档 https://help.aliyun.com/zh/oss/developer-reference/php-1/
```

## 支付宝 Alipay

```php
// 支付宝通用版v3
AlipayHelper::v3();
使用前需先安装 composer require alipaysdk/openapi
更多内容请查看文档 https://open.alipay.com/

// 支付宝Easy版
AlipayHelper::easy();
使用前需先安装 composer require alipaysdk/easysdk:^2.0
更多内容请查看文档 https://opendocs.alipay.com/common/02nlge
```

## 腾讯云 TencentCloud

```php
// 腾讯云开放API
TencentCloudHelper::client();
使用前需先安装 composer require tencentcloud/tencentcloud-sdk-php
更多内容请查看文档 
https://cloud.tencent.com/api/list
https://github.com/TencentCloud/tencentcloud-sdk-php

// 腾讯云对象存储服务
TencentCloudHelper::cos($cosConfig);
使用前需先安装 composer require qcloud/cos-sdk-v5
更多内容请查看文档 https://github.com/tencentyun/cos-php-sdk-v5
```

## 致谢 Thank

项目来之各开源项目收录和整理，持续更新中ing...
