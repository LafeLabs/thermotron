<?php

$dnaurl = "https://raw.githubusercontent.com/LafeLabs/switchotron/main/data/dna.txt";

if(isset($_GET["dna"])){
    $dnaurl = $_GET["dna"];
}

$baseurl = explode("data/",$dnaurl)[0];
$dnaraw = file_get_contents($dnaurl);
$dna = json_decode($dnaraw);

mkdir("data");
mkdir("php");

copy("https://raw.githubusercontent.com/LafeLabs/switchotron/main/php/replicator.txt","replicator.php");


foreach($dna->html as $value){
    
    copy($baseurl.$value,$value);

}


foreach($dna->data as $value){
    
    copy($baseurl."data/".$value,"data/".$value);
    
}



foreach($dna->php as $value){
 
    copy($baseurl."php/".$value,"php/".$value);
    copy($baseurl."php/".$value,explode(".",$value)[0].".php");

}
    
foreach($dna->scrolls as $value){
    
    copy($baseurl."scrolls/".$value,"scrolls/".$value);

}
    
    
?>
<a href = "index.html">CLICK TO GO TO NEW PAGE</a>
<style>
body{
    background-color:#9f8767;
    font-family:Comic Sans MS;
    font-size:3em;
}

a{
    font-size:3em;
}
</style>
