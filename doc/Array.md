## 数组 Array

```php
// 获取对象或者数组的指定的值
ArrayHelper::getValue($array, $key, $default = null);
// 检查数组是否是列索引
ArrayHelper::isAssoc($array);
// 递归获取指定下标数组
ArrayHelper::getTree($array);
// 获取元素值为b的下一组
ArrayHelper::from([0 => 'b', 1 => 'a'])->after('b');
// 数组排序
ArrayHelper::from(['b' => 0, 'a' => 1])->arsort();
文档 https://github.com/aimeos/map
```