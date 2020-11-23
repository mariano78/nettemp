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

$inshop_id_tow = isset($_POST['inshop_id_tow']) ? $_POST['inshop_id_tow'] : '';
$inshopcheck = isset($_POST['inshopcheck']) ? $_POST['inshopcheck'] : '';
$inshop1 = isset($_POST['inshop1']) ? $_POST['inshop1'] : '';


if (!empty($inshop_id_tow) && ($inshop1 == "inshop1")){
    
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET IN_SHOP = :ins WHERE ID_TOW = :isidt');
	
	oci_bind_by_name($stid, ":isidt", $in_shop_id_tow);
	oci_bind_by_name($stid, ":ins", $inshopcheck);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);
	
	echo "robota";
	
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


?>




<div class="panel panel-default">
<div class="panel-heading">Produkty do uzupełnienia</div>

<div class="table-responsive">
<table class="table table-hover table-condensed small">
<thead>
<tr>
<th>Lp.</th>
<th>Kod RB</th>
<th>Grupa</th>
<th>Nazwa RB</th>
<th>W sklepie ?</th>
<th>Kategoria</th>
<th>Dostawa</th>
<th>Shoper nazwa</th>
</tr>
</thead>

<?php


$total_records = 0;

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$pstop = $paginating;
$pstart = ($page-1) * $pstop; 

$licznik = 1;

$sql = "SELECT * FROM INFOR_SHOPER_EXP_2 OFFSET ".$pstart." ROWS FETCH NEXT ".$pstop." ROWS ONLY";
$sql2 = "SELECT * FROM INFOR_SHOPER_EXP_2";

$stid = oci_parse($conn, "$sql2");
$stid2 = oci_parse($conn, "$sql");
		//oci_bind_by_name($stid, ":eean", $ean_csv);		
		oci_execute($stid2);
			
		while (($row = oci_fetch_array($stid2, OCI_ASSOC)) != false) {
			
			$id_tow = $row['TO_ID']; //kod towaru w RB
			$rb_tow_kod = $row['TO_KOD'];
			$rb_tow_nazwa = $row['TO_NAZWA'];
			$grupa_tow = $row['TO_GRUPA'];
			$in_shop = $row['IN_SHOP'];
			$shop_cat = $row['CATEGORY'];
			$shop_delivery = $row['DELIVERY'];
			$shop_name = $row['SHOP_NAME'];
			
?>
			<tr>	
				<td> <?php echo $licznik ?></td>
				
				<td> <?php echo $rb_tow_kod ?></td>
				
				<td> <?php echo $grupa_tow ?></td>
				
				<td> <?php echo $rb_tow_nazwa ?></td>
				
				<td>
					<form action="" method="post" style="display:inline!important;">
						<input type="hidden" name="inshop_id_tow" value="<?php echo $id_tow; ?>" />
						<?php echo $id_tow; ?>
						<input type="hidden" name="inshop1" value="inshop1" />
						<input type="checkbox" name="inshopcheck" value="Y" <?php echo $in_shop == 'Y' ? 'checked="checked"' : ''; ?> onchange="this.form.submit()" />
						<?php echo $in_shop; ?>
						
					</form>
				</td>
				
				<td> <?php echo $shop_cat ?>
				
					<form action="" method="post"  class="form-inline">
						<select name="kategoria" class="form-control input-sm small" onchange="this.form.submit()" style="width: 90px;" >
							<option value="4"  <?php echo $shop_cat == 4 ? 'selected="selected"' : ''; ?>  ><?php echo "kat1" ?></option>
							<option value="5"  <?php echo $shop_cat == 5 ? 'selected="selected"' : ''; ?>  ><?php echo "kat2" ?></option>
						</select>
						<input type="hidden" name="kat_id_tow" value="<?php echo $id_tow; ?>" />
					</form>
				
				
				
				</td>
				
				<td> <?php echo $shop_delivery ?>
					
					<form action="" method="post"  class="form-inline">
						<select name="dostawa" class="form-control input-sm small" onchange="this.form.submit()" style="width: 90px;" >
							<option value="2"  <?php echo $shop_delivery == 2 ? 'selected="selected"' : ''; ?>  ><?php echo "2 dni" ?></option>
							<option value="6"  <?php echo $shop_delivery == 6 ? 'selected="selected"' : ''; ?>  ><?php echo "10 dni" ?></option>
							<option value="8"  <?php echo $shop_delivery == 8 ? 'selected="selected"' : ''; ?>  ><?php echo "45 dni" ?></option>
							<option value="999"  <?php echo $shop_delivery == 999 ? 'selected="selected"' : ''; ?>  ><?php echo "Brak" ?></option>
						</select>
						<input type="hidden" name="deliv_id_tow" value="<?php echo $id_tow; ?>" />
					</form>
				</td>
				
				<td> <?php echo $shop_name ?></td>
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

if($total_records >=101) {
	
	$total_pages = ceil($total_records / $pstop); 
	echo "Stron - ".$total_pages." <br> \n";
	
	echo "<a href='index.php?id=tools&type=shop_baza&page=1'>".'|<'."</a> ";
	
	for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='index.php?id=tools&type=shop_baza&page=".$i."'>".$i."</a> "; 
	}; 	
	
	echo "<a href='index.php?id=tools&type=shop_baza&page=$total_pages'>".'>|'."</a> "; 
	
}



?>
