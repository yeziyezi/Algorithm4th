<?php
require("Node.php");
$node1=new Node("node1");
$node2=new Node("node2");
$node3=new Node("node3");
$node4=new Node("node4");


//当节点保存的next是后续节点的引用时，将next置为null，才是真正删掉后续节点，
//否则会造成后续节点变成游离对象
$node1->next=&$node2;
$node2->next=&$node3;
$node3->next=&$node4;

//删掉第k个节点 1.3.20
function delete(int $k){
    global $node1;
    $node=$node1;
    for($i=2;$node!=null&&$i<$k;++$i)
        $node=$node->next;
    if($i<$k){
        return;
    }
    $node->next=null;
    print_r($node1);
}

//1.3.21
function find(Node $first,string $key){
    for($node=$first;$node!=null;$node=$node->next){
        if($node->data==$key)return true;
   }
   return false;
}
// var_dump(find($node1,"node5"));

//1.3.24
function removeAfter(Node $node){
    if($node==null||$node->next==null){
        return;
    }
    $t=$node->next;
    $node->next=$node->next->next;
    $t=null;
}
// removeAfter($node2);
// var_dump($node2);
// var_dump($node3);

//1.3.25
function insertAfter(Node $node1,Node $node2){
    if($node1==null||$node2==null){
        return;
    }
    $node2->next=$node1->next;
    $node1->next=$node2;
}
// var_dump($node1);
// $nodeX=new Node("nodeX");
// insertAfter($node2,$nodeX);
// var_dump($node1);

//1.3.26
$node=new Node("node");
$nodea=new Node("node");
$nodeb=new Node("nodeb");
$nodec=new Node("node");
$noded=new Node("noded");

$node->next=&$nodea;
$nodea->next=&$nodeb;
$nodeb->next=&$nodec;
$nodec->next=&$noded;

function remove(Node &$list,string $key){
    $head=new Node(null);
    $head->next=$list;
    $node1=$head;
    $node2=$head->next;
    while($node2!=null){
        if($node2->data===$key){
            $node2=$node2->next;
            $node1->next=null;
            $node1->next=$node2;
        }else{
            $node1=$node1->next;
            $node2=$node2->next;
        }
    }
    var_dump($head);
    var_dump($head->next);
    $list=$head->next;
}
var_dump($node);
remove($node,"node");
var_dump($node);
