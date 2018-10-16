<?php
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