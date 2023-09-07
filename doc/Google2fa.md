## 双因素身份验证 Two-Factor

```php
// 生成密钥和用于Google Authenticator的二维码URL
$rtn = Google2faHelper::generate('test', 'test@qq.com', [
    'length' => 64,
    'algorithm' => Constants::SHA1, // google2fa only support SHA1
    'compatibility' => true,
    'keyRegeneration' => 30,
    'passwordLength' => 6,
]);
// BW6A6OCESCNBGICSBHM5C2XWBF6ZGIQRMOB33O2QRHSI7XQO7AXPRJ7263LVWJ3R
dump($rtn['secretKey']);
// otpauth://totp/test:test%40qq.com?secret=BW6A6OCESCNBGICSBHM5C2XWBF6ZGIQRMOB33O2QRHSI7XQO7AXPRJ7263LVWJ3R&issuer=test&algorithm=SHA1&digits=6&period=30
dump($rtn['qrCodeUrl']);
// 56469315
dump($rtn['timestamp']);

// 校验用户密码
$secretKey = 'BW6A6OCESCNBGICSBHM5C2XWBF6ZGIQRMOB33O2QRHSI7XQO7AXPRJ7263LVWJ3R';
$userKey = '684557';
$oldTimestamp = Google2faHelper::verify($secretKey, $userKey, [
    'window' => 1, // 窗口期：60s
    'returnTimestamp' => true,
]);
$this->assertTrue($oldTimestamp !== false);

// $oldTimestamp 时间戳用于 verifyKeyNewer，确保同一个码不能重复使用
$timestamp = Google2faHelper::verifyKeyNewer($secretKey, $userKey, $oldTimestamp);
$this->assertFalse($timestamp);
```
