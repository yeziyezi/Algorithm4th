<?php
// Faster merge. Implement a version of merge() that copies the second half of a[] to aux[] in decreasing order and then does the merge back to a[]. This change allows you to remove the code to test that each of the halves has been exhausted from the inner loop. Note: the resulting sort is not stable.
require("common.php");
Class FastMerge{
    private static $temp=[];
    private static function merge(array &$arr,int $low,int $mid,int $high){
        //Origin⬇
        // for($i=$low;$i<=$high;$i++){
        //     self::$temp[$i]=$arr[$i];
        // }
        // $p1=$low;
        // $p2=$mid+1;
        // for($i=$low;$i<=$high;$i++){
        //     switch(true){
        //     case $p1>$mid:
        //         $arr[$i]=self::$temp[$p2++];break;
        //     case $p2>$high:
        //         $arr[$i]=self::$temp[$p1++];break;
        //     case self::$temp[$p1]<=self::$temp[$p2]:
        //         $arr[$i]=self::$temp[$p1++];break;
        //     default:
        //         $arr[$i]=self::$temp[$p2++];break;
        //     }
        // }

        //faster merge,not stable(why?)
        for($i=$low;$i<=$mid;$i++){
            self::$temp[$i]=$arr[$i];
        }
        //将右子数组倒置放进temp，下面的比较操作就可以省去对某边子数组用尽的检测
        for($i=$mid+1;$i<=$high;$i++){
            self::$temp[$i]=$arr[$high-$i+$mid+1];
        }
        $p1=$low;
        $p2=$high;
        //原理：p1 p2相向移动，假如左边先用尽，此时p1指向右边最大的数，有p2<p1，则p2一直向左移动，直到p1 p2重叠为止。右边同理
        for($i=$low;$i<=$high;$i++){
            if(self::$temp[$p1]<=self::$temp[$p2]) $arr[$i]=self::$temp[$p1++];
            else $arr[$i]=self::$temp[$p2--];
        }
        
    }
    public static function sort(array &$arr){
        $len=count($arr);
        for($size=1;$size<$len;$size*=2){
            for($low=0;$low<$len-$size;$low+=($size*2)){
                self::merge($arr,$low,$low+$size-1,min($low+2*$size-1,$len-1));
            }
        }
    }
}
$arr=[1,2,3,4,5,6,5,4,2,1,9,4,6,4,5,7,42,2,6,8,3,6];
echo "Orgin:".dumpArrln($arr);
FastMerge::sort($arr);
echo "Sorted:".dumpArrln($arr);