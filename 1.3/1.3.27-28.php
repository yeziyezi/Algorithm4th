<?php
require("Node.php");
$node1=new Node(32);
$node2=new Node(12);
$node3=new Node(92);
$node4=new Node(3);
$node5=new Node(13);

$node1->next=$node2;
$node2->next=$node3;
$node3->next=$node4;
$node4->next=$node5;

function max1(Node $node){
    if($node==null){
        return 0;
    }
    $max=0;
    for($n=$node;$n!=null;$n=$n->next){
        if($n->data>$max){
            $max=$n->data;
        }
    }
    return $max;
}
function max2(Node $node){
    return max2_sub($node,0);
}
function max2_sub($node,int $max){
    if($node==null){
        return $max;
    }
    if($node->data>$max){
        return max2_sub($node->next,$node->data);
    }else{
        return max2_sub($node->next,$max);
    }

}
echo 'max1:',max1($node1),"\n";
echo 'max2:',max2($node1),"\n";
