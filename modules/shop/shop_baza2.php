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

$cat_id = '';
try {
   
    $categoriesResource = new DreamCommerce\ShopAppstoreLib\Resource\Category($client);
	$currentPage = 1;
    $categoriesResult = $categoriesResource->get();
	$pages = $categoriesResult->pages;
	
	while($currentPage <= $categoriesResult->getPageCount() ){
		
		$categoriesResult = $categoriesResource->page($currentPage)->limit(50)->get();
		
			$categories = array();
			
			foreach($categoriesResult as $c){
			$cat_id = $c->category_id;
				
			$categories[$c->category_id] = $c->translations->pl_PL->name;
			
			}
			$currentPage++;	
	}
			
			//var_dump($categories);
			
			$resource = new DreamCommerce\ShopAppstoreLib\Resource\CategoriesTree($client);
			
			$id = $cat_id;
			$result = $resource->get($id);
			
			$renderNode = function($start, $level = 1) use (&$renderNode, $categories){

			foreach($start as $i) {
				printf("%s #%d - %s\n", str_repeat('-', $level), $i->id, $categories[$i->id]);
				if (!empty($i->__children)) {
					$renderNode($i->__children, $level + 1);
				}
			}

			};

$renderNode($result);		
	
   
} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}