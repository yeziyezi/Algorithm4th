<?php
require("common.php");
//神奇的希尔排序,至今没有人对希尔排序的性能研究透彻
//核心思想是将数组变成h有序，并对子数组进行插入排序，并逐步减小h的值至1
//下面的算法使用的递增序列为(3^k-1)/2
//最坏情况下会进行N^(3/2)次比较，运行时间保证低于N^2
//对于不同的h递增序列，性能会有所不同
//特点是占用内存空间很少，比简单的插入排序更快，也能够处理较大规模的数组
function shellSorting($arr){
    $len=count($arr);
    $h=1;
    while($h<$len/3) $h=$h*3+1;//递增序列 1 4 13 40 ....(3^k-1)/2
    while($h>=1){
        for($i=$h;$i<$len;$i++){
            for($j=$i;$j>=$h&&$arr[$j]<$arr[$j-1];$j-=$h){
                $t=$arr[$j];
                $arr[$j]=$arr[$j-1];
                $arr[$j-1]=$t;
                echo "h=$h,i=$i,j=$j".dumpArr($arr);
            }
        }
        $h=intval($h/3);
    }
    return $arr;
}
$arr=[6,5,4,3,2,1,2,3,4,5,6];
echo "Origin:".dumpArr($arr);
shellSorting($arr);