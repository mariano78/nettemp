<script src="https://cdn.tiny.cloud/1/pvjworei9jxokictreph27mi58kixrsqwu4e4zfchizpwfi3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: '#mytextarea',
		language: 'pl',
		plugins: 'autoresize',
		toolbar_mode: 'floating'
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

//Zapis opisu do bazy oracle
$save_desc_id = isset($_POST['save_desc']) ? $_POST['save_desc'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';

if (!empty($save_desc_id)){
	
	$sql = "UPDATE SHOPPER_PRODUCTS SET SHOP_TO_DESCRIPTION = :lob WHERE ID_TOW = '$save_desc_id' ";
	$stid2 = oci_parse($conn, $sql);	
	$lob_w = oci_new_descriptor($conn, OCI_D_LOB);
					
	oci_bind_by_name($stid2, ':lob',  $lob_w, -1, OCI_B_CLOB);
	$lob_w->WriteTemporary($description);
	oci_execute($stid2, OCI_NO_AUTO_COMMIT);
	$lob_w->close();
	oci_commit($conn);
	oci_free_statement($stid2);	
	header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

//synchronizacja produktu
$sync_prod_code = isset($_POST['sync_prod_code']) ? $_POST['sync_prod_code'] : '';

if (!empty($sync_prod_code)){
	shell_exec("php -f $root/modules/shop/shop_prod.php c=$sync_prod_code");
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

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
			
			if ($shop_name == ''){
				
				$linkwww = 'https://www.robelit.pl/'.pl_charset($rb_tow_nazwa).'-'.$rb_tow_kod.'.html';	
			} else {
				$linkwww = 'https://www.robelit.pl/'.pl_charset($shop_name).'-'.$rb_tow_kod.'.html';	
				
			}
		}
		
?>

<div class="panel panel-default">
<div class="panel-heading" style="color:black;text-align:center;font-weight: bold;">
Edytowany towar: <?php echo "$rb_tow_kod"." - "."$shop_name"?>

    <form method="post" style="display:inline!important;">
		<textarea name="description" id="mytextarea"><?php echo $to_opis; ?></textarea>
		<button class="btn btn-xs btn-danger" style="margin: 20px;">Zapisz</button>
		<input type="hidden" name="save_desc" value="<?php echo $id_tow; ?>" />
    </form>
					
	<form action="" method="post" style="display:inline!important;">				
		<button class="btn btn-xs btn-success" style="margin: 20px;">Wyślij na WWW </button>
		<input type="hidden" name="sync_prod_code" value="<?php echo $rb_tow_kod; ?>" />
	</form>
					
	<a target="_blank" class="btn btn-xs btn-success" style="margin: 20px;" href="<?php echo $linkwww ?>">Podgląd w shoper</a>
	
		
</div>
</div>
<script>
document.getElementsByClassName('tox-notifications-container')[0].style.visibility = 'hidden';
</script>