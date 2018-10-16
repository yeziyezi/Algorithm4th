<?php
//路径压缩的加权quick union算法，是union-find的最优实现
require("1.5.7_trait_uf.php");
class PathCompressionWeightedQuickUnionUF{
    use UF;
    private $componentSize=[];
    function __construct($pointCount){
        for($i=0;$i<$pointCount;$i++){
            $this->points[$i]=$i;
            $this->componentSize[$i]=1;
        }
        $this->componentCount=$pointCount;
    }
    private function find($p){
        $nodeOnPath=[];
        while($p!=$this->points[$p]){//寻找p的根结点
            $nodeOnPath[]=$p;
            $p=$this->points[$p];
        }
        foreach($nodeOnPath as $node){//路径压缩 将寻根路径上的所有结点直接连接到根结点
            $this->points[$node]=$p;
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
            $this->componentSize[$pRoot]=$pSize+$qSize;

        }else{
            $this->points[$pRoot]=$qRoot;
            $this->componentSize[$pRoot]=$pSize+$qSize;
        }
        $this->componentCount--;
    }
}


test("PathCompressionWeightedQuickUnionUF");
