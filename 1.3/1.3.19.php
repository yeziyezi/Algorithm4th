<?php
require("Node.php");
$node1=new Node("node1");
$node2=new Node("node2");
$node3=new Node("node3");
$node4=new Node("node4");
$first=$node1;
$first->next=$node2;
$node2->next=$node3;
$node3->next=$node4;
//输出原链表
for($p=$first;$p!=null;$p=$p->next){
    echo $p->data,' -> ';
}
echo "\n";
//删掉尾结点
for($p=$first;$p->next->next!=null;$p=$p->next);
$p->next=null;
//输出新链表
for($p=$first;$p!=null;$p=$p->next){
    echo $p->data,' -> ';
}
echo "\n";
