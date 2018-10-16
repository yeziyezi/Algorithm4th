<?php
$arr=[11,10,1,7,6,5,4,3,2];
$len=count($arr);
$low=0;
$high=$len-1;
while($low<=$high){
    $mid=$low+($high-$low)/2;
    $leftValue=$arr[$mid-1];
    $rightValue=$arr[$mid+1];
    $midValue=$arr[$mid];
    echo "$leftValue $midValue $rightValue\n";
    if($midValue<$leftValue&&$midValue<$rightValue){
        echo $midValue,"\n";
        break;
    }else{
        if($leftValue<$rightValue){
            $high=$mid-1;
        }else{
            $low=$mid+1;
        }
    }
}
