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
$www_serwer = "http://robelit.pl/";



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
		$file_list = ftp_nlist($conn, $ean);
		
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
					printf("#%d - %s\n", $r_img->gfx_id, $r_img->name);
					
					$resource = new DreamCommerce\ShopAppstoreLib\Resource\ProductImage($client);
					//$id = 1;
					$result_del_img = $resource->delete($gfx_id);

					if($result_del_img){
						echo 'An image has been successfully deleted';
					}
				}
			} else { 
			//usuwam zdjecia
			
			// dodaje zdjęcia
				echo "Brak zdjęc - dodaje nowe\n";
				var_dump($file_list);
			
				foreach ($file_list as $file)
				{
				  
				  $ext = substr($file, -4);//sprawdzam rozszerzenie
				  $img_name = substr($file, 0, 13);//sprawdzam rozszerzenie
				  
				  if ($ext == '.jpg'){
					  
					  echo "$ext \n";
					  
				  }
				  
					$resource = new DreamCommerce\ShopAppstoreLib\Resource\ProductImage($client);
					$data = array(
						'product_id' => $id,
						'file' => $img_name.$ext,
						'url' => $www_serwer.$img_name
						'translations' => array(
							'pl_PL' => array(
								'name' => 'opis'
							)
						)
					);

					$id = $resource->post($data);

					printf("An object has been added #%d", $id);
				  
				}
			
			}
			// dodaje zdjęcia
			
			
			
			
			
			
			
		} // jesli nie ma folderu/plikow zrob else i logi
		
		
		
		
		
		
		
    }
	// dla każdego produktu w shoperze
	
	ftp_close($conn); //close ftp
	
}



?>