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
			
			$stid2 = oci_parse($conn, 'SELECT * FROM JFOX_RB_TOWAR_KARTOTEKI WHERE ID_TOW = :idtow3 AND IS_DELETED = :isdel');
			oci_bind_by_name($stid2, ":idtow3", $id_tow);
			$isdel = 'N';
			oci_bind_by_name($stid2, ":isdel", $isdel);
			oci_execute($stid2);
			
			while (($row2 = oci_fetch_array($stid2, OCI_ASSOC)) != false) {
				
				$tow_status = $row2['TO_STATUS_HANDL']; //status towaru w jfox
				
				
				if($tow_status != 'spr' && $tow_status != 'spz' && $tow_status != 'wyp'){
					echo "TOW STAT-".$tow_status;
					echo "\nTOW ID-".$id_tow;
					
					//update shop_prod
					$stid3 = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET IS_DELETED = :is_del, IN_SHOP = :in_shop WHERE ID_TOW = :idtow4');
					$is_del = 'Y';
					$in_shop = 'N';
					oci_bind_by_name($stid3, ":idtow4", $id_tow);
					oci_bind_by_name($stid3, ":is_del", $is_del);
					oci_bind_by_name($stid3, ":in_shop", $in_shop);
					oci_execute($stid3, OCI_DEFAULT);
					oci_commit($conn);
					echo oci_error();
					echo "Ustawiam \n";
					
				}
				
				
			}
				
			
		}

		oci_free_statement($stid);
		oci_free_statement($stid2);
		oci_free_statement($stid3);
		oci_close($conn);
     
		


?>


