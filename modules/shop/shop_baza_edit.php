<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: '#mytextarea',
		language: 'pl'
      });
    </script>

<?php

$desc_id_tow=isset($_GET['code']) ? $_GET['code'] : '';

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

$sql = "SELECT 
JFOX_TOWAR_KARTOTEKI.ID TO_ID,
JFOX_TOWAR_KARTOTEKI.TO_KOD TO_KOD,
JFOX_STAN_A01.MAGAZYN MAGAZYN,
JFOX_RB_TOWAR_KARTOTEKI.TO_STATUS_HANDL STATUS,
JFOX_TOWAR_KARTOTEKI.TO_KK_1 TO_KK_1,
JFOX_TOWAR_KARTOTEKI.TO_SKROT TO_SKROT,
JFOX_TOWAR_KARTOTEKI.TO_JM TO_JM,
JFOX_TOWAR_KARTOTEKI.TO_JM3 TO_JM_ZBIORCZA,
JFOX_TOWAR_KARTOTEKI.TO_OPA3 TO_OPA3,
JFOX_TOWAR_KARTOTEKI.TO_SZEROKOSC TO_SZEROKOSC,
JFOX_TOWAR_KARTOTEKI.TO_DLUGOSC TO_DLUGOSC,
JFOX_TOWAR_KARTOTEKI.TO_GRUPA TO_GRUPA,
JFOX_TOWAR_KARTOTEKI.TO_NAZWA TO_NAZWA,
JFOX_TOWAR_KARTOTEKI.TO_MASA TO_MASA, 
JFOX_RB_TOWAR_KARTOTEKI.TO_STRUKTURA TO_STRUKTURA,
JFOX_RB_TOWAR_KARTOTEKI.TO_RB_KOLOR,
JFOX_CENNIK.CEN_F01 CEN_F01,
JFOX_TOWAR_KARTOTEKI.TO_VAT_CODE TO_VAT_CODE,
JFOX_STAN_A01.ST_MAG_IL ST_MAG_IL,
JFOX_STAN_A01.ST_ZAMOW ST_ZAMOW,
JFOX_STAN_A01.ST_MAG_IL - JFOX_STAN_A01.ST_ZAMOW AS STAN,
JFOX_RB_TOWAR_KARTOTEKI.TO_LADNA_NAZWA TO_LADNA_NAZWA,
SHOPPER_PRODUCTS.ID_TOW ID_TOW_F_S_PROD,
SHOPPER_PRODUCTS.IN_SHOP IN_SHOP,
SHOPPER_PRODUCTS.SHOP_TO_CATEGORY CATEGORY,
SHOPPER_PRODUCTS.SHOP_TO_CATEGORY_2 CATEGORY2,
SHOPPER_PRODUCTS.SHOP_TO_DELIVERY DELIVERY,
SHOPPER_PRODUCTS.SHOP_TO_DELIVERY_2 DELIVERY2,
SHOPPER_PRODUCTS.SHOP_TO_DELIVERY_3 DELIVERY3,
SHOPPER_PRODUCTS.SHOP_TO_NAME SHOP_NAME,
SHOPPER_PRODUCTS.SHOP_TO_SPZ SHOP_SPZ,
SHOPPER_PRODUCTS.SHOP_TO_LINKED SHOP_LINKED,
SHOPPER_PRODUCTS.SHOP_TO_DESCRIPTION SHOP_OPIS
FROM JFOX_TOWAR_KARTOTEKI 
INNER JOIN JFOX_RB_TOWAR_KARTOTEKI ON JFOX_TOWAR_KARTOTEKI.ID = JFOX_RB_TOWAR_KARTOTEKI.ID_TOW 
INNER JOIN JFOX_CENNIK ON JFOX_TOWAR_KARTOTEKI.ID = JFOX_CENNIK.TOW_ID 
INNER JOIN JFOX_STAN_A01 ON JFOX_STAN_A01.TOW_ID = JFOX_TOWAR_KARTOTEKI.ID
INNER JOIN SHOPPER_PRODUCTS ON JFOX_TOWAR_KARTOTEKI.ID = SHOPPER_PRODUCTS.ID_TOW
WHERE JFOX_TOWAR_KARTOTEKI.IS_DELETED LIKE 'N'
AND JFOX_RB_TOWAR_KARTOTEKI.IS_DELETED LIKE 'N' 
AND JFOX_CENNIK.IS_DELETED LIKE 'N' 
AND JFOX_STAN_A01.MAGAZYN LIKE 'M-GLOWNY'
AND SHOPPER_PRODUCTS.ID_TOW LIKE '".$desc_id_tow."'";

$stid = oci_parse($conn, "$sql");
		oci_execute($stid);
			
		while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
			
			$id_tow = $row['TO_ID']; //kod towaru w RB
			$rb_stat = $row['STATUS']; //kod towaru w RB
			$rb_tow_kod = $row['TO_KOD'];
			$rb_tow_nazwa = $row['TO_NAZWA'];
			$grupa_tow = $row['TO_GRUPA'];
			$in_shop = $row['IN_SHOP'];
			$shop_cat = $row['CATEGORY'];
			$shop_cat2 = $row['CATEGORY2'];
			$shop_delivery = $row['DELIVERY'];
			$shop_delivery3 = $row['DELIVERY3'];
			$shop_delivery_typ = $row['DELIVERY2'];
			$shop_pow = $row['SHOP_LINKED'];
			$shop_name = $row['SHOP_NAME'];
			$shop_spz = $row['SHOP_SPZ'];
			$shop_linked = $row['SHOP_LINKED'];
			$to_opis = $row['SHOP_OPIS']; // opis towaru
			$rb_stan = $row['STAN'];
			$linkwww = '';
			
			if ($to_opis == ''){
				$to_opis = '';
			} else {
				$to_opis = $row['SHOP_OPIS']->load(); // opis towaru
			}
		}
		
?>

<div class="panel panel-default">
<div class="panel-heading">
<h1>Edycja opisu towaru dla: </h1>
    <form method="post">
      <textarea id="mytextarea"><?php echo $to_opis; ?></textarea>
    </form>
		
</div>
</div>