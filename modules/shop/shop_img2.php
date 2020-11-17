<?php

if(!empty($_SERVER["DOCUMENT_ROOT"])){
    $root=$_SERVER["DOCUMENT_ROOT"];
}else{
    $root=__DIR__;
    for($i=0;$i<5;$i++){
        $root = file_exists($root.'/dbf/nettemp.db') ? $root : dirname($root) ;
    }
}
// Dołączam ustawienia Oracle i sdk shoper
include("$root/modules/shop/shop_settings.php");

$url = 'http://robelit.pl/wp-content/upload/5905725026302/';
$no_html = strip_tags(file_get_contents($url));
$arr = explode('Parent Directory', $no_html);
$files = trim($arr[1]);
$files = explode("\n ", $files);
var_dump($files);

?>