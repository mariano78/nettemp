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

	$resource = new DreamCommerce\ShopAppstoreLib\Resource\Order($client);
    $currentPage = 1;
	$currentProd = 1;;
	$result = $resource->get();
	$pages = $result->pages;
	
	$global_kwota_netto = 0;
	
	while($currentPage <= $result->getPageCount() ){
	  
		$result = $resource->page($currentPage)->limit(50)->get();
	
				//var_dump($result);
				$count = $result->count;
				echo "count_".$count."\n";
				
				foreach($result as $r){
					$id_zam = $r->order_id;
					$kwota_zam = $r->sum;
					$kwota_przesylki = $r->shipping_cost;
					
					$kwota_zam_brutto = $kwota_zam - $kwota_przesylki;
					echo $kwota_zam_brutto; 
					$kwota_netto = $kwota_zam_brutto/1.23;
					echo $kwota_netto;
					$global_kwota_netto += $kwota_netto;
					
					echo "\n Kwota netto (całościowo) - ".$global_kwota_netto."\n";
					
					$do_wyplaty = $global_kwota_netto * 1.06;
					
					echo "\n Kwota netto do wyplaty (całościowo) - ".$do_wyplaty."\n";
					
				
					
        //printf("#%d - %.2f (@%s)\n", $r->order_id, $r->sum, $r->shipping_cost);
    }
		
		$currentPage++;		
	}
	
	

    
 

?>


	