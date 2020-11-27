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
	   
	 
	   
		$stid = oci_parse($conn, 'SELECT ID FROM JFOX_TOWAR_KARTOTEKI WHERE TO_KK_1 LIKE :eean');
		oci_bind_by_name($stid, ":eean", $ean_csv);
		oci_execute($stid);
		
		
				while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
					

					// etc.

						$sql = "SELECT
								   SHOP_TO_DESCRIPTION
								FROM
								   SHOPPER_PRODUCTS
								WHERE
								   ID_TOW = $tokod_csv
								FOR UPDATE /* locks the row */
						";

						$stmt = oci_parse($conn, $sql);

						// Execute the statement using OCI_DEFAULT (begin a transaction)
						oci_execute($stmt, OCI_DEFAULT) 
							or die ("Unable to execute query\n");

						// Fetch the SELECTed row
						if ( FALSE === ($row = oci_fetch_assoc($stmt) ) ) {
							oci_rollback($conn);
							die ("Unable to fetch row\n");
						}

						// Discard the existing LOB contents
						if ( !$row['MYLOB']->truncate() ) {
							oci_rollback($conn);
							die ("Failed to truncate LOB\n");
						}

						// Now save a value to the LOB
						if ( !$row['MYLOB']->save('UPDATE: '.date('H:i:s',time()) ) ) {
							
							// On error, rollback the transaction
							oci_rollback($conn);
							
						} else {

							// On success, commit the transaction
							oci_commit($conn);
							
						}

						// Free resources
						oci_free_statement($stmt);
						$row['MYLOB']->free();


// etc.

					
					
					
					
					
					
				}
		
        }
      
        fclose($file);  
		oci_free_statement($stid);
		oci_close($conn);
     
		}


?>



