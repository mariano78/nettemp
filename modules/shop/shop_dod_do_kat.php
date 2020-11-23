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
$time_pre = microtime(true);
//$stid = oci_parse($conn, 'SELECT * FROM INFOR_SHOPER_EXP');
//oci_execute($stid);
	   
		$stid = oci_parse($conn, 'SELECT * FROM INFOR_SHOPER_EXP_2');
		//oci_bind_by_name($stid, ":eean", $ean_csv);
		oci_execute($stid);
		
		while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
			
			$id_tow = $row['TO_ID']; //kod towaru w RB
			$stat = $row['STATUS']; //kod towaru w RB
			$grupa_tow = $row['TO_GRUPA'];
			echo "Towar ID - ".$id_tow."\n";
			
			if ($grupa_tow == 'IZOLK' && $stat != 'wyp'){
				
				$katt = 49;
			
			
			
			
			
			$stid2 = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET "SHOP_TO_CATEGORY"= :catt WHERE ID_TOW = :idtow2');
			
			oci_bind_by_name($stid2, ":idtow2", $id_tow);
			oci_bind_by_name($stid2, ":catt", $katt);
			oci_execute($stid2);
			}
				
			
		}
		
           
      
         
		   oci_free_statement($stid);
			oci_close($conn);
     
		


?>



