<?php
require("Node.php");
$node1=new Node("node1");
$node2=new Node("node2");
$node3=new Node("node3");
//循环链表实现FIFO队列 入队到表尾，出队返回表首
class QueueByCircularLinkedList{
    private $count=0;
    private $first=null;
    public function in(Node $node){
        if($this->count==0){
            $this->first=$node;
            $this->first->next=$node;
        }else{
            $node->next=$this->first->next;
            $this->first->next=$node;
        }
        ++$this->count;
    }
    public function out(){
        $node_out=$this->first;
        $node=$this->first;
        for($i=1;$i<$this->count;++$i){
            $node=$node->next;
        }
        $node->next=$this->first->next;
        $this->first=$node;
        --$this->count;
        return $node_out;
    }
}
$list=new QueueByCircularLinkedList();
$list->in($node1);
$list->in($node2);
$list->in($node3);
echo $list->out()->data;
echo $list->out()->data;
echo $list->out()->data;