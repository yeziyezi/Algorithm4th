<?php
require("DoubleNode.php");
class Deque implements Iterator{

    private $count=0;
    private $left=null;
    private $right=null;
    private $iterPointer=null;
    private function init(DoubleNode $node){
        $this->left=$node;
        $this->right=$node;
        return;
    }
    public function isEmpty(){
        return $this->count==0;
    }
    public function size(){
        return $this->count;
    }
    public function pushLeft($data){
        $node=new DoubleNode($data);
        $this->iterPointer=$node;
        if($this->count==0){
            $this->init($node);
        }else{
            $node->prev=null;
            $node->next=$this->left;
            $this->left->prev=$node;
            $this->left=$node;
        }
        ++$this->count;
    }
    public function pushRight($data){
        $node=new DoubleNode($data);
        if($this->count==0){
            $this->init($node);
        }else{
            $node->prev=$this->right;
            $node->next=null;
            $this->right->next=$node;
            $this->right=$node;
        }
        ++$this->count;
    }
    public function popLeft(){
        $node=$this->left;
        $this->iterPointer=$this->left->next;
        $this->left=$this->left->next;
        $node->prev=null;
        $node->next=null;
        --$this->count;
        return $node;
    }
    public function popRight(){
        $node=$this->right;
        $this->right=$this->right->prev;
        $this->right->next=null;
        $node->prev=null;
        $node->next=null;
        --$this->count;
        return $node;
    }
    public function next(){
        $this->iterPointer=$this->iterPointer->next;
    }
    public function valid(){
        return $this->iterPointer!==null;
    }
    public function rewind(){
        $this->iterPointer=$this->left;
    }
    public function current(){
        return $this->iterPointer->data;
    }
    public function key(){
        if($this->valid()){
            return "key";
        }
        return null;
    }
    public function iterate(){
        foreach($this as $k=>$v){
            echo $v,"->";
        }
        echo "\n";
    }
}

$deque=new Deque();
$deque->pushLeft("node1");
$deque->iterate();
$deque->pushRight("node2");
$deque->iterate();
$deque->pushLeft("node3");
$deque->iterate();
$deque->popRight();
$deque->iterate();
$deque->popLeft();
$deque->iterate();
