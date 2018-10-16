<?php
require("1.5.7_trait_uf.php");
class QuickUnionUF{
    use UF;
    private function find($p){
        while($p!=$this->points[$p]){
            $p=$this->points[$p];
        }
        return $p;
    }
    public function union($p,$q){
        $this->points[$this->find($p)]=$this->find($q);
        $this->componentCount--;
    }
}


test("QuickUnionUF");
