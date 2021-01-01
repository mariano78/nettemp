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
	$currentPage = 1;
	$currentProd = 1;;
	$result = $resource->get();
	//var_dump($result);
	
	$pages = $result->pages;
	
while($currentPage <= $result->getPageCount() ){
	  
	  $result = $resource->page($currentPage)->limit(50)->get();
	var_dump($result);

    foreach($result as $r){
        printf("#%d - %.2f (product #%d)\n", $r->stock_id, $r->price, $r->product_id);
		
		
    }
	$currentPage++;
}
} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}

try{
   
    $resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
    $id = 2177;
    $result = $resource->delete($id);

    if($result){
        echo 'Product stock deleted';
    }
} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}
 

?>