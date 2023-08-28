## 文档处理 XML

```php
// 写入XML文档
$xmlService = XmlHelper::instance();
$xmlService->namespaceMap = ['http://example.org' => 'b'];
$xmlStr = $xmlService->write('{http://example.org}book', [
    '{http://example.org}title' => 'Cryptonomicon',
    '{http://example.org}author' => 'Neil Stephenson',
]);

// 读取XML文档
$input = <<<XML
<article xmlns="http://example.org/">
<title>Hello world</title>
<content>Fuzzy Pickles</content>
</article>
XML;

$xmlService = XmlHelper::instance();
$xmlService->elementMap = [
    '{http://example.org/}article' => 'Sabre\Xml\Element\KeyValue',
];
$output = $xmlService->parse($input);
文档 https://github.com/sabre-io/xml
```