<?php
//php Q2.5.12.STP.php < Q2.5.12.input.txt
require("PQ.php");
$pq=new MinPQ(function(array $arr1,array $arr2){
    return $arr1['time']<$arr2['time'];
});
while($in=fscanf(STDIN,"%s%d")){
    $task=['name'=>$in[0],'time'=>$in[1]];
    $pq->insert($task);    
}
echo "name\ttime\n";
while(!$pq->isEmpty()){
    $t=$pq->deleteMin();
    echo $t['name']."\t".$t['time']."\n";
}
