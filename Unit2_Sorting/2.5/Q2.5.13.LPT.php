<?php
//php Q2.5.13.LPT.php < Q2.5.13.input.txt
require("PQ.php");
$taskPQ=new MinPQ(function(array $task1,array $task2){
    return $task1['time']<$task2['time'];
});
$cpuPQ=new MinPQ(function(array $cpu1,array $cpu2){
    return $cpu1['taskTime']<$cpu2['taskTime'];
});
$in=fscanf(STDIN,"%d");
$cpuNums=$in[0];
for($i=0;$i<$cpuNums;$i++){
    $cpu=['number'=>$i,'taskTime'=>0,'totalTime'=>0];
    $cpuPQ->insert($cpu);
}
while($in=fscanf(STDIN,"%s%d")){
    $task=['name'=>$in[0],'time'=>$in[1]];
    $taskPQ->insert($task);
}
while(!$taskPQ->isEmpty()){
    $task=$taskPQ->deleteMin();
    $cpu=$cpuPQ->deleteMin();
    $cpu['taskTime']=$task['time'];
    $cpu['totalTime']+=$task['time'];
    echo 'cpu'.$cpu['number']."\t".$task['name']."\t".$task['time']."\n";
    $cpuPQ->insert($cpu);
}
$totalTime=0;
while(!$cpuPQ->isEmpty()){
    $cpu=$cpuPQ->deleteMin();
    if($cpu['totalTime']>$totalTime){
        $totalTime=$cpu['totalTime'];
    }
}
echo 'total time : '.$totalTime."\n";//total time : 3853