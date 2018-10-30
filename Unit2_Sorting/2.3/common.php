<?php
function dumpArrln(array $arr,int $low=null,int $high=null){
    return dumpArr($arr,$low,$high)."\n"; 
}
function dumpArr(array $arr,int $low=null,int $high=null){
    $low=$low??0;
    $high=$high??count($arr)-1;
    $output="[ ";
    for($i=$low;$i<=$high;$i++){
        $output=$output.$arr[$i].' ';
    }
    $output.="]";
    return $output;
}
function copyArr(array $src,int $low,int $high=null){
    $high=$high??count($arr)-1;
    $dst=[];
    for($i=$low;$i<=$high;$i++){
        $dst[]=$src[$i];
    }
    return $dst;
}
function swap($a, $b,array &$arr=null)
{
    if($arr!=null){
        $t=$arr[$a];
        $arr[$a]=$arr[$b];
        $arr[$b]=$t;
    }
    $t = $a;
    $a = $b;
    $b = $t;
}