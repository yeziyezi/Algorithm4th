<?php
require("Node.php");
class Steque{
    private $top=null;
    public function enqueue(Node $node){
        if($this->top==null){
            $this->top=$node;
            return;
        }
        $p=$this->top;
        while($p->next!=null){
            $p=$p->next;
        }
        $p->next=$node;
    }
    public function pop(){
        $node=$this->top;
        $this->top=$this->top->next;
        $node->next=null;
        return $node;
    }
    public function push(Node $node){
        if($this->top==null){
            $this->top=$node;
            return;
        }
        $node->next=$this->top;
        $this->top=$node;
    }
    public function iterate(){
        $p=$this->top;
        echo "[top]";
        while($p!=null){
            echo $p->data,'->';
            $p=$p->next;
        }
        echo "\n";
    }
}
$n1=new Node("node1");
$n2=new Node("node2");
$n3=new Node("node3");
$n4=new Node("node4");
$s=new Steque();
$s->push($n1);
$s->iterate();
$s->enqueue($n2);
$s->iterate();
$s->push($n3);
$s->iterate();
$s->pop();
$s->iterate();
