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
$currentPage =1;

	$categoriesResource = new DreamCommerce\ShopAppstoreLib\Resource\Category($client);
    $categoriesResult = $categoriesResource->page($currentPage)->limit(50)->get();
	//$result = $resource->page($currentPage)->limit(50)->get();

    $categories = array();
    foreach($categoriesResult as $c){
        $categories[$c->category_id] = $c->translations->pl_PL->name;
    }

    $resource = new DreamCommerce\ShopAppstoreLib\Resource\CategoriesTree($client);
    $result = $resource->page($currentPage)->limit(50)->get();

    $renderNode = function($start, $level = 1) use (&$renderNode, $categories){

        foreach($start as $i) {
            printf("%s #%d - %s\n <br>", str_repeat('-', $level), $i->id, $categories[$i->id]);
            if (!empty($i->__children)) {
                $renderNode($i->__children, $level + 1);
            }
        }

    };

    $renderNode($result);

?>
