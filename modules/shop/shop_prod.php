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
$licz_produkt = 1;

$db->exec("UPDATE shop SET value='$syncstatus' WHERE option='syncstatus'");
$db2->exec("DELETE FROM logs");

// 1. Pobieramy z bazy oracle dane o produkcie 
// 2. Sprawdzamy czy w shoperze istnieje produkt z kodem z oracle - dodajemy lub aktualizujemy 
$time_pre = microtime(true);
$stid = oci_parse($conn, 'SELECT * FROM INFOR_SHOPER_EXP_3');
oci_execute($stid);



while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
	
	$kod = $row['TO_KOD']; //kod towaru w RB
	$ean = $row['TO_KK_1']; // kod ean
	$nazwa = $row['TO_NAZWA']; //nazwa z jfox
	$nazwa_shop = $row['SHOP_NAME']; //nazwa z jfox
	$in_shop = $row['IN_SHOP'];
	$to_grupa = $row['TO_GRUPA'];
	$jed_miar_jfox = $row['TO_JM'];
	$to_opa3a = $row['TO_OPA3'];
	$to_opa3 = $to_opa3a/1000;
	$cena = $row['CEN_F01'];
	$stan = $row['STAN']; // dostępna ilosć towaru
	$kategoria = $row['CATEGORY']; // kategoria w shoper
	$kategoria2 = $row['CATEGORY2']; // kategoria w shoper 2
	$delivery = $row['DELIVERY']; // czas dostawy
	$delivery3 = $row['DELIVERY3']; // czas dostawy dla spz
	$delivery2 = $row['DELIVERY2']; // rodzaj przewoźnika
	$to_status = $row['STATUS']; // rodzaj przewoźnika
	$to_spz2 = $row['SHOP_SPZ'];
	$to_opis = $row['SHOP_OPIS']->load(); // opis towaru
	$to_related = $row['SHOP_LINKED']; // indeksy towarów powiązanych rozdzielane ; - srednik
	
	$to_related_inshop = array() ;
	$to_kategorie_inshop = array();
	
	//$to_order_inshop = 0;
	//$kat = array(75,76,77,78,74,73,79,80,81,82,83,84,85,86,91,92,87,88,89,90);
	//if (in_array($kategoria, $kat)) {
	//	$to_order_inshop = 100;
	//}
	
	
	if (!empty($kategoria) && !empty($kategoria2) && $kategoria !=999 && $kategoria2 !=999) {
		
		$to_kategorie_inshop[] = $kategoria;
		$to_kategorie_inshop[] = $kategoria2;
		
		array_walk($to_kategorie_inshop, function(int &$int){;});
		
	}

	if (empty($to_opis)){
		
		$to_opis = 'To jest opis produktu';
	}
	
	$cut_to_opis = substr($to_opis, 0, 3);
	if  ($cut_to_opis != '<p>'){
		
		$to_opis = '<p style="text-align: justify;">'.$to_opis.'</p>';
		
	}
	
	
	
	
	
	if ($nazwa_shop != ''){
		$nazwa = $nazwa_shop;
	}
	
	$seo_name = pl_charset($nazwa).'-'.$kod.'.html'; // link seo w shoperze

	
	
	$podatek_jfox = $row['TO_VAT_CODE'];
	if($podatek_jfox == '51') $podatek = 1; $mnoznik = 1.23; //przypisanie podatku jfox->shoper
	
	//if($jed_miar_jfox == 'SZT') 
	
	$jedmiar = 1; //przypisanie jednostki miary jfox->shoper  1 - sztuka
	
//****************************************************Przeliczanie cen i stanów**********************************

if ($to_grupa == 'PCB' OR $to_grupa == 'AKRYL' OR $to_grupa == 'PVCSP'){
	
		if ($jed_miar_jfox == 'M2'){
			
			$cena = $cena * $to_opa3 ;
			$stan = $stan / $to_opa3;
		}
}

if ($to_grupa == 'IZOLK' OR $to_grupa == 'PLSRU' OR $to_grupa == 'IZOLM' OR $to_grupa == 'FOLOCH' OR $to_grupa == 'FOLBU' OR $to_grupa == 'PLSOG' OR $to_grupa == 'FOLRU' OR $to_grupa == 'OGRAG' OR $to_grupa == 'PLSRP'){
	
		if ($jed_miar_jfox == 'MB'){
			
			$cena = $cena * $to_opa3 ;
			$stan = $stan / $to_opa3;
		}
}


if ($kod == 'HPL00001'){
	
		if ($jed_miar_jfox == 'M2'){
			
			$cena = $cena * $to_opa3 ;
			$stan = $stan / $to_opa3;
		}
}


