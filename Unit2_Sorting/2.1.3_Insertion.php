<?php
//插入排序
require("common.php");
class Insertion
{
    public static function asc($arr)
    {
        echo 'Origin ' . dumpArr($arr);
        $len = count($arr);
        for ($i = 1; $i < $len; $i++) {

            //对i及其左边的部分进行排序，由于每次都对左边进行排序，可以保证当遇到有序对时,j左边的所有数都小于j，j右边的数都大于j，即i左边的序列已经排序完成   
            for ($j = $i; $j >0 && $arr[$j] < $arr[$j - 1]; $j--) {
                $t = $arr[$j];
                $arr[$j] = $arr[$j - 1];
                $arr[$j - 1] = $t;
                echo "i=$i,j=$j" . dumpArr($arr);
            }

        }
    }
}
//test
$arr = [9,2, 8,4, 7,3, 5,2 ,6,1, 4, 3, 2, 1];
Insertion::asc($arr);