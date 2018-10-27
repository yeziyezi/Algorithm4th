<?php
require("common.php");
// This method is much faster than standard quick sort for arrays with lots of repeating elements
class Quick3way{
    public static function sort(array &$arr){
        self::rsort($arr,0,count($arr)-1);
    }
    private static function rsort(array &$arr,int $low,int $high){
        if($low>=$high) return;
        $ruler=$arr[$low];
        $lt=$low;
        $gt=$high;
        $i=$low+1;
        while($i<=$gt){
            if($arr[$i]<$ruler){
                self::swap($arr,$i++,$lt++);
            }else if($arr[$i]>$ruler){
                self::swap($arr,$i,$gt--);
            }else{
                $i++;
            }
        }
        self::rsort($arr,$low,$lt-1);
        self::rsort($arr,$gt+1,$high);
    }
    private static function swap(array &$arr,int $index1,int $index2){
        $t=$arr[$index1];
        $arr[$index1]=$arr[$index2];
        $arr[$index2]=$t;
    }
}
$arr=[97,21,4,21,23,12,4,4,23,56,58,21,705,67,142,9,34,6,934,8,457,76,437,4];
echo "Origin".dumpArrln($arr);
Quick3way::sort($arr);
echo "Sorted:".dumpArrln($arr);
