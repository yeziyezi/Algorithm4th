<?php
// Quicksort is popular because it is not difficult to implement, works well for a variety of different kinds of input data, and is substantially faster than any other sorting method in typical applications. It is in-place (uses only a small auxiliary stack), requires time proportional to N log N on the average to sort N items, and has an extremely short inner loop.(https://algs4.cs.princeton.edu/23quicksort/)
require("common.php");
class BasicQuickSort{
    public static function sort(array &$arr){
        //shuffle the array firstly to avoid some extreme conditions.
        //for example,the $ruler is the minimum or the maximum.
        shuffle($arr);
        echo "shuffled:".dumpArrln($arr);
        self::rsort($arr, 0, count($arr) - 1);
    }
    private static function rsort(array &$arr, int $low, int $high){
        if ($low >= $high) return;
        $k = self::partition($arr, $low, $high);
        self::rsort($arr, $low, $k - 1);
        self::rsort($arr, $k + 1, $high);
    }
    private static function partition(array &$arr, int $low, int $high){
        $ruler = $arr[$low];
        $i = $low;
        $j = $high+1;
        while (true) {
            while ($i < $high && $arr[++$i] <= $ruler);
            while ($j > $low && $arr[--$j] > $ruler);
            if ($i >= $j) {
                $t=$arr[$j];
                $arr[$j]=$arr[$low];
                $arr[$low]=$t;
                return $j;
            }
            $t = $arr[$j];
            $arr[$j] = $arr[$i];
            $arr[$i] = $t;
            echo "i=$i,j=$j".dumpArrln($arr);
            sleep(1);
        }
    }
}
$arr = [100, 124, 421, 2, 32, 13, 84, 23, 154, 57, 32, 34, 2, 47, 35, 4, 423, 7, 3, 5, 23, 7, 2, 34, 1, 25, 348, 5, 6, 46];
echo "Origin:".dumpArrln($arr);
BasicQuickSort::sort($arr);
echo "Sorted:".dumpArrln($arr);
