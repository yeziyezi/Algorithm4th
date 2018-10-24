<?php
require("common.php");
//自顶向下的归并排序+三个改进：
//对小数组使用插入排序
//对已有序的数组不再排序
//将复制元素到辅助数组的过程替换掉：交替地由原数组和辅助数组向对方写入已排序的结果
class MergeTDX{
    private const LIMIT=7;
    private static function merge(array &$src,array &$dst,int $low,int $mid,int $high){
        $p1=$low;
        $p2=$mid+1;
        for($i=$low;$i<=$high;$i++){
            switch(true){
            case $p1>$mid:
                $dst[$i]=$src[$p2++];break;
            case $p2>$high:
                $dst[$i]=$src[$p1++];break;
            case $src[$p1]<=$src[$p2]:
                $dst[$i]=$src[$p1++];break;
            default:
                $dst[$i]=$src[$p2++];
            }
        }
    }
    private static function rsort(array &$src, array &$dst,int $low,int $high){//the real sort function
        // echo "src ".dumpArr($src)." dst".dumpArrln($dst);
        //对小数组直接插入排序 此时不再需要if (hi <= lo) return;
        if($high-$low<=self::LIMIT){
            self::insertionSort($dst,$low,$high);
            return;
        }
        $mid=$low+intval(($high-$low)/2);
        self::rsort($dst,$src,$low,$mid);
        self::rsort($dst,$src,$mid+1,$high);
        if($src[$mid+1]>=$src[$mid]){//已排序好
            for($i=$low;$i<=$high;$i++){
                $dst[$i]=$src[$i];
            }
            return;
        }
        self::merge($src,$dst,$low,$mid,$high);
    }
    public static function sort(array &$arr){
        $temp=$arr;//复制arr到temp（实际上复制的不是值，而是引用，等到对temp或arr修改时会自动复制一份，这就是PHP的写时复制。这里可以认为是直接复制了值）
        self::rsort($temp,$arr,0,count($arr)-1);//将结果写入原数组
    }
    private static function insertionSort(array &$arr,int $low,int $high){
        for($i=$low;$i<=$high;$i++){
            for($j=$i;$j>$low&&$arr[$j]<$arr[$j-1];$j--){
                $t=$arr[$j];
                $arr[$j]=$arr[$j-1];
                $arr[$j-1]=$t;
            }
        }
    }
}
$arr=[6,5,4,3,2,1,2,3,4,5,6,7,1];
echo "Origin:".dumpArrln($arr);
MergeTDX::sort($arr);
echo "New:".dumpArrln($arr);