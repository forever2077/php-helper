## 编码 Json

```php
// Json 查询
JsonHelper::search('foo.bar', ['foo' => ['bar' => 1]]);
JsonHelper::search('foo[*].bar', ['foo' => [['bar' => 1], ['bar' => 2]]]);
JsonHelper::search('foo[*].bar', '{"foo":[{"bar":1},{"bar":2}]}');
// 结果AST缓存到内存
JsonHelper::search('foo.bar', ['foo' => ['bar' => 1]], ['mode' => 'ast']);
// 结果编译成JMESPath语法后缓存（性能最佳），需指定缓存目录
JsonHelper::search('foo.bar', ['foo' => ['bar' => 1]], ['mode' => 'compiler', 'path' => $path]);
文档 https://github.com/jmespath/jmespath.php

// JSON 语法检查
JsonHelper::lint('{"foo":1}', JsonParser::DETECT_KEY_CONFLICTS);
JsonHelper::lint(['foo' => 1, 'bar'], JsonParser::DETECT_KEY_CONFLICTS);
文档 https://github.com/Seldaek/jsonlint

// JSON 映射器
$json = '{"name":"Sheldon Cooper","address":{"street":"2311 N. Los Robles Avenue","city":"Pasadena"}}';
JsonHelper::mapper($json, new Contact);

class Contact
{
    public string $name;
    public Address $address;
}
class Address
{
    public $street;
    public $city;
    public function getGeoCoords(){}
}
$json = [
	'name' => 'Sheldon Cooper',
	'address' => [
		'street' => '2311 N. Los Robles Avenue',
		'city' => 'Pasadena'
	]
];
JsonHelper::mapper($json, new Contact);
文档 https://github.com/cweiske/jsonmapper

// Json 流式解析器，支持传入：File、Stream、Iterable
$users = JsonHelper::parseStream('500MB-users.json');
foreach ($users as $id => $user) {
    var_dump($user->name);
}
文档 https://github.com/halaxa/json-machine
```