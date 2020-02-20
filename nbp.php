<?php



try {
 
	
	
	$url = "http://api.nbp.pl/api/exchangerates/rates/a/EUR/last/100/?format=json";
	$json = file_get_contents($url);
	
	$obj = json_decode($json,true);
	//var_dump($obj);
	
	foreach ($obj as $value) {
		
		echo $value;
		
	}
	
	
	} catch (Exception $e) {
    echo $date." Error.\n";
    echo $e;
    exit;
}
?>

