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


						
						function updateClob($id_tow,$description_csv,$conn) {
						$sql = "UPDATE SHOPPER_PRODUCTS SET SHOP_TO_DESCRIPTION = EMPTY_CLOB() WHERE ID_TOW = '$id_tow' RETURNING SHOP_TO_DESCRIPTION INTO :lob";
						echo $sql."\n";
						//echo $sql."\n";
						$clob = OCINewDescriptor($conn, OCI_D_LOB);
						$stmt = OCIParse($conn, $sql);
						OCIBindByName($stmt, ':lob', &$clob, -1, OCI_B_CLOB);
						OCIExecute($stmt,OCI_DEFAULT);
						if($clob->save($description_csv)){
							OCICommit($conn);
							echo " Updated"."\n";
						}else{
							echo " Problems: Couldn't upload Clob.  This usually means the where condition had no match \n";
						}
						$clob->free();
						OCIFreeStatement($stmt);
						}

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

						
						
						
						updateClob($id_tow,$description_csv,$conn);
	   
				}
			}
		}
        fclose($file);  
		//oci_free_statement($stid);
		//oci_close($conn);
     

?>



