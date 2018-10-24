<?php
require("common.php");
class MergeIndexSort{
    private static $index=[];
    private static $temp=[];
    private static function mergex(array $arr,int $low,int $mid,int $high){
        /**************** Wrong example *********************/
        // for($i=$low;$i<=$high;$i++){
        //     self::$temp[$i]=$arr[self::$index[$i]];
        // }
        // $p1=$low;
        // $p2=$mid+1;
        // for($i=$low;$i<=$high;$i++){
        //     switch(true){
        //     case $p1>$mid:
        //         self::$index[$i]=$p2++;break;
        //     case $p2>$high:
        //         self::$index[$i]=$p1++;break;
        //     case self::$temp[$p1]<=self::$temp[$p2]:
        //         self::$index[$i]=$p1++;break;
        //     default:
        //         self::$index[$i]=$p2++;break;
        //     }
        // }
        /***************************************************/
        for($i=$low;$i<=$high;$i++){
            self::$temp[$i]=self::$index[$i];//Remember to copy the part of the actually sorted array into temp
        }
        $p1=$low;
        $p2=$mid+1;
        for($i=$low;$i<=$high;$i++){
            switch(true){
            case $p1>$mid:
                self::$index[$i]=self::$temp[$p2++];break;
            case $p2>$high:
                self::$index[$i]=self::$temp[$p1++];break;
            case $arr[self::$temp[$p1]]<=$arr[self::$temp[$p2]]:
                self::$index[$i]=self::$temp[$p1++];break;
            default:
                self::$index[$i]=self::$temp[$p2++];
            }
        }

        /****************************test**********************/
        // echo "[ ";
        // for($i=$low;$i<=$high;$i++){
        //     echo self::$index[$i]."=>".$arr[self::$index[$i]]." "; 
        // }
        // echo "]\n";
        /*****************************************************/
    }
    public static function sort(array $arr){
        $len=count($arr);
        for($i=0;$i<$len;$i++){
            self::$index[$i]=$i;
        }
        for($size=1;$size<$len;$size*=2){
            for($low=0;$low<$len-$size;$low+=2*$size){
                self::mergex($arr,$low,$low+$size-1,min($low+2*$size-1,$len-1));
            }
        }
    }
    public static function validate(array $arr){
        echo "Sorted index".dumpArrln(self::$index);
        $result=[];
        foreach(self::$index as $i){
            $result[]=$arr[$i];
        }
        echo "result:".dumpArrln($result);
    }
}
$arr=[1,2,3,45,90,654,8,3,5,5,72,34,75,12,5,26,21,4,347,23,4];
echo "Origin:".dumpArrln($arr);
MergeIndexSort::sort($arr);
MergeIndexSort::validate($arr);