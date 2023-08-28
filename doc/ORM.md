## 数据库 ORM

```php
// 加载配置创建链接并查询id=1的记录
$db = new DbHelper();
$config = ConfigHelper::load(dirname(__DIR__) . '/data/db/config.yaml');
$db->setConfig($config->all());
$conn = $db->connect();
$rows = $conn->table('user')->where(['id' => 1])->findOrEmpty();

// 使用User模型查询id=1的记录
use Forever2077\PhpHelper\Db\User;
$user = new User();
$rows = $user->where(['id' => 1])->findOrEmpty();

文档 https://github.com/top-think/think-orm
```