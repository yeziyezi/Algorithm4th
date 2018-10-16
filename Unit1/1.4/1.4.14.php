<?php
require("timer.php");
$nums=[];
echo 'reading...',"\n";
while($in=fscanf(STDIN,"%d")){
    $nums[]=$in[0];
}
echo count($nums),' numbers read',"\n";
$timer=new Timer;

// $timer->start();
// threeSum1($nums);
// $timer->stop();

$timer->start();
fourSum1($nums);
$timer->stop();

//二分查找
function binarySearch($list,$num){
    $len=count($list);
    $low=0;
    $high=$len-1;
    while($low<=$high){
        $mid=$low+($high-$low)/2;
        if($list[$mid]>$num) $high=$mid-1;
        elseif($list[$mid]<$num) $low=$mid+1;
        else return $mid;
    }
    return -1;
}


//*********************************************************
//时间复杂度N^3lgN
//1kints 191s
//2kints 鬼知道要多久
function fourSum1($list){
    array_multisort($list,SORT_ASC);
    $len=count($list);
    $count=0;
    for($i=0;$i<$len;$i++){
        for($j=$i+1;$j<$len;$j++){
            for($k=$j+1;$k<$len;$k++){
                if(binarySearch($list,-$list[$i]-$list[$j]-$list[$k])>$k)
                    $count++;
            }
        }
    }
    echo 'result:',$count,"\n";
}
//********************************************************* 
//时间复杂度 N^2lgN
//1kints 0.5s
//2kints 2.3s
//4kints 9.7s
//8kints 42s
//16kints 179s
//32kints   797s
//1Mints    大概是 797*5*32 懒得跑了
function threeSum1($list){
    array_multisort($list,SORT_ASC);//排序极快 时间可忽略
    $len=count($list);
    $count=0;
    for($i=0;$i<$len;$i++){
        for($j=$i+1;$j<$len;$j++){
            if(binarySearch($list,-$list[$i]-$list[$j])>$j)//去重
                $count++;
        }
    }
    echo 'result:',$count,"\n";
}
//********************************************************* 
