<?php
require("common.php");
$len=10;

$arr=range(0,$len-1);//$arr=[0,1,2,.....,$len-1]

function deal1(array $arr,int $low,int $high,array &$result){//binary search the array
    if($low>$high) return;
    $mid=$low+intval(($high-$low)/2);
    $result[]=$arr[$mid];
    deal1($arr,$low,$mid-1,$result);
    deal1($arr,$mid+1,$high,$result);
}
$result=[];
echo "Origin:".dumpArrln($arr);
deal1($arr,0,$len-1, $result);
echo "deal1".dumpArrln($result);

//the answer on https://algs4.cs.princeton.edu/23quicksort/QuickBest.java.html
//Also binary search ,but exchange mid and low directly.
function deal2(array &$arr,int $low,int $high){
    if($low>=$high) return;
    $mid=$low+intval(($high-$low)/2);
    deal2($arr,$low,$mid-1);
    deal2($arr,$mid+1,$high);
    swap($low,$mid,$arr);
}
echo "Origin:".dumpArrln($arr);
deal2($arr,0,$len-1);
echo "deal2".dumpArrln($arr);