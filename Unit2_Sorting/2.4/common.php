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
function showCompleteBinaryTree(array $arr){
    //arr[0] usually not used
    $total=count($arr)-1;
    $depth=intval(floor(log($total,2)))+1;
    if($depth==1){
        echo $arr[1],"\n";
        return;
    }
    for($t=0;pow(2,$t)<$depth;$t++);
    if(pow(2,$t)!=$depth){
        $d=pow(2,$t);
    }else{
        $d=$depth;
    }
    echo "depth:$depth\n";
    echo "d:$d\n";
    for($i=1;$i<=$depth;$i++){   
        $leftSpace=2**($d-$i)-1;
        if($leftSpace<0)$leftSpace=0;
        echo str_repeat(' ',$leftSpace);
        if($i==1){
            echo $arr[1],"\n";
            continue;
        }        
        $delimiteSpace=2**($d-$i+1)-1;
        for($j=pow(2,$i-1);$j<pow(2,$i)&&$j<=$total;$j++){
            echo $arr[$j].str_repeat(' ',$delimiteSpace);
        }
        echo "\n";
    }
}