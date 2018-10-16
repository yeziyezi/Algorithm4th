<?php
require("Node.php");
require("Queue.php");
$k=$argv[1];
$queue=new Queue();
$str=fgets(STDIN);
$str=explode(' ',$str);
foreach($str as $sub){
    $queue->in(new Node($sub));
}
$size=$queue->size();
$times=$size-$k-2;
for($i=0;$i<$times;++$i){
    $queue->out();
}
var_dump($queue->out()->data);
