<?php

namespace Forever2077\PhpHelper;

class AlgorithmHelper
{
    /**
     * 冒泡排序
     * @param $arr array 需要排序的数组
     * @return array 排序后的数组
     */
    public static function BubbleSort(array $arr): array
    {
        $len = count($arr);
        for ($i = 1; $i < $len; $i++) {
            for ($k = 0; $k < $len - $i; $k++) {
                if ($arr[$k] > $arr[$k + 1]) {
                    $tmp = $arr[$k + 1];
                    $arr[$k + 1] = $arr[$k];
                    $arr[$k] = $tmp;
                }
            }
        }
        return $arr;
    }

    /**
     * 插入排序
     * @param array $arr 需要排序的数组
     * @return array 排序后的数组
     */
    public static function InsertionSort(array $arr): array
    {
        $len = count($arr);
        for ($i = 1; $i < $len; $i++) {
            $tmp = $arr[$i];
            for ($k = $i - 1; $k >= 0; $k--) {
                if ($tmp < $arr[$k]) {
                    $arr[$k + 1] = $arr[$k];
                    $arr[$k] = $tmp;
                } else {
                    break;
                }
            }
        }
        return $arr;
    }

    /**
     * 选择排序
     * @param array $arr 需要排序的数组
     * @return array 排序后的数组
     */
    public static function SelectionSort(array $arr): array
    {
        $len = count($arr);
        for ($i = 0; $i < $len - 1; $i++) {
            $min = $i;
            for ($k = $i + 1; $k < $len; $k++) {
                if ($arr[$k] < $arr[$min]) {
                    $min = $k;
                }
            }
            if ($min != $i) {
                $tmp = $arr[$i];
                $arr[$i] = $arr[$min];
                $arr[$min] = $tmp;
            }
        }
        return $arr;
    }

    /**
     * 希尔排序
     * @param array $arr 需要排序的数组
     * @return array 排序后的数组
     */
    public static function ShellSort(array $arr): array
    {
        $len = count($arr);
        $gap = 1;
        while ($gap < $len / 3) {
            $gap = $gap * 3 + 1;
        }
        for ($gap; $gap > 0; $gap = floor($gap / 3)) {
            for ($i = $gap; $i < $len; $i++) {
                $tmp = $arr[$i];
                for ($k = $i - $gap; $k >= 0; $k -= $gap) {
                    if ($tmp < $arr[$k]) {
                        $arr[$k + $gap] = $arr[$k];
                        $arr[$k] = $tmp;
                    } else {
                        break;
                    }
                }
            }
        }
        return $arr;
    }

    /**
     * 快速排序
     * @param array $arr 需要排序的数组
     * @return array 排序后的数组
     */
    public static function QuickSort(array $arr): array
    {
        $len = count($arr);
        if ($len <= 1) {
            return $arr;
        }
        $pivot = $arr[0];
        $left = [];
        $right = [];
        for ($i = 1; $i < $len; $i++) {
            if ($arr[$i] < $pivot) {
                $left[] = $arr[$i];
            } else {
                $right[] = $arr[$i];
            }
        }
        $left = self::QuickSort($left);
        $right = self::QuickSort($right);
        return array_merge($left, [$pivot], $right);
    }

    /**
     * 堆排序
     * @param array $arr 需要排序的数组
     * @return array 排序后的数组
     */
    public static function HeapSort(array $arr): array
    {
        $len = count($arr);
        for ($i = floor($len / 2) - 1; $i >= 0; $i--) {
            self::HeapAdjust($arr, $i, $len);
        }
        for ($i = $len - 1; $i > 0; $i--) {
            $tmp = $arr[0];
            $arr[0] = $arr[$i];
            $arr[$i] = $tmp;
            self::HeapAdjust($arr, 0, $i);
        }
        return $arr;
    }

