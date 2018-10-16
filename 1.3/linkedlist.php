<?php
class LinkedList{
    private $head=null;
    public function setHead(Node $node){
        if(!isset($this->head)){
            $this->head=$node;
        }else{
            $node->next=$this->head;
            $this->head=$node;
        }
    }
    public function traverse(){
        $node=$this->head;
        while($node!=null){
            echo $node->data,'->';
            $node=$node->next;
        }
        echo "\n";
    }
}
class Node{
    private $data;
    public $next;
    public function __construct($data){
        $this->data=$data;
    }
    public function __get($name){
        return $this->$name;
    }
}
$node1=new Node("node1");
$node2=new Node("node2");
$node3=new Node("node3");
$list=new LinkedList();
$node1->next=$node2;
$node2->next=$node3;
$list->setHead($node1);
$list->traverse();
$node4=new Node("node4");
$list->setHead($node4);
$list->traverse();