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
	   $description_csv = trim($description_csv);
	 
	   $id_tow = $row['ID']; //kod towaru w RB
					echo $id_tow;
					// etc.

						
						$sql = "UPDATE SHOPPER_PRODUCTS SET SHOP_TO_DESCRIPTION = EMPTY_CLOB() WHERE ID_TOW = '$id_tow' RETURNING SHOP_TO_DESCRIPTION INTO :lob";
						echo $sql."\n";
						
						$stmt = OCI_Parse($conn, $sql);
						$clob = OCI_New_Descriptor($conn, OCI_D_LOB);
						OCI_Bind_By_Name($stmt, ':lob', $clob, -1, OCI_B_CLOB);
						OCI_Execute($stmt,OCI_DEFAULT);
						$clob->save($description_csv);
						
						
						
						OCIFreeStatement($stmt);
	   
	   
	   
	   
	   
	   
	   
			}
		}
      
        fclose($file);  
		//oci_free_statement($stid);
		//oci_close($conn);
     

?>



