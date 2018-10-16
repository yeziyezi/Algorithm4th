<?php
require("1.5.7_trait_uf.php");

class QuickFindUF{
    use UF;
    private function find($p){
        return $this->points[$p];
    }
    public function union($p,$q){
        $pRoot=$this->points[$p];
        $qRoot=$this->points[$q];
        foreach($this->points as $key=>$root){
            if($root==$pRoot){
                $this->points[$key]=$qRoot;
            }
        }
        $this->componentCount--;
    }
}
test("QuickFindUF");