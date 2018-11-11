<?php
require("PQ.php");
class California{
    private $namePQ;
    public function __construct(){
        $this->namePQ=new MinPQ(function(string $a,string $b){
            $func=self::compare();
            return $func($a,$b)<0;
        });
    }
    public function insert(string $name){
        $this->namePQ->insert($name);
    }
    public function show(){
        $namePQ=$this->namePQ;
        while(!$namePQ->isEmpty()){
            $name=$this->namePQ->deleteMin();
            echo $name,"\n";
        }
    }
    public static function compare(){
        return function(string $name1,string $name2){
            $rule='RWQOJMVAHBSGZXNTCIEKUPDYFL';
            $len1=strlen($name1);
            $len2=strlen($name2);
            $len=min($len1,$len2);
            $name1=strtoupper($name1);
            $name2=strtoupper($name2);
            for($i=0;$i<$len;$i++){
                $index1=strpos($rule,self::getFirstCharacterAndDeleteIt($name1));
                $index2=strpos($rule,self::getFirstCharacterAndDeleteIt($name2));
                if($index1<$index2) return -1;
                if($index1>$index2) return 1;
            }
            if($len1>$len2) return 1;
            if($len1<$len2) return -1;
            return 0;
        };
    }
    private static function getFirstCharacterAndDeleteIt(string &$str){
        $c=chr(ord($str));
        $str=substr($str,1);
        return $c;
    }
    public static function sort(array &$names){
        usort($names,California::compare());
    }
    public static function test(){
        require("common.php");
        $names=['sefesf','sehbdrnsfoa','jacieof','seuisi','podq','ceggst'];
        echo dumpArrln($names);
        California::sort($names);
        echo dumpArrln($names);
        echo "==================\n";
        $names=['sefesf','sehbdrnsfoa','jacieof','seuisi','podq','ceggst'];
        echo dumpArrln($names);
        $cali=new California();
        foreach($names as $name){
            $cali->insert($name);
        }
        $cali->show();

    }
}
California::test();