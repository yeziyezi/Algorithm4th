<?php
require("Stack.php");
require("Node.php");
$nums=new Stack();
$symbols=new Stack();
$c=fgetc(STDIN);
while($c!=PHP_EOL){
    
    switch($c){
        case '+':
        case '-':
        case '*':
        case '/':
                $symbols->push(new Node($c));
                break;
        case ')':
                $symbol=$symbols->pop()->data; 
                $right=$nums->pop()->data;
                $left=$nums->pop()->data;
                $nums->push(new Node('( '.$left.' '.$right.' '.$symbol.' )'));
                break;
        case '(':break;
        default:$nums->push(new Node($c));
    }
    $c=fgetc(STDIN);
}

echo $nums->pop()->data,"\n";