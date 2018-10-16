<?php
trait UF{//private function find($p); private function union($p,$q);

    private $points=[];
    private $componentCount=0;
    function __construct($pointCount){
        for($i=0;$i<$pointCount;$i++){
            $this->points[$i]=$i;
        }
        $this->componentCount=$pointCount;
    }
    
    public function connected($p,$q){
        return $this->find($p)==$this->find($q);
    }
    public function componentCount(){
        return $this->componentCount;
    }
    
}
function test($aimClass){
    echo "timer start\n\033[?25l";
    $time=microtime(true);
    $count=fscanf(STDIN,"%d")[0];
    $uf=new $aimClass($count);
    while($nums=fscanf(STDIN,"%d%d")){
        $p=$nums[0];
        $q=$nums[1];
        if($uf->connected($p,$q)){
            continue;
        }
        $uf->union($p,$q);

        echo "time spend (second): ",microtime(true)-$time,"\r";
    }
    echo "\n";
    echo $uf->componentCount()." components\n\033[?25h";

    
}