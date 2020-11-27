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
					

					// connect to DB etc...

					$sql = "INSERT INTO
							SHOPPER_PRODUCTS
							  (
								SHOP_TO_DESCRIPTION
							  )
						   VALUES
							  (
								--Initialize as an empty CLOB
								EMPTY_CLOB()
							  )
						   RETURNING
							  --Return the LOB locator
							  mylob INTO :mylob_loc";

					$stid2 = oci_parse($conn, $sql);

					// Creates an "empty" OCI-Lob object to bind to the locator
					$myLOB = oci_new_descriptor($conn, OCI_D_LOB);

					// Bind the returned Oracle LOB locator to the PHP LOB object
					oci_bind_by_name($stid2, ":mylob_loc", $myLOB, -1, OCI_B_CLOB);

					// Execute the statement using , OCI_DEFAULT - as a transaction
					oci_execute($stid2, OCI_DEFAULT)
						or die ("Unable to execute query\n");
						
					// Now save a value to the LOB
					if ( !$myLOB->save('INSERT: '.date('H:i:s',time())) ) {
						
						// On error, rollback the transaction
						oci_rollback($conn);
						
					} else {

						// On success, commit the transaction
						oci_commit($conn);
						
					}

					// Free resources
					oci_free_statement($stid2);
					$myLOB->free();

					
					
					
					
					
					
				}
		
        }
      
        fclose($file);  
		oci_free_statement($stid);
		oci_close($conn);
     
		}


?>



