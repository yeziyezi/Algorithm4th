<?php
//insertion solution: O(N^2)
require("common.php");
function solution1(array $arr1,array $arr2){
    $time=microtime(true);
    // echo "1:".dumpArrln($arr1);
    // echo "2:".dumpArrln($arr2);
    $compare=compare($arr1);
    $len=count($arr2);
    $swapTimes=0;
    for($i=1;$i<$len;$i++){
        for($j=$i;$j>0 && $compare($arr2[$j],$arr2[$j-1])<0;$j--){
            swap($j,$j-1,$arr2);
            $swapTimes++;
            echo "time spend ".(microtime(true)-$time)." seconds\r";
        }
    }
    echo "\n";
    // echo "2 sorted:".dumpArrln($arr2);
    echo "Kenall tau distance is $swapTimes\n";
}
function compare(array $rule){
    return function(int $number1,int $number2) use ($rule){
        $index1=array_search($number1,$rule);
        $index2=array_search($number2,$rule);
        if($index1>$index2) return 1;
        if($index1<$index2) return -1;
        return 0;
    };
}
//test
$len=200;
$arr1=range(0,$len);
$arr2=range(0,$len);
shuffle($arr1);
shuffle($arr2);
// solution1($arr1,$arr2);
//len  time
//10000 ???(>300s)
//2000 10s
//1000 2.06s
//500 0.41s
//200 0.07s
//100 0.02s

