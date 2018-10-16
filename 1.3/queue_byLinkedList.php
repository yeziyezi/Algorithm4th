<?php

//链表实现的FIFO队列，将链表头作为队首，链表尾为队尾
//命令 php queue_byLinkedList.php < test.txt
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
class Queue{
    private $count=0;
    private $first=null;
    private $last=null;
    public function in(Node $node){
        if($this->count==0){
            $this->first=$node;
            $this->last=$node;
        }else{
            $this->last->next=$node;
            $this->last=$node;
        }
        ++$this->count;
    }
    public function out(){
        if($this->count===0){
            throw new Exception("Queue out Exception,Queue is empty");
        }else{
            --$this->count;
            $node=$this->first;
            $this->first=$this->first->next;
            return $node;
        }
    }
    public function size(){
        return $count;
    }
    public function isEmpty(){
        return $count===0;
    }

}
$in=fgets(STDIN);
$stack=new Queue();
while($in!=""){
    $data=explode(" ",$in);
    foreach($data as $d){
        if($d==="-"){
            $node=$stack->out();
            echo $node->data,' ';
        }else{
            $stack->in(new Node($d));
        }
    }   
    $in=fgets(STDIN);
}
