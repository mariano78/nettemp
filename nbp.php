<?php
$ROOT=dirname(dirname(dirname(__FILE__)));
define("LOCAL","local");
 
include("$ROOT/receiver.php");	

try {
    $db = new PDO("sqlite:$ROOT/dbf/nettemp.db");
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $date." Could not connect to the database.\n";
    exit;
}


try {
 
	
	
	
	foreach ($result as $vr) {
		
		
	if (substr($vr['type'],0,3) == 'air'){
			
			$lati = $vr['latitude'];
			$long = $vr['longitude'];
			$api = $vr['apikey'];
			$localid = $vr['id'];
			$local_rom = $vr['rom'];
			$local_type = $vr['type'];
			$local_device = $vr['device'];
			
	$url = "http://api.nbp.pl/api/exchangerates/rates/a/EUR/last/100/?format=json";
	$json = file_get_contents($url);
	
	$obj = json_decode($json,true);
	var_dump($obj);
	
	
	} catch (Exception $e) {
    echo $date." Error.\n";
    echo $e;
    exit;
}
?>

