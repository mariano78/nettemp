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

//$db->exec("UPDATE shop SET value='$syncstatus' WHERE option='syncstatus'");

// 1. Pobieramy z bazy oracle dane o produkcie 
// 2. Sprawdzamy czy w shoperze istnieje produkt z kodem z oracle - dodajemy lub aktualizujemy 
//$time_pre = microtime(true);
//$stid = oci_parse($conn, 'SELECT * FROM INFOR_SHOPER_EXP');
//oci_execute($stid);

		$cat = 999;
	    $deliv1 = 999;
		$deliv2 = 999;
		$deliv3 = 999;
		
		$stid = oci_parse($conn, 'SELECT * FROM INFOR_SHOPER_EXP_3');
		//oci_bind_by_name($stid, ":eean", $ean_csv);
		oci_execute($stid);
		
		while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
			
			$id_tow = $row['TO_ID']; //kod towaru w RB
			echo "Towar ID - ".$id_tow."\n";
			
			$stid2 = oci_parse($conn, '
			MERGE INTO SHOPPER_PRODUCTS USING dual ON ( "ID_TOW" = :idtow2 )
			WHEN NOT MATCHED THEN INSERT ("ID_TOW","SHOP_TO_DELIVERY", "SHOP_TO_DELIVERY_2", "SHOP_TO_DELIVERY_3", "SHOP_TO_CATEGORY", "SHOP_TO_CATEGORY_2", "SHOP_TO_SPZ", "IS_DELETED") 
				VALUES ( :idtow2, :deliv1, :deliv2, :deliv3 , :cat, :cat2 :spz :isd)'
				
				);
			$cat = 999;
			$is_deleted = 'N';
			$spz = 'N';
			oci_bind_by_name($stid2, ":idtow2", $id_tow);
			oci_bind_by_name($stid2, ":deliv1", $deliv1);
			oci_bind_by_name($stid2, ":deliv2", $deliv2);
			oci_bind_by_name($stid2, ":deliv3", $deliv3);
			oci_bind_by_name($stid2, ":cat", $cat);
			oci_bind_by_name($stid2, ":cat2", $cat);
			oci_bind_by_name($stid2, ":isd", $is_deleted);
			oci_bind_by_name($stid2, ":spz", $spz);
			oci_execute($stid2);
				
			
		}

		oci_free_statement($stid);
		oci_free_statement($stid2);
		oci_close($conn);
     
		


?>



