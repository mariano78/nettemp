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
	   $description_csv = mb_convert_encoding($description_csv, "ASCII");
	   echo $description_csv;
	   
		$stid = oci_parse($conn, 'SELECT ID FROM JFOX_TOWAR_KARTOTEKI WHERE TO_KK_1 LIKE :eean');
		oci_bind_by_name($stid, ":eean", $ean_csv);
		oci_execute($stid);
		
				while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
	 
					$id_tow = $row['ID']; //kod towaru w RB
					echo $id_tow;
					// etc.
					$sql = "UPDATE SHOPPER_PRODUCTS SET SHOP_TO_DESCRIPTION = :lob WHERE ID_TOW = '$id_tow' ";
					$stid2 = oci_parse($conn, $sql);	
					$lob_w = oci_new_descriptor($conn, OCI_D_LOB);
					
					oci_bind_by_name($stid2, ':lob',  $lob_w, -1, OCI_B_CLOB);
					$lob_w->WriteTemporary($description_csv);
					oci_execute($stid2, OCI_NO_AUTO_COMMIT);
		
					$lob_w->close();
					oci_commit($conn);
					
						
						//oci_free_descriptor($lob_w);
						oci_free_statement($stid2);
						
				
						echo " SQL: ".$sql;
	   
				}
			}
		}
        fclose($file);  
		//oci_free_statement($stid);
		//oci_close($conn);
     

?>



