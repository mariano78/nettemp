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

try{
    

    $resource = new DreamCommerce\ShopAppstoreLib\Resource\Category($client);

    $result = $resource->put(119, array(
        'translations' => array(
            'pl_PL' => array(
                'name' => 'category name'
            )
        )
    ));

    if($result){
        echo 'Category updated';
    }
} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}