## 注解 Annotation

```php
// 方法前置处理
#[Before("beforeAction", ['a' => 3, 'b' => 4])] // 类内静态方法
// 方法后置处理
#[After(['AnnotationHelperTest', 'afterAction'], ['a' => 5, 'b' => 6])] // 非静态方法 or 其他类方法
// 方法结果缓存（支持：redis/files）
#[Cache(300, 'files', 'myDefined')] // 后续通过自定义ID获取内容，支持重叠使用
public function doAction(int $a = 0, int $b = 0): string {}
```