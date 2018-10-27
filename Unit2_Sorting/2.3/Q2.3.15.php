<?php
//Nuts and bolts. (G. J. E. Rawlins). You have a mixed pile of N nuts and N bolts and need to quickly find the corresponding pairs of nuts and bolts. Each nut matches exactly one bolt, and each bolt matches exactly one nut. By fitting a nut and bolt together, you can see which is bigger. But it is not possible to directly compare two nuts or two bolts. Given an efficient method for solving the problem.
require("common.php");


//test result is about 0.84*N^2
//O(N^2)
function solution1(array $nuts,array $bolts,int $len){
    // echo "nuts:".dumpArrln($nuts);
    // echo "bolts:".dumpArrln($bolts);
    $times=0;
    $sorted=-1;
    for($i=0;$i<$len;$i++){
        for($j=$sorted+1;$j<$len;$j++){
            $times+=2;
            if($nuts[$i]==$bolts[$j]){
                swap($j,++$sorted,$bolts);
                $times+=2;
                break;
            }
        }
        // echo "sorting bolts:".dumpArrln($bolts);
    }
    // echo "sorted bolts:".dumpArrln($bolts);
    return $times;
}
function solution2($nuts,$bolts,$len){//save the data as a binary tree.
    //if a human being do this work,I think it only cost O(NlogN) times. Useing a binary tree ,many times will waste in traverse the tree.
    $times=0;
    $len=count($nuts);
    $left=[];
    $right=[];
    $parent=null;//This varible is for save the parent of the current node.If change $p directly ,the $p will point at the new Node object ,not the location of current node int the tree.So we must change the element value of it's parent. 
    $ruler=$nuts[0];
    for($i=0;$i<$len;$i++){
        if($bolts[$i]>$ruler){
            $right[]=$bolts[$i];
        }elseif($bolts[$i]<$ruler){
            $left[]=$bolts[$i];
        }
        $times+=2;
    }
    $head=new Node($ruler,$left,$right,null);
    for($i=1;$i<$len;$i++){
        $ruler=$nuts[$i];
        $times++;
        $p=$head;
        $isLeft=true;//we should remeber the current node is the left or the right child of it's parent.
        while(true){
            $times+=2;
            if(empty($p->left)&&empty($p->right))
                break;
            $times++;
            if($ruler>$p->data){
                $parent=$p;
                $p=$p->right;
                $isLeft=false;
            }elseif($ruler<$p->data){
                $parent=$p;
                $p=$p->left;
                $isLeft=true;
            }
        }
        $arr=$p;
        $left=[];
        $right=[];
        foreach($arr as $num){
            $times++;
            if($num<$ruler){
                $left[]=$num;
            }elseif($num>$ruler){
                $right[]=$num;
            }
        }
        $times++;
        if($isLeft){
            $parent->left=new Node($ruler,$left,$right);
        }else{
            $parent->right=new Node($ruler,$left,$right);
        }
    }
    // print_r($head);
    return $times;
}
test("solution2");
class Node{
    public $data;
    public $left;
    public $right;
    function __construct($data,$left,$right)
    {
        $this->data=$data;
        $this->left=$left;
        $this->right=$right;
    }
}
function test(callable $functionName,int $arrayLen=10,int $testTimes=1){

    $nuts = range(1, $arrayLen);
    $bolts = range(1, $arrayLen);
    shuffle($nuts);
    shuffle($bolts);

    if($testTimes==1){
        shuffle($nuts);
        shuffle($bolts);
        $functionName($nuts,$bolts,$arrayLen);
        return;
    }
    $time=microtime(true);
    $times = 0;
    for ($i = 0; $i < $testTimes; $i++) {
        shuffle($nuts);
        shuffle($bolts);
        $times += $functionName($nuts, $bolts,$arrayLen);
        echo "times:$i time spend ".(microtime(true)-$time)."s\r";
    }
    echo "\n";
    echo $functionName . " average access times:" . ($times / $testTimes) . ' average time cost'.((microtime(true)-$time)/$times)."\n";   
}

//test("solution1",100,100000); //40s cost,8400 times average array access
//test("solution2",100,100000);//22s cost,3200 times average array or list access.
// test("solution1",1000,1000);//average 28ms
// test("solution2",1000,1000);//average 2.8ms
// test("solution1",10000,1000);//average 3s
//test("solution2",10000,1000);//average 41ms
// test("solution1",100000,100);//more than 30s,my computer smells cooked.
// test("solution2",100000,100);//average 2s

//I am sorry about say that the solution2 is not at NlogN level.
//I think the time cost is already small.
//Google for the best answer.