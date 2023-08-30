## 服务器 Server

```php
// http
$http = Helper::server('http://0.0.0.0:2345');
$http->count = 2;
$http->onMessage = function ($connection, $request) {
	//$request->get();
	//$request->post();
	//$request->header();
	//$request->cookie();
	//$request->session();
	//$request->uri();
	//$request->path();
	//$request->method();
	$connection->send("Hello World");
};
$http::runAll();

// websocket
$ws = Helper::server('websocket://0.0.0.0:2346');
$ws->onConnect = function ($connection) {
	echo "New connection\n";
};
$ws->onMessage = function ($connection, $data) {
	$connection->send('Hello ' . $data);
};
$ws->onClose = function ($connection) {
	echo "Connection closed\n";
};
$ws::runAll();

文档 https://github.com/walkor/workerman
```

```php
// 可用命令：php + 入口文件 + 参数
php start.php start  
php start.php start -d  
php start.php status  
php start.php status -d  
php start.php connections
php start.php stop  
php start.php stop -g  
php start.php restart  
php start.php reload  
php start.php reload -g  
```
