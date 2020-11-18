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
$www_serwer = "http://robelit.pl/shopimg/";



$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
	//filtry
	//$resource->filters(['stock.code'=> ['LIKE'=> $kod]]);
    $result = $resource->get();
	//var_dump($result);
	$count = $result->count;
	echo "count_".$count."\n";

if ($count != '0') {
	
	$ftp_host = "robelit.home.pl";
	$ftp_user = "shoper@robelit.pl";
	$ftp_password = "Ala1Ala2";

	//Connect
	echo "\n";
	echo "Connecting to $ftp_host via FTP... \n";
	$conn = ftp_connect($ftp_host);
	$login = ftp_login($conn, $ftp_user, $ftp_password);
	$mode = ftp_pasv($conn, TRUE); //Enable PASV ( Note: must be done after ftp_login() )
	if ((!$conn) || (!$login) || (!$mode)) { //Login OK ?
	   die("FTP connection has failed ! \n");
	}
	echo "Login Ok. \n";
	
	// dla każdego produktu w shoperze 
	 foreach($result as $r){
        printf("#%d - %s\n", $r->product_id, $r->translations->pl_PL->name);
		$ean = $r->stock->ean;
		$id = $r->product_id;
		$kod = $r->code;
		$prod_name = $r->translations->pl_PL->name;
		$file_list = ftp_nlist($conn, $ean);
		$filteredFiles = preg_grep( '/\.jpg$/i', $file_list );
		sort($filteredFiles);
		if($file_list) {
			
			//1. sprawdzam czy sa zdjecia, jesli sa usuwam
			$resource = new DreamCommerce\ShopAppstoreLib\Resource\ProductImage($client);
			//filtry
			$resource->filters(['product_id'=> ['LIKE'=> $id]]);
			$result_img = $resource->get();
			
			$count_img = $result_img->count;
			echo "count_img_".$count_img."\n";
			
			//usuwam zdjecia
			if ($count_img != 0){

				foreach($result_img as $r_img){
					$gfx_id = $r_img->gfx_id;
					$resource = new DreamCommerce\ShopAppstoreLib\Resource\ProductImage($client);
					$result_del_img = $resource->delete($gfx_id);
					if($result_del_img){
						echo 'An image has been successfully deleted';
					}
				}
			//usuwam zdjecia
				// dodaje zdjęcia
				foreach ($filteredFiles as $file)
				{
					$ext = substr($file, -4);//sprawdzam rozszerzenie
					$img_name = substr($file, 0, 13);//sprawdzam rozszerzenie
					$img_name2 = substr($file, strpos($file, "_") + 1);    
				  
					$resource = new DreamCommerce\ShopAppstoreLib\Resource\ProductImage($client);
					$data = array(
						'product_id' => $id,
						//'file' => $file,
						'url' => $www_serwer.$file,
						'translations' => array(
							'pl_PL' => array(
								'name' => $prod_name
							)
						)
					);
					
					$idz = $resource->post($data);
					
					if($idz){
						$date = date('H:i:s');
						printf("Dodano zdjęcie do produktu #%d", $kod);
						logs_shop($date, 'Info', "Dodano zdjęcie do produktu ". $kod);
					}
				}
				} else { 
			
			
			// dodaje zdjęcia
				foreach ($filteredFiles as $file)
				{
					$ext = substr($file, -4);//sprawdzam rozszerzenie
					$img_name = substr($file, 0, 13);//sprawdzam rozszerzenie
					$img_name2 = substr($file, strpos($file, "_") + 1);    
				  
					$resource = new DreamCommerce\ShopAppstoreLib\Resource\ProductImage($client);
					$data = array(
						'product_id' => $id,
						//'file' => $file,
						'url' => $www_serwer.$file,
						'translations' => array(
							'pl_PL' => array(
								'name' => $prod_name
							)
						)
					);
					
					$idz = $resource->post($data);
					
					if($idz){
					$date = date('H:i:s');
					printf("Dodano zdjęcie do produktu #%d", $kod);
					logs_shop($date, 'Info', "Dodano zdjęcie do produktu ". $kod);
					}
				  
				}
			
			}
			// dodaje zdjęcia
			
			
			
			
			
			
			
		} // jesli nie ma folderu/plikow zrob else i logi
		
		
		
		
		
		
		
    }
	// dla każdego produktu w shoperze
	
	ftp_close($conn); //close ftp
	
}



?>