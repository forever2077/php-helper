## 条形码 Barcode

```php
// 编码
$code = '987456321';
// 默认：输出PNG格式数据（base64编码字符串）
BarcodeHelper::setOutputDataType('PNG');
$encode1 = BarcodeHelper::encode($code); // 默认：QRCODE
$encode2 = BarcodeHelper::encode($code, BarcodeHelper::C128, 10, 10, [255, 255, 0], true); // 1D Barcode 底部内容
$this->assertTrue(ValidateHelper::isBase64($encode1));
$this->assertTrue(ValidateHelper::isBase64($encode2));
// SVG格式
BarcodeHelper::setOutputDataType('SVG');
$encode3 = BarcodeHelper::encode($code);
$encode4 = BarcodeHelper::encode($code, BarcodeHelper::C128, 10, 10, [255, 0, 0], true);
$encode5 = BarcodeHelper::encode($code, BarcodeHelper::C128, 10, 10, [255, 0, 0], true, true); // 去除SVG版本声明
$this->assertStringContainsString('DOCTYPE svg PUBLIC', $encode3);
$this->assertStringContainsString('DOCTYPE svg PUBLIC', $encode4);
$this->assertStringContainsString('svg', $encode5);
// HTML格式
BarcodeHelper::setOutputDataType('HTML');
$encode6 = BarcodeHelper::encode($code);
$encode7 = BarcodeHelper::encode($code, BarcodeHelper::C128, 10, 10, [255, 0, 0], true);
$this->assertStringContainsString('div', $encode6);
$this->assertStringContainsString('div', $encode7);
```

```php
// 解码
$code = '987456321';
// 需小心数据输出类型的参数是全局共享
BarcodeHelper::setOutputDataType('PNG');
$encode = BarcodeHelper::encode($code);
// 数据准备
$blob = base64_decode($encode);
$filepath = dirname(__DIR__) . "/data/temp/barcode.png";
helper::file()::createFile($filepath, $blob);
// 通过文件解码
$decode = BarcodeHelper::decode($filepath);
$this->assertEquals($code, $decode->toString());
// 通过二进制数据解码
$decode = BarcodeHelper::decode($blob, QrReader::SOURCE_TYPE_BLOB);
$this->assertEquals($code, $decode->toString());
// 通过RESOURCE数据解码
$resource = imagecreatefrompng($filepath);
$decode = BarcodeHelper::decode($resource, QrReader::SOURCE_TYPE_RESOURCE);
$this->assertEquals($code, $decode->toString());
```
