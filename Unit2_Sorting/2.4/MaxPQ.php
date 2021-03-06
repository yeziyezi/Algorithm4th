<?php
require("common.php");
class MaxPQ{
    private $data=[0];
    private $total=0;
    public function isEmpty(){
        return empty($this->data);
    }
    public function size(){
        return $this->total;
    }
    public function swim(int $i){
        while($i>1&&$this->less(intval($i/2),$i)){
            $this->exch($i,intval($i/2));
            $i=intval($i/2);
        }
    }
    public function sink(int $i){
        while($i*2<=$this->total){
            $j=$i*2;
            if($j<$this->total && less($j,$j+1)) $j++;//exchange the unsorted node with it's larger child
            $this->exch($j,$i);
            $i=$j;
        }
    }
    public function exch(int $i,int $j){
        $t=$this->data[$i];
        $this->data[$i]=$this->data[$j];
        $this->data[$j]=$t;
    }
    public function less(int $i,int $j){
        $dataI=$this->data[$i];
        $dataJ=$this->data[$j];
        
        return $dataI<$dataJ;
    }
    public function max(){
        return $this->data[1];
    }
    public function deleteMax(){
        $maxValue=$this->max();
        $this->data[1]=$this->data[$this->total];
        unset($this->data[$this->total]);
        $this->sink(1);
        $this->total--;
        return $maxValue;
    }
    public function insert($data){
        //the data in the array must be uppercase character
        assert($this->isUppercase($data),new Exception('data is not uppercase character'));
        $this->data[]=$data;
        $this->total++;
        $this->swim($this->total);
    }
    private function isUppercase($data){
        if(!is_string($data)) return false;
        if(strlen($data)!==1) return false;
        if($data>'Z' || $data<'A') return false;
        return true;
    }
    public function show(){
        echo dumpArrln($this->data);
        showCompleteBinaryTree($this->data);
    }
}
//test
$maxPQ=new MaxPQ;
$arr=range('A','Z');//[A,B,C,...,Z]
//suggest $i less than 16 ,or the screen width will not enough
for($i=0;$i<15;$i++){
    $maxPQ->insert($arr[array_rand($arr)]);
    $maxPQ->show();
    echo "\n";
}