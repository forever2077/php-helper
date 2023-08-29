## 模板 Template

```php
// 数组加载器
$arrayLoader = TemplateHelper::array([
    'index' => 'Hello {{ name }}!',
]);
$this->assertEquals('Hello World!', $arrayLoader->render('index', ['name' => 'World']));
  
// 文件加载器
$fileLoader = TemplateHelper::filesystem(
    dirname(__DIR__) . '/data/temp/templates',
    null,
    [
        'cache' => dirname(__DIR__) . '/data/temp/templates/cache',
    ]
);
$this->assertEquals('<p>Hello World!</p>', $fileLoader->render('index.html', ['name' => 'World']));
  
// 合并加载器
$arrayLoader = TemplateHelper::array([
    'index' => 'Hello {{ name }}!',
], [
    '__loader' => true, // 返回加载器实例
]);
$fileLoader = TemplateHelper::filesystem(
    dirname(__DIR__) . '/data/temp/templates',
    null,
    [
        'cache' => dirname(__DIR__) . '/data/temp/templates/cache',
        '__loader' => true, // 返回加载器实例
    ]
);
$chainLoader = Helper::template()::chain([$arrayLoader, $fileLoader]);
$this->assertEquals('<p>Hello World!</p>', $chainLoader->render('index.html', ['name' => 'World']));

文档 https://twig.symfony.com/doc/3.x/
```
