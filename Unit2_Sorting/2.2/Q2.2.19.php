<?php
//实现一个线性对数级别的算法计算数组中倒置的个数（插入排序需要交换的次数）
require("common.php");
//使用插入排序的验证方法
function exchangeTimes(array $arr){
    $times=0;
    $len=count($arr);
    for($i=0;$i<$len;$i++){
        for($j=$i;$j>0&&$arr[$j]<$arr[$j-1];$j--){
            $times++;
            $t=$arr[$j];
            $arr[$j]=$arr[$j-1];
            $arr[$j-1]=$t;
        }
    }
    echo "correct sorted array:".dumpArrln($arr);
    return $times;
}
//I tried to use bottom-up merge sorting,but failed.
// this is the PHP version of the answer on https://algs4.cs.princeton.edu/22mergesort/Inversions.java.html
//btw I hate self:: & $this!!!
class MergeTDC{//top-down count
    private static function merge(array &$arr,array &$temp,int &$count,int $low,int $mid,int $high){
        for($i=$low;$i<=$high;$i++){
            $temp[$i]=$arr[$i];
        }
        $p1=$low;
        $p2=$mid+1;
        for($i=$low;$i<=$high;$i++){
            switch(true){
            case $p1>$mid:
                $arr[$i]=$temp[$p2++];break;
            case $p2>$high:
                $arr[$i]=$temp[$p1++];break;
            case $temp[$p1]<=$temp[$p2]:
                $arr[$i]=$temp[$p1++];break;
            default:
                $arr[$i]=$temp[$p2++];
                $count+=($mid-$p1+1);
            }
        }
    }
    private static function rsort(array &$arr,array &$temp,int &$count,int $low,int $high){
        if($high<=$low){
            return;
        }
        $mid=$low+intval(($high-$low)/2);
        self::rsort($arr,$temp,$count,$low,$mid);
        self::rsort($arr,$temp,$count,$mid+1,$high);
        self::merge($arr,$temp,$count,$low,$mid,$high);
    }
    public static function sort(array &$arr){
        $temp=[];
        $count=0;
        self::rsort($arr,$temp,$count,0,count($arr)-1);
        return $count;
    }
}

$arr=[1,2,3,5,8,9,8743,1,34,35,6,2,4];
echo "Orgin:".dumpArrln($arr);
echo "correct answer:".exchangeTimes($arr)."\n";
echo "merge result:".MergeTDC::sort($arr),"\n";
echo "sorted array:".dumpArrln($arr);

