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