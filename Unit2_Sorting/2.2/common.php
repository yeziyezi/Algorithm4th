<?php
function dumpArrln($arr){
    $output="[ ";
    foreach($arr as $num){
        $output.="$num ";
    }
    $output.="]";
    return $output."\n";
}
function dumpArr($arr){
    $output="[ ";
    foreach($arr as $num){
        $output.="$num ";
    }
    $output.="]";
    return $output;
}
function copyArr(array $src,int $low,int $high=null){
    if($high==null){
        $high=count($arr)-1;
    }
    $dst=[];
    for($i=$low;$i<=$high;$i++){
        $dst[]=$src[$i];
    }
    return $dst;
}