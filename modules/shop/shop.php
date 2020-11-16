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
    $result = $resource->get();

    foreach($result as $r){
        printf("#%d - %s\n", $r->product_id, $r->translations->pl_PL->name, $r->stack.code);
    }
	
    
}

oci_free_statement($stid);
oci_close($conn);
	

 
  

 

?>