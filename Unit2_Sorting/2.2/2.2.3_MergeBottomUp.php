<?php
require("common.php");
//自底向上的归并排序实现
//与自顶向下的区别：自顶向下是将整个大数组不断切分成小数组，再递归归并成一个有序大叔组
//自底向上是从最小的数组（大小为1）开始逐渐将小数组归并为最后的大数组
//相比自顶向下少了很多函数调用
class MergeBU{
    //merge函数与自顶向下相比没有变化
    private  static function merge(array &$arr,int $low,int $mid,int $high,array &$temp){
        for($i=$low;$i<=$high;$i++){
            $temp[$i]=$arr[$i];
        }
        $p1=$low;
        $p2=$mid+1;
        for($i=$low;$i<=$high;$i++){
            switch(true){
            case $p1>$mid:$arr[$i]=$temp[$p2++];break;
            case $p2>$high:$arr[$i]=$temp[$p1++];break;
            case $temp[$p1]<=$temp[$p2]:$arr[$i]=$temp[$p1++];break;
            default:$arr[$i]=$temp[$p2++];break;
            }
        }
    }
    public static function sort(array &$arr){
        $len=count($arr);
        $temp=array_fill(0,$len,0);//在sort中新建一个临时数组将引用传递给merge函数，避免重复创建新的数组浪费空间 事先填充0可以避免Notice提示未定义偏移量

        for($size=1;$size<$len;$size*=2){
            for($low=0;$low<$len-$size;$low+=($size*2)){//low是将要合并的两个小数组的最小索引
                self::merge($arr,$low,$low+$size-1,min($low+$size*2-1,$len-1),$temp);//在merge时，实际上是将$low~$mid作为一个数组，$mid+1~$high作为另一个数组,并且绝大多数两个数组都是相等的
                //例 1,2,3,4,5,6,7,8 low=1,mid=4,high=8
            }
        }
    }
}
$arr=[1,4,2,10,3,4,8,5,3,6,2,5,4,3,2,1];
echo "Origin:".dumpArrln($arr);
MergeBU::sort($arr);
echo "New:".dumpArrln($arr);
