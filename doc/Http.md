## 网络请求 Http

```php
// 请求baidu链接并检查200状态
try {
    $client = HttpHelper::instance();
    $response = $client->request('GET', 'https://www.baidu.com', [
        'verify' => __DIR__ . '/cacert.pem',
    ]);
    $this->assertEquals(200, $response->getStatusCode());
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

// 获取guzzle实例
HttpHelper::guzzle();

// Get请求
$response = HttpHelper::get([
    'url' => 'https://www.baidu.com',
    'options' => [
        'verify' => __DIR__ . '/cacert.pem',
    ],
]);

// Post请求
$response = HttpHelper::post([
    'url' => 'https://www.baidu.com',
    'options' => [
        'verify' => __DIR__ . '/cacert.pem',
    ],
]);
文档 https://docs.guzzlephp.org/en/stable/
```