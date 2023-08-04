<?php

namespace Forever2077\PhpHelper;

/**
 * Class PhpHelper PHP辅助类
 * @method static AlgorithmHelper Algorithm()   提供各种算法相关的功能
 * @method static ArrayHelper Array()           数组处理工具库
 * @method static BloomHelper Bloom()           布隆过滤器相关的功能
 * @method static CacheHelper Cache()           缓存相关的功能
 * @method static CaptchaHelper Captcha()       验证码生成和验证功能
 * @method static CryptoHelper Crypto()         加密技术相关的功能
 * @method static CsvHelper Csv()               用于处理CSV文件的功能
 * @method static DateTimeHelper DateTime()     日期和时间相关的功能
 * @method static DfaHelper Dfa()               DFA字符串匹配算法相关的功能
 * @method static EmailHelper Email()           邮件发送和验证的功能
 * @method static ErrorHelper Error()           错误处理的功能
 * @method static FileHelper File()             文件操作的功能
 * @method static HttpHelper Http()             HTTP相关的功能
 * @method static ImageHelper Image()           图片处理的功能
 * @method static IpHelper Ip()                 IP地址处理的功能
 * @method static JsonHelper Json()             JSON相关的功能
 * @method static JwtHelper Jwt()               JSON Web令牌(JWT)相关的功能
 * @method static LogHelper Log()               日志相关的功能
 * @method static LruCacheHelper LruCache()     LRU缓存相关的功能
 * @method static MapHelper Map()               地图相关的功能
 * @method static MathHelper Math()             数学函数相关的功能
 * @method static NetHelper Net()               网络相关的功能
 * @method static OfficeHelper Office()         处理Office文档的功能
 * @method static PayHelper Pay()               支付相关的功能
 * @method static RandomHelper Random()         生成随机值的功能
 * @method static RuntimeHelper Runtime()       运行时和性能测量功能
 * @method static SmsHelper Sms()               短信相关的功能
 * @method static StrHelper Str()               字符串操作的功能
 * @method static SystemHelper System()         系统相关的功能
 * @method static ToolsHelper Tools()           各种工具和辅助功能
 * @method static TreeHelper Tree()             打印数据树结构处理的功能
 * @method static ValidateHelper Validate()     内容验证功能
 * @method static VersionHelper Version()       版本比较和处理的功能
 * @method static XmlHelper Xml()               XML解析和生成的功能
 * @method static ZipHelper Zip()               处理ZIP压缩文件的功能
 */
class PhpHelper
{
    /**
     * 存储所有辅助类的单例
     * @var array
     */
    private static array $helpers = [];

    /**
     * 使用魔术方法 __callStatic 处理对未定义的静态方法的调用
     * @param string $name 未定义的静态方法的名称
     * @param mixed $arguments 调用静态方法时传递的参数
     * @return mixed 对应的辅助类的单例
     * @throws \Exception 如果对应的辅助类不存在
     */
    public static function __callStatic(string $name, mixed $arguments): mixed
    {
        // 获取当前命名空间
        $namespace = (new \ReflectionClass(__CLASS__))->getNamespaceName();

        // 构造完整类名
        $class = ucfirst($name) . 'Helper';
        $fullClassName = $namespace . '\\' . $class;

        // 如果该类的单例还未创建，则创建该类的单例
        if (!isset(self::$helpers[$class])) {
            try {
                // 尝试创建该类的单例
                self::$helpers[$class] = new $fullClassName($arguments);
            } catch (\Error $e) {
                // 如果该类不存在，则抛出异常
                throw new \Exception("Class $fullClassName does not exist");
            }
        }

        // 返回该类的单例
        return self::$helpers[$class];
    }
}
