<?php
require("Node.php");
$node1=new Node("node1");
$node2=new Node("node2");
$node3=new Node("node3");
$node4=new Node("node4");
$node1->next=$node2;
$node2->next=$node3;
$node3->next=$node4;
//破坏性地将原链表倒置，并返回新链表的首节点

//迭代解法
function reverse1($node){
    if($node==null||$node->next==null){
        return $node;
    }
    $first=$node;
    $reverse=null;
    while($first!=null){
        $second=$first->next;
        $first->next=$reverse;
        $reverse=$first;
        $first=$second;
    }
    return $reverse;
}
// var_dump($node1);
// var_dump(reverse1($node1));
// $nodea=new Node("nodea");
// $nodeb=new Node("nodeb");
// $nodea->next=$nodeb;
// var_dump($nodea);
// var_dump(reverse1($nodea));

//递归解法 尾递归
function reverse2($node){
    if($node==null||$node->next==null)return $node;
    return reverse2_sub(null,$node,null);
}
function reverse2_sub($reverse,$first,$second){
    if($first==null){
        return $reverse;
    }
    $second=$first->next;
    $first->next=$reverse;
    $reverse=$first;
    $first=$second;
    return reverse2_sub($reverse,$first,$second);
}
// var_dump($node1);
// var_dump(reverse2($node1));

//递归解法二
//先递归颠倒后N-1个结点，再将第1个结点插入到颠倒结果的最后
//最后一次颠倒的结果就是最终逆序链表的首节点，即原链表的最后一个节点
function reverse3($first){
    if($first==null||$first->next==null){
        return $first;
    }
    $second=$first->next;
    $rest=reverse3($second);
    $second->next=$first;
    $first->next=null;
    return $rest;
}