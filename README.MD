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

|数据与文档处理 | 网络扩展与辅助工具 | 运行时、调试、框架、算法等 |
|---------------|--------------------|----------------------------|
|[字符串 Str](doc/Str.md) | [网络请求 Http](doc/Http.md) | [注解 Annotation](doc/Annotation.md)
|[字符串 Str（Advanced）](doc/StrAdvanced.md) | [网际协议 IP](doc/IP.md) | [协程 Coroutine](doc/Coroutine.md)
|[字符串 Str（UTF-8）](doc/StrUtf8.md) | [网络 Net](doc/Net.md) | [异常 Exceptions](doc/Exceptions.md)
|[字符串 Str（ASCII）](doc/StrAscii.md) | [域名 Domain](doc/Domain.md) | [日志 Log](doc/Log.md)
|[数组 Array](doc/Array.md) | [资源标识符 URI](doc/URI.md) | [配置 Config](doc/Config.md)
|[文档处理 Office](doc/Office.md) | [认证 Jwt](doc/Jwt.md) | [环境变量 Env](doc/Env.md)
|[文档处理 CSV](doc/CSV.md) | [认证 OAuth2](doc/OAuth2.md) | [调试器 Debugger](doc/Debugger.md)
|[文档处理 XML](doc/XML.md) | [上传 Upload](doc/Upload.md) | [运行时 Runtime](doc/Runtime.md)
|[文档处理 PDF](doc/Pdf.md) | [下载 Download](doc/Download.md) | [验证/断言 Validate/Assert](doc/ValidateAssert.md)
|[文档对象 Markdown](doc/Markdown.md) | [翻译 Translate](doc/Translate.md) | [终端 Terminal](doc/Terminal.md)
|[文档对象 Dom](doc/Dom.md) | [短信 SMS](doc/SMS.md) | [系统 System](doc/System.md)
|[随机字符串 RandStr](doc/RandomString.md) | [邮件 Email](doc/Email.md) | [服务器 Server](doc/Server.md)
|[编码加密 Encode/Crypto](doc/EncodeCrypto.md) | [阿里云 Aliyun](doc/Aliyun.md) | [数据库 ORM](doc/ORM.md)
|[编码 Json](doc/Json.md) | [腾讯云 Tencent](doc/TencentCloud.md) | [路由器 Router](doc/Router.md)
|[颜色 Color](doc/Color.md) | [百度AI BaiduAi](doc/BaiduAi.md) | [容器 Container](doc/Container.md)
|[拼音 Pinyin](doc/Pinyin.md) | [支付宝 Alipay](doc/Alipay.md) | [接口 Api](doc/Api.md)
|[语言 Language](doc/Language.md) | [微信 Wechat](doc/Wechat.md) | [模板 Template](doc/Template.md)
|[时间日期 Datetime](doc/Datetime.md) | [支付 Payment](doc/Payment.md) | [权限控制 Access](doc/Access.md)
|[图像处理 Image](doc/Image.md) | [条形码 Barcode](doc/Barcode.md) | [开放接口 Openapi](doc/OpenApi.md)
|[文件 File](doc/File.md) | [验证码 Captcha](doc/Captcha.md) | [数学 Math](doc/Math.md)
|[表单 Form](doc/Form.md) | [嵌入地图 EmbedMap](doc/EmbedMap.md) | [算法 Algorithm](doc/Algorithm.md)
|[压缩 Zip](doc/Zip.md) | [身份标识 Identity ID](doc/IdentityID.md) |
|[缓存 Cache](doc/Cache.md) | [版本号 Version](doc/Version.md) |
|[缓存 LruCache](doc/LRUCache.md) | [唯一标识符 UUID](doc/UUID.md) |
|[表情符号 Emoji](doc/Emoji.md) | [硬件唯一码 DeviceId](doc/DeviceId.md) |
|[用户代理 UserAgent](doc/UserAgent.md) | [双因素身份验证 Google2fa](doc/Google2fa.md) |
|[地理国家 Geo/Country](doc/GeoCountry.md) | [布隆过滤器 BloomFilter](doc/BloomFilter.md) |
| | [敏感词过滤器 Sensitive](doc/Sensitive.md) |


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
