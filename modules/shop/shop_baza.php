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
//iconv("UTF-8", "cp1250", $name_new);
//iconv( "cp1250", "UTF-8", ($name_new));
//$str2 = mb_convert_encoding( $name_new, "Windows-1252", "UTF-8" );
echo $str2;

//$current_encoding = mb_detect_encoding($str2, 'auto');
//echo $current_encoding ;
//$str2 = mb_convert_encoding( $name_new, "Windows-1252", $current_encoding );

//if ($current_encoding == 'ASCII' )  {
	//$str2 = mb_convert_encoding( $name_new, "Windows-1252", "ASCII" );
	//$current_encoding = mb_detect_encoding($str2, 'auto');
	//echo "Po IFie --". $current_encoding ;
//}




//$name_new2 = iconv("UTF-8", "MSWIN1250", $name_new);
if (!empty($name_id)){
    
	$stid = oci_parse($conn, 'UPDATE SHOPPER_PRODUCTS SET SHOP_TO_NAME = :ins WHERE ID_TOW = :isidt');
	oci_bind_by_name($stid, ":isidt", $name_id);
	oci_bind_by_name($stid, ":ins", $str2);
	oci_execute($stid);
	oci_free_statement($stid);
	oci_close($conn);
    //header("location: " . $_SERVER['REQUEST_URI']);
   // exit();
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

//ttt
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
			$shop_delivery_typ = $row['DELIVERY2'];
			$shop_name = $row['SHOP_NAME'];
			
?>
			<tr>	
				<td class="col-md-0"> <?php echo $licznik ?></td>
				
				<td class="col-md-0"> <?php echo $rb_tow_kod ?></td>
				
				<td class="col-md-0"> <?php echo $grupa_tow ?></td>
				
				<td class="col-md-0"> 
				
					<?php if ($rb_stat == 'spr') {echo  '<span class="label label-success">'.$rb_stat.'</span>';}  ?>
					<?php if ($rb_stat == 'spz') {echo  '<span class="label label-info">'.$rb_stat.'</span>';}  ?>
					<?php if ($rb_stat == 'wyp') {echo  '<span class="label label-danger">'.$rb_stat.'</span>';}  ?>
				
				</td>
				
				<td class="col-md-0"> <?php echo $rb_tow_nazwa ?>
				<?php $current_encoding = mb_detect_encoding($rb_tow_nazwa, 'auto');
				echo $current_encoding ;
				?>
				
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
				
					<form action="" method="post"  class="form-inline">
						<select name="kategoria" class="form-control input-sm small" onchange="this.form.submit()" style="width: 390px;" >
							<option value="999"  <?php echo $shop_cat == 999 ? 'selected="selected"' : ''; ?>  ><?php echo "Brak" ?></option>
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
							
							<option value="46"  <?php echo $shop_cat == 46 ? 'selected="selected"' : ''; ?>  ><?php echo "Bitumiczne pokrycia dachowe - Płyty bitumiczne" ?></option>
							<option value="47"  <?php echo $shop_cat == 47 ? 'selected="selected"' : ''; ?>  ><?php echo "Bitumiczne pokrycia dachowe - Gonty bitumiczne" ?></option>
							<option value="108"  <?php echo $shop_cat == 108 ? 'selected="selected"' : ''; ?>  ><?php echo "Bitumiczne pokrycia dachowe - Płyty bitumiczne - akcesoria" ?></option>
							
							<option value="49"  <?php echo $shop_cat == 49 ? 'selected="selected"' : ''; ?>  ><?php echo "Izolacje pionowe i poziome - Folia kubełkowa" ?></option>
							<option value="50"  <?php echo $shop_cat == 50 ? 'selected="selected"' : ''; ?>  ><?php echo "Izolacje pionowe i poziome - Izolacja pozioma" ?></option>
							<option value="51"  <?php echo $shop_cat == 51 ? 'selected="selected"' : ''; ?>  ><?php echo "Izolacje pionowe i poziome - Membrany dachowe" ?></option>
							<option value="52"  <?php echo $shop_cat == 52 ? 'selected="selected"' : ''; ?>  ><?php echo "Izolacje pionowe i poziome - Folia paroprzepuszczalna" ?></option>
							
							<option value="15"  <?php echo $shop_cat == 15 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony płaskie NRO " ?></option>
							<option value="21"  <?php echo $shop_cat == 21 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Poliester - płyty faliste" ?></option>
							<option value="22"  <?php echo $shop_cat == 22 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Poliester - rulony faliste " ?></option>
							
							<option value="109"  <?php echo $shop_cat == 109 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe - 100 cm " ?></option>
							<option value="110"  <?php echo $shop_cat == 110 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe - 150 cm " ?></option>
							<option value="111"  <?php echo $shop_cat == 111 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe - 200 cm " ?></option>
							<option value="112"  <?php echo $shop_cat == 112 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe - 250 cm " ?></option>
							<option value="113"  <?php echo $shop_cat == 113 ? 'selected="selected"' : ''; ?>  ><?php echo "Produkty z poliestru - Rulony poliestrowe - 300 cm " ?></option>
							
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
							
							<option value="54"  <?php echo $shop_cat == 54 ? 'selected="selected"' : ''; ?>  ><?php echo "Folia - Folie PE" ?></option>
							<option value="66"  <?php echo $shop_cat == 66 ? 'selected="selected"' : ''; ?>  ><?php echo "Folia - Folia A-Pet" ?></option>
							<option value="56"  <?php echo $shop_cat == 56 ? 'selected="selected"' : ''; ?>  ><?php echo "Folia - Folie PET i PVC" ?></option>
							<option value="64"  <?php echo $shop_cat == 64 ? 'selected="selected"' : ''; ?>  ><?php echo "Folia - Ochronne - samoprzylepne" ?></option>
							
							<option value="67"  <?php echo $shop_cat == 67 ? 'selected="selected"' : ''; ?>  ><?php echo "Maty ochronne" ?></option>
							<option value="63"  <?php echo $shop_cat == 63 ? 'selected="selected"' : ''; ?>  ><?php echo "Płyty kanalikowe z polipropylenu" ?></option>
							<option value="62"  <?php echo $shop_cat == 62 ? 'selected="selected"' : ''; ?>  ><?php echo "PVC spienione" ?></option>
							<option value="65"  <?php echo $shop_cat == 65 ? 'selected="selected"' : ''; ?>  ><?php echo "Asfalt workowany" ?></option>
							<option value="13"  <?php echo $shop_cat == 13 ? 'selected="selected"' : ''; ?>  ><?php echo "Wyprzedaż" ?></option>
							
							
							
							
						
						
						</select>
						<input type="hidden" name="kat_id_tow" value="<?php echo $id_tow; ?>" />
					</form>
				
				</td>
				
				<td class="col-md-0">
					
					<form action="" method="post"  class="form-inline">
						<select name="dostawa" class="form-control input-sm small" onchange="this.form.submit()" style="width: 130px;" >
							<option value="999"  <?php echo $shop_delivery == 999 ? 'selected="selected"' : ''; ?>  ><?php echo "Brak" ?></option>
							<option value="2"  <?php echo $shop_delivery == 2 ? 'selected="selected"' : ''; ?>  ><?php echo "2 dni" ?></option>
							<option value="6"  <?php echo $shop_delivery == 6 ? 'selected="selected"' : ''; ?>  ><?php echo "10 dni" ?></option>
							<option value="8"  <?php echo $shop_delivery == 8 ? 'selected="selected"' : ''; ?>  ><?php echo "45 dni" ?></option>
							
						</select>
						<input type="hidden" name="deliv_id_tow" value="<?php echo $id_tow; ?>" />
					</form>
				</td>
				
				<td class="col-md-1">
					
					<form action="" method="post"  class="form-inline">
						<select name="dostawa_typ" class="form-control input-sm small" onchange="this.form.submit()" style="width: 130px;" >
							<option value="0"  <?php echo $shop_delivery_typ == 0 ? 'selected="selected"' : ''; ?>  ><?php echo "Brak" ?></option>
							<option value="15"  <?php echo $shop_delivery_typ == 15 ? 'selected="selected"' : ''; ?>  ><?php echo "DPD - 20" ?></option>
							<option value="16"  <?php echo $shop_delivery_typ == 16 ? 'selected="selected"' : ''; ?>  ><?php echo "DPD - 40" ?></option>
							<option value="17"  <?php echo $shop_delivery_typ == 17 ? 'selected="selected"' : ''; ?>  ><?php echo "Paleta" ?></option>
							<option value="18"  <?php echo $shop_delivery_typ == 18 ? 'selected="selected"' : ''; ?>  ><?php echo "Własny RB" ?></option>
							<option value="11"  <?php echo $shop_delivery_typ == 11 ? 'selected="selected"' : ''; ?>  ><?php echo "Osobisty" ?></option>
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
				<?php $current_encoding = mb_detect_encoding($shop_name, 'auto');
				echo $current_encoding ;
				?>
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
