<?php
//MaxPQ & MinPQ
//Trait is a awful feature!Use combinations first instead of inheritance!
Trait PQ{
    private $data=[0=>0];
    private $total=0;
    private $lessRule=null;
    function __construct(callable $lessRule=null){
        if($lessRule===null){
            $lessRule=function($a,$b){return $a<$b;};
        }
        $this->lessRule=$lessRule;
    }
    private function less(int $i,int $j){
        $lr=$this->lessRule;
        return $lr($this->data[$i],$this->data[$j]);
    }
    public function insert($data){
        $this->data[++$this->total]=$data;
        $this->swim($this->total);
    }
    private function exchange(int $index1,int $index2){
        $t=$this->data[$index1];
        $this->data[$index1]=$this->data[$index2];;
        $this->data[$index2]=$t;
    }
    public function show(callable $showFunction=null){
        // showCompleteBinaryTree($this->data);
        if($showFunction===null){
            echo dumpArrln($this->data,1);
            return;
        }
        $showFunction($this->data);
    }
    public function size(){
        return $this->total;
    }
    public function isEmpty(){
        return $this->total===0;
    }
    public function deleteMinOrMax(){
        $minOrMax=$this->minOrMax();
        $this->data[1]=$this->data[$this->total];
        unset($this->data[$this->total--]);
        $this->sink(1);
        return $minOrMax;
    }
    public function minOrMax(){
        return $this->data[1];
    }

}
class MinPQ{
    use PQ;
    function __call($name, $arguments){
        switch($name){
        case 'min':return $this->minOrMax();
        case 'deleteMin':return $this->deleteMinOrMax();
        }
    }
    private function swim(int $index){
        while($index>1&&$this->less($index,intval($index/2))){
            $this->exchange($index,intval($index/2));
            $index=intval($index/2);
        }
    }
    private function sink(int $index){
        while(2*$index<=$this->total){
            $child=$index*2;
            if($child < $this->total && $this->less($child+1,$child)){
                $child++;
            }
            if(!$this->less($child,$index)){
                break;
            }
            $this->exchange($child,$index);
            $index=$child;
        }
    }
}

class MaxPQ{
    use PQ;
    function __call($name, $arguments){
        switch($name){
        case 'max':return $this->minOrMax();
        case 'deleteMax':return $this->deleteMinOrMax();
        }
    }
    private function swim(int $index){
        while($index>1&&$this->less(intval($index/2),$index)){
            $this->exchange($index,intval($index/2));
            $index=intval($index/2);
        }
    }
    private function sink(int $index){
        while(2*$index<=$this->total){
            $child=$index*2;
            if($child < $this->total && $this->less($child,$child+1)){
                $child++;
            }
            if(!$this->less($index,$child)){
                break;
            }
            $this->exchange($child,$index);
            $index=$child;
        }
    }
    public function debug(){
        print_r($this->data);
    }
}