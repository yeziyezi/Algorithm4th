<?php
require("Stack.php");
require("Node.php");
// $s=fgets(STDIN);
$s='( ( 1 2 + ) ( ( 3 4 - ) ( 5 6 - ) * ) * )';
$chars=explode(' ',$s);
$symbols=new Stack();
$nums=new Stack();
foreach($chars as $c){
    switch($c){
        case '+':
        case '-':
        case '*':
        case '/':$symbols->push(new Node($c));break;
        case '(':break;
        case ')':
                $symbol=$symbols->pop()->data;
                $right=$nums->pop()->data;
                $left=$nums->pop()->data;
                $result=0.0;
                switch($symbol){
                    case '+':$result=$left+$right;break;
                    case '-':$result=$left-$right;break;
                    case '*':$result=$left*$right;break;
                    case '/':$result=$left/$right;break;
                }
                $nums->push(new Node($result));
                break;
        default:$nums->push(new Node($c));                

    }
}
echo $nums->pop()->data,"\n";