<?php
//excute this script and redirect the output stream to a txt file like this:
//php Q2.5.12.inputGenerator.php > Q2.5.12.input.txt
for($i=0;$i<100;$i++){
    echo 'task'.$i.' '.random_int(1,500)."\n";
}
