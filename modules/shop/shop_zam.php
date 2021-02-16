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

			$resource = newDreamCommerce\ShopAppstoreLib\Resource\Order($client);
    $result = $resource->get();

    foreach($result as $r){
        printf("#%d - %.2f (@%s)\n", $r->order_id, $r->sum, $r->date);
    }
 

?>