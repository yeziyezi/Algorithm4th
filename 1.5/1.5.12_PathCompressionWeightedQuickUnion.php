<?php
//书：路径压缩的加权quick union算法，是union-find的最优实现
//实际：输入largeUF比未进行路径压缩之前还慢0.1s
//猜测：对于测试样例，压缩路径长度带来的性能提升小于压缩带来的性能损失
require("1.5.7_trait_uf.php");
class PathCompressionWeightedQuickUnionUF{
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
        }else{
            $this->points[$pRoot]=$qRoot;
        }
        $this->componentCount--;
    }
}


test("PathCompressionWeightedQuickUnionUF");
