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
$stid = oci_parse($conn, 'SELECT * FROM INFOR_SHOPER_EXP');
oci_execute($stid);



while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
	
	
	$towar_id = $row['TO_ID']; //kod towaru w RB
	$ean = $row['TO_KK_1']; // kod ean
	$nazwa = $row['TO_NAZWA']; //nazwa z jfox
	$kategoria = 1; // kategoria w shoper
	$stan = floor($row['STAN']); // dostępna ilosć towaru
	
	//$connection=oci_connect($username,$password,$database);

     $sql="INSERT  INTO shopper_products (ID_TOW, IN_SHOP, SHOP_TO_CATEGORY, SHOP_TO_DELIVERY, SHOP_TO_NAME, SHOP_TO_DESCRIPTION)
			VALUES ('"$towar_id"','',1,1,'NAZWA','OPIS')";
			   

     $st= oci_parse($conn, $sql);
     oci_execute($st);
	
	
	
}//while

 

?>