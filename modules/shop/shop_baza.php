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

//czy w sklepie
$inshop_id_tow = isset($_POST['inshop_id_tow']) ? $_POST['inshop_id_tow'] : '';
$inshopcheck = isset($_POST['inshopcheck']) ? $_POST['inshopcheck'] : '';
$inshop1 = isset($_POST['inshop1']) ? $_POST['inshop1'] : '';


if (!empty($inshop_id_tow) && ($inshop1 == "inshop1")){
  
	echo $inshop_id_tow;
	echo $inshopcheck;
	echo "opopopopp";
	
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET IN_SHOP = :ins WHERE ID_TOW = :isidt');
	
	oci_bind_by_name($stid, ":isidt", $inshop_id_tow);
	oci_bind_by_name($stid, ':ins', $inshopcheck);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);	
	
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
//nazwa
$name_new = isset($_POST['name_new']) ? $_POST['name_new'] : '';
$name_id = isset($_POST['name_id']) ? $_POST['name_id'] : '';
//$name_new = iconv();
iconv("UTF-8", "MSWIN1250", $name_new);
//$name_new2 = iconv("UTF-8", "MSWIN1250", $name_new);
if (!empty($name_id)){
    
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET SHOP_TO_NAME = :ins WHERE ID_TOW = :isidt');
	oci_bind_by_name($stid, ":isidt", $name_id);
	oci_bind_by_name($stid, ":ins", $name_new);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);
    //header("location: " . $_SERVER['REQUEST_URI']);
    //exit();
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
	
//dostawa	 typ
$dostawa_typ = isset($_POST['dostawa_typ']) ? $_POST['dostawa_typ'] : '';
$deliv_id_tow_typ = isset($_POST['deliv_id_tow_typ']) ? $_POST['deliv_id_tow_typ'] : '';

