<?php
require("common.php");
class MergeTD{
    private static $temp=[];
    private static function merge(array &$arr,int $low,int $mid,int $high){
        $p1=$low;
        $p2=$mid+1;
        for($i=$low;$i<=$high;$i++){
            self::$temp[$i]=$arr[$i];
        }
        for($i=$low;$i<=$high;$i++){
            switch(true){
            case $p1>$mid:
                $arr[$i]=self::$temp[$p2++];break;
            case $p2>$high:
                $arr[$i]=self::$temp[$p1++];break;
            case self::$temp[$p1]<=self::$temp[$p2]:
                $arr[$i]=self::$temp[$p1++];break;
            default:
                $arr[$i]=self::$temp[$p2++];
            }
        }
    }
    private static function rsort(array &$arr,int $low,int $high,array &$temp=[]){//the real sort function
        if($high<=$low) return;//二分至最小
        $mid=$low+intval(($high-$low)/2);
        self::rsort($arr,$low,$mid);
        self::rsort($arr,$mid+1,$high);
        self::merge($arr,$low,$mid,$high);
    }
    public static function sort(array &$arr){
        self::rsort($arr,0,count($arr)-1);
    }
}
$arr=[6,5,4,3,2,1,2,3,4,5,6,7,1];
echo "Origin:".dumpArrln($arr);
MergeTD::sort($arr);
echo "New:".dumpArrln($arr);
