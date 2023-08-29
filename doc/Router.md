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
