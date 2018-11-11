<?php
//php Q2.5.15.php < domains.txt

//sort the reverse domain firstly
require("Q2.5.14.Domain.php");
require("common.php");
$domains=[];
while($in=fscanf(STDIN,"%s")){
    $domains[]=new Domain($in[0]);
}
foreach($domains as $domain){
    $domain->show();
}
usort($domains,Domain::compare());
echo "=================\n";
foreach($domains as $domain){
    $domain->show();
}