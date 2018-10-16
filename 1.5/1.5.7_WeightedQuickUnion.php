<?php
require("1.5.7_trait_uf.php");
class WeightedQuickUnionUF{
    use UF;
    private $componentSize=[];
    function __construct($pointCount){
        for($i=0;$i<$pointCount;$i++){
            $this->points[$i]=$i;
            $this->componentSize[$i]=$i;
        }
        $this->componentCount=$pointCount;
    }
    private function find($p){
        while($p!=$this->points[$p]){
            $p=$this->points[$p];
        }
        return $p;
    }
    public function union($p,$q){
        $pRoot=$this->find($p);
        $qRoot=$this->find($q);
        $pSize=$this->componentSize[$pRoot];
        $qSize=$this->componentSize[$qRoot];
        if($pSize>$qSize){
            $this->points[$qRoot]=$pRoot;
        }else{
            $this->points[$pRoot]=$qRoot;
        }
        $this->componentCount--;
    }
}


test("WeightedQuickUnionUF");
