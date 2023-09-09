## 开放接口 OpenApi

```php
// 写入器
$data = [
    'openapi' => '3.0.2',
    'info' => [
        'title' => 'Test API',
        'version' => '1.0.0',
    ],
    'paths' => [
        '/test' => [
            'description' => 'something'
        ],
    ],
];
try {
    $openapi = Helper::openapi()->writer($data);
} catch (Exception $e) {
    $this->fail($e->getMessage());
}
$filePath = dirname(__DIR__) . '/data/temp/test.json';
try {
    Helper::openapi()->writer($data, $filePath);
} catch (Exception $e) {
    $this->fail($e->getMessage());
}
  
// 读取器 
$paths = [];
$openapi = Helper::openapi()->reader(dirname(__DIR__) . '/data/openapi/test.json');

// 生成器
$rtn = OpenApiHelper::generator([
    'src' => dirname(__DIR__) . '/data/openapi/test.json',
    'out' => dirname(__DIR__) . '/src/OpenApi/Test.php',
    'namespace' => 'Helpful\OpenApi',
    'top-level' => 'test',
    'lang' => 'php',
    'with-get' => true,
    'with-set' => true,
    'fast-get' => false,
    'with-closing' => false,
    'acronym-styl' => 'original',
    'alphabetize-properties' => true,
    'all-properties-option' => true,
]);
```
