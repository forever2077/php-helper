## 配置 Config

```php
// 从字符串中加载
$settingsJson = <<<FOOBAR
{
  "application": {
    "name": "configuration",
    "secret": "s3cr3t"
  },
  "host": "localhost",
  "port": 80,
  "servers": [
    "host1",
    "host2",
    "host3"
  ]
}
FOOBAR;
// 使用Json读取器解释字符串
$config = ConfigHelper::load($this->settingsJson, 'json', true);
// 获取下标变量
$config['application.name'];
$config->get('application.name');
// 设置目标变量
$config['application.name'] = 'Json Config';
// 保存结果
$config->toFile('config.json');
// 另存为 Yaml
$config->toFile('config.yaml');
// 强制指定写入器
$config->toFile('config.txt', new Serialize());

// 从文件中加载(默认Json解释器)
ConfigHelper::load('config.json');
// 加载yaml文件并转成ini（支持：yaml、ini、xml、php、serialize、properties）
ConfigHelper::load('config.yaml', 'ini');
// 从多个文件加载值
ConfigHelper::load(['config.json', 'config.xml']);
// 加载目录中所有支持的文件
ConfigHelper::load(__DIR__ . '/config');
// 从可选文件加载值
ConfigHelper::load(['config.dist.json', '?config.json']);
文档 https://github.com/hassankhan/config
```