<?php

var_dump($argv);
parse_str($argv[1],$single_code);
$code_to_update=$single_code['c'];

//echo $code_to_update;



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
$db2->exec("DELETE FROM logs");

$www_serwer = "http://robelit.home.pl/shop_img/";

$resource = new DreamCommerce\ShopAppstoreLib\Resource\Product($client);
	if ($code_to_update == 'all'){
		
						$resource->filters(['translations.pl_PL.active'=>true]);
	}else {
						$resource->filters([
							'translations.pl_PL.active' =>true,
							'stock.code' =>['LIKE' => $code_to_update]
						]);
	}
	$currentPage = 1;
	$currentProd = 1;;
	$result = $resource->get();
	//var_dump($result);
	
	$pages = $result->pages;
	
while($currentPage <= $result->getPageCount() ){
	  
	  $result = $resource->page($currentPage)->limit(50)->get();
	
				//var_dump($result);
				$count = $result->count;
				echo "count_".$count."\n";

			if ($count != '0') {
				
				$ftp_host = "robelit.home.pl";
				$ftp_user = $shopftp;
				$ftp_password = $shopftppass;

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
					//$filteredFiles = preg_grep( '/\.jpg$/i', $file_list );
					//sort($filteredFiles);
					
					if($file_list) { // czy jest folder na FTP
					
						$filteredFiles = preg_grep( '/\.jpg$/i', $file_list );
						sort($filteredFiles);
						
						//1. sprawdzam czy sa zdjecia, jesli sa usuwam
						$resource_img = new DreamCommerce\ShopAppstoreLib\Resource\ProductImage($client);
						//filtry
						$resource_img->filters(['product_id'=> ['LIKE'=> $id]]);
						$result_img = $resource_img->get();
						
						$count_img = $result_img->count;
						//echo "count_img_".$count_img."\n";
						
						//usuwam zdjecia
						if ($count_img != 0){

							foreach($result_img as $r_img){
								$gfx_id = $r_img->gfx_id;
								$resource_del_gfx = new DreamCommerce\ShopAppstoreLib\Resource\ProductImage($client);
								$result_del_img = $resource_del_gfx->delete($gfx_id);
								if($result_del_img){
									echo "Usunięto zdjęcie dla produktu ", $kod." \n";
								}
							}
						//usuwam zdjecia
							// dodaje zdjęcia
							foreach ($filteredFiles as $file)
							{
								//echo "-----file-----".$file;
								$ext = substr($file, -4);//sprawdzam rozszerzenie
								$img_name = substr($file, 0, 13);//sprawdzam rozszerzenie
								$img_name2 = substr($file, strpos($file, "_") + 1);    
							  
								$resource_add_gfx = new DreamCommerce\ShopAppstoreLib\Resource\ProductImage($client);
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
								
								$idz = $resource_add_gfx->post($data);
								
								if($idz){
									$date = date('H:i:s');
									echo "Dodano zdjęcie do produktu ", $kod." \n";
									logs_shop($date, 'Info', "Dodano zdjęcie do produktu ". $kod);
								}
							}
							} else { 
						
						
						// dodaje zdjęcia
							foreach ($filteredFiles as $file)
							{
								//echo "-----file-----".$file;
								$ext = substr($file, -4);//sprawdzam rozszerzenie
								$img_name = substr($file, 0, 13);//sprawdzam rozszerzenie
								$img_name2 = substr($file, strpos($file, "_") + 1);    
							  
								$resource_add_gfx = new DreamCommerce\ShopAppstoreLib\Resource\ProductImage($client);
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
								
								$idz = $resource_add_gfx->post($data);
								
								if($idz){
								$date = date('H:i:s');
								echo"Dodano zdjęcie do produktu ", $kod." \n";
								logs_shop($date, 'Info', "Dodano zdjęcie do produktu ". $kod);
								}
							  
							}
						
						}
						// dodaje zdjęcia
							
					} else {
						
						echo "Nie ma folderu FTP dla produktu ", $kod." \n";
						
						logs_shop($date, 'errorimg', "Brak zdjeć-".$kod."-".$ean."-".$prod_name);
						
						
						
					}// jesli nie ma folderu/plikow zrob else i logi
	
				}
				// dla każdego produktu w shoperze
				
				ftp_close($conn); //close ftp
				$currentPage++;
				
			}  
}
$sth_log = $db2->query("SELECT * FROM logs WHERE type = 'errorimg'");
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
			 <p>Raport automatyczny - brakujące zdjecia w sklepie www.robelit.pl</p><br>
			 <table border="1" style="">
			 <tr><th>Lp.</th><th>Kod Produktu</th><th>EAN</th><th>Nazwa</th><th>Zdjecia</th></tr>';
			 
	
	

$lp = 1;
foreach ($result_log as $log) {
	//logs_shop($date, 'errorimg', "Brak zdjeć-".$kod."-".$ean."-".$prod_name);
	
	
	$mess_log =  $log['message'];
	$sklad = explode("-", $mess_log);
	
	
	$log_kod = $sklad[1];
	$log_ean = $sklad[2];
	$log_nazwa = $sklad[3];
	
	
	
	$body .= '<tr><td>'.$lp.'</td><td>'.$log_kod.'</td><td>'.$log_ean.'</td><td>'.$log_nazwa.'</td><td>Brak</td></tr>';
	$lp ++;
}
$lp = 0;
$body .= '</table></div></body></html>';

if ( mail ('musik@robelit.pl', 'Shoper raport - brakujące zdjęcia', $body, $headers ) ) {
							echo "Mail send OK\n";
						} else {
						echo "Mail send problem\n";
						}



$db2->exec("DELETE FROM logs");
//koniec

?>