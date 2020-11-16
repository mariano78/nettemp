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

// 1. Pobieramy z bazy oracle dane o produkcie 
// 2. Sprawdzamy czy w shoperze istnieje pordukt - dodajemy lub aktualizujemy 

$stid = oci_parse($conn, 'SELECT * FROM INFOR_SHOPER_EXP');
oci_define_by_name($stid, 'NUMBER_OF_ROWS', $number_of_rows);
oci_execute($stid);
echo $number_of_rows. " rows selected.<br />\n";
//echo oci_num_rows($stid) 

echo "<table border='1'>\n";
//while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
//while (false !== ($item = oci_fetch_assoc($stid)) {
	
	while (oci_fetch($stid)) {
    echo oci_result($stid, 'TO_KOD') . " is ";
    echo oci_result($stid, 'MAGAZYN') . "<br>\n";
}
	
	
   // echo "<tr>\n";
   // foreach ($row as $item) {
   //     echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
	//	echo $item['TO_KOD'];
	//	echo $item['MAGAZYN'];
   // }
  //  echo "</tr>\n";
//}
//echo "</table>\n";

 
  
 
$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
    $result = $resource->get();

    foreach($result as $r){
        printf("#%d - %s\n", $r->product_id, $r->translations->pl_PL->name);
    }

 

?>