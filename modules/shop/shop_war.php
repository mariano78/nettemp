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
include("$root/modules/shop/shop_settings2.php");

$count = '';
$dodanych = 0;
$aktualizowanych = 0;
$pominietych = 0;
$akcja = 5;
$syncstatus = 0;
$licz_produkt = 1;


try{
    
    $resource = new DreamCommerce\ShopAppstoreLib\Resource\OptionValue($client);
    $result = $resource->get();

    foreach($result as $r) {
        printf("#%d (option: %d) - products num: %d\n", $r->ovalue_id, $r->option_id, $r->total_products);
    }
} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}



?>