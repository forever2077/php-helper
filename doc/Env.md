## 环境变量 Env

```php
// 将数组保存为.env文件
$env = EnvHelper::instance(__DIR__);
$env->save(['foo' => 'bar']);
// 获取foo变量
$env->get('foo');
// 获取失败后默认值
$env->get('foo', 'bar');
// 获取foo变量并校验规则
$env->get('foo', function (Dotenv\Dotenv $dotenv) {
    $dotenv->required('bar')->allowedValues(['bar']);
})；
// 检查foo变量是否存在
$env->has('foo');
// 设置bar值为foo
$env->set('bar', 'foo');
文档 https://github.com/vlucas/phpdotenv
```