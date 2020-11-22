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

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$pstop=100;
$pstart = ($page-1) * $pstop; 


$licznik = 1;


$sql = "SELECT * FROM INFOR_SHOPER_EXP OFFSET ".$pstart." ROWS FETCH NEXT ".$pstop." ROWS ONLY;";


$stid = oci_parse($conn, "$sql");
		//oci_bind_by_name($stid, ":eean", $ean_csv);
		oci_execute($stid);
		
		while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
			
			$id_tow = $row['TO_ID']; //kod towaru w RB
			$rb_tow_kod = $row['TO_KOD'];
			$rb_tow_nazwa = $row['TO_NAZWA'];
			$grupa_tow = $row['TO_GRUPA'];
			$in_shop = $row['IN_SHOP'];
			$shop_cat = $row['CATEGORY'];
			$shop_delivery = $row['DELIVERY'];
			$shop_name = $row['SHOP_NAME'];
			
			
			echo $licznik." - ".$rb_tow_kod." - ".$rb_tow_nazwa." <br> \n";
			
				
		$licznik++;
		}

		   oci_free_statement($stid);
			oci_close($conn);




?>
