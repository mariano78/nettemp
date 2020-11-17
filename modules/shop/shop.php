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
$akcja = 5;

// 1. Pobieramy z bazy oracle dane o produkcie 
// 2. Sprawdzamy czy w shoperze istnieje produkt z kodem z oracle - dodajemy lub aktualizujemy 
$time_pre = microtime(true);
$stid = oci_parse($conn, 'SELECT * FROM INFOR_SHOPER_EXP');
oci_execute($stid);



while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
	
	
	$kod = $row['TO_KOD']; //kod towaru w RB
	$ean = $row['TO_KK_1']; // kod ean
	$nazwa = $row['TO_NAZWA']; //nazwa z jfox
	$kategoria = 1; // kategoria w shoper
	$stan = floor($row['STAN']); // dostępna ilosć towaru
	
	if ($stan < 0) $stan = 0; // dla stanu poniżej 0
	
	$podatek_jfox = $row['TO_VAT_CODE'];
	if($podatek_jfox == '51') $podatek = 1; $mnoznik = 1.23; //przypisanie podatku jfox->shoper
	
	$jed_miar_jfox = $row['TO_JM'];
	if($jed_miar_jfox == 'SZT') $jedmiar = 1; //przypisanie jednostki miary jfox->shoper
	
	$cena = $row['CEN_F01'] * $mnoznik; //cena * podatek VAT
	if ($cena == 0) $akcja = 0; // jeśli = 1 to wykonujemy akcję aktulizacja lub dodanie
	
	
	$opis = 'To jest opis produktu';
	$aktywnosc = true;
	
	$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
	//filtry
	
	$resource->filters(['stock.code'=> ['LIKE'=> $kod]]);
    $result = $resource->get();
	//var_dump($result);
	$count = $result->count;
	
	if ($count == '0' && $akcja != 0) {
			
			echo "Dodaje produkt - ".$kod."\n";
			
			$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
			$data = array(
				'category_id' => $kategoria,
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
				'stock' => $stan
			),
			'tax_id' => 1,
			'code' => $kod,
        '	unit_id' => $jedmiar
			);
			
    $result = $resource->post($data);

    printf("An object has been added #%d \n", $result);
	$dodanych++;

			
	
		} elseif ($akcja != 0){

				foreach($result as $r){
		
					$kod_shop = $r->stock->code;

					echo '<br>--'.$kod_shop.'--';
		
					if ($kod == $kod_shop) {
			
					echo 'Aktualizuję produkt - '.$kod.'<br>';
					echo 'kodshopera to '.$kod_shop;
					$id = $r->product_id;
					echo $r->category_id;
					echo $r->translations->pl_PL->name;
					echo $r->stock->code;
					echo $r->stock->ean.'<br>';
		
					$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
					//$id = 1;
					$data = array(
						'category_id' => $kategoria,
						'translations' => array(
							'pl_PL' => array(
							'name' => $nazwa,
							'description' => $opis,
							'active' => $aktywnosc
							)
						),
						'stock' => array(
							'price' => 0,
							'active' => 1,
							'stock' => $stan
							),
						'tax_id' => 1,
						'code' => $kod,
						'unit_id' => $jedmiar
					);

				$result = $resource->put($id, $data);

				if($result){
					echo 'A product has been successfully updated';
					$aktualizowanych++;
				}
		
		
			}
		
		}	
	} 
}//while

 echo 'Akt - '.$aktualizowanych; 
 echo 'Dod - '.$dodanych;

oci_free_statement($stid);
oci_close($conn);
	
$time_post = microtime(true);
$exec_time = $time_post - $time_pre;

$duration = $time_post-$time_pre;
$hours = (int)($duration/60/60);
$minutes = (int)($duration/60)-$hours*60;
$seconds = (int)$duration-$hours*60*60-$minutes*60;
  
$db->exec("UPDATE shop SET value='$exec_time' WHERE option='etime'");
echo ' --- '.$hours.' --- ';
echo ' --- '.$minutes.' --- ';
echo ' --- '.$seconds.' --- ';
 

?>