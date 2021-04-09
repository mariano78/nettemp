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

//synchronizacja zdjec
$sync_pic_code = isset($_POST['sync_pic_code']) ? $_POST['sync_pic_code'] : '';

if (!empty($sync_pic_code)){
	shell_exec("php -f $root/modules/shop/shop_img.php c=$sync_pic_code");
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

//czy w sklepie
$inshop_id_tow = isset($_POST['inshop_id_tow']) ? $_POST['inshop_id_tow'] : '';
$inshopcheck = isset($_POST['inshopcheck']) ? $_POST['inshopcheck'] : '';
$inshop1 = isset($_POST['inshop1']) ? $_POST['inshop1'] : '';


if (!empty($inshop_id_tow) && ($inshop1 == "inshop1")){
  
	
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET IN_SHOP = :ins WHERE ID_TOW = :isidt');
	
	oci_bind_by_name($stid, ":isidt", $inshop_id_tow);
	oci_bind_by_name($stid, ':ins', $inshopcheck);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);	
	
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

//czy spz
$in_shop_spz_id = isset($_POST['in_shop_spz_id']) ? $_POST['in_shop_spz_id'] : '';
$in_shop_spz = isset($_POST['in_shop_spz']) ? $_POST['in_shop_spz'] : '';
$in_shop_spz1 = isset($_POST['in_shop_spz1']) ? $_POST['in_shop_spz1'] : '';


if (!empty($in_shop_spz_id) && ($in_shop_spz1 == "in_shop_spz1")){
  
	
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET SHOP_TO_SPZ = :ins WHERE ID_TOW = :isspz');
	
	oci_bind_by_name($stid, ":isspz", $in_shop_spz_id);
	oci_bind_by_name($stid, ':ins', $in_shop_spz);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);	
	
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
//filtr kod
$ffkod = isset($_POST['ffkod']) ? $_POST['ffkod'] : '';
$ffkodok = isset($_POST['ffkodok']) ? $_POST['ffkodok'] : '';

if (!empty($ffkodok)){
    
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
    $db->exec("UPDATE shop SET value = '$ffkod' WHERE option = 'fkod'") or die ($db->lastErrorMsg());
    header("location: index.php?id=tools&type=shop_baza");
    exit();
    }
//filtr status
$ffstat = isset($_POST['ffstat']) ? $_POST['ffstat'] : '';
$ffstatok = isset($_POST['ffstatok']) ? $_POST['ffstatok'] : '';

if (!empty($ffstatok)){
    
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
    $db->exec("UPDATE shop SET value = '$ffstat' WHERE option = 'fstat'") or die ($db->lastErrorMsg());
    header("location: index.php?id=tools&type=shop_baza");
    exit();
    }
//filtr grupa
$ffgrupa = isset($_POST['ffgrupa']) ? $_POST['ffgrupa'] : '';
$ffgrupaok = isset($_POST['ffgrupaok']) ? $_POST['ffgrupaok'] : '';

if (!empty($ffgrupaok)){
    
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
    $db->exec("UPDATE shop SET value = '$ffgrupa' WHERE option = 'fgrupa'") or die ($db->lastErrorMsg());
    header("location: index.php?id=tools&type=shop_baza");
    exit();
    }
//filtr sklep
$ffsklep = isset($_POST['ffsklep']) ? $_POST['ffsklep'] : '';
$ffsklepok = isset($_POST['ffsklepok']) ? $_POST['ffsklepok'] : '';
if (!empty($ffsklepok)){
    
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
    $db->exec("UPDATE shop SET value = '$ffsklep' WHERE option = 'fsklep'") or die ($db->lastErrorMsg());
    header("location: index.php?id=tools&type=shop_baza");
    exit();
    }
//filtr spz
$ffspz = isset($_POST['ffspz']) ? $_POST['ffspz'] : '';
$ffspzok = isset($_POST['ffspz']) ? $_POST['ffspz'] : '';
if (!empty($ffspzok)){
    
	$db = new PDO("sqlite:$root/dbf/nettemp.db");
    $db->exec("UPDATE shop SET value = '$ffspz' WHERE option = 'fspz'") or die ($db->lastErrorMsg());
    header("location: index.php?id=tools&type=shop_baza");
    exit();
    }
	
//nazwa
$name_new = isset($_POST['name_new']) ? $_POST['name_new'] : '';
$name_id = isset($_POST['name_id']) ? $_POST['name_id'] : '';

if (!empty($name_id)){
    
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET SHOP_TO_NAME = :ins WHERE ID_TOW = :isidt');
	oci_bind_by_name($stid, ":isidt", $name_id);
	oci_bind_by_name($stid, ":ins", $name_new);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
//powiazane
$pow_new = isset($_POST['pow_new']) ? $_POST['pow_new'] : '';
$pow_id = isset($_POST['pow_id']) ? $_POST['pow_id'] : '';

if (!empty($pow_id)){
    
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET SHOP_TO_LINKED = :ins WHERE ID_TOW = :isidt');
	oci_bind_by_name($stid, ":isidt", $pow_id);
	oci_bind_by_name($stid, ":ins", $pow_new);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
//kategoria	
$kategoria = isset($_POST['kategoria']) ? $_POST['kategoria'] : '';
$kat_id_tow = isset($_POST['kat_id_tow']) ? $_POST['kat_id_tow'] : '';

if (!empty($kat_id_tow) && !empty($kategoria)){
    
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET SHOP_TO_CATEGORY = :ins WHERE ID_TOW = :isidt');
	oci_bind_by_name($stid, ":isidt", $kat_id_tow);
	oci_bind_by_name($stid, ":ins", $kategoria);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
//kategoria	2
$kategoria2 = isset($_POST['kategoria2']) ? $_POST['kategoria2'] : '';
$kat_id_tow2 = isset($_POST['kat_id_tow2']) ? $_POST['kat_id_tow2'] : '';

if (!empty($kat_id_tow2) && !empty($kategoria2)){
    
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET SHOP_TO_CATEGORY_2 = :ins WHERE ID_TOW = :isidt');
	oci_bind_by_name($stid, ":isidt", $kat_id_tow2);
	oci_bind_by_name($stid, ":ins", $kategoria2);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
//dostawa	
$dostawa = isset($_POST['dostawa']) ? $_POST['dostawa'] : '';
$deliv_id_tow = isset($_POST['deliv_id_tow']) ? $_POST['deliv_id_tow'] : '';

if (!empty($deliv_id_tow) && !empty($dostawa)){
    
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET SHOP_TO_DELIVERY = :ins WHERE ID_TOW = :isidt');
	oci_bind_by_name($stid, ":isidt", $deliv_id_tow);
	oci_bind_by_name($stid, ":ins", $dostawa);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
//dostawa3	
$dostawa3 = isset($_POST['dostawa3']) ? $_POST['dostawa3'] : '';
$deliv_id_tow3 = isset($_POST['deliv_id_tow3']) ? $_POST['deliv_id_tow3'] : '';

if (!empty($deliv_id_tow3) && !empty($dostawa3)){
    
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET SHOP_TO_DELIVERY_3 = :ins WHERE ID_TOW = :isidt');
	oci_bind_by_name($stid, ":isidt", $deliv_id_tow3);
	oci_bind_by_name($stid, ":ins", $dostawa3);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
	
//dostawa	 typ
$dostawa_typ = isset($_POST['dostawa_typ']) ? $_POST['dostawa_typ'] : '';
$deliv_id_tow_typ = isset($_POST['deliv_id_tow_typ']) ? $_POST['deliv_id_tow_typ'] : '';

if (!empty($deliv_id_tow_typ) && !empty($dostawa_typ)){
    
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET SHOP_TO_DELIVERY_2 = :ins WHERE ID_TOW = :isidt');
	oci_bind_by_name($stid, ":isidt", $deliv_id_tow_typ);
	oci_bind_by_name($stid, ":ins", $dostawa_typ);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
//$pstop = $paginating;
$pstop = $paginating;
$pstart = ($page-1) * $pstop; 
?>




<div class="panel panel-default">
<div class="panel-heading">
Filtry:
Kod:
<form action="" method="post" style="display:inline!important;">
	<input type="text" name="ffkod" size="9" maxlength="9" value="<?php echo $filtr_kod; ?>" />
	<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
	<input type="hidden" name="ffkodok" value="ok" />
</form>
Status:
<form action="" method="post" style="display:inline!important;">
	<input type="text" name="ffstat" size="9" maxlength="9" value="<?php echo $filtr_stat; ?>" />
	<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
	<input type="hidden" name="ffstatok" value="ok" />
</form>
Grupa:
<form action="" method="post" style="display:inline!important;">
	<input type="text" name="ffgrupa" size="9" maxlength="9" value="<?php echo $filtr_grupa; ?>" />
	<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
	<input type="hidden" name="ffgrupaok" value="ok" />
</form>
W sklepie ? (T/N/%):
<form action="" method="post" style="display:inline!important;">
	<input type="text" name="ffsklep" size="9" maxlength="9" value="<?php echo $filtr_sklep; ?>" />
	<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
	<input type="hidden" name="ffsklepok" value="ok" />
</form>
Spz ? (Y/N/%):
<form action="" method="post" style="display:inline!important;">
	<input type="text" name="ffspz" size="9" maxlength="9" value="<?php echo $filtr_spz; ?>" />
	<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
	<input type="hidden" name="ffspzok" value="ok" />
</form>

<center>Produkty do uzupełnienia - strona  <?php echo $page;?></center> </div>

<div class="table-responsive">
<table class="table table-hover table-condensed small">
<thead>
<tr>
<th>Lp.</th>
<th>ID.</th>
<th>Kod RB</th>
<th>Grupa</th>
<th>Status</th>
<th>Sync</th>
<th>Stan</th>
<th>Nazwa RB</th>
<th>W sklepie?</th>
<th>SPZ?</th>
<th>Kategoria 1</th>
<th>Kategoria 2</th>
<th>Czas Dost.</th>
<th>Czas Dost. 2</th>
<th>Forma Dostawy </th>
<th>Powiazane ;</th>
<th>Shoper nazwa</th>
<th>Opis</th>
</tr>
</thead>

<?php

//ttt
$total_records = 0;
$licznik = 1;
$to_opis_lenght = 1300;

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
AND JFOX_RB_TOWAR_KARTOTEKI.TO_STATUS_HANDL LIKE '".$filtr_stat."'
AND JFOX_TOWAR_KARTOTEKI.TO_KOD LIKE '".$filtr_kod."'
AND JFOX_TOWAR_KARTOTEKI.TO_GRUPA LIKE '".$filtr_grupa."'
AND SHOPPER_PRODUCTS.IN_SHOP LIKE '".$filtr_sklep."'
AND SHOPPER_PRODUCTS.SHOP_TO_SPZ LIKE '".$filtr_spz."'
AND (JFOX_RB_TOWAR_KARTOTEKI.TO_STATUS_HANDL LIKE 'spr' OR JFOX_RB_TOWAR_KARTOTEKI.TO_STATUS_HANDL LIKE 'spz' OR JFOX_RB_TOWAR_KARTOTEKI.TO_STATUS_HANDL LIKE 'wyp')
ORDER BY JFOX_TOWAR_KARTOTEKI.TO_GRUPA ASC, JFOX_TOWAR_KARTOTEKI.TO_KOD ASC OFFSET ".$pstart." ROWS FETCH NEXT ".$pstop." ROWS ONLY";

$sql2 = "SELECT 
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
AND JFOX_RB_TOWAR_KARTOTEKI.TO_STATUS_HANDL LIKE '".$filtr_stat."'
AND JFOX_TOWAR_KARTOTEKI.TO_KOD LIKE '".$filtr_kod."'
AND JFOX_TOWAR_KARTOTEKI.TO_GRUPA LIKE '".$filtr_grupa."'
AND SHOPPER_PRODUCTS.IN_SHOP LIKE '".$filtr_sklep."'
AND SHOPPER_PRODUCTS.SHOP_TO_SPZ LIKE '".$filtr_spz."'
AND (JFOX_RB_TOWAR_KARTOTEKI.TO_STATUS_HANDL LIKE 'spr' OR JFOX_RB_TOWAR_KARTOTEKI.TO_STATUS_HANDL LIKE 'spz' OR JFOX_RB_TOWAR_KARTOTEKI.TO_STATUS_HANDL LIKE 'wyp')
ORDER BY JFOX_TOWAR_KARTOTEKI.TO_GRUPA ASC, JFOX_TOWAR_KARTOTEKI.TO_KOD ASC";

$stid = oci_parse($conn, "$sql2");
$stid2 = oci_parse($conn, "$sql");
		//oci_bind_by_name($stid, ":eean", $ean_csv);		
		oci_execute($stid2);
			
		while (($row = oci_fetch_array($stid2, OCI_ASSOC)) != false) {
			
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
			$rb_stan = $row['STAN'];
			$linkwww = '';
			$link_prod_desc = '';
			$link_prod_desc = 'http://192.168.18.96/index.php?id=tools&type=shop_baza_edit&code='.$id_tow;
			
			$to_opis = $row['SHOP_OPIS']; // opis towaru
	
			if ($to_opis == ''){
				$to_opis = 'Opis produktu';
			} else {
				$to_opis = $row['SHOP_OPIS']->load(); // opis towaru
			}
			
			$to_opis = strip_tags($to_opis);
			
			
			if ($shop_name == ''){
				
				$linkwww = 'https://www.robelit.pl/'.pl_charset($rb_tow_nazwa).'-'.$rb_tow_kod.'.html';	
			} else {
				$linkwww = 'https://www.robelit.pl/'.pl_charset($shop_name).'-'.$rb_tow_kod.'.html';	
				
			}
			
			
?>
			<tr>	
				<td class="col-md-0"> <?php echo $licznik ?></td>
				
				<td class="col-md-0" style="font-size: 10px;"> <?php echo $id_tow ?></td>
				
				<td class="col-md-0"> <?php echo $rb_tow_kod ?></td>
				
				<td class="col-md-0"> <?php echo $grupa_tow ?></td>
				
				<td class="col-md-0"> 
				
					<?php if ($rb_stat == 'spr') {echo  '<span class="label label-success">'.$rb_stat.'</span>';}  ?>
					<?php if ($rb_stat == 'spz') {echo  '<span class="label label-info">'.$rb_stat.'</span>';}  ?>
					<?php if ($rb_stat == 'wyp') {echo  '<span class="label label-danger">'.$rb_stat.'</span>';}  ?>
				
				</td>
				
				<td class="col-md-0"> 
				
					<form action="" method="post" style="display:inline!important;">
						
						<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-picture"></span> </button>
						<input type="hidden" name="sync_pic_code" value="<?php echo $rb_tow_kod; ?>" />
					</form>
					
					<form action="" method="post" style="display:inline!important;">
						
						<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-send"></span> </button>
						<input type="hidden" name="sync_prod_code" value="<?php echo $rb_tow_kod; ?>" />
					</form>
					
					<a target="_blank" class="btn btn-xs btn-success glyphicon glyphicon-globe" href="<?php echo $linkwww ?>"></a>
					
					
				
				</td>
				
				<td class="col-md-0"> <?php echo $rb_stan ?>
				
				</td>
				
				<td class="col-md-0"> <?php echo $rb_tow_nazwa ?>
				
				</td>

				<td class="col-md-0">
					<form action="" method="post" style="display:inline!important;">
					<input type="hidden" name="inshop_id_tow" value="<?php echo $id_tow; ?>" />
					<input type="hidden" name="inshop1" value="inshop1" />
					<button type="submit" name="inshopcheck" value="<?php echo $in_shop == 'T' ? 'N' : 'T'; ?>" <?php echo $in_shop == 'T' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
					<?php echo $in_shop == 'T' ? 'ON' : 'OFF'; ?></button>
				</form>
				</td>
				
				
				<td class="col-md-0">
				<?php if ($rb_stat == 'spz') {?>
					<form action="" method="post" style="display:inline!important;">
					<input type="hidden" name="in_shop_spz_id" value="<?php echo $id_tow; ?>" />
					<input type="hidden" name="in_shop_spz1" value="in_shop_spz1" />
					<button type="submit" name="in_shop_spz" value="<?php echo $shop_spz == 'Y' ? 'N' : 'Y'; ?>" <?php echo $shop_spz == 'Y' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
					<?php echo $shop_spz == 'Y' ? 'ON' : 'OFF'; ?></button>
				</form>
				<?php }?>
				</td>
				
				<td class="col-md-0">
				
					<form action="" method="post"  class="form-inline">
						<select name="kategoria" class="form-control input-sm small" onchange="this.form.submit()" style="width: 200px;" >
							<option class="label-danger" value="999"  <?php echo $shop_cat == 999 ? 'selected="selected"' : ''; ?>  ><?php echo "Brak" ?></option>
							<option value="30"  <?php echo $shop_cat == 30 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty lite -> Akryl PMMA" ?></option>
							<option value="28"  <?php echo $shop_cat == 28 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty lite -> Poliwęglan lity" ?></option>
							<option value="29"  <?php echo $shop_cat == 29 ? 'selected="selected"' : ''; ?>  ><?php echo "Panele poliwęglanowe" ?></option>
							<option value="75"  <?php echo $shop_cat == 75 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 4mm" ?></option>
							<option value="76"  <?php echo $shop_cat == 76 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 4,5mm" ?></option>
							<option value="77"  <?php echo $shop_cat == 77 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 6mm" ?></option>
							<option value="78"  <?php echo $shop_cat == 78 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 8mm" ?></option>
							<option value="74"  <?php echo $shop_cat == 74 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 10mm" ?></option>
							<option value="73"  <?php echo $shop_cat == 73 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 16mm" ?></option>
							<option value="79"  <?php echo $shop_cat == 79 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 20mm" ?></option>
							<option value="80"  <?php echo $shop_cat == 80 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 25mm" ?></option>
						
							<option value="81"  <?php echo $shop_cat == 81 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Mleczny -> 6mm" ?></option>
							<option value="82"  <?php echo $shop_cat == 82 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Mleczny -> 8mm" ?></option>
							<option value="83"  <?php echo $shop_cat == 83 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Mleczny -> 10mm" ?></option>
							<option value="84"  <?php echo $shop_cat == 84 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Mleczny -> 16mm" ?></option>
							<option value="85"  <?php echo $shop_cat == 85 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Mleczny -> 20mm" ?></option>
							<option value="86"  <?php echo $shop_cat == 86 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Mleczny -> 25mm" ?></option>
							
							<option value="87"  <?php echo $shop_cat == 87 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Dymny -> 4mm" ?></option>
							<option value="88"  <?php echo $shop_cat == 88 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Dymny -> 4,5mm" ?></option>
							<option value="89"  <?php echo $shop_cat == 89 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Dymny -> 6mm" ?></option>
							<option value="90"  <?php echo $shop_cat == 90 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Dymny -> 8mm" ?></option>
							<option value="91"  <?php echo $shop_cat == 91 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Dymny -> 10mm" ?></option>
							<option value="92"  <?php echo $shop_cat == 92 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Dymny -> 16mm" ?></option>
						
							<option value="93"  <?php echo $shop_cat == 93 ? 'selected="selected"' : ''; ?>  ><?php echo "Akces. do płyt poliw - Profile" ?></option>
							<option value="94"  <?php echo $shop_cat == 94 ? 'selected="selected"' : ''; ?>  ><?php echo "Akces. do płyt poliw - Uszczelki" ?></option>
							<option value="95"  <?php echo $shop_cat == 95 ? 'selected="selected"' : ''; ?>  ><?php echo "Akces. do płyt poliw - Taśmy" ?></option>
							<option value="96"  <?php echo $shop_cat == 96 ? 'selected="selected"' : ''; ?>  ><?php echo "Akces. do płyt poliw - Wkręty" ?></option>
							<option value="97"  <?php echo $shop_cat == 97 ? 'selected="selected"' : ''; ?>  ><?php echo "Akces. do płyt poliw - Pozostałe" ?></option>
						
							<option value="17"  <?php echo $shop_cat == 17 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty profilowane - Akryl profilowany" ?></option>
							<option value="18"  <?php echo $shop_cat == 18 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty profilowane - PVC profilowany" ?></option>
							<option value="19"  <?php echo $shop_cat == 19 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty profilowane - Poliwęglan Profilowany PC05" ?></option>
							<option value="20"  <?php echo $shop_cat == 20 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty profilowane - Poliwęglan Profilowany PC08" ?></option>
							<option value="25"  <?php echo $shop_cat == 25 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty profilowane - Akce. do mont. płyt profil." ?></option>
						
							<option value="37"  <?php echo $shop_cat == 37 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Antyrefleks" ?></option>
							
							<option value="98"  <?php echo $shop_cat == 98 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 2 mm" ?></option>
							<option value="99"  <?php echo $shop_cat == 99 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 2,5 mm" ?></option>
							<option value="100"  <?php echo $shop_cat == 100 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 4 mm" ?></option>
							<option value="101"  <?php echo $shop_cat == 101 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 5 mm" ?></option>
							<option value="102"  <?php echo $shop_cat == 102 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 8 mm" ?></option>
							
							<option value="34"    <?php echo $shop_cat == 34 ? 'selected="selected"' : ''; ?>  ><?php echo "Formatki do drzwi" ?></option>
							<option value="124"  <?php echo $shop_cat == 124 ? 'selected="selected"' : ''; ?>  ><?php echo "Formatki do drzwi - 440x440 mm" ?></option>
							<option value="106"  <?php echo $shop_cat == 106 ? 'selected="selected"' : ''; ?>  ><?php echo "Formatki do drzwi - 440x540 mm" ?></option>
							<option value="104"  <?php echo $shop_cat == 104 ? 'selected="selected"' : ''; ?>  ><?php echo "Formatki do drzwi - 1200x640 mm" ?></option>
							<option value="126"  <?php echo $shop_cat == 126 ? 'selected="selected"' : ''; ?>  ><?php echo "Formatki do drzwi - 1420x440 mm" ?></option>
							<option value="105"  <?php echo $shop_cat == 105 ? 'selected="selected"' : ''; ?>  ><?php echo "Formatki do drzwi - 1420x540 mm" ?></option>
							
							<option value="103"  <?php echo $shop_cat == 103 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polist. - Szkło syntetyczne - ornamentowe. 1000x2000 mm" ?></option>
							<option value="107"  <?php echo $shop_cat == 107 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polist. - Szkło syntetyczne - ornamentowe. Pozostałe mm" ?></option>
							
							<option value="39"  <?php echo $shop_cat == 39 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki alu. STANDARD" ?></option>
							<option value="127"  <?php echo $shop_cat == 127 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki alu. - Daszki łukowe" ?></option>
							<option value="128"  <?php echo $shop_cat == 128 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki alu. - Daszki markizowe" ?></option>
							<option value="129"  <?php echo $shop_cat == 129 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki alu. - Daszki płaskie" ?></option>
							
							
							<option value="40"  <?php echo $shop_cat == 40 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki aluminiowe RETRO" ?></option>
							<option value="41"  <?php echo $shop_cat == 41 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki aluminiowe PLUS" ?></option>
							<option value="42"  <?php echo $shop_cat == 42 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki ze stali nierdzewnej" ?></option>
								<option value="130"  <?php echo $shop_cat == 130 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki ze stali nierdzewnej - Daszki lightline" ?></option>
								<option value="131"  <?php echo $shop_cat == 131 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki ze stali nierdzewnej - Daszki modułowe lightline" ?></option>
								<option value="132"  <?php echo $shop_cat == 132 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki ze stali nierdzewnej - Ścianki boczne" ?></option>
							
							
							<option value="43"  <?php echo $shop_cat == 43 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki balkonowe" ?></option>
							<option value="44"  <?php echo $shop_cat == 44 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Markiza Coppo Line" ?></option>
							
							<option value="46"  <?php echo $shop_cat == 46 ? 'selected="selected"' : ''; ?>  ><?php echo "Bitumiczne pokrycia dachowe - Płyty bitumiczne" ?></option>
							<option value="47"  <?php echo $shop_cat == 47 ? 'selected="selected"' : ''; ?>  ><?php echo "Bitumiczne pokrycia dachowe - Gonty bitumiczne" ?></option>
							<option value="108"  <?php echo $shop_cat == 108 ? 'selected="selected"' : ''; ?>  ><?php echo "Bitumiczne pokrycia dachowe - Płyty bitumiczne - akcesoria" ?></option>
							
							<option value="49"  <?php echo $shop_cat == 49 ? 'selected="selected"' : ''; ?>  ><?php echo "Izolacje pionowe i poziome - Folia kubełkowa" ?></option>
							<option value="50"  <?php echo $shop_cat == 50 ? 'selected="selected"' : ''; ?>  ><?php echo "Izolacje pionowe i poziome - Izolacja pozioma" ?></option>
							<option value="51"  <?php echo $shop_cat == 51 ? 'selected="selected"' : ''; ?>  ><?php echo "Izolacje pionowe i poziome - Membrany dachowe" ?></option>
							<option value="52"  <?php echo $shop_cat == 52 ? 'selected="selected"' : ''; ?>  ><?php echo "Izolacje pionowe i poziome - Folia paroprzepuszczalna" ?></option>
							
							<option value="15"  <?php echo $shop_cat == 15 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony płaskie NRO " ?></option>
							<option value="21"  <?php echo $shop_cat == 21 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Poliester - płyty faliste" ?></option>
							<option value="22"  <?php echo $shop_cat == 22 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe płaskie " ?></option>
							
							<option value="109"  <?php echo $shop_cat == 109 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe faliste - 100 cm " ?></option>
							<option value="110"  <?php echo $shop_cat == 110 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe faliste - 150 cm " ?></option>
							<option value="111"  <?php echo $shop_cat == 111 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe faliste - 200 cm " ?></option>
							<option value="112"  <?php echo $shop_cat == 112 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe faliste - 250 cm " ?></option>
							<option value="113"  <?php echo $shop_cat == 113 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe faliste - 300 cm " ?></option>
							
							<option value="23"  <?php echo $shop_cat == 23 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Poliester - profile blach trapezowych " ?></option>
							<option value="24"  <?php echo $shop_cat == 24 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Poliester - samonośne płyty łukowe" ?></option>
							
							<option value="115"  <?php echo $shop_cat == 115 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Agrotkaniny - AgroSTOP" ?></option>
							<option value="116"  <?php echo $shop_cat == 116 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Agrotkaniny - AgroSPEED" ?></option>
							<option value="117"  <?php echo $shop_cat == 117 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Agrotkaniny - AgroTHERM" ?></option>
							<option value="118"  <?php echo $shop_cat == 118 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Agrotkaniny - Akcesoria" ?></option>
							
							<option value="61"  <?php echo $shop_cat == 61 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Kratka trawnikowa" ?></option>
							<option value="114"  <?php echo $shop_cat == 114 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Kaptury ochronne" ?></option>
							<option value="59"  <?php echo $shop_cat == 59 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Podesty kompozytowe" ?></option>
							<option value="60"  <?php echo $shop_cat == 60 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Sztachety kompozytowe" ?></option>
							<option value="123"  <?php echo $shop_cat == 123 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Szklarnie" ?></option>
							<option value="133"  <?php echo $shop_cat == 133 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Pergole" ?></option>
							
							<option value="54"  <?php echo $shop_cat == 54 ? 'selected="selected"' : ''; ?>  ><?php echo "Folia - Folie PE" ?></option>
							<option value="66"  <?php echo $shop_cat == 66 ? 'selected="selected"' : ''; ?>  ><?php echo "Folia - Folia A-Pet" ?></option>
							<option value="56"  <?php echo $shop_cat == 56 ? 'selected="selected"' : ''; ?>  ><?php echo "Folia - Folie PET i PVC" ?></option>
							<option value="64"  <?php echo $shop_cat == 64 ? 'selected="selected"' : ''; ?>  ><?php echo "Folia - Ochronne - samoprzylepne" ?></option>
							
							<option value="67"  <?php echo $shop_cat == 67 ? 'selected="selected"' : ''; ?>  ><?php echo "Maty ochronne" ?></option>
							<option value="63"  <?php echo $shop_cat == 63 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty kanalikowe z polipropylenu" ?></option>
							<option value="62"  <?php echo $shop_cat == 62 ? 'selected="selected"' : ''; ?>  ><?php echo "PVC spienione" ?></option>
							<option value="65"  <?php echo $shop_cat == 65 ? 'selected="selected"' : ''; ?>  ><?php echo "Asfalt workowany" ?></option>
							<option value="13"  <?php echo $shop_cat == 13 ? 'selected="selected"' : ''; ?>  ><?php echo "Wyprzedaż" ?></option>
							<option value="121"  <?php echo $shop_cat == 121 ? 'selected="selected"' : ''; ?>  ><?php echo "Wyprzedaż - środki czystości" ?></option>
							<option value="122"  <?php echo $shop_cat == 122 ? 'selected="selected"' : ''; ?>  ><?php echo "Maseczki i przyłbice" ?></option>
							
							
						
						
						</select>
						<input type="hidden" name="kat_id_tow" value="<?php echo $id_tow; ?>" />
					</form>
				
				</td>
				
				<td class="col-md-0">
				
					<form action="" method="post"  class="form-inline">
						<select name="kategoria2" class="form-control input-sm small" onchange="this.form.submit()" style="width: 200px;" >
							<option class="label-danger" value="999"  <?php echo $shop_cat2 == 999 ? 'selected="selected"' : ''; ?>  ><?php echo "Brak" ?></option>
							<option value="30"  <?php echo $shop_cat2 == 30 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty lite -> Akryl PMMA" ?></option>
							<option value="28"  <?php echo $shop_cat2 == 28 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty lite -> Poliwęglan lity" ?></option>
							<option value="29"  <?php echo $shop_cat2 == 29 ? 'selected="selected"' : ''; ?>  ><?php echo "Panele poliwęglanowe" ?></option>
							<option value="75"  <?php echo $shop_cat2 == 75 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 4mm" ?></option>
							<option value="76"  <?php echo $shop_cat2 == 76 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 4,5mm" ?></option>
							<option value="77"  <?php echo $shop_cat2 == 77 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 6mm" ?></option>
							<option value="78"  <?php echo $shop_cat2 == 78 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 8mm" ?></option>
							<option value="74"  <?php echo $shop_cat2 == 74 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 10mm" ?></option>
							<option value="73"  <?php echo $shop_cat2 == 73 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 16mm" ?></option>
							<option value="79"  <?php echo $shop_cat2 == 79 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 20mm" ?></option>
							<option value="80"  <?php echo $shop_cat2 == 80 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 25mm" ?></option>
						
							<option value="81"  <?php echo $shop_cat2 == 81 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Mleczny -> 6mm" ?></option>
							<option value="82"  <?php echo $shop_cat2 == 82 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Mleczny -> 8mm" ?></option>
							<option value="83"  <?php echo $shop_cat2 == 83 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Mleczny -> 10mm" ?></option>
							<option value="84"  <?php echo $shop_cat2 == 84 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Mleczny -> 16mm" ?></option>
							<option value="85"  <?php echo $shop_cat2 == 85 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Mleczny -> 20mm" ?></option>
							<option value="86"  <?php echo $shop_cat2 == 86 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Mleczny -> 25mm" ?></option>
							
							<option value="87"  <?php echo $shop_cat2 == 87 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Dymny -> 4mm" ?></option>
							<option value="88"  <?php echo $shop_cat2 == 88 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Dymny -> 4,5mm" ?></option>
							<option value="89"  <?php echo $shop_cat2 == 89 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Dymny -> 6mm" ?></option>
							<option value="90"  <?php echo $shop_cat2 == 90 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Dymny -> 8mm" ?></option>
							<option value="91"  <?php echo $shop_cat2 == 91 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Dymny -> 10mm" ?></option>
							<option value="92"  <?php echo $shop_cat2 == 92 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Dymny -> 16mm" ?></option>
						
							<option value="93"  <?php echo $shop_cat2 == 93 ? 'selected="selected"' : ''; ?>  ><?php echo "Akces. do płyt poliw - Profile" ?></option>
							<option value="94"  <?php echo $shop_cat2 == 94 ? 'selected="selected"' : ''; ?>  ><?php echo "Akces. do płyt poliw - Uszczelki" ?></option>
							<option value="95"  <?php echo $shop_cat2 == 95 ? 'selected="selected"' : ''; ?>  ><?php echo "Akces. do płyt poliw - Taśmy" ?></option>
							<option value="96"  <?php echo $shop_cat2 == 96 ? 'selected="selected"' : ''; ?>  ><?php echo "Akces. do płyt poliw - Wkręty" ?></option>
							<option value="97"  <?php echo $shop_cat2 == 97 ? 'selected="selected"' : ''; ?>  ><?php echo "Akces. do płyt poliw - Pozostałe" ?></option>
						
							<option value="17"  <?php echo $shop_cat2 == 17 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty profilowane - Akryl profilowany" ?></option>
							<option value="18"  <?php echo $shop_cat2 == 18 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty profilowane - PVC profilowany" ?></option>
							<option value="19"  <?php echo $shop_cat2 == 19 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty profilowane - Poliwęglan Profilowany PC05" ?></option>
							<option value="20"  <?php echo $shop_cat2 == 20 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty profilowane - Poliwęglan Profilowany PC08" ?></option>
							<option value="25"  <?php echo $shop_cat2 == 25 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty profilowane - Akce. do mont. płyt profil." ?></option>
						
							<option value="37"  <?php echo $shop_cat2 == 37 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Antyrefleks" ?></option>
							
							<option value="98"  <?php echo $shop_cat2 == 98 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 2 mm" ?></option>
							<option value="99"  <?php echo $shop_cat2 == 99 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 2,5 mm" ?></option>
							<option value="100"  <?php echo $shop_cat2 == 100 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 4 mm" ?></option>
							<option value="101"  <?php echo $shop_cat2 == 101 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 5 mm" ?></option>
							<option value="102"  <?php echo $shop_cat2 == 102 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 8 mm" ?></option>
							
							<option value="34"    <?php echo $shop_cat2 == 34 ? 'selected="selected"' : ''; ?>  ><?php echo "Formatki do drzwi" ?></option>
							<option value="124"  <?php echo $shop_cat2 == 124 ? 'selected="selected"' : ''; ?>  ><?php echo "Formatki do drzwi - 440x440 mm" ?></option>
							<option value="106"  <?php echo $shop_cat2 == 106 ? 'selected="selected"' : ''; ?>  ><?php echo "Formatki do drzwi - 440x540 mm" ?></option>
							<option value="104"  <?php echo $shop_cat2 == 104 ? 'selected="selected"' : ''; ?>  ><?php echo "Formatki do drzwi - 1200x640 mm" ?></option>
							<option value="126"  <?php echo $shop_cat2 == 126 ? 'selected="selected"' : ''; ?>  ><?php echo "Formatki do drzwi - 1420x440 mm" ?></option>
							<option value="105"  <?php echo $shop_cat2 == 105 ? 'selected="selected"' : ''; ?>  ><?php echo "Formatki do drzwi - 1420x540 mm" ?></option>
							
							<option value="103"  <?php echo $shop_cat2 == 103 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polist. - Szkło syntetyczne - ornamentowe. 1000x2000 mm" ?></option>
							<option value="107"  <?php echo $shop_cat2 == 107 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polist. - Szkło syntetyczne - ornamentowe. Pozostałe mm" ?></option>
							
							<option value="39"  <?php echo $shop_cat2 == 39 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki alu. STANDARD" ?></option>
							<option value="127"  <?php echo $shop_cat2 == 127 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki alu. - Daszki łukowe" ?></option>
							<option value="128"  <?php echo $shop_cat2 == 128 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki alu. - Daszki markizowe" ?></option>
							<option value="129"  <?php echo $shop_cat2 == 129 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki alu. - Daszki płaskie" ?></option>
							
							
							<option value="40"  <?php echo $shop_cat2 == 40 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki aluminiowe RETRO" ?></option>
							<option value="41"  <?php echo $shop_cat2 == 41 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki aluminiowe PLUS" ?></option>
							<option value="42"  <?php echo $shop_cat2 == 42 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki ze stali nierdzewnej" ?></option>
								<option value="130"  <?php echo $shop_cat2 == 130 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki ze stali nierdzewnej - Daszki lightline" ?></option>
								<option value="131"  <?php echo $shop_cat2 == 131 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki ze stali nierdzewnej - Daszki modułowe lightline" ?></option>
								<option value="132"  <?php echo $shop_cat2 == 132 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki ze stali nierdzewnej - Ścianki boczne" ?></option>
							
							
							<option value="43"  <?php echo $shop_cat2 == 43 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Daszki balkonowe" ?></option>
							<option value="44"  <?php echo $shop_cat2 == 44 ? 'selected="selected"' : ''; ?>  ><?php echo "Zad. drzwi i bal. - Markiza Coppo Line" ?></option>
							
							<option value="46"  <?php echo $shop_cat2 == 46 ? 'selected="selected"' : ''; ?>  ><?php echo "Bitumiczne pokrycia dachowe - Płyty bitumiczne" ?></option>
							<option value="47"  <?php echo $shop_cat2 == 47 ? 'selected="selected"' : ''; ?>  ><?php echo "Bitumiczne pokrycia dachowe - Gonty bitumiczne" ?></option>
							<option value="108"  <?php echo $shop_cat2 == 108 ? 'selected="selected"' : ''; ?>  ><?php echo "Bitumiczne pokrycia dachowe - Płyty bitumiczne - akcesoria" ?></option>
							
							<option value="49"  <?php echo $shop_cat2 == 49 ? 'selected="selected"' : ''; ?>  ><?php echo "Izolacje pionowe i poziome - Folia kubełkowa" ?></option>
							<option value="50"  <?php echo $shop_cat2 == 50 ? 'selected="selected"' : ''; ?>  ><?php echo "Izolacje pionowe i poziome - Izolacja pozioma" ?></option>
							<option value="51"  <?php echo $shop_cat2 == 51 ? 'selected="selected"' : ''; ?>  ><?php echo "Izolacje pionowe i poziome - Membrany dachowe" ?></option>
							<option value="52"  <?php echo $shop_cat2 == 52 ? 'selected="selected"' : ''; ?>  ><?php echo "Izolacje pionowe i poziome - Folia paroprzepuszczalna" ?></option>
							
							<option value="15"  <?php echo $shop_cat2 == 15 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony płaskie NRO " ?></option>
							<option value="21"  <?php echo $shop_cat2 == 21 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Poliester - płyty faliste" ?></option>
							<option value="22"  <?php echo $shop_cat2 == 22 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe płaskie " ?></option>
							
							<option value="109"  <?php echo $shop_cat2 == 109 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe faliste - 100 cm " ?></option>
							<option value="110"  <?php echo $shop_cat2 == 110 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe faliste - 150 cm " ?></option>
							<option value="111"  <?php echo $shop_cat2 == 111 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe faliste - 200 cm " ?></option>
							<option value="112"  <?php echo $shop_cat2 == 112 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe faliste - 250 cm " ?></option>
							<option value="113"  <?php echo $shop_cat2 == 113 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe faliste - 300 cm " ?></option>
							
							<option value="23"  <?php echo $shop_cat2 == 23 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Poliester - profile blach trapezowych " ?></option>
							<option value="24"  <?php echo $shop_cat2 == 24 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Poliester - samonośne płyty łukowe" ?></option>
							
							<option value="115"  <?php echo $shop_cat2 == 115 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Agrotkaniny - AgroSTOP" ?></option>
							<option value="116"  <?php echo $shop_cat2 == 116 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Agrotkaniny - AgroSPEED" ?></option>
							<option value="117"  <?php echo $shop_cat2 == 117 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Agrotkaniny - AgroTHERM" ?></option>
							<option value="118"  <?php echo $shop_cat2 == 118 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Agrotkaniny - Akcesoria" ?></option>
							
							<option value="61"  <?php echo $shop_cat2 == 61 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Kratka trawnikowa" ?></option>
							<option value="114"  <?php echo $shop_cat2 == 114 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Kaptury ochronne" ?></option>
							<option value="59"  <?php echo $shop_cat2 == 59 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Podesty kompozytowe" ?></option>
							<option value="60"  <?php echo $shop_cat2 == 60 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Sztachety kompozytowe" ?></option>
							<option value="123"  <?php echo $shop_cat2 == 123 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Szklarnie" ?></option>
							<option value="133"  <?php echo $shop_cat == 133 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty do ogrodu - Pergole" ?></option>
							
							<option value="54"  <?php echo $shop_cat2 == 54 ? 'selected="selected"' : ''; ?>  ><?php echo "Folia - Folie PE" ?></option>
							<option value="66"  <?php echo $shop_cat2 == 66 ? 'selected="selected"' : ''; ?>  ><?php echo "Folia - Folia A-Pet" ?></option>
							<option value="56"  <?php echo $shop_cat2 == 56 ? 'selected="selected"' : ''; ?>  ><?php echo "Folia - Folie PET i PVC" ?></option>
							<option value="64"  <?php echo $shop_cat2 == 64 ? 'selected="selected"' : ''; ?>  ><?php echo "Folia - Ochronne - samoprzylepne" ?></option>
							
							<option value="67"  <?php echo $shop_cat2 == 67 ? 'selected="selected"' : ''; ?>  ><?php echo "Maty ochronne" ?></option>
							<option value="63"  <?php echo $shop_cat2 == 63 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty kanalikowe z polipropylenu" ?></option>
							<option value="62"  <?php echo $shop_cat2 == 62 ? 'selected="selected"' : ''; ?>  ><?php echo "PVC spienione" ?></option>
							<option value="65"  <?php echo $shop_cat2 == 65 ? 'selected="selected"' : ''; ?>  ><?php echo "Asfalt workowany" ?></option>
							<option value="13"  <?php echo $shop_cat2 == 13 ? 'selected="selected"' : ''; ?>  ><?php echo "Wyprzedaż" ?></option>
							<option value="121"  <?php echo $shop_cat2 == 121 ? 'selected="selected"' : ''; ?>  ><?php echo "Wyprzedaż - środki czystości" ?></option>
							<option value="122"  <?php echo $shop_cat2 == 122 ? 'selected="selected"' : ''; ?>  ><?php echo "Maseczki i przyłbice" ?></option>

						</select>
						<input type="hidden" name="kat_id_tow2" value="<?php echo $id_tow; ?>" />
					</form>
				
				</td>
				
				<td class="col-md-0">
					
					<form action="" method="post"  class="form-inline">
						<select name="dostawa" class="form-control input-sm small" onchange="this.form.submit()" style="width: 75px;" >
							<option class="label-danger" value="999"  <?php echo $shop_delivery == 999 ? 'selected="selected"' : ''; ?>  ><?php echo "Brak" ?></option>
							<option value="2"  <?php echo $shop_delivery == 2 ? 'selected="selected"' : ''; ?>  ><?php echo "2 d" ?></option>
							<option value="6"  <?php echo $shop_delivery == 6 ? 'selected="selected"' : ''; ?>  ><?php echo "10 d" ?></option>
							<option value="8"  <?php echo $shop_delivery == 8 ? 'selected="selected"' : ''; ?>  ><?php echo "45 d" ?></option>
							
						</select>
						<input type="hidden" name="deliv_id_tow" value="<?php echo $id_tow; ?>" />
					</form>
				</td>
				
				<td class="col-md-0">
					
					<form action="" method="post"  class="form-inline">
						<select name="dostawa3" class="form-control input-sm small" onchange="this.form.submit()" style="width: 75px;" >
							<option class="label-danger" value="999"  <?php echo $shop_delivery3 == 999 ? 'selected="selected"' : ''; ?>  ><?php echo "Brak" ?></option>
							<option value="2"  <?php echo $shop_delivery3 == 2 ? 'selected="selected"' : ''; ?>  ><?php echo "2 d" ?></option>
							<option value="6"  <?php echo $shop_delivery3 == 6 ? 'selected="selected"' : ''; ?>  ><?php echo "10 d" ?></option>
							<option value="8"  <?php echo $shop_delivery3 == 8 ? 'selected="selected"' : ''; ?>  ><?php echo "45 d" ?></option>
							
						</select>
						<input type="hidden" name="deliv_id_tow3" value="<?php echo $id_tow; ?>" />
					</form>
				</td>
				
				<td class="col-md-0">
					
					<form action="" method="post"  class="form-inline">
						<select name="dostawa_typ" class="form-control input-sm small" onchange="this.form.submit()" style="width: 75px;" >
							<option class="label-danger" value="999"  <?php echo $shop_delivery_typ == 999 ? 'selected="selected"' : ''; ?>  ><?php echo "Brak" ?></option>
							<option value="2"  <?php echo $shop_delivery_typ == 2 ? 'selected="selected"' : ''; ?>  ><?php echo "DPD - 20" ?></option>
							<option value="3"  <?php echo $shop_delivery_typ == 3 ? 'selected="selected"' : ''; ?>  ><?php echo "DPD - 40" ?></option>
							<option value="4"  <?php echo $shop_delivery_typ == 4 ? 'selected="selected"' : ''; ?>  ><?php echo "Paleta" ?></option>
							<option value="5"  <?php echo $shop_delivery_typ == 5 ? 'selected="selected"' : ''; ?>  ><?php echo "Własny RB" ?></option>
							<option value="7"  <?php echo $shop_delivery_typ == 7 ? 'selected="selected"' : ''; ?>  ><?php echo "Osobisty" ?></option>
							<option value="8"  <?php echo $shop_delivery_typ == 8 ? 'selected="selected"' : ''; ?>  ><?php echo "Darmowy" ?></option>
						</select>
						<input type="hidden" name="deliv_id_tow_typ" value="<?php echo $id_tow; ?>" />
					</form>
				</td>
				
				<td class="col-md-0">
				
					<form action="" method="post" style="display:inline!important;">
						<input type="text" name="pow_new" size="20" maxlength="254" value="<?php echo $shop_pow; ?>" />
						<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
						<input type="hidden" name="pow_id" value="<?php echo $id_tow; ?>" />
					</form>
				</td>
				
				<td class="col-md-0">
				
					<form action="" method="post" style="display:inline!important;">
						<input type="text" name="name_new" size="50" maxlength="250" value="<?php echo $shop_name; ?>" />
						<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
						<input type="hidden" name="name_id" value="<?php echo $id_tow; ?>" />
					</form>
				</td>
				
				<td class="col-md-0">
					<a target="_blank" style="display:inline!important;" class="btn btn-xs <?php if (strlen($to_opis) <= $to_opis_lenght) {echo 'btn-danger';} else {echo 'btn-success';} ?> glyphicon glyphicon-text-background" href="<?php echo $link_prod_desc ?>"></a>
				</td>
			</tr>

<?php
			
				
		$licznik++;
		}

		oci_free_statement($stid2);
		//oci_close($conn);
		
		oci_execute($stid);
		$results=array(); 
		$total_records = oci_fetch_all($stid, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
		oci_free_statement($stid);
		oci_close($conn);
		
		
		
?>

</table>
</div>
</div>

<?php
		echo "Rekordów - ".$total_records." <br> \n";

if($total_records >= $paginating+1) {
	
	$total_pages = ceil($total_records / $pstop); 
	echo "Stron - ".$total_pages." <br> \n";
	
	echo "<a href='index.php?id=tools&type=shop_baza&page=1'>".'|<'."</a> ";
	
	for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='index.php?id=tools&type=shop_baza&page=".$i."'>".$i."</a> "; 
	}; 	
	
	echo "<a href='index.php?id=tools&type=shop_baza&page=$total_pages'>".'>|'."</a> "; 
	
}



?>
