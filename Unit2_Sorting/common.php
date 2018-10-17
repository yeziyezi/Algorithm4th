<?php
function dumpArr($arr){
    $output="[ ";
    foreach($arr as $num){
        $output.="$num ";
    }
    $output.="]";
    return $output."\n";
}
class Timer{
    private static $timeStart=0;
    public static function start(){
        self::$timeStart=microtime(true);
    }
    public static function echoTimer($message=""){//效果是在终端中显示一个动态变化的计时器
        $timeSpend=microtime(true)-self::$timeStart;
        echo " $message|time spend $timeSpend seconds\r";
    }
    public static function stop(){
        echo "\n";
    }
}