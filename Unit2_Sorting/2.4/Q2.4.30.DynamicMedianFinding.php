<?php
DynamicMedianFinding::test();
class DynamicMedianFinding{
    private $median=null;
    private $left=null;
    private $right=null;
    function __construct(){
        $lessRule=function($a,$b){
            return $a<$b;
        };
        $this->left=new MaxPQ($lessRule);
        $this->right=new MinPQ($lessRule);
    }
    public function insert(int $data){
        echo "insert $data\n";
        if($this->median==null){
            $this->median=$data;
            return;
        }
        $data>$this->median?$this->right->insert($data):$this->left->insert($data);
        if(abs($this->left->size()-$this->right->size())>=2){
            if($this->left->size()>$this->right->size()){
                $this->right->insert($this->median);
                echo "left delete ".$this->left->maxValue(),"\n";
                $this->median=$this->left->deleteMax();
            }else{
                $this->left->insert($this->median);
                echo "right delete ".$this->right->minValue(),"\n";
                $this->median=$this->right->deleteMin();
            }
        }
    }
    public function median(){
        if($this->left->size()>$this->right->size()){
            return ($this->left->maxValue()+$this->median)/2;
        }else if($this->left->size()<$this->right->size()){
            return ($this->right->minValue()+$this->median)/2;
        }else{
            return $this->median;
        }
    }
    public function show(){
        echo 'left:';
        $this->left->show();
        echo "median:".$this->median."\n";
        echo 'right:';
        $this->right->show();
        echo "real median".$this->median();
        echo "\n\n";
    }   
    public static function test(){
        require("common.php");
        $mf=new DynamicMedianFinding();
        for($i=0;$i<10;$i++){
            $num=random_int(1,100);
            $mf->insert($num);
            $mf->show();
        }
    }

}


//MaxPQ & MinPQ
class MinPQ{
    private $data=[0=>0];
    private $total=0;
    private $lessRule=null;
    function __construct(callable $lessRule)
    {
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
    }
    public function deleteMin(){
        $minValue=$this->minValue();
        $this->data[1]=$this->data[$this->total];
        unset($this->data[$this->total--]);
        $this->sink(1);
        return $minValue;
    }
    public function minValue(){
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
    public function size(){
        return $this->total;
    }
}

class MaxPQ{
    private $data=[0=>0];
    private $total=0;
    private $lessRule=null;
    function __construct(callable $lessRule)
    {
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
    public function deleteMax(){
        $minValue=$this->maxValue();
        $this->data[1]=$this->data[$this->total];
        unset($this->data[$this->total--]);
        $this->sink(1);
        return $minValue;
    }
    public function maxValue(){
        return $this->data[1];
    }
    private function exchange(int $index1,int $index2){
        $t=$this->data[$index1];
        $this->data[$index1]=$this->data[$index2];;
        $this->data[$index2]=$t;
    }
    private function swim(int $index){
        while($index>1&&$this->less(intval($index/2),$index)){
            //echo $this->data[index]." swim to ".$this->data[intval($index/2)]."\n";
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
    public function show(){
        // showCompleteBinaryTree($this->data);
        echo dumpArrln($this->data,1);
    }
    public function size(){
        return $this->total;
    }
}