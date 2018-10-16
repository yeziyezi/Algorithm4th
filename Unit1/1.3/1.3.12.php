<?php
require("Node.php");
class Stack implements Iterator{
    private $top=null;
    private $current=null;
    private $currentDepth=0;
    private $elementCount=0;
    public function pop(){
        if($this->elementCount==0){
            throw new Exception("Pop Error:Stack is already empty");
        }else if($this->elementCount==1){//栈空，迭代器的标记也要置0
            $this->currentDepth=0;
        }
        $node=$this->top;
        $this->top=$this->top->next;
        $this->current=$this->top;
        return $node;
    }
    public function push(Node $node){
        ++$this->currentDepth;
        ++$this->elementCount;
        $node->next=$this->top;
        $this->top=$node;
        $this->current=$this->top;
    }
    public function current(){
        return $this->current;
    }
    public function key(){
        return $this->currentDepth-1;
    }
    public function next(){
        $node=$this->current->next;
        if($node!=null){
            ++$this->currentDepth;
        }
        $this->current=$this->current->next;
        return $node;
    }
    public function rewind(){
        $this->current=$this->top;
        if($this->elementCount==0){
            $this->currentDepth=0;
        }else{
            $this->currentDepth=1;
        }
    }
    public function valid(){
        if($this->current==null){
            return false;
        }
        return true;
    }
    public function copy(){
        $stackCopy=new Stack();
        $buf=[];
        foreach($this as $k=>$v){
            $buf[]=$v;
        }
        $buf=array_reverse($buf);
        foreach($buf as $node){
            $stackCopy->push($node);
        }
        return $stackCopy;
    }
}
$node1=new Node("node1");
$node2=new Node("node2");
$node3=new Node("node3");
$node4=new Node("node4");
$node5=new Node("node5");
$stack=new Stack();
$stack->push($node1);
$stack->push($node2);
$stack->push($node3);
foreach($stack as $k=>$v){
    echo $k,":",$v->data,"\n";
}
echo "\n";
$stack->pop();
$stack->push($node4);
$stack->push($node5);
foreach($stack as $k=>$v){
    echo $k,":",$v->data,"\n";
}
echo "\ncopy:\n";
$stackCopy=$stack->copy();
foreach($stack as $k=>$v){
    echo $k,":",$v->data,"\n";
}