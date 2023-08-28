## 异常 Exceptions

```php
try {
    // 异常处理标准库
    throw new \Exceptions\Data\NotFoundException();
} catch (\Exceptions\Data\NotFoundException $e) {
    $this->assertEquals('Data requested for cannot be found in the data source.', $e->getMessage());
}
文档 https://github.com/crazycodr/standard-exceptions
```