    /**
     * 堆调整
     * @param array $arr 需要排序的数组
     * @param int $i 调整的位置
     * @param int $len 数组长度
     * @return void 无返回值
     */
    private static function HeapAdjust(array &$arr, int $i, int $len): void
    {
        $tmp = $arr[$i];
        for ($k = 2 * $i + 1; $k < $len; $k = 2 * $k + 1) {
            if ($k + 1 < $len && $arr[$k] < $arr[$k + 1]) {
                $k++;
            }
            if ($arr[$k] > $tmp) {
                $arr[$i] = $arr[$k];
                $i = $k;
            } else {
                break;
            }
        }
        $arr[$i] = $tmp;
    }

    /**
     * 归并排序
     * @param array $arr 需要排序的数组
     * @return array 排序后的数组
     */
    public static function MergeSort(array $arr): array
    {
        $len = count($arr);
        if ($len <= 1) {
            return $arr;
        }
        $mid = floor($len / 2);
        $left = array_slice($arr, 0, $mid);
        $right = array_slice($arr, $mid);
        $left = self::MergeSort($left);
        $right = self::MergeSort($right);
        $arr = self::Merge($left, $right);
        return $arr;
    }

    /**
     * 归并
     * @param array $left 左边数组
     * @param array $right 右边数组
     * @return array 归并后的数组
     */
    private static function Merge(array $left, array $right): array
    {
        $arr = [];
        while (count($left) && count($right)) {
            $arr[] = $left[0] < $right[0] ? array_shift($left) : array_shift($right);
        }
        return array_merge($arr, $left, $right);
    }

    /**
     * 计数排序
     * @param array $arr 需要排序的数组
     * @return array 排序后的数组
     */
    public static function CountSort(array $arr): array
    {
        $len = count($arr);
        if ($len <= 1) {
            return $arr;
        }
        $max = max($arr);
        $tmp = array_fill(0, $max + 1, 0);
        foreach ($arr as $v) {
            $tmp[$v]++;
        }
        $arr = [];
        for ($i = 0; $i <= $max; $i++) {
            while ($tmp[$i] > 0) {
                $arr[] = $i;
                $tmp[$i]--;
            }
        }
        return $arr;
    }

    /**
     * 二分递归查找
     * @param array $arr 需要查找的数组
     * @param int $low 查找的最小位置
     * @param int $high 查找的最大位置
     * @param int $target 查找的目标值
     * @return int 查找的目标值的位置
     */
    public static function BinarySearch(array $arr, int $low, int $high, int $target): int
    {
        if ($low > $high) {
            return -1;
        }
        $mid = floor(($low + $high) / 2);
        if ($arr[$mid] == $target) {
            return $mid;
        } elseif ($arr[$mid] > $target) {
            return self::BinarySearch($arr, $low, $mid - 1, $target);
        } else {
            return self::BinarySearch($arr, $mid + 1, $high, $target);
        }
    }

    /**
     * 二分迭代查找
     * @param array $arr 需要查找的数组
     * @param int $target 查找的目标值
     * @return int 查找的目标值的位置
     */
    public static function BinaryIterativeSearch(array $arr, int $target): int
    {
        $len = count($arr);
        if ($len <= 0) {
            return -1;
        }
        $low = 0;
        $high = $len - 1;
        while ($low <= $high) {
            $mid = floor(($low + $high) / 2);
            if ($arr[$mid] == $target) {
                return $mid;
            } elseif ($arr[$mid] > $target) {
                $high = $mid - 1;
            } else {
                $low = $mid + 1;
            }
        }
        return -1;
    }

    /**
     * 双指针法
     * @param array $arr 需要查找的数组
     * @param int $target 查找的目标值
     * @return int 查找的目标值的位置
     */
    public static function DoublePointer(array $arr, int $target): int
    {
        $len = count($arr);
        if ($len <= 0) {
            return -1;
        }
        $low = 0;
        $high = $len - 1;
        while ($low <= $high) {
            if ($arr[$low] == $target) {
                return $low;
            }
            if ($arr[$high] == $target) {
                return $high;
            }
            $low++;
            $high--;
        }
        return -1;
    }
}