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

$count = '';
$dodanych = 0;
$aktualizowanych = 0;
$pominietych = 0;
$akcja = 5;
$syncstatus = 0;
$licz_produkt = 1;

try{
    

    $resource = new DreamCommerce\ShopAppstoreLib\Resource\ProductStock($client);
    $result = $resource->get();
	var_dump($result);

    foreach($result as $r){
        printf("#%d - %.2f (product #%d)\n", $r->stock_id, $r->price, $r->product_id);
		
		$resource2 = new DreamCommerce\ShopAppstoreLib\Resource\ProductStock($client);
		$idd = $r->stock_id;
		echo $idd;
		$result2 = $resource2->delete($idd);

    if($result2){
        echo 'Product stock deleted';
    }
    }
} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}
 

?>