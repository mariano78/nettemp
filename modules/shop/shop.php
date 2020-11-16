<?php

if(!empty($_SERVER["DOCUMENT_ROOT"])){
    $root=$_SERVER["DOCUMENT_ROOT"];
}else{
    $root=__DIR__;
    for($i=0;$i<5;$i++){
        $root = file_exists($root.'/dbf/nettemp.db') ? $root : dirname($root) ;
    }
}

include("$root/modules/shop/shop_settings.php");

$stid = oci_parse($conn, 'SELECT * FROM JFOX_MAGAZ');
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

 
  try{
      $client = \DreamCommerce\ShopAppstoreLib\Client::factory(
         \DreamCommerce\ShopAppstoreLib\Client::ADAPTER_BASIC_AUTH,
         array(
             'entrypoint'=> $shoptest,
             'username'=> $shopusr,
             'password'=> $shoppass
         )
      );
 
$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
    $result = $resource->get();

    foreach($result as $r){
        printf("#%d - %s\n", $r->product_id, $r->translations->pl_PL->name);
    }

  }catch(DreamCommerce\ShopAppstoreLib\Exception\Exception $ex) {
      die($ex->getMessage());
  }

?>