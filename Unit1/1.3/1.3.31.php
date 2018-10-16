<?php
class DoubleNode{
    private $data;
    function __construct($data=null){
        $this->data=$data;
    }
    public $prev=null;
    public $next=null;
    function __get($name){
        return $this->$name;
    }
}
class DoubleLinkList{
    public static function insertFirst(DoubleNode $list,DoubleNode $insert){
        while($list->prev!=null){//确保list指向头节点
            $list=$list->prev;
        }
        $insert->prev=null;
        $insert->next=$list;
        $list->prev=$insert;
        $list=$insert;
        return $list;
    }
    public static function insertLast(DoubleNode $list,DoubleNode $node){
        $p=$list;
        while($p->next!=null){
            $p=$p->next;
        }
        $p->next=$node;
        $node->prev=$p;
        $node->next=null;
        return $list;
    }
    public static function deleteFirst(DoubleNode $list){
        while($list->prev!=null){
            $list=$list->prev;
        }
        $t=$list;
        $list=$list->next;
        $list->prev=null;
        $t->next=null;
        return $list;
    }
    public static function deleteLast(DoubleNode $list){
        $p=$list;
        while($p->next!=null){
            $p=$p->next;
        }
        $newlast=$p->prev;
        $p->prev=null;
        $newlast->next=null;
        return $list;
    }
    public static function insertBefore(DoubleNode $node,DoubleNode $insert){
        $prev=$node->prev;
        $prev->next=$insert;
        $insert->prev=$prev;
        $insert->next=$node;
        $node->prev=$insert;
    }
    public static function insertAfter(DoubleNode $node,DoubleNode $insert){
        $next=$node->next;
        $node->next=$insert;
        $insert->prev=$node;
        $insert->next=$next;
        $next->prev=$insert;
    }
    public static function delete(DoubleNode $node){
        $prev=$node->prev;
        $next=$node->next;
        $node->prev=null;
        $node->next=null;
        $prev->next=$next;
        $next->prev=$prev;
    }
}
function iterate(DoubleNode $node){
    echo "正序:";
    $p=$node;
    while($p->next!=null){
        echo $p->data,"->";
        $p=$p->next;
    }
    echo $p->data;
    echo "\n反序:";
    while($p->prev!=null){
        echo $p->data,"->";
        $p=$p->prev;
    }
    echo $p->data;
    echo "\n";
}
$node1=new DoubleNode("node1");
$node2=new DoubleNode("node2");
$node3=new DoubleNode("node3");
$node1->next=$node2;
$node2->prev=$node1;
$node2->next=$node3;
$node3->prev=$node2;
$list=$node1;
iterate($list);

// $list=DoubleLinkList::insertFirst($list,new DoubleNode("node4"));
// iterate($list);

// $list=DoubleLinkList::insertLast($list,new DoubleNode("node5"));
// iterate($list);

// $list=DoubleLinkList::deleteFirst($list);
// iterate($list);

// $list=DoubleLinkList::deleteLast($list);
// iterate($list);

// DoubleLinkList::delete($node2);
// iterate($list);

// $nodeX=new DoubleNode("nodex");
// DoubleLinkList::insertBefore($node2,$nodeX);
// iterate($list);

// $nodeX2=new DoubleNode("nodeX2");
// DoubleLinkList::insertAfter($node2,$nodeX2);
// iterate($list);