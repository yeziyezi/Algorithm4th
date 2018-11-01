<?php
require("common.php");
class IndexMinPQ{
    private $pq=[];
    private $indexes=[0=>0];
    private $total=0;
    private $lessRule=null;
    public function __construct(callable $lessRulefunction){
        $this->lessRule=$lessRulefunction;
    }
    public function insert(int $index,$item){
        $this->pq[$index]=$item;
        $this->indexes[++$this->total]=$index;
        if($this->size()>1){
            $this->swim($this->total);
        }
    }
    public function change(int $index,$item){
        $this->pq[$index]=$item;
    }
    public function contains(int $index){
        return !array_search($index,$this->indexes)===false;
    }
    public function delete(int $index){
        $realIndex=array_search($index,$this->indexes);
        assert($realIndex!==false,new Exception("index is not exist!"));
        assert($realIndex!==null,new Exception("invalid index!"));
        if($realIndex==$this->total){
            unset($this->indexes[$realIndex]);
            unset($this->pq[$index]);
            return;
        }
        $this->exchange($realIndex,$this->total);
        unset($this->indexes[$this->total]);
        unset($this->pq[$index]);
        $this->total--;
        $this->sink($realIndex);
    }
    public function min(){
        return $this->pq[$this->indexes[1]];
    }
    public function minIndex(){
        return $this->indexes[1];
    }
    public function delMin(){
        $index=$this->indexes[1];
        // $minItem=$this->pq[$index];
        $this->exchange(1,$this->total);
        unset($this->indexes[$this->total--]);
        unset($this->pq[$index]);
        $this->sink(1);
        return $index;
    }
    public function isEmpty(){
        return $this->total==0;
    }
    public function size(){
        return $this->total;
    }
    private function sink(int $index){
        $child=$index*2;
        while($child<=$this->total){
            if($child<$this->total && $this->less($child+1,$child))
                $child++;
            if($this->less($child,$index)){
                $this->exchange($child,$index);
            }
            $index=$child;
            $child=$index*2;
        }
    }
    public function show(){
        echo "[ ";
        for($i=1;$i<=$this->total;$i++){
            echo $this->pq[$this->indexes[$i]]," ";
        }
        echo "]\n";
    }
    private function swim(int $index){
        $parent=intval($index/2);
        while($parent>=1&&$this->less($index,$parent)){
            $this->exchange($index,$parent);
            $index=$parent;
            $parent=intval($index/2);
        }
    }
    private function less(int $index1,int $index2){
        $lessRule=$this->lessRule;
        $data1=$this->pq[$this->indexes[$index1]];
        $data2=$this->pq[$this->indexes[$index2]];
        return $lessRule($data1,$data2);
    }
    private function exchange(int $index1,int $index2){
        $t=$this->indexes[$index1];
        $this->indexes[$index1]=$this->indexes[$index2];
        $this->indexes[$index2]=$t;
    }
    
}
$pq=new IndexMinPQ(function(string $data1,string $data2){
    return $data1<$data2;
});
$len=30;
$index=range(1,$len);
$value=range('A','Z');
while(!empty($index)){
    $randKeyIndex=array_rand($index);
    $randNumber=$index[$randKeyIndex];
    $randLetter=$value[array_rand($value)];
    $pq->insert($randNumber,$randLetter);
    unset($index[$randKeyIndex]);
    echo "insert [$randNumber=>$randLetter]\n";
    $pq->show();
}
while(!$pq->isEmpty()){
    $minValue=$pq->min();
    $minIndex=$pq->delMin();
    echo "deleted:$minIndex=>$minValue\n";
    $pq->show();
}
