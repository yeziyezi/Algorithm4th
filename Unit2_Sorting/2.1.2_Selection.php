<?php
//选择排序ASC
//$arr 为整数数组
//找到未排序部分中最小的数 将最小值与未排序部分的第一个数交换 以此类推
//特点：运行时间和输入无关 数据移动最少
//比较N^2/2次 交换N次

require("common.php");
class Selection
{
    public static function asc($arr)
    {
        Timer::start();
        $p = 0;
        $len = count($arr);
        while ($p < $len) {
            //找到未排序部分中最小的数
            $min = $p;
            for ($i = $p; $i < $len; $i++) {
                if ($arr[$i] < $arr[$min]) {
                    $min = $i;
                }
            }
            //将最小值与未排序部分的第一个数交换
            $t = $arr[$min];
            $arr[$min] = $arr[$p];
            $arr[$p] = $t;
            $p++;
            Timer::echoTimer("SelectionSortingASC");
        }
        Timer::stop();
        return $arr;
    }
    public static function desc($arr)
    {
        Timer::start();
        $p = 0;
        $len = count($arr);
        while ($p < $len) {
        //找到未排序部分中最大的数
            $max = $p;
            for ($i = $p; $i < $len; $i++) {
                if ($arr[$i] > $arr[$max]) {
                    $max = $i;
                }
            }
        //将最大值与未排序部分的第一个数交换
            $t = $arr[$max];
            $arr[$max] = $arr[$p];
            $arr[$p] = $t;
            $p++;
            Timer::echoTimer("SelectionSortingDESC");
        }
        Timer::stop();
        return $arr;
    }
}

//test
$arr = [234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56,234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56, 234, 5, 4, 2, 56, 7, -1, 3, 382, 56];
echo 'Origin' . dumpArr($arr);
echo 'ASC' . dumpArr(Selection::asc($arr));
echo 'DESC' . dumpArr(Selection::desc($arr));