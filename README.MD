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


| 数据处理             | 网络通信与认证技术    | 编程运行时与调试工具    | 
|------------------|--------------| ------------- |
| [字符串 Str](doc/Str.md) | [网络请求 Http](doc/Http.md) | [注解 Annotation](doc/Annotation.md) |
| [数组 Array](doc/Array.md) | [网际协议 IP](doc/IP.md) | [协程 Coroutine](doc/Coroutine.md) |
| [文件 File](doc/File.md) | [网络 Net](doc/Net.md) | [异常 Exceptions](doc/Exceptions.md) |
| [表单 Form](doc/Form.md) | [域名 Domain](doc/Domain.md) | [验证/断言 Validate/Assert](doc/ValidateAssert.md) |
| [拼音 Pinyin](doc/Pinyin.md) | [资源标识符 URI](doc/URI.md) | [调试器 Debugger](doc/Debugger.md) |
| [颜色 Color](doc/Color.md) | [认证 Jwt](doc/Jwt.md) | [运行时 Runtime](doc/Runtime.md) |
| [缓存 LruCache](doc/LRUCache.md) | [认证 OAuth2](doc/OAuth2.md) | [日志 Log](doc/Log.md) |
| [缓存 Cache](doc/Cache.md) | [上传 Upload](doc/Upload.md) | [配置 Config](doc/Config.md) |
| [时间日期 Datetime](doc/Datetime.md) | [下载 Download](doc/Download.md) | [终端 Terminal](doc/Terminal.md) |
| [图像处理 Image](doc/Image.md) | [验证码 Captcha](doc/Captcha.md) | [系统 System](doc/System.md) |
| [条形码 Barcode](doc/Barcode.md) |              | [环境变量 Env](doc/Env.md) |

| 开放平台与云服务商     | 后端开发核心组件      | 文档对象处理       | 数据进阶处理 |
| ------------- | ------------- | ------------ |---------|
| [阿里云 Aliyun](doc/Aliyun.md) | [服务器 Server](doc/Server.md) | [文档处理 Office](doc/Office.md) | [随机字符串 RandStr](doc/RandomString.md) |
| [腾讯云 TencentCloud](doc/TencentCloud.md) | [数据库 ORM](doc/ORM.md) | [文档处理 CSV](doc/CSV.md) | [敏感词过滤器 Sensitive](doc/Sensitive.md) |
| [百度AI BaiduAi](doc/BaiduAi.md) | [路由器 Router](doc/Router.md) | [文档处理 XML](doc/XML.md) | [身份标识 Identity ID](doc/IdentityID.md) |
| [支付宝 Alipay](doc/Alipay.md) | [容器 Container](doc/Container.md) | [文档处理 PDF](doc/Pdf.md) | [版本号 Version](doc/Version.md) |  |
| [微信 Wechat](doc/Wechat.md) | [接口 Api](doc/Api.md) | [文档对象 Dom](doc/Dom.md) | [唯一标识符 UUID](doc/UUID.md) |
| [支付 Payment](doc/Payment.md) | [模板 Template](doc/Template.md) | [压缩 Zip](doc/Zip.md) | [地理国家 Geo/Country](doc/GeoCountry.md) |

| 第三方嵌入 | 算法与编码           |
|----------|----------|
| [短信 SMS](doc/SMS.md) |  [编码 Json](doc/Json.md) |
| [邮件 Email](doc/Email.md) | [编码加密 Encode/Crypto](doc/EncodeCrypto.md) |
| [翻译 Translate](doc/Translate.md) | [数学 Math](doc/Math.md) |
| [嵌入地图 EmbedMap](doc/EmbedMap.md) | [算法 Algorithm](doc/Algorithm.md) |
|| [布隆过滤器 BloomFilter](doc/BloomFilter.md) |

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