if (!empty($deliv_id_tow_typ) && !empty($dostawa_typ)){
    
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET SHOP_TO_DELIVERY = :ins WHERE ID_TOW = :isidt');
	oci_bind_by_name($stid, ":isidt", $deliv_id_tow);
	oci_bind_by_name($stid, ":ins", $dostawa);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$pstop = $paginating;
$pstart = ($page-1) * $pstop; 
?>




<div class="panel panel-default">
<div class="panel-heading"><center>Produkty do uzupełnienia - strona  <?php echo $page;?></center> </div>

<div class="table-responsive">
<table class="table table-hover table-condensed small">
<thead>
<tr>
<th>Lp.</th>
<th>Kod RB</th>
<th>Grupa</th>
<th>Status</th>
<th>Nazwa RB</th>
<th>W sklepie ?</th>
<th>Kategoria</th>
<th>Czas Dostawy</th>
<th>Forma Dostawy</th>
<th>Shoper nazwa</th>
</tr>
</thead>

<?php


$total_records = 0;



$licznik = 1;

$sql = "SELECT * FROM INFOR_SHOPER_EXP_2 OFFSET ".$pstart." ROWS FETCH NEXT ".$pstop." ROWS ONLY";
$sql2 = "SELECT * FROM INFOR_SHOPER_EXP_2";

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
			$shop_delivery = $row['DELIVERY'];
			$shop_delivery_typ = $row['DELIVERY_TYP'];
			$shop_name = $row['SHOP_NAME'];
			
?>
			<tr>	
				<td class="col-md-0"> <?php echo $licznik ?></td>
				
				<td class="col-md-0"> <?php echo $rb_tow_kod ?></td>
				
				<td class="col-md-0"> <?php echo $grupa_tow ?></td>
				
				<td class="col-md-0"> <?php echo $rb_stat ?></td>
				
				<td class="col-md-0"> <?php echo $rb_tow_nazwa ?></td>
				
				<td class="col-md-0">
					<form action="" method="post" style="display:inline!important;">
					<input type="hidden" name="inshop_id_tow" value="<?php echo $id_tow; ?>" />
					<input type="hidden" name="inshop1" value="inshop1" />
					<button type="submit" name="inshopcheck" value="<?php echo $in_shop == 'T' ? 'N' : 'T'; ?>" <?php echo $in_shop == 'T' ? 'class="btn btn-xs btn-primary"' : 'class="btn btn-xs btn-default"'; ?>>
					<?php echo $in_shop == 'T' ? 'ON' : 'OFF'; ?></button>
					<input type="hidden" name="log_on" value="log_on" />	
				</form>
				</td>
				
				<td class="col-md-0">
				
					<form action="" method="post"  class="form-inline">
						<select name="kategoria" class="form-control input-sm small" onchange="this.form.submit()" style="width: 90px;" >
							<option value="30"  <?php echo $shop_cat == 30 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty lite -> Akryl PMMA" ?></option>
							<option value="28"  <?php echo $shop_cat == 28 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty lite -> Poliwęglan lity" ?></option>
							<option value="29"  <?php echo $shop_cat == 29 ? 'selected="selected"' : ''; ?>  ><?php echo "Panele poliwęglanowe" ?></option>
							<option value="75"  <?php echo $shop_cat == 75 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 4mm" ?></option>
							<option value="76"  <?php echo $shop_cat == 76 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty komorowe -> Bezbarwny -> 4,5mm" ?></option>
							
							
						</select>
						<input type="hidden" name="kat_id_tow" value="<?php echo $id_tow; ?>" />
					</form>
				
				</td>
				
				<td class="col-md-0">
					
					<form action="" method="post"  class="form-inline">
						<select name="dostawa" class="form-control input-sm small" onchange="this.form.submit()" style="width: 130px;" >
							<option value="2"  <?php echo $shop_delivery == 2 ? 'selected="selected"' : ''; ?>  ><?php echo "2 dni" ?></option>
							<option value="6"  <?php echo $shop_delivery == 6 ? 'selected="selected"' : ''; ?>  ><?php echo "10 dni" ?></option>
							<option value="8"  <?php echo $shop_delivery == 8 ? 'selected="selected"' : ''; ?>  ><?php echo "45 dni" ?></option>
							<option value="999"  <?php echo $shop_delivery == 999 ? 'selected="selected"' : ''; ?>  ><?php echo "Brak" ?></option>
						</select>
						<input type="hidden" name="deliv_id_tow" value="<?php echo $id_tow; ?>" />
					</form>
				</td>
				
				<td class="col-md-1">
					
					<form action="" method="post"  class="form-inline">
						<select name="dostawa_typ" class="form-control input-sm small" onchange="this.form.submit()" style="width: 130px;" >
							<option value="15"  <?php echo $shop_delivery_typ == 15 ? 'selected="selected"' : ''; ?>  ><?php echo "DPD - 20" ?></option>
							<option value="16"  <?php echo $shop_delivery_typ == 16 ? 'selected="selected"' : ''; ?>  ><?php echo "DPD - 40" ?></option>
							<option value="17"  <?php echo $shop_delivery_typ == 17 ? 'selected="selected"' : ''; ?>  ><?php echo "Paleta" ?></option>
							<option value="18"  <?php echo $shop_delivery_typ == 18 ? 'selected="selected"' : ''; ?>  ><?php echo "Własny RB" ?></option>
							<option value="11"  <?php echo $shop_delivery_typ == 1 ? 'selected="selected"' : ''; ?>  ><?php echo "Osobisty" ?></option>
						</select>
						<input type="hidden" name="deliv_id_tow_typ" value="<?php echo $id_tow; ?>" />
					</form>
				</td>
				
				<td class="col-md-0">
				
					<form action="" method="post" style="display:inline!important;">
						<input type="text" name="name_new" size="40" maxlength="250" value="<?php echo $shop_name; ?>" />
						<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
						<input type="hidden" name="name_id" value="<?php echo $id_tow; ?>" />
					</form>
				
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
