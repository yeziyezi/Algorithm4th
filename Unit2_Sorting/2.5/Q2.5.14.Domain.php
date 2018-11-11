<?php
class Domain{
    public $domainArr=[];
    public function __construct(string $domain){
        $this->domainArr=array_reverse(explode('.',$domain));
    }
    public static function compare(){
        return function(Domain $domain1,Domain $domain2){
            $len1=count($domain1->domainArr);
            $len2=count($domain2->domainArr);
            $len=min($len1,$len2);
            for($i=0;$i<$len;$i++){
                $result=strcmp($domain1->domainArr[$i],$domain2->domainArr[$i]);
                if($result>0) return 1;
                if($result<0) return -1;
            }
            if($len1>$len2) return 1;
            if($len1<$len2) return -1;
            return 0;
        };
    }
    public function show(){
        echo implode('.',$this->domainArr)."\n";
    }
}
// $d=new Domain('a.fw.w4.gs.s.f.es.f.e.fs.google.com');
// $d->show();
