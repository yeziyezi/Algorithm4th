<?php

//链表实现的下压堆栈，将链表头作为栈顶
//命令 php stack_byLinkedList.php < test.txt
class Node
{
    private $data;
    public $next;
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function __get($name)
    {
        return $this->$name;
    }
}
class Stack
{
    private $count = 0;
    private $top = null;
    public function push(Node $node)
    {
        if ($this->top === null) {
            $this->top = $node;
        } else {
            $node->next = $this->top;
            $this->top = $node;
        }
        ++$this->count;
    }
    public function pop()
    {
        if ($this->count === 0) {
            throw new Exception("Pop Exception,Stack is empty");
        } else {
            --$this->count;
            $node = $this->top;
            $this->top = $this->top->next;
            return $node;
        }
    }
    public function size()
    {
        return $count;
    }
    public function isEmpty()
    {
        return $count === 0;
    }

}
$in = fgets(STDIN);
$stack = new Stack();
while ($in != "") {
    $data = explode(" ", $in);
    foreach ($data as $d) {
        if ($d === "-") {
            $node = $stack->pop();
            echo $node->data, ' ';
        } else {
            $stack->push(new Node($d));
        }
    }
    $in = fgets(STDIN);
}

