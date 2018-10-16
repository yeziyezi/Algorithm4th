<?php
require("Node.php");
require("Queue.php");
$queue=new Queue;
$total=0;//总人数
$died=0;//第几个人死
echo '对给定人数进行编号，从第一个人开始报数，报到死亡数字者淘汰，下一轮从被淘汰者的下一位开始报数,以此类推',"\n";
echo '总人数:';
fscanf(STDIN,"%d",$total);
echo '死亡数字:';
fscanf(STDIN,"%d",$died);
echo '淘汰顺序:',"\n";
for($i=1;$i<=$total;$i++){
    $queue->in(new Node($i));
}
while(!$queue->isEmpty()){
    for($i=1;$i<=$died;$i++){
        $node=$queue->out();
        if($i==$died)
            break;
        $queue->in($node);
    }
    echo $node->data,'->';
}
echo "\n";