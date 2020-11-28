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

$mydb="
  (DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.18.240)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = XE)
    )
  )";
    
		$filename = "opisy2.csv";
        $file = fopen($filename, "r");
		if ($file) {
          while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
           {  
	   $tokod_csv = $getData[0];
	   $ean_csv = $getData[1];

	   $description_csv = $getData[2];
	   $description_csv = trim($description_csv);
	   
	   
		$stid = oci_parse($conn, 'SELECT ID FROM JFOX_TOWAR_KARTOTEKI WHERE TO_KK_1 LIKE :eean');
		oci_bind_by_name($stid, ":eean", $ean_csv);
		oci_execute($stid);
		
		
				while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
	 
					$id_tow = $row['ID']; //kod towaru w RB
					echo $id_tow;
					// etc.

						
						$sql = "UPDATE SHOPPER_PRODUCTS SET SHOP_TO_DESCRIPTION = EMPTY_CLOB() WHERE ID_TOW = '$id_tow' RETURNING SHOP_TO_DESCRIPTION INTO :lob";
						echo $sql."\n";
						
						$big_string = $description_csv;
					

						
							$pdo = new PDO("oci:dbname=".$mydb, "erp", "erp");
							$stmt = $pdo->prepare("UPDATE SHOPPER_PRODUCTS SET SHOP_TO_DESCRIPTION = EMPTY_CLOB() WHERE ID_TOW = '$id_tow' RETURNING SHOP_TO_DESCRIPTION INTO :lob");
							$stmt->bindParam(":lob", $big_string, PDO::PARAM_STR, strlen($big_string));
							$pdo->beginTransaction();
							if (!$stmt->execute()) {
								echo "ERROR: ".print_r($stmt->errorInfo())."\n";
								$pdo->rollBack();
								exit;
							}
							$pdo->commit();
	   
				}
			}
		}
        fclose($file);  
		//oci_free_statement($stid);
		//oci_close($conn);
     

?>



