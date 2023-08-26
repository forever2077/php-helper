# PHP 助手类/工具包

[![PHP 8.1](https://img.shields.io/badge/PHP-8.1-8892BF.svg)](https://www.php.net/releases/8.1/en.php) [![PHPUnit Tests](https://img.shields.io/badge/PHPUnit-Passed-brightgreen.svg)](https://phpunit.de/) [![License](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT) [![Development Status](https://img.shields.io/badge/Development-Active-brightgreen.svg)](https://your-project-repo-link)

## Composer源管理工具

```php
// 使用composer安装
composer global require slince/composer-registry-manager
// 列出可用的所有镜像源
composer repo:ls
// 使用镜像源
composer repo:use tencent
文档 https://github.com/slince/composer-registry-manager/blob/master/README-zh_CN.md
注意 有个别项目在某些源已不更新，可切换回composer官方源即可解决
```

## 安装

```php
// 初始化 composer.json
composer require forever2077/php-helper:"@dev" --no-install
// 仅安装主要依赖包，排除体积较大项目按需安装（阿里云、腾讯云、地理数据等）
composer install --no-dev
```

## 辅助类

```php
// 冒泡排序
$arr = [1, 3, 2, 5, 4];
Helper::algorithm()::BubbleSort($arr);

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
Helper::array()::toArray($foo);

// 获取内存使用情况
Helper::system()::getMemoryUsage();
// 获取当前日期时间
Helper::dateTime()::carbon()::now()->toDateTimeString();
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

// 网络地址类型判断
$address = IpHelper::networkAddress('127.0.0.1');
$this->assertInstanceOf(IPv4Address::class, $address);
$address = IpHelper::networkAddress('127.0.0.1/8');
$this->assertInstanceOf(CIDRv4Address::class, $address);
$address = IpHelper::networkAddress('::1');
$this->assertInstanceOf(IPv6Address::class, $address);
$address = IpHelper::networkAddress('ff80::1/64');
$this->assertInstanceOf(CIDRv6Address::class, $address);
$address = IpHelper::networkAddress('84:34:ff:ff:ff:ff');
$this->assertInstanceOf(MACAddress::class, $address);
// 网络地址对比
$this->assertIsBool(IpHelper::networkAddress('::1')->equals(IpHelper::networkAddress('::1')));
// 判断目标IP是否在CIDR域内
$cidr = IpHelper::networkAddress('192.168.0.7/8');
$network = $cidr->toNetwork();
$this->assertIsBool($network->containsAddress(IpHelper::networkAddress('192.168.0.1')));
文档 https://github.com/lukanetconsult/network-address-types
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

## 验证/断言 Validate/Assert

```php
// 检查字符串是否为有效的电子邮件地址，错误抛出异常提示语
ValidateHelper::email('alganet@gmail.com', 'Email (%s) is invalid');
文档 https://github.com/webmozarts/assert

// 检查字符串是否为有效的电子邮件地址，返回bool类型
ValidateHelper::rule()::email()->validate('alganet@gmail.com');
文档 https://respect-validation.readthedocs.io/en/latest/list-of-rules/

// 检查护照号格式是否正确（默认：中国）
ValidateHelper::isPassportNumber('EA1234567');
// 计划从 validator.js 移植
文档 https://github.com/validatorjs/validator.js
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

文档 https://github.com/briannesbitt/Carbon
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

文档 https://image.intervention.io/v2/
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

文档 https://csv.thephpleague.com/9.0/
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

文档 https://docs.guzzlephp.org/en/stable/
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

文档 https://github.com/PHPMailer/PHPMailer

// 根据RPC规则验证邮件地址
EmailHelper::validator()->isValid("example@example.com", new RFCValidation())；

文档 https://github.com/egulias/EmailValidator
```

## 短信 SMS

```php
$config = [
    'timeout' => 5.0,
    'default' => [
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,
        'gateways' => [
            'yunpian', 'aliyun',
        ],
    ],
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        'yunpian' => [
            'api_key' => '824f0ff2f71cab52936axxxxxxxxxx',
        ],
        'aliyun' => [
            'access_key_id' => '',
            'access_key_secret' => '',
            'sign_name' => '',
        ],
    ],
];
SmsHelper::instance($config)->send('13500000001', [
    'content' => '您的验证码为: 6379',
    'template' => 'SMS_001',
    'data' => [
        'code' => 6379
    ]
]);
文档 https://github.com/overtrue/easy-sms
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
文档 https://phpspreadsheet.readthedocs.io

// word文档处理实例
OfficeHelper::world();

文档 https://phpword.readthedocs.io
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

文档 https://github.com/hassankhan/config
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

文档 https://github.com/vlucas/phpdotenv
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

文档 https://uuid.ramsey.dev/en/stable/
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
文档 https://github.com/jmespath/jmespath.php

// JSON 语法检查
JsonHelper::lint('{"foo":1}', JsonParser::DETECT_KEY_CONFLICTS);
JsonHelper::lint(['foo' => 1, 'bar'], JsonParser::DETECT_KEY_CONFLICTS);
文档 https://github.com/Seldaek/jsonlint

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
文档 https://github.com/cweiske/jsonmapper

// Json 流式解析器，支持传入：File、Stream、Iterable
$users = JsonHelper::parseStream('500MB-users.json');
foreach ($users as $id => $user) {
    var_dump($user->name);
}

文档 https://github.com/halaxa/json-machine
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

文档 https://github.com/ZanySoft/Laravel-Zip
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

文档 https://github.com/sabre-io/xml
```

## 资源标识符 URI

```php
$uri = UriHelper::instance('https://www.baidu.com/s?wd=php%20uri%20helper#hash');
$this->assertEquals('https', $uri->getScheme());
$this->assertEquals('www.baidu.com', $uri->getHost());
$this->assertEquals('/s', $uri->getPath());
$this->assertEquals('wd=php%20uri%20helper', $uri->getQuery());
$this->assertEquals('hash', $uri->getFragment());

文档 https://github.com/guzzle/psr7
```

## 阿里云 Aliyun

```php
// 阿里云开放API
AliyunHelper::ecs()::v20140526();
安装 composer require alibabacloud/sdk
文档
https://next.api.aliyun.com/
https://github.com/aliyun/openapi-sdk-php-client/blob/master/docs/zh-CN/3-Request.md

// 阿里云对象存储服务
AliyunHelper::oss(OSS_ACCESSKEYID,OSS_ACCESSKEYSECRET,OSS_ENDPOINT);
安装 composer require aliyuncs/oss-sdk-php
文档 https://help.aliyun.com/zh/oss/developer-reference/php-1/
```

## 支付宝 Alipay

```php
// 支付宝通用版v3
AlipayHelper::v3();
安装 composer require alipaysdk/openapi
文档 https://open.alipay.com/

// 支付宝Easy版
AlipayHelper::easy();
安装 composer require alipaysdk/easysdk:^2.0
文档 https://opendocs.alipay.com/common/02nlge
```

## 腾讯云 TencentCloud

```php
// 腾讯云开放API
TencentCloudHelper::client();
安装 composer require tencentcloud/tencentcloud-sdk-php
文档 
https://cloud.tencent.com/api/list
https://github.com/TencentCloud/tencentcloud-sdk-php

// 腾讯云对象存储服务
TencentCloudHelper::cos($cosConfig);
文档 https://github.com/tencentyun/cos-php-sdk-v5
```

## 百度AI BaiduAi

```php
// 文字识别
BaiduHelper::aipOcr($appId, $apiKey, $secretKey);
// 人脸识别
BaiduHelper::aipFace($appId, $apiKey, $secretKey);

文档 https://ai.baidu.com/sdk
```

## 微信 Wechat

```php
// 微信公众号
WechatHelper::officialAccount($config);
// 微信支付
WechatHelper::pay($config);
// 微信小程序
WechatHelper::miniApp($config);
// 微信开放平台
WechatHelper::openPlatform($config);
// 企业微信
WechatHelper::work($config);
// 企业微信开放平台
WechatHelper::openWork($config);

文档 https://easywechat.com/6.x/
```

## 支付 Payment

```php
// 支付宝
PayHelper::alipay($config);
// 微信支付
PayHelper::wechat($config);
// 银联
PayHelper::unipay($config);

文档 https://pay.yansongda.cn/docs/v3/
```

## 认证 OAuth2

```php
/** 
 * 支持平台有：
 * Facebook，Github，Google，Linkedin，Outlook，QQ，TAPD，支付宝，淘宝，
 * 百度，钉钉，微博，微信，抖音，飞书，Lark，豆瓣，企业微信，腾讯云，Line，Gitee，Coding
 */
$config = [
    'github' => [
        'client_id' => 'your-app-id',
        'client_secret' => 'your-app-secret',
        'redirect' => 'http://localhost/socialite/callback.php',
    ],
];
$socialite = OAuth2Helper::socialite($config);
// 让用户跳转至平台认证
$url = $socialite->create('github')->redirect();
return redirect($url);

// 服务器收到平台回调 Code，使用 Code 换取平台处用户信息
$code = request()->query('code');
$user = $socialite->create('github')->userFromCode($code);
$user->getId();
$user->getName();
$user->getNickname();
$user->getEmail();
文档 https://github.com/overtrue/socialite

// OAuth2.0 授权服务器
OAuth2Helper::server(...);
文档 https://oauth2.thephpleague.com

// OAuth2.0 客户端
OAuth2Helper::client(...);
文档 https://oauth2-client.thephpleague.com
```

## 拼音 Pinyin

```php
$pinyin = PinyinHelper::sentence('你好，世界');
文档 https://github.com/overtrue/pinyin
```

## 终端 Terminal

```php
// 打印红色文字内容
Helper::terminal()->red('Whoa now this text is red.');
// 打印蓝色文字内容
Helper::terminal()->blue('Blue? Wow!');
文档 https://github.com/thephpleague/climate
```

## 地理国家 Geo/Country

```php
// 根据 ISO 3166-1 alpha-2 代码获取国家信息
GeoHelper::country('cn');
// 包含195个条目，来自193个联合国成员国主权国家（通常称为国家），加上巴勒斯坦和梵蒂冈城国这两个观察员国（英文版）
GeoHelper::getAllCountries('en', 'countries');
// 包含所有249个国家、地区和具有官方指定的ISO 3166-1代码的地理区域（简体版）
GeoHelper::getAllCountries('zh', 'world');
// 获取中国一至三级行政区域
GeoHelper::getChinaArea();
// 获取指定区域代码城市
GeoHelper::getChinaArea(542500000000);

文档 https://github.com/rinvex/countries
安装 composer require rinvex/countries
数据 https://github.com/stefangabos/world_countries  https://github.com/kakuilan/china_area_mysql
```

## 身份标识 Identity ID

```php
// 解析中国身份证号码
$ID = IdentityHelper::parseChineseID();
$passed = $ID->validateIDCard($pid);
$area = $ID->getArea($pid);
$gender = $ID->getGender($pid);
$birthday = $ID->getBirth($pid);
$age = $ID->getAge($pid);
$constellation = $ID->getConstellation($pid);

文档 https://github.com/douyasi/identity-card
```

## 随机字符串 RandomString

```php
// 生成32位随机字符串
RandomHelper::string(32)->generate();
// 生成指定配置的字符串
RandomHelper::string()::fromArray(['length' => 6, 'charset' => 'ABCD1234'])->generate();
// 使用StringConfig生成配置的随机字符串
RandomHelper::string(32,
    StringConfig::make()
        ->length(32)
        ->charset('~!@#$%^&*()_+85716253uygsdfdgfj')
)->generate();

文档 https://github.com/stfndamjanovic/php-random-string

// 生成随机UserAgent
RandomHelper::userAgent([
    'os_type' => 'Windows', 'device_type' => 'Mobile'
]);

文档 https://github.com/joecampo/random-user-agent
```

## 版本号 Version

```php
// 版本号是否符合要求
VersionHelper::complies('^7.0', '7.0.0'); // true
VersionHelper::complies('^7.0', '6.4.34'); // false
VersionHelper::complies('~1.1.0', '1.1.4'); // true
// 版本号对比
$leftVersion = Helper::version('3.0.0-alpha.1');
$rightVersion = Helper::version('3.0.0-alpha.2');
$leftVersion->isGreaterThan($rightVersion);
$rightVersion->isGreaterThan($leftVersion);

文档 https://github.com/phar-io/version
```

## 布隆过滤器 BloomFilter

```php
$bf = Helper::bloom(100000, 0.001);
$bf->add('item1');
$bf->exists('item1');

文档 https://github.com/pleonasm/bloom-filter
```

## 敏感词过滤器 Sensitive

```php
// DFA算法过滤器
$handle = SensitiveHelper::dfa($wordData = []);
$handle->islegal($badWord);
$handle->replace($badWord, '*', true);
$handle->replace($badWord, '***');
$handle->mark($badWord, '<mark>', '</mark>');
$handle->getBadWord($badWord)[0];
文档 https://github.com/FireLustre/php-dfa-sensitive

// AC算法过滤器
$handle = SensitiveHelper::ac($wordData = []);
$handle->add('...');
$handle->finalize();
$found = $handle->search($badWord);
文档 https://github.com/codeplea/ahocorasickphp
```

## 日志 Log

```php
$log = Helper::log();
$log->pushHandler(new TestHandler());
$log->warning('Foo');
$log->error('bar');
文档 https://seldaek.github.io/monolog/
```

## 调试器 Debugger

```php
// 默认开启调试器
DebugHelper::enable();
// 限制开发人员从特定IP地址访问
DebugHelper::enable('23.75.345.200');
// 记录异常
DebugHelper::log('Unexpected error');
文档 https://github.com/nette/tracy
```

## 异常 Exceptions

```php
try {
    // 异常处理标准库
    throw new \Exceptions\Data\NotFoundException();
} catch (\Exceptions\Data\NotFoundException $e) {
    $this->assertEquals('Data requested for cannot be found in the data source.', $e->getMessage());
}
文档 https://github.com/crazycodr/standard-exceptions
```

## 数学 Math

```php
// 代数
use MathPHP\Algebra;
$gcd = Algebra::gcd(8, 12);
// 算术
use MathPHP\Arithmetic;
$√x = Arithmetic::isqrt(8);
// 遍历
use MathPHP\Functions\Map;
$x = [1, 2, 3, 4];
$sums = Map\Single::add($x, 2);
文档 https://github.com/markrogoyski/math-php
```

## 协程 Coroutine

```php
use function Amp\async;
use function Amp\delay;

$future1 = async(function () {
    for ($i = 0; $i < 5; $i++) {
        echo 'A' . $i, PHP_EOL;
        delay(0.01);
    }
});

$future2 = async(function () {
    for ($i = 0; $i < 5; $i++) {
        echo 'B' . $i, PHP_EOL;
        delay(0.01);
    }
});

$future1->await();
$future2->await();

文档 https://amphp.org/amp
```

## 缓存 Cache

```php
use Phpfastcache\CacheManager;
// 缓存配置(可选)
CacheManager::setDefaultConfig(CacheHelper::config(['path' => __DIR__ . '/tmp']));
// 创建本地文本缓存系统
$cache = Helper::cache('files');
$cache->set('name', 'forever2077');
$cache->get('name');
// 创建事件
CacheHelper::event()->onCacheGetItem(function (ExtendedCacheItemPoolInterface $itemPool, ExtendedCacheItemInterface $item) {
    $item->set('[HACKED BY EVENT] ' . $item->get());
});

// Redis 缓存
$config = new RedisConfig([
    'host' => getenv('CACHE_REDIS_HOST'),          // 服务器地址
    'port' => (int)getenv('CACHE_REDIS_PORT'),     // 端口号
    'password' => getenv('CACHE_REDIS_PASSWORD'),  // 密码 (如果有)
    'database' => (int)getenv('CACHE_REDIS_DB'),   // 数据库索引
    'optPrefix' => getenv('CACHE_REDIS_PREFIX'),   // 前缀
]);
$cache = Helper::cache('redis', $config);
$cache->set('name', '......');
$cache->get('name');
$cache->delete('name');

文档 https://github.com/PHPSocialNetwork/phpfastcache
```

## 注解 Annotation

```php
// 方法前置处理
#[Before("beforeAction", ['a' => 3, 'b' => 4])] // 类内静态方法
// 方法后置处理
#[After(['AnnotationHelperTest', 'afterAction'], ['a' => 5, 'b' => 6])] // 非静态方法 or 其他类方法
// 方法结果缓存（支持：redis/files）
#[Cache(300, 'files', 'myDefined')] // 后续通过自定义ID获取内容，支持重叠使用
public function doAction(int $a = 0, int $b = 0): string {}
```

## 认证 Jwt

```php
$now = new DateTimeImmutable();
$token = JwtHelper::issuingTokens([
    'signing_algorithm' => 'ES512',
    'token_options' => [
        'issuedBy' => 'https://example.com',
        'relatedTo' => 'https://example.com',
        'permittedFor' => 'https://example.org',
        'identifiedBy' => '4f1g23a12aa',
        'issuedAt' => $now,
        'expiresAt' => $now->modify('+1 hour'),
        'canOnlyBeUsedAfter' => $now->modify('+1 minute'),
        'withClaim' => ['uid', 1],
        'withHeader' => [
            ['foo', 'bar'], ['baz', 'qux'],
        ],
    ]
]);
//dump($token);
$rtn = JwtHelper::parsingTokens($token);
//dump($rtn);
$this->assertEquals(1, $rtn->claims()->get('uid'));
$this->assertEquals('bar', $rtn->headers()->get('foo'));
$this->assertEquals('qux', $rtn->headers()->get('baz'));
$this->assertTrue(JwtHelper::validator($rtn, new HasClaimWithValue('uid', 1)));
$this->assertTrue(JwtHelper::validator($rtn, new RelatedTo('https://example.com')));
$this->assertTrue(JwtHelper::validator($rtn, new PermittedFor('https://example.org')));
$this->assertTrue(JwtHelper::validator($rtn, new IssuedBy('https://example.com')));
$this->assertTrue(JwtHelper::validator($rtn, new IdentifiedBy('4f1g23a12aa')));

文档 https://lcobucci-jwt.readthedocs.io/en/stable/
```

## 致谢 Thank

项目来之各开源项目收录和整理，持续更新中ing...
