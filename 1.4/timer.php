<?php
class Timer{
    private $time=0;
    public function start(){
        echo 'timer start',"\n";
        $this->time=-microtime(true);
    }
    public function stop(){
        $this->time+=microtime(true);
        echo 'timer stop in ',$this->time,"s\n";
    }
}