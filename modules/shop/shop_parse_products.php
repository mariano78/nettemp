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

		
		$stid = oci_parse($conn, 'SELECT * FROM SHOPPER_PRODUCTS');
		//oci_bind_by_name($stid, ":eean", $ean_csv);
		oci_execute($stid);
		
		while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
			
			$id_tow = $row['ID_TOW']; //kod towaru w RB
			echo "Towar ID - ".$id_tow."\n";
			
			//JFOX_RB_TOWAR_KARTOTEKI.TO_STATUS_HANDL
			
			$stid2 = oci_parse($conn, "SELECT TO_STATUS_HANDL FROM JFOX_RB_TOWAR_KARTOTEKI WHERE ID_TOW = :idtow3");
			oci_bind_by_name($stid2, ":idtow3", $id_tow);
			oci_execute($stid2);
			
			while (($row2 = oci_fetch_array($stid2, OCI_ASSOC)) != false) {
				
				$id_tow_status = $row['TO_STATUS_HANDL']; //status towaru w jfox
				echo $id_tow_status;
				
				
			}
				
			
		}

		oci_free_statement($stid);
		oci_free_statement($stid2);
		oci_close($conn);
     
		


?>



