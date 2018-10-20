<?php
//based on WeightedQuickUnion
require("1.5.7_trait_uf.php");
function generator($n){
    for($i=0;$i<$n;$i++){
        yield $i;
    }
}
class ErdosRenyi{
    use UF;
    private $connectionCount=0;
    private $componentSize=[];
    function __construct($pointCount){
        $generator=generator($pointCount);
        foreach($generator as $num){
            $this->points[$num]=$num;
            $this->componentSize[$num]=1;
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
        $this->connectionCount++;
        $this->componentCount--;
    }
    public function connectionCount(){
        return $this->connectionCount;
    }
}
//测试用例
$in=fscanf(STDIN,"%d");
$pointTotalCount=intval($in[0]);
$erdosRenyi=new ErdosRenyi($pointTotalCount);
$timeSpend=0.0;
$timeStart=microtime(true);
$connectionCount=0;
while(true){
    $p=rand(0,$pointTotalCount-1);
    $q=rand(0,$pointTotalCount-1);
    while($p==$q) 
        $q=rand(0,$pointTotalCount-1);
    if($erdosRenyi->connected($p,$q))
        continue;
    $erdosRenyi->union($p,$q);
    $connectionCount=$erdosRenyi->connectionCount();
    echo "total connection: $connectionCount|".(microtime(true)-$timeStart+$timeSpend)."seconds\r";//动态显示连接数的增长以及花费时间
    if($erdosRenyi->componentCount()==1){//当分量为1时全部连接上
        echo "\n";
        break;
    }
}
//事实上结果总是输入减1