//if ($to_status == 'spz'){}
//****************************************************Przeliczanie cen i stanów**********************************
	
	$stan = floor($stan); // dostępna ilosć towaru
	if ($stan < 0) $stan = 0; // dla stanu poniżej 0
	$cena = $cena * $mnoznik; //cena * podatek VAT
	
	//jaka dostępność towaru
	if ($to_status == 'spz' &&  $to_spz2 == 'Y' && $stan == 0){
			$av_id = 6; // id z shopera - na zamowienie
		if ($delivery3 != 999){
				$delivery = $delivery3; // bierzemy czas dostawy z drugiego pola
		}
	}else {
		$av_id = '';
	}
	
	if ($cena >=5){  //zaokraglanie w górę dla cen większych niż 10 pln
		
		$cena = ceil($cena);
	}
	
	//zaokraglanie w górę
	$ean_lenght = strlen($ean); // sprawdza dlugosc eanu
	
	($cena == 0 OR $ean_lenght != 13 OR $kategoria == 999 OR $delivery == 999 OR $delivery2 == 999) ? $akcja = 0 : $akcja = 1;  // jeśli = 1 to wykonujemy akcję aktulizacja lub dodanie
	
	$date = date('H:i:s');
	if ($akcja == 0) {
		logs_shop($date, 'error', "Brak parametru-".$kod."-".$nazwa."-".$ean."-".$kategoria."-".$delivery."-".$delivery2."-".$cena."-".$in_shop);
		$pominietych++;
		}
	
	$waga = floatval($row['TO_MASA']); // waga produktu
	$szerokosc = $row['TO_SZEROKOSC']; // szerokosc produktu - width
	$dlugosc = $row['TO_DLUGOSC']; // długosc produktu
	
	
	//$opis = 'To jest opis produktu';
	
	if ($in_shop == 'T'){
		$aktywnosc = true;
	}else {
		$aktywnosc = false;
	}
	
	// obróbka prduktów powiązanych  - działa tylko dla aktualizacji
	if ($to_related != ''){
		
		$to_related2 = explode(";",$to_related);
		$resource_rel = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
		
		foreach($to_related2 as $to_rel){ // znajdź id z shopera i wstaw do stringa
		
			//$resource_rel = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
			//filtry
			
			$resource_rel->filters(['stock.code'=> ['LIKE'=> $to_rel]]);
			$result_rel = $resource_rel->get();
			
				foreach($result_rel as $rrel){
					$to_rel2 = $rrel->product_id;
					$to_related_inshop[]=$to_rel2;
				}
		}
	
	}
	 array_walk($to_related_inshop, function(int &$int){;});
	 $to_related_inshop = array_unique($to_related_inshop);
	 

		
	$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
	//filtry
	
	$resource->filters(['stock.code'=> ['LIKE'=> $kod]]);
    $result = $resource->get();
	//var_dump($result);
	$count = $result->count;
	
//***************************************************Dodawanie***************************************************

	if ($count == '0' && $akcja != 0) {
			
			logs_shop($date, 'Info', "Dodaję produkt ".$kod);
			echo $licz_produkt.". Dodaję produkt - ".$kod."\n";
			
			$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
			$data = array(
						'category_id' => $kategoria,
						'ean' => $ean,
						'dimension_w' => $szerokosc,
						'dimension_h' => $dlugosc,
						'gauge_id' => $delivery2,
						'translations' => array(
							'pl_PL' => array(
							'name' => $nazwa,
							'description' => $to_opis,
							'seo_url' => $seo_name,
							'active' => $aktywnosc
							)
						),
						'stock' => array(
							'price' => $cena,
							'active' => 1,
							'stock' => $stan,
							'weight' => $waga,
							'availability_id' => $av_id, 
							'delivery_id' => $delivery 
							),
						'tax_id' => $podatek,
						'code' => $kod,
						'unit_id' => $jedmiar,
						'categories' => $to_kategorie_inshop
						
						
					);
					
		
					$result = $resource->post($data);
	
				if($result){
					echo "Dodano produkt ". $kod." \n";
					logs_shop($date, 'Info', "Dodano produkt ". $kod);
					$dodanych++;
					$licz_produkt++;
				}
//***************************************************Aktualizacja***************************************************
		} elseif ($akcja != 0){

				foreach($result as $r){
		
					$kod_shop = $r->stock->code;
		
					if ($kod == $kod_shop) {
						echo $licz_produkt.". Aktualizuję produkt - ".$kod." \n";
						logs_shop($date, 'Info', "Aktualizuję produkt ". $kod);
						$id = $r->product_id;
						//echo 'ID:'.$id;
					
					$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
					$data = array(
						//'related' => [1597,1628],
						'category_id' => $kategoria,
						'ean' => $ean,
						'dimension_w' => $szerokosc,
						'dimension_h' => $dlugosc,
						'gauge_id' => $delivery2,
						
						'translations' => array(
							'pl_PL' => array(
							'name' => $nazwa,
							'description' => $to_opis,
							'seo_url' => $seo_name,
							//'order' => $to_order_inshop,
							'active' => $aktywnosc
							)
						),
						'stock' => array(
							'price' => $cena,
							'active' => 1,
							'stock' => $stan,
							'weight' => $waga,
							'availability_id' => $av_id,
							'delivery_id' => $delivery
							),
						'tax_id' => $podatek,
						'code' => $kod,
						'unit_id' => $jedmiar,
						'categories' => $to_kategorie_inshop
						
					);

					$result = $resource->put($id, $data);
					if (!empty($to_related)){
							$resourcea2 = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
							$data2 = array(
								'related' => $to_related_inshop
							);

							$resulta2 = $resourcea2->put($id, $data2);
							
					}

				if($result){
					echo "Zaktualizowano produkt ". $kod." \n";
					logs_shop($date, 'Info', "Zaktualizowano produkt ". $kod);
					$aktualizowanych++;
					$licz_produkt++;
				}
				if($resulta2){
					echo "Zaktualizowano powiazane dla ". $kod." \n";
				}
				
				
			}
		}	
	} 
}//while

