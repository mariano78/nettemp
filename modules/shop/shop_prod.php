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

// 1. Pobieramy z bazy oracle dane o produkcie 
// 2. Sprawdzamy czy w shoperze istnieje produkt z kodem z oracle - dodajemy lub aktualizujemy 
$time_pre = microtime(true);
$stid = oci_parse($conn, 'SELECT * FROM INFOR_SHOPER_EXP_2');
oci_execute($stid);



while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
	
	
	$kod = $row['TO_KOD']; //kod towaru w RB
	$ean = $row['TO_KK_1']; // kod ean
	$nazwa = $row['TO_NAZWA']; //nazwa z jfox
	$nazwa_shop = $row['SHOP_TO_NAME']; //nazwa z jfox
	
	if ($nazwa_shop != ''){
		
		$nazwa = $nazwa_shop;
	}
	
	$kategoria = $row['CATEGORY']; // kategoria w shoper
	$stan = floor($row['STAN']); // dostępna ilosć towaru
	
	if ($stan < 0) $stan = 0; // dla stanu poniżej 0
	
	$podatek_jfox = $row['TO_VAT_CODE'];
	if($podatek_jfox == '51') $podatek = 1; $mnoznik = 1.23; //przypisanie podatku jfox->shoper
	
	$jed_miar_jfox = $row['TO_JM'];
	if($jed_miar_jfox == 'SZT') $jedmiar = 1; //przypisanie jednostki miary jfox->shoper
	
	$cena = $row['CEN_F01'] * $mnoznik; //cena * podatek VAT
	$ean_lenght = strlen($ean); // sprawdza dlugosc eanu
	
	($cena == 0 OR $ean_lenght != 13) ? $akcja = 0 : $akcja = 1;  // jeśli = 1 to wykonujemy akcję aktulizacja lub dodanie
	
	$date = date('H:i:s');
	if ($akcja == 0) {
		logs_shop($date, 'error', "Produkt nie spełnia wymagań ".$kod);
		$pominietych++;
		}
	
	$waga = floatval($row['TO_MASA']); // waga produktu
	$szerokosc = $row['TO_SZEROKOSC']; // szerokosc produktu - width
	$dlugosc = $row['TO_DLUGOSC']; // długosc produktu
	
	
	$opis = 'To jest opis produktu';
	$aktywnosc = true;
	
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
						'translations' => array(
							'pl_PL' => array(
							'name' => $nazwa,
							'description' => $opis,
							'active' => $aktywnosc
							)
						),
						'stock' => array(
							'price' => $cena,
							'active' => 1,
							'stock' => $stan,
							'weight' => $waga
							),
						'tax_id' => $podatek,
						'code' => $kod,
						'unit_id' => $jedmiar
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
					
					$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
					$data = array(
						'category_id' => $kategoria,
						'ean' => $ean,
						'dimension_w' => $szerokosc,
						'dimension_h' => $dlugosc,
						'translations' => array(
							'pl_PL' => array(
							'name' => $nazwa,
							'description' => $opis,
							'active' => $aktywnosc
							)
						),
						'stock' => array(
							'price' => $cena,
							'active' => 1,
							'stock' => $stan,
							'weight' => $waga
							),
						'tax_id' => $podatek,
						'code' => $kod,
						'unit_id' => $jedmiar
					);

					$result = $resource->put($id, $data);

				if($result){
					echo "Zaktualizowano produkt ". $kod." \n";
					logs_shop($date, 'Info', "Zaktualizowano produkt ". $kod);
					$aktualizowanych++;
					$licz_produkt++;
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

echo "W czasie: ";
echo $hours." h ";
echo $minutes." m ";
echo $seconds." s \n";
 

?>