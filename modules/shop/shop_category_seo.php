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

try {
   
    $resource = new DreamCommerce\ShopAppstoreLib\Resource\Category($client);
	$currentPage = 1;
    $result = $resource->get();
	$pages = $result->pages;

	while($currentPage <= $result->getPageCount() ){
		
		$result = $resource->page($currentPage)->limit(50)->get();
		
				$count = $result->count;
				echo "count_".$count."\n";
				
				if ($count != '0') {
				
					foreach($result as $r){
						
						echo $r->category_id."-".$r->translations->pl_PL->name." <br>";
						$idc = $r->category_id;
						$nazwa = $r->translations->pl_PL->name;
						$seo_name = pl_charset($nazwa).'.html';		
						
						$resource2 = new DreamCommerce\ShopAppstoreLib\Resource\Category($client);

							$result2 = $resource2->put($idc, array(
								'translations' => array(
									'pl_PL' => array(
										'seo_url' => $seo_name.$idc
									)
								)
							));

							if($result2){
								echo 'Category updated';
							}
					}

				$currentPage++;
				}

	}

    
} catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
    die($ex->getMessage());
}