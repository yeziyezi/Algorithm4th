<?php
require("Stack.php");
require("Node.php");
//括号匹配


function test(){
    $c=fgetc(STDIN);
    $stack=new Stack();
    while($c!=PHP_EOL){
        try{
            switch($c){
                case "]":$sth=$stack->pop()->data;if($sth!="[")return false;break;
                case ")":$sth=$stack->pop()->data;if($sth!="(")return false;break;
                case "}":$sth=$stack->pop()->data;if($sth!="{")return false;break;
                default:$node=new Node($c);$stack->push($node);
            }
        }catch(Exception $e){
            return false;
        }
        $c=fgetc(STDIN);
    }
    return true;
}
if(test())echo "true\n";
else echo "false\n";