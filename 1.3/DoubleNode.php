<?php
class DoubleNode{
    private $data;
    function __construct($data=null){
        $this->data=$data;
    }
    public $prev=null;
    public $next=null;
    function __get($name){
        return $this->$name;
    }
}