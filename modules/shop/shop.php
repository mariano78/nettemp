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

// 1. Pobieramy z bazy oracle dane o produkcie 
// 2. Sprawdzamy czy w shoperze istnieje produkt z kodem z oracle - dodajemy lub aktualizujemy 

$stid = oci_parse($conn, 'SELECT * FROM INFOR_SHOPER_EXP');
oci_execute($stid);



while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
	
	
	$kod = $row['TO_KOD'];
		
	$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
	//filtry
	
	//$resource->filters(['stock.code'=> ['LIKE'=> 1]]);
	
    $result = $resource->get();
	//var_dump($result);
	

    foreach($result as $r){
		$ile = $r->count;
		echo $ile.'wierszy';
        echo $r->product_id;
		echo $r->category_id;
		echo $r->translations->pl_PL->name;
		echo $r->stock.code;
		echo $r->stock->ean;
    }
	
    
}

oci_free_statement($stid);
oci_close($conn);
	

 
  

 

?>