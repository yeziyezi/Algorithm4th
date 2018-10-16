<?php
//链表实现的下压堆栈，将链表头作为栈顶
//命令 php stack_byLinkedList.php < test.txt
class Stack
{
    private $count = 0;
    private $top = null;
    public function push(Node $node)
    {
        ++$this->count;
        if ($this->top === null) {
            $this->top = $node;
        } else {
            $node->next = $this->top;
            $this->top = $node;
        }
    }
    public function pop()
    {
        if ($this->count === 0) {
            throw new Exception("Pop Exception,Stack is empty");
            return;
        }
        --$this->count;
        $node = $this->top;
        $this->top = $this->top->next;
        return $node;
    }
    public function size()
    {
        return $this->count;
    }
    public function isEmpty()
    {
        return $this->count === 0;
    }
    public function peek()
    {
        if ($this->count == 0) {
            return null;
        }
        return $this->top;
    }
}