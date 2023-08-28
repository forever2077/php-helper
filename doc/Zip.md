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