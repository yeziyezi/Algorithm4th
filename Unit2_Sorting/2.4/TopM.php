<?php
require("common.php");
class MinPQ{
    private $limit=0;
    private $data=[0=>0];
    private $total=0;
    private $lessRule=null;
    function __construct(int $limit,callable $lessRule)
    {
        $this->limit=$limit;
        $this->lessRule=$lessRule;
    }
    private function less(int $i,int $j){
        //copy the closure object to use
        //if use $this->lessRule(...) directly
        //You will got a fatal error:call to undefined method
        $lr=$this->lessRule;
        return $lr($this->data[$i],$this->data[$j]);
    }
    public function insert($data){
        $this->data[++$this->total]=$data;
        $this->swim($this->total);
        if($this->total>$this->limit){
            $this->deleteMin();
        }
    }
    private function deleteMin(){
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
}
//test
$minPQ=new MinPQ(26,function(string $data1,string $data2){
    return $data1<$data2;
});
$arr=range('A','Z');//[A,B,C,...,Z]
//suggest $i less than 16 ,or the screen width will not enough
for($i=0;$i<100;$i++){
    $minPQ->insert($arr[array_rand($arr)]);
    $minPQ->show();
    echo "\n";
}