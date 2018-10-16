<?php
$low = 1;
$high = 100;
$result = 3;
function judge($number)
{
    global $result;
    static $distance = -1;
    switch(true){
    case $number == $result:
        return 'success';
    case abs($number - $result) > $distance:
        $distance=abs($number - $result);
        return 'further';
    default:
        $distance=abs($number - $result);
        return 'closer';
    }
}
