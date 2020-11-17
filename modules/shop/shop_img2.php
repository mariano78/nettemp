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

$context = stream_context_create(
        array(
            "http" => array(
                'method'=>"GET",
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) 
                            AppleWebKit/537.36 (KHTML, like Gecko) 
                            Chrome/50.0.2661.102 Safari/537.36\r\n" .
                            "accept: text/html,application/xhtml+xml,application/xml;q=0.9,
                            image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3\r\n" .
                            "accept-language: es-ES,es;q=0.9,en;q=0.8,it;q=0.7\r\n" . 
                            "accept-encoding: gzip, deflate, br\r\n"
            )
        )
    );

echo file_get_contents("http://www.robelit.pl/5905725026302", false, $context);





?>