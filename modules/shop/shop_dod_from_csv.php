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


    
		$filename = "spz.csv";
        $file = fopen($filename, "r");
		if ($file) {
          while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
           {  
	   
	   $id_tow = $getData[0];
	   $czas_prze = $getData[1];
	   
	   
	  
			
			//$id_tow = $row['ID']; //kod towaru w RB
			echo "Towar ID - ".$id_tow."\n";
			
			$stid2 = oci_parse($conn, '
			MERGE INTO SHOPPER_PRODUCTS USING dual ON ( "ID_TOW" = :idtow2 )
			WHEN MATCHED THEN UPDATE SET "SHOP_TO_SPZ"= :devtime'
				
				);
		  
			oci_bind_by_name($stid2, ":idtow2", $id_tow);
			oci_bind_by_name($stid2, ":devtime", $czas_prze);
			//oci_bind_by_name($stid2, ":devtime", $czas_prze_id);
			//oci_bind_by_name($stid2, ":cat", $cat);
			oci_execute($stid2);
				
			
		
		
           }
      
           fclose($file);  
		   oci_free_statement($stid);
			oci_close($conn);
     
		}


?>



