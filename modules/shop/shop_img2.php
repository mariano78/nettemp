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
	
	
	 foreach($result as $r){
        printf("#%d - %s\n", $r->product_id, $r->translations->pl_PL->name);
		$ean = $r->stock->ean;
		$file_list = ftp_nlist($conn, $ean);
		var_dump($file_list);
		foreach ($file_list as $file)
		{
		  
		  $ext = substr($file, -4);//sprawdzam rozszerzenie
		  
		  if ($ext == '.jpg'){
			  
			  echo "$ext \n";
			  
		  }
		  
		}
		
		
		
		
    }
	//close
	ftp_close($conn);
	
}



?>