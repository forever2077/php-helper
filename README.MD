## PHP 助手类/工具包

[![PHP 8.1](https://img.shields.io/badge/PHP-8.1-8892BF.svg)](https://www.php.net/releases/8.1/en.php) [![License](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT) [![PHPUnit Tests](https://img.shields.io/badge/PHPUnit-Passed-brightgreen.svg)](https://phpunit.de/) [![Development Status](https://img.shields.io/badge/Development-Active-brightgreen.svg)](https://your-project-repo-link)

## 安装 Install

```php
// 初始化 composer.json
composer require forever2077/php-helper:"@dev" --no-install
// 仅安装主要依赖包，排除体积较大项目按需安装（阿里云、腾讯云、地理数据等）
composer install --no-dev
```

## 辅助类 Helper

```php
// 冒泡排序
Helper::algorithm()::BubbleSort([1, 3, 2, 5, 4]);
// 获取内存使用情况
Helper::system()::getMemoryUsage();
// 获取当前日期时间
Helper::dateTime()::now()->toDateTimeString();
支持所有辅助类;
```

## 文档目录


|                云服务与API                |                     编程与算法                     |           配置与环境变量           |                文件与数据处理                |
| :----------------------------------------: | :-------------------------------------------------: | :--------------------------------: | :-------------------------------------------: |
|       [阿里云 Aliyun](doc/Aliyun.md)       |         [算法 Algorithm](doc/Algorithm.md)         |     [环境变量 Env](doc/Env.md)     |           [文件 File](doc/File.md)           |
| [腾讯云 TencentCloud](doc/TencentCloud.md) |             [数组 Array](doc/Array.md)             |  [运行时 Runtime](doc/Runtime.md)  |            [压缩 Zip](doc/Zip.md)            |
|       [支付宝 Alipay](doc/Alipay.md)       |    [布隆过滤器 BloomFilter](doc/BloomFilter.md)    |    [系统 System](doc/System.md)    |          [文档处理 CSV](doc/CSV.md)          |
|        [微信 Wechat](doc/Wechat.md)        |         [协程 Coroutine](doc/Coroutine.md)         |    [配置 Config](doc/Config.md)    | [编码加密 Encode/Crypto](doc/EncodeCrypto.md) |
|      [百度AI BaiduAi](doc/BaiduAi.md)      |                                                    |                                    |           [编码 Json](doc/Json.md)           |
|                 网络与通信                 |                     身份与安全                     |            其他实用工具            |                  邮件与注解                  |
|        [网络请求 Http](doc/Http.md)        |          [验证码 Captcha](doc/Captcha.md)          |   [图片处理 Image](doc/Image.md)   |          [邮件 Email](doc/Email.md)          |
|          [网际协议 IP](doc/IP.md)          |      [身份标识 Identity ID](doc/IdentityID.md)      |     [缓存 Cache](doc/Cache.md)     |     [注解 Annotation](doc/Annotation.md)     |
|       [支付 Payment](doc/Payment.md)       |               [认证 Jwt](doc/Jwt.md)               |  [缓存 LruCache](doc/LRUCache.md)  |                                              |
|           [短信 SMS](doc/SMS.md)           |               [日志 Log](doc/Log.md)               | [调试器 Debugger](doc/Debugger.md) |                                              |
|    [时间日期 Datetime](doc/Datetime.md)    | [密码与安全 Validate/Assert](doc/ValidateAssert.md) |      [数据库 ORM](doc/ORM.md)      |                                              |
|        [认证 OAuth2](doc/OAuth2.md)        |                                                    |    [拼音 Pinyin](doc/Pinyin.md)    |                                              |

## Composer 源管理工具（可选）

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

## 致谢 Thank

* 项目来之各开源项目收录和整理，持续更新中ing...

## 许可 License

* 本项目基于MIT许可，并包含了基于Apache 2.0许可的代码
