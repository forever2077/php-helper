<?php

namespace Forever2077\PhpHelper;

use Error;
use Exception;
use ReflectionClass;

/**
 * Class PhpHelper PHP辅助类
 * @method static AlgorithmHelper      Algorithm()       算法
 * @method static ArrayHelper          Array()           数组处理
 * @method static BloomHelper          Bloom()           布隆过滤器
 * @method static CacheHelper          Cache()           缓存
 * @method static CaptchaHelper        Captcha()         验证码
 * @method static CryptoHelper         Crypto()          加密解密与常用编码
 * @method static CsvHelper            Csv()             CSV文件处理
 * @method static DataStructureHelper  DataStructure()   数据结构
 * @method static DateTimeHelper       DateTime()        日期和时间
 * @method static DfaHelper            Dfa()             DFA字符串匹配算法
 * @method static EmailHelper          Email()           邮件发送和验证
 * @method static ErrorHelper          Error()           错误处理
 * @method static FileHelper           File()            文件操作
 * @method static GeoHelper            Geo()             地理国家省市
 * @method static HttpHelper           Http()            HTTP
 * @method static ImageHelper          Image()           图片处理
 * @method static IpHelper             Ip()              IP地址
 * @method static JsonHelper           Json()            JSON相
 * @method static JwtHelper            Jwt()             JSON Web令牌(JWT)
 * @method static LogHelper            Log()             日志相关
 * @method static LruCacheHelper       LruCache()        LRU缓存
 * @method static MapHelper            Map()             地图相关
 * @method static MathHelper           Math()            数学函数
 * @method static NetHelper            Net()             网络相关
 * @method static OfficeHelper         Office()          Office文档处理
 * @method static PayHelper            Pay()             支付相关
 * @method static RandomHelper         Random()          随机字符串生成
 * @method static RuntimeHelper        Runtime()         运行时和性能测量
 * @method static SmsHelper            Sms()             短信相关
 * @method static StrHelper            Str()             字符串操作
 * @method static SystemHelper         System()          系统相关
 * @method static ToolsHelper          Tools()           其他工具
 * @method static ValidateHelper       Validate()        内容验证
 * @method static VersionHelper        Version()         版本比较和处理
 * @method static XmlHelper            Xml()             XML解析和生成
 * @method static ZipHelper            Zip()             处理ZIP压缩文件
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
     * @throws Exception 如果对应的辅助类不存在
     */
    public static function __callStatic(string $name, mixed $arguments): mixed
    {
        // 获取当前命名空间
        $namespace = (new ReflectionClass(__CLASS__))->getNamespaceName();

        // 构造完整类名
        $class = ucfirst($name) . 'Helper';
        $fullClassName = $namespace . '\\' . $class;

        // 如果该类的单例还未创建，则创建该类的单例
        if (!isset(self::$helpers[$class])) {
            try {
                // 尝试创建该类的单例
                self::$helpers[$class] = new $fullClassName($arguments);
            } catch (Error $e) {
                // 如果该类不存在，则抛出异常
                throw new Exception("Class $fullClassName does not exist");
            }
        }

        // 返回该类的单例
        return self::$helpers[$class];
    }
}
