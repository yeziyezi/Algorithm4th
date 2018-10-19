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