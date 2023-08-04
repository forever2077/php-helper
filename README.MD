# PHP助手类/工具包

## 安装

```php
composer require forever2077/php-helper:"@dev"
```

## 懒加载+单例模式

```php
// 冒泡排序
$arr = [1, 3, 2, 5, 4];
PhpHelper::Algorithm()::BubbleSort($arr);

// 数组转对象
class Foo
{
    public $a = 1;
    public $b = 2;

    public function __construct()
    {
        $this->a = 1;
        $this->b = 2;
    }
}
$foo = new Foo();
PhpHelper::Array::toArray($foo);
```

## 算法 Algorithm

```php
// 冒泡排序
$arr = [1, 3, 2, 5, 4];
AlgorithmHelper::BubbleSort($arr);

// 快速排序
$arr = [1, 3, 2, 5, 4];
AlgorithmHelper::QuickSort($arr);

// 二分递归查找
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$target = 5;
$low = 0;
$high = count($arr) - 1;
AlgorithmHelper::BinarySearch($arr, $low, $high, $target);
```

## 数组 Array

```php
// 把对象或者数组对象，转成数组
ArrayHelper::toArray($object, $properties = [], $recursive = true);

// 获取对象或者数组的指定的值
ArrayHelper::getValue($array, $key, $default = null);

// 根据指定的key，建立key对应索引的数组，或者分组后的索引数组
ArrayHelper::index($array, $key, $groups = []);

// 把数组转成 key-value 的形式
ArrayHelper::map($array, $from, $to, $group = null);

// 检查数组是否是列索引
ArrayHelper::isAssoc($array);
```
