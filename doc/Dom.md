## 文档对象 Dom

```php
// 通过URL加载
$document = DomHelper::load('https://www.whois.com/whois/baidu.com');
$content = $document->find('#registrarData');
dump($content[0]->text());
$this->assertIsString($content[0]->text());

// 通过html字符串加载
$document = DomHelper::load($this->htmlDemo());
$query = $document->find('#container > .label');
$this->assertEquals('Label 1', $query[0]->firstChild()->text());

// 通过文件加载
$document = DomHelper::load(dirname(__DIR__) . '/data/http/test.html');
$query = $document->find('#container > .label');
$this->assertEquals('Label 1', $query[0]->firstChild()->text());

// 加载XML
$document = DomHelper::load($this->xmlDemo(), Document::TYPE_XML);
$query = $document->find('#bk102 > author');
$this->assertEquals('Ralls, Kim', $query[0]->text());

// 创建元素
$element = DomHelper::element('span', 'Hello');
$this->assertEquals('<span>Hello</span>', $element->html());

// 创建带属性的元素
$attributes = ['name' => 'description', 'placeholder' => 'Enter description of item'];
$element = DomHelper::element('textarea', 'Text', $attributes);
$this->assertEquals('<textarea name="description" placeholder="Enter description of item">Text</textarea>', $element->html());

// 从CSS转换而来的XPath表达式的数组缓存
$xpath = DomHelper::compile('h2');
$compiled = DomHelper::getCompiled();
$this->assertEquals($xpath, $compiled['h2']);

文档 https://github.com/Imangazaliev/DiDOM
```
