<?php
require("common.php");
//将两个有序的数组合并成一个有序数组，是归并排序的核心
function merge(array $arr,int $low,int $mid,int $high){
    $p1=$low;
    $p2=$mid+1;
    $temp=[];
    for($i=$low;$i<=$high;$i++){
        $temp[$i]=$arr[$i];
    }
    for($i=$low;$i<=$high;$i++){
        switch(true){
        case $p1>$mid:
            $arr[$i]=$temp[$p2++];break;
        case $p2>$high:
            $arr[$i]=$temp[$p1++];break;
        case $temp[$p1]<=$temp[$p2]:
            $arr[$i]=$temp[$p1++];break;
        default:
            $arr[$i]=$temp[$p2++];break;
        }
        echo "temp:".dumpArr($temp)."arr:".dumpArrln($arr);

    }
    return $arr;
}
$arr=[1,2,3,4,5,6,1,2,3,4,5,6];
echo "Origin:".dumpArrln($arr);
$low=0;
$high=count($arr)-1;
$mid=intval(($high-$low)/2);
merge($arr,$low,$mid,$high);
