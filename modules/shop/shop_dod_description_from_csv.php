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


    
		$filename = "opisy1.csv";
        $file = fopen($filename, "r");
		if ($file) {
          while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
           {  
	   $tokod_csv = $getData[0];
	   $ean_csv = $getData[1];
	   $description_csv = $getData[2];
	   echo $description_csv;
	   
	 
	   
		$stid = oci_parse($conn, 'SELECT ID FROM JFOX_TOWAR_KARTOTEKI WHERE TO_KK_1 LIKE :eean');
		oci_bind_by_name($stid, ":eean", $ean_csv);
		oci_execute($stid);
		
		
		
				while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
					
					$id_tow = $row['ID']; //kod towaru w RB
					echo $id_tow;
					// etc.

						
						$sql = "UPDATE SHOPPER_PRODUCTS SET SHOP_TO_DESCRIPTION = EMPTY_CLOB() WHERE ID_TOW = '$id_tow' RETURNING SHOP_TO_DESCRIPTION INTO :lob";
						//echo $sql."\n";
						
						$stmt = OCIParse($conn, $sql);
						$clob = OCI_New_Descriptor($conn, OCI_D_LOB);
						OCI_Bind_By_Name($stmt, ':lob', $clob, -1, OCI_B_CLOB);
						OCIExecute($stmt,OCI_DEFAULT);
						$clob->writetemporary("coś")){
						oci_execute($stmt);							}
						$clob->close();
						//OCIFreeStatement($stmt);
						


// etc.

					
					
					
					
					
					
				}
		
        }
      
        fclose($file);  
		oci_free_statement($stid);
		oci_close($conn);
     
		}


?>



