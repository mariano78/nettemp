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
						<select name="kategoria" class="form-control input-sm small" onchange="this.form.submit()" style="width: 290px;" >
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
							<option value="36"  <?php echo $shop_cat == 36 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Akryl - formatki do drzwi" ?></option>
							<option value="98"  <?php echo $shop_cat == 98 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 2 mm" ?></option>
							<option value="99"  <?php echo $shop_cat == 99 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 2,5 mm" ?></option>
							<option value="100"  <?php echo $shop_cat == 100 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 4 mm" ?></option>
							<option value="101"  <?php echo $shop_cat == 101 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 5 mm" ?></option>
							<option value="102"  <?php echo $shop_cat == 102 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polistyrenu - Szkło syntet. - gładkie - 8 mm" ?></option>
						
							<option value="103"  <?php echo $shop_cat == 103 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polist. - Szkło syntetyczne - ornamentowe. 1000x2000 mm" ?></option>
							<option value="104"  <?php echo $shop_cat == 104 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polist. - Szkło syntetyczne - ornamentowe. 1200x640 mm" ?></option>
							<option value="105"  <?php echo $shop_cat == 105 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polist. - Szkło syntetyczne - ornamentowe. 1420x540 mm" ?></option>
							<option value="106"  <?php echo $shop_cat == 106 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polist. - Szkło syntetyczne - ornamentowe. 440x540 mm" ?></option>
							<option value="107"  <?php echo $shop_cat == 107 ? 'selected="selected"' : ''; ?>  ><?php echo "Szkło z polist. - Szkło syntetyczne - ornamentowe. Pozostałe mm" ?></option>
							
							<option value="39"  <?php echo $shop_cat == 39 ? 'selected="selected"' : ''; ?>  ><?php echo "Zadaszenia drzwi i balkonów - Daszki aluminiowe STANDARD" ?></option>
							<option value="40"  <?php echo $shop_cat == 40 ? 'selected="selected"' : ''; ?>  ><?php echo "Zadaszenia drzwi i balkonów - Daszki aluminiowe RETRO" ?></option>
							<option value="41"  <?php echo $shop_cat == 41 ? 'selected="selected"' : ''; ?>  ><?php echo "Zadaszenia drzwi i balkonów - Daszki aluminiowe PLUS" ?></option>
							<option value="42"  <?php echo $shop_cat == 42 ? 'selected="selected"' : ''; ?>  ><?php echo "Zadaszenia drzwi i balkonów - Daszki ze stali nierdzewnej" ?></option>
							<option value="43"  <?php echo $shop_cat == 43 ? 'selected="selected"' : ''; ?>  ><?php echo "Zadaszenia drzwi i balkonów - Daszki balkonowe" ?></option>
							<option value="44"  <?php echo $shop_cat == 44 ? 'selected="selected"' : ''; ?>  ><?php echo "Zadaszenia drzwi i balkonów - Markiza Coppo Line" ?></option>
							
							
						
						
						
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
