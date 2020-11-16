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

// 1. Pobieramy z bazy oracle dane o produkcie 
// 2. Sprawdzamy czy w shoperze istnieje produkt z kodem z oracle - dodajemy lub aktualizujemy 

$stid = oci_parse($conn, 'SELECT * FROM INFOR_SHOPER_EXP');
oci_execute($stid);



while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
	
	
	$kod = $row['TO_KOD'];
	$ean = $row['TO_KK_1'];
	$nazwa = $row['TO_NAZWA'];
	$kategoria = 1;
	$cena = $row['CEN_F01']* 1.23; //zrobić ifa na stawki vat
	$stan = floor($row['STAN']);
	if ($stan < 0) {$stan = 0};
	$podatek = 1; //zrobić ifa
	$jedmiar = 1; //zrobić ifa
	
	$opis = 'To jest opis produktu';
	$aktywnosc = true;
	
	
	
	echo 'Kod oracle - '.$kod.'<br>';
		
	$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
	//filtry
	
	$resource->filters(['stock.code'=> ['LIKE'=> $kod]]);
	
    $result = $resource->get();
	//var_dump($result);
	$count = $result->count;
	
	if ($count == '0') {
			
			echo 'Dodaje produkt - '.$kod.'<br>';
			
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
        'unit_id' => $jedmiar
    );
    $result = $resource->post($data);

    printf("An object has been added #%d", $result);
			
			
			
			
			
			
			
		} else {
		
	

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
            'price' => $cena,
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
    }
		
		
		}
		
    }
		}
	
    
}

oci_free_statement($stid);
oci_close($conn);
	

 
  

 

?>