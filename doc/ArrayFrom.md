```php
$map = ArrayHelper::from([...]);                     // 从给定数据创建一个新对象
$map->push( ['id' => 'three', 'value' => 'value3'] ) // 添加元素
    ->remove( 0 )                                    // 移除元素
    ->filter()                                       // 移除空值
    ->sort()                                         // 对元素进行排序
    ->col( 'value', 'id' )                           // 创建 ['three' => 'value3']
    ->first();                                       // 获取第一个元素

文档 https://github.com/aimeos/map
```

### Create

- function map() : 从传入的元素创建一个新的映射
- __construct() : 创建一个新的映射
- clone() : 克隆映射以及其中所有的对象
- copy() : 创建一个新的副本
- explode() : 将字符串拆分为一个元素的映射
- from() : 从传入的元素创建一个新的映射
- fromJson() : 从一个JSON字符串创建一个新的映射
- times() : 通过多次调用闭包创建一个新的映射
- tree() : 从列表项创建一个树结构

### Access

- __call() : 调用自定义方法
- __callStatic() : 静态地调用自定义方法
- all() : 返回原始数组
- at() : 返回给定位置的值
- bool() : 通过键返回元素并将其转换为布尔值
- call() : 在所有项上调用给定方法
- find() : 返回第一个/最后一个匹配元素
- first() : 返回第一个元素
- firstKey() : 返回第一个键
- get() : 通过键返回元素
- index() : 返回给定键的数字索引
- int() : 通过键返回元素并将其转换为整数
- float() : 通过键返回元素并将其转换为浮点数
- keys() : 返回所有键
- last() : 返回最后一个元素
- lastKey() : 返回最后一个键
- pop() : 返回并移除最后一个元素
- pos() : 返回值的数字索引
- pull() : 通过键返回并移除元素
- random() : 返回随机元素并保留键
- search() : 查找元素的键
- shift() : 返回并移除第一个元素
- string() : 通过键返回元素并将其转换为字符串
- toArray() : 返回原始数组
- unique() : 返回所有唯一元素并保留键
- values() : 返回所有元素并生成新的键

### Add

- concat() : 添加所有元素并生成新的键
- insertAfter() : 在给定元素后插入值
- insertAt() : 在映射的给定位置插入元素
- insertBefore() : 在给定元素前插入值
- merge() : 合并元素并覆盖现有的元素
- pad() : 使用给定值填充到指定长度
- prepend() : 在开头添加一个元素
- push() : 在末尾添加一个元素
- put() : 在映射中设置给定的键和值
- set() : 覆盖或添加元素
- union() : 添加元素但不覆盖现有的元素
- unshift() : 在开头添加一个元素

### Aggregate

- avg() : 返回所有值的平均数
- count() : 返回元素的总数量
- countBy() : 计算映射中相同值出现的次数
- max() : 返回所有元素中的最大值
- min() : 返回所有元素中的最小值
- sum() : 返回映射中所有值的总和

### Debug

- dd() : 打印映射内容并终止脚本
- dump() : 打印映射内容
- tap() : 将映射的克隆传递给给定的回调函数

### OrderBy

- arsort() : 反向排序元素并保留键
- asort() : 排序元素并保留键
- krsort() : 根据键反向排序元素
- ksort() : 根据键排序元素
- order() : 根据传入的键排序元素
- reverse() : 反转数组顺序并保留键
- rsort() : 使用新键反向排序元素
- shuffle() : 随机化元素顺序
- sort() : 排序元素并分配新键
- uasort() : 使用回调函数排序元素并保留键
- uksort() : 使用回调函数根据键排序元素
- usort() : 使用回调函数排序元素并分配新键

### Shorten

