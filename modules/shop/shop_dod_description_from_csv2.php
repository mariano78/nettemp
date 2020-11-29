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

		$filename = "opisy2.csv";
        $file = fopen($filename, "r");
		if ($file) {
          while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
           {  
	   $tokod_csv = $getData[0];
	   $ean_csv = $getData[1];

	   $description_csv = $getData[2];
	   $description_csv = "My big tekst";
	   
		$stid = oci_parse($conn, 'SELECT ID FROM JFOX_TOWAR_KARTOTEKI WHERE TO_KK_1 LIKE :eean');
		oci_bind_by_name($stid, ":eean", $ean_csv);
		oci_execute($stid);
		
				while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
	 
					$id_tow = $row['ID']; //kod towaru w RB
					echo $id_tow;
					// etc.
					$sql = "UPDATE SHOPPER_PRODUCTS SET SHOP_TO_DESCRIPTION = EMPTY_CLOB() WHERE ID_TOW = '$id_tow' RETURNING SHOP_TO_DESCRIPTION INTO :lob";
						
					
					$lob_w = oci_new_descriptor($conn, OCI_D_LOB);


					$stid2 = oci_parse($connection, $sql);
					oci_bind_by_name($stid2, ':lob',  $lob_w, -1, OCI_B_CLOB);
						


						$success = oci_execute($stid2, OCI_DEFAULT);

						if (!$success) {
							oci_rollback($connection);
							$text_insertion_error = 0;
						} else if (oci_num_rows($stid2) === 1) {
							
							$lob_w->save($description_csv);
							oci_commit($conn);
							$text_insertion_error = 1;
						}

						
						oci_free_descriptor($lob_w);
						oci_free_statement($stid2);
						
						echo " Error: ".$text_insertion_error;
	   
				}
			}
		}
        fclose($file);  
		//oci_free_statement($stid);
		//oci_close($conn);
     

?>



