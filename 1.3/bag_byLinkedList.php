<?php
//链表实现的背包
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
class Bag{
    private $count=0;
    private $top=null;
    public function add(Node $node){
        if($this->top===null){
            $this->top=$node;
        }else{
            $node->next=$this->top;
            $this->top=$node;
        }
        ++$this->count;
    }
    public function size(){
        return $count;
    }
    public function isEmpty(){
        return $count===0;
    }

}