- after() : 返回给定元素之后的元素
- before() : 返回给定元素之前的元素
- clear() : 移除所有元素
- diff() : 返回给定列表中缺失的元素
- diffAssoc() : 返回给定列表中缺失的元素并检查键
- diffKeys() : 根据键返回给定列表中缺失的元素
- except() : 返回一个没有传入键的新映射
- filter() : 对所有元素应用过滤器
- grep() : 对所有元素应用正则表达式
- intersect() : 返回共享的元素
- intersectAssoc() : 返回共享的元素并检查键
- intersectKeys() : 根据键返回共享的元素
- nth() : 返回映射中每第n个元素
- only() : 只返回由键指定的元素
- pop() : 返回并移除最后一个元素
- pull() : 返回并通过键移除元素
- reject() : 移除所有匹配的元素
- remove() : 通过键移除元素
- shift() : 返回并移除第一个元素
- skip() : 跳过给定数量的项并返回其余部分
- slice() : 返回映射的一个切片
- take() : 返回具有给定数量项的新映射
- where() : 根据给定条件过滤元素列表

### Test

- function is_map() : 测试变量是否为映射对象
- compare() : 将值与所有映射元素进行比较
- contains() : 测试映射中是否存在某项
- each() : 对每个元素应用回调
- empty() : 测试映射是否为空
- equals() : 测试映射内容是否相等
- every() : 验证所有元素是否通过给定回调的测试
- has() : 测试键是否存在
- if() : 根据条件执行回调
- ifAny() : 如果映射包含元素，则执行回调
- ifEmpty() : 如果映射为空，则执行回调
- in() : 测试元素是否包含
- includes() : 测试元素是否包含
- inString() : 测试项是否是映射中字符串的一部分
- is() : 测试映射是否由相同的键和值组成
- isEmpty() : 测试映射是否为空
- isNumeric() : 测试所有条目是否为数字值
- isObject() : 测试所有条目是否为对象
- isScalar() : 测试所有条目是否为标量值
- implements() : 测试所有条目是否为实现接口的对象
- none() : 测试映射中没有任何元素
- some() : 测试是否包含至少一个元素
- strContains() : 测试是否至少有一个传入的字符串是至少一个条目的一部分
- strContainsAll() : 测试所有条目是否包含传入字符串中的至少一个
- strEnds() : 测试至少一个条目是否以传入的字符串之一结束
- strEndsAll() : 测试所有条目是否以传入的字符串之一结束
- strStarts() : 测试至少一个条目是否以传入的字符串之一开头
- strStartsAll() : 测试所有条目是否以传入的字符串之一开头

### Transform

- cast() : 将所有条目转换为传入的类型
- chunk() : 将映射分割为块
- col() : 创建键/值映射
- collapse() : 折叠多维元素并覆盖元素
- combine() : 将映射元素作为键与给定值组合
- flat() : 平铺多维元素，不覆盖元素
- flip() : 交换键和它们的值
- groupBy() : 对关联数组元素或对象进行分组
- join() : 返回以分隔符连接的元素字符串
- ltrim() : 从所有字符串的左侧移除传入的字符
- map() : 对每个元素应用回调并返回结果
- partition() : 将列表分成给定数量的组
- pipe() : 对整个映射应用回调
- pluck() : 创建键/值映射
- prefix() : 向每个映射条目添加前缀
- reduce() : 从映射内容计算单一值
- rekey() : 根据传入函数更改键
- replace() : 递归地替换元素
- rtrim() : 从所有字符串的右侧移除传入的字符
- splice() : 用新元素替换切片
- strAfter() : 返回传入值之后的字符串
- strLower() : 将所有字母字符转换为小写
- strReplace() : 使用替换字符串替换搜索字符串的所有出现
- strUpper() : 将所有字母字符转换为大写
- suffix() : 向每个映射条目添加后缀
- toJson() : 以JSON格式返回元素
- toUrl() : 创建HTTP查询字符串
- transpose() : 为二维映射交换行和列
- traverse() : 遍历嵌套项的树，并将每个项传递给回调
- trim() : 从所有字符串的左侧/右侧移除传入的字符
- walk() : 将给定回调应用于所有元素
- zip() : 在相应索引处合并所有数组的值

### Misc

- delimiter() : 设置或返回多维数组路径的分隔符
- getIterator() : 返回元素的迭代器
- jsonSerialize() : 指定应序列化为JSON的数据
- method() : 注册自定义方法
- offsetExists() : 检查键是否存在
- offsetGet() : 通过键返回元素
- offsetSet() : 覆盖元素
- offsetUnset() : 通过键移除元素
- sep() : 在当前映射中设置多维数组路径的分隔符

文档 https://github.com/aimeos/map
