## 资源标识符 URI

```php
$uri = UriHelper::instance('https://www.baidu.com/s?wd=php%20uri%20helper#hash');
$this->assertEquals('https', $uri->getScheme());
$this->assertEquals('www.baidu.com', $uri->getHost());
$this->assertEquals('/s', $uri->getPath());
$this->assertEquals('wd=php%20uri%20helper', $uri->getQuery());
$this->assertEquals('hash', $uri->getFragment());
文档 https://github.com/guzzle/psr7
```