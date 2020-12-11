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
    
    $resource = new DreamCommerce\ShopAppstoreLib\Resource\OptionGroup($client);
    $result = $resource->get();

    foreach($result as $r) {
        printf("%d - %s\n", $r->group_id, $r->translations->pl_PL->name);
    }
} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}

try{
    
    $resource = new DreamCommerce\ShopAppstoreLib\Resource\OptionValue($client);
    $result = $resource->get();

    foreach($result as $r) {
        printf("#%d (option: %d) - products num: %d\n", $r->ovalue_id, $r->option_id, $r->total_products);
    }
} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}

try{
   
    $resource = new DreamCommerce\ShopAppstoreLib\Resource\Option($client);
    $result = $resource->get();
	//var_dump($result);
    foreach($result as $r){
        printf("#%d - %s\n", $r->option_id, $r->translations->pl_PL->name);
    }
} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}

try{
   
    $resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
	$related = array(1,2,3,4);
    $data = array(
        'category_id' => 1,
		'related' => [2,3],
		'categories' => [1,2],
        'translations' => array(
            'pl_PL' => array(
                'name' => 'product name',
                'description' => 'product description',
                'active' => true
            )
        ),
        'stock' => array(
            'price' => 10,
            'active' => 1,
            'stock' => 10
        ),
        'tax_id' => 1,
        'code' => '1234567',
        'unit_id' => 1
    );
    $result = $resource->post($data);

    printf("An object has been added #%d", $result);
} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}


try{
   

    $resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
    $result = $resource->get();
	var_dump($result);

    foreach($result as $r){
        printf("#%d - %s\n", $r->product_id, $r->translations->pl_PL->name);
		//printf("#%d - %s\n", $r->product_id, $r->related);
		
    }
} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}


?>