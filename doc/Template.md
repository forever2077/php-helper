## 模板 Template

```php
// 数组加载器
$loader = TemplateHelper::array([
    'index' => 'Hello {{ name }}!',
]);
$twig = TemplateHelper::env($loader);
$this->assertEquals('Hello World!', $twig->render('index', ['name' => 'World']));

// 文件加载器
$loader = TemplateHelper::filesystem(
    dirname(__DIR__) . '/data/temp/templates',
);
$twig = TemplateHelper::env($loader, [
    'cache' => dirname(__DIR__) . '/data/temp/templates/cache',
]);
$this->assertEquals('<p>Hello World!</p>', $twig->render('index.html', ['name' => 'World']));

// 合并加载器
$arrayLoader = TemplateHelper::array([
    'index' => 'Hello {{ name }}!',
]);
$fileLoader = TemplateHelper::filesystem(
    dirname(__DIR__) . '/data/temp/templates',
);
$chain = TemplateHelper::chain([$arrayLoader, $fileLoader]);
$twig = TemplateHelper::env($chain, [
    'cache' => dirname(__DIR__) . '/data/temp/templates/cache',
]);
$this->assertEquals('<p>Hello World!</p>', $twig->render('index.html', ['name' => 'World']));

文档 https://twig.symfony.com/doc/3.x/
```
