<?php
class RandomBag implements Iterator{
    private $total=0;
    private $bag=[];
    private $remaining=[];
    public function size(){
        return $this->total;
    }
    public function isEmpty(){
        return $this->total==0;
    }
    public function add($data){
        $this->bag[$this->total]=$data;
        $this->remaining[]=$this->total;
        $this->total++;
    }
    public function key(){
        return "key";
    }
    public function valid(){
        if(count($this->remaining)==0){
            return false;
        }
        return true;
    }
    public function next(){
        //donothing
    }
    public function current(){
        $iterIndex=array_rand($this->remaining);
        $current=$this->bag[$this->remaining[$iterIndex]];
        unset($this->remaining[$iterIndex]);
        return $current;
    }
    public function iterate(){
        // var_dump($this);

        echo "[ ";
        foreach($this as $k=>$v){
            echo $v,' '; 
        }
        echo "]\n";
    }
    public function rewind(){
        $this->remaining=[];
        foreach($this->bag as $k=>$v){
            $this->remaining[]=$k;
        }
    }
}
$bag =new RandomBag;
$bag->add("1");
$bag->add("2");
$bag->add("3");
$bag->add("4");
$bag->add("5");
$bag->add("6");
$bag->add("7");
$bag->add("8");

$bag->iterate();
