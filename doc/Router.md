## 路由器 Router

```php
// Get请求
RouterHelper::get('/', function () {
    return 'hello';
});
// 混合请求模式
RouterHelper::match(['get', 'post'], '/user/{id}', function ($id) {
    return "UserId：{$id}";
})->where(['id' => '[0-9]+']);;
// 中间件
RouterHelper::post('/user/{id}/profile', 'UserController@profile')->addMiddleware('AuthMiddleware');
// 启动路由器
RouterHelper::start();
文档 https://github.com/skipperbent/simple-php-router
```

```bash
// 简单测试（项目根目录下执行指定入口文件）
php -S 127.0.0.1:80 index.php
```
