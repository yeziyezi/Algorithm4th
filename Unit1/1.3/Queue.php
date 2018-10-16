<?php
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
        return $this->count;
    }
    public function isEmpty(){
        return $this->count===0;
    }

}