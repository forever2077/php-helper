## 验证码 Captcha

```php
$imgDir = dirname(__DIR__) . '/data/captcha/temp';
// 所有参数均为可选配置
$captcha = Helper::captcha()::image([
    'imgDir' => $imgDir,          // 生成图像的目录，如果不存在则返回结果数组
    'length' => 6,                // 验证码位数
    'fontSize' => 30,             // 验证码字体大小(px)
    'math' => false,              // 算术验证码
    'useZh' => false,             // 使用中文验证码
    'numberCode' => false,        // 启用纯数字字符集
    'useImgBg' => false,          // 使用背景图片
    'useNoise' => true,           // 是否添加杂点
    'useCurve' => true,           // 是否画混淆曲线
    'useNoiseLevel' => true,      // 启用噪波点数
    'dotNoiseLevel' => 100,       // 图像上的噪波线数
    'useLineNoiseLevel' => true,  // 启用噪波线数
    'lineNoiseLevel' => 10,       // 图像上的噪波线数
    'fontTTF' => '',              // 验证码字体，默认随机获取
    'imageH' => 0,                // 验证码图片高度 (自动)
    'imageW' => 0,                // 验证码图片宽度 (自动)
    'bg' => [243, 251, 254],      // 背景颜色
    'gcFreq' => 10,               // 执行垃圾收集的频率
    'expire' => 600,              // 验证码过期时间（s）
]);
dump($captcha);
文档 https://github.com/top-think/think-captcha
```