echo "\nZaktualizowano - ".$aktualizowanych."\n"; 
echo "Dodano - ".$dodanych."\n";
echo "Pominięto - ".$pominietych."\n";

oci_free_statement($stid);
oci_close($conn);
	
$time_post = microtime(true);
$exec_time = $time_post - $time_pre;
$duration = $time_post-$time_pre;
$hours = (int)($duration/60/60);
$minutes = (int)($duration/60)-$hours*60;
$seconds = (int)$duration-$hours*60*60-$minutes*60;

$syncstatus = 1; // aktualizacja stanu synchronizacji
  
$db->exec("UPDATE shop SET value='$exec_time' WHERE option='etime'");
$db->exec("UPDATE shop SET value='$syncstatus' WHERE option='syncstatus'");



$sth_log = $db2->query("SELECT * FROM logs WHERE type = 'error'");
$sth_log->execute();
$result_log = $sth_log->fetchAll();

	$headers .= "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	$body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
			 <html>
			 <head>
			 <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	         <style>* { margin: 0; padding: 0; } a {text-decoration: none;} th, td {  padding: 5px;} table, th, td { border: 1px solid black;  border-collapse: collapse;} * {font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;}</style>
			 </head>
			 <table border="1" style="">
			 <tr><th>Lp.</th><th>Kod Produktu</th><th>Nazwa</th><th>EAN</th><th>W sklepie?</th><th>Kategoria</th><th>Czas wysyłki</th><th>Przewoźnik</th><th>Cena</th></tr>';
			 
	
	
$count2 = $result_log->count;
$lp = 1;
if ($count2 > 0){
	
	foreach ($result_log as $log) {
		//logs_shop($date, 'error', "Brak parametru-".$kod."-".$nazwa."-".$ean."-".$kategoria."-".$delivery."-".$delivery2."-".$cena );
		
		
		$mess_log =  $log['message'];
		$sklad = explode("-", $mess_log);
		$log_kod = $sklad[1];
		$log_nazwa = $sklad[2];
		
		//$log_kategoria = $sklad[4];
		//$log_delivery = $sklad[5];
		//$log_delivery2 = $sklad[6];
		//$log_cena = $sklad[7];
		($sklad[3] == '') ? $log_ean = 'Brak EAN' : $log_ean = $sklad[3];
		($sklad[4] == '999') ? $log_kategoria = 'Brak' : $log_kategoria = '';
		($sklad[5] == '999') ? $log_delivery  = 'Brak' : $log_delivery = '';
		($sklad[6] == '999') ? $log_delivery2 = 'Brak' : $log_delivery2 = '';
		($sklad[7] == '') ? $log_cena = 'Brak' : $log_cena = $sklad[7];
		$log_aktywny = $sklad[8];
		
		
		$body .= '<tr><td>'.$lp.'</td><td>'.$log_kod.'</td><td>'.$log_nazwa.'</td><td>'.$log_ean.'</td><td>'.$log_aktywny.'</td><td>'.$log_kategoria.'</td><td>'.$log_delivery.'</td><td>'.$log_delivery2.'</td><td>'.$log_cena.'</td></tr>';
		$lp ++;
	}
	$lp = 0;
	$body .= '</table></div></body></html>';
	$odbiorcy = '';
	$dzien = date("D"); 

	if (date('H') == 13 && ($dzien == 'Fri' OR $dzien == 'Mon') ){
		$odbiorcy = 'musik@robelit.pl;mikolajczyk@robelit.pl';
	}else {
		$odbiorcy = 'musik@robelit.pl';
	}

	if ( mail ($odbiorcy, 'Shoper - raport produktów do uzupełnienia', $body, $headers ) ) {
								echo "Mail send OK\n";
							} else {
							echo "Mail send problem\n";
							}

} else if($count2 == 0 AND ((date('H') == 8) OR (date('H') == 20)) ){
	
	if ( mail ('musik@robelit.pl', 'Shoper - synchronizacja OK', 'Synchronizacja przebiegla pomyslnie' ) ) {
								echo "Mail send OK\n";
							} else {
							echo "Mail send problem\n";
							}
	
	
}

$db2->exec("DELETE FROM logs");

echo "W czasie: ";
echo $hours." h ";
echo $minutes." m ";
echo $seconds." s \n";
 

?>