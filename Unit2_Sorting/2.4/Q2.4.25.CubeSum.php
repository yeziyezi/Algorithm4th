<?php
require_once("common.php");
class MinPQ{
    private $data=[0=>0];
    private $total=0;
    private $compareRule=null;
    function __construct(callable $compareRule)
    {
        $this->compareRule=$compareRule;
    }
    private function less(int $i,int $j){
        $compareRule=$this->compareRule;
        return $compareRule($this->data[$i],$this->data[$j])<0;
    }
    public function insert($data){
        $this->data[++$this->total]=$data;
        $this->swim($this->total);
    }
    public function deleteMin(){
        $minValue=$this->minValue();
        $this->data[1]=$this->data[$this->total];
        unset($this->data[$this->total--]);
        $this->sink(1);
        return $minValue;
    }
    private function minValue(){
        return $this->data[1];
    }
    private function exchange(int $index1,int $index2){
        $t=$this->data[$index1];
        $this->data[$index1]=$this->data[$index2];;
        $this->data[$index2]=$t;
    }
    private function swim(int $index){
        while($index>1&&$this->less($index,intval($index/2))){
            //echo $this->data[index]." swim to ".$this->data[intval($index/2)]."\n";
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
    public function show(){
        // showCompleteBinaryTree($this->data);
        echo dumpArrln($this->data,1);
    }
    public function isEmpty(){
        return $this->total===0;
    }
}
class CubeSum{
    public $i;
    public $j;
    public $sum;
    public function __construct(int $i,int $j){
        $this->i=$i;
        $this->j=$j;
        $this->sum=$i**3+$j**3;
    }
    public static function compareRule(){
        return function(CubeSum $a,CubeSum $b){
            $aSum=$a->sum;
            $bSum=$b->sum;
            if($aSum>$bSum) return 1;
            if($aSum===$bSum) return 0;
            if($aSum<$bSum) return -1;
        };
    }
    public function toString(){
        return $this->sum.'='.$this->i.'^3+'.$this->j.'^3';
    }
}
//test
$pq=new MinPQ(CubeSum::compareRule());
$number=$argv[1];
for($i=0;$i<$number;$i++){
    $pq->insert(new CubeSum($i,0));
}
$temp=[];
$sum=0;
while(!$pq->isEmpty()){
    $cs= $pq->deleteMin();
    echo $cs->toString(),"\n";
    if($cs->j<$number){
        $pq->insert(new CubeSum($cs->i,$cs->j+1));
    }
}