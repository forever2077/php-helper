<?php

use PHPUnit\Framework\TestCase;
use Helpful\Helper;
use Helpful\AlgorithmHelper;

class AlgorithmHelperTest extends TestCase
{
    public function testInstance()
    {
        $this->assertEquals(AlgorithmHelper::Class, Helper::algorithm()::class);
    }

    public function testBubbleSort()
    {
        $arr = [1, 3, 2, 5, 4];
        $this->assertEquals([1, 2, 3, 4, 5], AlgorithmHelper::BubbleSort($arr));
    }

    public function testInsertionSort()
    {
        $arr = [1, 3, 2, 5, 4];
        $this->assertEquals([1, 2, 3, 4, 5], AlgorithmHelper::InsertionSort($arr));
    }

    public function testSelectionSort()
    {
        $arr = [1, 3, 2, 5, 4];
        $this->assertEquals([1, 2, 3, 4, 5], AlgorithmHelper::SelectionSort($arr));
    }

    public function testQuickSort()
    {
        $arr = [1, 3, 2, 5, 4];
        $this->assertEquals([1, 2, 3, 4, 5], AlgorithmHelper::QuickSort($arr));
    }

    public function testMergeSort()
    {
        $arr = [1, 3, 2, 5, 4];
        $this->assertEquals([1, 2, 3, 4, 5], AlgorithmHelper::MergeSort($arr));
    }

    public function testHeapSort()
    {
        $arr = [1, 3, 2, 5, 4];
        $this->assertEquals([1, 2, 3, 4, 5], AlgorithmHelper::HeapSort($arr));
    }

    public function testShellSort()
    {
        $arr = [1, 3, 2, 5, 4];
        $this->assertEquals([1, 2, 3, 4, 5], AlgorithmHelper::ShellSort($arr));
    }

    public function testCountSort()
    {
        $arr = [1, 3, 2, 5, 4];
        $this->assertEquals([1, 2, 3, 4, 5], AlgorithmHelper::CountSort($arr));
    }

    public function testBinarySearch()
    {
        // 创建一个已排序的数组
        $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        // 查找目标值5
        $target = 5;
        $low = 0;
        $high = count($arr) - 1;
        // 预期下标值
        $this->assertEquals(4, AlgorithmHelper::BinarySearch($arr, $low, $high, $target));
    }

    public function testBinaryIterativeSearch()
    {
        $arr = [1, 3, 2, 5, 4];
        sort($arr); // 对数组进行排序
        $this->assertEquals(2, AlgorithmHelper::BinaryIterativeSearch($arr, 3));

    }

    public function testDoublePointer()
    {
        $arr = [1, 3, 2, 5, 4];
        $this->assertEquals(1, AlgorithmHelper::DoublePointer($arr, 3));
    }
}